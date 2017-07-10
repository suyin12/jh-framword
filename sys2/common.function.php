<?php

if (realpath(__FILE__) == realpath($_SERVER ['SCRIPT_FILENAME'])) {
    exit ('禁止访问');
}

#设置员工信息的额外列 ,目前数据库只多设置了4列,要添加相应的列

function wInfoExtraFieldSet()
{
    //额外项
    $array = array("spID" => "特定编号", "A" => "姓名(证)", "B" => "家庭住址(证)", "C" => "工作单位(证)", "D" => "手机(证)", "E" => "固话(证)", "F" => "工会证号", "G" => "行政职务", "H" => "子女数量", "I" => "健康状况", "J" => "驾驶证类型", "K" => "家庭收入", "L" => "住房情况", "M" => "配偶单位");
    return $array;
}

#各种中英文对照,英文字段所表示的中文名称,也可以做统一的名称显示

function engTochs()
{
    $arr = array("unitName" => "单位名称", 'num' => "序号", 'extraBatch' => "批次", "utilities" => "房屋水电", "cardMoney" => "制卡费", "totalFee" => "总费用", "mCost" => "管理费", "total" => "合计", "pTotal" => "个人合计", "uTotal" => "单位合计", "soInsID" => "社保帐户", "housingFundID" => "公积金帐户", "soInsDate" => "社保年月", 'HFDate' => "公积金年月", "uHF" => "单位公积金", "pHF" => "个人公积金", "uHFPer" => "单位公积金比例", "pHFPer" => "个人公积金比例", "salaryDate" => "工资年月", 'rewardDate' => "奖金年月", "comInsDate" => "商保年月", "pComIns" => "个人商保", "uComIns" => "单位商保", "uSoIns" => "单位社保", "pSoIns" => "个人社保", "uPDIns" => "残障金", "uPension" => "单位养老", "uHospitalization" => "单位医疗", "uHousing" => "单位住房", "employmentRadix" => "工伤基数", "uEmploymentInjury" => "单位工伤", "uUnemployment" => "单位失业", "uBirth" => "单位生育", "pPension" => "个人养老", "pHospitalization" => "个人医疗", "sponsorName" => "提交人", "sponsorTime" => "提交时间", "batch" => "批次号", 'status' => "状态", 'uID' => '员工编号', 'name' => "姓名", 'pID' => "身份证号码", 'bID' => "工资账号", 'oldBID' => "曾用工资账号", "spID" => "特定编号", "photoID" => "数码图像号", 'sex' => "性别", 'nation' => "民族", 'homeAddress' => "家庭地址", 'workAddress' => "工作地址", 'education' => "学历", 'role' => "政治面貌", 'marriage' => "婚否", 'mobilePhone' => "移动电话", 'telephone' => "固定电话", 'contact' => "联系人", 'contactPhone' => "联系电话", 'school' => "学校", 'blank' => "开户银行", 'type' => "员工类型", 'unitID' => "单位编号", "filiale" => "分公司", 'department' => "部门", 'station' => "岗位", 'mountGuardDay' => "入职日期", 'cBeginDay' => "合同开始日期", 'cEndDay' => "合同终止日期", 'soInsurance' => "社保", 'soInsModifyDate' => "社保变更日期", 'housingFund' => "公积金", "HFBuyDate" => "公积金购买日期", 'HFModifyDate' => '公积金变更日期', "HFRadix" => "公积金基数", 'domicile' => "户籍类型", 'soInsBuyDate' => "投保日期", 'sID' => "社保号", "HFID" => "个人公积金号", 'radix' => "缴交基数", 'pension' => "养老", 'hospitalization' => "医疗", 'employmentInjury' => "工伤", 'unemployment' => "失业", 'housing' => "住房", 'PDIns' => "残障金", 'hand' => "利手", 'comInsurance' => "商保", 'helpCost' => "互助会", 'helpCostFee' => "互助会费", 'managementCost' => "管理费", 'managementCostFee' => "管理费", 'jobRegModifyDate' => "就业登记日期", 'remarks' => "备注", 'dimissionDate' => "离职日期", 'dimissionReason' => "离职原因", 'dimissionRemarks' => "离职备注", 'pay' => "应发工资", 'pTax' => '个税', 'acheive' => "实发工资", 'ratal' => '应纳税额', "uSoInsMoney" => "单位社保", "uHFMoney" => "单位公积金", "pHFMoney" => "个人公积金", "pSoInsMoney" => "个人社保", "pComInsMoney" => "个人商保", "uComInsMoney" => "单位商保", "advanceMoney" => "收回垫付款", "+" => "加", "-" => "减", "/" => "除", "*" => "乘", "(" => "左括号", ")" => "右括号", "marketName" => "市场", "marketNum" => "场次", "cvNum" => "简历数", "mountGuardNum" => "入职", "rateSuccess" => "成功率", "betterPosition" => "突出岗位", "positionName" => "岗位(单位)", "betterMarket" => "突出市场", "waitNum" => "待岗人数", "createdByNum" => "录入数", "createdBy" => "创建人", "createdOn" => "创建时间", "phoneAccessNum" => "电话回访数", "reexamineNum" => "复试人数", "dateOfGraduation" => "毕业年月", "cType" => "合同信息", "spouseName" => "配偶姓名", "spousePID" => "配偶身份证", "birthID" => "避孕节育报告单号", "proTitle" => "职称", "proLevel" => "技能等级", "dID" => "档案编号", "jobRegmodifyDate" => "就业登记日期");
    return $arr;
}

#递归函数
function fetchArray($array)
{
    if (!empty ($array)) {
        foreach ($array as $val) {
            if (is_array($val)) {
                $arrStr .= fetchArray($val);
            } else {
                $arrStr .= $val . "<br/>";
            }
        }
    }
    return $arrStr;
}

#获取文件的扩展名
function getFileExtension($filepath)
{
    $fileinfo = pathinfo($filepath);
    return $fileinfo ['extension'];
}

#密码加密
function pwMcrypt($v, $t = "encode")
{
    require_once sysPath . 'class/mCrypt.class.php';
    $m = new mCrypt ();
    if ($t == "encode")
        $mCryptVal = $m->encrypt($v);
    elseif ($t == "decode")
        $mCryptVal = $m->decrypt($v);
    return $mCryptVal;
}

#变量加引号
function makeMark($string)
{
    $str = "'" . $string . "'";
    return $str;
}

#事务处理语句 :要求全部执行成功
function transaction($pdo, $sqlQueue, $excArr = null)
{
    $num = 0;
    $i = 0;
    if (count($sqlQueue) > 0) {
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
            $pdo->beginTransaction();
            foreach ($sqlQueue as $sql) {
                if (!is_array($sql)) {
                    if ($excArr) {
                        $res = $pdo->prepare($sql);
                        $res->execute($excArr);
                        $eNum = $res->rowCount();
                    } else {
                        $res = $pdo->query($sql);
                        $eNum = $res->rowCount();
                    }
                    $num += $eNum;
                    if (!$eNum) {
                        $err .= "\n 信息未变更:" . $sql;
                    }
                    $i++;
                }
            }
            if ($i == $num) {
                $tNum = $num;
                $pdo->commit();
            }
        } catch (Exception $e) {
            $err .= "\n 事务处理出错:" . $e->getMessage();
            $pdo->rollBack();
        }
    } else {
        $err .= "\n sql语句数组不能为空";
    }
    //	var_dump($err);
    $result = array(
        "error" => $err,
        "num" => $tNum
    );
    return $result;
}

#事务处理语句 :不要求全部执行成功
function extraTransaction($pdo, $sqlQueue)
{
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
    $result = array(
        "error" => $err
    );
    return $result;
}

#数据库执行操作
function SQL($pdo, $sql, $var = null, $type = "all")
{
    $res = $pdo->prepare($sql);
    if ($var)
        $res->execute($var);
    //下面这句怎么不行了......他妈`奇怪
    else
        $res->execute();
    //2016-01-14修改过
    if ($type == "all")
        try {
            $row = $res->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $e) {
            $result['error'] .= "\n 事务处理出错:" . $e->getMessage();
        }
//    print_r($result);
//        $row = $res->fetchAll(PDO::FETCH_ASSOC);//2016-07-14原来
    if ($type == "one")
        $row = $res->fetch(PDO::FETCH_ASSOC);
    return $row;
}

#重构数组..指定KEY为该数组的KEY
function keyArray($arr, $key)
{
    if (is_array($arr))
        foreach ($arr as $v) {
            $newArr [$v [$key]] = $v;
        }
    unset ($arr);
    return $newArr;
}

#获取真实ip地址,即使是代理服务器
function getRealIpAddr()
{
    if (!empty($_SERVER ['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER ['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER ['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
        $ip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER ['REMOTE_ADDR'];
    }
    return $ip;
}

#获取ip地址,返回值为IP  string
function ip_address()
{
    static $ip_address = NULL;

    if (!isset ($ip_address)) {
        $ip_address = $_SERVER ['REMOTE_ADDR'];
        if (variable_get('reverse_proxy', 0) && array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            // If an array of known reverse proxy IPs is provided, then trust
            // the XFF header if request really comes from one of them.
            $reverse_proxy_addresses = variable_get('reverse_proxy_addresses', array());
            if (!empty ($reverse_proxy_addresses) && in_array($ip_address, $reverse_proxy_addresses, TRUE)) {
                // If there are several arguments, we need to check the most
                // recently added one, i.e. the last one.
                $ip_address = array_pop(explode(',', $_SERVER ['HTTP_X_FORWARDED_FOR']));
            }
        }
    }

    return $ip_address;
}

#为用户提供强制下载
function force_download($file)
{
    if ((isset ($file)) && (file_exists($file))) {
        header("Content-length: " . filesize($file));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"');
        readfile("$file");
    } else {
        echo "No file selected";
    }
}

#各种时间函数
function timeStyle($style, $cat = "-", $time = null)
{
//判断是否有传入时间戳
    $time = is_null($time) ? time() : $time;
    switch ($style) {
        case "dateTime" :
            $timeStyle = date("Y" . $cat . "m" . $cat . "d H:i:s", $time);
            break;
        case "date" :
            $timeStyle = date("Y" . $cat . "m" . $cat . "d", $time);
            break;
        case "Ym" :
            $timeStyle = date("Y" . $cat . "m", $time);
            break;
        case "md" :
            $timeStyle = date("m" . $cat . "d", $time);
            break;
        case "d" :
            $timeStyle = date("d", $time);
            break;
        case "timeStamp" :
            $timeStyle = $time;
            break;
        //本月第一天
        case "firstdayMon" :
            $timeStyle = date('Y' . $cat . 'm' . $cat . '01', $time);
            break;
        //本月最后一天
        case "finallyDayMon" :
            $firstday = date('Y-m-01', $time);
            $timeStyle = date('Y' . $cat . 'm' . $cat . 't', $time);
            break;
    }
    return $timeStyle;
}

#解析数据库中数组形式的数据结构,返回数组..
function makeArray($string)
{
    $str = 'array (' . $string . ')';
    eval ('$arr=' . $str . ';');
    return $arr;
}

#日期格式验证
function isDate($str, $format = "Ymd")
{
    if ($format == "Ym")
        $checkStr = $str . "01";
    else
        $checkStr = $str;
    $unixTime = strtotime($checkStr);
    $checkDate = date($format, $unixTime);
    if ($checkDate == $str)
        return true;
    else
        return false;
}

#验证日期格式,年月
function isMonth($str, $format = "")
{
    //正则验证;
    if ($format) {
        if (preg_match("/^\d{4}\D{1}([0-12]{2}|0[1-9]{1})$/", $str))
            return true;
        else
            return false;
    } else {
        if (preg_match("/^\d{4}([0-12]{2}|0[1-9]{1})$/", $str))
            return true;
        else
            return false;
    }
}

#身份证号码15位转18位,当然也可以转17位的,但是一般情况下 均为输入错误
function pIDVildator($str)
{
    //验证身份证的基本正确性,并且将身份证号码转换为18位
    $isIDCard1 = "/^(\d{18,18}|\d{15,15}|\d{17,17}[A-Za-z])$/";
    if (preg_match($isIDCard1, $str)) {
        $length = strlen($str);
        if ($length == "15") {
            $pID = substr($str, 0, 6) . "19" . substr($str, 6);
            $wi = array(
                7,
                9,
                10,
                5,
                8,
                4,
                2,
                1,
                6,
                3,
                7,
                9,
                10,
                5,
                8,
                4,
                2
            );
            //校验码串
            $ai = array(
                '1',
                '0',
                'X',
                '9',
                '8',
                '7',
                '6',
                '5',
                '4',
                '3',
                '2'
            );
            //按顺序循环处理前17位
            for ($i = 0; $i < 17; $i++) {
                //提取前17位的其中一位，并将变量类型转为实数
                $b = ( int )$pID{$i};
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
        } elseif ($length == "18") {
            $pID = substr($str, 0, 17);
            $last = substr($str, 17, 1);
            $wi = array(
                7,
                9,
                10,
                5,
                8,
                4,
                2,
                1,
                6,
                3,
                7,
                9,
                10,
                5,
                8,
                4,
                2
            );
            //校验码串
            $ai = array(
                '1',
                '0',
                'X',
                '9',
                '8',
                '7',
                '6',
                '5',
                '4',
                '3',
                '2'
            );
            //按顺序循环处理前17位
            for ($i = 0; $i < 17; $i++) {
                //提取前17位的其中一位，并将变量类型转为实数
                $b = ( int )$pID{$i};
                //提取相应的加权因子
                $w = $wi [$i];
                //把从身份证号码中提取的一位数字和加权因子相乘，并累加
                $sigma += $b * $w;
            }
            //计算序号
            $number = $sigma % 11;
            //按照序号从校验码串中提取相应的字符。
            $check_number = $ai [$number];
            if ($check_number == $last) {
                return $str;
            } else {
                return false;
            }
        } else {
            return $str;
        }
    } else {
        return false;
    }
}
#根据身份证获取性别,返回值 1:男, 2:女
function getSexByPID($pID){
    $sex=substr($pID, (strlen($pID)==15 ? -2 : -1), 1) % 2 ? '1' : '2';
    return $sex;
}

#手机号码验证
function mobileNumValid($str)
{
    $errMsg = null;
    if (!preg_match("/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/", $str))
        $errMsg = "手机号码错误";
    return $errMsg;
}

#公式验证(简单验证版..正则水平太有限)
function validFormulas($str)
{
    $errMsg = null;
    if (preg_match("/(?![\+|\-|\*|\/|\(|\)|\.])\W{1}|[\+|\-|\*|\/]{2,}?/", $str))
        $errMsg = "请验证运算符是否正确";
    return $errMsg;
}

#定义公式确定的部分Str,$formulasStr 是一个数组...
//	$zfSql = "select zIndex,field,payFormulas,ratalFormulas,acheiveFormulas from a_zformatInfo where zID like :zID";
//	$zfRes = $pdo->prepare ( $zfSql );
//	$zfRes->execute ( array (":zID" => $zID ) );
//	$zfRet = $zfRes->fetch ( PDO::FETCH_ASSOC );
//	//获取各种公式..
//	$formulasStr =array("pay"=> $zfRet['payFormulas'],"ratal"=>$zfRet['rataFormulas'],"acheiveFormulas"=>$zfRet['acheive']);
function formulasStr($type, $formulasStr)
{
    switch ($type) {
        //应缴纳税额
        case "ratalFormulas" :
            $str = $formulasStr ['pay'] . "-" . $formulasStr ['pSoIns'];
            break;
        case "acheiveFormulas" :
            $str = $formulasStr ['pay'] . "-" . $formulasStr ['pSoIns'] . "-" . $formulasStr ['pComIns'] . "-" . $formulasStr ['pSoInsMoney'] . "-" . $formulasStr ['pComInsMoney'] . "-" . $formulasStr ['utilities'] . "-" . $formulasStr ['helpCost'];
            break;
    }
    return $str;
}

#引用原有的字符串,应用于preg_replace_callback,,,并替换成相应的格式,$ex是匹配到的数组,这里就暂且指定他只用来替换费用表数组了
function curry($func, $arity)
{
    //转换返回函数是否有多个参数
    return create_function('', "
        \$args = func_get_args();
        if(count(\$args) >= $arity)
            return call_user_func_array('$func', \$args);
        \$args = var_export(\$args, 1);
        return create_function('','
            \$a = func_get_args();
            \$z = ' . \$args . ';
            \$a = array_merge(\$z,\$a);
            return call_user_func_array(\'$func\', \$a);
        ');
    ");
}

function on_match($arrField, $matches)
{
    //要替换的字符串
    if (!$arrField)
        return '$fVal[\'' . $matches [0] . '\']';
    else
        return "$" . $arrField . '[\'' . $matches [0] . '\']';
}

function strToPHP($str, $arrField = NULL)
{
    //并且在这里替换A B C 为变量进行运算操作
    //这里就获得了应发工资的字符串了..再EVAL 一下..就可以转成PHP代码进行运算了
    $callback = curry(on_match, 2);
    //	$phpStr = preg_replace_callback ( "/((?<=[\+|\-|\*|\/|\(|\)|\.]))?\w+(?=[\+|\-|\*|\/|\(|\)|\.]?)/", $callback ( $arrField ), $str ) . ";";
    $phpStr = preg_replace_callback("/((?<=[\+|\-|\*|\/|\(|\)|\.]))?((\b[a-zA-Z])\w*)(?=[\+|\-|\*|\/|\(|\)|\.]?)/", $callback ($arrField), $str) . ";";
    return $phpStr;
}

#运算中的变量替换
function replaceStr($string, $replaceArr)
{
    foreach ($replaceArr as $key => $val) {
        //必需以运算符开始和结束
        $string = preg_replace("/(?<=[\+|\-|\*|\/|\(|\)|\.]\b)" . $key . "(?=[\+|\-|\*|\/|\(|\)|\.]?)/", $val, $string);
    }
    return $string;
}

#删除欠挂记录为0的 记录
function delPrsMoney($pdo)
{
    $delSql = "delete from `a_prsRequireMoney` where `uPDInsMoney`='0' and `uSoInsMoney`='0' and `pSoInsMoney`='0' and `uComInsMoney`='0' and `pComInsMoney`='0' and `pHFMoney`='0' and `uHFMoney`='0' and `managementCostMoney`='0' and `soInsCardMoney`='0' and `residentCardMoney`='0' and `uAccount`='0' and `pOtherMoney` = '0' and `uOtherMoney`='0' and `salaryMoney`='0' ";
    $pdo->query($delSql);
}

#生成a_prsRequireMoney的临时保存表
function saveMoneyTmp($pdo, $conArr)
{
    $delSql = "delete from a_prsRequireMoney_tmp where month like '" . $conArr ['month'] . "' and unitID like '" . $conArr ['unitID'] . "'";
    if ($conArr ['extraBatch'])
        $delSql .= " and `extraBatch`='" . $conArr ['extraBatch'] . "'";
    else
        $delSql .= " and `extraBatch`='0'";
    $pdo->query($delSql);
    $sql = "insert into a_prsRequireMoney_tmp (unitID,month,extraBatch,uID,status,feeType,type,sponsorName,sponsorTime,`uPDInsMoney`, `uSoInsMoney`, `pSoInsMoney`, `uComInsMoney`, `pComInsMoney`, `pHFMoney`, `uHFMoney`, `managementCostMoney`, `soInsCardMoney`, `residentCardMoney`, `uAccount`, `pOtherMoney`,`uOtherMoney`, `salaryMoney`)
             select unitID,month,extraBatch,uID,status,feeType,type,sponsorName,sponsorTime,`uPDInsMoney`, `uSoInsMoney`, `pSoInsMoney`, `uComInsMoney`, `pComInsMoney`, `pHFMoney`, `uHFMoney`, `managementCostMoney`, `soInsCardMoney`, `residentCardMoney`, `uAccount`, `pOtherMoney`,`uOtherMoney`, `salaryMoney`  from a_prsRequireMoney where month like '" . $conArr ['month'] . "' and unitID like '" . $conArr ['unitID'] . "'";
    if ($conArr ['extraBatch'])
        $sql .= " and `extraBatch`='" . $conArr ['extraBatch'] . "'";
    else
        $sql .= " and `extraBatch`='0'";
    $pdo->query($sql);
}

#设置计算个税的函数,
function taxCount($ratalMoney, $taxTypeArr = null)
{
    //起征点3500
    $point = 3500;
    if ($taxTypeArr ['type'] == "yearAward") {
        #年终奖算法
        $b = ($taxTypeArr ['salary'] - $point) >= 0 ? $ratalMoney : ($ratalMoney - ($point - $taxTypeArr ['salary']));
        $a = round(($b / 12), 2);
        if (0 < $a && $a <= 1500) {
            $per = 0.03;
            $tax = $b * $per;
        } elseif (1500 < $a && $a <= 4500) {
            $per = 0.1;
            $tax = $b * $per - 105;
        } elseif (4500 < $a && $a <= 9000) {
            $per = 0.2;
            $tax = $b * $per - 555;
        } elseif (9000 < $a && $a <= 35000) {
            $per = 0.25;
            $tax = $b * $per - 1005;
        } elseif (35000 < $a && $a <= 55000) {
            $per = 0.3;
            $tax = $b * $per - 2755;
        } elseif (55000 < $a && $a <= 80000) {
            $per = 0.35;
            $tax = $b * $per - 5505;
        } elseif ($a > 80000) {
            $per = 0.45;
            $tax = $b * $per - 13505;
        } else {
            $a = 0;
            $b = 0;
            $per = 0;
            $tax = 0;
        }
        return $yearAWardArr = array(
            "ratalTotal" => $b,
            "ratalMonAvg" => $a,
            "taxPer" => $per,
            "tax" => $tax
        );
    } else {
        #一般奖金算法
        $a = $ratalMoney - $point;
        if (0 < $a && $a <= 1500) {
            $tax = $a * 0.03;
        } elseif (1500 < $a && $a <= 4500) {
            $tax = $a * 0.1 - 105;
        } elseif (4500 < $a && $a <= 9000) {
            $tax = $a * 0.2 - 555;
        } elseif (9000 < $a && $a <= 35000) {
            $tax = $a * 0.25 - 1005;
        } elseif (35000 < $a && $a <= 55000) {
            $tax = $a * 0.3 - 2755;
        } elseif (55000 < $a && $a <= 80000) {
            $tax = $a * 0.35 - 5505;
        } elseif ($a > 80000) {
            $tax = $a * 0.45 - 13505;
        } else {
            $tax = 0;
        }
    }
    return $tax;
}

#合并数组,但并不合并相同键值的项,单纯的增加元素,这里就不保存KEY了..重新生成新KEY
function mergeArray($arr1, $arr2, $arr3 = null, $arr4 = null, $arr5 = null)
{
    //懒得改成获取局部变量,然后递归生成了...最多也很难超过5个...如果真的多再重新写个...
    $newArr = null;
    $i = 0;
    if (is_array($arr1))
        foreach ($arr1 as $oV) {
            $newArr [] = $oV;
        }
    if (is_array($arr2))
        foreach ($arr2 as $sV) {
            $newArr [] = $sV;
        }
    if (is_array($arr3))
        foreach ($arr3 as $sV) {
            $newArr [] = $sV;
        }
    if (is_array($arr4))
        foreach ($arr4 as $sV) {
            $newArr [] = $sV;
        }
    if (is_array($arr5))
        foreach ($arr5 as $sV) {
            $newArr [] = $sV;
        }
    return $newArr;
}

#匹配字符串全是中文
function matchCHN($str)
{
    if (!preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $str)) { //UTF-8汉字字母数字下划线正则表达式
        $msg = false;
    } else {
        $msg = true;
    }
    return $msg;
}

#验证EMAIL地址是否正确
function emailValid($email)
{
    if (ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+", $email)) {
        return true;
    } else {
        return false;
    }
}

#递归算法,$array 表示被减数的集合,$subVal减数的集合,返回的结果是array 余数的KEY和减数的VALUE
function recursionSub($array, $subVal)
{
    foreach ($array as $key => $val) {
        $t += $val;
        $newArr [$key] = $val;
        if ($t - $subVal >= 0) {
            $newArr [$key] = $t - $subVal;
            break;
        } else {
            $newArr [$key] = 0;
        }
    }
    return $newArr;
}

#递归算法,key相同的数相加(数组的合并相加),$array 表示被加数的集合,$addVal加数的集合,$errKey 不进行相加的KEY,返回的结果是array 两数组的合并KEY和加数的VALUE
function recursionAdd($array, $addVal, $errKey)
{
    if ($array && $addVal) {
        $t = array_merge_recursive($array, $addVal);
        foreach ($t as $key => $val) {
            foreach ($val as $k => $v) {
                if (is_array($v)) {
                    if (!in_array($k, $errKey))
                        $newArr [$key] [$k] = array_sum($v);
                } else {
                    $newArr [$key] [$k] = $v;
                }
            }
        }
    } else {
        if ($array)
            $newArr = $array;
        elseif ($addVal)
            $newArr = $addVal;
    }
    return $newArr;
}

# 分页函数
function paginationAction($p, $sql, $page, $queryStr, $pagesize = 20, $allRet = null)
{
    $mypage = new Pagination (); //使用分页类
    $mypage->page = $page; //设置当前页
    $mypage->pagesize = $pagesize; //每页多少条记录
    $mypage->form_mothod = "get"; //get则第一个连字符是 &  POST则为 ?
    $pre = $p->prepare($sql);
    $pre->execute();
    if ($allRet == "all") {
        $aRet = SQL($p, $sql);
        $pageArr ['allRet'] = $aRet;
    }
    $mypage->count = $pre->rowCount(); //获取并设置数据库总记录数
    if ($pagesize != "all") {
        $sql .= $mypage->get_limit(); //分页条件查询
    }
    $res = $p->prepare($sql);
    $res->execute();
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $pageList = $mypage->page_list($_SERVER ['PHP_SELF'] . "?" . $queryStr);
    $pageArr ["ret"] = $ret;
    $pageArr ["pageList"] = $pageList;
    return $pageArr;
}

#解析地址栏编码
function Strip($value)
{
    if (get_magic_quotes_gpc() != 0) {
        if (is_array($value))
            if (array_is_associative($value)) {
                foreach ($value as $k => $v)
                    $tmp_val [$k] = stripslashes($v);
                $value = $tmp_val;
            } else
                for ($j = 0; $j < sizeof($value); $j++)
                    $value [$j] = stripslashes($value [$j]);
        else
            $value = stripslashes($value);
    }
    return $value;
}

function array_is_associative($array)
{
    if (is_array($array) && !empty ($array)) {
        for ($iterator = count($array) - 1; $iterator; $iterator--) {
            if (!array_key_exists($iterator, $array)) {
                return true;
            }
        }
        return !array_key_exists(0, $array);
    }
    return false;
}

#获取文件夹内文件内容
function getFileArr($dir, $typeAllowArr = "all")
{
    if (is_dir($dir)) {
        $dh = opendir($dir);
        if ($dh) {
            while (($file = readdir($dh)) !== false) {
                if (strcmp($file, '.') == 0 || strcmp($file, '..') == 0)
                    continue;
                $fileDir = $dir . $file;
                //换算成 KB
                $type = filetype($fileDir);
                if (is_array($typeAllowArr) && in_array($type, $typeAllowArr)) {
                    $size = round(filesize($fileDir) / 1000, 2);
                    $createTime = date("Y-m-d H:i:s", filectime($fileDir));
                    $modifyTime = date("Y-m-d H:i:s", filemtime($fileDir));
                    $fileArr [] = array(
                        "name" => $file,
                        "size" => $size,
                        "type" => $type,
                        "createTime" => $createTime,
                        "modifyTime" => $modifyTime
                    );
                } elseif ($typeAllowArr == "all") {
                    $size = round(filesize($fileDir) / 1000, 2);
                    $createTime = date("Y-m-d H:i:s", filectime($fileDir));
                    $modifyTime = date("Y-m-d H:i:s", filemtime($fileDir));
                    $fileArr [] = array(
                        "name" => $file,
                        "size" => $size,
                        "type" => $type,
                        "createTime" => $createTime,
                        "modifyTime" => $modifyTime
                    );
                }
            }
            closedir($dh);
        }
    } else {
        exit ("找不到文件夹名为: " . $dir);
    }
    return $fileArr;
}

#获取UUID
function UUID($prefix = '')
{
    $chars = md5(uniqid(mt_rand(), true));
    $uuid = substr($chars, 0, 8) . '-';
    $uuid .= substr($chars, 8, 4) . '-';
    $uuid .= substr($chars, 12, 4) . '-';
    $uuid .= substr($chars, 16, 4) . '-';
    $uuid .= substr($chars, 20, 12);
    return $prefix . $uuid;
}

#删除一个串里的一个值,返回删除后的串
/*
 * $str 是一个类似"1,2,3,4,5,6"这样的数组implode成的串
 * $val 是想要删除掉的一个数
 * 返回的结果就是删除掉$val后的串
 * 该函数在recruitManage/a_dailyRecruit.php中使用
 */
function delete_a_value($str, $val)
{
    $str_arr = explode(",", $str);
    foreach ($str_arr as $v) {
        if ($v == $val)
            continue;
        $new_str_arr [] = $v;
    }
    $new_str = implode(",", $new_str_arr);
    return $new_str;
}

#提取一个汉字或一个汉语词组的首字的拼音首字母（大写）
/*
 * 默认使用UTF-8输入字符集
 */
function uniord($str, $from_encoding = false)
{
    $from_encoding = $from_encoding ? $from_encoding : 'UTF-8';

    if (strlen($str) == 1)
        return ord($str);

    $str = mb_convert_encoding($str, 'UCS-4BE', $from_encoding);
    $tmp = unpack('N', $str);
    return $tmp [1];
}

function pinyinFirstLetter($str)
{
    $strChineseFirstPY = "YDYQSXMWZSSXJBYMGCCZQPSSQBYCDSCDQLDYLYBSSJGYZZJJFKCCLZDHWDWZJLJPFYYNWJJTMYHZWZHFLZPPQHGSCYYYNJQYXXGJHHSDSJNKKTMOMLCRXYPSNQSECCQZGGLLYJLMYZZSECYKYYHQWJSSGGYXYZYJWWKDJHYCHMYXJTLXJYQBYXZLDWRDJRWYSRLDZJPCBZJJBRCFTLECZSTZFXXZHTRQHYBDLYCZSSYMMRFMYQZPWWJJYFCRWFDFZQPYDDWYXKYJAWJFFXYPSFTZYHHYZYSWCJYXSCLCXXWZZXNBGNNXBXLZSZSBSGPYSYZDHMDZBQBZCWDZZYYTZHBTSYYBZGNTNXQYWQSKBPHHLXGYBFMJEBJHHGQTJCYSXSTKZHLYCKGLYSMZXYALMELDCCXGZYRJXSDLTYZCQKCNNJWHJTZZCQLJSTSTBNXBTYXCEQXGKWJYFLZQLYHYXSPSFXLMPBYSXXXYDJCZYLLLSJXFHJXPJBTFFYABYXBHZZBJYZLWLCZGGBTSSMDTJZXPTHYQTGLJSCQFZKJZJQNLZWLSLHDZBWJNCJZYZSQQYCQYRZCJJWYBRTWPYFTWEXCSKDZCTBZHYZZYYJXZCFFZZMJYXXSDZZOTTBZLQWFCKSZSXFYRLNYJMBDTHJXSQQCCSBXYYTSYFBXDZTGBCNSLCYZZPSAZYZZSCJCSHZQYDXLBPJLLMQXTYDZXSQJTZPXLCGLQTZWJBHCTSYJSFXYEJJTLBGXSXJMYJQQPFZASYJNTYDJXKJCDJSZCBARTDCLYJQMWNQNCLLLKBYBZZSYHQQLTWLCCXTXLLZNTYLNEWYZYXCZXXGRKRMTCNDNJTSYYSSDQDGHSDBJGHRWRQLYBGLXHLGTGXBQJDZPYJSJYJCTMRNYMGRZJCZGJMZMGXMPRYXKJNYMSGMZJYMKMFXMLDTGFBHCJHKYLPFMDXLQJJSMTQGZSJLQDLDGJYCALCMZCSDJLLNXDJFFFFJCZFMZFFPFKHKGDPSXKTACJDHHZDDCRRCFQYJKQCCWJDXHWJLYLLZGCFCQDSMLZPBJJPLSBCJGGDCKKDEZSQCCKJGCGKDJTJDLZYCXKLQSCGJCLTFPCQCZGWPJDQYZJJBYJHSJDZWGFSJGZKQCCZLLPSPKJGQJHZZLJPLGJGJJTHJJYJZCZMLZLYQBGJWMLJKXZDZNJQSYZMLJLLJKYWXMKJLHSKJGBMCLYYMKXJQLBMLLKMDXXKWYXYSLMLPSJQQJQXYXFJTJDXMXXLLCXQBSYJBGWYMBGGBCYXPJYGPEPFGDJGBHBNSQJYZJKJKHXQFGQZKFHYGKHDKLLSDJQXPQYKYBNQSXQNSZSWHBSXWHXWBZZXDMNSJBSBKBBZKLYLXGWXDRWYQZMYWSJQLCJXXJXKJEQXSCYETLZHLYYYSDZPAQYZCMTLSHTZCFYZYXYLJSDCJQAGYSLCQLYYYSHMRQQKLDXZSCSSSYDYCJYSFSJBFRSSZQSBXXPXJYSDRCKGJLGDKZJZBDKTCSYQPYHSTCLDJDHMXMCGXYZHJDDTMHLTXZXYLYMOHYJCLTYFBQQXPFBDFHHTKSQHZYYWCNXXCRWHOWGYJLEGWDQCWGFJYCSNTMYTOLBYGWQWESJPWNMLRYDZSZTXYQPZGCWXHNGPYXSHMYQJXZTDPPBFYHZHTJYFDZWKGKZBLDNTSXHQEEGZZYLZMMZYJZGXZXKHKSTXNXXWYLYAPSTHXDWHZYMPXAGKYDXBHNHXKDPJNMYHYLPMGOCSLNZHKXXLPZZLBMLSFBHHGYGYYGGBHSCYAQTYWLXTZQCEZYDQDQMMHTKLLSZHLSJZWFYHQSWSCWLQAZYNYTLSXTHAZNKZZSZZLAXXZWWCTGQQTDDYZTCCHYQZFLXPSLZYGPZSZNGLNDQTBDLXGTCTAJDKYWNSYZLJHHZZCWNYYZYWMHYCHHYXHJKZWSXHZYXLYSKQYSPSLYZWMYPPKBYGLKZHTYXAXQSYSHXASMCHKDSCRSWJPWXSGZJLWWSCHSJHSQNHCSEGNDAQTBAALZZMSSTDQJCJKTSCJAXPLGGXHHGXXZCXPDMMHLDGTYBYSJMXHMRCPXXJZCKZXSHMLQXXTTHXWZFKHCCZDYTCJYXQHLXDHYPJQXYLSYYDZOZJNYXQEZYSQYAYXWYPDGXDDXSPPYZNDLTWRHXYDXZZJHTCXMCZLHPYYYYMHZLLHNXMYLLLMDCPPXHMXDKYCYRDLTXJCHHZZXZLCCLYLNZSHZJZZLNNRLWHYQSNJHXYNTTTKYJPYCHHYEGKCTTWLGQRLGGTGTYGYHPYHYLQYQGCWYQKPYYYTTTTLHYHLLTYTTSPLKYZXGZWGPYDSSZZDQXSKCQNMJJZZBXYQMJRTFFBTKHZKBXLJJKDXJTLBWFZPPTKQTZTGPDGNTPJYFALQMKGXBDCLZFHZCLLLLADPMXDJHLCCLGYHDZFGYDDGCYYFGYDXKSSEBDHYKDKDKHNAXXYBPBYYHXZQGAFFQYJXDMLJCSQZLLPCHBSXGJYNDYBYQSPZWJLZKSDDTACTBXZDYZYPJZQSJNKKTKNJDJGYYPGTLFYQKASDNTCYHBLWDZHBBYDWJRYGKZYHEYYFJMSDTYFZJJHGCXPLXHLDWXXJKYTCYKSSSMTWCTTQZLPBSZDZWZXGZAGYKTYWXLHLSPBCLLOQMMZSSLCMBJCSZZKYDCZJGQQDSMCYTZQQLWZQZXSSFPTTFQMDDZDSHDTDWFHTDYZJYQJQKYPBDJYYXTLJHDRQXXXHAYDHRJLKLYTWHLLRLLRCXYLBWSRSZZSYMKZZHHKYHXKSMDSYDYCJPBZBSQLFCXXXNXKXWYWSDZYQOGGQMMYHCDZTTFJYYBGSTTTYBYKJDHKYXBELHTYPJQNFXFDYKZHQKZBYJTZBXHFDXKDASWTAWAJLDYJSFHBLDNNTNQJTJNCHXFJSRFWHZFMDRYJYJWZPDJKZYJYMPCYZNYNXFBYTFYFWYGDBNZZZDNYTXZEMMQBSQEHXFZMBMFLZZSRXYMJGSXWZJSPRYDJSJGXHJJGLJJYNZZJXHGXKYMLPYYYCXYTWQZSWHWLYRJLPXSLSXMFSWWKLCTNXNYNPSJSZHDZEPTXMYYWXYYSYWLXJQZQXZDCLEEELMCPJPCLWBXSQHFWWTFFJTNQJHJQDXHWLBYZNFJLALKYYJLDXHHYCSTYYWNRJYXYWTRMDRQHWQCMFJDYZMHMYYXJWMYZQZXTLMRSPWWCHAQBXYGZYPXYYRRCLMPYMGKSJSZYSRMYJSNXTPLNBAPPYPYLXYYZKYNLDZYJZCZNNLMZHHARQMPGWQTZMXXMLLHGDZXYHXKYXYCJMFFYYHJFSBSSQLXXNDYCANNMTCJCYPRRNYTYQNYYMBMSXNDLYLYSLJRLXYSXQMLLYZLZJJJKYZZCSFBZXXMSTBJGNXYZHLXNMCWSCYZYFZLXBRNNNYLBNRTGZQYSATSWRYHYJZMZDHZGZDWYBSSCSKXSYHYTXXGCQGXZZSHYXJSCRHMKKBXCZJYJYMKQHZJFNBHMQHYSNJNZYBKNQMCLGQHWLZNZSWXKHLJHYYBQLBFCDSXDLDSPFZPSKJYZWZXZDDXJSMMEGJSCSSMGCLXXKYYYLNYPWWWGYDKZJGGGZGGSYCKNJWNJPCXBJJTQTJWDSSPJXZXNZXUMELPXFSXTLLXCLJXJJLJZXCTPSWXLYDHLYQRWHSYCSQYYBYAYWJJJQFWQCQQCJQGXALDBZZYJGKGXPLTZYFXJLTPADKYQHPMATLCPDCKBMTXYBHKLENXDLEEGQDYMSAWHZMLJTWYGXLYQZLJEEYYBQQFFNLYXRDSCTGJGXYYNKLLYQKCCTLHJLQMKKZGCYYGLLLJDZGYDHZWXPYSJBZKDZGYZZHYWYFQYTYZSZYEZZLYMHJJHTSMQWYZLKYYWZCSRKQYTLTDXWCTYJKLWSQZWBDCQYNCJSRSZJLKCDCDTLZZZACQQZZDDXYPLXZBQJYLZLLLQDDZQJYJYJZYXNYYYNYJXKXDAZWYRDLJYYYRJLXLLDYXJCYWYWNQCCLDDNYYYNYCKCZHXXCCLGZQJGKWPPCQQJYSBZZXYJSQPXJPZBSBDSFNSFPZXHDWZTDWPPTFLZZBZDMYYPQJRSDZSQZSQXBDGCPZSWDWCSQZGMDHZXMWWFYBPDGPHTMJTHZSMMBGZMBZJCFZWFZBBZMQCFMBDMCJXLGPNJBBXGYHYYJGPTZGZMQBQTCGYXJXLWZKYDPDYMGCFTPFXYZTZXDZXTGKMTYBBCLBJASKYTSSQYYMSZXFJEWLXLLSZBQJJJAKLYLXLYCCTSXMCWFKKKBSXLLLLJYXTYLTJYYTDPJHNHNNKBYQNFQYYZBYYESSESSGDYHFHWTCJBSDZZTFDMXHCNJZYMQWSRYJDZJQPDQBBSTJGGFBKJBXTGQHNGWJXJGDLLTHZHHYYYYYYSXWTYYYCCBDBPYPZYCCZYJPZYWCBDLFWZCWJDXXHYHLHWZZXJTCZLCDPXUJCZZZLYXJJTXPHFXWPYWXZPTDZZBDZCYHJHMLXBQXSBYLRDTGJRRCTTTHYTCZWMXFYTWWZCWJWXJYWCSKYBZSCCTZQNHXNWXXKHKFHTSWOCCJYBCMPZZYKBNNZPBZHHZDLSYDDYTYFJPXYNGFXBYQXCBHXCPSXTYZDMKYSNXSXLHKMZXLYHDHKWHXXSSKQYHHCJYXGLHZXCSNHEKDTGZXQYPKDHEXTYKCNYMYYYPKQYYYKXZLTHJQTBYQHXBMYHSQCKWWYLLHCYYLNNEQXQWMCFBDCCMLJGGXDQKTLXKGNQCDGZJWYJJLYHHQTTTNWCHMXCXWHWSZJYDJCCDBQCDGDNYXZTHCQRXCBHZTQCBXWGQWYYBXHMBYMYQTYEXMQKYAQYRGYZSLFYKKQHYSSQYSHJGJCNXKZYCXSBXYXHYYLSTYCXQTHYSMGSCPMMGCCCCCMTZTASMGQZJHKLOSQYLSWTMXSYQKDZLJQQYPLSYCZTCQQPBBQJZCLPKHQZYYXXDTDDTSJCXFFLLCHQXMJLWCJCXTSPYCXNDTJSHJWXDQQJSKXYAMYLSJHMLALYKXCYYDMNMDQMXMCZNNCYBZKKYFLMCHCMLHXRCJJHSYLNMTJZGZGYWJXSRXCWJGJQHQZDQJDCJJZKJKGDZQGJJYJYLXZXXCDQHHHEYTMHLFSBDJSYYSHFYSTCZQLPBDRFRZTZYKYWHSZYQKWDQZRKMSYNBCRXQBJYFAZPZZEDZCJYWBCJWHYJBQSZYWRYSZPTDKZPFPBNZTKLQYHBBZPNPPTYZZYBQNYDCPJMMCYCQMCYFZZDCMNLFPBPLNGQJTBTTNJZPZBBZNJKLJQYLNBZQHKSJZNGGQSZZKYXSHPZSNBCGZKDDZQANZHJKDRTLZLSWJLJZLYWTJNDJZJHXYAYNCBGTZCSSQMNJPJYTYSWXZFKWJQTKHTZPLBHSNJZSYZBWZZZZLSYLSBJHDWWQPSLMMFBJDWAQYZTCJTBNNWZXQXCDSLQGDSDPDZHJTQQPSWLYYJZLGYXYZLCTCBJTKTYCZJTQKBSJLGMGZDMCSGPYNJZYQYYKNXRPWSZXMTNCSZZYXYBYHYZAXYWQCJTLLCKJJTJHGDXDXYQYZZBYWDLWQCGLZGJGQRQZCZSSBCRPCSKYDZNXJSQGXSSJMYDNSTZTPBDLTKZWXQWQTZEXNQCZGWEZKSSBYBRTSSSLCCGBPSZQSZLCCGLLLZXHZQTHCZMQGYZQZNMCOCSZJMMZSQPJYGQLJYJPPLDXRGZYXCCSXHSHGTZNLZWZKJCXTCFCJXLBMQBCZZWPQDNHXLJCTHYZLGYLNLSZZPCXDSCQQHJQKSXZPBAJYEMSMJTZDXLCJYRYYNWJBNGZZTMJXLTBSLYRZPYLSSCNXPHLLHYLLQQZQLXYMRSYCXZLMMCZLTZSDWTJJLLNZGGQXPFSKYGYGHBFZPDKMWGHCXMSGDXJMCJZDYCABXJDLNBCDQYGSKYDQTXDJJYXMSZQAZDZFSLQXYJSJZYLBTXXWXQQZBJZUFBBLYLWDSLJHXJYZJWTDJCZFQZQZZDZSXZZQLZCDZFJHYSPYMPQZMLPPLFFXJJNZZYLSJEYQZFPFZKSYWJJJHRDJZZXTXXGLGHYDXCSKYSWMMZCWYBAZBJKSHFHJCXMHFQHYXXYZFTSJYZFXYXPZLCHMZMBXHZZSXYFYMNCWDABAZLXKTCSHHXKXJJZJSTHYGXSXYYHHHJWXKZXSSBZZWHHHCWTZZZPJXSNXQQJGZYZYWLLCWXZFXXYXYHXMKYYSWSQMNLNAYCYSPMJKHWCQHYLAJJMZXHMMCNZHBHXCLXTJPLTXYJHDYYLTTXFSZHYXXSJBJYAYRSMXYPLCKDUYHLXRLNLLSTYZYYQYGYHHSCCSMZCTZQXKYQFPYYRPFFLKQUNTSZLLZMWWTCQQYZWTLLMLMPWMBZSSTZRBPDDTLQJJBXZCSRZQQYGWCSXFWZLXCCRSZDZMCYGGDZQSGTJSWLJMYMMZYHFBJDGYXCCPSHXNZCSBSJYJGJMPPWAFFYFNXHYZXZYLREMZGZCYZSSZDLLJCSQFNXZKPTXZGXJJGFMYYYSNBTYLBNLHPFZDCYFBMGQRRSSSZXYSGTZRNYDZZCDGPJAFJFZKNZBLCZSZPSGCYCJSZLMLRSZBZZLDLSLLYSXSQZQLYXZLSKKBRXBRBZCYCXZZZEEYFGKLZLYYHGZSGZLFJHGTGWKRAAJYZKZQTSSHJJXDCYZUYJLZYRZDQQHGJZXSSZBYKJPBFRTJXLLFQWJHYLQTYMBLPZDXTZYGBDHZZRBGXHWNJTJXLKSCFSMWLSDQYSJTXKZSCFWJLBXFTZLLJZLLQBLSQMQQCGCZFPBPHZCZJLPYYGGDTGWDCFCZQYYYQYSSCLXZSKLZZZGFFCQNWGLHQYZJJCZLQZZYJPJZZBPDCCMHJGXDQDGDLZQMFGPSYTSDYFWWDJZJYSXYYCZCYHZWPBYKXRYLYBHKJKSFXTZJMMCKHLLTNYYMSYXYZPYJQYCSYCWMTJJKQYRHLLQXPSGTLYYCLJSCPXJYZFNMLRGJJTYZBXYZMSJYJHHFZQMSYXRSZCWTLRTQZSSTKXGQKGSPTGCZNJSJCQCXHMXGGZTQYDJKZDLBZSXJLHYQGGGTHQSZPYHJHHGYYGKGGCWJZZYLCZLXQSFTGZSLLLMLJSKCTBLLZZSZMMNYTPZSXQHJCJYQXYZXZQZCPSHKZZYSXCDFGMWQRLLQXRFZTLYSTCTMJCXJJXHJNXTNRZTZFQYHQGLLGCXSZSJDJLJCYDSJTLNYXHSZXCGJZYQPYLFHDJSBPCCZHJJJQZJQDYBSSLLCMYTTMQTBHJQNNYGKYRQYQMZGCJKPDCGMYZHQLLSLLCLMHOLZGDYYFZSLJCQZLYLZQJESHNYLLJXGJXLYSYYYXNBZLJSSZCQQCJYLLZLTJYLLZLLBNYLGQCHXYYXOXCXQKYJXXXYKLXSXXYQXCYKQXQCSGYXXYQXYGYTQOHXHXPYXXXULCYEYCHZZCBWQBBWJQZSCSZSSLZYLKDESJZWMYMCYTSDSXXSCJPQQSQYLYYZYCMDJDZYWCBTJSYDJKCYDDJLBDJJSODZYSYXQQYXDHHGQQYQHDYXWGMMMAJDYBBBPPBCMUUPLJZSMTXERXJMHQNUTPJDCBSSMSSSTKJTSSMMTRCPLZSZMLQDSDMJMQPNQDXCFYNBFSDQXYXHYAYKQYDDLQYYYSSZBYDSLNTFQTZQPZMCHDHCZCWFDXTMYQSPHQYYXSRGJCWTJTZZQMGWJJTJHTQJBBHWZPXXHYQFXXQYWYYHYSCDYDHHQMNMTMWCPBSZPPZZGLMZFOLLCFWHMMSJZTTDHZZYFFYTZZGZYSKYJXQYJZQBHMBZZLYGHGFMSHPZFZSNCLPBQSNJXZSLXXFPMTYJYGBXLLDLXPZJYZJYHHZCYWHJYLSJEXFSZZYWXKZJLUYDTMLYMQJPWXYHXSKTQJEZRPXXZHHMHWQPWQLYJJQJJZSZCPHJLCHHNXJLQWZJHBMZYXBDHHYPZLHLHLGFWLCHYYTLHJXCJMSCPXSTKPNHQXSRTYXXTESYJCTLSSLSTDLLLWWYHDHRJZSFGXTSYCZYNYHTDHWJSLHTZDQDJZXXQHGYLTZPHCSQFCLNJTCLZPFSTPDYNYLGMJLLYCQHYSSHCHYLHQYQTMZYPBYWRFQYKQSYSLZDQJMPXYYSSRHZJNYWTQDFZBWWTWWRXCWHGYHXMKMYYYQMSMZHNGCEPMLQQMTCWCTMMPXJPJJHFXYYZSXZHTYBMSTSYJTTQQQYYLHYNPYQZLCYZHZWSMYLKFJXLWGXYPJYTYSYXYMZCKTTWLKSMZSYLMPWLZWXWQZSSAQSYXYRHSSNTSRAPXCPWCMGDXHXZDZYFJHGZTTSBJHGYZSZYSMYCLLLXBTYXHBBZJKSSDMALXHYCFYGMQYPJYCQXJLLLJGSLZGQLYCJCCZOTYXMTMTTLLWTGPXYMZMKLPSZZZXHKQYSXCTYJZYHXSHYXZKXLZWPSQPYHJWPJPWXQQYLXSDHMRSLZZYZWTTCYXYSZZSHBSCCSTPLWSSCJCHNLCGCHSSPHYLHFHHXJSXYLLNYLSZDHZXYLSXLWZYKCLDYAXZCMDDYSPJTQJZLNWQPSSSWCTSTSZLBLNXSMNYYMJQBQHRZWTYYDCHQLXKPZWBGQYBKFCMZWPZLLYYLSZYDWHXPSBCMLJBSCGBHXLQHYRLJXYSWXWXZSLDFHLSLYNJLZYFLYJYCDRJLFSYZFSLLCQYQFGJYHYXZLYLMSTDJCYHBZLLNWLXXYGYYHSMGDHXXHHLZZJZXCZZZCYQZFNGWPYLCPKPYYPMCLQKDGXZGGWQBDXZZKZFBXXLZXJTPJPTTBYTSZZDWSLCHZHSLTYXHQLHYXXXYYZYSWTXZKHLXZXZPYHGCHKCFSYHUTJRLXFJXPTZTWHPLYXFCRHXSHXKYXXYHZQDXQWULHYHMJTBFLKHTXCWHJFWJCFPQRYQXCYYYQYGRPYWSGSUNGWCHKZDXYFLXXHJJBYZWTSXXNCYJJYMSWZJQRMHXZWFQSYLZJZGBHYNSLBGTTCSYBYXXWXYHXYYXNSQYXMQYWRGYQLXBBZLJSYLPSYTJZYHYZAWLRORJMKSCZJXXXYXCHDYXRYXXJDTSQFXLYLTSFFYXLMTYJMJUYYYXLTZCSXQZQHZXLYYXZHDNBRXXXJCTYHLBRLMBRLLAXKYLLLJLYXXLYCRYLCJTGJCMTLZLLCYZZPZPCYAWHJJFYBDYYZSMPCKZDQYQPBPCJPDCYZMDPBCYYDYCNNPLMTMLRMFMMGWYZBSJGYGSMZQQQZTXMKQWGXLLPJGZBQCDJJJFPKJKCXBLJMSWMDTQJXLDLPPBXCWRCQFBFQJCZAHZGMYKPHYYHZYKNDKZMBPJYXPXYHLFPNYYGXJDBKXNXHJMZJXSTRSTLDXSKZYSYBZXJLXYSLBZYSLHXJPFXPQNBYLLJQKYGZMCYZZYMCCSLCLHZFWFWYXZMWSXTYNXJHPYYMCYSPMHYSMYDYSHQYZCHMJJMZCAAGCFJBBHPLYZYLXXSDJGXDHKXXTXXNBHRMLYJSLTXMRHNLXQJXYZLLYSWQGDLBJHDCGJYQYCMHWFMJYBMBYJYJWYMDPWHXQLDYGPDFXXBCGJSPCKRSSYZJMSLBZZJFLJJJLGXZGYXYXLSZQYXBEXYXHGCXBPLDYHWETTWWCJMBTXCHXYQXLLXFLYXLLJLSSFWDPZSMYJCLMWYTCZPCHQEKCQBWLCQYDPLQPPQZQFJQDJHYMMCXTXDRMJWRHXCJZYLQXDYYNHYYHRSLSRSYWWZJYMTLTLLGTQCJZYABTCKZCJYCCQLJZQXALMZYHYWLWDXZXQDLLQSHGPJFJLJHJABCQZDJGTKHSSTCYJLPSWZLXZXRWGLDLZRLZXTGSLLLLZLYXXWGDZYGBDPHZPBRLWSXQBPFDWOFMWHLYPCBJCCLDMBZPBZZLCYQXLDOMZBLZWPDWYYGDSTTHCSQSCCRSSSYSLFYBFNTYJSZDFNDPDHDZZMBBLSLCMYFFGTJJQWFTMTPJWFNLBZCMMJTGBDZLQLPYFHYYMJYLSDCHDZJWJCCTLJCLDTLJJCPDDSQDSSZYBNDBJLGGJZXSXNLYCYBJXQYCBYLZCFZPPGKCXZDZFZTJJFJSJXZBNZYJQTTYJYHTYCZHYMDJXTTMPXSPLZCDWSLSHXYPZGTFMLCJTYCBPMGDKWYCYZCDSZZYHFLYCTYGWHKJYYLSJCXGYWJCBLLCSNDDBTZBSCLYZCZZSSQDLLMQYYHFSLQLLXFTYHABXGWNYWYYPLLSDLDLLBJCYXJZMLHLJDXYYQYTDLLLBUGBFDFBBQJZZMDPJHGCLGMJJPGAEHHBWCQXAXHHHZCHXYPHJAXHLPHJPGPZJQCQZGJJZZUZDMQYYBZZPHYHYBWHAZYJHYKFGDPFQSDLZMLJXKXGALXZDAGLMDGXMWZQYXXDXXPFDMMSSYMPFMDMMKXKSYZYSHDZKXSYSMMZZZMSYDNZZCZXFPLSTMZDNMXCKJMZTYYMZMZZMSXHHDCZJEMXXKLJSTLWLSQLYJZLLZJSSDPPMHNLZJCZYHMXXHGZCJMDHXTKGRMXFWMCGMWKDTKSXQMMMFZZYDKMSCLCMPCGMHSPXQPZDSSLCXKYXTWLWJYAHZJGZQMCSNXYYMMPMLKJXMHLMLQMXCTKZMJQYSZJSYSZHSYJZJCDAJZYBSDQJZGWZQQXFKDMSDJLFWEHKZQKJPEYPZYSZCDWYJFFMZZYLTTDZZEFMZLBNPPLPLPEPSZALLTYLKCKQZKGENQLWAGYXYDPXLHSXQQWQCQXQCLHYXXMLYCCWLYMQYSKGCHLCJNSZKPYZKCQZQLJPDMDZHLASXLBYDWQLWDNBQCRYDDZTJYBKBWSZDXDTNPJDTCTQDFXQQMGNXECLTTBKPWSLCTYQLPWYZZKLPYGZCQQPLLKCCYLPQMZCZQCLJSLQZDJXLDDHPZQDLJJXZQDXYZQKZLJCYQDYJPPYPQYKJYRMPCBYMCXKLLZLLFQPYLLLMBSGLCYSSLRSYSQTMXYXZQZFDZUYSYZTFFMZZSMZQHZSSCCMLYXWTPZGXZJGZGSJSGKDDHTQGGZLLBJDZLCBCHYXYZHZFYWXYZYMSDBZZYJGTSMTFXQYXQSTDGSLNXDLRYZZLRYYLXQHTXSRTZNGZXBNQQZFMYKMZJBZYMKBPNLYZPBLMCNQYZZZSJZHJCTZKHYZZJRDYZHNPXGLFZTLKGJTCTSSYLLGZRZBBQZZKLPKLCZYSSUYXBJFPNJZZXCDWXZYJXZZDJJKGGRSRJKMSMZJLSJYWQSKYHQJSXPJZZZLSNSHRNYPZTWCHKLPSRZLZXYJQXQKYSJYCZTLQZYBBYBWZPQDWWYZCYTJCJXCKCWDKKZXSGKDZXWWYYJQYYTCYTDLLXWKCZKKLCCLZCQQDZLQLCSFQCHQHSFSMQZZLNBJJZBSJHTSZDYSJQJPDLZCDCWJKJZZLPYCGMZWDJJBSJQZSYZYHHXJPBJYDSSXDZNCGLQMBTSFSBPDZDLZNFGFJGFSMPXJQLMBLGQCYYXBQKDJJQYRFKZTJDHCZKLBSDZCFJTPLLJGXHYXZCSSZZXSTJYGKGCKGYOQXJPLZPBPGTGYJZGHZQZZLBJLSQFZGKQQJZGYCZBZQTLDXRJXBSXXPZXHYZYCLWDXJJHXMFDZPFZHQHQMQGKSLYHTYCGFRZGNQXCLPDLBZCSCZQLLJBLHBZCYPZZPPDYMZZSGYHCKCPZJGSLJLNSCDSLDLXBMSTLDDFJMKDJDHZLZXLSZQPQPGJLLYBDSZGQLBZLSLKYYHZTTNTJYQTZZPSZQZTLLJTYYLLQLLQYZQLBDZLSLYYZYMDFSZSNHLXZNCZQZPBWSKRFBSYZMTHBLGJPMCZZLSTLXSHTCSYZLZBLFEQHLXFLCJLYLJQCBZLZJHHSSTBRMHXZHJZCLXFNBGXGTQJCZTMSFZKJMSSNXLJKBHSJXNTNLZDNTLMSJXGZJYJCZXYJYJWRWWQNZTNFJSZPZSHZJFYRDJSFSZJZBJFZQZZHZLXFYSBZQLZSGYFTZDCSZXZJBQMSZKJRHYJZCKMJKHCHGTXKXQGLXPXFXTRTYLXJXHDTSJXHJZJXZWZLCQSBTXWXGXTXXHXFTSDKFJHZYJFJXRZSDLLLTQSQQZQWZXSYQTWGWBZCGZLLYZBCLMQQTZHZXZXLJFRMYZFLXYSQXXJKXRMQDZDMMYYBSQBHGZMWFWXGMXLZPYYTGZYCCDXYZXYWGSYJYZNBHPZJSQSYXSXRTFYZGRHZTXSZZTHCBFCLSYXZLZQMZLMPLMXZJXSFLBYZMYQHXJSXRXSQZZZSSLYFRCZJRCRXHHZXQYDYHXSJJHZCXZBTYNSYSXJBQLPXZQPYMLXZKYXLXCJLCYSXXZZLXDLLLJJYHZXGYJWKJRWYHCPSGNRZLFZWFZZNSXGXFLZSXZZZBFCSYJDBRJKRDHHGXJLJJTGXJXXSTJTJXLYXQFCSGSWMSBCTLQZZWLZZKXJMLTMJYHSDDBXGZHDLBMYJFRZFSGCLYJBPMLYSMSXLSZJQQHJZFXGFQFQBPXZGYYQXGZTCQWYLTLGWSGWHRLFSFGZJMGMGBGTJFSYZZGZYZAFLSSPMLPFLCWBJZCLJJMZLPJJLYMQDMYYYFBGYGYZMLYZDXQYXRQQQHSYYYQXYLJTYXFSFSLLGNQCYHYCWFHCCCFXPYLYPLLZYXXXXXKQHHXSHJZCFZSCZJXCPZWHHHHHAPYLQALPQAFYHXDYLUKMZQGGGDDESRNNZLTZGCHYPPYSQJJHCLLJTOLNJPZLJLHYMHEYDYDSQYCDDHGZUNDZCLZYZLLZNTNYZGSLHSLPJJBDGWXPCDUTJCKLKCLWKLLCASSTKZZDNQNTTLYYZSSYSSZZRYLJQKCQDHHCRXRZYDGRGCWCGZQFFFPPJFZYNAKRGYWYQPQXXFKJTSZZXSWZDDFBBXTBGTZKZNPZZPZXZPJSZBMQHKCYXYLDKLJNYPKYGHGDZJXXEAHPNZKZTZCMXCXMMJXNKSZQNMNLWBWWXJKYHCPSTMCSQTZJYXTPCTPDTNNPGLLLZSJLSPBLPLQHDTNJNLYYRSZFFJFQWDPHZDWMRZCCLODAXNSSNYZRESTYJWJYJDBCFXNMWTTBYLWSTSZGYBLJPXGLBOCLHPCBJLTMXZLJYLZXCLTPNCLCKXTPZJSWCYXSFYSZDKNTLBYJCYJLLSTGQCBXRYZXBXKLYLHZLQZLNZCXWJZLJZJNCJHXMNZZGJZZXTZJXYCYYCXXJYYXJJXSSSJSTSSTTPPGQTCSXWZDCSYFPTFBFHFBBLZJCLZZDBXGCXLQPXKFZFLSYLTUWBMQJHSZBMDDBCYSCCLDXYCDDQLYJJWMQLLCSGLJJSYFPYYCCYLTJANTJJPWYCMMGQYYSXDXQMZHSZXPFTWWZQSWQRFKJLZJQQYFBRXJHHFWJJZYQAZMYFRHCYYBYQWLPEXCCZSTYRLTTDMQLYKMBBGMYYJPRKZNPBSXYXBHYZDJDNGHPMFSGMWFZMFQMMBCMZZCJJLCNUXYQLMLRYGQZCYXZLWJGCJCGGMCJNFYZZJHYCPRRCMTZQZXHFQGTJXCCJEAQCRJYHPLQLSZDJRBCQHQDYRHYLYXJSYMHZYDWLDFRYHBPYDTSSCNWBXGLPZMLZZTQSSCPJMXXYCSJYTYCGHYCJWYRXXLFEMWJNMKLLSWTXHYYYNCMMCWJDQDJZGLLJWJRKHPZGGFLCCSCZMCBLTBHBQJXQDSPDJZZGKGLFQYWBZYZJLTSTDHQHCTCBCHFLQMPWDSHYYTQWCNZZJTLBYMBPDYYYXSQKXWYYFLXXNCWCXYPMAELYKKJMZZZBRXYYQJFLJPFHHHYTZZXSGQQMHSPGDZQWBWPJHZJDYSCQWZKTXXSQLZYYMYSDZGRXCKKUJLWPYSYSCSYZLRMLQSYLJXBCXTLWDQZPCYCYKPPPNSXFYZJJRCEMHSZMSXLXGLRWGCSTLRSXBZGBZGZTCPLUJLSLYLYMTXMTZPALZXPXJTJWTCYYZLBLXBZLQMYLXPGHDSLSSDMXMBDZZSXWHAMLCZCPJMCNHJYSNSYGCHSKQMZZQDLLKABLWJXSFMOCDXJRRLYQZKJMYBYQLYHETFJZFRFKSRYXFJTWDSXXSYSQJYSLYXWJHSNLXYYXHBHAWHHJZXWMYLJCSSLKYDZTXBZSYFDXGXZJKHSXXYBSSXDPYNZWRPTQZCZENYGCXQFJYKJBZMLJCMQQXUOXSLYXXLYLLJDZBTYMHPFSTTQQWLHOKYBLZZALZXQLHZWRRQHLSTMYPYXJJXMQSJFNBXYXYJXXYQYLTHYLQYFMLKLJTMLLHSZWKZHLJMLHLJKLJSTLQXYLMBHHLNLZXQJHXCFXXLHYHJJGBYZZKBXSCQDJQDSUJZYYHZHHMGSXCSYMXFEBCQWWRBPYYJQTYZCYQYQQZYHMWFFHGZFRJFCDPXNTQYZPDYKHJLFRZXPPXZDBBGZQSTLGDGYLCQMLCHHMFYWLZYXKJLYPQHSYWMQQGQZMLZJNSQXJQSYJYCBEHSXFSZPXZWFLLBCYYJDYTDTHWZSFJMQQYJLMQXXLLDTTKHHYBFPWTYYSQQWNQWLGWDEBZWCMYGCULKJXTMXMYJSXHYBRWFYMWFRXYQMXYSZTZZTFYKMLDHQDXWYYNLCRYJBLPSXCXYWLSPRRJWXHQYPHTYDNXHHMMYWYTZCSQMTSSCCDALWZTCPQPYJLLQZYJSWXMZZMMYLMXCLMXCZMXMZSQTZPPQQBLPGXQZHFLJJHYTJSRXWZXSCCDLXTYJDCQJXSLQYCLZXLZZXMXQRJMHRHZJBHMFLJLMLCLQNLDXZLLLPYPSYJYSXCQQDCMQJZZXHNPNXZMEKMXHYKYQLXSXTXJYYHWDCWDZHQYYBGYBCYSCFGPSJNZDYZZJZXRZRQJJYMCANYRJTLDPPYZBSTJKXXZYPFDWFGZZRPYMTNGXZQBYXNBUFNQKRJQZMJEGRZGYCLKXZDSKKNSXKCLJSPJYYZLQQJYBZSSQLLLKJXTBKTYLCCDDBLSPPFYLGYDTZJYQGGKQTTFZXBDKTYYHYBBFYTYYBCLPDYTGDHRYRNJSPTCSNYJQHKLLLZSLYDXXWBCJQSPXBPJZJCJDZFFXXBRMLAZHCSNDLBJDSZBLPRZTSWSBXBCLLXXLZDJZSJPYLYXXYFTFFFBHJJXGBYXJPMMMPSSJZJMTLYZJXSWXTYLEDQPJMYGQZJGDJLQJWJQLLSJGJGYGMSCLJJXDTYGJQJQJCJZCJGDZZSXQGSJGGCXHQXSNQLZZBXHSGZXCXYLJXYXYYDFQQJHJFXDHCTXJYRXYSQTJXYEFYYSSYYJXNCYZXFXMSYSZXYYSCHSHXZZZGZZZGFJDLTYLNPZGYJYZYYQZPBXQBDZTZCZYXXYHHSQXSHDHGQHJHGYWSZTMZMLHYXGEBTYLZKQWYTJZRCLEKYSTDBCYKQQSAYXCJXWWGSBHJYZYDHCSJKQCXSWXFLTYNYZPZCCZJQTZWJQDZZZQZLJJXLSBHPYXXPSXSHHEZTXFPTLQYZZXHYTXNCFZYYHXGNXMYWXTZSJPTHHGYMXMXQZXTSBCZYJYXXTYYZYPCQLMMSZMJZZLLZXGXZAAJZYXJMZXWDXZSXZDZXLEYJJZQBHZWZZZQTZPSXZTDSXJJJZNYAZPHXYYSRNQDTHZHYYKYJHDZXZLSWCLYBZYECWCYCRYLCXNHZYDZYDYJDFRJJHTRSQTXYXJRJHOJYNXELXSFSFJZGHPZSXZSZDZCQZBYYKLSGSJHCZSHDGQGXYZGXCHXZJWYQWGYHKSSEQZZNDZFKWYSSTCLZSTSYMCDHJXXYWEYXCZAYDMPXMDSXYBSQMJMZJMTZQLPJYQZCGQHXJHHLXXHLHDLDJQCLDWBSXFZZYYSCHTYTYYBHECXHYKGJPXHHYZJFXHWHBDZFYZBCAPNPGNYDMSXHMMMMAMYNBYJTMPXYYMCTHJBZYFCGTYHWPHFTWZZEZSBZEGPFMTSKFTYCMHFLLHGPZJXZJGZJYXZSBBQSCZZLZCCSTPGXMJSFTCCZJZDJXCYBZLFCJSYZFGSZLYBCWZZBYZDZYPSWYJZXZBDSYUXLZZBZFYGCZXBZHZFTPBGZGEJBSTGKDMFHYZZJHZLLZZGJQZLSFDJSSCBZGPDLFZFZSZYZYZSYGCXSNXXCHCZXTZZLJFZGQSQYXZJQDCCZTQCDXZJYQJQCHXZTDLGSCXZSYQJQTZWLQDQZTQCHQQJZYEZZZPBWKDJFCJPZTYPQYQTTYNLMBDKTJZPQZQZZFPZSBNJLGYJDXJDZZKZGQKXDLPZJTCJDQBXDJQJSTCKNXBXZMSLYJCQMTJQWWCJQNJNLLLHJCWQTBZQYDZCZPZZDZYDDCYZZZCCJTTJFZDPRRTZTJDCQTQZDTJNPLZBCLLCTZSXKJZQZPZLBZRBTJDCXFCZDBCCJJLTQQPLDCGZDBBZJCQDCJWYNLLZYZCCDWLLXWZLXRXNTQQCZXKQLSGDFQTDDGLRLAJJTKUYMKQLLTZYTDYYCZGJWYXDXFRSKSTQTENQMRKQZHHQKDLDAZFKYPBGGPZREBZZYKZZSPEGJXGYKQZZZSLYSYYYZWFQZYLZZLZHWCHKYPQGNPGBLPLRRJYXCCSYYHSFZFYBZYYTGZXYLXCZWXXZJZBLFFLGSKHYJZEYJHLPLLLLCZGXDRZELRHGKLZZYHZLYQSZZJZQLJZFLNBHGWLCZCFJYSPYXZLZLXGCCPZBLLCYBBBBUBBCBPCRNNZCZYRBFSRLDCGQYYQXYGMQZWTZYTYJXYFWTEHZZJYWLCCNTZYJJZDEDPZDZTSYQJHDYMBJNYJZLXTSSTPHNDJXXBYXQTZQDDTJTDYYTGWSCSZQFLSHLGLBCZPHDLYZJYCKWTYTYLBNYTSDSYCCTYSZYYEBHEXHQDTWNYGYCLXTSZYSTQMYGZAZCCSZZDSLZCLZRQXYYELJSBYMXSXZTEMBBLLYYLLYTDQYSHYMRQWKFKBFXNXSBYCHXBWJYHTQBPBSBWDZYLKGZSKYHXQZJXHXJXGNLJKZLYYCDXLFYFGHLJGJYBXQLYBXQPQGZTZPLNCYPXDJYQYDYMRBESJYYHKXXSTMXRCZZYWXYQYBMCLLYZHQYZWQXDBXBZWZMSLPDMYSKFMZKLZCYQYCZLQXFZZYDQZPZYGYJYZMZXDZFYFYTTQTZHGSPCZMLCCYTZXJCYTJMKSLPZHYSNZLLYTPZCTZZCKTXDHXXTQCYFKSMQCCYYAZHTJPCYLZLYJBJXTPNYLJYYNRXSYLMMNXJSMYBCSYSYLZYLXJJQYLDZLPQBFZZBLFNDXQKCZFYWHGQMRDSXYCYTXNQQJZYYPFZXDYZFPRXEJDGYQBXRCNFYYQPGHYJDYZXGRHTKYLNWDZNTSMPKLBTHBPYSZBZTJZSZZJTYYXZPHSSZZBZCZPTQFZMYFLYPYBBJQXZMXXDJMTSYSKKBJZXHJCKLPSMKYJZCXTMLJYXRZZQSLXXQPYZXMKYXXXJCLJPRMYYGADYSKQLSNDHYZKQXZYZTCGHZTLMLWZYBWSYCTBHJHJFCWZTXWYTKZLXQSHLYJZJXTMPLPYCGLTBZZTLZJCYJGDTCLKLPLLQPJMZPAPXYZLKKTKDZCZZBNZDYDYQZJYJGMCTXLTGXSZLMLHBGLKFWNWZHDXUHLFMKYSLGXDTWWFRJEJZTZHYDXYKSHWFZCQSHKTMQQHTZHYMJDJSKHXZJZBZZXYMPAGQMSTPXLSKLZYNWRTSQLSZBPSPSGZWYHTLKSSSWHZZLYYTNXJGMJSZSUFWNLSOZTXGXLSAMMLBWLDSZYLAKQCQCTMYCFJBSLXCLZZCLXXKSBZQCLHJPSQPLSXXCKSLNHPSFQQYTXYJZLQLDXZQJZDYYDJNZPTUZDSKJFSLJHYLZSQZLBTXYDGTQFDBYAZXDZHZJNHHQBYKNXJJQCZMLLJZKSPLDYCLBBLXKLELXJLBQYCXJXGCNLCQPLZLZYJTZLJGYZDZPLTQCSXFDMNYCXGBTJDCZNBGBQYQJWGKFHTNPYQZQGBKPBBYZMTJDYTBLSQMPSXTBNPDXKLEMYYCJYNZCTLDYKZZXDDXHQSHDGMZSJYCCTAYRZLPYLTLKXSLZCGGEXCLFXLKJRTLQJAQZNCMBYDKKCXGLCZJZXJHPTDJJMZQYKQSECQZDSHHADMLZFMMZBGNTJNNLGBYJBRBTMLBYJDZXLCJLPLDLPCQDHLXZLYCBLCXZZJADJLNZMMSSSMYBHBSQKBHRSXXJMXSDZNZPXLGBRHWGGFCXGMSKLLTSJYYCQLTSKYWYYHYWXBXQYWPYWYKQLSQPTNTKHQCWDQKTWPXXHCPTHTWUMSSYHBWCRWXHJMKMZNGWTMLKFGHKJYLSYYCXWHYECLQHKQHTTQKHFZLDXQWYZYYDESBPKYRZPJFYYZJCEQDZZDLATZBBFJLLCXDLMJSSXEGYGSJQXCWBXSSZPDYZCXDNYXPPZYDLYJCZPLTXLSXYZYRXCYYYDYLWWNZSAHJSYQYHGYWWAXTJZDAXYSRLTDPSSYYFNEJDXYZHLXLLLZQZSJNYQYQQXYJGHZGZCYJCHZLYCDSHWSHJZYJXCLLNXZJJYYXNFXMWFPYLCYLLABWDDHWDXJMCXZTZPMLQZHSFHZYNZTLLDYWLSLXHYMMYLMBWWKYXYADTXYLLDJPYBPWUXJMWMLLSAFDLLYFLBHHHBQQLTZJCQJLDJTFFKMMMBYTHYGDCQRDDWRQJXNBYSNWZDBYYTBJHPYBYTTJXAAHGQDQTMYSTQXKBTZPKJLZRBEQQSSMJJBDJOTGTBXPGBKTLHQXJJJCTHXQDWJLWRFWQGWSHCKRYSWGFTGYGBXSDWDWRFHWYTJJXXXJYZYSLPYYYPAYXHYDQKXSHXYXGSKQHYWFDDDPPLCJLQQEEWXKSYYKDYPLTJTHKJLTCYYHHJTTPLTZZCDLTHQKZXQYSTEEYWYYZYXXYYSTTJKLLPZMCYHQGXYHSRMBXPLLNQYDQHXSXXWGDQBSHYLLPJJJTHYJKYPPTHYYKTYEZYENMDSHLCRPQFDGFXZPSFTLJXXJBSWYYSKSFLXLPPLBBBLBSFXFYZBSJSSYLPBBFFFFSSCJDSTZSXZRYYSYFFSYZYZBJTBCTSBSDHRTJJBYTCXYJEYLXCBNEBJDSYXYKGSJZBXBYTFZWGENYHHTHZHHXFWGCSTBGXKLSXYWMTMBYXJSTZSCDYQRCYTWXZFHMYMCXLZNSDJTTTXRYCFYJSBSDYERXJLJXBBDEYNJGHXGCKGSCYMBLXJMSZNSKGXFBNBPTHFJAAFXYXFPXMYPQDTZCXZZPXRSYWZDLYBBKTYQPQJPZYPZJZNJPZJLZZFYSBTTSLMPTZRTDXQSJEHBZYLZDHLJSQMLHTXTJECXSLZZSPKTLZKQQYFSYGYWPCPQFHQHYTQXZKRSGTTSQCZLPTXCDYYZXSQZSLXLZMYCPCQBZYXHBSXLZDLTCDXTYLZJYYZPZYZLTXJSJXHLPMYTXCQRBLZSSFJZZTNJYTXMYJHLHPPLCYXQJQQKZZSCPZKSWALQSBLCCZJSXGWWWYGYKTJBBZTDKHXHKGTGPBKQYSLPXPJCKBMLLXDZSTBKLGGQKQLSBKKTFXRMDKBFTPZFRTBBRFERQGXYJPZSSTLBZTPSZQZSJDHLJQLZBPMSMMSXLQQNHKNBLRDDNXXDHDDJCYYGYLXGZLXSYGMQQGKHBPMXYXLYTQWLWGCPBMQXCYZYDRJBHTDJYHQSHTMJSBYPLWHLZFFNYPMHXXHPLTBQPFBJWQDBYGPNZTPFZJGSDDTQSHZEAWZZYLLTYYBWJKXXGHLFKXDJTMSZSQYNZGGSWQSPHTLSSKMCLZXYSZQZXNCJDQGZDLFNYKLJCJLLZLMZZNHYDSSHTHZZLZZBBHQZWWYCRZHLYQQJBEYFXXXWHSRXWQHWPSLMSSKZTTYGYQQWRSLALHMJTQJSMXQBJJZJXZYZKXBYQXBJXSHZTSFJLXMXZXFGHKZSZGGYLCLSARJYHSLLLMZXELGLXYDJYTLFBHBPNLYZFBBHPTGJKWETZHKJJXZXXGLLJLSTGSHJJYQLQZFKCGNNDJSSZFDBCTWWSEQFHQJBSAQTGYPQLBXBMMYWXGSLZHGLZGQYFLZBYFZJFRYSFMBYZHQGFWZSYFYJJPHZBYYZFFWODGRLMFTWLBZGYCQXCDJYGZYYYYTYTYDWEGAZYHXJLZYYHLRMGRXXZCLHNELJJTJTPWJYBJJBXJJTJTEEKHWSLJPLPSFYZPQQBDLQJJTYYQLYZKDKSQJYYQZLDQTGJQYZJSUCMRYQTHTEJMFCTYHYPKMHYZWJDQFHYYXWSHCTXRLJHQXHCCYYYJLTKTTYTMXGTCJTZAYYOCZLYLBSZYWJYTSJYHBYSHFJLYGJXXTMZYYLTXXYPZLXYJZYZYYPNHMYMDYYLBLHLSYYQQLLNJJYMSOYQBZGDLYXYLCQYXTSZEGXHZGLHWBLJHEYXTWQMAKBPQCGYSHHEGQCMWYYWLJYJHYYZLLJJYLHZYHMGSLJLJXCJJYCLYCJPCPZJZJMMYLCQLNQLJQJSXYJMLSZLJQLYCMMHCFMMFPQQMFYLQMCFFQMMMMHMZNFHHJGTTHHKHSLNCHHYQDXTMMQDCYZYXYQMYQYLTDCYYYZAZZCYMZYDLZFFFMMYCQZWZZMABTBYZTDMNZZGGDFTYPCGQYTTSSFFWFDTZQSSYSTWXJHXYTSXXYLBYQHWWKXHZXWZNNZZJZJJQJCCCHYYXBZXZCYZTLLCQXYNJYCYYCYNZZQYYYEWYCZDCJYCCHYJLBTZYYCQWMPWPYMLGKDLDLGKQQBGYCHJXY";

    return $strChineseFirstPY [uniord($str) - 19968];
}

#出错并终止程序执行的函数
function sys_error($smarty, $str, $title = "您访问的页面出错")
{
    $smarty->assign(array(
        "title" => $title,
        "css" => httpPath . "css/main.css",
        "httpPath" => httpPath
    ));
    $smarty->assign("str", $str);
    $smarty->display("error.tpl");
    exit ();
}

/*
 * 返回包含所有用户的数组
  Array
  (
  [1] => superAdmin
  ......
  )
 */
function getUsers($pdo)
{
    $sql = "select mID,mName from s_user ";
    $ret = $pdo->query($sql);
    if ($ret) {
        $res = $ret->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $v) {
            $users [$v ['mID']] = $v ['mName'];
        }
        return $users;
    } else
        return false;
}

/*
 * 返回包含所有市场的数组：
  Array
  (
  [8] => 龙岗区人才市场
  ......
  )
 */

// type = 0 全部
// type = 1 所有活动的市场
function getMarkets($pdo, $type = 0)
{
    switch ($type) {
        case "0" :
            $sql = "select marketID,name from a_market";
            break;
        case "1" :
            $sql = "select marketID,name from a_market where active = '1'";
            break;
        default :
            $sql = "select marketID,name from a_market";
            break;
    }

    $ret = $pdo->query($sql);
    if ($ret) {
        $res = $ret->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $v) {
            $users [$v ['marketID']] = $v ['name'];
        }
        return $users;
    }
    return false;
}

/*
 * 返回包含所有需求的数组
  Array
  (
  [12] => 客户服务
  ......
  )
 */
function getRequires($pdo)
{
    $sql = "select r.demandID,p.name from a_recruitdemand r
			left join a_position p on r.positionID = p.positionID";
    $ret = $pdo->query($sql);
    if ($ret) {
        $res = $ret->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $v) {
            $requires [$v ['demandID']] = $v ['name'];
        }
        return $requires;
    }
    return false;
}

function getUnits($pdo)
{
    $sql = "select unitID,unitName from a_unitinfo";
    $ret = $pdo->query($sql);
    if ($ret) {
        $res = $ret->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $v) {
            $units [$v ['unitID']] = $v ['unitName'];
        }
        return $units;
    }
    return false;
}

function idtoname($pdo, $id_type, $id_str)
{
    if (!$id_str) {
        return "";
    } else {
        $id_arr = explode(",", $id_str);
        $name_str = "";
        if ($id_type == "user") {
            $all = getUsers($pdo);
        } elseif ($id_type == "market") {
            $all = getMarkets($pdo, 0);
        } elseif ($id_type == "require") {
            $all = getRequires($pdo);
        }

        foreach ($id_arr as $id) {
            if (!$name_str)
                $name_str .= $all [$id];
            else
                $name_str .= "," . $all [$id];
        }
        return $name_str;
    }
}

# 判断uid是否在old_uid字符串里面存在，是返回true，否返回false
function is_exist($old_uid, $uid)
{
    $old_uid_arr = explode(",", $old_uid);
    if (in_array($uid, $old_uid_arr))
        return true;
    else
        return false;
}


#统计 $date_s 到 $date_t 之间的用户为$users , 市场为$markets 的 工作管理 场次和里程信息

function calc_numdis($pdo, $markets, $users, $date_s, $date_t)
{
    $sql = "select mID from s_user where roleID = '4_1,' and status='1'";
    $ret = $pdo->query($sql);
    if ($ret) {
        $res = $ret->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $user) {
            foreach ($user as $id) {
                $users_arr = explode(",", $users);
                if (in_array($id, $users_arr)) {
                    $statics [idtoname($pdo, "user", $id)] ['mID'] = $id;
                    $statics [idtoname($pdo, "user", $id)] ['num'] = 0;
                    $statics [idtoname($pdo, "user", $id)] ['dis'] = 0;
                }
            }
        }
    }

    $sql = "select d.*,m.distance,m.name from a_dailyrecruit d
			left join a_market m on d.marketID = m.marketID  
			where d.marketID in (" . $markets . ") and recruitDate <= '" . $date_t . "' and recruitDate >= '" . $date_s . "' order by marketID,amOrPm";

    $ret = $pdo->query($sql);

    ///*
    // *  原来的 。。。
    // */
    if ($ret) {
        $res = $ret->fetchAll(PDO::FETCH_ASSOC);

        foreach ($res as $arr) {

            $mid_arr = explode(",", $arr ['mID']);
            $users_arr = explode(",", $users);

            foreach ($mid_arr as $id) {
                if (in_array($id, $users_arr)) {
                    $statics [idtoname($pdo, "user", $id)] ['num'] += 1;
                    $statics [idtoname($pdo, "user", $id)] ['dis'] += $arr ['distance'];
                }
            }
        }
        return $statics;
    }
}

/**去除多余的0
 */
function del0($s)
{
    $s = trim(strval($s));
    if (preg_match('#^-?\d+?\.0+$#', $s)) {
        return preg_replace('#^(-?\d+?)\.0+$#', '$1', $s);
    }
    if (preg_match('#^-?\d+?\.[0-9]+?0+$#', $s)) {
        return preg_replace('#^(-?\d+\.[0-9]+?)0+$#', '$1', $s);
    }
    return $s;
}

/**
 * php冒泡排序算法的实现
 * @param array $array 一维数组
 * @return array 排序过后的数组
 */
function bsort(array $array)
{
    $count = count($array);
    if ($count == 0) {
        return array();
    } elseif ($count == 1) {
        return $array;
    } elseif ($count > 1) {
        for ($i = 0; $i < $count; $i++) {
            for ($j = $count - 1; $j > $i; $j--) {
                if ($array[$j] < $array[$j - 1]) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j - 1];
                    $array[$j - 1] = $temp;
                }
            }
        }
        return $array;
    } else {
        return false;
    }
}

/** 获取当前时间戳，精确到毫秒 */
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

/** 格式化时间戳，精确到毫秒，x代表毫秒 */
function microtime_format($tag, $time)
{
    list($usec, $sec) = explode(".", $time);
    $date = date($tag, $usec);
    return str_replace('x', $sec, $date);
}

/**
 * 以下为微信端的通用方法
 **/


//数据通讯加解密方法
/**
 * 系统加密方法
 *
 * @param string $data
 *            要加密的字符串
 * @param string $key
 *            加密密钥
 * @param int $expire
 *            过期时间 单位 秒
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_encrypt($data, $key = '', $expire = 0)
{
    $key = md5($key);

    $data = base64_encode($data);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l)
            $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    $str = sprintf('%010d', $expire ? $expire + time() : 0);

    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
    }
    return str_replace(array(
        '+',
        '/',
        '='
    ), array(
        '-',
        '_',
        ''
    ), base64_encode($str));
}

/**
 * 系统解密方法
 *
 * @param string $data
 *            要解密的字符串 （必须是think_encrypt方法加密的字符串）
 * @param string $key
 *            加密密钥
 * @return string
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function think_decrypt($data, $key = '')
{
    $key = md5(empty ($key) ? C('DATA_AUTH_KEY') : $key);
    $data = str_replace(array(
        '-',
        '_'
    ), array(
        '+',
        '/'
    ), $data);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    $data = base64_decode($data);
    $expire = substr($data, 0, 10);
    $data = substr($data, 10);

    if ($expire > 0 && $expire < time()) {
        return '';
    }
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = $str = '';

    for ($i = 0; $i < $len; $i++) {
        if ($x == $l)
            $x = 0;
        $char .= substr($key, $x, 1);
        $x++;
    }

    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return base64_decode($str);
}


/**
 * 获取输入参数 支持过滤和默认值
 * 使用方法:
 * <code>
 * filterParam('id',0); 获取id参数 自动判断get或者post
 * filterParam('post.name','','htmlspecialchars'); 获取$_POST['name']
 * filterParam('get.'); 获取$_GET
 * </code>
 * @param string $name 变量的名称 支持指定类型
 * @param mixed $default 不存在的时候默认值
 * @param mixed $filter 参数过滤方法
 * @param mixed $datas 要获取的额外数据源
 * @return mixed
 */
function filterParam($name,$default='',$filter=null,$datas=null) {
    if(strpos($name,'.')) { // 指定参数来源
        list($method,$name) =   explode('.',$name,2);
    }else{ // 默认为自动判断
        $method =   'param';
    }
    switch(strtolower($method)) {
        case 'get'     :   $input =& $_GET;break;
        case 'post'    :   $input =& $_POST;break;
        case 'put'     :   parse_str(file_get_contents('php://input'), $input);break;
        case 'param'   :
            switch($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $input  =  $_POST;
                    break;
                case 'PUT':
                    parse_str(file_get_contents('php://input'), $input);
                    break;
                default:
                    $input  =  $_GET;
            }
            break;
        case 'path'    :
            $input  =   array();
            if(!empty($_SERVER['PATH_INFO'])){
                $depr   =   C('URL_PATHINFO_DEPR');
                $input  =   explode($depr,trim($_SERVER['PATH_INFO'],$depr));
            }
            break;
        case 'request' :   $input =& $_REQUEST;   break;
        case 'session' :   $input =& $_SESSION;   break;
        case 'cookie'  :   $input =& $_COOKIE;    break;
        case 'server'  :   $input =& $_SERVER;    break;
        case 'globals' :   $input =& $GLOBALS;    break;
        case 'data'    :   $input =& $datas;      break;
        default:
            return NULL;
    }
    if(''==$name) { // 获取全部变量
        $data       =   $input;
        array_walk_recursive($data,'filter_exp');
        $filters    =   isset($filter)?$filter:C('DEFAULT_FILTER');
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }
            foreach($filters as $filter){
                $data   =   array_map_recursive($filter,$data); // 参数过滤
            }
        }
    }elseif(isset($input[$name])) { // 取值操作
        $data       =   $input[$name];
        is_array($data) && array_walk_recursive($data,'filter_exp');
        $filters    =   isset($filter)?$filter:catchParam('DEFAULT_FILTER');
        if($filters) {
            if(is_string($filters)){
                $filters    =   explode(',',$filters);
            }elseif(is_int($filters)){
                $filters    =   array($filters);
            }

            foreach($filters as $filter){
                if(function_exists($filter)) {
                    $data   =   is_array($data)?array_map_recursive($filter,$data):$filter($data); // 参数过滤
                }else{
                    $data   =   filter_var($data,is_int($filter)?$filter:filter_id($filter));
                    if(false === $data) {
                        return   isset($default)?$default:NULL;
                    }
                }
            }
        }
    }else{ // 变量默认值
        $data       =    isset($default)?$default:NULL;
    }
    return $data;
}

function array_map_recursive($filter, $data) {
    $result = array();
    foreach ($data as $key => $val) {
        $result[$key] = is_array($val)
            ? array_map_recursive($filter, $val)
            : call_user_func($filter, $val);
    }
    return $result;
}



/**
 * 获取和设置配置参数 支持批量定义
 * @param string|array $name 配置变量
 * @param mixed $value 配置值
 * @param mixed $default 默认值
 * @return mixed
 */
function catchParam($name=null, $value=null,$default=null) {
    static $_config = array();
    // 无参数时获取所有
    if (empty($name)) {
        return $_config;
    }
    // 优先执行设置获取或赋值
    if (is_string($name)) {
        if (!strpos($name, '.')) {
            $name = strtoupper($name);
            if (is_null($value))
                return isset($_config[$name]) ? $_config[$name] : $default;
            $_config[$name] = $value;
            return null;
        }
        // 二维数组设置和获取支持
        $name = explode('.', $name);
        $name[0]   =  strtoupper($name[0]);
        if (is_null($value))
            return isset($_config[$name[0]][$name[1]]) ? $_config[$name[0]][$name[1]] : $default;
        $_config[$name[0]][$name[1]] = $value;
        return null;
    }
    // 批量设置
    if (is_array($name)){
        $_config = array_merge($_config, array_change_key_case($name,CASE_UPPER));
        return null;
    }
    return null; // 避免非法参数
}
?>