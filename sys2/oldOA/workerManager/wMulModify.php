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
class wMulModify
{
    //参数  p - > $PDO(传入参数)
    public $p;
    public $cellArray;
    private $field = array('name' , 'record');
    private $fieldName = array("姓名" , "成绩");
    #构造字段数组,字段名,字段显示名
    public function tableContent ()
    {
        $field = $this->field;
        $fieldName = $this->fieldName;
        $tableContent = array_combine($field, $fieldName);
        return $tableContent;
    }
    #获取数组,并加上KEY
    public function cellArray ($cellVal)
    {
        $field = $this->field;
        $countCell = count($cellVal);
        for ($k = 0; $k < $countCell; $k ++) {
            $cellArray[] = array_combine($field, $cellVal[$k]);
        }
        $cellArray = array_filter($cellArray);
        $this->cellArray = $cellArray;
    }
    #日期格式验证
    private function isDate ($str, $format = "Ymd")
    {
        $unixTime = strtotime($str);
        $checkDate = date($format, $unixTime);
        if ($checkDate == $str)
            return true;
        else
            return false;
    }
    public function sqlCon ()
    {
        $db_user = "root"; // Database username
        $db_pass = "1qa2WS3ed4RF"; // Database password
        $db_name = "sq_user"; // Database name
        $db_host = "localhost"; // Database host
        $dsn = "mysql:host=$db_host;dbname=$db_name";
        $pdo = new PDO($dsn, $db_user, $db_pass);
        $pdo->query("SET NAMES 'UTF8'");
        $this->p = $pdo;
    }
    #设置文档内容函数
    public function set ()
    {
        $title = "批量导入员工培训成绩信息";
        $table = "m_waitWorkList";
        $field = $this->field;
        $fieldHeader = '<div style=""><table border="0" cellspacing="1" cellpadding="2"  bgcolor="#666666" width="300px"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	                    <th>姓名</th><th>成绩</th></tr></thead>';
        $setArray = array("title" => $title , "table" => $table , "field" => $field , "fieldHeader" => $fieldHeader);
        return $setArray;
    }
    #验证数据正确性及到数据库部分的 函数
    public function validator ()
    {
        $tableContent = $this->tableContent();
        $cellArray = $this->cellArray;
        $countCell = count($cellArray);
        foreach ($cellArray as $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    if (! is_null($v)) {
                        $cellK[$k][] = $v;
                    }
                    switch ($k) {
                        // 1.验证成绩信息,是否为数字
                        case "record":
                            if (! is_numeric($v)) {
                                $errMsg[$k][] = "( " . $val['name'] . " )   <<<" . $tableContent[$k] . ">>> 必须是数字切不为空 {" . $v . "}";
                            }
                            break;
                        // 2.验证重名,
                        case "name":
                            if (is_null($v)) {
                                $errMsg[$k][] = "( " . $val['name'] . " )   <<<" . $tableContent[$k] . ">>> 不能为空 {" . $v . "}";
                            } else {
                                $countRe[$k] = array_count_values($cellK[$k]);
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
                    $reCell[$cKey][] = $cK;
                }
            }
        }
        foreach ($reCell as $reK => $reV) {
            foreach ($reV as $rV) {
                for ($cC = 0; $cC < $countCell; $cC ++) {
                    if ($rV == $cellArray[$cC][$reK]) {
                        //$reErrMsg [] = "<<<" . $tableContent [$reK] . "{" . $rV . "}>>> 重复";
                        //对应的格式是(姓名,错误的项)
                        $reErrMsg[$reK][$rV][] = $cellArray[$cC]['name'];
                    }
                }
            }
        }
        foreach ($reErrMsg as $re_k => $re_v) {
            $reMsg .= "错误的重复项: " . $tableContent[$re_k] . "<br/>";
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
        $errMsg = array($errMsg , $errMsg2);
        $errMsg = array_filter($errMsg);
        return $errMsg;
    }
    #验证数据库
    public function validatorSql ()
    {
        $pdo = $this->p;
        $cellArray = $this->cellArray;
        $countCell = count($cellArray);
        foreach ($cellArray as $val) {
            if (is_array($val)) {
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "name":
                            //注释掉的这部分是通过数据库验证,可是他要执行很多次...哎!尴尬...
                            if ($v) {
                                $sql = "select " . $k . " from m_waitWorkList where ";
                                $sql1 = $k . " in (";
                                $sql2 .= ",'" . $v . "'";
                                $sql2 = ltrim($sql2, ",");
                                $wReSql = $sql . $sql1 . $sql2 . ") and status like '0' ";
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
                for ($cC = 0; $cC < $countCell; $cC ++) {
                    if ($rV['name'] == $cellArray[$cC]['name']) {
                        unset($cellArray[$cC]);
                    }
                }
            }
            foreach ($cellArray as $cellValue) {
                $errMsg[] = "花名册中不存在姓名与导入数据一致的员工(" . $cellValue['name'] . ")";
            }
        } else {
            $errMsg[] = "数据库中不存在相应的员工信息";
        }
        return $errMsg;
    }
    #生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
    public function extraFieldValue ()
    {
        $time = time();
        $cellArray = $this->cellArray;
        return $cellArray;
    }
    #数据库操作语句
    public function sql ()
    {
	    @session_start();
		$actionPer =$_SESSION[UserName];
	    $time = time();
	    $lastModifyTime = date("Y-m-d H:i:s", $time);
        $cellArray = $this->extraFieldValue();
        foreach ($cellArray as $cValue) {
            if ($cValue['record'] >= 60) {
                $sqlH = "update m_waitWorkList set `trainStatus` = '1' ,`lastModifyTime`='$lastModifyTime ',`actionPer`='$actionPer'";
                //生成更新语句
                $sql[] = $sqlH . " where name like '" . $cValue['name'] . "'";
            }
        }
        return $sql;
    }
    #数据库事务处理函数(一般的 更新及插入操作,全部要执行成功)
    public function transaction ($sqlQueue)
    {
        $pdo = $this->p;
        $num = 0;
        if (count($sqlQueue) > 0) {
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
                $pdo->beginTransaction();
                foreach ($sqlQueue as $sql) {
                    if (! is_array($sql)) {
                        $eNum = $pdo->exec($sql);
                        $num += $eNum;
                    }
                }
                $pdo->commit();
            } catch (Exception $e) {
                $err .= "<br/>事务处理出错:" . $e->getMessage();
                $pdo->rollBack();
            }
        } else {
            $err .= "<br/>sql语句数组不能为空";
        }
        $result = array("error" => $err , "num" => $num);
        return $result;
    }
#额外的SQL信息操作 (不一定都要执行成功,没有任何返回其实..)
	public function extraTransaction($sqlQueue) {
		$pdo = $this->p;
		if (count ( $sqlQueue ) > 0) {
			
			try {
				$pdo->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$pdo->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
				$pdo->beginTransaction ();
				foreach ( $sqlQueue as $sql ) {
					$pdo->exec ( $sql );
				}
				$pdo->commit ();
			} catch ( Exception $e ) {
				$err .= "<br/>事务处理出错:" . $e->getMessage ();
				$pdo->rollBack ();
			}
		} else {
			$err .= "<br/>sql语句数组不能为空";
		}
		//	var_dump($err);
		$result = array ("error" => $err );
		return $result;
	}
    #导入信息概况
    public function dataInfo ()
    {
        $cellArray = $this->extraFieldValue();
        $w1 = $w2 = $x1 = $x2 = $y1 = $y2 = $z1 = $z2 = 0;
        $insertInfo .= '<div align="center"><br/>';
        foreach ($cellArray as $cValue) {
            foreach ($cValue as $cK => $cV) {
                if ($cK == 'type') {
                    switch ($cV) {
                        case "1":
                            $w1 ++;
                            if ($cValue['soInsurance'] != "1") {
                                $x1 ++;
                                $o1 .= "<tr bgcolor=#ffffff><td>" . $cValue['name'] . "</td><td>" . $cValue['uID'] . "</td>";
                            }
                            if ($cValue['comInsurance'] != "1") {
                                $y1 ++;
                                $p1 .= "<tr bgcolor=#ffffff><td>" . $cValue['name'] . "</td><td>" . $cValue['uID'] . "</td>";
                            }
                            if ($cValue['status'] != "1") {
                                $z1 ++;
                                $q1 .= "<tr bgcolor=#ffffff><td>" . $cValue['name'] . "</td><td>" . $cValue['uID'] . "</td></tr>";
                            }
                            break;
                        case "2":
                            $w2 ++;
                            if ($cValue['soInsurance'] != "1") {
                                $x2 ++;
                                $o2 .= "<tr bgcolor=#ffffff><td>" . $cValue['name'] . "</td><td>" . $cValue['uID'] . "</td>";
                            }
                            if ($cValue['comInsurance'] != "1") {
                                $y2 ++;
                                $p2 .= "<tr bgcolor=#ffffff><td>" . $cValue['name'] . "</td><td>" . $cValue['uID'] . "</td>";
                            }
                            if ($cValue['status'] != "1") {
                                $z2 ++;
                                $q2 .= "<tr bgcolor=#ffffff><td>" . $cValue['name'] . "</td><td>" . $cValue['uID'] . "</td>";
                            }
                            break;
                    }
                }
            }
        }
        $insertInfo .= '<div align="center">';
        if ($w1 != 0) {
            $insertInfo .= '<br/>
		<p>1. 全日制员工有' . $w1 . ' 人,有 ' . $x1 . ' 人不购买社保,有' . $y1 . '  人不购买商保,有' . $z1 . '  人资料不完整<br/></p>';
            if ($x1)
                $insertInfo .= '<br><p>不购买社保名单:</p>
		<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="50%"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $o1 . '
	    </tbody>
	    </table></div>';
            if ($y1)
                $insertInfo .= '<br>不购买商保名单:
		<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="50%"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $p1 . '
	    </tbody>
	    </table></div>';
            if ($z1)
                $insertInfo .= '
	    <br>资料不完整名单:
		<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="50%"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $q1 . '
	    </tbody>
	    </table></div>';
        }
        if ($w2 != 0) {
            $insertInfo .= '<br/>
		<p>2. 非全日制员工有 ' . $w2 . '人,有' . $x2 . '  人不购买社保,有' . $y2 . '  人不购买商保,有' . $z2 . '  人资料不完整<br/></p>';
            if ($x2)
                $insertInfo .= '<br>不购买社保名单:
		<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="50%"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $o2 . '
	    </tbody>
	    </table></div>';
            if ($y2)
                $insertInfo .= '<br>不购买商保名单:
		<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="50%"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $p2 . '
	    </tbody>
	    </table></div>';
            if ($z2)
                $insertInfo .= ' <br>资料不完整名单:
		<div style=""><table border="0" cellspacing="1" cellpadding="2" align="center" bgcolor="#666666" width="50%"><thead><tr bgcolor="#CAE8EA" style="text-align:center;">
	    <th>姓名</th><th>编号</th></tr>
	    </thead>
	    <tbody>
	    ' . $q2 . '
	    </tbody>
	    </table></div>
	    <br/></div>';
        }
        return $insertInfo;
    }
    #end class	
}
?>