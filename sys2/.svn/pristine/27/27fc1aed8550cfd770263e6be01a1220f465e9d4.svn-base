<?php

/*
 *     2011-1-11
 *          <<<生成台账
 *                说明下, 这里的台账呢, 是一个历史数据的统计,要验证费用表是否已经审核通过,才允许如台账,
 *                还有要说明的就是, 因为现在费用表部分有一些相关费用是有特殊情况的, 所以可能台账这里要分为
 *                收入跟支出, 也就是说,这边也是要有公式的..不懂了, 先晾一下
 *                
 *                切记,累计挂账/欠款等,一定是每条记录都要有的
 *                首先需要验证,是否还有没有平账数据,本人费用调整,他人费用调整,整体冲减挂账,明细冲减费用等费用还未处理...
 *            >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#链接相应的客户经理,单位数据文件
require_once sysPath . 'dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
#工资费用相关类
require_once sysPath . "dataFunction/salaryFee.data.php";
#累计欠挂相关类
require_once sysPath . 'dataFunction/money.data.php';
#用工单位社保\公积金\商保等实际缴交金额
require_once sysPath . 'dataFunction/Insurance.data.php';
#连接模板文件
require_once sysPath . 'dataFunction/wInfo.data.php';
#标题
$title = "台账";
$unitID = $_GET ['unitID'];
$month = $_GET ['month'];
$extraBatch = '0';
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1","","1");
$j_unitManager = json_encode($unitManager);
#验证本月的审批是否已经完成,包括明细冲减,整体冲减,费用表及工资表审批
$validAppSql = "select * from `a_valid_approval_finished` where `unitID` like :unitID and `month` like :month and `approvalType` not in ('dimissionSalary')";
$validAppRet = SQL($pdo, $validAppSql, array(":unitID" => $unitID, ":month" => $month));
$validApproval = 0;
if ($validAppRet) {
    foreach ($validAppRet as $val) {
        if ($val ['status'] == 0)
            $validApproval = 1;
    }
} else {
    $validApproval = 1;
}
#生成单位ID
if ($_GET ['mID']) {
    $mID = $_GET ['mID'];
    foreach ($unitManager as $uValue) {
        if ($uValue ['mID'] == $mID) {
            foreach ($uValue ['unit'] as $uV) {
                $sqlV .= "'" . $uV ['unitID'] . "',";
            }
        }
    }
    $sqlV = rtrim($sqlV, ",");
    if ($_GET ['unitID']) {
        $unitID = $_GET ['unitID'];
        $sqlUnit .= " and a.unitID like '$unitID' ";
    } else
        $sqlUnit .= " and a.unitID in(" . $sqlV . ")";
} else {
    if (!$_GET ['wCS'])
        $mID = $_SESSION ['exp_user'] ['mID'];
}
//遍历客户经理,单位数组
foreach ($unitManager as $um_v) {
    foreach ($um_v as $um_v_k => $um_v_v) {
        if ($um_v ['mID'] == $mID) {
            //构造get后,单位数组
            $um [0] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName'], "unit" => $um_v ['unit']);
        } else {
            //构造get后,单位数组,除get外其余的客户经理
            $um_m[$um_v['mID']] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName']);
        }
    }
}
//构造get后,单位数组

if ($um) {
    $um = array_merge($um, $um_m);
    $smarty->assign("unitManager", $um);
} else {
    $smarty->assign("unitManager", $unitManager);
}
//获取各种公式..
#这里重新修改过,设置公式,可以每月的公式都不一样,
$formulasSql = " select * from `a_zFormulas` where `month`='$month' and `unitID`='$unitID' ";
$formulasRet = SQL($pdo, $formulasSql, null, 'one');
if ($formulasRet ['ID']) {
    $formulasStr = array("zID" => $zID, "sIncome" => $formulasRet ['sIncomeFormulas'], "sExpenditure" => $formulasRet ['sExpenditureFormulas'], "sOtherFee" => $formulasRet ['sOtherFeeFormulas'], "pSoIns" => "(pPension+pHospitalization)", "pComIns" => "pComIns", "utilities" => "utilities");
    $smarty->assign("formulasID", $formulasRet ['ID']);
}
//求得台账相关的所有列
if ($formulasStr ['sIncome']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['sIncome'], $sIncomeStr);
    $sIncomeFormulas = strToPHP($formulasStr ['sIncome']);
    foreach ($sIncomeStr [0] as $val) {
        $selStr .= ",sum(`$val`) as $val";
    }
}
//这里就获得了应发工资的字符串了..再EVAL 一下..就可以转成PHP代码进行运算了
if ($formulasStr ['sExpenditure']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['sExpenditure'], $sExpenditureStr);
    $sExpenditureFormulas = strToPHP($formulasStr ['sExpenditure']);
    foreach ($sExpenditureStr [0] as $val) {
        $selStr .= ",sum(`$val`) as $val";
    }
}
if ($formulasStr ['sOtherFee']) {
    preg_match_all("/[a-zA-Z]+/", $formulasStr ['sOtherFee'], $sOtherFeeStr);
    $sOtherFeeFormulas = strToPHP($formulasStr ['sOtherFee']);
    foreach ($sOtherFeeStr [0] as $val) {
        $selStr .= ",sum(`$val`) as $val";
    }
}
#在这里还是先赋值变量,免得底下会变动
$smarty->assign("formulasStr", $formulasStr);
#验证是否有存在需要生成台账的数据,或者只存在确认后的历史数据
$exSql = "select zID,uID,month from `a_originalFee` where `confirmStatus` !='1' and `unitID`=:unitID order by ID limit 1";
$exRet = SQL($pdo, $exSql, array(":unitID" => $unitID), 'one');
if ($exRet ['month']) {
    $month = $exRet ['month'];
    if (!$_GET ['month'])
        header("location:" . httpPath . "leader/ledger.php?" . $_SERVER ['QUERY_STRING'] . "&month=$month");

    #获取重复的项
    if ($sIncomeStr [0] and $sExpenditureStr [0]) {
        $repeatFieldTmp = array_intersect($sIncomeStr [0], $sExpenditureStr [0]);
        if ($repeatFieldTmp) {
            foreach ($repeatFieldTmp as $rv) {
                $repeatField [$rv] ['sIncome'] = $rv . "1";
                $repeatField [$rv] ['sExpenditure'] = $rv . "2";
                $formulasStr ['sIncome'] = replaceStr($formulasStr ['sIncome'], array($rv => $rv . "1"));
                $formulasStr ['sExpenditure'] = replaceStr($formulasStr ['sExpenditure'], array($rv => $rv . "2"));
            }
            unset($repeatFieldTmp);
            $sIncomeFormulas = strToPHP($formulasStr ['sIncome']);
            $sExpenditureFormulas = strToPHP($formulasStr ['sExpenditure']);
        }
    }
    if ($sOtherFeeStr [0] and $sExpenditureStr [0]) {
        $repeatFieldTmp = array_intersect($sOtherFeeStr [0], $sExpenditureStr [0]);
        if ($repeatFieldTmp) {
            foreach ($repeatFieldTmp as $rv) {
                $repeatField [$rv] ['sExpenditure'] = $rv . "2";
                $repeatField [$rv] ['sOtherFee'] = $rv . "3";
                $formulasStr ['sExpenditure'] = replaceStr($formulasStr ['sExpenditure'], array($rv => $rv . "2"));
                $formulasStr ['sOtherFee'] = replaceStr($formulasStr ['sOtherFee'], array($rv => $rv . "3"));
            }
            unset($repeatFieldTmp);
            $sExpenditureFormulas = strToPHP($formulasStr ['sExpenditure']);
            $sOtherFeeFormulas = strToPHP($formulasStr ['sOtherFee']);
        }
    }
    if ($sIncomeStr [0] and $sOtherFeeStr [0]) {
        $repeatFieldTmp = array_intersect($sIncomeStr [0], $sOtherFeeStr [0]);
        if ($repeatFieldTmp) {
            foreach ($repeatFieldTmp as $rv) {
                $repeatField [$rv] ['sIncome'] = $rv . "1";
                $repeatField [$rv] ['sOtherFee'] = $rv . "3";
                $formulasStr ['sIncome'] = replaceStr($formulasStr ['sIncome'], array($rv => $rv . "1"));
                $formulasStr ['sOtherFee'] = replaceStr($formulasStr ['sOtherFee'], array($rv => $rv . "3"));
            }
            unset($repeatFieldTmp);
            $sIncomeFormulas = strToPHP($formulasStr ['sIncome']);
            $sOtherFeeFormulas = strToPHP($formulasStr ['sOtherFee']);
        }
    }
    if ($validApproval == 0) {
        #首先更新a_prsRequireMoney表中那些status ='0'的记录,如 欠款status='1'则表示已经归还欠款
        #再者,这句更新语句是更新所有 a_prsRequireMoney中的type in(2,3) 且 status in ('0','1') ,这是因为担心有某处不小心把status更新成'1',但实际并没有收回欠款
        $needupSql = "select x.ID from `a_prsRequireMoney` x,(select uID from a_prsRequireMoney where `type` in ('2','3') and `unitID` like :unitID and `month`<= :month and status=0
	                group by uID HAVING (sum(uPDInsMoney) =0 and sum(uSoInsMoney) =0 and sum(pSoInsMoney)=0  and sum(pHFMoney)=0 and sum(uHFMoney)=0   and sum(uComInsMoney) =0 and sum(pComInsMoney)=0 and 
	                sum(managementCostMoney)=0 and sum(uOtherMoney) =0 and sum(salaryMoney)=0 and sum(soInsCardMoney)=0 and sum(residentCardMoney)=0)) y where x.type in ('2','3') and x.month<=:month and x.uID=y.uID and x.`status`='0' ";
        $needupRet = SQL($pdo, $needupSql, array(":unitID" => $unitID, ":month" => $month));
        if ($needupRet) {
            foreach ($needupRet as $nuVal) {
                $upIDStr .= $nuVal ['ID'] . ',';
            }
            $upIDStr = rtrim($upIDStr, ",");
            $upSql = "update `a_prsRequireMoney` set status='1' where ID in ($upIDStr)";
            $needDelSql = "delete from  `a_ledger_prsReMoney_tmp` where `month`='$month' and `unitID`='$unitID' and `ledgerType`='1'";
            $needInSql = "insert into `a_ledger_prsReMoney_tmp` set `month`='$month',`unitID`='$unitID',`ledgerType`='1',`prsReID`='$upIDStr' ";
            $needSql = array($upSql, $needDelSql, $needInSql);
            $rt = extraTransaction($pdo, $needSql);
            if ($rt ['error'])
                exit($rt ['error']);
        }
    }
    $zID = $exRet ['zID'];
    $engToChsArr = engTochs();
    //现在没把公式都移植到 a_zFormulas的表中, 过后再来改吧
    $formulasSql = " select a.zID,a.field,a.zIndex,b.* from `a_zformatinfo` a left join `a_zFormulas` b on a.zID=b.zID where a.`zID` = '$zID' and b.`month`='$month' and b.`unitID`='$unitID'";
    $formulasRes = $pdo->query($formulasSql);
    $formulasRet = $formulasRes->fetch(PDO::FETCH_ASSOC);
    $fieldArr = makeArray($formulasRet ['field']);
    $zIndex = makeArray($formulasRet ['zIndex']);
    $zIndex = array_flip($zIndex);
    preg_match_all("/[a-zA-Z]+/", $formulasRet ['totalFeeFormulas'], $totalFeeStr);
    preg_match_all("/[a-zA-Z]+/", $formulasRet ['acheiveFormulas'], $acheiveStr);
    //获取可以用于设置公式的项目
    $needArr = mergeArray($totalFeeStr [0], $acheiveStr [0]);
    foreach ($fieldArr as $key => $val) {
        if (array_key_exists($key, $zIndex)) {
            $key = $zIndex [$key];
            $val = $engToChsArr [$key];
        }

        if (!empty($needArr) && in_array($key, $needArr)) {
            $newFieldArr [$key] = $val;
            $formulasChart [$key] = $val . "(" . $key . ")";
        }
    }
    #设置公式所需要的代号
    if ($formulasChart) {
        $formulasChart = array("+" => "+ (加)", "-" => "- (减)", "/" => "/ (除)", "*" => "* (乘)", "(" => "( (左括号)", ")" => ")(右括号)") + $formulasChart;
        $i = 0;
        $formulasChartStr .= "<tr>";
        foreach ($formulasChart as $chartKey => $chart) {
            if ($i % 10 == 0 && $i != 0)
                $formulasChartStr .= "</tr><tr>";
            $i++;
            $formulasChartStr .= "<td>";
            $formulasChartStr .= "<a  id='$chartKey' class='chart'>$chart</a>";
            $formulasChartstr .= "</td>";
        }
        $formulasChartStr .= "</tr>";
    }
    #获取实收的单位费用
    $s = new salaryFee();
    $s->pdo = $pdo;
    $s->month = $month;
    $s->unitID = $unitID;
    $ofR = $s->BFeeTotal(null, "feeTmp");
    //#获取工资表,奖金表明细数组(注:该数组是有对应显示顺序的...所以这里也要注意一下先后顺序)
   	$exRet = $s->basicRet("fee");
    $exRet_r = $s->basicRet("reward");
    $exRet = $s->feeSum($exRet);
    $exRet_r = $s->feeSum($exRet_r);
    //多次工资的单位挂账及收回垫付款
    $exRet_m = $s->basicRet("mulFee");
    $exRet_m = $s->feeSum($exRet_m);
    
    #获取需要本月的欠挂数据
    $m = new money();
    $m->pdo = $pdo;
    $m->month = $month;
    $m->unitID = $unitID;
    $m->extraBatch="all";
    #获取该月所有欠挂账的合计数
    $prsReRetTmp = $m->curMonthTotal();
    foreach($prsReRetTmp as $psKey=> $psVal){
        foreach($psVal as $psk=>$psv){
            $psk=$psk."Sum";
            $prsReRet[$psKey][$psk]=$psv;
        }
    }

    #获取该月实际缴交金额
    $t = new Insurance();
    $t->pdo = $pdo;
    $t->unitID = $unitID;
    $soInsRet = $t->sumTotal('soIns',$exRet['soInsDate']);
	$HFRet = $t->sumTotal('HF',$exRet['HFDate']);

    if ($soInsRet ['pTotal'] == 0 && $soInsRet ['uTotal'] == 0) {
        $msg = "<script>alert('系统中未导入[ " . $exRet ['soInsDate'] . "社保缴交明细 ],请核实');</script>";
    }else {
        #获取本月商保缴交明细
        $comInsRet = $t->sumTotal('comIns',"Com.{$exRet['comInsDate']}");
        #公司挂账
        $cASql = "select sum(uPDInsMoney) as uPDInsCA,sum(uSoInsMoney) as uSoInsCA ,sum(pSoInsMoney) as pSoInsCA,sum(uHFMoney) as uHFCA ,sum(pHFMoney) as pHFCA,sum(uComInsMoney) as uComInsCA,sum(pComInsMoney) as pComInsCA,sum(managementCostMoney) as mCostCA,sum( pOtherMoney+uOtherMoney) as otherCA  from a_cAccountList where month like :month and unitID like :unitID";
        $cARet = SQL($pdo, $cASql, array(":unitID" => $unitID, "month" => $month), 'one');
        #上月累计挂账/欠款
        $sumMoneySql = "select uSoInsAccountSum,uHFAccountSum,uComInsAccountSum,salaryAccountSum,uAccountSTSum,soInsMoneySum,HFMoneySum,comInsMoneySum,salaryMoneySum,mCostMoneySum from a_ledger where  ID=(select max(ID) as maxID from a_ledger where unitID like :unitID)";
        $sumMoneyRet = SQL($pdo, $sumMoneySql, array(":unitID" => $unitID), 'one');
        #获取本月是否存在整体冲减挂账记录,如果存在则a_ledger表中也存在相应的冲减挂账记录(未出台账前是没有加上明细部分,出了台账后就要包括整体和明细两部分)
        $wholeWDSql = "select  wholeWD,field from a_uwritedownList where `confirmStatus`='1' and `month` like :month and `unitID` like :unitID and type='1' and extraBatch='0'";
        $wholeWDRet = SQL($pdo, $wholeWDSql, array(":unitID" => $unitID, "month" => $month), 'one');
        $WDFieldArrTmp = null;
        $WDFieldArrTmp = explode("|", $wholeWDRet ['field']);
        $WDFieldArrTmp = array_filter($WDFieldArrTmp);
        if (!empty($WDFieldArrTmp)) {
            //按此序列进行冲减优先uSoInsAccountSum
            $orderFiledArr = array('uAccountSTSum', 'salaryAccountSum', 'uSoInsAccountSum', 'uHFAccountSum', 'uComInsAccountSum');
            foreach ($orderFiledArr as $orderKey => $orderVal) {
                if ($WDFieldArrTmp and in_array($orderVal, $WDFieldArrTmp))
                    $WDFieldArr [$orderKey] = $orderVal;
            }

            foreach ($WDFieldArr as $WDFieldKey => $WDFieldVal) {
                $WDSubject [$WDFieldVal] = $sumMoneyRet [$WDFieldVal];
            }
            $newSumMoneyRet = recursionSub($WDSubject, $wholeWDRet ['wholeWD']);
        }
        #[ 这里包括了社保,公积金两部分平账  ]本月社保/公积金平账造成的欠款和挂账,
        //$balFeeSql = "select sum(uPDInsMoney) as uPDInsBF,sum(uSoInsMoney) as uSoInsBF ,sum(pSoInsMoney) as pSoInsBF,sum(uHFMoney) as uHFBF ,sum(pHFMoney) as pHFBF,sum(uComInsMoney) as uComInsBF,sum(managementCostMoney) as mCostBF from a_editAccountList where month like :month and unitID like :unitID and type in ('5','6')";
        //$balFeeRet = SQL($pdo, $balFeeSql, array(":unitID" => $unitID, "month" => $month), 'one');
        $fVal = $s->sumTotal($exRet,$exRet_r,$exRet_m);
        //冲减挂账
        $WDMoney = $wholeWDRet ['wholeWD'] + $prsReRet ['4'] ['uPDInsMoneySum'] + $prsReRet ['4'] ['uSoInsMoneySum'] + $prsReRet ['4'] ['pSoInsMoney'] + $prsReRet ['4'] ['uHFMoneySum'] + $prsReRet ['4'] ['pHFMoneySum'] + $prsReRet ['4'] ['uComInsMoneySum'] + $prsReRet ['4'] ['pComInsMoneySum'] + $prsReRet ['4'] ['managementCostMoneySum'] + $prsReRet ['4'] ['uOtherMoneySum'] + $prsReRet ['4'] ['pOtherMoneySum'];
        $fVal ['WDMoney'] = $WDMoney;
        $fVal ['mCostNum'] = $pdo->query("select uID from `a_originalFee` where  `unitID`='$unitID' and `month`='$month' and `managementCost`!='0'")->rowCount();
        #构造输出的数组收入(注:新加入奖金部分)
        $fVal = $s->ex_arr($fVal);
        $w = new wInfo();
        $w->pdo = $pdo;
        $num = $w->wInfoNum("sum(1) as num","`unitID`={$unitID} and `status`!='0'");
        $fVal['num'] = $num['num'];
        $fVal ['managementCost'] += $prsReRet ['3'] ['managementCostMoneySum'];
        $fVal ['uPDInsS'] += $prsReRet ['3'] ['uPDInsMoneySum'];
        $fVal ['uSoInsMoneyRe'] = $prsReRet ['3'] ['uSoInsMoneySum'];
        $fVal ['uHFMoneyRe'] = $prsReRet ['3'] ['uHFMoneySum'];
        $fVal ['uComInsMoneyRe'] = $prsReRet ['3'] ['uComInsMoneySum'];
        $fVal ['uMCostMoneyRe'] = $prsReRet ['3'] ['managementCostMoneySum'];
        $fVal ['uSalaryMoneyRe'] = $exRet['advanceMoney'] + $exRet_m['advanceMoney'];
        $fVal ['uAccountSp'] = $prsReRet ['1'] ['uAccountSum'] + $exRet_m['uAccount'];
        if ($sIncomeStr) {
            foreach ($sIncomeStr [0] as $val) {
                if (array_key_exists($val, $repeatField))
                    $fVal [$repeatField [$val] ['sIncome']] = $exRet [$val];
                else
                    $fVal [$val] = $exRet [$val];
            }
            @eval('$otherSIncome=' . $sIncomeFormulas . ";");
        }
        $fVal ['sIncomeTotal'] = $fVal ['salaryS'] + $fVal ['managementCost'] + $fVal ['uPDInsS'] + $fVal ['uSoInsS'] + $fVal ['uHFS'] + $fVal ['uComInsS'] + $fVal ['uSoInsMoneyRe'] + $fVal ['uHFMoneyRe'] + $fVal ['uComInsMoneyRe'] + $fVal ['uMCostMoneyRe'] + $fVal ['uSalaryMoneyRe'] + $fVal ['uAccountSp'] + $otherSIncome;
        #支出
        $fVal ['salaryR'] = $exRet ['acheive']+$exRet_m['acheive']+$exRet_r['acheive'];
        $fVal ['soInsR'] = $soInsRet ['pTotal'] + $soInsRet ['uTotal'];
        $fVal ['HFR'] = $HFRet ['pTotal'] + $HFRet ['uTotal'];
        $fVal ['comInsR'] = $comInsRet ['comInsR'];
        $fVal ['pTax'] = $exRet ['pTax']+$exRet_m['pTax']+$exRet_r['pTax'];
        $fVal ['utilities'] = $exRet ['utilities'];
        $fVal ['cardsCost'] = $exRet ['cardMoney'];
        
        $fVal ['otherExpenditure'] = null;
        if ($sExpenditureStr) {
            foreach ($sExpenditureStr [0] as $val) {
                if (array_key_exists($val, $repeatField))
                    $fVal [$repeatField [$val] ['sExpenditure']] = $exRet [$val];
                else
                    $fVal [$val] = $exRet [$val];
            }
            eval('$otherSExpenditure=' . $sExpenditureFormulas . ";");
        }
        $fVal ['sExpenditureTotal'] = $fVal ['salaryR'] + $fVal ['soInsR'] + $fVal ['HFR'] + $fVal ['comInsR'] + $fVal ['pTax'] + $fVal ['utilities'] + $fVal ['cardsCost'] + $fVal ['otherExpenditure'] + $otherSExpenditure;
        $fVal ['helpCost'] = $exRet ['helpCost'];
        $fVal ['soInsBal'] = $fVal ['uSoInsS'] + $fVal ['pSoInsS'] - $fVal ['soInsR'];
        $fVal ['HFBal'] = $fVal ['uHFS'] + $fVal ['pHFS'] - $fVal ['HFR'];
        $fVal ['comInsBal'] = $fVal ['uComInsS'] + $fVal ['pComInsS'] - $fVal ['comInsR'];
        $fVal ['uOtherAccount'] = $fVal ['uAccountSp'];
        if ($sOtherFeeStr) {
            foreach ($sOtherFeeStr [0] as $val) {
                if (array_key_exists($val, $repeatField))
                    $fVal [$repeatField [$val] ['sOtherFee']] = $exRet [$val];
                else
                    $fVal [$val] = $exRet [$val];
            }
            eval('$sOtherFee=' . $sOtherFeeFormulas . ";");
        }
        $fVal ['pSoInsMoneyRe'] = $prsReRet ['3'] ['pSoInsMoneySum'];
        $fVal ['pHFMoneyRe'] = $prsReRet ['3'] ['pHFMoneySum'];
        $fVal ['pComInsMoneyRe'] = $prsReRet ['3'] ['pComInsMoneySum'];
        $fVal ['soInsCA'] = $cARet ['uSoInsCA'] + $cARet ['pSoInsCA'] + $cARet ['uPDInsCA'];
        $fVal ['HFCA'] = $cARet ['uHFCA'] + $cARet ['pHFCA'];
        $fVal ['comInsCA'] = $cARet ['uComInsCA'] + $cARet ['pComInsCA'];
        $fVal ['salaryCA'] = null;
        $fVal ['cATotal'] = $fVal ['soInsCA'] + $fVal ['HFCA'] + $fVal ['comInsCA'] + $fVal ['salaryCA'];
        #挂账
        $fVal ['uSoInsAccount'] = $prsReRet ['1'] ['uSoInsMoneySum'];
        if (!is_null($newSumMoneyRet ['uSoInsAccountSum']))
            $fVal ['uSoInsAccountSum'] = ($newSumMoneyRet ['uSoInsAccountSum'] + $fVal ['uSoInsAccount'] - $prsReRet ['4'] ['uSoInsMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($newSumMoneyRet ['uSoInsAccountSum'] + $fVal ['uSoInsAccount'] - $prsReRet ['4'] ['uSoInsMoneySum']);
        else
            $fVal ['uSoInsAccountSum'] = ($sumMoneyRet ['uSoInsAccountSum'] + $fVal ['uSoInsAccount'] - $prsReRet ['4'] ['uSoInsMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['uSoInsAccountSum'] + $fVal ['uSoInsAccount'] - $prsReRet ['4'] ['uSoInsMoneySum']);
        $fVal ['pSoInsAccount'] = $prsReRet ['1'] ['pSoInsMoneySum'];
        $fVal ['uHFAccount'] = $prsReRet ['1'] ['uHFMoneySum'];
        if (!is_null($newSumMoneyRet ['uHFAccountSum']))
            $fVal ['uHFAccountSum'] = ($newSumMoneyRet ['uHFAccountSum'] + $fVal ['uHFAccount'] - $prsReRet ['4'] ['uHFMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($newSumMoneyRet ['uHFAccountSum'] + $fVal ['uHFAccount'] - $prsReRet ['4'] ['uHFMoneySum']);
        else
            $fVal ['uHFAccountSum'] = ($sumMoneyRet ['uHFAccountSum'] + $fVal ['uHFAccount'] - $prsReRet ['4'] ['uHFMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['uHFAccountSum'] + $fVal ['uHFAccount'] - $prsReRet ['4'] ['uHFMoneySum']);
        $fVal ['pHFAccount'] = $prsReRet ['1'] ['pHFMoneySum'];
        $fVal ['uComInsAccount'] = $prsReRet ['1'] ['uComInsMoneySum'];
        if (!is_null($newSumMoneyRet ['uComInsAccountSum']))
            $fVal ['uComInsAccountSum'] = ($newSumMoneyRet ['uComInsAccountSum'] + $fVal ['uComInsAccount'] - $prsReRet ['4'] ['uComInsMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($newSumMoneyRet ['uComInsAccountSum'] + $fVal ['uComInsAccount'] - $prsReRet ['4'] ['uComInsMoneySum']);
        else
            $fVal ['uComInsAccountSum'] = ($sumMoneyRet ['uComInsAccountSum'] + $fVal ['uComInsAccount']) < 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['uComInsAccountSum'] + $fVal ['uComInsAccount'] );
        $fVal ['pComInsAccount'] = $prsReRet ['1'] ['pComInsMoneySum'];
        $fVal ['salaryAccount'] = $prsReRet ['1'] ['salaryMoneySum'];
        if (!is_null($newSumMoneyRet ['salaryAccountSum']))
            $fVal ['salaryAccountSum'] = ($newSumMoneyRet ['salaryAccountSum'] + $fVal ['salaryAccount'] - $prsReRet ['4'] ['salaryMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($newSumMoneyRet ['salaryAccountSum'] + $fVal ['salaryAccount'] - $prsReRet ['4'] ['salaryMoneySum']);
        else
            $fVal ['salaryAccountSum'] = ($sumMoneyRet ['salaryAccountSum'] + $fVal ['salaryAccount'] - $prsReRet ['4'] ['salaryMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['salaryAccountSum'] + $fVal ['salaryAccount'] - $prsReRet ['4'] ['salaryMoneySum']);
        $fVal ['uAccountST'] = $prsReRet ['1'] ['uAccountSum'];
        if (!is_null($newSumMoneyRet ['salaryAccountSum']))
            $fVal ['uAccountSTSum'] = ($newSumMoneyRet ['uAccountSTSum'] + $fVal ['uAccountST'] - $prsReRet ['4'] ['salaryMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($newSumMoneyRet ['uAccountSTSum'] + $fVal ['uAccountST'] + $exRet_m['uAccount'] - $prsReRet ['4'] ['salaryMoneySum']);
        else
            $fVal ['uAccountSTSum'] = ($sumMoneyRet ['uAccountSTSum'] + $fVal ['uAccountST'] - $prsReRet ['4'] ['salaryMoneySum']) < 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['uAccountSTSum'] + $fVal ['uAccountST'] + $exRet_m['uAccount'] - $prsReRet ['4'] ['salaryMoneySum']);

        //累计挂账(上月累计+本月挂账)
        $fVal ['sumAccount'] = $fVal ['uSoInsAccountSum'] + $fVal ['uHFAccountSum'] + $fVal ['uComInsAccountSum'] + $fVal ['salaryAccountSum'] + $fVal ['uAccountSTSum'];
        #欠款
        $fVal ['soInsMoney'] = $prsReRet ['2'] ['uSoInsMoneySum'] + $prsReRet ['2'] ['pSoInsMoneySum'] + $prsReRet ['2'] ['uPDInsMoneySum'];
        $soInsMoneyRe = $fVal ['uSoInsMoneyRe'] + $fVal ['pSoInsMoneyRe'];
        $fVal ['soInsMoneySum'] = round(($sumMoneyRet ['soInsMoneySum'] + $fVal ['soInsMoney'] + $soInsMoneyRe),2) > 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['soInsMoneySum'] + $fVal ['soInsMoney'] + $soInsMoneyRe);
        $fVal ['HFMoney'] = $prsReRet ['2'] ['uHFMoneySum'] + $prsReRet ['2'] ['pHFMoneySum'];
        $HFMoneyRe = $fVal ['uHFMoneyRe'] + $fVal ['pHFMoneyRe'];
        $fVal ['HFMoneySum'] = round(($sumMoneyRet ['HFMoneySum'] + $fVal ['HFMoney'] + $HFMoneyRe),2) > 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['HFMoneySum'] + $fVal ['HFMoney'] + $HFMoneyRe);
        $fVal ['comInsMoney'] = $prsReRet ['2'] ['uComInsMoneySum'] + $prsReRet ['2'] ['pComInsMoneySum'];
        $comInsMoneyRe = $fVal ['uComInsMoneyRe'] + $fVal ['pComInsMoneyRe'];
        $fVal ['comInsMoneySum'] = ($sumMoneyRet ['comInsMoneySum'] + $fVal ['comInsMoney'] + $comInsMoneyRe) > 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['comInsMoneySum'] + $fVal ['comInsMoney'] + $comInsMoneyRe);
        $fVal ['mCostMoney'] = $prsReRet ['2'] ['managementCostMoneySum'];
        $mCostMoneyRe = $fVal ['uMCostMoneyRe'];
        $fVal ['mCostMoneySum'] = ($sumMoneyRet ['mCostMoneySum'] + $fVal ['mCostMoney'] + $mCostMoneyRe) > 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['mCostMoneySum'] + $fVal ['mCostMoney'] + $mCostMoneyRe);
        $fVal ['salaryMoney'] = $prsReRet ['2'] ['salaryMoneySum'];
        $salaryMoneyRe = $fVal ['uSalaryMoneyRe'];
        // 暂时把它屏蔽了，等开放了离职工资收回再加入
        // $fVal ['salaryMoneySum'] = ($sumMoneyRet ['salaryMoneySum'] + $fVal ['salaryMoney'] + $salaryMoneyRe) > 0 ? "<span class='red'>出错了</span>" : ($sumMoneyRet ['salaryMoneySum'] + $fVal ['salaryMoney'] + $salaryMoneyRe);
        $fVal ['salaryMoneySum'] = 0;
        $fVal ['soInsMoneyRe'] = $soInsMoneyRe;
        $fVal ['HFMoneyRe'] = $HFMoneyRe;
        $fVal ['comInsMoneyRe'] = $comInsMoneyRe;
        $fVal ['mCostMoneyRe'] = $mCostMoneyRe;
        //暂时改为收回垫付款
        $fVal ['salaryMoneyRe'] = $exRet['advanceMoney'] + $exRet_m['advanceMoney'];
        //累计欠款(上月累计+本月欠款+本月收回欠款)
        $fVal ['sumMoney'] = $fVal ['soInsMoneySum'] + $fVal ['HFMoneySum'] + $fVal ['comInsMoneySum'] + $fVal ['salaryMoneySum'] + $fVal ['mCostMoneySum'];
        $fVal ['remarks'] = null;

        if ($_POST ['save']) {
            foreach ($fVal as $key => $val) {
                switch ($key) {
                    case "sIncomeTotal" :
                    case "sExpenditureTotal" :
                    case "cATotal" :
                    case "sumAccount" :
                    case "sumMoney" :
                        break;
                    case "comments" :
                    case "remarks" :
                        $val = $_POST [$key];
                        $str .= "`$key`='$val',";
                        break;
                    case "uSoInsAccountSum" :
                    case "uHFAccountSum" :
                    case "uComInsAccountSum" :
                    case "salaryAccountSum" :
                    case "soInsMoneySum" :
                    case "HFMoneySum" :
                    case "comInsMoneySum" :
                    case "mCostMoneySum" :
                    case "salaryMoneySum" :
                        if (!is_numeric($val))
                            exit("台账数据有误,不能生成报表,检查下是否是冲减挂账的问题");
                        $str .= "`$key`='$val',";
                        break;
                    default :
                        if ($repeatField) {
                            foreach ($repeatField as $reKey => $reVal) {
                                foreach ($reVal as $reK => $reV) {
                                    if ($reV == $key) {
                                        $vStr [$key] = "`$reKey`='$val',";
                                        break;
                                    }
                                }
                            }
                            if ($vStr and array_key_exists($key, $vStr)) {
                                break;
                            } else
                                $str .= "`$key`='$val',";
                        } else {
                            $str .= "`$key`='$val',";
                        }
                        break;
                }
            }
            if ($vStr) {
                $vStr = array_unique($vStr);
                foreach ($vStr as $vVal) {
                    $str .= $vVal;
                }
            }
            $sql = " select ID from `a_ledger` where `type`='1' and `unitID` like :unitID and `month` like :month and `extraBatch`='$extraBatch'";
            $ret = SQL($pdo, $sql, array(":unitID" => $unitID, ":month" => $month), "one");
            if (!$ret ['ID']) {
                #添加台账记录
                $iSql = "insert into `a_ledger` set `unitID`='$unitID',";
                $iSql .= $str . "`type`='1'";
                $tSql = $iSql;
            } else {
                #更新台账记录
                $uSql = "update `a_ledger` set " . rtrim($str, ",") . " where `ID`='$ret[ID]'";
                $tSql = $uSql;
            }
            #把费用表改为确认数据
            $confirmSql = " update `a_originalFee` set `confirmStatus`='1' where `month` like '$month' and `unitID` like '$unitID'";
            $confirmSql_r = " update `a_rewardfee` set `confirmStatus`='1' where `month` like '$month' and `unitID` like '$unitID'";
            $actionSql = array($confirmSql, $confirmSql_r, $tSql);
            $retsult = extraTransaction($pdo, $actionSql);
            $errMsg = $result ['error'];
            if (empty($errMsg)) {
                $msg = "成功生成 [ $month ] 台账";
                #插入改过的 ledger 的ID,用于完成记录更新过的欠款记录
                $sql = " select ID from `a_ledger` where `type`='1' and `unitID` like :unitID and `month` like :month";
                $ret = SQL($pdo, $sql, array(":unitID" => $unitID, ":month" => $month), "one");

                $needInSql = "update `a_ledger_prsReMoney_tmp` set `ledgerID`='$ret[ID]' where `ledgerType`='1' and `month` like '$month' and `unitID`='$unitID' ";
                $pdo->query($needInSql);
            } else {
                $msg = $errMsg;
            }
            $msg = "<script>alert('$msg')</script>";
        }
        $fVal = $fVal;
    }
}
#历史数据查询
//查询该单位的公式,确定所有公式涉及的元素,但是目前台账的额外公式设置 只支持"+"(相加),涉及到不同月份的
$hisFormulasSql = "select a.*,b.field from `a_zFormulas` a,`a_zformatinfo` b where a.zID=b.zID and a.`unitID` like :unitID and ( a.`sIncomeFormulas`<>'0' or a.`sExpenditureFormulas`<>'0' or a.`sOtherFeeFormulas`<>'0')";
$hisFormulasRet = SQL($pdo, $hisFormulasSql, array(":unitID" => $unitID));
foreach ($hisFormulasRet as $hVal) {
    $HformulasStr [$hVal ['month']] = array("zID" => $hVal ['zID'], "field" => makeArray($hVal ['field']), "sIncome" => $hVal ['sIncomeFormulas'], "sExpenditure" => $hVal ['sExpenditureFormulas'], "sOtherFee" => $hVal ['sOtherFeeFormulas']);
    $HsIncomeStrTmp = $HsExpenditureStrTmp = $HsOthereStrTmp = null;
    preg_match_all("/[a-zA-Z]+/", $hVal ['sIncomeFormulas'], $HsIncomeStrTmp);
    preg_match_all("/[a-zA-Z]+/", $hVal ['sExpenditureFormulas'], $HsExpenditureStrTmp);
    preg_match_all("/[a-zA-Z]+/", $hVal ['sOtherFeeFormulas'], $HsOtherFeeStrTmp);
    $HsIncomeStr = mergeArray($HsIncomeStrTmp [0], $HsIncomeStr);
    $HsExpenditureStr = mergeArray($HsExpenditureStrTmp [0], $HsExpenditureStr);
    $HsOtherFeeStr = mergeArray($HsOtherFeeStrTmp [0], $HsOtherFeeStr);
    #获取所有除常规费用外的项目
    $HallStr [$hVal ['month']] = mergeArray($HsIncomeStrTmp [0], $HsExpenditureStrTmp [0], $HsOtherFeeStrTmp [0]);
    if ($HallStr [$hVal ['month']])
        $HallStr [$hVal ['month']] = array_unique($HallStr [$hVal ['month']]);
}

#获取历史出现过的项目
if ($HsIncomeStr) {
    $HsIncomeStr = array_unique($HsIncomeStr);
}
if ($HsExpenditureStr) {
    $HsExpenditureStr = array_unique($HsExpenditureStr);
}
if ($HsOtherFeeStr) {
    $HsOtherFeeStr = array_unique($HsOtherFeeStr);
}
#获取历史重复的项
if ($HsIncomeStr and $HsExpenditureStr) {
    $repeatFieldTmp = array_intersect($HsIncomeStr, $HsExpenditureStr);
    if ($repeatFieldTmp) {
        foreach ($repeatFieldTmp as $rv) {
            $HrepeatField [$rv] ['sIncome'] = $rv . "1";
            $HrepeatField [$rv] ['sExpenditure'] = $rv . "2";
        }
        unset($repeatFieldTmp);
    }
}
if ($HsOtherFeeStr and $HsExpenditureStr) {
    $repeatFieldTmp = array_intersect($HsOtherFeeStr, $HsExpenditureStr);
    if ($repeatFieldTmp) {
        foreach ($repeatFieldTmp as $rv) {
            $HrepeatField [$rv] ['sExpenditure'] = $rv . "2";
            $HrepeatField [$rv] ['sOtherFee'] = $rv . "3";
        }
        unset($repeatFieldTmp);
    }
}
if ($HsIncomeStr and $HsOtherFeeStr) {
    $repeatFieldTmp = array_intersect($HsIncomeStr, $HsOtherFeeStr);
    if ($repeatFieldTmp) {
        foreach ($repeatFieldTmp as $rv) {
            $HrepeatField [$rv] ['sIncome'] = $rv . "1";
            $HrepeatField [$rv] ['sOtherFee'] = $rv . "3";
        }
        unset($repeatFieldTmp);
    }
}
if ($HallStr)
    foreach ($HallStr as $haKey => $haVal) {
        if ($haVal) {
            foreach ($haVal as $haV) {
                if ($HrepeatField and !array_key_exists($haV, $HrepeatField)) {
                    $newHallStr [$haKey] [] = $haV;
                } else {
                    $newHallStr [$haKey] [] = $haV;
                }
            }
        }
    }

//查询所有台账
$historySql = "select * from `a_ledger` where `unitID` like :unitID";
$historyRet = SQL($pdo, $historySql, array(":unitID" => $unitID));
foreach ($historyRet as $key => $val) {
    $hisRet [$key] ['ID'] = $val ['ID'];
    $hisRet [$key] ['month'] = $val ['month'];
    $hisRet [$key] ['salaryDate'] = $val ['salaryDate'];
    $hisRet [$key] ['soInsDate'] = $val ['soInsDate'];
    $hisRet [$key] ['HFDate'] = $val ['HFDate'];
    $hisRet [$key] ['comInsDate'] = $val ['comInsDate'];
    $hisRet [$key] ['managementCostDate'] = $val ['managementCostDate'];
    $hisRet [$key] ['comments'] = $val ['comments'];
    $hisRet [$key] ['num'] = $val ['num'];
    #收入
    $hisRet [$key] ['totalFeeR'] = $val ['totalFeeR'];
    $hisRet [$key] ['WDMoney'] = $val ['WDMoney'];
    $hisRet [$key] ['salaryS'] = $val ['salaryS'];
    $hisRet [$key] ['mCostNum'] = $val ['mCostNum'];
    $hisRet [$key] ['managementCost'] = $val ['managementCost'];
    $hisRet [$key] ['uPDInsS'] = $val ['uPDInsS'];
    $hisRet [$key] ['uSoInsS'] = $val ['uSoInsS'];
    $hisRet [$key] ['pSoInsS'] = $val ['pSoInsS'];
    $hisRet [$key] ['uHFS'] = $val ['uHFS'];
    $hisRet [$key] ['pHFS'] = $val ['pHFS'];
    $hisRet [$key] ['uComInsS'] = $val ['uComInsS'];
    $hisRet [$key] ['pComInsS'] = $val ['pComInsS'];
    $hisRet [$key] ['uSoInsMoneyRe'] = $val ['uSoInsMoneyRe'];
    $hisRet [$key] ['uHFMoneyRe'] = $val ['uHFMoneyRe'];
    $hisRet [$key] ['uComInsMoneyRe'] = $val ['uComInsMoneyRe'];
    $hisRet [$key] ['uMCostMoneyRe'] = $val ['uMCostMoneyRe'];
    $hisRet [$key] ['uSalaryMoneyRe'] = $val ['uSalaryMoneyRe'];
    $hisRet [$key] ['uAccountSp'] = $val ['uAccountSp'];
    if ($HsIncomeStr) {
        $otherHSIncome = null;
        foreach ($HsIncomeStr as $hv) {
            if (array_key_exists($hv, $HrepeatField))
                $hisRet [$key] [$HrepeatField [$hv] ['sIncome']] = $val [$hv];
            else
                $hisRet [$key] [$hv] = $val [$hv];
            $otherHSIncome += $val [$hv];
        }
    }
    $hisRet [$key] ['sIncomeTotal'] = $hisRet [$key] ['salaryS'] + $hisRet [$key] ['managementCost'] + $hisRet [$key] ['uPDInsS'] + $hisRet [$key] ['uSoInsS'] + $hisRet [$key] ['uHFS'] + $hisRet [$key] ['uComInsS'] + $hisRet [$key] ['uSoInsMoneyRe'] + $hisRet [$key] ['uHFMoneyRe'] + $hisRet [$key] ['uComInsMoneyRe'] + $hisRet [$key] ['uMCostMoneyRe'] + $hisRet [$key] ['uSalaryMoneyRe'] + $hisRet [$key] ['uAccountSp'] + $otherHSIncome;
    #支出
    $hisRet [$key] ['salaryR'] = $val ['salaryR'];
    $hisRet [$key] ['soInsR'] = $val ['soInsR'];
    $hisRet [$key] ['HFR'] = $val ['HFR'];
    //商保这边是有点问题的,,,咱不理他.
    $hisRet [$key] ['comInsR'] = $val ['comInsR'];
    $hisRet [$key] ['pTax'] = $val ['pTax'];
    $hisRet [$key] ['utilities'] = $val ['utilities'];
    $hisRet [$key] ['cardsCost'] = $val ['cardsCost'];
    $hisRet [$key] ['otherExpenditure'] = $val ['otherExpenditure'];
    if ($HsExpenditureStr) {
        $otherHSExpenditure = null;
        foreach ($HsExpenditureStr as $hv) {
            if (array_key_exists($hv, $HrepeatField))
                $hisRet [$key] [$HrepeatField [$hv] ['sExpenditure']] = $val [$hv];
            else
                $hisRet [$key] [$hv] = $val [$hv];
            $otherHSExpenditure += $val [$hv];
        }
    }
    $hisRet [$key] ['sExpenditureTotal'] = $hisRet [$key] ['salaryR'] + $hisRet [$key] ['soInsR'] + $hisRet [$key] ['HFR'] + $hisRet [$key] ['comInsR'] + $hisRet [$key] ['pTax'] + $hisRet [$key] ['utilities'] + $hisRet [$key] ['cardsCost'] + $hisRet [$key] ['otherExpenditure'] + $otherHSExpenditure;
    $hisRet [$key] ['helpCost'] = $val ['helpCost'];
    $hisRet [$key] ['soInsBal'] = $val ['soInsBal'];
    $hisRet [$key] ['HFBal'] = $val ['HFBal'];
    $hisRet [$key] ['comInsBal'] = $val ['comInsBal'];
    $hisRet [$key] ['uOtherAccount'] = $val ['uOtherAccount'];
    if ($HsOtherFeeStr) {
        $HsOtherFee = null;
        foreach ($HsOtherFeeStr as $hv) {
            if (array_key_exists($hv, $HrepeatField))
                $hisRet [$key] [$HrepeatField [$hv] ['sOtherFee']] = $val [$hv];
            else
                $hisRet [$key] [$hv] = $val [$hv];
            $HsOtherFee += $val [$hv];
        }
    }
    $hisRet [$key] ['pSoInsMoneyRe'] = $val ['pSoInsMoneyRe'];
    $hisRet [$key] ['pHFMoneyRe'] = $val ['pHFMoneyRe'];
    $hisRet [$key] ['pComInsMoneyRe'] = $val ['pComInsMoneyRe'];
    $hisRet [$key] ['soInsCA'] = $val ['soInsCA'];
    $hisRet [$key] ['HFCA'] = $val ['HFCA'];
    $hisRet [$key] ['comInsCA'] = $val ['comInsCA'];
    $hisRet [$key] ['salaryCA'] = $val ['salaryCA'];
    $hisRet [$key] ['cATotal'] = $hisRet [$key] ['soInsCA'] + $hisRet [$key] ['HFCA'] + $hisRet [$key] ['comInsCA'] + $hisRet [$key] ['salaryCA'];
    #挂账
    $hisRet [$key] ['uSoInsAccount'] = $val ['uSoInsAccount'];
    $hisRet [$key] ['uSoInsAccountSum'] = $val ['uSoInsAccountSum'];
    $hisRet [$key] ['pSoInsAccount'] = $val ['pSoInsAccount'];
    $hisRet [$key] ['uHFAccount'] = $val ['uHFAccount'];
    $hisRet [$key] ['uHFAccountSum'] = $val ['uHFAccountSum'];
    $hisRet [$key] ['pHFAccount'] = $val ['pHFAccount'];
    $hisRet [$key] ['uComInsAccount'] = $val ['uComInsAccount'];
    $hisRet [$key] ['uComInsAccountSum'] = $val ['uComInsAccountSum'];
    $hisRet [$key] ['pComInsAccount'] = $val ['pComInsAccount'];
    $hisRet [$key] ['salaryAccount'] = $val ['salaryAccount'];
    $hisRet [$key] ['salaryAccountSum'] = $val ['salaryAccountSum'];
    $hisRet [$key] ['uAccountST'] = $val ['uAccountST'];
    $hisRet [$key] ['uAccountSTSum'] = $val ['uAccountSTSum'];
    //累计挂账(上月累计+本月挂账)
    $hisRet [$key] ['sumAccount'] = $val ['uSoInsAccountSum'] + $val ['uHFAccountSum'] + $val ['uComInsAccountSum'] + $val ['salaryAccountSum'] + $val ['uAccountSTSum'];
    #欠款
    $hisRet [$key] ['soInsMoney'] = $val ['soInsMoney'];
    $hisRet [$key] ['soInsMoneySum'] = $val ['soInsMoneySum'];
    $hisRet [$key] ['HFMoney'] = $val ['HFMoney'];
    $hisRet [$key] ['HFMoneySum'] = $val ['HFMoneySum'];
    $hisRet [$key] ['comInsMoney'] = $val ['comInsMoney'];
    $hisRet [$key] ['comInsMoneySum'] = $val ['comInsMoneySum'];
    $hisRet [$key] ['mCostMoney'] = $val ['mCostMoney'];
    $hisRet [$key] ['mCostMoneySum'] = $val ['mCostMoneySum'];
    $hisRet [$key] ['salaryMoney'] = $val ['salaryMoney'];
    $hisRet [$key] ['salaryMoneySum'] = $val ['salaryMoneySum'];
    $hisRet [$key] ['soInsMoneyRe'] = $val ['soInsMoneyRe'];
    $hisRet [$key] ['HFMoneyRe'] = $val ['HFMoneyRe'];
    $hisRet [$key] ['comInsMoneyRe'] = $val ['comInsMoneyRe'];
    $hisRet [$key] ['mCostMoneyRe'] = $val ['mCostMoneyRe'];
    $hisRet [$key] ['salaryMoneyRe'] = $val ['salaryMoneyRe'];
    //累计欠款(上月累计+本月欠款+本月收回欠款)
    $hisRet [$key] ['sumMoney'] = $val ['soInsMoneySum'] + $val ['HFMoneySum'] + $val ['comInsMoneySum'] + $val ['mCostMoneySum'] + $val ['salaryMoneySum'];
    $hisRet [$key] ['remarks'] = $val ['remarks'];
}
#加载模板变量
$smarty->assign("j_unitManager", $j_unitManager);
$smarty->assign("s_unitID", $unitID);
$smarty->assign("s_mID", $mID);
$smarty->assign(array("newFieldArr" => $newFieldArr, "formulasChartStr" => $formulasChartStr));
$smarty->assign(array("sIncomeStr" => $sIncomeStr, "sExpenditureStr" => $sExpenditureStr, "sOtherFeeStr" => $sOtherFeeStr));
$smarty->assign(array("HsIncomeStr" => $HsIncomeStr, "HsExpenditureStr" => $HsExpenditureStr, "HsOtherFeeStr" => $HsOtherFeeStr));
$smarty->assign(array("HrepeatField" => $HrepeatField, "HformulasStr" => $HformulasStr, "HallStr" => $HallStr, "newHallStr" => $newHallStr));
$smarty->assign("validApproval", $validApproval);
$smarty->assign("msg", $msg);
$smarty->assign(array("fVal" => $fVal, "hisRet" => $hisRet));
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("leader/ledger.tpl");
?>
