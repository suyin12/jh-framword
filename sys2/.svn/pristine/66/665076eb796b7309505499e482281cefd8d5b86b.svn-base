<?php
/*
*     2010-3-16   
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
session_start();
header("Content-type: text/plain; charset=UTF-8");
error_reporting(E_ALL & ~ (E_NOTICE | E_WARNING));
// print_r($_SESSION);
if (isset($_POST['intoExcel'])) {
    ini_set('display_errors', 1);
    //error_reporting(E_ALL & ~ (E_NOTICE | E_WARNING));
    include_once ("../settings.inc");
    //所有员工的信息
    $wInfoSql = "select * from cwps_user where groupID like '13'";
    $wInfoRet = mysql_query($wInfoSql);
    while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
        $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
    }
    $month = $_GET['month'];
    if (! $month)
        exit("非法网址");
    $actionPer = $_SESSION['UserName'];
       // if($_SESSION['SubGroupIDs']!=',17,')exit("无权访问");
    //求平均分概况  分别是 员工,部长,总经理
    $wAverageSql = "select a.* ,b.pyPersent as pyPersent,b.lhPersent as lhPersent,b.salary as salary from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.status like '1' and b.status like '1'  and b.subGroupIDs not like ',17,' and b.userName is not null order by b.id";
    $wAverageRet = mysql_query($wAverageSql);
    while ($wAverageRow = mysql_fetch_assoc($wAverageRet)) {
        $wGradeArr[$wAverageRow['userName']][] = $wAverageRow;
    }
    // echo "<pre>";
    // print_r($wGradeArr);
    foreach ($wGradeArr as $wGAK => $wGAV) {
        $x1 = $x2 = $x3 = $x4 = $x5 = 0;
        $x2_num = $x3_num = $x4_num = 0;
        foreach ($wGAV as $wAK => $wAV) {
            //1.提出本人的情况
            if ($wGAK == $wAV['actionPer']) {
                $x1 = $wAV['total'] * 0.1;
            } elseif ($wAV['actionPerGroupID'] == ',17,') {
                //2.提出领导层人员,再划分为部长和总经理两部分人员(这里估计要用土招,直接猎取总经理)
                if ($wInfoArr[$wAV['actionPer']]['RoleID'] == "40") {
                    $x5 = $wAV['total'] * 0.1;
                } else {
                    $x4 += $wAV['total'] * 0.3;
                    $x4_num += 1;
                }
            } else {
                //3.剩下的就是员工的人员,再换分为本部门和其他部门
                if ($wAV['actionPerGroupID'] == $wAV['userGroupID']) {
                    $x2 += $wAV['total'] * 0.35;
                    $x2_num += 1;
                } else {
                    $x3 += $wAV['total'] * 0.15;
                    $x3_num += 1;
                }
            }
        }
        $wAverage[$wGAK] = $x1 + ($x2 / $x2_num) + ($x3 / $x3_num) + ($x4 / $x4_num) + $x5;
    }
    $mAverageSql = "select a.* from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.status like '1' and b.subGroupIDs  like ',17,' and b.userName is not null order by b.id";
    $mAverageRet = mysql_query($mAverageSql);
    while ($mAverageRow = mysql_fetch_assoc($mAverageRet)) {
        $mGradeArr[$mAverageRow['userName']][] = $mAverageRow;
    }
    foreach ($mGradeArr as $mGAK => $mGAV) {
        $y1 = $y2 = $y3 = $y4 = $y5 = 0;
        $y2_num = $y3_num = $y4_num = 0;
        foreach ($mGAV as $mAK => $mAV) {
            //1.提出本人的情况
            if ($mGAK == $mAV['actionPer']) {
                $y1 = $mAV['total'] * 0.1;
            } elseif ($mAV['actionPerGroupID'] == ',17,') {
                //2.提出领导层人员,再划分为部长和总经理两部分人员(这里估计要用土招,直接猎取总经理)
                if ($wInfoArr[$mAV['actionPer']]['RoleID'] == "40") {
                    $y5 = $mAV['total'] * 0.2;
                } else {
                    $y4 += $mAV['total'] * 0.2;
                    $y4_num += 1;
                }
            } else {
                //3.剩下的就是员工的人员,再换分为本部门和其他部门
                $roleID = $wInfoArr[$mAV['userName']]['RoleID'];
                switch ($roleID) {
                    case '22':
                        $userGroupID = ',14,';
                        break;
                    case '24':
                        $userGroupID = ',16,';
                        break;
                    case '28':
                        $userGroupID = ',15,';
                        break;
                }
                if ($mAV['actionPerGroupID'] == $userGroupID) {
                    $y2 += $mAV['total'] * 0.3;
                    $y2_num += 1;
                } else {
                    $y3 += $mAV['total'] * 0.2;
                    $y3_num += 1;
                }
            }
        }
        $mAverage[$mGAK] = $y1 + ($y2 / $y2_num) + ($y3 / $y3_num) + ($y4 / $y4_num) + $y5;
    }
    //部门平均分
    $wGroupSql = "select subGroupIDs from grade_filter where  subGroupIDs not like ',17,' and subGroupIDs not like '' group by SubGroupIDs";
    $wGroupRet = mysql_query($wGroupSql);
    while ($wGroupRow = mysql_fetch_assoc($wGroupRet)) {
        $wGroupArr[] = $wGroupRow['subGroupIDs'];
    }
    foreach ($wGroupArr as $wgroupV) {
        $wTotal[$wgroupV]["total"] = 0;
        $wTotal[$wgroupV]["num"] = 0;
        foreach ($wAverage as $waverageK => $waverageV) {
            //echo $wgroupV;
            // echo "<br/>";		  
            // if ($wInfoArr[$waverageK]['SubGroupIDs'] == $wgroupV) {
                $wTotal[$wgroupV]["total"] += $wAverage[$waverageK];
                $j ++;
                $wTotal[$wgroupV]["num"] += 1;
            // }
        }
    }
    // echo "<pre>";
    // print_r($wTotal);
    foreach ($mAverage as $maverage) {
        $mTotal['total'] += $maverage;
        $mTotal['num'] += 1;
    }
    $exitsAverageSql = "select * from grade_persent where month like '$month'";
    $exitsAverageRet = mysql_query($exitsAverageSql);
    while ($eARow = mysql_fetch_assoc($exitsAverageRet)) {
        $exitsAverageArr[$eARow['userName']] = $eARow;
    }
    foreach ($wGradeArr as $wUserKey => $wUserVal) {
        $personalAverage = number_format($wAverage[$wUserKey], 2, ".", "");
        $departmentAverage = number_format($wTotal[$wUserVal[0]['userGroupID']]['total'] / $wTotal[$wUserVal[0]['userGroupID']]['num'], 2, ".", "");
        $pyxs = number_format($wAverage[$wUserKey] / $departmentAverage, 3, ".", "");
        $departmentAverage = number_format($wTotal[$wUserVal[0]['userGroupID']]['total'] / $wTotal[$wUserVal[0]['userGroupID']]['num'], 2, ".", "");
        if ($wUserVal[0]['pyPersent'] == "1") {
            $lhxs = 0;
            $readOnly = "readOnly";
        } else {
            $lhxs = $exitsAverageArr[$wUserKey]['lhxs'];
            $readOnly = NULL;
        }
        if ($exitsAverageArr[$wUserKey]['pyPersent']) {
            $pyPersent = $exitsAverageArr[$wUserKey]['pyPersent'];
        } else {
            $pyPersent = $wUserVal[0]['pyPersent'];
        }
        if ($exitsAverageArr[$wUserKey]['lhPersent']) {
            $lhPersent = $exitsAverageArr[$wUserKey]['lhPersent'];
        } else {
            $lhPersent = $wUserVal[0]['lhPersent'];
        }
        if ($exitsAverageArr[$wUserKey]['salary']) {
            $salary = $exitsAverageArr[$wUserKey]['salary'];
        } else {
            $salary = $wUserVal[0]['salary'];
        }
        $resultSalary = number_format(($salary * ($pyxs * $pyPersent + $lhxs * $lhPersent) + $exitsAverageArr[$wUserKey]['reward']), 2, ".", "");
        $wAverRet[] = array("userName" => $wUserKey , "personalAverage" => $personalAverage , "departmentAverage" => $departmentAverage , "pyxs" => $pyxs , "lhxs" => $lhxs , "reward" => $exitsAverageArr[$wUserKey]['reward'] , "salary" => $salary , "resultSalary" => $resultSalary);
    }
    foreach ($mGradeArr as $mUserKey => $mUserVal) {
        $mDeAverage = $mTotal['total'] / $mTotal['num'];
        $personalAverage = number_format($mAverage[$mUserKey], 2, ".", "");
        $departmentAverage = number_format($mDeAverage, 2, ".", "");
        $pyxs = number_format($mAverage[$mUserKey] / $mDeAverage, 3, ".", "");
        $mAverRet[] = array("userName" => $mUserKey , "personalAverage" => $personalAverage , "departmentAverage" => $departmentAverage , "pyxs" => $pyxs);
    }
    if (! $wAverage || ! $mAverage)
        exit("<script> alert('无数据导出') </script>");
    $excelTitle = $month . "群众评议汇总表";
    $wAverSheetTitle = "员工评议表概况";
    $mAverSheetTitle = "管理层评议表概况";
    $wAverTableHead = array("userName" => "姓名" , "personalAverage" => "个人加权平均分" , "departmentAverage" => "公司平均分" , "pyxs" => "评议系数" , "lhxs" => "量化系数" , "reward" => "奖励" , "salary" => "应发绩效工资" , "resultSalary" => "实发绩效工资");
    $wThArr[] = $wAverTableHead;
    $wAverRet = array_merge($wThArr, $wAverRet);
    $mAverTableHead = array("userName" => "姓名" , "personalAverage" => "个人加权平均分" , "departmentAverage" => "部门平均分" , "pyxs" => "评议系数");
    $mThArr[] = $mAverTableHead;
    $mAverRet = array_merge($mThArr, $mAverRet);
    // print_r($wAverRet);
    #链接PHPEXCEL CLASS
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excel.class.php';
    $oExcel = new PHPExcel();
    #构造输出函数
    $op = new excelOutput();
    $op->oExcel = $oExcel;
    $op->eRes = $wAverRet;
    $op->selFieldArray = $wAverTableHead;
    $op->title = $wAverSheetTitle;
    $op->fillData();
    $oExcel->createSheet();
    $op->sheetIndex = 1;
    $op->eRes = $mAverRet;
    $op->selFieldArray = $mAverTableHead;
    $op->title = $mAverSheetTitle;
    $op->fillData();
    $op->eFileName = $excelTitle . ".xls";
    $op->output();
}
?>