<?php

/*
 *     2010-5-13
 *          <<<用来导入原始费用表,不用做太多的数据处理..简单完成导入即可  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

class rewardMulInsert {

    public $p; //$pdo   对象
    public $cellArray; //欲操作数组
    public $zID; //导入的工资帐套ID
    private $field; //通过数据库查询,获得
    private $fieldName; //通过数据库查询,获得
    public $extraCellArray;
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

    public function set() {
        $title = "导入原始的奖金表";
        $table = "a_rewardFee_tmp";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
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
                            break;
                    }
                }
            }
        }

        //8. 查找出重复员工编号/身份证/社保号/合同编号的人员
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

    #生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery

    public function extraFieldValue($getQuery) {
        $pdo = $this->p;
        $sponsorTime = timeStyle("dateTime");
        $sponsorName = $_SESSION ['exp_user'] ['mName'];
        $zID = $getQuery ['zID'];
        $unitID = $getQuery ['unitID'];
        $rewardDate = $getQuery ['rewardDate'];
        $month = $getQuery ['month'];
        $cellArray = $this->cellArray;
        $sql = "select max(extraBatch) as maxExtraBatch from `a_rewardFee_tmp` where `unitID` like '$unitID' and `month` like '$month'";
        $ret = SQL($pdo, $sql, null, 'one');
        $extraBatch = 0;
        if ($ret['maxExtraBatch'])
            $extraBatch = $ret['maxExtraBatch'] + 1;
        else
            $extraBatch = 1;
        foreach ($cellArray as $key => $val) {
            $cellArray [$key] ['zID'] = $zID;
            $cellArray [$key] ['unitID'] = $cellArray [$key] ['unitID'] ? $cellArray [$key] ['unitID'] : $unitID;
			$cellArray [$key] ['month'] = $month;
            $cellArray[$key]['extraBatch'] = $extraBatch;
            $cellArray [$key] ['rewardDate'] = $rewardDate;
            $cellArray [$key] ['sponsorName'] = $sponsorName;
            $cellArray [$key] ['sponsorTime'] = $sponsorTime;
        }
        return $this->extraCellArray = $cellArray;
    }

    #数据库操作语句

    public function sql() {
        $cellArray = $this->extraCellArray;
        foreach ($cellArray as $cValue) {
            $s_V = "";
            $sqlK = "";
            foreach ($cValue as $cK => $cV) {
                $sqlK .= $cK . ',';
                $s_V .= "'" . $cV . "',";
            }
            $s_V = rtrim($s_V, ",");
            $sqlV .= "(" . $s_V . "),";
        }
        $sqlK = rtrim($sqlK, ",");
        $sqlV = rtrim($sqlV, ",");
        $sql = "insert into `a_rewardFee_tmp` ( ";

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