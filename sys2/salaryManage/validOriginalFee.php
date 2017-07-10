<?php

/*
 *     2010-5-28
 *          <<< 验证原始费用表的信息,及匹配员工信息 ,这个是致命性错误>>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#通用函数库
require_once '../common.function.php';
#页面标题
#这里要注意一下就是,该页面的GET参数皆由引用该页面的页面提供
$title = "验证原始费用表的员工信息,是否存在";
$unitID = $_GET ['unitID'];
$whatDate = $_GET ["whatDate"];
#初始化页面信息
$sel = array("" => "--请选择--");
$model = array("name" => "姓名", "uID" => "员工编号", "pID" => "身份证", "sID" => "社保号", "bID" => "工资账号", "dID" => "档案编号");
$model = array_merge($sel, $model);

#获取费用表中的工资账号,及单位信息及姓名..用于匹配当前花名册的员工信息状态
switch ($whatDate) {
    case "salaryDate" :
        $month = $_GET ['month'];
        $zID = $_GET['zID'];
         $type = "a=originalFee&";
        $sql = "select spID,bID,unitID,name from a_originalFee_tmp where unitID like :unitID and month like :month and uID like '' ";
        $res = $pdo->prepare($sql);
        $res->execute(array(":unitID" => $unitID, ":month" => $month));
        break;
    case "soInsDate" :
        $soInsDate = $_GET ['soInsDate'];
        $sql = "select bID,unitID,name from a_originalFee_tmp where unitID like :unitID and soInsDate like :soInsDate ";
        $res = $pdo->prepare($sql);
        $res->execute(array(":unitID" => $unitID, ":soInsDate" => $soInsDate));
        break;
    case "mulFee":
        $month = $_GET ['month'];
        $zID = $_GET['zID'];
        $extraBatch = $_GET['extraBatch'];
        $type = "a=mulFee&extraBatch=$extraBatch&";
        $sql = "select spID,bID,unitID,name from a_mul_originalFee_tmp where unitID like :unitID and month like :month and extraBatch=:extraBatch and uID like '' ";
        $res = $pdo->prepare($sql);
        $res->execute(array(":unitID" => $unitID, ":month" => $month, ":extraBatch" => $extraBatch));
        break;
}

$ret = $res->fetchAll(PDO::FETCH_ASSOC);
#获取花名册信息
$wSql = "select uID,unitID,name,bID,spID  from a_workerInfo where unitID like :unitID ";
$wRes = $pdo->prepare($wSql);
$wRes->execute(array(":unitID" => $unitID));
$wRet = $wRes->fetchAll(PDO::FETCH_ASSOC);
#重构数组,bID数组..重构数组的目的是为了降低程序复杂度,可能会减少程序执行时间
//费用表信息数组
foreach ($ret as $key => $val) {
    if ($val ['spID'])
        $bIDArr_Fee [$val ['spID']] = $val ['name'];
    else {
        $nameArr_Fee [] = $val ['name'];
    }
}
//员工信息数组
foreach ($wRet as $wKey => $wVal) {
    if ($wVal ['spID']) {
        //获取有工资账号的人员
        $bIDArr_wInfo [$wVal ['spID']] = $wVal ['name'];
    } else {
        //获取无工资账号的人员姓名,这里是为了判断无工资账号且姓名重复的人
        $repeatNameArr_wInfo [] = $wVal ['name'];
    }
    //name就包括了整个单位的人,同样包括有工资账号的人
    $nameArr_wInfo [] = $wVal ['name'];
}

#验证员工花名册,同一个单位是否出现了同名的情况,同名则报错
if (!$bIDArr_Fee)
    $reCountName = array_count_values($nameArr_wInfo);
else
    $reCountName = array_count_values($repeatNameArr_wInfo);

foreach ($reCountName as $reCNKey => $reCNVal) {
    if ($reCNVal > 1)
        $errMsg [] = "同一个单位中,存在相同姓名{<a href='" . httpPath . "workerInfo/wInfo.php?m=name&c=" . $reCNKey . "' target='_blank'>" . $reCNKey . "</a>}的员工,请修改,使之与费用表中的姓名一致并得以区分";
}
#验证员工花名册中，同一个单位是否出现同名的情况
#验证原始费用表中存在两个同名人员

$reCountFeeName = array_count_values($nameArr_Fee);
foreach ($reCountFeeName as $reCFNKey => $reCFNVal) {
    if ($reCFNVal > 1)
        $errMsg [] = "同一个单位中,原始费用表中存在相同姓名{<a href='" . httpPath . "salaryManage/detail.php?".$type."month=" . $month . "&unitID=$unitID&zID=$zID&m=name&c=$reCFNKey' target='_blank'>" . $reCFNKey . "</a>}的员工,请修改,使之与费用表中的姓名一致并得以区分";
}

#验证有工资账号的在不在花名册中,满足的条件是,姓名及其工资账号必需吻合
if ($bIDArr_Fee) {
    if ($bIDArr_wInfo)
        $bIDErrArr = array_diff_key($bIDArr_Fee, $bIDArr_wInfo);
    else
        $bIDErrArr = $bIDArr_Fee;
}
if ($nameArr_Fee) {
    if ($nameArr_wInfo)
        $nameErrArr = array_diff($nameArr_Fee, $nameArr_wInfo);
    else
        $nameErrArr = $nameArr_Fee;
}

unset($bIDArr_wInfo);
unset($nameArr_wInfo);

if ($bIDErrArr || $nameErrArr) {
    if ($bIDErrArr)
        foreach ($bIDErrArr as $bEKey => $bEVal) {
            $errMsg [] = "花名册中不存在特定编号为{<a href='" . httpPath . "salaryManage/detail.php?".$type."month=" . $month . "&unitID=$unitID&zID=$zID&m=spID&c=$bEKey' target='_blank'>" . $bEKey . "</a>/<a href='" . httpPath . "workerInfo/wInfo.php?m=name&c=" . $bEVal . "' target='_blank'>" . $bEVal . "</a>}或姓名与花名册不匹配";
        }
    if ($nameErrArr)
        foreach ($nameErrArr as $nEKey => $nEVal) {
            $errMsg [] = "花名册中不存在该员工信息{<a href='" . httpPath . "salaryManage/detail.php?".$type."month=" . $month . "&unitID=$unitID&zID=$zID&m=name&c=$nEVal' target='_blank'>" . $nEVal . "</a>}";
        }
} elseif (!$errMsg) {
    switch ($whatDate) {
        case "salaryDate" :
            foreach ($bIDArr_Fee as $bID => $name) {
                $updateSql [] = "update a_originalFee_tmp x , a_workerInfo y set x.uID=y.uID  where x.spID=y.spID and x.month like '$month' and x.unitID='$unitID' and x.spID like '$bID'";
            }
            if ($nameArr_Fee)
                foreach ($nameArr_Fee as $name) {
                    $updateSql [] = "update a_originalFee_tmp x , a_workerInfo y set x.uID=y.uID  where x.name=y.name and x.unitID=y.unitID and x.unitID like '$unitID'  and x.month like '$month'  and x.name like '$name'";
                }
            break;
        case "soInsDate" :
            foreach ($bIDArr_Fee as $bID => $name) {
                $updateSql [] = "update a_originalFee_tmp x , a_workerInfo y set x.uID=y.uID  where x.bID=y.bID and x.soInsDate like '$soInsDate' and x.bID like '$bID'";
            }
            if ($nameArr_Fee)
                foreach ($nameArr_Fee as $name) {
                    $updateSql [] = "update a_originalFee_tmp x , a_workerInfo y set x.uID=y.uID  where x.name=y.name and x.unitID=y.unitID and x.unitID like '$unitID'  and x.soInsDate like '$soInsDate'  and x.name like '$name'";
                }
            break;
        case "mulFee":
            foreach ($bIDArr_Fee as $bID => $name) {
                $updateSql [] = "update a_mul_originalFee_tmp x , a_workerInfo y set x.uID=y.uID  where x.spID=y.spID and x.month like '$month' and x.spID like '$bID'";
            }
            if ($nameArr_Fee)
                foreach ($nameArr_Fee as $name) {
                    $updateSql [] = "update a_mul_originalFee_tmp x , a_workerInfo y set x.uID=y.uID  where x.name=y.name and x.unitID=y.unitID and x.unitID like '$unitID'  and x.month like '$month'  and x.name like '$name'";
                }
            break;
    }
    //		echo "<pre>";
    //		print_r ( $updateSql );
    transaction($pdo, $updateSql);
    $err = $result ['error'];
    $execNum = $result ['num'];
    if (!empty($err)) {
        $errMsg [] = "发生未知错误,请联系管理员<br/>1.可能是原始费用表中存在相同的工资账号";
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
$smarty->display("salaryManage/validOriginalFee.tpl");
?>