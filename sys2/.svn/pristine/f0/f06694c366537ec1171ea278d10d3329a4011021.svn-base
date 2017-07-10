<?php
/*
*     2010-2-21   
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
@session_start();
error_reporting(E_ALL & ~ (E_NOTICE | E_WARNING));
include_once ("../settings.inc");
//所有员工的信息
$wInfoSql = "select * from cwps_user where groupID like '13'";
$wInfoRet = mysql_query($wInfoSql);
while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
    $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
}
// if($_SESSION['SubGroupIDs']!=',17,')exit("无权访问");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	 $(".month").change(function(){
	       window.location.href="CEOAction.php?month="+$(this).val();
	    });
	 function ajaxAction(t, u, d, dt, m){
	        $.ajax({
	            type: t,
	            url: u,
	            data: d,
	            dataType: dt,
	            error: function(html){
	                alert('ajax提交出错,请联系系统管理员!');
	            },
	            success: m
	        });
	    }
	 //全选反选
	    $(".chkAll").click(function(){
	        var cC, aC;
	        var formName = this.form.name;
	        var chkName = formName.replace("Form", "");
	        cC = this;
	        aC = ':checkbox[name^=' + chkName + 'Check]';
	        checkAll(cC, aC);
	    });
	    
	    function checkAll(clickChk, actionChk){
	        if ($(clickChk).attr('checked') == true) {
	            $(actionChk).attr('checked', true);
	        }
	        else {
	            $(actionChk).attr('checked', false);
	        }
	    }
	  //AJAX提交,签收和退回操作
	  $(".updateBtn").click(function(){
		    
	        var formName = this.form.name;
	        var chkName = formName.replace("Form", "")+"Check";
	        var t, u, d, dt, m;
	        t = "post";
	        u = "sqlAction.php";
	        d = $("#" + formName).serialize() + "&update=1&btn=" + $(this).attr("name")+"&type="+chkName;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
                            alert(n);
                            window.location.reload();
                            break;
	                            }
	                        });
	                };
	        ajaxAction(t, u, d, dt, m);
	            });
				
			$("input[name^=resultSalary]").each(function(i){
			     $(this).ready(function(){
						   var lhVal = Number($(".lhxs").eq(i).val());	
						   var pyVal = Number($(".pyxs").eq(i).val());						   
						   var  lhPersent = Number($("input[name^=lhPersent]").eq(i).val());
						   var  pyPersent = Number($("input[name^=pyPersent]").eq(i).val());
						   
						   if(pyPersent==1){
							   var  salary = Number($(".salary").eq(i).text());				  
							   var  reward = Number($("input[name^=reward]").eq(i).val());							   
							   var  resultSalary = salary*(pyVal*pyPersent+lhVal*lhPersent)+reward;							   
							   resultSalary = formatFloat(resultSalary,2);
							   $("input[name^=resultSalary]").eq(i).attr("value",resultSalary);
			               }
					});
			   
			});
				
	        $(".lhxs").each(function(i){
					$(this).blur(function(){				    
						var lhVal = $(this).val();								
						if(!isNaN(lhVal)){
								   var pyVal = Number($(".pyxs").eq(i).text());
								   lhVal = Number(lhVal);
								   var  lhPersent = Number($("input[name^=lhPersent]").eq(i).val());
								   var  pyPersent = Number($("input[name^=pyPersent]").eq(i).val());
								   var  salary = Number($(".salary").eq(i).text());
								   var  reward = Number($("input[name^=reward]").eq(i).val());
								   // alert(salary);
								   var  resultSalary = salary*(pyVal*pyPersent+lhVal*lhPersent)+reward;
								   resultSalary = formatFloat(resultSalary,2);
								   $("input[name^=resultSalary]").eq(i).attr("value",resultSalary);
								   
						}
							else{
								error = "请输入数字";
							}	
				   }); 					
			}); 
			
			$("input[name^=reward]").each(function(i){
				$(this).blur(function(){	
				           var lhVal = Number($(".lhxs").eq(i).val());	
						   var pyVal = Number($(".pyxs").eq(i).text());
						   lhVal = Number(lhVal);
						   var  lhPersent = Number($("input[name^=lhPersent]").eq(i).val());
						   var  pyPersent = Number($("input[name^=pyPersent]").eq(i).val());
						   var  salary = Number($(".salary").eq(i).text());
						   var  reward = Number($("input[name^=reward]").eq(i).val());							   
						   var  resultSalary = salary*(pyVal*pyPersent+lhVal*lhPersent)+reward;							   
						   resultSalary = formatFloat(resultSalary,2);
						   $("input[name^=resultSalary]").eq(i).attr("value",resultSalary);
			               
				   }
			   );
			});
		function formatFloat(src, pos)
				{
					return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
				}			
	        
});

</script>
<style type="text/css">
</style>
</head>
<body>
<?php
$month = $_GET['month'];
if (! $month)
    exit("非法网址");
$actionPer = $_SESSION['UserName'];
//获取参加评议的人员
$userSql = "select userName from grade_filter where status like '1'";
$userRet = mysql_query($userSql);
while ($userRow = @mysql_fetch_assoc($userRet)) {
    $userArr[] = $userRow['userName'];
}
//获取已交评议表(员工)的人员
$wExistsSql = "SELECT distinct (a.actionPer),a.status FROM `grade_number` a LEFT JOIN grade_filter b ON a.userName = b.userName WHERE a.month like '$month' and b.subGroupIDs not LIKE ',17,' AND b.userName IS NOT NULL";
$wExistsRet = mysql_query($wExistsSql);
while ($wExistsRow = @mysql_fetch_assoc($wExistsRet)) {
    $wExistsArr[] = $wExistsRow['actionPer'];
    $wStatus[$wExistsRow['actionPer']] = $wExistsRow['status'];
}
//获取未交评议表(员工)的人员
if ($wExistsArr)
    $wNotExistsArr = @array_diff($userArr, $wExistsArr);
else
    $wNotExistsArr = $userArr;
    //获取已交评议表(管理层)的人员
$mExistsSql = "SELECT distinct (a.actionPer),a.status FROM `grade_number` a LEFT JOIN grade_filter b ON a.userName = b.userName WHERE a.month like '$month' and b.subGroupIDs  LIKE ',17,' AND b.userName IS NOT NULL";
$mExistsRet = mysql_query($mExistsSql);
while ($mExistsRow = @mysql_fetch_assoc($mExistsRet)) {
    $mExistsArr[] = $mExistsRow['actionPer'];
    $mStatus[$mExistsRow['actionPer']] = $mExistsRow['status'];
}
//获取未交评议表(管理层)的人员
if ($mExistsArr)
    $mNotExistsArr = array_diff($userArr, $mExistsArr);
else
    $mNotExistsArr = $userArr;
    //求平均分概况  分别是 员工,部长,总经理
$wAverageSql = "select a.* ,b.pyPersent as pyPersent,b.lhPersent as lhPersent,b.salary as salary from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and b.subGroupIDs not like ',17,' and b.userName is not null order by b.id";
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
$mAverageSql = "select a.* from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and b.subGroupIDs  like ',17,' and b.userName is not null order by b.id";
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
        if ($wInfoArr[$waverageK]['SubGroupIDs'] == $wgroupV) {
            $wTotal[$wgroupV]["total"] += $wAverage[$waverageK];
            $j ++;
            $wTotal[$wgroupV]["num"] += 1;
        }
    }
}
// echo "<pre>";
// print_r($wTotal);
foreach ($mAverage as $maverage) {
    $mTotal['total'] += $maverage;
    $mTotal['num'] += 1;
}
// echo "<pre>";
// print_r($mGradeArr);
//	echo "<script>alert('该月数据不存在')</script>";
?>
<div class="bd_xuanze">请选择要查看评议的月份 <select class="month" name="month">
<?php
$monthSql = "SELECT DISTINCT month FROM `grade_number` order by month desc";
$monthRet = mysql_query($monthSql);
while ($monthRow = mysql_fetch_assoc($monthRet)) {
    $checkedMonth = "";
    if ($month == $monthRow['month'])
        $checkedMonth = "selected";
    echo "<option value='$monthRow[month]' " . $checkedMonth . ">$monthRow[month]</option>";
}
$time = time();
$todayY = date("Y", $time);
$todayM = date("m", $time);
if ($wInfoArr[$_SESSION['UserName']]['RoleID'] != "40") {
    ?>
</select></div>
<br>

<p>评议表(员工)缴交概况:</p>
<form name=wForm id=wForm>
<table width="80%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>已缴(全选/反选<input name=wChK class=chkAll type="checkbox">)</th>
		<th>未缴</th>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
			<td width=50%><?php
    if ($wExistsArr)
        foreach ($wExistsArr as $wV) {
            if ($wStatus[$wV] == '1')
                $checked = "checked";
            else
                $checked = NULL;
            echo "<input type=checkbox name=wCheck[] value=" . $month . "," . $wV . " $checked>";
            echo "<a href=numList.php?month=$month&actionPer=$wV&type=w target=_blank>" . $wV . "</a>&nbsp;&nbsp;&nbsp;";
        }
    ?></td>
			<td width=50%><?php
    if ($wNotExistsArr)
        foreach ($wNotExistsArr as $wNV) {
            echo $wNV . "&nbsp;&nbsp;&nbsp;";
        }
    ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;<input type="button" class="updateBtn"
				name="pass" value="签收" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
				type="button" class="updateBtn" name="reGrade" value="退回"></td>
		</tr>

	</tbody>
</table>

</form>
<p>评议表(管理层)缴交情况:</p>
<form name=mForm id=mForm>
<table width="80%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>已缴(全选/反选<input name=mChK class=chkAll type="checkbox">)</th>
		<th>未缴</th>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
			<td width=50%><?php
    if ($mExistsArr)
        foreach ($mExistsArr as $mV) {
            if ($mStatus[$mV] == '1')
                $checked = "checked";
            else
                $checked = NULL;
            echo "<input type=checkbox name=mCheck[] value=" . $month . "," . $mV . " $checked>";
            echo "<a href=numList.php?month=$month&actionPer=" . urlencode($mV) . "&type=m target=_blank>" . $mV . "</a>&nbsp;&nbsp;&nbsp;";
        }
    ?></td>
			<td width=50%><?php
    if ($mNotExistsArr)
        foreach ($mNotExistsArr as $mNV) {
            echo $mNV . "&nbsp;&nbsp;&nbsp;";
        }
    ?></td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;<input type="button" class="updateBtn"
				name="pass" value="签收" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
				type="button" class="updateBtn" name="reGrade" value="退回"></td>
		</tr>
	</tbody>
</table>
</form>


<p>当前评分概况(员工):</p>
<form action="">
<table width="80%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th></th>
		<th>最后加权分</th>
		<th>部门平均分</th>
		<th>评议系数</th>
		<th>量化系数</th>
		<th>奖励</th>
		<th>应发绩效工资</th>
		<th>实法绩效工资</th>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
    foreach ($wGradeArr as $wUserKey => $wUserVal) {
        $departmentAverage = ($wTotal[$wUserVal[0]['userGroupID']]['total'] / $wTotal[$wUserVal[0]['userGroupID']]['num']);
        if ($wUserVal[0]['pyPersent'] == "1") {
            $lhxs = 0;
            $readOnly = "readOnly";
        } else {
            $lhxs = Null;
            $readOnly = NULL;
        }
        echo "<tr>";
        echo "<td width=14%><a href=numList.php?month=$month&userName=" . urlencode($wUserKey) . " target=_blank>" . $wUserKey . "</a></td>
                      <td width=14%><input type=text readonly name=personalAverage[$wUserKey] value='" . number_format($wAverage[$wUserKey], 2, ".", "") . "'/></td>
                      <td width=14%><input type=text readonly name=departmentAverage[$wUserKey] value='" . number_format($departmentAverage, 2, ".", "") . "'</td>
                      <td width=14%><input type=hidden name=pyPersent[] value='" . $wUserVal[0]['pyPersent'] . "' /><input name=pyxs[$wUserKey] class='pyxs' type=text value='" . number_format($wAverage[$wUserKey] / $departmentAverage, 3, ".", "") . "'/></td>
					  <td width=14%><input type=hidden name=lhPersent[] value='" . $wUserVal[0]['lhPersent'] . "' /><input name= lhxs[$wUserKey] class='lhxs' type=text value='$lhxs'  $readOnly/></td>
					  <td><input name=reward[] type=text /></td>
					  <td width=14%><span class=salary>" . $wUserVal[0]['salary'] . "</span></td>					
					  <td width=16%><input type=text readonly name= resultSalary[$wUserKey]></td>";
        echo "</tr>";
    }
    ?>
	</tbody>
</table>
<input type="button" class="sub" name="save" value="保存" />
<input type="button" class="sub" name="reload" value="重新载入" />
</form>
<p>当前评分概况(管理层):</p>
<table width="80%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th></th>
		<th>最后加权分</th>
		<th>部门平均分</th>
		<th>绩效系数</th>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
    foreach ($mGradeArr as $mUserKey => $mUserVal) {
        $mDeAverage = $mTotal['total'] / $mTotal['num'];
        echo "<tr>";
        echo "<td width=25%><a href=numList.php?month=$month&userName=" . urlencode($mUserKey) . " target=_blank>" . $mUserKey . "</a></td>
                      <td width=25%>" . number_format($mAverage[$mUserKey], 2, ".", "") . "</td>
                      <td width=25%>" . number_format($mDeAverage, 2, ".", "") . "</td>
                      <td width=25%>" . number_format($mAverage[$mUserKey] / $mDeAverage, 3, ".", "") . "</td>";
        echo "</tr>";
    }
    ?>
	</tbody>
</table>
<?php
} else {
    ?>
<p>当前评分概况(员工):</p>
<table width="80%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
			<th></th>
			<th>最后加权分</th>
			<th>部门平均分</th>
			<th>评议系数</th>
			<th>量化系数</th>
			<th>应发绩效工资</th>
			<th>实法绩效工资</th>
		</tr>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
    echo "<pre>";
    foreach ($wGradeArr as $wUserKey => $wUserVal) {
        // print_r($wUserVal);
        $departmentAverage = ($wTotal[$wUserVal[0]['userGroupID']]['total'] / $wTotal[$wUserVal[0]['userGroupID']]['num']);
        if ($wUserVal[0]['pyPersent'] == "1") {
            $lhxs = 0;
        } else {
            $lhxs = Null;
        }
        echo "<tr>";
        echo "<td width=14%>" . $wUserKey . "</td>
                      <td width=14%>" . number_format($wAverage[$wUserKey], 2, ".", "") . "</td>
                      <td width=14%>" . number_format($departmentAverage, 2, ".", "") . "</td>
                      <td width=14%><input type=hidden name=pyPersent[] value='" . $wUserVal[0]['pyPersent'] . "' /><span class='pyxs'>" . number_format($wAverage[$wUserKey] / $departmentAverage, 3, ".", "") . "</span></td>
					  <td width=14%><input type=hidden name=lhPersent[] value='" . $wUserVal[0]['lhPersent'] . "' /><input name= lhxs[$wUserKey] class='lhxs' type=text value='$lhxs' /></td>
					  <td width=14%><span class=salary>" . $wUserVal[0]['salary'] . "</span></td>
					  <td width=16%><input type=text readonly name= resultSalary[$wUserKey]></td>";
        echo "</tr>";
    }
    ?>
	</tbody>
</table>
<p>当前评分概况(管理层):</p>
<table width="80%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
			<th></th>
			<th>最后加权分</th>
			<th>部门平均分</th>
			<th>绩效系数</th>
		</tr>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
    foreach ($mGradeArr as $mUserKey => $mUserVal) {
        $mDeAverage = $mTotal['total'] / $mTotal['num'];
        echo "<tr>";
        echo "<td width=25%>" . $mUserKey . "</td>
                      <td width=25%>" . number_format($mAverage[$mUserKey], 2, ".", "") . "</td>
                      <td width=25%>" . number_format($mDeAverage, 2, ".", "") . "</td>
                      <td width=25%>" . number_format($mAverage[$mUserKey] / $mDeAverage, 3, ".", "") . "</td>";
        echo "</tr>";
    }
    ?>
	</tbody>
</table>
<?php
}
if (isset($_POST['intoExcel'])) {
    if (! $excelRet)
        exit("<script> alert('无数据导出') </script>");
        #链接PHPEXCEL CLASS
    $excelTitle = $month . "群众评议汇总表";
    require_once '../class/phpExcel/Classes/PHPExcel.php';
    require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
    require_once '../class/excel.class.php';
    $oExcel = new PHPExcel();
    #设置文档基本属性
    $oPro = $oExcel->getProperties();
    $oPro->setCreator($authorCompany); //公司名
    #构造输出函数
    $op = new excelOutput();
    $op->oExcel = $oExcel;
    $op->eRes = $excelRet;
    $op->selFieldArray = $tableHead;
    $op->title = $sheetTitle;
    $op->fillData();
    $op->eFileName = $excelTitle . ".xls";
    $op->output();
}
?>

</body>
</html>
