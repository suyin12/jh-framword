<?php

/*
  2009-12-28

  encode this file to 'GBK', you will find new World..^_^
  ������,������лΰ��Ĳ����ʫ��,,,
  Ȼ����,���ǲ��ǳ���������,,���ǲ����Ѿ���Ҫ��#��,ѹ��Ͳ�֪�4���������,
  ��Ҫ��,������...��jϵshi35dong@gmail.com.��ͻ������������֢..
  4��..����һ��ֻ�м���Ĳ����...
 */

/*
 * 目前主要包括两个函数,一个是基本配置文件函数,
 * 另一个是验证数据正确与否的函数
 * 
 * 
 *  set() 返回相应的数组格式: 文件名,表名,字段名,字段显示格式
 *  
 *  validator(被操作数组)
 * 最后返回的数组形式,仅仅是一个 foreach 递归的形式,也就是说 错误类型及其对应的说明已经包含在该数组中
 * */

#简易身份证号码验证

class wMulInsert
{

    //参数  p - > $PDO(传入参数)
    public $p;
    public $cellArray;
    private $field;
    private $fieldName;

    #构造函数,初始化
    function  __construct()
    {
        require_once sysPath . 'dataFunction/fieldDisplay.data.php';
        $f = new fieldDisplay();
        $f->model = "mulInsert";
        $f->style = "none";
        $this->field = $f->wInfoField();
        $this->fieldName = array_values($f->fieldStyle());
    }

    private function pIDVildator($str)
    {
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
                    $b = (int)$pID{$i};
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
            }
            elseif ($length == "17") {
                return false;
            }
            else {
                return $str;
            }
        }
        else {
            return false;
        }
    }

    #构造字段数组,字段名,字段显示名

    public function tableContent()
    {
        $field = $this->field;
        $fieldName = $this->fieldName;
        $tableContent = array_combine($field, $fieldName);
        return $tableContent;
    }

    #获取数组,并加上KEY

    public function cellArray($cellVal)
    {
        $field = $this->field;
        $countCell = count($cellVal);
        for ($k = 0; $k < $countCell; $k++) {
            $cellArray [] = array_combine($field, $cellVal [$k]);
        }
        $cellArray = array_filter($cellArray);
        $this->cellArray = $cellArray;
        //		 $this->cellArray = $cellArray;
    }

    #日期格式验证

    private function isDate($str, $format = "Ymd")
    {
        $unixTime = strtotime($str);
        $checkDate = date($format, $unixTime);
        if ($checkDate == $str)
            return true;
        else
            return false;
    }

    #设置文档内容函数

    public function set()
    {

        $title = "批量导入员工信息";
        $table = "a_workerInfo";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
    }

    #验证数据正确性及到数据库部分的 函数

    public function validator()
    {

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
                        // 1.身份证号码不能为空,且满足基本身份真要求
                        case "pID" :
                            if (!$v || !$this->pIDVildator($v))
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 错误 {" . $v . "}";
                            else {
                                $countRe [$k] = array_count_values($cellK [$k]);
                            }
                            break;
                        //配偶身份证
                        case "spousePID" :
                            if (!is_null($v) && !$this->pIDVildator($v))
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 错误 {" . $v . "}";
                            break;
                        //2.社保号,银行帐号可为空,但为数字
                        case "sID" :
                        case "bID" :
                        case "HFID" :
                        case "proTitle" :
                        case "proLevel" :
                        case "role" :
                        case "marriage" :
                            if (!is_null($v)) {
                                $countRe [$k] = array_count_values($cellK [$k]);
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                }
                            }
                            break;
                        //3.合同编号,员工编号不能为空
                        //						case "cID" :
                        case "uID" :
                            if (is_null($v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空 {" . $v . "}";
                            }
                            else {
                                $countRe [$k] = array_count_values($cellK [$k]);
                            }
                            break;
                        //4. 验证购买社保的情况
                        case "pension" :
                        case "hospitalization" :
                        case "employmentInjury" :
                        case "unemployment" :
                        case "housing" :
                        case "PDIns" :
                            if (!is_null($v)) {
                                if (!preg_match("/^[0-4]{1,1}$/", $v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 '0'或'1'或'2'或'4'{" . $v . "}";
                                }
                                else {
                                    if (!$val ['employmentInjury'] || !$val ['radix']) {
                                        //9. 社保购买错误信息,缴交基数,医疗和工伤为必买项
                                        $errMsg [] = "( " . $val ['name'] . " )   缴交基数,工伤是必选项";
                                    }
                                }
                            }
                            break;
                        //5. 单位编号,且为数字
                        case "unitID" :
                      //  case "managementCost" :
                            if (!$v || !is_numeric($v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 不能为空/不是数字代码 {" . $v . "}";
                            }
                            break;
                        // 6. 婚否,性别,商保,互助会必需为数字,可为空	
                        case "sex" :
                        case "hand" :
                        case "comInsurance" :
                        case "helpCost" :
                        case "cType":
                            if (!is_null($v)) {
                                if (!preg_match("/^[0-3]{1,1}$/", $v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字代码 0/1/2/3{" . $v . "}";
                                }
                            }
                            break;
                        //7. 判断日期格式是否正确	,且入职日期不能为空
                        case "mountGuardDay" :
                            if ($v) {
                                if (!$this->isDate($v) && !$this->isDate($v, "Y-m-d")) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为日期格式(例 : 20090202) {" . $v . "}";
                                }
                            }
                            else {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 是必填项";
                            }
                            break;
                        //7. 判断日期格式是否正确	,且入职日期不能为空
                        case "soInsBuyDate" :
                            if ($v) {
                                if (!$this->isDate($v) && !$this->isDate($v, "Y-m-d")) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为日期格式(例 : 20090202) {" . $v . "}";
                                }
                            }
                            else {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 是必填项";
                            }
                            break;
                        case "cBeginDay" :
                        case "cEndDay" :
                        case "HFBuyDate" :
                        case "jobRegModifyDate":
                            if ($v && !$this->isDate($v) && !$this->isDate($v, "Y-m-d")) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为日期格式(例 : 20090202) {" . $v . "}";
                            }
                            break;
                        //11.户籍类型不能为空,且只能为1,2
                        case "domicile" :
                            if (!$v || !preg_match("/^[1-2]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 必需是数字代码 '1'或'2' {" . $v . "}";
                            }
                            break;
                        //员工类型不能为空,切只能为1到4	
                        case "type" :
                            if (!$v || !preg_match("/^[1-5]{1,1}$/", $v)) {
                                $errMsg [$k] [] = "( " . $val ['name'] . " )   <<<" . $tableContent [$k] . ">>> 必需是数字代码 '1','2','3','4'或'5' {" . $v . "}";
                            }
                            break;
                        // 12. 如果基数不为空,则判断它是否为数字 且 工伤(因为有兼职工伤存在,故医疗可不买),基数 均不能为空或 '0'
                        case "radix" :
                            if ($v) {
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                }
                                else {
                                    if (!$val ['employmentInjury']) {
                                        $errMsg [] = "( " . $val ['name'] . " )   缴交基数,工伤是必选项";
                                    }
                                }
                            }
                            break;
                        //住房公积金比例
                        case "pHFPer" :
                        case "uHFPer" :
                            if ($v) {
                                if (!is_numeric($v)) {
                                    $errMsg [$k] [] = "( " . $val ['name'] . " )  <<<" . $tableContent [$k] . ">>> 必需为数字{" . $v . "}";
                                }
                                else {
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
                                }
                                else {
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
        $errMsg = array_unique($errMsg);
        $errMsg = array($errMsg, $errMsg2);
        $errMsg = array_filter($errMsg);
        return $errMsg;
        //	echo fetchArray ( $errMsg );
    }

    #验证数据库

    public function validatorSql()
    {
        $pdo = $this->p;
        $tableContent = $this->tableContent();
        $cellArray = $this->cellArray;

        foreach ($cellArray as $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    switch ($k) {
                        //如果导入的数据不为空,判断是否已经存在相同的员工编号,身份证号码,合同编号,社保号,工资账号
                        case "uID" :
                        case "bID" :
                        case "sID" :
                        case "HFID" :
                        case "photoID" :
                        case "birthID" :
                            //注释掉的这部分是通过数据库验证,可是他要执行很多次...哎!尴尬...
                            if ($v) {
                                $sql = "select name," . $k . " from a_workerInfo where ";
                                $sql1 = $k . " in (";
                                $sql2 [$k] .= ",'" . $v . "'";
                                $sql2 [$k] = ltrim($sql2 [$k], ",");
                                $wReSql [$k] = $sql . $sql1 . $sql2 [$k] . ") ";
                            }
                            break;
                        case "pID" :
                            if ($v) {
                                $v = $this->pIDVildator($v);
                                $sql = "select name," . $k . " from a_workerInfo where ";
                                $sql1 = $k . " in (";
                                $sql2 [$k] .= ",'" . $v . "'";
                                $sql2 [$k] = ltrim($sql2 [$k], ",");
                                $wReSql [$k] = $sql . $sql1 . $sql2 [$k] . ") ";
                            }
                            break;
                    }
                }
                $uSql [$val ['unitID']] = "select unitID from a_unitInfo where `unitID`='$val[unitID]'";
            }
        }

        foreach ($wReSql as $sqlK => $sqlV) {
            $res = $pdo->query($sqlV);
            if ($res->rowCount() > 0) {
                $ret = $res->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ret as $rV)
                    $errMsg [] = "<<< " . $tableContent [$sqlK] . " {" . $rV [$sqlK] . "}>>>与花名册中的(" . $rV ['name'] . ")重复 ";
            }
        }
        foreach ($uSql as $uSqlK => $uSqlV) {
            $ures = $pdo->query($uSqlV);
            if ($ures->rowCount() < 0 || $ures->rowCount() == 0) {
                $errMsg [] = "<<< " . $tableContent ['unitID'] . " {" . $uSqlK . "}>>> 在系统中不存在,请核实导入数据";
            }
        }
        return $errMsg;
    }

    #生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2

    public function extraFieldValue()
    {
        $time = time();
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            $cellArray [$key] ['status'] = "1";
            foreach ($val as $k => $v) {
                switch ($k) {
                    case "soInsurance" :
                    case "pension" :
                    case "hospitalization" :
                    case "employmentInjury" :
                    case "unemployment" :
                    case "housing" :
                    case "PDIns" :
                    case "hand" :
                    case "comInsurance" :
                    case "helpCost" :
                        if (is_null($v)) {
                            $v = "0";
                            $cellArray [$key] [$k] = $v;
                        }
                        break;
                    case "pID" :
                        $v = $this->pIDVildator($v);
                        $cellArray [$key] [$k] = $v;
                        break;
//设置默认值
                    case "proLevel":
                    case "proTitle":
                        if (!$v) {
                            $v = "9";
                            $cellArray [$key] [$k] = $v;
                        }
                        break;
                    case "role":
                        if (!$v) {
                            $v = "4";
                            $cellArray [$key] [$k] = $v;
                        }
                        break;
                }
            }
            if ($val ['employmentInjury'] == "1" && $val ['radix']) {
                $cellArray [$key] ['soInsurance'] = "1";
                //初始化员工社保日期为员工的投保日期
                $cellArray [$key] ['soInsModifyDate'] = $cellArray [$key] ['soInsBuyDate'];
            }
            else {
                $cellArray [$key] ['soInsurance'] = "0";
                $cellArray [$key] ['soInsModifyDate'] = NULL;
            }
            if ($val ['HFRadix']) {
                $cellArray [$key] ['housingFund'] = "1";
                //初始化员工公积金日期为员工的公积金启用日期
                $cellArray [$key] ['HFModifyDate'] = $cellArray [$key] ['HFBuyDate'];
            }
            else {
                $cellArray [$key] ['housingFund'] = "0";
                //初始化员工公积金日期为员工的公积金启用日期
                $cellArray [$key] ['HFModifyDate'] = NULL;
            }
            $cellArray [$key] ['jobRegModifyDate'] = $val['mountGuardDay'];
            $cellArray [$key] ['lastModifyDate'] = date("Y-m-d H:i:s", $time);
            $cellArray [$key] ['sponsorName'] = $_SESSION ['exp_user'] ['mName'];
        }
        return $cellArray;
    }

    #数据库操作语句

    public function sql()
    {
        $cellArray = $this->extraFieldValue();
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
        $sql = "insert into a_workerInfo ( ";

        //生成插入sql语句
        $sql = array($sql . $sqlK . ") values " . $sqlV);
        return $sql;
    }

    #数据库事务处理函数(一般的 更新及插入操作,全部要执行成功)

    public function transaction($sqlQueue)
    {
        $pdo = $this->p;
        $num = 0;
        if (count($sqlQueue) > 0) {

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                $pdo->beginTransaction();
                foreach ($sqlQueue as $sql) {
                    if (!is_array($sql)) {

                        $eNum = $pdo->exec($sql);
                        $num += $eNum;
                    }
                }
                $pdo->commit();
            } catch (Exception $e) {
                $err .= "<br/>事务处理出错:" . $e->getMessage();
                $pdo->rollBack();
            }
        }
        else {
            $err .= "<br/>sql语句数组不能为空";
        }

        $result = array("error" => $err, "num" => $num);
        return $result;
    }

    #导入信息概况

    public function dataInfo()
    {
        $cellArray = $this->extraFieldValue();
        $w1 = $w2 = $x1 = $x2 = $y1 = $y2 = $z1 = $z2 = 0;
        $insertInfo .= '<div style="min-height:200px;overflow:hidden;">';
        foreach ($cellArray as $cValue) {
            foreach ($cValue as $cK => $cV) {

                if ($cK == 'type') {
                    switch ($cV) {
                        case "1" :

                            $w1++;
                            if ($cValue ['soInsurance'] != "1") {

                                $x1++;
                                $o1 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['comInsurance'] != "1") {
                                $y1++;
                                $p1 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['status'] != "1") {
                                $z1++;
                                $q1 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td></tr>";
                            }
                            break;
                        case "2" :

                            $w2++;
                            if ($cValue ['soInsurance'] != "1") {
                                $x2++;
                                $o2 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['comInsurance'] != "1") {
                                $y2++;
                                $p2 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }
                            if ($cValue ['status'] != "1") {
                                $z2++;
                                $q2 .= "<tr ><td>" . $cValue ['name'] . "</td><td>" . $cValue ['uID'] . "</td>";
                            }

                            break;
                    }
                }
            }
        }


        if ($w1 != 0) {
            $insertInfo .= '<div class="block left halfWidth"><p class="notice">1. 全日制员工有' . $w1 . ' 人,有 ' . $x1 . ' 人不购买社保,有' . $y1 . '  人不购买商保,有' . $z1 . '  人资料不完整</p>';
            if ($x1)
                $insertInfo .= '<div class="left" >不购买社保名单:
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
                $insertInfo .= '<div class="left" >不购买商保名单:
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
                $insertInfo .= '<div class="left" >资料不完整名单:
		<table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $q1 . '
	    </tbody>
	    </table></div>';
            $insertInfo .= '</div>';
        }
        if ($w2 != 0) {
            $insertInfo .= '<div class="block right halfWidth"><p class="notice">2. 非全日制员工有 ' . $w2 . '人,有' . $x2 . '  人停止购买社保,有' . $y2 . '  人停止购买商保,有' . $z2 . '  人入职</p>';
            if ($x2)
                $insertInfo .= '<div class="left" >不购买社保名单:
                    <table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $o2 . '
	    </tbody>
	    </table></div>';
            if ($y2)
                $insertInfo .= '<div class="left" >不购买商保名单:
                    <table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $p2 . '
	    </tbody>
	    </table></div>';
            if ($z2)
                $insertInfo .= ' <div class="left" >资料不完整名单:
                    <table class="myTable"><thead><tr>
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $q2 . '
	    </tbody>
	    </table></div> ';
            $insertInfo .= '</div>';
        }
        return $insertInfo;
    }

#end class	
}

?>
