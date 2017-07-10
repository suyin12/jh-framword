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
if (! $_SESSION['UserName'])
    exit("页面已失效,请重新登陆");
    //所有员工的信息
$wInfoSql = "select * from cwps_user where groupID like '13'";
$wInfoRet = mysql_query($wInfoSql);
while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
    $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
}
// print_r($_SESSION);
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
	       window.location.href="perDetail.php?month="+$(this).val();
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
$wAverageSql = "select a.* ,b.pyPersent as pyPersent,b.lhPersent as lhPersent,b.salary as salary from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.status like '1' and b.subGroupIDs not like ',17,' and b.userName is not null order by b.id";
$wAverageRet = mysql_query($wAverageSql);
while ($wAverageRow = mysql_fetch_assoc($wAverageRet)) {
    $wGradeArr[$wAverageRow['userName']][] = $wAverageRow;
}
// echo "<pre>";
// print_r($wGradeArr);
foreach ($wGradeArr as $wGAK => $wGAV) {
    $x1 = $x2 = $x3 = $x4 = $x5 = 0;
    $x2_num = $x3_num = $x4_num = 0;
    $r1 = $r2 = $r3 = $r4 = $r5 = NULL;
    foreach ($wGAV as $wAK => $wAV) {
        $gradeArr = explode(",", $wAV['gradeStr']);
        //1.提出本人的情况
        if ($wGAK == $wAV['actionPer']) {
            foreach ($gradeArr as $gK => $gV) {
                $r1[$gK] = $gV * 0.1;
            }
            $x1 = $wAV['total'] * 0.1;
        } elseif ($wAV['actionPerGroupID'] == ',17,') {
            //2.提出领导层人员,再划分为部长和总经理两部分人员(这里估计要用土招,直接猎取总经理)
            if ($wInfoArr[$wAV['actionPer']]['RoleID'] == "40") {
                foreach ($gradeArr as $gK => $gV) {
                    $r5[$gK] = $gV * 0.1;
                }
                $x5 = $wAV['total'] * 0.1;
            } else {
                foreach ($gradeArr as $gK => $gV) {
                    $r4[$gK] += $gV * 0.3;
                }
                $x4 += $wAV['total'] * 0.3;
                $x4_num += 1;
            }
        } else {
            //3.剩下的就是员工的人员,再换分为本部门和其他部门
            if ($wAV['actionPerGroupID'] == $wAV['userGroupID']) {
                foreach ($gradeArr as $gK => $gV) {
                    $r2[$gK] += $gV * 0.35;
                }
                $x2 += $wAV['total'] * 0.35;
                $x2_num += 1;
            } else {
                foreach ($gradeArr as $gK => $gV) {
                    $r3[$gK] += $gV * 0.15;
                }
                $x3 += $wAV['total'] * 0.15;
                $x3_num += 1;
            }
        }
    }
    foreach ($gradeArr as $gK => $gV) {
        $wGradeStrAvg[$wGAK][$gK] = $r1[$gK] + ($r2[$gK] / $x2_num) + ($r3[$gK] / $x3_num) + ($r4[$gK] / $x4_num) + $r5[$gK];
    }
    $wAverage[$wGAK] = $x1 + ($x2 / $x2_num) + ($x3 / $x3_num) + ($x4 / $x4_num) + $x5;
}
$mAverageSql = "select a.* from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.status like '1' and b.subGroupIDs  like ',17,' and b.userName is not null order by b.id";
$mAverageRet = mysql_query($mAverageSql);
while ($mAverageRow = mysql_fetch_assoc($mAverageRet)) {
    $mGradeArr[$mAverageRow['userName']][] = $mAverageRow;
}
unset($gradeArr);
foreach ($mGradeArr as $mGAK => $mGAV) {
    $y1 = $y2 = $y3 = $y4 = $y5 = 0;
    $y2_num = $y3_num = $y4_num = 0;
    $s1 = $s2 = $s3 = $s4 = $s5 = NULL;
    foreach ($mGAV as $mAK => $mAV) {
        $gradeArr = explode(",", $mAV['gradeStr']);
        //1.提出本人的情况
        if ($mGAK == $mAV['actionPer']) {
            foreach ($gradeArr as $gK => $gV) {
                $s1[$gK] += $gV * 0.1;
            }
            $y1 = $mAV['total'] * 0.1;
        } elseif ($mAV['actionPerGroupID'] == ',17,') {
            //2.提出领导层人员,再划分为部长和总经理两部分人员(这里估计要用土招,直接猎取总经理)
            if ($wInfoArr[$mAV['actionPer']]['RoleID'] == "40") {
                foreach ($gradeArr as $gK => $gV) {
                    $s5[$gK] += $gV * 0.2;
                }
                $y5 = $mAV['total'] * 0.2;
            } else {
                foreach ($gradeArr as $gK => $gV) {
                    $s4[$gK] += $gV * 0.2;
                }
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
                foreach ($gradeArr as $gK => $gV) {
                    $s2[$gK] += $gV * 0.3;
                }
                $y2 += $mAV['total'] * 0.3;
                $y2_num += 1;
            } else {
                foreach ($gradeArr as $gK => $gV) {
                    $s3[$gK] += $gV * 0.2;
                }
                $y3 += $mAV['total'] * 0.2;
                $y3_num += 1;
            }
        }
    }
    foreach ($gradeArr as $gK => $gV) {
        $mGradeStrAvg[$mGAK][$gK] = $s1[$gK] + ($s2[$gK] / $y2_num) + ($s3[$gK] / $y3_num) + ($s4[$gK] / $y4_num) + $s5[$gK];
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
$monthSql = "SELECT DISTINCT month FROM `grade_number` where month >'2010-09' order by month desc";
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
<?php
if ($wInfoArr[$actionPer]['SubGroupIDs'] != ",17,") {
    ?>
<p>当前评分概况(员工):</p>
<table  width="1150px"  class="gradeTable" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
			
			<th colspan="4" align="center" valign="bottom">工作态度（55分）</th>
			<th colspan="3" align="center" valign="bottom">工作业绩（45分）</th>
	    </tr>
		<tr class="maxNumRow">
			<th align="center" valign="bottom">工作努力创新,主动提高业务能力及个人素质<br />
			（<span class="maxNum">10</span>分)</th>
			<th align="center" valign="bottom">严格遵守工作纪律及各项规章制度<br />
			（<span class="maxNum">15</span>分)</th>
			<th align="center" valign="bottom">能够积极主动沟通，协调、配合客户、上级、同事按时完成工作<br />
			（<span class="maxNum">15</span>分）</th>
			<th align="center" valign="bottom">工作责任感强，勇于承担责任并积极改进<br />
			（<span class="maxNum">15</span>分 </th>
			<th align="center" valign="bottom">工作量饱和，具良好敬业精神，愿意主动承担工作量<br />
			（<span class="maxNum">15</span>分）</th>
			<th align="center" valign="bottom">工作效率高，能积极有效地完成工作，不延误、拖拉<br />
			（<span class="maxNum">15</span>分）</th>
			<th align="center" valign="bottom">工作完成正确、清晰,质量高，无错漏 <br />
			（<span class="maxNum">15</span>分）</th>
		</tr>
	</thead>
	<tbody>
		<tr bgcolor="#ffffff">
	  <?php
    foreach ($wGradeStrAvg as $wGSAK => $wGSAV) {
        if ($wGSAK == $actionPer) {
            foreach ($wGSAV as $wGSAVV) {
                echo "<td>" . number_format($wGSAVV, 2, ".", "") . "</td>";
            }
        }
    }
    ?>
	</tr>
	</tbody>
</table>

<p>概况统计</p>
<table width="1150px" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
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
		</tr>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
    $exitsAverageSql = "select * from grade_persent where month like '$month'";
    $exitsAverageRet = mysql_query($exitsAverageSql);
    while ($eARow = mysql_fetch_assoc($exitsAverageRet)) {
        $exitsAverageArr[$eARow['userName']] = $eARow;
    }
    foreach ($wGradeArr as $wUserKey => $wUserVal) {
        if ($wUserKey == $actionPer) {
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
    }
    ?>
	</tbody>
</table>
<table>
  <?php
    ?>
   <tr></tr>

</table>
<?php
} else {
    ?>
<p>当前评分概况(管理层):</p>
<table width="1150px" class="gradeTable" border="0" cellspacing="1" bgcolor="#666666">
	<div class="fix" >
	<thead bgcolor="#ffffff">
	  <tr>
	    
	    <th colspan="4" align="center" valign="middle">管理能力(每项12.5分,共50分)	</th>
	    <th colspan="2" align="center" valign="middle">工作态度（每项12.5分,共25分）</th>
	    <th colspan="2" align="center" valign="middle">工作业绩（每项12.5分,共25分）</th>
	    <th rowspan="2" align="center" valign="middle">总评分</th>
	    <th rowspan="2" align="center" valign="middle">意见或建议</th>
	  </tr>
	  <tr class="maxNumRow">
	    <th align="center" valign="middle">能够积极学习并运用熟练的专业知识、机智灵活、有效、得当地处理业务（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">顾全大局、勇于承担责任、积极改进工作作风及方法（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">能较好地沟通协调客户、部门及同事的关系，具较强业务处理能力（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">积极培养、挖掘员工潜力、激发工作热情，部门管理到位，妥善舒解员工情绪（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">能够以身作则、自觉遵守各项规章制度，起到带头模范作用（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">工作积极主动、计划性强、执行力高，持之以恒，勇于克服困难（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">工作量饱和，具良好敬业精神，愿意主动承担工作量（<span class="maxNum">12.5</span>分）</th>
	    <th align="center" valign="middle">工作效率高、不延误拖拉，完成质量高，无错漏 (<span class="maxNum">12.5</span>分）</th>
	  </tr>
	</thead>
	<tbody>
		<tr bgcolor="#ffffff">
	  <?php
    foreach ($mGradeStrAvg as $mGSAK => $mGSAV) {
        if ($mGSAK == $actionPer) {
            foreach ($mGSAV as $mGSAVV) {
                echo "<td>" . number_format($mGSAVV, 2, ".", "") . "</td>";
            }
        }
    }
    ?>
	</tr>
	</tbody>
</table>
<p>概况统计</p>
<table width="1150px" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<th></th>
		<th>最后加权分</th>
		<th>部门平均分</th>
		<th>绩效系数</th>
		<th>意见及建议</th>
	</thead>
	<tbody bgcolor="#ffffff">
	     <?php
    foreach ($mGradeArr as $mUserKey => $mUserVal) {
        if ($mUserKey == $actionPer) {
            $mDeAverage = $mTotal['total'] / $mTotal['num'];
            echo "<tr>";
            echo "<td width=20%>" . $mUserKey . "</td>
                      <td width=20%>" . number_format($mAverage[$mUserKey], 2, ".", "") . "</td>
                      <td width=20%>" . number_format($mDeAverage, 2, ".", "") . "</td>
                      <td width=20%>" . number_format($mAverage[$mUserKey] / $mDeAverage, 3, ".", "") . "</td>";
            echo "<td width=20%>";
            foreach ($mUserVal as $mUserK => $mUserV) {
                if ($mUserV['remarks']) {
                    echo "* . ";
                    echo $mUserV['remarks'] . "<br/>";
                }
            }
            echo "</td> ";
            echo "</tr>";
        }
    }
    ?>
	</tbody>
</table>
<?php
}
?>

</div>
</body>
</html>
