<?php

require_once ('../auth.php');
require_once ('../templateConfig.php');
$title = "分配单位管理权限";

//所有客户经理
$sqlManager = "SELECT `mID`, `mName`,`unitID` FROM `s_user`where `roleID` regexp '2_1,' and status=1";
$rstManager = $pdo->query($sqlManager);
$rowManager = $rstManager->fetchAll(PDO::FETCH_ASSOC);
//所有业务文员
$sqlClerk = "SELECT `mID`, `mName`,`unitID` FROM `s_user`where `roleID` regexp '2_2,' and status=1";
$rstClerk = $pdo->query($sqlClerk);
$rowClerk = $rstClerk->fetchAll(PDO::FETCH_ASSOC);
//所有社保专员
$sqlSoin = "SELECT `mID`, `mName`,`unitID` FROM `s_user`where `roleID` regexp '3_1,' and status=1";
$rstSoin = $pdo->query($sqlSoin);
$rowSoin = $rstSoin->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST["send"])) {
    $adduid = $_GET["unid"];
    $manager = $_POST["rdomanager"];
    $clerk = $_POST["rdoclerk"];
    $soins = $_POST["rdosoins"];
    //echo "经理:".$manager."业务文员:".$clerk."社保专员:".$soins."ID:".$_GET["uid"];
    if ($manager != "") {
        $sqlSTmanager = "SELECT `unitID` FROM `s_user` where `mID`=$manager";
        $rstSTmanager = $pdo->query($sqlSTmanager);
        $rowSTmanager = $rstSTmanager->fetch(PDO::FETCH_ASSOC);
        $unidmanager = $rowSTmanager["unitID"];
        //echo "<br/>业务经理:".$rowSTmanager["unitID"];
        if ($unidmanager != "") {
            $newunidmanager = $unidmanager . "," . $adduid;
        } else {
            $newunidmanager = $adduid;
        }
        $sqlUPmanager = "UPDATE `s_user` SET `unitID` = '$newunidmanager' WHERE `mID` =$manager";
        //echo "<br/>".$sqlUPmanager;
        $affectedManager = $pdo->exec($sqlUPmanager);
    }
    if ($clerk != "") {
        $sqlSTclerk = "SELECT `unitID` FROM `s_user` where `mID`=$clerk";
        $rstSTclerk = $pdo->query($sqlSTclerk);
        $rowSTclerk = $rstSTclerk->fetch(PDO::FETCH_ASSOC);
        $unidclerk = $rowSTclerk["unitID"];
        //echo "<br/>业务文员:".$rowSTclerk["unitID"];
        if ($unidclerk != "") {
            $newunidclerk = $unidclerk . "," . $adduid;
        } else {
            $newunidclerk = $adduid;
        }
        $sqlUPclerk = "UPDATE `s_user` SET `unitID` = '$newunidclerk' WHERE `mID` =$clerk";
        //echo "<br/>".$sqlUPclerk;
        $affectedClerk = $pdo->exec($sqlUPclerk);
    }
    if ($soins != "") {
        $sqlSTsoins = "SELECT `unitID` FROM `s_user` where `mID`=$soins";
        $rstSTsoins = $pdo->query($sqlSTsoins);
        $rowSTsoins = $rstSTsoins->fetch(PDO::FETCH_ASSOC);
        $unidsoins = $rowSTsoins["unitID"];
        //echo "<br/>社保专员:".$rowSTsoins["unitID"];
        if ($unidsoins != "") {
            $newunidsoins = $unidsoins . "," . $adduid;
        } else {
            $newunidsoins = $adduid;
        }
        $sqlUPsoins = "UPDATE `s_user` SET `unitID` = '$newunidsoins' WHERE `mID` =$soins";
        //echo "<br/>".$sqlUPsoins;
        $affectedsoins = $pdo->exec($sqlUPsoins);
    }
    if ($affectedManager) {
        echo "<script>alert('操作成功！');location.href='unitinfo_manager.php';</script>";
    }
}

$smarty->assign("rowManager", $rowManager);
$smarty->assign("rowClerk", $rowClerk);
$smarty->assign("rowSoin", $rowSoin);
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("system/unitinfo_fen.tpl");
?>