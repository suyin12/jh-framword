<?php

/*
 *     2010-8-12
 *          <<< 工资调整,调整社保,商保,互助会等相关费用) >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
$title = "工资表设置";
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
$extraBatch = $_GET['extraBatch'];
if (!$_GET ['month'] || !$_GET ['unitID']) {
    exit("非法网址");
} else {
    #查看该单位是否需要缴交商保
    $valSql = "select pComInsMoney from a_unitInfo where unitID like :unitID";
    $valRet = SQL($pdo, $valSql, array(":unitID" => $unitID), 'one');
    #获取所有工资信息
    if ($extraBatch)
        $sql = "select a.ID,a.uID,a.name,a.pay,a.pSoIns,b.uSoIns,a.pHF,b.uHF,a.pComIns,b.uComIns,a.pSoInsMoney,a.pHFMoney,a.helpCost,a.cardMoney,a.utilities,a.mountGuardStatus as status from a_salary_tmp a left join a_mul_originalFee b on a.uID=b.uID where a.month like :month and a.unitID like :unitID and a.month=b.month and a.unitID=b.unitID and a.extraBatch=b.extraBatch and a.extraBatch='$extraBatch'";
    else
        $sql = "select a.ID,a.uID,a.name,a.pay,a.pSoIns,b.uSoIns,a.pHF,b.uHF,a.pComIns,b.uComIns,a.pSoInsMoney,a.pHFMoney,a.helpCost,a.cardMoney,a.utilities,a.mountGuardStatus as status from a_salary_tmp a left join a_originalFee b on a.uID=b.uID where a.month like :month and a.unitID like :unitID and a.month=b.month and a.unitID=b.unitID and a.extraBatch='0'";
    if ($_POST['search']) {
        unset($_GET ['displayModify']);
        $sql .=" and a.name like '" . trim($_POST['name']) . "%'";
    }
    if ($_GET ['displayModify'] == 'true')
       $sql .= " and a.lastModifyTime<>0";
    $res = $pdo->prepare($sql);
    $res->execute(array(":month" => $month, ":unitID" => $unitID));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $row = $res->rowCount();
    if (!$_POST['name'] && $_GET ['displayModify'] != 'true') {
        foreach ($ret as $rk => $rv) {
            if ($rv ['pSoIns'] != 0 && $rv ['pHF'] != 0 && $rv ['pComIns'] != 0 && $rv['uSoIns'] != 0 && $rv['uHF'] != 0) {
//                 if (matchCHN($rv ['name'])) {
                    unset($ret [$rk]);
//                 }
            }
            if ($valRet ['pComInsMoney'] == 0 && $rv ['pComIns'] == 0 && ( ($rv['uSoIns'] == 0 && $rv['pSoIns'] == 0) || ($rv['uSoIns'] != 0 && $rv['pSoIns'] != 0)) && ( ($rv['uHF'] == 0 && $rv['pHF'] == 0) || ($rv['uHF'] != 0 && $rv['pHF'] != 0))) {
//                 if (matchCHN($rv ['name'])) {
                    unset($ret [$rk]);
//                 }
            }
        }
    }
    $smarty->assign("month", $month);
    $smarty->assign("salaryArr", $ret);
    #模板配置
    $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
    $smarty->display("salaryManage/salaryEdit.tpl");
}
?>