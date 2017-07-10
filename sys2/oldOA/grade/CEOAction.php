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
require_once "../companyHeader.php";
//所有员工的信息
$wInfoSql = "select * from cwps_user where groupID like '13'";
$wInfoRet = mysql_query($wInfoSql);
while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
    $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
}
if($_SESSION['SubGroupIDs']!=',17,')exit("无权访问");
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

	  $(".sub").click(function(){
	    	var t = "post";
	        var u = "sqlAction.php";
	        var formID = $(this).parent("form").attr("id");
	        var d = $(this).attr("name")+"=1&"+$("#wAverageForm").serialize();
	        var dt= "json";
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
	                }
	            });
	            
	        }
     		 ret = confirm("确定"+$(this).attr("value")+"?");
	        if (ret == true ) {
	            	 ajaxAction(t, u, d, dt, m);
		            
	        }else {
	            return false;
	        }
  			});
          
		
			$("input[name^=resultSalary]").each(function(i){
			     $(this).ready(function(){
			    	       var lhVal = Number($("input[name^=lhxs]").eq(i).val());	
						   var pyVal = Number($(".pyxs").eq(i).text());
						   lhVal = Number(lhVal);
						   var  lhPersent = Number($("input[name^=lhPersent]").eq(i).val());
						   var  pyPersent = Number($("input[name^=pyPersent]").eq(i).val());
						   var  salary = Number($("input[name^=salary]").eq(i).val());
						   var  reward = Number($("input[name^=reward]").eq(i).val());
						   var  resultSalary = salary*(pyVal*pyPersent+lhVal*lhPersent)+reward;							   
						   resultSalary = formatFloat(resultSalary,2);
						   $("input[name^=resultSalary]").eq(i).attr("value",resultSalary);
					});
			   
			});
				
	        $(".blur").each(function(k){
					$(this).blur(function(){				    
						var thisVal = $(this).val();								
						if(!isNaN(thisVal)){
							   var  i = parseInt(k/5);
							   var j = k%5;
//							   alert(j);
						       var lhVal = Number($("input[name^=lhxs]").eq(i).val());	
							   var pyVal = Number($(".pyxs").eq(i).text());
							   lhVal = Number(lhVal);
							   var  lhPersent = Number($("input[name^=lhPersent]").eq(i).val());
							   var  pyPersent = Number($("input[name^=pyPersent]").eq(i).val());
							   var  salary = Number($("input[name^=salary]").eq(i).val());
							   var  reward = Number($("input[name^=reward]").eq(i).val());	
							   var  resultSalary = salary*(pyVal*pyPersent+lhVal*lhPersent)+reward;							   
							   resultSalary = formatFloat(resultSalary,2);
							   $("input[name^=resultSalary]").eq(i).attr("value",resultSalary);
						}
							else{
								error = "请输入数字";
							}	
				   }); 					
			}); 
			
		//格式化数字
		function formatFloat(src, pos){
			return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
		}	
 });

</script>
<style type="text/css">
</style>
</head>
<body>
<div id="right" name="right">
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
$wAverageSql = "select a.* ,b.pyPersent as pyPersent,b.lhPersent as lhPersent,b.salary as salary from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.status like '1' and b.subGroupIDs not like ',17,' and b.status like '1' and b.userName is not null order by b.id";
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

//排名数组
arsort($wAverage);
arsort($mAverage);
$i=$j=1;
foreach ($wAverage as $wsk=>$wsv){
	$wSortArr[$wsk]=$i;
	$i++;
}
foreach ($mAverage as $msk=>$msv){
	$mSortArr[$msk]=$j;
	$j++;
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
    $monthRowArr[] = $monthRow;
}
$time = time();
$today = date("Y-m", $time);
$lastMonth = $monthRowArr[0]['month'];
if ($today != $lastMonth) {
    if ($month == $today)
        $checkedMonth = "selected";
    else
        $checkedMonth = "";
    echo "<option value='" . $today . "' " . $checkedMonth . ">" . $today . "</option>";
}
foreach ($monthRowArr as $monthVal) {
    $checkedMonth = "";
    if ($month == $monthVal['month'])
        $checkedMonth = "selected";
    echo "<option value='$monthVal[month]' " . $checkedMonth . ">$monthVal[month]</option>";
}
?>
</select></div>
<br>
<H3 class="red">特别提醒:目前的评议得分的计算结果只统计已签收人员的部分</H3>
<?php
if ($wInfoArr[$_SESSION['UserName']]['RoleID'] == "40") {
    ?>
<p>评议表(员工)缴交概况:</p>
<form name=wForm id=wForm>
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>已签收</th>
		<th>未缴/未签收</th>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
			<td width=50%><?php
    if ($wExistsArr)
        foreach ($wExistsArr as $wV) {
            if ($wStatus[$wV] == '1') {
                echo "<input type=checkbox name=wCheck[] value='" . $month . "," . $wV . ",$wStatus[$wV]' >";
                echo "<a href=numList.php?month=$month&actionPer=" .urlencode($wV)."&type=w target=_blank>" . $wV . "</a>&nbsp;&nbsp;&nbsp;";
            } 
        }
    ?></td>
			<td width=50%><?php
    if ($wNotExistsArr)
        foreach ($wNotExistsArr as $wNV) {
            echo $wNV . "&nbsp;&nbsp;&nbsp;";
        }
    foreach ($wExistsArr as $wV) {
        if ($wStatus[$wV] != '1') {
            echo "<input type=checkbox name=wCheck[] value=" . $month . "," . $wV . " >";
            echo "<a href=numList.php?month=$month&actionPer=" .urlencode($wV)."&type=w target=_blank>" . $wV . "</a>&nbsp;&nbsp;&nbsp;";
        }
    }
    ?></td>
		</tr>
		<tr>
			<td><input	type="button" class="updateBtn" name="reGrade" value="退回"></td>
			<td><input type="button" class="updateBtn"	name="pass" value="签收" /></td>
		</tr>

	</tbody>
</table>

</form>
<p>评议表(管理层)缴交情况:</p>
<form name=mForm id=mForm>
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>已签收</th>
		<th>未缴/未签收</th>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
			<td width=50%><?php
    if ($mExistsArr)
        foreach ($mExistsArr as $mV) {
            if ($mStatus[$mV] == '1') {
                echo "<input type=checkbox name=mCheck[] value=" . $month . "," . $mV . " >";
                echo "<a href=numList.php?month=$month&actionPer=" . urlencode($mV) . "&type=m target=_blank>" . $mV . "</a>&nbsp;&nbsp;&nbsp;";
            }
        }
    ?></td>
			<td width=50%><?php
    if ($mNotExistsArr)
        foreach ($mNotExistsArr as $mNV) {
            echo $mNV . "&nbsp;&nbsp;&nbsp;";
        }
    foreach ($mExistsArr as $mV) {
        if ($mStatus[$mV] != '1') {
            echo "<input type=checkbox name=mCheck[] value=" . $month . "," . $mV . " >";
            echo "<a href=numList.php?month=$month&actionPer=" . urlencode($mV) . "&type=m target=_blank>" . $mV . "</a>&nbsp;&nbsp;&nbsp;";
        }
    }
    ?></td>
		</tr>
		<tr>
			<td><input type="button" class="updateBtn" name="reGrade" value="退回"></td>
		    <td><input type="button" class="updateBtn"	name="pass" value="签收" /></td>
		</tr>
	</tbody>
</table>
</form>


<p>当前评分概况(员工):</p>
<form action="" id="wAverageForm"><input type="hidden" name="month"
	value=<?php
    echo $month;
    ?> />
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
	   <th>总排名</th>
		<th>姓名</th>
		<th>最后加权分</th>
		<th>公司平均分</th>
		<th>评议系数</th>
		<th>本月评议比例</th>
		<th>量化系数</th>
		<th>本月量化比例</th>
		<th>奖励</th>
		<th>本月应发绩效工资</th>
		<th>实发绩效工资</th>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
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
        echo "<tr>";
        echo "<td width=14%>".$wSortArr[$wUserKey]."</td>
		<td width=14%><a href=numList.php?month=$month&userName=" . urlencode($wUserKey) . " target=_blank>" . $wUserKey . "</a></td>
                      <td width=14%>" . $personalAverage . "</td>
                      <td width=14%>" . $departmentAverage . "</td>
                       <td width=14%><span class='pyxs'>" . $pyxs . "</span></td>
					  <td><input type=text name=pyPersent[$wUserKey] class='blur'  value='" . $pyPersent . "' size=5 /></td>
					  <td width=14%><input name= lhxs[$wUserKey] class='blur'  type=text value='$lhxs' size=5 /></td>
					  <td><input type=text name=lhPersent[$wUserKey] class='blur' value='" . $lhPersent . "' size=5 /></td>
					  <td><input name=reward[$wUserKey] type=text class='blur'  value='" . $exitsAverageArr[$wUserKey]['reward'] . "' size=5 /></td>
					  <td width=14%><input type=text name=salary[$wUserKey] class='blur'    value='" . $salary . "' size=5 /></td>					
					  <td width=16%><input type=text readonly name= resultSalary[$wUserKey]></td>";
        echo "</tr>";
        //        $resultSalary = number_format(($wUserVal[0]['salary'] * ($pyxs * $wUserVal[0]['pyPersent'] + $lhxs * $wUserVal[0]['lhPersent']) + $exitsAverageArr[$wUserKey]['reward']), 2, ".", "");
    //        $wAverRet[] = array("userName" => $wUserKey , "personalAverage" => $personalAverage , "departmentAverage" => $departmentAverage , "pyxs" => $pyxs , "lhxs" => $lhxs , "reward" => $exitsAverageArr[$wUserKey]['reward'] , "salary" => $wUserVal[0]['salary'] , "resultSalary" => $resultSalary);
    }
    ?>
	</tbody>
</table>
<input type="button" class="sub" name="save" value="保存" /></form>
<p>当前评分概况(管理层):</p>
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
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
        $personalAverage = number_format($mAverage[$mUserKey], 2, ".", "");
        $departmentAverage = number_format($mDeAverage, 2, ".", "");
        $pyxs = number_format($mAverage[$mUserKey] / $mDeAverage, 3, ".", "");
        echo "<tr>";
        echo "<td width=25%><a href=numList.php?month=$month&userName=" . urlencode($mUserKey) . " target=_blank>" . $mUserKey . "</a></td>
                      <td width=25%>" . $personalAverage . "</td>
                      <td width=25%>" . $departmentAverage . "</td>
                      <td width=25%>" . $pyxs . "</td>";
        echo "</tr>";
    }
    ?>
	</tbody>
</table>
<?php
} else {
    ?>

<p>评议表(员工)缴交概况:</p>
<form name=wForm id=wForm>
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>已签收</th>
		<th>未缴/未签收</th>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
			<td width=50%><?php
    if ($wExistsArr)
        foreach ($wExistsArr as $wV) {
            if ($wStatus[$wV] == '1') {
                // echo "<input type=checkbox name=wCheck[] value='" . $month . "," . $wV . ",$wStatus[$wV]' >";
                echo  $wV."&nbsp;&nbsp;&nbsp;"  ;
            } 
        }
    ?></td>
			<td width=50%><?php
    if ($wNotExistsArr)
        foreach ($wNotExistsArr as $wNV) {
            echo $wNV . "&nbsp;&nbsp;&nbsp;";
        }
    foreach ($wExistsArr as $wV) {
        if ($wStatus[$wV] != '1') {
            echo "<input type=checkbox name=wCheck[] value=" . $month . "," . $wV . " >";
            echo  $wV."&nbsp;&nbsp;&nbsp;" ;
        }
    }
    ?></td>
		</tr>

	</tbody>
</table>

</form>
<p>评议表(管理层)缴交情况:</p>
<form name=mForm id=mForm>
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>已签收</th>
		<th>未缴/未签收</th>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
			<td width=50%><?php
    if ($mExistsArr)
        foreach ($mExistsArr as $mV) {
            if ($mStatus[$mV] == '1') {
                // echo "<input type=checkbox name=mCheck[] value=" . $month . "," . $mV . " >";
                echo $mV."&nbsp;&nbsp;&nbsp;"  ;
            }
        }
    ?></td>
			<td width=50%><?php
    if ($mNotExistsArr)
        foreach ($mNotExistsArr as $mNV) {
            echo $mNV . "&nbsp;&nbsp;&nbsp;";
        }
    foreach ($mExistsArr as $mV) {
        if ($mStatus[$mV] != '1') {
             echo "<input type=checkbox name=mCheck[] value=" . $month . "," . $mV . " >";
            echo  $mV."&nbsp;&nbsp;&nbsp;" ;
        }
    }
    ?></td>
		</tr>

	</tbody>
</table>
</form>

<p>当前评分概况(员工):</p>
<form action="" id="wAverageForm"><input type="hidden" name="month"
	value=<?php
    echo $month;
    ?> />
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th>总排名</th>
		<th>姓名</th>
		<th>最后加权分</th>
		<th>部门平均分</th>
		<th>评议系数</th>
		<th>本月评议比例</th>
		<th>量化系数</th>
		<th>本月量化比例</th>
		<th>奖励</th>
		<th>本月应发绩效工资</th>
		<th>实发绩效工资</th>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
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
        echo "<tr>";
        echo "<td width=14%>".$wSortArr[$wUserKey]."</td>
		<td width=14%>" . $wUserKey . "</a></td>
                      <td width=14%>" . $personalAverage . "</td>
                      <td width=14%>" . $departmentAverage . "</td>
                       <td width=14%><span class='pyxs'>" . $pyxs . "</span></td>
					  <td><input type=text name=pyPersent[$wUserKey] class='blur'  value='" . $pyPersent . "' size=5 /></td>
					  <td width=14%><input name= lhxs[$wUserKey] class='blur'  type=text value='$lhxs' size=5 /></td>
					  <td><input type=text name=lhPersent[$wUserKey] class='blur' value='" . $lhPersent . "' size=5 /></td>
					  <td><input name=reward[$wUserKey] type=text class='blur'  value='" . $exitsAverageArr[$wUserKey]['reward'] . "' size=5 /></td>
					  <td width=14%><input type=text name=salary[$wUserKey] class='blur'    value='" . $salary . "' size=5 /></td>					
					  <td width=16%><input type=text readonly name= resultSalary[$wUserKey]></td>";
        echo "</tr>";
    //        $resultSalary = number_format(($wUserVal[0]['salary'] * ($pyxs * $wUserVal[0]['pyPersent'] + $lhxs * $wUserVal[0]['lhPersent']) + $exitsAverageArr[$wUserKey]['reward']), 2, ".", "");
    //        $wAverRet[] = array("userName" => $wUserKey , "personalAverage" => $personalAverage , "departmentAverage" => $departmentAverage , "pyxs" => $pyxs , "lhxs" => $lhxs , "reward" => $exitsAverageArr[$wUserKey]['reward'] , "salary" => $wUserVal[0]['salary'] , "resultSalary" => $resultSalary);
    }
    ?>
	</tbody>
</table>
</form>
<p>当前评分概况(管理层):</p>
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
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
        $personalAverage = number_format($mAverage[$mUserKey], 2, ".", "");
        $departmentAverage = number_format($mDeAverage, 2, ".", "");
        $pyxs = number_format($mAverage[$mUserKey] / $mDeAverage, 3, ".", "");
        echo "<tr>";
        echo "<td width=25%>" . $mUserKey . "</td>
                      <td width=25%>" . $personalAverage . "</td>
                      <td width=25%>" . $departmentAverage . "</td>
                      <td width=25%>" . $pyxs . "</td>";
        echo "</tr>";
    }
    ?>
	</tbody>
</table>
<?php
}
?>
<form action="detail.excel.php?month=<?php
echo $month;
?>"
	method="post" target="_blank"><input type="submit" name="intoExcel"
	value="导出为EXCEL" /></form>
</body>
</html>