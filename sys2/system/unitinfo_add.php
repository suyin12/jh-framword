<?php
require_once '../auth.php';
require_once '../templateConfig.php';
$title="新增单位";
if(isset($_POST['unitinfoAdd']))
{
	$uid=$_POST["txtinfoId"];//单位编号
	$uname=$_POST["txtinfoName"];//单位名称
	$uComInsMoney=$_POST["txtuComInsMoney"];//单位商保缴交金
	$pComInsMoney=$_POST["txtpComInsMoney"];//个人商保缴交金
	$fullManageCost=$_POST["txtfullManageCost"];//全日制管理费
	$notFullManageCos=$_POST["txtnotFullManageCost"];//非全日制管理费
	$uaddress=$_POST["txtunitAddr"];//单位地址
	$soInsID=$_POST["sltsoInsID"];//社保登记账户
	$housingFundID=$_POST["slthousingFundID"];//商保登记账户
	$comInsType=$_POST["sltcomInsType"];//商保购买月份
	$soInsModel=$_POST["sltsoInsModel"];
	$HFModel=$_POST["sltHFModel"];
	$soInsForm=$_POST["sltsoInsForm"];
	$HFForm=$_POST["sltHFForm"];
	$type=1;
	$wltype=2;
	$sql="insert into a_unitinfo(`unitID`,`type`,`unitName`,`uComInsMoney`,`pComInsMoney`,`fullManageCost`,`notFullManageCost`,`unitAddr`,`soInsID`,`housingFundID`,`comInsType`,`wltype`,`soInsModel`,`HFModel`,`soInsFrom`,`HFFrom`) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	//$sql="insert into a_unitinfo(`unitID`,`type`,`unitName`,`uComInsMoney`,`pComInsMoney`,`fullManageCost`,`notFullManageCost`,`unitAddr`,`soInsID`,`housingFundID`,`comInsType`,`wltype`,`soInsModel`,`HFModel`,`soInsFrom`,`HFFrom`) values('$uid','1','$uname','$uComInsMoney','$pComInsMoney','$fullManageCost','$notFullManageCos','$uaddress','$soInsID','$housingFundID','$comInsType','2','$soInsModel','$HFModel','$soInsForm','$HFForm')";
	//echo $sql;
	//$affected=$pdo->exec($sql);
	
    /*if($affected)
	{
	    echo "<script>location.href='manager.php?unid=$uid';</script>";
	}
	else
	{
		echo "<script>alert('数据添加失败！');</script>";
	}*/
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(1,$uid);
	$stmt->bindParam(2,$type);
	$stmt->bindParam(3,$uname);
	$stmt->bindParam(4,$uComInsMoney);
	$stmt->bindParam(5,$pComInsMoney);
	$stmt->bindParam(6,$fullManageCost);
	$stmt->bindParam(7,$notFullManageCos);
	$stmt->bindParam(8,$uaddress);
	$stmt->bindParam(9,$soInsID);
	$stmt->bindParam(10,$housingFundID);
	$stmt->bindParam(11,$comInsType);
	$stmt->bindParam(12,$wltype);
	$stmt->bindParam(13,$soInsModel);
	$stmt->bindParam(14,$HFModel);
	$stmt->bindParam(15,$soInsForm);
	$stmt->bindParam(16,$HFForm);
	$stmt->execute();
	echo "<script>location.href='unitinfo_fen.php?unid=$uid';</script>";
	
}
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("system/unitinfo_add.tpl");
?>