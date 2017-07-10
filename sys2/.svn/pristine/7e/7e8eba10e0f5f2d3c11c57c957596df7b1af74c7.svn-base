<?php
require_once ('../auth.php');
require_once ('../templateConfig.php');

if($_GET["id"])
{
	$conId=$_GET["id"];
	$sql="SELECT * FROM `s_comins_set` where comInsType=$conId";
	$pdostatement=$pdo->query($sql);
	$res=$pdostatement->fetchAll(PDO::FETCH_ASSOC);
	$smarty->assign("comIns",$res);
	$smarty->display("system/comIns_edit.tpl");
}

if(isset($_POST["sub"])){
	$bianji=$_GET["edit"];
	switch ($bianji)
	{
		//修改 “商保” 设置
		case "modify":
	    	 $comInsType=$_POST["comInsType"];
			 $typename=$_POST["txtconName"];
			 $comInsMoney=$_POST["txtconRatio"];
			 $sql="UPDATE `s_comins_set` SET `comInsMoney` = '$comInsMoney',`typeName` = '$typename' WHERE `comInsType` = $comInsType";
			 //echo $sql;
			 $affected=$pdo->exec($sql);
			 if($affected)
			 {
			 	echo "<script>alert('修改成功！');</script>";
			 }
			 else
			 {
			 	echo "<script>alert('数据未作修改！');</script>";
			 }
			break;
		//添加 “商保”	
		case "add":
			$comInsType=$_POST["comInsType"];
			$typename=$_POST["txtconName"];
			$comInsMoney=$_POST["txtconRatio"];
			$sql="insert into `s_comins_set`(`comInsType`,`typeName`,`comInsMoney`) values('$comInsType','$typename','$comInsMoney')";
			//exit($sql);
			$affected=$pdo->exec($sql);
	        if($affected)
			 {
			 	echo "<script>alert('添加成功！');</script>";
			 }
			 else
			 {
			 	echo "<script>alert('数据添加失败！');window.location.href=window.location.href;</script>";
			 }
			break;
		//删除 “商保”	
		case "del":
			$comInsType=$_GET["delid"];
			$sql="DELETE FROM `s_comins_set` WHERE `comInsType`=$comInsType";
			$affected=$pdo->exec($sql);
	        if($affected)
			 {
			 	echo "<script>alert('数据删除成功！');location.href='comIns_manager.php';</script>";
			 }
			 else
			 {
			 	echo "<script>alert('数据删除失败！');location.href='comIns_manager.php';</script>";
			 }
			break;
		default:
			echo "<script>location.href='comIns_manager.php';</script>";
	}
	
}
?>
