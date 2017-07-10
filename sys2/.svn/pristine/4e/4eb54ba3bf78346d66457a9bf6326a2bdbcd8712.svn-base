<?php

/*
  2010-1-7
  <<该页面则负责导入一张临时表,该表只具有一次性的功能,每次导入该表的时则先删除再创建>>

  encode this file to 'GBK', you will find new World..^_^
  ������,������лΰ��Ĳ����ʫ��,,,
  Ȼ����,���ǲ��ǳ���������,,���ǲ����Ѿ���Ҫ��#��,ѹ��Ͳ�֪�4���������,
  ��Ҫ��,������...��jϵshi35dong@gmail.com.��ͻ������������֢..
  4��..����һ��ֻ�м���Ĳ����...
 */

class wMulModify {

    //参数  p - > $PDO(传入参数)
    public $p;
    public $cellArray;
    private $field;
    private  $fieldName;

    #构造函数,初始化
    function  __construct()
    {
        require_once sysPath . 'dataFunction/fieldDisplay.data.php';
        $f = new fieldDisplay();
        $f->model = "mulModify";
        $f->style = "none";
        $engToChsArr = array("soInsurance"=>"是否购买社保","housingFund"=>"是否购买公积金","comInsurance"=>"是否购买商保");
        $this->field = $f->wInfoField();
        $this->fieldName = array_values($f->fieldStyle(NULL,$engToChsArr));
    }
    #验证身份证的位数及表达式,并转码15位身份证号码

    private function pIDVildator($str) {
        //验证身份证的基本正确性,并且将身份证号码转换为18位
        $isIDCard1 = "/^(\d{18,18}|\d{15,15}|\d{17,17}[A-Za-z])$/";
        if (preg_match($isIDCard1, $str)) {
            $length = strlen($str);
            if ($length == "15") {
                $pID = substr($str, 0, 6) . "19" . substr($str, 6);
                $wi = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                //校验码串
                $ai = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                //按顺序循环处理前17位
                for ($i = 0; $i < 17; $i++) {
                    //提取前17位的其中一位，并将变量类型转为实数
                    $b = (int) $pID {$i};
                    //提取相应的加权因子
                    $w = $wi [$i];
                    //把从身份证号码中提取的一位数字和加权因子相乘，并累加
                    $sigma += $b * $w;
                }
                //计算序号
                $number = $sigma % 11;
                //按照序号从校验码串中提取相应的字符。
                $check_number = $ai [$number];
                $pID = $pID . $check_number;
                return $pID;
            } elseif ($length == "17") {
                return false;
            } else {
                return $str;
            }
        } else {
            return false;
        }
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
        //		 $this->cellArray = $cellArray;
    }

    #求二维数组的相同键值的不同元素(也就是差集)

    private function array_diff_assoc_recursive($array1, $array2) {
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!isset($array2 [$key])) {
                    $difference [$key] = $value;
                } elseif (!is_array($array2 [$key])) {
                    $difference [$key] = $value;
                } else {
                    $new_diff = array_diff_assoc_recursive($value, $array2 [$key]);
                    if ($new_diff != FALSE) {
                        $difference [$key] = $new_diff;
                    }
                }
            } elseif (!isset($array2 [$key]) || $array2 [$key] != $value) {
                $difference [$key] = $value;
            }
        }
        return!isset($difference) ? 0 : $difference;
    }

    #日期格式验证

    private function isDate($str, $format = "Ymd") {
        $unixTime = strtotime($str);
        $checkDate = date($format, $unixTime);
        if ($checkDate == $str)
            return true;
        else
            return false;
    }

    #设置文档内容函数

    public function set() {
        $title = "批量导入员工信息";
        $table = "a_workerInfo";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
    }

    #验证数据正确性及到数据库部分的 函数

    public function validator() {
        $tableContent = $this->tableContent();
        $cellArray = $this->cellArray;
        $countCell = count($cellArray);
        foreach ($cellArray as $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    if (!is_null($v)) {
                        $cellK [$k] [] = $v;
                    }
                    switch ($k) {
                        // 1.身份证号码不为空时,则验证是否满足基本身份证要求
                        case "pID" :
                            if (!is_null($v) && !$this->pIDVildator($v))
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 错误 {" . $v . "}";
                            else {
                                $countRe [$k] = array_count_values($cellK [$k]);
                            }
                            break;
                        case "spousePID" :
                            if (!is_null($v) && !$this->pIDVildator($v))
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 错误 {" . $v . "}";
                            break;
                        //2.合同编号,社保号,银行帐号,社保基数不为空时,验证是否为数字代码
                        //						case "cID" :
                        case "sID" :
                        case "bID" :
                        case "HFID" :
                            if (!is_null($v)) {
                                $countRe [$k] = array_count_values($cellK [$k]);
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 错误 {" . $v . "}";
                                }
                            }
                            break;
                        case "spID":
                            	if (!is_null($v)) {
                            		$countRe [$k] = array_count_values($cellK [$k]);                            	
                            	}
                            	break;
                        case "proTitle" :
                        case "proLevel" :
                        case "role" :
                        case "marriage" :
                            if (!is_null($v)) {
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 错误 {" . $v . "}";
                                }
                            }
                            break;
                        //3.员工编号,姓名不能为空
                        case "name" :
                            if (!$v) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空 {" . $v . "}";
                            }
                            break;
                        case "uID" :
                            if (!$v) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空 {" . $v . "}";
                            } else {
                                $countRe [$k] = array_count_values($cellK [$k]);
                            }
                            break;
                        //4. 验证购买社保的情况
                        case "pension" :
                        case "hospitalization" :
                        case "employmentInjury" :
                        case "unemployment" :                       
                            if (!is_null($v)) {
                                if (!preg_match("/^[0-4]{1,1}$/", $v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '0'或'1'或'2'或'4'{" . $v . "}";
                                } else {
                                    if ((!$val ['employmentInjury'] || !$val ['radix']) && $val ['soInsurance'] != '0' && $val ['status'] != '0') {
                                        //9. 社保购买错误信息,医疗和工伤为必买项
                                        $errMsg [] = "( " . $val ['name'] . " )  缴交基数,工伤是必选项";
                                    } elseif (is_null($val ["pension"]) || is_null($val ["hospitalization"]) || is_null($val ["unemployment"]) || is_null($val ["PDIns"])) {
                                        $errMsg [] = "( " . $val ['name'] . " )  不购买的险种必需设置为0";
                                    }
                                }
                                // 16.这里还有问题 必需修改... 验证当状态不为离职时,社保购买项如果要修改,是否设置了soInsurance = '2'


                                if (is_null($val ['soInsurance']) && $val ['status'] != "0") {
                                    $errMsg [] = "( " . $val ['name'] . " ) 修改社保信息时,'是否购买社保'{" . $val ['soInsurance'] . "}项必需设置为'2'";
                                    //									$errMsg [] = "( " . $val ['name'] . " ) 修改社保信息时,'是否购买社保'项必需设置为 '2'";
                                }
                            }
                            break;
                        //5. 当单位编号,管理费不为空时,验证是否为数字代码
                       // case "managementCost" :
                       //     if (!is_null($v) && !is_numeric($v)) {
                        //        $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空/不是数字代码 {" . $v . "}";
                       //     }
                        //    break;
                        // 6. 户籍,婚否,性别不为空时,验证是否为数字代码
                        case "domicile" :
                        case "sex" :
                        case "hand" :
                            if (!is_null($v) && !preg_match("/^[1-2]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '1'或'2'{" . $v . "}";
                            }
                            break;
                        //7. 判断入/离职日期格式是否正确	
                        case "mountGuardDay" :
                        case "cBeginDay" :
//                         case "cEndDay" :
                        case "dimissionDate" :
                        case "HFBuyDate" :
                            if (!is_null($v) && !$this->isDate($v) && !$this->isDate($v, "Y-m-d")) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为日期格式(例 : 20090202) {" . $v . "}";
                            }
                            break;
                        //10. 判断购买商保,互助会,只能为 0,1状态	
                        case "comInsurance" :
                        case "helpCost" :
                            if (!is_null($v) && !preg_match("/^[0-1]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '0'或'1' {" . $v . "}";
                            }
                            break;
                        //11. 员工类型只能为1,2
                        case "type" :
                            if (!is_null($v) && !preg_match("/^[1-5]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "(" . $val ['name'] . ")   <<<" . $tableContent [$k] . ">>> 必需是数字代码 '1'至'5' {" . $v . "}";
                            }
                            break;
                        //12. 员工离职状态
                        case "status" :
                            if (!is_null($v) && !preg_match("/^[0-0]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '0'(员工复职不能批量办理) {" . $v . "}";
                            } elseif ($v == "0" && (!$val ['dimissionDate'] || !$val ['dimissionReason'])) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " ) 必需填写离职日期,原因(离职备注选填)";
                            } else {
                                if ($val ['dimissionDate'] && $val ['dimissionReason'] && is_null($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )离职信息完整,要求补全'在职状态为 0'";
                                }
                            }
                            //14.当员工在职状态等于0是, 员工的社保不允许修改 或者 新增,但可以停保(即为,不包括soInsurance = 0的情况)
                            if ($v == "0" && ($val ['soInsurance'] || $val['housingFund'] || $val ['comInsurance'] || $val ['helpCost'] || $val ['uHFPer'] || $val ['pHFPer'] || $val ['HFRadix'] || $val ['radix'] || $val ['pension'] || $val ['hospitalization'] || $val ['employmentInjury'] || $val ['unemployment'] || $val ['PDIns'])) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )在职状态是离职,不允许修改或新增社保,公积金,商保,互助会请清空相关项";
                            }
                            break;
                        //13. 当选择购买社保时,必需同时勾选要买的险种 且 必需为 '0' 或 '1'或'2'...当更改社保信息时,必需清空投保日期
                        case "soInsurance" :
                            if (!is_null($v) && !preg_match("/^[0-2]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '0'或'1'或'2' {" . $v . "}";
                            }
                            if ($v == "1" && (!$val ['employmentInjury'] || !$val ['radix'])) {
                                $errMsg [] = "( " . $val ['name'] . " )  缴交基数,工伤是必选项";
                            }
                            if ($v == "2" &&!is_null($v) && !is_null($val ['soInsBuyDate'])) {
                                $errMsg [] = "( " . $val ['name'] . " )  当更改社保信息时,必需清空投保日期";
                            }
                            if ($v == "0" && ($val ['radix'] || $val ['pension'] || $val ['hospitalization'] || $val ['employmentInjury'] || $val ['unemployment'] || $val ['housing'] || $val ['PDIns'])) {
                                $errMsg [] = "( " . $val ['name'] . " ) 不购买社保的同时,必需清空基数及险种等社保相关项";
                            }
                            break;

                        //15.如果基数不为空,则判断它是否为数字 且 医疗,工伤,基数 均不能为空或 '0'
                        case "radix" :
                            if ($v) {
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                } else {
                                    if ((!$val ['employmentInjury']) && $val ['status'] != "0") {
                                        $errMsg [] = "( " . $val ['name'] . " )  缴交基数,工伤是必选项";
                                    }
                                }
                            }
                            break;
                        //16.不准修改员工单位编号,不准批量转派遣
                        // case "unitID" :
                        // if (!is_null($v)) {
                        // $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需清空{" . $v . "}(提示:不可以批量转派遣)";
                        // }
                        // break;
                        case "housingFund" :
                            if (!is_null($v) && !preg_match("/^[0-1]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '0'或'1' {" . $v . "}";
                            }
                            if ($v == "1" && (!$val ['uHFPer'] || !$val ['pHFPer'] || !$val ['HFRadix'] || !$val['HFBuyDate'])) {
                                $errMsg [] = "( " . $val ['name'] . " )  启封日期,基数,单位比例,个人比例是必选项";
                            }
                            if ($v == "0" && ($val ['HFRadix'] || $val ['pHFPer'] || $val ['uHFPer'] || $val['HFBuyDate'] )) {
                                $errMsg [] = "( " . $val ['name'] . " ) 不购买公积金时,必需清空基数及比例等公积金相关项";
                            }
                            if (!$v && ($val ['uHFPer'] || $val ['pHFPer'] || $val ['HFRadix'] || $val['HFBuyDate'])) {
                                $errMsg [] = "( " . $val ['name'] . " )  购买公积金时,需在<是否购买公积金>项目中填写 '1'";
                            }
                            break;
                        //住房公积金比例
                        case "pHFPer" :
                        case "uHFPer" :
                            if ($v) {
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                } else {
                                    if (!$val ['HFRadix'] || !$val ['pHFPer'] || !$val ['uHFPer']) {
                                        $errMsg [] = "( " . $val ['name'] . " )   公积金基数,个人比例,单位比例是必选项";
                                    }
                                }
                            }
                            break;
                        case "HFRadix" :
                            if ($v) {
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                } else {
                                    if (!$val ['pHFPer'] || !$val ['uHFPer']) {
                                        $errMsg [] = "( " . $val ['name'] . " )   公积金基数,个人比例,单位比例是必选项";
                                    }
                                }
                            }
                            break;
                    }
                }
            }
        }
        //8. 查找出重复员工编号/身份证/社保号/合同编号的人员
        foreach ($countRe as $cKey => $cVal) {
            foreach ($cVal as $cK => $cV) {
                if ($cV > 1) {
                    $reCell [$cKey] [] = $cK;
                }
            }
        }
        foreach ($reCell as $reK => $reV) {
            foreach ($reV as $rV) {
                for ($cC = 0; $cC < $countCell; $cC++) {
                    if ($rV == $cellArray [$cC] [$reK]) {
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
        $errMsg = array_unique($errMsg);
        $errMsg = array($errMsg, $errMsg2);
        $errMsg = array_filter($errMsg);
        return $errMsg;
    }

    #验证数据库

    public function validatorSql() {
        $pdo = $this->p;
        //				$tableContent = $this->tableContent ();
        $cellArray = $this->cellArray;
        $countCell = count($cellArray);
        foreach ($cellArray as $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    switch ($k) {
                        //如果导入的数据不为空,判断是否存在相应的员工,不存在则报错
                        case "uID" :
                            //注释掉的这部分是通过数据库验证,可是他要执行很多次...哎!尴尬...
                            if ($v) {
                                $sql = "select name," . $k . " from a_workerInfo where ";
                                $sql1 = $k . " in (";
                                $sql2 .= ",'" . $v . "'";
                                $sql2 = ltrim($sql2, ",");
                                $wReSql = $sql . $sql1 . $sql2 . ") and status in (1,2) ";
                            }
                            break;
                    }
                }
            }
        }
        $res = $pdo->query($wReSql);
        if ($res->rowCount() > 0) {
            $ret = $res->fetchAll(PDO::FETCH_ASSOC);
            foreach ($ret as $rV) {
                for ($cC = 0; $cC < $countCell; $cC++) {
                    if (($rV ['uID'] == $cellArray [$cC] ['uID'] && $rV ['name'] == $cellArray [$cC] ['name'])) {
                        unset($cellArray [$cC]);
                    }
                }
            }
            //			$countCell = count ( $cellArray );
            //			for($cC = 0; $cC < $countCell; $cC ++) {
            foreach ($cellArray as $cKey => $cVal) {
                $errMsg [] = "花名册中不存在员工编号及姓名与导入数据一致的员工{" . $cVal ['uID'] . "}(" . $cVal ['name'] . ")/或该员工已经离职不允许修改信息";
            }
            //		
        } else {
            $errMsg [] = "数据库中不存在相应员工编号的员工信息/该员工已经离职不允许修改信息";
        }
        return $errMsg;
        #end validator()
    }

    #生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2

    public function extraFieldValue() {
        $time = time();
        $today = date('Ymd', $time);
        $pdo = $this->p;
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            //如果办理离职,则需判断该员工,是否有购买住房公积金,有: HFModifyDate 有变化, 无: HFModifyDate 不变
            $sql = "select housingFund,unitID,mountGuardDay from a_workerInfo where uID like '$val[uID]'";
            $res = $pdo->query($sql);
            $ret = $res->fetch(PDO::FETCH_ASSOC);
            //这部分还没有写完..过后填充,还要验证当更改的状态是复职的时候的情况,还要考虑的是员工离职的情况,要生成离职原因及其离职日期的情况,数据库再次建立一张离职信息表
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "radix" :
                    case "soInsBuyDate" :
                    case "soInsurance" :
                    case "pension" :
                    case "hospitalization" :
                    case "employmentInjury" :
                    case "unemployment" :
                    case "housing" :
                    case "PDIns" :
                        if ($val ['soInsurance'] == "0" || $val ['status'] == "0") {
                            $v = "0";
                            $val ['soInsModifyDate'] = $today;
                        }
                        //当更新社保险种,基数时,并不更新投保日期
                        if ($val ['soInsurance'] == "2" || $val ['soInsurance'] == "1") {
                            $val ['soInsModifyDate'] = $today;
                            if (is_null($v) && $k != "soInsBuyDate") {
                                $v = "0";
                            }
                        }
                        //当修改投保日期时,社保最后一次修改时间 则为 投保日期,修改投保日期的原因是:当员工的入职离封帐日20号很近的情况的处理
                        if ($val ['soInsBuyDate'] && $val ['soInsurance'] != "0") {
                            $val ['soInsModifyDate'] = $val ['soInsBuyDate'];
                        }
                        break;
                    case "HFBuyDate":
                    case "housingFund" :
                    case "HFRadix":
                    case "pHFPer":
                    case "uHFPer":
                        if (($val['housingFund'] == "0" || $val ['status'] == "0") && $ret['housingFund'] != 0) {
                            $v = '0';
                            $val ['HFModifyDate'] = $today;
                        }
                        if ($val ['HFBuyDate'] && $val ['housingFund'] == "1") {
                            $val ['HFModifyDate'] = $val ['HFBuyDate'];
                        }
                        break;
                    case "comInsurance" :
                        if ($v == "0" || $val ['status'] == "0") {
                            $v = '0';
                            $val ['comInsModifyDate'] = $today;
                        }
                        break;
                    case "helpCost" :
                        if ($v == "0" || $val ['status'] == "0") {
                            $v = '0';
                            $val ['helpModifyDate'] = $today;
                        }
                        break;

                    case "dimissionDate" :
                    case "dimissionReason" :
                    case "dimissionRemarks" :
                        //员工状态不存在且 离职日期和离职原因不为空时,则该员工有关离职的项目全部清空	
                        if (is_null($val ["status"]) && !is_null($v)) {
                            $v = NULL;
                        }
                        break;
                    case "pID" :
                        if ($v)
                            $v = $this->pIDVildator($v);
                        break;
                }
                if (!is_null($v)) {
                    $newCellArray [$key] [$k] = $v;
                }
            }
            //如果为离职状态,则保存上次入职地方和日期
            if ($val['status'] == '0') {
                $newCellArray [$key] ['unitID'] = $ret['unitID'];
                $newCellArray [$key] ['mountGuardDay'] = $ret ['mountGuardDay'];
            }
            $newCellArray [$key] ['HFModifyDate'] = $val ['HFModifyDate'];
            $newCellArray [$key] ['soInsModifyDate'] = $val ['soInsModifyDate'];
            $newCellArray [$key] ['comInsModifyDate'] = $val ['comInsModifyDate'];
            $newCellArray [$key] ['helpModifyDate'] = $val ['helpModifyDate'];
            $newCellArray [$key] ['lastModifyDate'] = date("Y-m-d H:i:s", $time);
            $newCellArray [$key] ['sponsorName'] = $_SESSION ['exp_user'] ['mName'];
            //			$newCellArray [$key] ['comInsurance'] = $val ['comInsurance'];
            //			$newCellArray [$key] ['helpCost'] = $val ['helpCost'];
        }
        return $newCellArray;
        #end 	extraFieldValue()
    }

    #数据库语句

    public function sql() {
        $now = date("Y-m-d H:i:s", time());
        $cellArray = $this->extraFieldValue();
        $engToChs = array_merge( engTochs(),wInfoExtraFieldSet());
        foreach ($cellArray as $cValue) {
            $sqlH = "update a_workerInfo set ";
            $sqlX = $modifyFiled=null;
            foreach ($cValue as $cK => $cV) {
                if ($cK != "dimissionReason" && $cK != "dimissionRemarks" && $cK != "uID" && $cK != "name") {
                    if (!is_null($cV)) {
                        $sqlX .= $cK . " = '" . $cV . "',";
                        if($cK != "lastModifyDate" && $cK != "sponsorName")
                  		     $modifyFiled .=$engToChs[$cK]."/";
                    }
                }
            }
            if (!is_null($cValue ['dimissionDate'])) {
                $s_V .= "('" . $cValue ['uID'] . "','" . $cValue ['mountGuardDay'] . "','" . $cValue ['unitID'] . "','" . $cValue ['dimissionDate'] . "','" . $cValue ['dimissionReason'] . "','" . $cValue ['dimissionRemarks'] . "','" . $_SESSION ['exp_user'] ['mID'] . "','" . $now . "' ),";
            }
            //生成更新语句
            $modifyRemarks="修改: ".$modifyFiled;
            $sql [] = $sqlH . $sqlX . " `modifyRemarks`='$modifyRemarks' where uID like '" . $cValue ['uID'] . "'";
            if (is_null($cValue ['status'])) {
                $uID .= "'" . $cValue ['uID'] . "',";
            }
            $allUID .= "'" . $cValue ['uID'] . "',";
            //
        }
        //生成员工离职语句
        $uIDV = rtrim($uID, ",");
        $allUIDV = rtrim($allUID, ",");
        $sqlV = rtrim($s_V, ",");
        //生成插入额外的sql语句
        $dimiSql = "insert into a_dimission (uID, entryDate,lastUnitID,dimissionDate,dimissionReason,dimissionRemarks,createdBy,createdOn) values";
        $sql ['extra'] [] = $dimiSql . $sqlV;
        if ($uIDV) {
            $sql ['extra'] [] = "update a_workerInfo set status = '1' where status<>0 and radix <> 0 and bID <> '' and sID <> ''  and pID <> '' and type like '1' and uID in (" . $uIDV . ")";
            $sql ['extra'] [] = "update a_workerInfo set status = '1' where status<>0 and  radix <> 0 and  sID <> ''  and pID <> '' and type not like '1' and uID in (" . $uIDV . ")";
        }
        //生成历史记录
        $iSql = "insert into a_workerInfo_history select * from a_workerInfo where uID in (" . $allUIDV . ")";
        $pdo = $this->p;
        $pdo->query($iSql);

        return $sql;
    }

    #数据库事务处理函数(一般的 更新及插入操作,全部要执行成功)

    public function transaction($sqlQueue) {
        $pdo = $this->p;
        $num = 0;
        $i = 0;
        if (count($sqlQueue) > 0) {
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                $pdo->beginTransaction();
                foreach ($sqlQueue as $sql) {
                    if (!is_array($sql)) {
                        $eNum = $pdo->exec($sql);
                        $num += $eNum;
                        if (!$eNum) {
                            $err .= "<br/>信息未变更:" . $sql;
                            //						
                        }
                        $i++;
                    }
                }
                if ($i == $num) {
                    $pdo->commit();
                }
            } catch (Exception $e) {
                $err .= "<br/>事务处理出错:" . $e->getMessage();
                $pdo->rollBack();
            }
        } else {
            $err .= "<br/>sql语句数组不能为空";
        }
        //	var_dump($err);
        $result = array("error" => $err, "num" => $num);
        return $result;
    }

    #额外的SQL信息操作 (不一定都要执行成功,没有任何返回其实..)

    public function extraTransaction($sqlQueue) {
        $pdo = $this->p;
        if (count($sqlQueue) > 0) {
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                $pdo->beginTransaction();
                foreach ($sqlQueue as $sql) {
                    $pdo->exec($sql);
                }
                $pdo->commit();
            } catch (Exception $e) {
                $err .= "<br/>事务处理出错:" . $e->getMessage();
                $pdo->rollBack();
            }
        } else {
            $err .= "<br/>sql语句数组不能为空";
        }
        //	var_dump($err);
        $result = array("error" => $err);
        return $result;
    }

    #导入的数据的相关信息

    public function dataInfo() {
        $cellArray = $this->extraFieldValue();
        $w1 = $w2 = $x1 = $x2 = $y1 = $y2 = $z1 = $z2 = 0;
        $insertInfo .= '<div style="min-height:200px;overflow:hidden;">';
        foreach ($cellArray as $cValue) {
            foreach ($cValue as $cK => $cV) {
                if ($cK == 'type') {
                    switch ($cV) {
                        case "1" :
                            $w1++;
                            if ($cValue ['soInsurance'] == "0") {
                                $x1++;
                                $o1 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['comInsurance'] == "0") {
                                $y1++;
                                $p1 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['status'] == "0") {
                                $z1++;
                                $q1 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td></tr>";
                            }
                            break;
                        case "2" :
                            $w2++;
                            if ($cValue ['soInsurance'] == "0") {
                                $x2++;
                                $o2 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['comInsurance'] == "0") {
                                $y2++;
                                $p2 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['status'] == "0") {
                                $z2++;
                                $q2 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            break;
                    }
                }
            }
        }
        if ($w1 != 0) {
            $insertInfo .= '<div class="block left halfWidth"><p class="notice">1. 全日制员工有' . $w1 . ' 人,有 ' . $x1 . ' 人停止购买社保,有' . $y1 . '  人停止购买商保,有' . $z1 . '  人离职</p>';
            if ($x1)
                $insertInfo .= '<div class="left" >停止购买社保名单:
            <table class="myTable">
            <thead>
            <tr>
	    <td>姓名</td><td>编号</td>
            </tr>
	    </thead>
	    <tbody>
	    ' . $o1 . '
	    </tbody>
	    </table></div>';

            if ($y1)
                $insertInfo .= '<div class="left" >停止购买商保名单:
		<table class="myTable">
                <thead>
                <tr>
                  <th>姓名</th><th>编号</th>
                </tr>
	    </thead>
	    <tbody>
	    ' . $p1 . '
	    </tbody>
	    </table></div>';

            if ($z1)
                $insertInfo .= '<div class="left" >离职员工名单:
		<tr><table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $q1 . '
	    </tbody>
	    </table></div>';
            $insertInfo .= '</div>';
        }
        if ($w2 != 0) {
            $insertInfo .= '<div class="block right halfWidth"><p class="notice">2. 非全日制员工有 ' . $w2 . '人,有' . $x2 . '  人停止购买社保,有' . $y2 . '  人停止购买商保,有' . $z2 . '  人离职</p>';
            if ($x2)
                $insertInfo .= '<div class="left" >停止购买社保名单:
                    <table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $o2 . '
	    </tbody>
	    </table></div>';
            if ($y2)
                $insertInfo .= '<div class="left" >停止购买商保名单:
                    <table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $p2 . '
	    </tbody>
	    </table></div>';
            if ($z2)
                $insertInfo .= ' <div class="left" >离职名单:
                    <table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $q2 . '
	    </tbody>
	    </table></div> ';
            $insertInfo .= '</div>';
        }
        $insertInfo .= '</div>';
//        $cellArray = $this->cellArray;
//        $insertInfo = '共' . count($cellArray) . "条";
        return $insertInfo;
    }

    #end class	
}

?>