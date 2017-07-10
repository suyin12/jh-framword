<?php
/*社保缴交类型的设置及更新*/
require_once '../class/db_class.php';
require_once ('../auth.php');
require_once ('../templateConfig.php');
require_once '../dataFunction/feeExtra.data.php';
$date = date("Ym");
new db($pdo);
$fee=new feeExtra($pdo);

if ($_GET["id"]) {
    $ID = $_GET["id"];
    $sql = "SELECT * FROM `s_soins_set`where `ID`='$ID'";
    $pdostatement = $pdo->query($sql);
    $ret = $pdostatement->fetch(PDO::FETCH_ASSOC);
    foreach ($ret as $k => $v) {
        $smarty->assign($k, $v);
    }
}

if (isset($_POST["edit"])) {
    $bianji = $_POST["edit"];
    switch ($bianji) {
        //修改“社保设置”
        case "modify":
            foreach ($_POST as $key => $val) {
                switch ($key) {
                    case "add":
                    case "edit":
                        break;
                    case "type":
                        break;
                    default :
                        $str .="`" . $key . "`='" . $val . "',";
                        break;
                }
            }
            $str = rtrim($str, ",");
            if($ret["month"]==$date){
            	#存在本月社保缴交比例
            	$sql = "update `s_soIns_set` set " . $str . " where `ID`='$ID' ";
           	 	$affected = $pdo->exec($sql);
            }else{
            	#不存在本月社保缴交比例,1复制之前的缴交比例2修改
            	$arr = $_POST;
            	unset($arr["edit"]);
            	$fee->soInsMonlist("distinct `month`","order by month asc");
				$NewDate=$fee->soInsMon($date);
        		$soInsSet = $fee->soInsSet($NewDate);
        		$re = $fee->soInsSet($date);
            	if(empty($re)){
        			foreach ($soInsSet as $k => $v){
        				$v["month"] = $date;
        				unset($v["ID"]);
        				$re = db::insert("s_soIns_set",$v);
        			}
        			$sql = "update `s_soIns_set` set " . $str . " where `type`='{$_POST['type']}' and `month`='{$date}'";
            		$affected = $pdo->exec($sql);
        		}
            }
            if ($affected) {
                echo "<script>alert('修改成功！'); window.location.href=window.location.href;</script>";
            } else {
                echo "<script>alert('数据未作修改！') ;window.location.href=window.location.href;</script>";
            }
            break;
        case "add":
            foreach ($_POST as $key => $val) {
                switch ($key) {
                    case "add":
                    case "edit":
                        break;
                    default :
                        $str .="`" . $key . "`='" . $val . "',";
                        break;
                }
            }
            $str = rtrim($str, ",");
            $sql = "insert into `s_soIns_set` set " . $str;
            $affected = $pdo->exec($sql);
            $idStr = "id=" . $pdo->lastInsertId();
            if ($affected) {
                echo "<script>alert('添加成功！'); location.href='soIns_edit.php?" . $idStr . "';</script>";
            } else {
                echo "<script>alert('添加失败！请更改类型编号');window.location.href=window.location.href;</script>";
            }
            break;
    }
}
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("system/soIns_edit.tpl");
?>
