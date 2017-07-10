<?php
header("content-type:text/html;charset=utf8");
#引用配置文件
require_once 'agMconfig.php';
require_once 'aInfo_agm.php';

$btn = $_POST['btn'];
$current_user = $_SESSION['exp_user']['mID'];
$current_userName = $_SESSION['exp_user']['mName'];
$current_date = date('Y-m-d');
$current_time = date('Y-m-d H:i:s');
#输入提示信息、结果值true或false
function msg_Arr($error = "操作失败", $re, $succ = "操作成功")
{
    if ($re == true) {
        $msg = array(
            "error" => false,
            "succ" => $succ
        );
    } else {
        $msg = array(
            "error" => $error,
            "succ" => false
        );
    }
    return $msg;
}
#个代基本资料登记
if ($btn=="aCMinsert") {
	//数据的添加调用 类库  db_class.php
	unset($_POST['btn']);
	#给数据字段添加默认值0;
	$soInsurance="0";
	$housingFund="0";
	$pIDVid=pIDVildator($_POST['pID']);
	if(!empty($_POST["soInsBuyDate"])){
	    if (empty($_POST["radix"]) || empty($_POST['cBeginDay'])||empty($_POST['cEndDay'])){
			$error="(操作失败,社保缴交基数，有效期限为必选项)";
		}
		$soInsurance="1";
	}
	if(!$pIDVid)
		$error="(操作失败,请校验身份证号码是否正确)";
	if(!empty($_POST["HFBuyDate"])){
		if(empty($_POST['hBeginDay'])||empty($_POST['hEndDay'])||empty($_POST ['pHFPer']) || empty($_POST ['uHFPer'])){
			$error="个人比例,单位比例,有效期限是必填项";
		}
		$housingFund="1";
	}
	$arr=array(
	//复选框、社保项
		"pension"=>"0",
		"employmentInjury"=>"0",
		"unemployment"=>"0",
		"PDIns"=>"0",
		"status"=>"2",
		"soInsurance"=>$soInsurance,
		"soInsModifyDate" => $_POST ['soInsBuyDate'],
		"HFModifyDate" => $_POST ['HFBuyDate'],
	//公积金
		"housingFund"=>$housingFund,
		
	//修改历史
		"lastModifyTime"=>timeStyle("dateTime"),
		"lastModifyBy"=>$_SESSION ['exp_user'] ['mName']
	);
	$arr=array_merge($arr,$_POST);
	$arr['pID'] = $pIDVid;
    if(empty($error)){
	    $tableName = "d_agent_personalInfo";
	    new db($pdo);
    	//var_dump($arr);
	    $re=db::insert($tableName,$arr);
	    $msg=msg_Arr("添加失败",$re,"添加成功");
	    $insertSql = "insert into d_agent_personalInfo_history select * from d_agent_personalInfo where ID like '{$_POST['id']}'";
        $pdo->query($insertSql);
    }else{
    	$msg=msg_Arr("{$error}",false);
    }
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#个代基本资料修改
if ($btn == "aCM") {
    $ID = $_POST ['id'];
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "radix":
            case "HFRadix":
            case "pHFPer":
            case "uHFPer":
                if ($val == 0) {
                    $_POST[$key] = NULL;
                }
                break;
        }
    }
    if (($_POST ['radix'] || $_POST ['pension'] || $_POST ['unemployment'] || $_POST ['PDIns'] || $_POST ['hospitalization'] || $_POST ['employmentInjury']) && (!$_POST ['radix'] || !$_POST ['employmentInjury'])) {

        $errMsg = "添加失败(缴交基数,工伤为必选项)";
    } else {
        if (!$errMsg) {
            //登记修改记录
            $insertSql = "insert into d_agent_personalInfo_history select * from d_agent_personalInfo where ID like '$ID'";
            $pdo->query($insertSql);
            $soInsKey = array('domicile', 'radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment');
            $HFKey = array("HFRadix", "uHFPer", "pHFPer");
            //生成原始的社保字符串
            $sql = "select domicile,radix, pension, hospitalization, employmentInjury, unemployment,  PDIns, soInsBuyDate,HFRadix,uHFPer,pHFPer,HFBuyDate from d_agent_personalInfo where ID like '" . $ID . "'";
            $res = $pdo->query($sql);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            foreach ($row as $r_k => $r_v) {
                switch ($r_k) {
                    case "domicile":
                    case "radix" :
                    case "pension" :
                    case "hospitalization" :
                    case "employmentInjury" :
                    case "unemployment" :
                        if (!$r_v) {
                            $r_v = '0';
                        }

                        $oldSoIns .= $r_v;
                        break;
                    case "PDIns" :
                        if (!$r_v) {
                            $r_v = '0';
                        }
                        break;
                    case "HFRadix":
                    case "uHFPer":
                    case "pHFPer":
                        if (!$r_v) {
                            $r_v = '0';
                        }

                        $oldHF .= $r_v;
                        break;


                }
                $oldRadix = $row ['radix'];
                $oldSoInsBuyDate = $row ['soInsBuyDate'];
                $oldHFRadix = $row['HFRadix'];
                $oldHFBuyDate = $row ['HFBuyDate'];
            }
            //构造新的社保字符串
            foreach ($soInsKey as $v) {
                switch ($v) {
                    case "radix" :
                        $newSoIns .= number_format($_POST [$v], 2, ".", "");
                        break;
                    default :
                        if (!$_POST [$v]) {
                            $_POST [$v] = '0';
                        }
                        $newSoIns .= $_POST [$v];
                        break;
                }
            }

            //社保更改日期
            if ($oldSoIns == $newSoIns) {
                //等于空 是为了让下面的update语句,不更新soInsModifyDate字段
                $_POST ['soInsModifyDate'] = NULL;
            } else {
                $_POST ['soInsModifyDate'] = $current_date;
                //判断是新增社保或者是修改社保的
                if ($oldRadix != 0) {
                    $_POST ['soInsurance'] = "2";
                } else {
                    $_POST ['soInsurance'] = "1";
                }
            }
            if ($_POST ['soInsBuyDate'] != $oldSoInsBuyDate) {
                $_POST ['soInsModifyDate'] = $_POST ['soInsBuyDate'];
            }
            //构造新的公积金字符串
            foreach ($HFKey as $v) {
                switch ($v) {
                    case "HFRadix" :
                        $newHF .= number_format($_POST [$v], 2, ".", "");
                        break;
                    default :
                        if (!$_POST [$v]) {
                            $_POST [$v] = '0';
                        }
                        $newHF .= $_POST [$v];
                        break;
                }
            }
            //公积金更改日期

            if ($oldHF == $newHF) {
                //等于空 是为了让下面的update语句,不更新soInsModifyDate字段
                $_POST ['HFModifyDate'] = NULL;
            } else {
                $_POST ['HFModifyDate'] = $current_date;
                //判断是新增公积金或者是修改公积金
                if ($oldHFRadix != 0) {
                    $_POST ['housingFund'] = "2";
                } else {
                    $_POST ['housingFund'] = "1";
                }
            }

            if ($_POST['HFBuyDate'] != $oldHFBuyDate) {
                $_POST ['HFModifyDate'] = $_POST ['HFBuyDate'];
            }
            //POST生成相应的字段名,及其字段值
            if (($_POST ['HFRadix'] || $_POST ['pHFPer'] || $_POST ['uHFPer']) && (!$_POST ['pHFPer'] || !$_POST ['uHFPer'])) {
                $errMsg = "个人比例,单位比例,是必填项";
//            } elseif ($_POST ['housingFund'] > 0 && $_POST ['HFRadix'] == 0) {
//                $_POST['housingFund'] = 0;
//                $_POST['HFModifyDate'] = $current_date;
            }
            $_POST ['lastModifyTime'] = timeStyle("dateTime");
            $_POST ['lastModifyBy'] = $_SESSION ['exp_user'] ['mName'];
            $_POST ['PDIns'] = $_POST ['PDIns'] ? $_POST ['PDIns'] : 0;
            if (!$errMsg) {
                //POST生成相应的字段名,及其字段值
                foreach ($_POST as $k => $v) {
                    switch ($k) {
                        case "pID" :
                        case "bID" :
                        case 'sID' :
                        case 'HFID' :
                        case 'spID':
                        case 'photoID' :
                        case 'birthID' :
                            if ($v)
                                $sql3 .= $k . " like '" . $v . "' or ";
                            $sql1 .= $k . "='" . $v . "',";
                            break;
                        case 'btn' :
                        case 'oldUnitID' :
                        case 'oldID' :
                        case 'oldSoIns' :
                        case "id" :
                        case "curd":
                            break;
                        case 'comInsurance' :
                        case 'helpCost' :
                        case "pension" :
                        case "hospitalization" :
                        case "employmentInjury" :
                        case "unemployment" :
                        case "PDIns" :
                            if (!$v)
                                $v = 0;
                            $sql1 .= $k . "='" . $v . "',";
                            break;
                        case "soInsModifyDate" :
                            if ($v)
                                $sql1 .= $k . "='" . $v . "',";
                            break;
                        default :
                            $sql1 .= $k . "='" . $v . "',";
                            break;
                    }
                }

                //验证身份证号码,工资账号,员工编号,员工合同编号,员工社保号是否重复
                $sql3 = substr($sql3, 0, -3);
                $rc = 0;
                if ($sql3) {
                    $sql = "select name from d_agent_personalInfo where ( " . $sql3 . " )and ID<>'" . $ID . "'";
                    $row = $pdo->query($sql);
                    $rc = $row->rowCount();
                }
                if ($rc) {
                    foreach ($row as $key => $row) {
                        $errMsg = "身份证号码/工资账号/社保号/公积金号与员工<<<<[{$row['name']}]>>>>重复,请重新输入\n";
                    }
                } else {
                    //插入表单信息(员工花名册信息)
                    $sql = "update d_agent_personalInfo set ";
                    $sql1 .= "status='1'";
                    $sql .= $sql1;
                    $sql .= " where ID like '" . $ID . "' and `status`!='0'";
                    if ($pdo->exec($sql) > 0) {
                        $succMsg = "<<<<<" . $_POST ['name'] . ">>>>>信息更新成功";
                    } else {
                        $errMsg = "更新失败(1.信息未变更 2. 该员工是离职状态 )";
                    }
                }
            }

        }

    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#社保、公积金封停日期停交
if($btn=="modify"){
    #社保、公积金封停日期
    require_once 'aInfo_agm.php';
    $aInfo=new aInfo();
    unset($_POST["btn"]);
    $soInsModifyDate = $_POST["soInsModifyDate"];
    $HFModifyDate = $_POST["HFModifyDate"];
    $id = $_POST["id"];
    $tableName = "d_agent_personalInfo";
    new db($pdo);
    $aSet = new agencySet();
    $aSet->p=$pdo;
    #是否有参与社保或者公积金*******
    $in = $aInfo->getPlByfID($id,"`status`,`soInsurance`,`housingFund`");
    if($in["soInsurance"]=="1" && !empty($soInsModifyDate)){
        $modifyRemarks.="(社保封停日期$soInsModifyDate)";
        $SoArr = array(
            "soInsurance" => "0",
            "soInsBuyDate" => null,
            "radix" => "0",
            "pension" => "0",
            "hospitalization" => "0",
            "employmentInjury" => "0",
            "unemployment" => "0",
            "PDIns" => "0",
            "soInsModifyDate" => $soInsModifyDate
        );
        $Arr = $SoArr;
    }
    if($in["soInsurance"]=="0"){
        $SoArr = array(
            "soInsurance" => "0"
        );
    }
    if($in["housingFund"]=="1" && !empty($HFModifyDate)){
        $modifyRemarks.="(公积金封停日期$HFModifyDate)";
        $HFArr = array(
            "housingFund" => "0",
            "HFBuyDate" => null,
            "HFRadix" => "0",
            "uHFPer" => "0",
            "pHFPer" => "0",
            "HFModifyDate" => $HFModifyDate
        );
        if (!empty($SoArr))
            $Arr = array_merge($SoArr,$HFArr);
        else
            $Arr = $HFArr;
    }
    if($in["housingFund"]=="0"){
        $HFArr = array(
            "housingFund" => "0"
        );
    }
    #1、社保和公积金都停交
    if($SoArr["soInsurance"]=="0" && $HFArr["housingFund"]=="0"){
        $Arr["status"] = "0";
    }
    if (!empty($Arr)){
        $ModifyArr = array(
            "lastModifyTime" => timeStyle("dateTime"),
            "lastModifyBy" => $_SESSION ['exp_user'] ['mName'],
            "id" => $id,
            "modifyRemarks" => $modifyRemarks
        );
        $newArr = array_merge($Arr,$ModifyArr);
        $eror = "修改失败";
        $succ = "修改成功,$modifyRemarks";
    }else{
        $eror = "系统正在申报..";
    }
    if (!empty($newArr)){
    	db::query("insert into {$tableName}_history select * from {$tableName} where id='{$id}'");
        $re = $aSet->status($newArr);
    }
    $msg = msg_Arr($eror,$re,$succ);
    foreach ($msg as $val){
        echo $val;
    }
}
#添加社保、公积金的补缴记录
    if ($btn == "latepay") {
    $latepaymonth = $_POST["latepaymonth"];
    $paydate = date("Ym");
    $fID = $_POST["fID"];
    $radix = $_POST["radix"];
    $pension = $_POST["pension"];
    $latemanagementCost = $_POST["latemanagementCost"];
    require_once 'latepay_agm.php';
    require_once 'aInfo_agm.php';

    $fee = new feeExtra($pdo);
    $late = new latepay();
    $aInfo = new aInfo();
    $fee->soInsMonlist("distinct `month`", "order by month asc");
    #先判断传值的补缴月份是否已经存在
    $re = $late->monthisIN($latepaymonth);
    if (!$re) {
        $arr = $aInfo->getPlByfID($fID, "`name`,`domicile`,`hospitalization`");
        $arr["radix"] = $radix;
        $arr["pension"] = $pension;
        #应缴养老本金；
        $pensionArr = $fee->soInsPension($arr, $latepaymonth);
        #滞纳金
        $latepay = $fee->exlatepay($latepaymonth, $radix);
        $basicPension = $pensionArr["uPension"] + $pensionArr["pPension"];
        $soInslateArr = array(
            "fID" => $fID,
            "radix" => $radix,
            "paydate" => $paydate,
            "latepaymonth" => $latepaymonth,
            "latepaydays" => $latepay["latepaydays"],
            "latepay" => $latepay["latepay"],
            "latemanagementCost" => $latemanagementCost,
            "pension" => $pension,
            "basicPension" => $basicPension,
            "sponsorTime" => timeStyle("dateTime"),
            "sponsorName" => $_SESSION ['exp_user'] ['mName']
        );
        $total = $basicPension + $latepay["latepay"] + $latemanagementCost;
        $re = $late->addsoInslate($soInslateArr);
        if ($re) {
            echo "<tr class=\"listson\">
					<td>{$latepaymonth}</td>
					<td>{$radix}</td>
					<td>{$latepay["latepay"]}</td>
					<td>{$latepay["latepaydays"]}</td>
					<td>{$basicPension}</td>
					<td>{$latemanagementCost}</td>
					<td>{$total}</td>
				</tr>
			";
        }
    }

}
#个代欠费缴费
if ($btn == "bill") {
    #个代********缴费*****************
    $arr = array(
        "paydate" => date('Ym'),
        "status" => '1',
        "lastModifyTime" => timeStyle("dateTime"),
        "lastModifyBy" => $_SESSION ['exp_user'] ['mName']
    );
    unset($_POST["btn"]);
    $arr = array_merge($arr, $_POST);
    unset($arr["Total"]);
    $tableName = "d_agent_bill";
    new db($pdo);
    #添加新的收入记录
    $arr["income"] = round($arr['income'], 2);
    if ($arr["payment"]=="1") {
        #更新余额表
        $aInfo = new aInfo();
        $aInfo->remainOne($arr["income"],$arr["fid"]);
        $arr['remains'] = $arr['income'] + $arr['remains'];
    }
    $re = db::insert($tableName, $arr);
    $msg = msg_Arr("操作失败", $re, "操作成功");
    if ($re) {
        $msg = array_merge($msg, array("remains" => $arr["remains"]));
        if ($_POST["Total"] <= ($_POST["remains"] + $arr["income"])) {
            $aSet = new agencySet();
            $aSet->p = $pdo;
            if ($arr["payment"]=="1") {
            	$re = $aSet->status(array("status" => "1", "id" => $_POST["fid"]));
            }
            $msg = array_merge($msg, array("status" => "1"));
        }
    }
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#个代结算余额
if ($_POST ['btn'] == "clearing") {
    require_once 'agmLink.class.php';
    $x = new agmLink();
    $b = $x->classBill();
    $a =$x->classaInfo();
    $fID = $_POST["fID"];
    $mess = $_POST["mess"];
    $clearing = $b->clearing($fID);
    if (empty($clearing)) {
        $remain = $a->remain($fID);
        $a->remainTwo($fID);
        $billArr = array(
            "fID" => "{$fID}",
            "paydate" => date("Ym"),
            "type" => "4",
            "mess" => "{$mess}",
            "expenditure" => "$remain",
            "remains" => "0",
            "status" => "1",
            "lastModifyBy" => $_SESSION['exp_user']['mName'],
            "lastModifyTime" => date('Y-m-d H:i:s')
        );
        $re = db::insert("d_agent_bill", $billArr);
        $msg = msg_Arr("操作失败", $re, "操作成功");
    } else {
        $msg = msg_Arr($clearing, false);
    }
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#提交平账时出现等待修改时给社保入账
if ($_POST ['btn'] == "soInsAgmFee") {
    require_once 'agmLink.class.php';
    $x = new agmLink();
    $b = $x->classBill();
    $paydate = $_POST["paydate"];
    $fIDArr = $_POST["fID"];
    if($_POST["tt"] == "入账"){
        $kArr[] = $_POST['id'];
    }else{
        foreach ($fIDArr as $k => $v) {
            if ($v['status'] == '1') {
                $kArr[] = $k;
            } else {
                if ($_POST['type'] == '2'){
                    $sqlArr[] = "update d_agent_bill set status='2' where fID='$k' and paydate='{$paydate}' and type='2' and payment='5'";
                }else{
                    $sqlArr[] = "update d_agent_bill set status='2' where fID='$k' and paydate='{$paydate}' and type='2' and payment='1'";
                }
            }
        }
    }

    if (!empty($kArr)) {
    	$re = $b->expenpay($kArr, $paydate ,$pdo);
    }
    if (!empty($sqlArr)){
    	$re = extraTransaction($pdo, $sqlArr);
    }
    $msg = msg_Arr("操作失败", $re, "操作成功");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#提交平账时出现等待修改时给公积金入账
if ($_POST ['btn'] == "HFAgmFee") {
    require_once 'agmLink.class.php';
    $x = new agmLink();
    $b = $x->classBill();
    $paydate = $_POST["paydate"];
    $fIDArr = $_POST["fID"];
    if($_POST["tt"] == "入账"){
        $kArr[] = $_POST['id'];
    }else{
        foreach ($fIDArr as $k => $v) {
            if ($v['status'] == '1') {
                $kArr[] = $k;
            } else {
                $sqlArr[] = "update d_agent_bill set status='2' where fID='$k' and paydate='{$paydate}' and type='2' and payment='2'";
            }
        }
    }
	if (!empty($kArr)) {
    	$re = $b->expenpay($kArr, $paydate ,$pdo);
    }
    if (!empty($sqlArr)){
    	$re = extraTransaction($pdo, $sqlArr);
    }
    $msg = msg_Arr("操作失败", $re, "操作成功");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除社保平账数据
if ($_POST ['btn'] == "deleteSoInsAgmDetail") {
    $soInsID = $_POST ['soInsID'];
    $soInsDate = $_POST ['soInsDate'];
    $type = $_POST["type"];
    $exSql = "select `fID` from d_agent_bill where paydate='{$soInsDate}' and type='2' and status!='1'";
    $exRes = db::query($exSql);
    //$exRowCount = $exRes->rowCount();
    // print_r($exRes);
    $exSql = "select `fID` from d_soInsFee_tmp where dID='' and soInsDate='{$soInsDate}'";
    $exRess = db::query($exSql);
    if (empty($exRes) && empty($exRess)) {
        $errMsg [] = "平账数据已经提交,无法删除缴交明细";
    } else {
        require_once 'agmLink.class.php';
        $x = new agmLink();
        $a = $x->classaInfo();
        #一并删除本月的平账数据,如果已经被签收平账数据,则不可以删除原始表
        if($type == '2'){
            #补缴社保
            $sql [0] = "delete from d_soInsFee_tmp where soInsDate like '$soInsDate' and type='2'";
            $sql [1] = "delete from d_agent_bill where type='2' and payment='5' and paydate like '$soInsDate'";
            $sql [2] = "delete from d_agent_bill where type='2' and payment='6' and paydate like '$soInsDate'";
            $sql [3] = "delete from a_action_record where month like '$soInsDate' and type like '%agentSS%'";
            $succMsg = "请重新导入补缴社保缴交明细";
            #退款
            $re = $a->remainThree("2",$soInsDate);
        }else{
            $sql [0] = "delete from d_soInsFee_tmp where soInsDate like '$soInsDate' and type='1'";
            $sql [1] = "delete from d_agent_bill where type='2' and payment='1' and paydate like '$soInsDate'";
            $sql [2] = "delete from d_agent_bill where type='2' and payment='3' and paydate like '$soInsDate'";
            $sql [3] = "delete from d_agent_bill where type='2' and payment='4' and paydate like '$soInsDate'";
            $sql [4] = "delete from a_action_record where month like '$soInsDate' and type like '%agentS%'";
            $succMsg = "请重新导入社保缴交明细";
            #退款
            $re = $a->remainThree("1",$soInsDate);
        }
        if($re){
            $result = extraTransaction($pdo, $sql);
        }
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $succMsg = "删除成功,".$succMsg;
        } else
            $errMsg [] = "删除失败,请联系管理员";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除公积金平账数据
if ($_POST ['btn'] == "deleteHFAgmDetail") {
    $housingFundID = $_POST ['soInsID'];
    $HFDate = $_POST ['HFDate'];
    $exSql = "select `fID` from d_agent_bill where paydate='{$HFDate}' and type='2' and status!='1'";
    $exRes = db::query($exSql);
    $exSql = "select `fID` from d_hffee_tmp where dID='' and HFDate='{$HFDate}'";
    $exRess = db::query($exSql);
    if (empty($exRes) && empty($exRess)) {
        $errMsg [] = "平账数据已经提交,无法删除缴交明细";
    } else {
        require_once 'agmLink.class.php';
        $x = new agmLink();
        $a = $x->classaInfo();
        $re = $a->remainThree("3",$HFDate);
        //$re = $aInfo->remainThree("3",$HFDate);
        #一并删除本月的平账数据,如果已经被签收平账数据,则不可以删除原始表
        $sql [0] = "delete from d_hffee_tmp where HFDate like '$HFDate'";
        $sql [1] = "delete from d_agent_bill where type='2' and payment='2' and paydate like '$HFDate'";
        $sql [2] = "delete from a_action_record where month like '$HFDate' and type like '%agentH%'";
        if($re){
            $result = extraTransaction($pdo, $sql);
        }
        $errMsg ['sql'] = $result ['error'];
        if (empty ($errMsg ['sql'])) {
            $succMsg = "删除成功,请重新导入公积金平账";
        } else
            $errMsg [] = "删除失败,请联系管理员";
    }

    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#删除个别的平账数据
if ($_POST ['btn'] == "delsoInsfID") {
    list ($fID, $paydate) = explode("|", $_POST ['fIDsoIns']);
    #一并删除本月的平账数据
    $sql [0] = "delete from d_soInsFee_tmp where fID={$fID} and soInsDate like '$paydate'";
    $sql [1] = "delete from d_agent_bill where paydate like '$paydate' and payment='1' and type='2' and fID={$fID}";
    $result = extraTransaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
        $succMsg = "删除成功";
    } else
        $errMsg [] = "删除失败,请联系管理员";
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#更改社保缴交明细姓名及身份证号码
if ($_POST ['btn'] == "editSoInsFee_tmpBtn") {
    list ($field, $ID) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    $reSql = "update d_soInsFee_tmp set `$field`='$fieldVal',`sponsorName`='$current_userName',`sponsorTime`='$current_time' where `ID`='$ID'";
    $sql [0] = $reSql;
    $result = transaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
        $succMsg = "修改成功";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#更改公积金缴交明细姓名及身份证号码
if ($_POST ['btn'] == "editHFFee_tmpBtn") {
    list ($field, $ID) = explode("|", $_POST ['field']);
    $fieldVal = $_POST ['value'];
    $reSql = "update d_hffee_tmp set `$field`='$fieldVal',`sponsorName`='$current_userName',`sponsorTime`='$current_time' where `ID`='$ID'";
    $sql [0] = $reSql;
    $result = transaction($pdo, $sql);
    $errMsg ['sql'] = $result ['error'];
    if (empty ($errMsg ['sql'])) {
        $succMsg = "修改成功";
    }
    if ($errMsg) {
        $errMsg = array_filter($errMsg);
        $errMsg = array_unique($errMsg);
        foreach ($errMsg as $eV) {
            $errorMsg .= $eV . "<br/>";
        }
        $errMsg = $errorMsg;
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
if ($btn == "rCardCreate") {
    $uID = $_POST['uID'];
    $name = $_POST['name'];
    $oldname = $_POST['oldname'];
    $sex = $_POST['sex'];
    $nation = $_POST['nation'];
    $idcard = $_POST['idcard'];
    $marriage = $_POST['marriage'];
    $politics = $_POST['politics'];
    $hkAddr = $_POST['hkAddr'];
    $hkAddrType = $_POST['hkAddrType'];
    $picNumber = $_POST['picNumber'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $education = $_POST['education'];
    $title = $_POST['title'];
    $level = $_POST['level'];
    $employmentType = $_POST['employmentType'];
    $conStart = $_POST['conStart'];
    $conEnd = $_POST['conEnd'];
    $curUnitStart = $_POST['curUnitStart'];
    $beginWork = $_POST['beginWork'];
    $planBirth = $_POST['planBirth'];
    $planBirthReport = $_POST['reportNum'];
    $rAddr = $_POST['rAddr'];
    $cDate = $_POST['cDate'];
    $houseNumber = $_POST['houseNum'];
    $houseType = $_POST['houseType'];
    $rType = $_POST['rType'];
    $rDate = $_POST['rDate'];
    $solNumber = $_POST['solNumber'];
    $comeReason = $_POST['comeReason'];
    $mobile = $_POST['mobile'];
    $tele = $_POST['tele'];
    $urgent = $_POST['uname'];
    $umobile = $_POST['umobile'];
    $utele = $_POST['utele'];
    $firstApp = $_POST['firstApp'];

    $sql = "select id from a_papers where idcard = '" . $idcard . "' and firstApp = '1'";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows) {
        $error = "系统中有您的记录，您可能已经办理过居住证";
    } else {
        $sql = "INSERT INTO a_papers(uID,name,oldname,sex,nation,idcard,marriage,hukouAddress,
				hukouAddressType,picNumber,location,education,title,skillLevel,planBirthReport,
				planBirthReportNumber,comeDate,houseNumber,houseType,residentialType,
				residentialDate,solNumber,comeReason,mobile,telephone,urgentContacter,ucMobile,
				ucTelephone,firstApp,employmentType,contractStart,contractEnd,currentUnitStart,beginWork,
				salary,politics,createdBy,createdOn,status) VALUES('" . $uID . "','" .
            $name . "','" . $oldname . "','" . $sex . "','" . $nation . "','" . $idcard . "','" . $marriage . "','" . $hkAddr .
            "','" . $hkAddrType . "','" . $picNumber . "','" . $location . "','" . $education . "','" . $title . "','" . $level .
            "','" . $planBirth . "','" . $planBirthReport . "','" . $cDate . "','" . $houseNumber . "','" . $houseType .
            "','" . $rType . "','" . $rDate . "','" . $solNumber . "','" . $comeReason . "','" . $mobile . "','" . $tele . "','" . $urgent .
            "','" . $umobile . "','" . $utele . "','" . $firstApp . "','" . $employmentType . "','" . $conStart . "','" . $conEnd .
            "','" . $curUnitStart . "','" . $beginWork . "','" . $salary . "','" . $politics . "'," . $current_user . ",'" .
            $current_date . "','1')";


        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == 1)
            $success = "插入成功";
        else
            $error2 = "插入失败";
    }
    $msg = array("error" => $error, "error2" => $error2, "success" => $success);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "rCardUpdate") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $oldname = $_POST['oldname'];
    $sex = $_POST['sex'];
    $nation = $_POST['nation'];
    $idcard = $_POST['idcard'];
    $marriage = $_POST['marriage'];
    $politics = $_POST['politics'];
    $hkAddr = $_POST['hkAddr'];
    $hkAddrType = $_POST['hkAddrType'];
    $picNumber = $_POST['picNumber'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $education = $_POST['education'];
    $title = $_POST['title'];
    $level = $_POST['level'];
    $employmentType = $_POST['employmentType'];
    $conStart = $_POST['conStart'];
    $conEnd = $_POST['conEnd'];
    $curUnitStart = $_POST['curUnitStart'];
    $beginWork = $_POST['beginWork'];
    $planBirth = $_POST['planBirth'];
    $planBirthReport = $_POST['reportNum'];
    $rAddr = $_POST['rAddr'];
    $cDate = $_POST['cDate'];
    $houseNumber = $_POST['houseNum'];
    $houseType = $_POST['houseType'];
    $rType = $_POST['rType'];
    $rDate = $_POST['rDate'];
    $solNumber = $_POST['solNumber'];
    $comeReason = $_POST['comeReason'];
    $mobile = $_POST['mobile'];
    $tele = $_POST['tele'];
    $urgent = $_POST['uname'];
    $umobile = $_POST['umobile'];
    $utele = $_POST['utele'];
    $firstApp = $_POST['firstApp'];

    $sql = "UPDATE a_papers set name = '" . $name . "',oldname = '" . $oldname . "',sex = '" . $sex . "',nation = '" . $nation . "',idcard = '" . $idcard . "',marriage = '" . $marriage . "',hukouAddress = '" . $hkAddr .
        "',hukouAddressType = '" . $hkAddrType . "',picNumber = '" . $picNumber . "',location = '" . $location . "',education = '" . $education . "',title = '" . $title . "',skillLevel = '" . $level .
        "',planBirthReport = '" . $planBirth . "',planBirthReportNumber = '" . $planBirthReport . "',comeDate = '" . $cDate . "',houseNumber = '" . $houseNumber . "',houseType = '" . $houseType .
        "',residentialType = '" . $rType . "',residentialDate = '" . $rDate . "',solNumber = '" . $solNumber . "',mobile = '" . $mobile . "',telephone = '" . $tele . "',urgentContacter = '" . $urgent .
        "',ucMobile = '" . $umobile . "',ucTelephone = '" . $utele . "',employmentType = '" . $employmentType . "',contractStart = '" . $conStart . "',contractEnd = '" . $conEnd .
        "',currentUnitStart = '" . $curUnitStart . "',beginWork = '" . $beginWork . "',salary = '" . $salary . "',politics = '" . $politics . "' where id = " . $id;
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1 || $rows == 0)
        $success = "更新成功";
    else
        $error = "更新失败";

    $msg = array("error" => $error, "success" => $success);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

if ($btn == "chgStatus") {
    $num = $_POST['num'];
    $papers_array = $_POST['papers'];
    $papers_num = count($papers_array);

    if (!$papers_num)
        $error = "您未选择任何记录";
    else {
        $paper_str = implode(",", $papers_array);

        $sql = "update a_papers set status = '" . ($num + 2) . "' where id in (" . $paper_str . ")";


        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();

        if ($rows == $papers_num)
            $success = "状态更新成功";
        else
            $error2 = "状态更新失败";
    }
    $msg = array("error" => $error, "error2" => $error2, "success" => $success);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

// archiveCreate 是 档案管理的创建
if ($btn == "archiveCreate1" || $btn == "archiveCreate2"
    || $btn == "archiveCreate3" || $btn == "archiveCreate4"
) {
    $type = substr($btn, 13, 1);

    // 1-4 共有的
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $idcard = $_POST['idcard'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $tel3 = $_POST['tel3'];

    $fileNumber = $_POST['filenumber'];
    $fromUnit = $_POST['fromunit'];
    $workUnit = $_POST['workunit'];
    $manager = $_POST['manager'];

    $jobRegister = $_POST['jobreg'];

    $urgentContactor = $_POST['uc'];
    $urgentContactorTel = $_POST['uctel'];

    $manageDate = $_POST['manageDate'];
    $remarks = $_POST['remarks'];

    $unitContactor = $_POST['unitc'];
    $unitContactorTel = $_POST['unitctel'];
    $feedate = $_POST['feedate'];
    $feeprice = $_POST['feeprice'];
    $huzheng_type = $_POST['hztype'];

    $sql = "select id from a_archive where idcard = '" . $idcard . "'";
    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows)
        $exist = "存在相同身份证号码的档案";
    else {
        switch ($type) {
            case 1:
                $sql = "insert into a_archive(wtype,name,sex,idcard,tel1,tel2,tel3,fromUnit,workUnit,manager,jobRegister,filenumber,manageDate,
						remarks,createdBy,createdOn) values('" . $type . "','" . $name . "','" . $sex . "','" . $idcard . "','" . $tel1 .
                    "','" . $tel2 . "','" . $tel3 . "','" . $fromUnit . "','" . $workUnit . "','" . $manager . "','" . $jobRegister . "','" . $fileNumber . "','" . $manageDate . "','" .
                    $remarks . "'," . $current_user . ",'" . $current_date . "')";
                break;
            case 2:
                $sql = "insert into a_archive(wtype,name,fileNumber,sex,idcard,tel1,tel2,tel3,fromUnit,workUnit,manager,jobRegister,manageDate,
						feePrice,remarks,createdBy,createdOn) values('" . $type . "','" . $name . "','" . $fileNumber . "','" . $sex . "','" . $idcard . "','" . $tel1 .
                    "','" . $tel2 . "','" . $tel3 . "','" . $fromUnit . "','" . $workUnit . "','" . $manager . "','" . $jobRegister . "','" . $manageDate . "','" .
                    $feeprice . "','" . $remarks . "'," . $current_user . ",'" . $current_date . "')";
                break;
            case 3:
                $sql = "insert into a_archive(wtype,name,fileNumber,sex,idcard,tel1,tel2,tel3,fromUnit,workUnit,urgentContactor,urgentContactorTel,manageDate,
						feePrice,remarks,createdBy,createdOn) values('" . $type . "','" . $name . "','" . $fileNumber . "','" . $sex . "','" . $idcard . "','" . $tel1 .
                    "','" . $tel2 . "','" . $tel3 . "','" . $fromUnit . "','" . $workUnit . "','" . $urgentContactor . "','" . $urgentContactorTel . "','" . $manageDate . "','" .
                    $feeprice . "','" . $remarks . "'," . $current_user . ",'" . $current_date . "')";
                break;
            case 4:
                $sql = "insert into a_archive(wtype,name,fileNumber,sex,idcard,tel1,tel2,tel3,fromUnit,workUnit,unitContactor,unitContactorTel,huzhengType,manageDate,
						feePrice,remarks,createdBy,createdOn) values('" . $type . "','" . $name . "','" . $fileNumber . "','" . $sex . "','" . $idcard . "','" . $tel1 .
                    "','" . $tel2 . "','" . $tel3 . "','" . $fromUnit . "','" . $workUnit . "','" . $unitContactor . "','" . $unitContactorTel . "','" . $huzheng_type . "','" . $manageDate . "','" .
                    $feeprice . "','" . $remarks . "'," . $current_user . ",'" . $current_date . "')";
                break;
        }

        $ret = $pdo->query($sql);
        $rows = $ret->rowCount();
        if ($rows == 1)
            $success = "档案创建成功";
        else
            $error = "档案创建失败";
    }
    $msg = array("error1" => $exist, "error2" => $error, "success" => $success);
    $msg = array_filter($msg);
    $msg = json_encode($msg);
    echo $msg;
}

# 档案管理 添加一个缴费记录
if ($btn == "addArchiveFee") {
    $id = $_POST['userid'];
    $paytype = $_POST['paytype'];
    $amount = $_POST['amount'];
    $period_s = $_POST['period_s'];
    $period_e = $_POST['period_e'];
    $paidBy = $_POST['paidBy'];
    $paidOn = $_POST['paidOn'];


    $sql = "insert into a_agencypaymenthistory(paytype,userid,amount,period_s,period_e,paidBy,paidOn,createdBy,createdOn)
			values('" . $paytype . "','" . $id . "'," . $amount . ",'" . $period_s . "','" . $period_e . "','" . $paidBy . "','" . $paidOn . "'," . $current_user .
        ",'" . $current_date . "')";

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();
    if ($rows == 1)
        $success = "成功";
    else
        $error = "失败";

    $msg = array("error" => $error, "success" => $success);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

# 添加一个个人社保代理的人员
if ($btn == "siAgencyCreate") {
    $name = $_POST['name'];
    $idcard = $_POST['idcard'];
    $pcno = $_POST['pcno'];
    $period_s = $_POST['period_s'];
    $period_e = $_POST['period_e'];
    $manageFee = $_POST['manageFee'];
    $siStart = $_POST['siStart'];
    $telephone = $_POST['telephone'];

    $siStart_arr = explode("-", $siStart);
    $solStart_y = $siStart_arr[0];
    $solStart_m = $siStart_arr[1];

    $sql = "insert into a_soinsagency(name,idcard,pcno,telephone,period_s,period_e,manageFee,soInsStart_y,soInsStart_m,createdByName,createdOn)
			 values ('" . $name . "','" . $idcard . "','" . $pcno . "','" . $telephone . "','" . $period_s . "','" . $period_e . "'," . $manageFee . ",'" . $solStart_y . "','" .
        $solStart_m . "','" . $current_userName . "','" . $current_date . "')";

    echo $sql;

    $ret = $pdo->query($sql);
    $rows = $ret->rowCount();

    if ($rows == 1)
        $success = "添加个人社保代理人成功";
    else
        $error = "添加个人社保代理失败";

    $msg = array("error" => $error, "success" => $success);
    $msg = array_filter($msg);
    $json_msg = json_encode($msg);
    echo $json_msg;
}


#就业登记专员签收就业登记申报表
if ($_POST ['btn'] == "receive") {

    $zhuanyuan = $_POST ['zy'];
    if ($_SESSION ['exp_user'] ['mID'] != $zhuanyuan) { //if(0)
        $error2 = "只能签收自己管理的就业登记单位";
    } else {
        $manageSql = "select unitID,mName from s_user where roleID REGEXP '2_1,'";
        $manageRes = $pdo->query($manageSql);
        $manageRet = $manageRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($manageRet as $mK => $mV) {
            $manageArr [$mV ['mName']] = $mV ['unitID'];
        }
        $receiverName = $_SESSION ['exp_user'] ['mName'];
        $receiveTime = timeStyle("dateTime");
        $zySql = "select unitID from s_user where mID = " . $zhuanyuan;
        $ret = $pdo->query($zySql);
        $res = $ret->fetch(PDO::FETCH_ASSOC);
        $units_str = $res ['unitID'];

        foreach ($_POST ['chkList'] as $chkVal) {
            list ($jobRegModifyDate, $sponsorName, $extraBatch) = explode("|", $chkVal);
            $sql [] = "update a_jobReglist a , a_workerinfo b set a.receiverName = '" . $receiverName . "', a.receiveTime = '" . $receiveTime . "', a.status = '1'
							where a.uID = b.uID and a.jobRegModifyDate = '" . $jobRegModifyDate . "' and a.sponsorName = '" . $sponsorName . "' and a.extraBatch = '" . $extraBatch . "' and b.unitID in (" . $units_str . ")";
        }

        //进行事务处理,所有更新成功为成功
        $result = extraTransaction($pdo, $sql);
        $errMsg = $result ['error'];
        $succNum = $result ['num'];
        if (empty($errMsg)) {
            $succMsg = "签收成功";
        }
    }

    $msg = array("error" => $errMsg, "error2" => $error2, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#更新档案管理个人信息
if ($_POST['btn'] == 'updateArchive') {
    foreach ($_POST as $key => $val) {
        switch ($key) {
            case "id":
                $id = $val;
                break;
            case "btn":
                break;
            default :
                $str .= "`" . $key . "`='" . $val . "',";
                break;
        }
    }
    $str = rtrim($str, ",");
    $upSql[0] = " update `a_archive` set $str  where `id`='$id'";
    $result = transaction($pdo, $upSql);
    $errMsg = $result ['error'];
    if (empty($errMsg)) {
        $succMsg = "修改成功";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg);
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}

#生成社保申报表
if ($_POST ['btn'] == "soList") {
    //var_dump($_POST);
    //定义发起人,及其发起时间
    $sponsorName = $current_userName;
    $sponsorTime = $current_time;
    $time = time();
    $unitID = '3000.001'; //本公司的单位编号
    //为下面的日期格式做铺垫
    if ($_POST ['currentMon'] && $_POST ['currentDay']) {
        $currentMon = $_POST ['currentMon'];
        $currentDay = $_POST ['currentDay'];
    } else {
        $currentMon = date("Ym", $time);
        $currentDay = date('d', $time);
    }
    $startMon = $currentMon . "01";
    //社保年月界定为,当月20号到次月19号,为一个投保期限..这样生成的目的是避免客户经理提前做入职,但到社保购买日,忘记购买社保的情况(或购买次月社保的情况)...
    // 如果把$eT设定为当前日期的话,则是一种比较正规的操作方法,但是这就可能造成为购买次月社保的情况
    if ($currentDay <= insuranceInTurn("soIns")) {
        $mon = $currentMon;
        $bT = date("Ym", strtotime("$startMon -1 month")) . (insuranceInTurn("soIns") + 1);
        $eT = $currentMon . insuranceInTurn("soIns");
    } else {
        $mon = date("Ym", strtotime("$startMon +1 month"));
        $bT = $currentMon . (insuranceInTurn("soIns") + 1);
        $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("soIns");
    }

    #更换了社保的生成方法,首先删除本月未签收数据,然后插入本月应该购买的社保人员名单...这个方法在效率上估计会比上一个方法效率上会高...也就是说可以不用更新操作来麻烦了..再者上面那个社保生成名单也是错误的...
    //删除本客户经理,本月未签收的数据(这里不限定月份的原因是,因为每批数据社保专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
    $sql ["delete"] = "delete from a_soInsList where status like '0' and sponsorName like '$sponsorName' and type='9' ";
    //插入语句则是,本月该段时间内,即soInsModifyDate在该段操作时间内,的一切社保行为,无论是新增,修改,停保等...故更社保状态无关
    $sql ['diff'] = "select x.id as uID,'$unitID' as unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,y.status,'' as remarks,'9' as type from d_agent_personalInfo x left join a_soInsList y on (x.id=y.uID and x.soInsModifyDate= y.soInsModifyDate  )where   x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is null";
    //同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的社保信息处理(1.未签收被删除2.签收则insert 注意的是:社保状态要为2)
    $sql ["same"] = "select distinct(x.id) as uID,'$unitID' as unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,'0' as status,'' as remarks,'9' as type from d_agent_personalInfo x left join a_soInsList y on (x.id=y.uID and x.soInsModifyDate= y.soInsModifyDate )where   x.status in (1,2) and x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is not null and x.soInsurance like '2'  ";
    //同一天离职,入职的情况,也不是特别确定就是了..
    $sql ["same_time"] = " select distinct(x.id) as uID,'$unitID' as unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,'0' as status,'' as remarks,'9' as type from d_agent_personalInfo x where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and   exists(select 1 from ( select max(y.ID) as ID from  a_soinslist y where y.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.unitID  like '$unitID' group by y.uID) s,a_soinslist t where  t.ID=s.ID and x.id=t.uID and x.soInsurance != t.soInsurance  and t.status =  '1' AND t.soInsurance !=  '2' ) ";
    //同一天修改,同一天离职的情况
    $sql ["same_time2"] = " select distinct(x.id) as uID, '$unitID' as unitID,x.soInsModifyDate,x.soInsurance,x.radix,x.pension,x.hospitalization,x.employmentInjury,x.unemployment,x.PDIns,'0' as status,'' as remarks,'9' as type from d_agent_personalInfo x where x.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and  exists(select 1 from ( select max(y.ID) as ID from  a_soinslist y where y.soInsModifyDate between '" . $bT . "' and '" . $eT . "' and y.unitID like '$unitID' group by y.uID) s,a_soinslist t where  t.ID=s.ID and x.id=t.uID and x.soInsurance != t.soInsurance  and t.status =  '1' AND t.soInsurance =  '2' and x.soInsurance = '0' ) ";
    //补缴相关的信息
    $sql ['late'] = "select fID as uID , '$unitID' as unitID, date(x.sponsorTime) as soInsModifyDate,'9' as soInsurance,x.radix,x.pension, '0' as hospitalization, '0' as employmentInjury,'0' as unemployment,'0' as PDIns, '0' as status,concat(cast('补缴:' as char),x.latepaymonth) as remarks,'9' as type from d_soInslate_tmp x  where  date(x.sponsorTime) between '" . $bT . "' and '" . $eT . "' and not exists ( select 1 from a_soinslist y where x.fid=y.uID and date(x.sponsorTime)=y.soInsModifyDate and y.status=1 and y.soInsurance=9  ) ";
	//print_r($sql);
    foreach ($sql as $sK => $sV) {
        $res = $pdo->query($sV);
        if ($res)
            $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
    }
    $insertArr = keyArray($ret ['diff'], "uID");
    foreach ($ret ['diff'] as $rdK => $rdV) {
        $soInsModifyDateArr [] = $rdV ['soInsModifyDate'];
    }
    foreach ($ret ['same'] as $rK => $rV) {
        if ($rV ['status'] == "1") {
            $insertArr [$rV['uID']] = $rV;
            $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
        }
    }
    foreach ($ret ['same_time'] as $rK => $rV) {
        $insertArr [$rV['uID']] = $rV;
        $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
    }
    foreach ($ret ['same_time2'] as $rK => $rV) {
        $insertArr [$rV['uID']] = $rV;
        $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
    }
    foreach ($ret ['late'] as $rK => $rV) {
        $uID = "GD" . $rV['uID'];
        $insertArr [$uID]['uID'] = $rV['uID'];
        $insertArr [$uID]['unitID'] = $rV['unitID'];
        $insertArr [$uID]['soInsModifyDate'] = $rV['soInsModifyDate'];
        $insertArr [$uID]['soInsurance'] = $rV['soInsurance'];
        $insertArr [$uID]['radix'] = '';
        $insertArr [$uID]['pension'] = $rV['pension'];
        $insertArr [$uID]['hospitalization'] = $rV['hospitalization'];
        $insertArr [$uID]['employmentInjury'] = $rV['employmentInjury'];
        $insertArr [$uID]['unemployment'] = $rV['unemployment'];
        $insertArr [$uID]['PDIns'] = $rV['PDIns'];
        $insertArr [$uID]['status'] = $rV['status'];
        $insertArr [$uID]['remarks'] .= $rV['remarks'] . ",基数" . $rV['radix'] . ";";
        $insertArr [$uID]['type'] = $rV['type'];
        $soInsModifyDateArr [] = $rV ['soInsModifyDate'];
    }

    if ($soInsModifyDateArr) {
        $soInsModifyDateArr = array_unique($soInsModifyDateArr);
        foreach ($soInsModifyDateArr as $sMDV) {
            $soInsModifyDateStr .= "'" . $sMDV . "',";
        }
        $soInsModifyDateStr = rtrim($soInsModifyDateStr, ",");
        $existsSql = "select max(extraBatch) as eB,soInsModifyDate from a_soInsList where soInsModifyDate in($soInsModifyDateStr) and sponsorName like '$sponsorName' group by soInsModifyDate";
        $existsRes = $pdo->query($existsSql);
        $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($existsRet as $eK => $eV) {
            $extraBatchArr [$eV ['soInsModifyDate']] = ++$eV ['eB'];
        }
    }
//	print_r($insertArr);
    $fieldStr = "uID,unitID,soInsModifyDate,soInsurance,radix, pension, hospitalization, employmentInjury, unemployment, PDIns, status,remarks,type,batch,extraBatch,sponsorName,sponsorTime";
    //构成插入语句
    if ($insertArr) {
        $insertSql = " insert into a_soInsList (" . $fieldStr . ")values";
        foreach ($insertArr as $iV) {

            $iV ['batch'] = "So." . $mon;
            $iV ['extraBatch'] = $extraBatchArr [$iV ['soInsModifyDate']];
            $iV ['sponsorName'] = $sponsorName;
            $iV ['sponsorTime'] = $sponsorTime;
            $iV ['status'] = "0";
            $insertStr .= "(";
            foreach ($iV as $iKey => $iVal) {
                if (!$iVal && $iKey != 'remarks')
                    $iVal = '0';
                $insertStr .= "'" . $iVal . "',";
            }
            $insertStr = rtrim($insertStr, ",");
            $insertStr .= "),";
        }
        $insertStr = rtrim($insertStr, ",");
        //insert sql
        $actionSql [] = $insertSql . $insertStr;
    }
    extraTransaction($pdo, $actionSql);
    $errMsg = $result ['error'];
    if (empty($errMsg)) {
        $succMsg = "成功生成社保申报名单";
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg, "type" => "soIns");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#页面createList.php 生成住房公积金清单
if ($_POST ['btn'] == "HFList") {

    //定义发起人,及其发起时间
    $sponsorName = $current_userName;
    $sponsorTime = $current_time;
    $time = time();
    $unitID = '3000.001'; //本公司的单位编号
    //为下面的日期格式做铺垫
    if ($_POST ['currentMon'] && $_POST ['currentDay']) {
        $currentMon = $_POST ['currentMon'];
        $currentDay = $_POST ['currentDay'];
    } else {
        $currentMon = date("Ym", $time);
        $currentDay = date('d', $time);
    }
    $startMon = $currentMon . "01";
    if ($currentDay <= insuranceInTurn("HF")) {
        $mon = $currentMon;
        $bT = date("Ym", strtotime("$startMon -1 month")) . (insuranceInTurn("HF") + 1);
        $eT = $currentMon . insuranceInTurn("HF");
    } else {
        $mon = date("Ym", strtotime("$startMon +1 month"));
        $bT = $currentMon . (insuranceInTurn("HF") + 1);
        $eT = date("Ym", strtotime("$startMon +1 month")) . insuranceInTurn("HF");
    }

    #更换了公积金的生成方法,首先删除本月未签收数据,然后插入本月应该购买的公积金人员名单...这个方法在效率上估计会比上一个方法效率上会高...也就是说可以不用更新操作来麻烦了..再者上面那个社保生成名单也是错误的...
    //删除本客户经理,本月未签收的数据(这里不限定月份的原因是,因为每批数据公积金专员那边必需跟进,签收然后做网上申报,一般当天就可以签收了)
    $sql ["delete"] = "delete from a_HFList where status like '0' and sponsorName like '$sponsorName' and type='9'";
    //插入语句则是,本月该段时间内,即HFModifyDate在该段操作时间内,的一切公积金行为,无论是新增,修改,停保等...故更社保状态无关
    $sql ['diff'] = "select x.id as uID,'$unitID' as unitID,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,'0' as status,'' as remarks,'9' as type from d_agent_personalInfo x left join a_HFList y on (x.id=y.uID and x.HFModifyDate= y.HFModifyDate  )where   x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is null";
    //同一个天内(防止同一天内多次修改社保状态的问题),相同员工编号的公积金信息处理(1.未签收被删除2.签收则insert 注意的是:公积金要为2)
    $sql ["same"] = "select distinct(x.ID) as uID,'$unitID' as unitID,x.HFModifyDate,x.housingFund,x.HFRadix,x.pHFPer,x.uHFPer,'0' as status,'' as remarks,'9' as type from d_agent_personalInfo x left join a_HFList y on (x.uID=y.uID and x.HFModifyDate= y.HFModifyDate  )where   x.status in (1,2) and x.HFModifyDate between '" . $bT . "' and '" . $eT . "' and y.uID is not null and x.housingFund like '2' ";
    //补缴
    $sql ['late'] = "select fID as uID , '$unitID' as unitID, date(x.sponsorTime) as HFModifyDate,'9' as housingFund,x.HFRadix,x.uHFPer,x.pHFPer,'0' as status,concat(cast('补缴:' as char),x.latepaymonth) as remarks,'9' as type from d_hflate_tmp x  where  date(x.sponsorTime) between '" . $bT . "' and '" . $eT . "' and not exists ( select 1 from a_HFlist y where x.fid=y.uID and date(x.sponsorTime)=y.HFModifyDate and y.status=1 and y.housingFund=9) ";
    //echo "<pre>";var_dump($sql);
    foreach ($sql as $sK => $sV) {
        $res = $pdo->query($sV);
        if ($res)
            $ret [$sK] = $res->fetchAll(PDO::FETCH_ASSOC);
    }
  
    $insertArr = keyArray($ret ['diff'], "uID");
    foreach ($ret ['diff'] as $rdK => $rdV) {
        $HFModifyDateArr [$rdV['uID']] = $rdV ['HFModifyDate'];
    }
    foreach ($ret ['same'] as $rK => $rV) {
        if ($rV ['status'] == "1") {
            $insertArr [$rV['uID']] = $rV;
            $HFModifyDateArr [] = $rV ['HFModifyDate'];
        }
    }
   
    foreach ($ret ['late'] as $rK => $rV) {
        $uID = "GD" . $rV['uID'];
        $insertArr [$uID]['uID'] = $rV['uID'];
        $insertArr [$uID]['unitID'] = $rV['unitID'];
        $insertArr [$uID]['HFModifyDate'] = $rV['HFModifyDate'];
        $insertArr [$uID]['housingFund'] = $rV['housingFund'];
        $insertArr [$uID]['HFRadix'] = '';
        $insertArr [$uID]['pHFPer'] = $rV['pHFPer'];
        $insertArr [$uID]['uHFPer'] = $rV['uHFPer'];
        $insertArr [$uID]['status'] = $rV['status'];
        $insertArr [$uID]['remarks'] .= $rV['remarks'] . ",基数" . $rV['HFRadix'] . ";";
        $insertArr [$uID]['type'] = $rV['type'];
        $HFModifyDateArr [] = $rV ['HFModifyDate'];
    }
    
    if ($HFModifyDateArr) {
        $HFModifyDateArr = array_unique($HFModifyDateArr);
        foreach ($HFModifyDateArr as $sMDV) {
            $HFModifyDateStr .= "'" . $sMDV . "',";
        }
        $HFModifyDateStr = rtrim($HFModifyDateStr, ",");
        $existsSql = "select max(extraBatch) as eB,HFModifyDate from a_HFList where HFModifyDate in($HFModifyDateStr) and sponsorName like '$sponsorName' group by HFModifyDate";
        $existsRes = $pdo->query($existsSql);
        $existsRet = $existsRes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($existsRet as $eK => $eV) {
            $extraBatchArr [$eV ['HFModifyDate']] = ++$eV ['eB'];
        }
    }
    //	print_r($extraBatchArr);
    $fieldStr = "uID,unitID,HFModifyDate,housingFund,HFRadix, pHFPer,uHFPer,status,remarks,type,batch,extraBatch,sponsorName,sponsorTime";
    //构成插入语句
    if ($insertArr) {
        $insertSql = " insert into a_HFList (" . $fieldStr . ")values";
        foreach ($insertArr as $iV) {
            if ($iV ['housingFund'] > 0 && ($iV ['pHFPer'] != 0.05 || $iV ['uHFPer'] != 0.05) && ($iV ['pHFPer'] != 0.06 || $iV ['uHFPer'] != 0.06) && ($iV ['pHFPer'] != 0.1 || $iV ['uHFPer'] != 0.1)) {
                $errMsg = "报表生成失败;目前只开放比例为 5%,6%,10%的公积金(错误:个人编号为:" . $iV ['uID'] . "-单位比例:" . $iV ['uHFPer'] . "-个人比例:" . $iV ['pHFPer'] . ")";
                break;
            } else {
                $iV ['batch'] = "HF." . $mon;
                $iV ['extraBatch'] = $extraBatchArr [$iV ['HFModifyDate']];
                $iV ['sponsorName'] = $sponsorName;
                $iV ['sponsorTime'] = $sponsorTime;
                $iV ['status'] = "0";
                $insertStr .= "(";
                foreach ($iV as $iKey => $iVal) {
                    if (!$iVal && $iKey != "remarks")
                        $iVal = '0';
                    $insertStr .= "'" . $iVal . "',";
                }
                $insertStr = rtrim($insertStr, ",");
                $insertStr .= "),";
            }
        }
        $insertStr = rtrim($insertStr, ",");
        //insert sql
        $actionSql [] = $insertSql . $insertStr;
    }
    //print_r($actionSql);
    if (!$errMsg) {
        extraTransaction($pdo, $actionSql);
        $errMsg = $result ['error'];
        if (empty($errMsg)) {
            $succMsg = "成功生成公积金申报名单";
        }
    }
    $msg = array("error" => $errMsg, "succ" => $succMsg, "type" => "HF");
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
#恢复停交,清楚协议日期等信息
if ($_POST ['btn'] == "reentry") {
    $current_date = date("Y-m-d");
    $id = $_POST ['id'];
    $sql = "update d_agent_personalinfo set status = '1',cBeginDay = '',cEndDay = '',radix = '',
			soInsBuyDate = '',managementCost = 0 where id = '" . $id . "'";
    $ret = $pdo->query($sql);
    if ($ret) {
    	$rows = $ret->rowCount();
        if ($rows == 1)
            $succMsg = "办理成功，现在跳转到人员登记界面";
        else
            $error = "清空失败";
    } else {
            $error = "数据库查询错误";
    }
    $msg = array(
        "error" => $errMsg,
        "succ" => $succMsg
    );
    $msg = array_filter($msg);
    $js_msg = json_encode($msg);
    echo $js_msg;
}
?>