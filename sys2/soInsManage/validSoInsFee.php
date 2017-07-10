<?php

/*
 *     2010-6-3
 *          <<<  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#页面标题
#这里要注意一下就是,该页面的GET参数皆由引用该页面的页面提供
$title = "验证缴交明细信息";
$soInsDate = $_GET ['soInsDate'];
#初始化页面信息
$sel = array("" => "--请选择--");
$model = array("name" => "姓名", "uID" => "员工编号", "pID" => "身份证", "sID" => "社保号", "bID" => "工资账号", "dID" => "档案编号");
$model = array_merge($sel, $model);

#获取费用表中的工资账号,及单位信息及姓名..用于匹配当前花名册的员工信息状态
$sql = "select a.ID,a.pID,a.name,a.soInsID from  a_soInsFee_tmp a left join a_workerInfo b on a.pID=b.pID  where a.soInsDate like :soInsDate and b.pID is null";
$res = $pdo->prepare($sql);
$res->execute(array(":soInsDate" => $soInsDate));
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
$wantingCount = $res->rowCount();
if ($wantingCount > 0) {
    foreach ($ret as $key => $val) {
        //		$delStr .= "'".$val['pID']."',";
        $errMsg [] = "花名册中不存在身份证号码为{<a href='".httpPath."soInsManage/soInsFeeDetail.php?soInsDate=".$soInsDate ."&ID=".$val ['ID'] ."' target='_blank'>" . $val ['pID'] . "</a>},且姓名为{<a href='".httpPath."workerInfo/wInfo.php?m=name&c=".$val ['name'] ."' target='_blank'>" . $val ['name'] . "</a>}的员工";
  
    }
} else {
    $sql = "select uID,soInsDate from a_soInsFee_tmp where soInsDate like :soInsDate and uID like ''";
    $res = $pdo->prepare($sql);
    $res->execute(array(":soInsDate" => $soInsDate));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $count = $res->rowCount();
    if ($count > 0) {
        //更新社保缴交明细的员工的员工编号
        $updateSql = "update a_soInsFee_tmp  a,a_workerInfo b set a.uID=b.uID,a.unitID=b.unitID where a.pID=b.pID and a.soInsDate like '$soInsDate'";
        //为防止员工,转派遣,所以还必须更新一遍单位信息
//        $updateSql2 = "update a_soInsFee_tmp a,a_originalFee_tmp b set a.unitID=b.unitID,a.sponsorName='superAdmin' where  a.soInsDate like '$soInsDate' and a.uID=b.uID  and a.unitID != b.unitID and a.soInsDate=b.soInsDate ";
        //更新社保号
        $updateSql3 = "update a_soInsFee_tmp a,a_workerInfo b set b.sID=a.sID where  a.soInsDate like '$soInsDate' and  a.pID=b.pID and a.sID!=b.sID";

        $actionSql = array($updateSql, $updateSql3);
//        $actionSql = array($updateSql, $updateSql2, $updateSql3);
        $res = extraTransaction($pdo, $actionSql);
        if (empty($res['error'])) {
            $result = true;
        } else {
            $errMsg [] = "发生未知错误,请联系管理员<br/>";
        }
    } else {
        $result = true;
    }
}
#配置模板变量
$smarty->assign("errMsg", $errMsg);
$smarty->assign("result", $result);
#配置查询条件
$smarty->assign("actionURL", httpPath . "workerInfo/wInfo.php");
$smarty->assign("m", $model);
$smarty->assign("s_m", $m);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("soInsManage/validSoInsFee.tpl");
?>