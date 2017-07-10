<?php

/*
 *     2010-5-13
 *          <<<用来导入原始费用表,不用做太多的数据处理..简单完成导入即可  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

class salaryMulInsert {

    public $p; //$pdo   对象
    public $cellArray; //欲操作数组
    public $zID; //导入的工资帐套ID
    private $field; //通过数据库查询,获得
    private $fieldName; //通过数据库查询,获得
    public $extraCellArray;
    public  $setArray;
    #获取数据库中预定义的$field,$fieldName

    public function field() {
        $pdo = $this->p;
        $zID = $this->zID;
        $engToChsArr = engTochs();
        //		print_r($engToChsArr);
        $sql = "select field,zIndex from a_zformatInfo where zID like :zID";
        $res = $pdo->prepare($sql);
        $res->execute(array(":zID" => $zID));
        $ret = $res->fetch(PDO::FETCH_ASSOC);
        //引用该类的源文件要有引用common.function.php
        $fieldArr = makeArray($ret ['field']);
        $zIndex = makeArray($ret ['zIndex']);
        $zIndex = array_flip($zIndex);
        foreach ($fieldArr as $key => $val) {
            if (array_key_exists($key, $zIndex)) {
                $key = $zIndex [$key];
                $val = $engToChsArr [$key];
            }
            $newFieldArr [$key] = $val;
        }
        $this->field = array_keys($newFieldArr);
        $this->fieldName = array_values($newFieldArr);
    }

    #构造字段数组,字段名,字段显示名

    public function tableContent() {
        $field = $this->field;
        $fieldName = $this->fieldName;
        $tableContent = array_combine($field, $fieldName);
        return $tableContent;
    }

    #获取数组,并加上KEY

    public function cellArray($cellVal) {
        $field = $this->field;
        $countCell = count($cellVal);
        for ($k = 0; $k < $countCell; $k++) {
            $cellArray [] = array_combine($field, $cellVal [$k]);
        }
        $cellArray = array_filter($cellArray);
        $this->cellArray = $cellArray;
    }

    #设置文档内容函数

    public function set($mul=null) {
        $title = "导入原始费用表";
        if ($mul == "mul")
            $table = "a_" . $mul . "_originalFee_tmp";
        else
            $table = "a_originalFee_tmp";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $this->setArray= $setArray;
    }

    public function validator() {
        $tableContent = $this->tableContent();
        $cellArray = $this->cellArray;
        $countCell = count($cellArray);
        foreach ($cellArray as $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    switch ($k) {
                        //2.银行帐号可为空,但为数字
                        case "bID" :
                            if ($v) {
                                $cellK [$k] [] = $v;
                                $countRe [$k] = array_count_values($cellK [$k]);
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                }
                            }
                            break;
                        //3.同一个单位不能有同名,如果为同名则改成花名册中的编号1,2,特别注意,这里设置的是非特定分配的,表示的是只导入一个单位
                        case "name" :
                            if (is_null($v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空 {" . $v . "}";
                            }
                            //							else {
                            //								$countRe [$k] = array_count_values ( $cellK [$k] );
                            //							}
                            break;
                    }
                }
            }
        }

        //8. 查找出重复员工 
        if ($countRe) {

            foreach ($countRe as $cKey => $cVal) {
                foreach ($cVal as $cK => $cV) {
                    if ($cV > 1) {
                        $reCell [$cKey] [] = $cK;
                    }
                }
            }
            if ($reCell) {
                foreach ($reCell as $reK => $reV) {
                    foreach ($reV as $rV) {
                        for ($cC = 0; $cC < $countCell; $cC++) {
                            if ($rV === $cellArray [$cC] [$reK]) {
                                //$reErrMsg [] = "<<<" . $tableContent [$reK] . "{" . $rV . "}>>> 重复";
                                //对应的格式是(姓名,错误的项)
                                $reErrMsg [$reK] [$rV] [] = $cellArray [$cC] ['name'];
                            }
                        }
                    }
                }
                foreach ($reErrMsg as $re_k => $re_v) {
                    $reMsg .= "错误的重复项: " . $tableContent [$re_k] . "<br/>";
                    foreach ($re_v as $r_k => $r_v) {
                        $reMsg .= "  重复代码为: " . $r_k . "  错误名单为:(";
                        foreach ($r_v as $r_v_v) {
                            $reMsg .= $r_v_v . "/";
                        }
                        $reMsg .= " ) <br/><br/> ";
                    }
                    $errMsg2 = $reMsg;
                }
            }
        }

        $errMsg = @ array_unique($errMsg);
        $errMsg = array($errMsg, $errMsg2);
        $errMsg = array_filter($errMsg);
        return $errMsg;
    }

    #验证数据库中是否已存在该单位的数据

    public function validatorSql($getQuery) {
        $pdo = $this->p;
        $unitID = $getQuery ['unitID'];
        $soInsDate = $getQuery ['soInsDate'];
        $HFDate = $getQuery['HFDate'];
        $comInsDate = $getQuery ['comInsDate'];
        $salaryDate = $getQuery ['salaryDate'];
        $month = $getQuery ['month'];
        $managementCostDate = $getQuery ['managementCostDate'];
        $zID = $getQuery ['zID'];
        $table = "a_originalFee_tmp";
        $sql = "select zID from " . $table . " where unitID like '$unitID' and ( month='$month' or salaryDate = '$salaryDate' or soInsDate= '$soInsDate' or HFDate='$HFDate' or comInsDate ='$comInsDate' or managementCostDate='$managementCostDate') limit 1";
        $res = $pdo->query($sql);
        $row = $res->rowCount();		
        if ($row > 0) {
            $errMsg [] = "数据库已经存在该单位本月数据,请勿重复导入,您可以通过<a href='" . httpPath . "salaryManage/salaryManage.php?zID=$zID&month=$month&salaryDate=$salaryDate&unitID=$unitID' target='_blank'>工资表,费用表管理</a>,修改您的数据";
        }
        return $errMsg;
    }

    #生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery

    public function extraFieldValue($getQuery) {
        $sponsorTime = timeStyle("dateTime");
        $sponsorName = $_SESSION ['exp_user'] ['mName'];
        $pdo = $this->p;
        $setArr = $this->setArray;
        $table = $setArr['table'];
        $zID = $getQuery ['zID'];
        $unitID = $getQuery ['unitID'];
        $soInsDate = $getQuery ['soInsDate'];
        $HFDate = $getQuery['HFDate'];
        $comInsDate = $getQuery ['comInsDate'];
        $salaryDate = $getQuery ['salaryDate'];
        $month = $getQuery ['month'];
        $managementCostDate = $getQuery ['managementCostDate'];
        if ($getQuery['mulFee'] == "mul") {
            $sql = "select max(extraBatch) as extraBatch from " . $table . " where unitID like '$unitID' and month like '$month' limit 1";
            $ret = SQL($pdo, $sql, null, 'one');
            $extraBatch = $ret['extraBatch'] + 1;
        }
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            $cellArray [$key] ['zID'] = $zID;
            $cellArray [$key] ['unitID'] = $cellArray [$key] ['unitID'] ? $cellArray [$key] ['unitID'] : $unitID;
            $cellArray [$key] ['month'] = $month;
            if ($extraBatch)
                $cellArray [$key] ['extraBatch'] = $extraBatch;
            $cellArray [$key] ['salaryDate'] = $salaryDate;
            $cellArray [$key] ['soInsDate'] = $soInsDate;
            $cellArray [$key] ['HFDate'] = $HFDate;
            $cellArray [$key] ['comInsDate'] = $comInsDate;
            $cellArray [$key] ['managementCostDate'] = $managementCostDate;
            $cellArray [$key] ['sponsorName'] = $sponsorName;
            $cellArray [$key] ['sponsorTime'] = $sponsorTime;
        }
        return $this->extraCellArray = $cellArray;
    }

    #数据库操作语句

    public function sql() {
        $cellArray = $this->extraCellArray;
        $setArr = $this->setArray;
        $table = $setArr['table'];
        foreach ($cellArray as $cValue) {
            $s_V = "";
            $sqlK = "";
            foreach ($cValue as $cK => $cV) {
                $sqlK .='`' . $cK . '`,';
                $s_V .= "'" . $cV . "',";
            }
            $s_V = rtrim($s_V, ",");
            $sqlV .= "(" . $s_V . "),";
        }
        $sqlK = rtrim($sqlK, ",");
        $sqlV = rtrim($sqlV, ",");
        $sql = "insert into " . $table . " ( ";

        //生成插入sql语句
        $sql = array($sql . $sqlK . ") values " . $sqlV);
        return $sql;
    }

    #导入信息概况

    public function dataInfo() {
        $cellArray = $this->cellArray;
        $insertInfo = '共' . count($cellArray) . "条";
        return $insertInfo;
    }

}

?>