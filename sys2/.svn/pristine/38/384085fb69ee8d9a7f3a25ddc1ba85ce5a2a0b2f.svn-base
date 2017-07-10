<?php
/*
 *  <<<<<公积金账号的验证，之后产生社保未审核的流水账支出记录>>>>>
 *     
 */
#引用配置文件
require_once 'agMconfig.php';
require_once 'soInsFee_agm.php';
require_once 'bill_agm.php';
require_once 'aInfo_agm.php';
require_once 'latepay_agm.php';
require_once 'lateHF_agm.php';
require_once 'hfFee_agm.php';

$latesoins = new latesoins();
$lateHF = new lateHF();
$HFFee=new HFFee();
$SoFee=new SoFee();
$bill=new bill();
$aInfo=new aInfo();
$fee=new feeExtra($pdo);
$fee->soInsMonlist("distinct `month`","order by month asc");
#页面标题
#这里要注意一下就是,该页面的GET参数皆由引用该页面的页面提供
$title = "验证缴交明细信息";
$HFDate = $_GET ['HFDate'];
#初始化页面信息
$sel = array("" => "--请选择--");
$model = array("name" => "姓名", "pID" => "身份证", "HFID" => "公积金号", "dID" => "档案编号");
$model = array_merge($sel, $model);

#获取费用表中的工资账号,及单位信息及姓名..用于匹配当前花名册的员工信息状态
$sql = "select a.ID,a.pID,a.name from  d_hffee_tmp a left join d_agent_personalinfo b on a.pID=b.pID  where a.HFDate like :HFDate and b.pID is null";
$res = $pdo->prepare($sql);
$res->execute(array(":HFDate" => $HFDate));
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
$wantingCount = $res->rowCount();
if ($wantingCount > 0) {
    foreach ($ret as $key => $val) {
        //		$delStr .= "'".$val['pID']."',";
        $errMsg [] = "花名册中不存在身份证号码为{<a href='".httpPath."agencyService/soInsAgmDetail.php?HFDate=".$HFDate ."&ID=".$val ['ID'] ."' target='_blank'>" . $val ['pID'] . "</a>},且姓名为{<a href='".httpPath."agencyService/agencyManage?m=name&c=".$val ['name'] ."' target='_blank'>" . $val ['name'] . "</a>}的员工";

    }
} else {
    $sql = "select `fID`,`total`,`HFDate` from d_hffee_tmp where HFDate like :HFDate and dID like ''";
    $res = $pdo->prepare($sql);
    $res->execute(array(":HFDate" => $HFDate));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $count = $res->rowCount();
    if ($count > 0) {
        //更新社保缴交明细里的人的档案编号
        $updateSql = "update d_hffee_tmp a,d_agent_personalinfo b set a.fID=b.id,a.dID=b.dID where a.pID=b.pID and a.HFDate like '$HFDate'";
        //更新社保号
        $updateSql3 = "update d_hffee_tmp a,d_agent_personalinfo b set b.HFID=a.HFID where  a.HFDate like '$HFDate' and  a.pID=b.pID and a.HFID!=b.HFID";
        $actionSql = array($updateSql, $updateSql3);
        $res = extraTransaction($pdo, $actionSql);
        if (empty($res['error'])) {
            $result = true;
		    #产生缴交流水账
		    $where="where HFDate='{$HFDate}'"; 
		    $totalAll=$HFFee->getTotalByDate($where,"`fID`,`total`,`HFDate`");
		    $billArr=$bill->getArr("2",$HFDate);
		    foreach ($totalAll as $k =>$v){
		    	#补缴管理费社保+公积金=合计
    			$lateListArr = $latesoins->getListByfID($v['fID'],$HFDate);
    			$TsoinsArr = $latesoins->TotalsoinsArr($lateListArr);
    			$Tsoins = $TsoinsArr["latemanagementCost"];
				$lateHFListArr = $lateHF->getListByfID($v['fID'],$HFDate);
				$THFArr = $lateHF->TotalHFArr($lateHFListArr);
				$THF = $THFArr["latemanagementCost"];
				$lateCostTotal = $Tsoins + $THF;
		    	
		    	$cost=$aInfo->getPlByfID($v["fID"],"`managementCost`");
		    	if($cost["managementCost"]>0){
					if(empty($billArr[$v["fID"]]["GuanLi"])){
						$bill->expenditure2(array("fID"=>$v["fID"],"total"=>$cost["managementCost"]),"管理费支出","3",$v["HFDate"]);
					}
				}
				if(empty($billArr[$v["fID"]]["HF"])){
					$bill->expenditure($v,"产生公积金","2",$v["HFDate"]);
				}
		    	
		    	if($lateCostTotal>0){
					if(empty($billArr[$v["fID"]]["lateGuanLi"])){
						$bill->expenditure2(array("fID"=>$v["fID"],"total"=>$lateCostTotal),"管理费支出","6",$HFDate);
					}
				}
    		}
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
$smarty->assign("actionURL", httpPath . "agencyService/agencyManage.php");
$smarty->assign("m", $model);
$smarty->assign("s_m", $m);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/validSoInsAgm.tpl");
?>