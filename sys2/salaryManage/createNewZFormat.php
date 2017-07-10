<?php

/*
 *     2010-3-17   
 *          <<< 新建帐套 :目前的思路是,必须选择设置的项目有 1.银行账号 2.姓名 3.(都是企业部分,因为个人部分都将被重新生成)基数,养老 ,医疗,生育,工伤,失业,住房 4.管理费 5.个人商保,企业商保 6.互助会>>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#链接相应的客户经理,单位数据文件
//require_once '../dataFunction/unit.data.php';
#链接通用函数
require_once '../common.function.php';
#页面标题
$title = "新建工资帐套";
//$smarty->debugging = true;
#初始化页面
if ($_POST ['column']) {
    $column = $_POST ['column'];
} else {
    $column = 25;
}
$colStart = 'A';
//增加多少列
#处理帐套更新情况
$zID = $_GET ['zID'];
if (!$zID) {
    $btnName = "zFCreate";
} else {
    $btnName = "zFUpdate";
    $sql = "select * from a_zformatinfo where zID like ?";
    $res = $pdo->prepare($sql);
    $res->execute(array($zID));
    $ret = $res->fetch(PDO::FETCH_ASSOC);
    $field = makeArray($ret ['field']);
    $zIndex = makeArray($ret ['zIndex']);
    $column = count($field);
    $exSql = "select zID from a_zformulas where zID like '$zID'";
    $exRet = SQL($pdo, $exSql, NULL, 'one');

    $smarty->assign("field", $field);
    $smarty->assign("zIndex", $zIndex);
    $smarty->assign("zName", $ret ['zName']);
    $smarty->assign("zID", $zID);
    $smarty->assign("exRet", $exRet);
}
if ($_POST ['addCol']) {
    $column += $_POST ['addCol'];
}

#循环等到列号
for ($i = 0; $i < $column; $i++) {
    $colName [] = $colStart;
    $colStart++;
}
#每10 就换行
$delmit = 11;
$row = ceil(count($colName) / $delmit);
#变量配置
$smarty->assign("btnName", $btnName);
$smarty->assign("column", $column);
$smarty->assign("colName", $colName);
$smarty->assign("row", $row);
$smarty->assign("delmit", $delmit);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("salaryManage/createNewZFormat.tpl");
?>