<?php
/*
 *  <<<<<社保账号的验证，之后产生社保未审核的流水账支出记录>>>>>
 *
 */
#引用配置文件
require_once 'agMconfig.php';
require_once 'soInsFee_agm.php';
require_once 'bill_agm.php';
require_once 'aInfo_agm.php';
require_once 'latepay_agm.php';
require_once 'lateHF_agm.php';

$latesoins = new latesoins();
$lateHF = new lateHF();
$SoFee=new SoFee();
$bill=new bill();
$aInfo=new aInfo();
$fee=new feeExtra($pdo);
$fee->soInsMonlist("distinct `month`","order by month asc");

#页面标题
#这里要注意一下就是,该页面的GET参数皆由引用该页面的页面提供
$title = "验证缴交明细信息";
$soInsDate = $_GET ['soInsDate'];
$type = $_GET ["type"];
#初始化页面信息
$sel = array("" => "--请选择--");
$model = array("name" => "姓名", "pID" => "身份证", "sID" => "社保号", "dID" => "档案编号");
$model = array_merge($sel, $model);

#获取身份证号及姓名..用于匹配当前花名册的人员信息状态
$sql = "select a.ID,a.pID,a.name,a.soInsID from  d_soInsFee_tmp a left join d_agent_personalinfo b on a.pID=b.pID  where a.soInsDate like :soInsDate and b.pID is null";
$res = $pdo->prepare($sql);
$res->execute(array(":soInsDate" => $soInsDate));
$ret = $res->fetchAll(PDO::FETCH_ASSOC);
$wantingCount = $res->rowCount();
if ($wantingCount > 0) {
    foreach ($ret as $key => $val) {
        //		$delStr .= "'".$val['pID']."',";
        $errMsg [] = "花名册中不存在身份证号码为{<a href='".httpPath."agencyService/soInsAgmDetail.php?soInsDate=".$soInsDate ."&ID=".$val ['ID'] ."' target='_blank'>" . $val ['pID'] . "</a>},且姓名为{<a href='".httpPath."agencyService/agencyManage.php?m=name&c=".$val ['name'] ."' target='_blank'>" . $val ['name'] . "</a>}的员工";

    }
} else {
    $sql = "select `fID`,`total`,`soInsDate` from d_soInsFee_tmp where soInsDate like :soInsDate and dID like '' and type='{$type}'";
    $res = $pdo->prepare($sql);
    $res->execute(array(":soInsDate" => $soInsDate));
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $count = $res->rowCount();
    if ($count > 0) {
        //更新社保缴交明细里的人的档案编号
        $updateSql = "update d_soInsFee_tmp a,d_agent_personalinfo b set a.fID=b.id,a.dID=b.dID where a.pID=b.pID and a.soInsDate like '$soInsDate'";
        //更新社保号
        $updateSql3 = "update d_soInsFee_tmp a,d_agent_personalinfo b set b.sID=a.sID where  a.soInsDate like '$soInsDate' and  a.pID=b.pID and a.sID!=b.sID";
        $actionSql = array($updateSql, $updateSql3);
        $res = extraTransaction($pdo, $actionSql);
        if (empty($res['error'])) {
            $result = true;
		    #产生缴交流水账
		    $where="where soInsDate='{$soInsDate}' and type='{$type}'";
		    $totalAll=$SoFee->getTotalByDate($where,"`fID`,`total`,`soInsDate`");
		    $billArr=$bill->getArr("2",$soInsDate);
		    foreach ($totalAll as $k =>$v){
		    	$cost=$aInfo->getPlByfID($v["fID"],"`managementCost`,`PDIns`");
		    	if($type=="1"){
		    		if($cost["managementCost"]>0){
						if(empty($billArr[$v["fID"]]["GuanLi"])){
							$bill->expenditure2(array("fID"=>$v["fID"],"total"=>$cost["managementCost"]),"管理费支出","3",$soInsDate);
						}
					}
					if($cost["PDIns"]=="1"){
						$PDIns=$fee->soInsFun("PDIns",$soInsDate);
						if(empty($billArr[$v["fID"]]["PDIns"])){
							$bill->expenditure(array("fID"=>$v["fID"],"total"=>$PDIns),"产生残障金","4",$soInsDate);
						}
					}
		    		if(empty($billArr[$v["fID"]]["soIns"])){
			    		$bill->expenditure($v,"产生社保费","1",$v["soInsDate"]);
			    	}
    			}
    			if($type=="2"){
    				#补缴管理费社保+公积金=合计
	    			$lateListArr = $latesoins->getListByfID($v['fID'],$soInsDate);
	    			$TsoinsArr = $latesoins->TotalsoinsArr($lateListArr,$soInsDate);
	    			$lateTotal = $TsoinsArr["latepay"] + $TsoinsArr["basicPension"];
	    			$Tsoins = $TsoinsArr["latemanagementCost"];
					$lateHFListArr = $lateHF->getListByfID($v['fID'],$soInsDate);
					$THFArr = $lateHF->TotalHFArr($lateHFListArr,$soInsDate);
					$THF = $THFArr["latemanagementCost"];
					$lateCostTotal = $Tsoins + $THF;
	    			if($lateCostTotal>0){
						if(empty($billArr[$v["fID"]]["lateGuanLi"])){
							$bill->expenditure2(array("fID"=>$v["fID"],"total"=>$lateCostTotal),"管理费支出","6",$soInsDate);
						}
					}
    				if(empty($billArr[$v["fID"]]["latesoIns"])){
    					$bill->expenditure(array("fID"=>$v["fID"],"total"=>$lateTotal),"补缴社保费","5",$soInsDate);
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