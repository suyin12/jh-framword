<?php
/*
 *编辑当前用户角色权限
 * 
 * */
//页面访问权限
require_once ('../../auth.php');
//配置文件 数据库和pdo smarty初始化等
require_once ('../../setting.php');
//连接模板文件
require_once ('../../templateConfig.php');
require_once ('../../dataFunction/unit.data.php');

$title="编辑角色权限";

//查询角色已赋予的权限然后拆解组成数组
if(isset($_GET["id"]))
{
	$roleID=$_GET["id"];
	$sql = "SELECT `Function_ID_STR` FROM `s_role` where `roleID`= ?";
	$roleByIDResult = SQL($pdo,$sql,$var=array($roleID),$type="one");
	$roleValue=$roleByIDResult[Function_ID_STR];
	if($roleValue!="")
	{
		$roleList= explode(",",$roleValue);
		array_pop($roleList);//弹出数组中的最后一个 值
		//print_r($roleList);
	}
	else
	{
		$roleList=array();
		//print_r($roleList);
	}
}

//查询所有功能
$sql_Menu="SELECT * FROM `s_menu`";
$menu_result=SQL($pdo,$sql_Menu,$var=null,$type="all");
//echo "<br><pre>";
//print_r($menu_result);


$menulist=array();
for($i=0;$i<count($menu_result);$i++)
{
	$menuID=$menu_result[$i]["Menu_ID"];
	$sql_Function_bymenuid="SELECT * FROM `s_function` where `Menu_ID` REGEXP ? ";
    $functionByMenuIDs_result=SQL($pdo,$sql_Function_bymenuid,$val=array($menuID),$type="all");  
    $menulist[$menuID]=$functionByMenuIDs_result;
    
}
//echo "<pre>";
//print_r($menulist);

$smarty->assign("roleID","$roleID");
$smarty->assign("menu_result",$menu_result);
$smarty->assign("roleList",$roleList);
$smarty->assign("menulist",$menulist);
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->display('system/role/edit_role.tpl');

//修改权限
if(isset($_POST["Submit"]))
{ 
	$success_Meg="<script>alert('权限编辑成功！');location.href='index.php';</script>";
	$fail_Meg="<script>alert('错了，错了！');location.href='index.php';</script>";
	$roleID=$_POST["id"];
	$functionList=$_POST["action_code"];
	$function_STR=implode(',',$functionList).",";
	//die($function_STR);
    $sql_Role_update="UPDATE `s_role` SET `Function_ID_STR`='$function_STR' where `roleID`=:var";
    $res=$pdo->prepare($sql_Role_update);
    $res->bindParam(":var",$roleID);
    $affected=$res->execute();
    if($affected)
    {
    	echo $success_Meg;
    }
	else 
	{
		echo $fail_Meg;
	}
}
?>