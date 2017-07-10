<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/*
*     2010-2-21   
*          <<<  >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
@session_start();
include_once ("../settings.inc");
//if(!$_SESSION['UserName'])exit("页面已失效,请重新登陆");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	    $(".month").change(function(){
		       window.location.href="gradePage.php?month="+$(this).val();
		    });

		$(".subTemp").click(function(){
		    var t = "post";
	        var u = "sqlAction.php";
	        var d = "subTemp=1&"+$("#gradeForm").serialize();
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
        	 ret = confirm("临时保存评分结果?提示：这将会清除过去的暂存记录及其评议表（管理层）的暂存记录");
	        if (ret == true ) {
	          
	           	   ajaxAction(t, u, d, dt, m);
	        }
	        else {
	            return false;
	        }
 		});
		
	    $(".sub").click(function(){
	    	var t = "post";
	        var u = "sqlAction.php";
	        var d = "sub=1&"+$("#gradeForm").serialize();
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
        	 ret = confirm("评分完毕?");
	        if (ret == true ) {
	           var valid = validData();
	            if(valid == true)
	           	   ajaxAction(t, u, d, dt, m);
				else
                   alert(valid);				
	        }
	        else {
	            return false;
	        }
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
    function validData(){
    	var error;
    	$("input[name^=grade]").each(
    			function(i){
					var k = i%16;
					var max = parseInt($(".maxNum").eq(k).html());
					var num = $(this).val();
					if(!isNaN(num)){
					    if(!num || num <= 0){
                            error = "输入的数字不能为'空'或者小于等于'0'";
						}
					    else if(num>max){
                            error = "您的评分超过最高值 : "+ max;
						}
					}
					else{
						error = "请输入数字";
					}
					if(error){
						       $(this).addClass("errorInput");
						       return false;
						   }else{
							   $(this).removeClass("errorInput");
							   }
        });
        if(!error)
           return true;
		else
           return error;		
    }
	
	
		function formatFloat(src, pos)
		{
			return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
		}

	$("input[name^=grade]").each(
			function(i){
				var focusI= i;
				$(this).blur(function(){
						var error;
						var k = i%16;
						var max = parseInt($(".maxNum").eq(k).html());
						var num = $(this).val();
						if(!isNaN(num)){
						    if(!num || num <= 0){
	                            error = "输入的数字不能为'空'或者小于等于'0'";
							}
						    else if(num>max){
	                              error = "您的评分超过最高值 : "+ max;
							}else{
						    	 var j = parseInt(i/16) ;
	                             var total= 0 ;
	                             $("input[name^=grade["+j+"]]").each(function(x){
										var value = Number($(this).val());
										if( !value )
		                                     value=0;
										total += value;
	                                 });
	                              total =formatFloat(total,2);
	                             $("input[name=total[]]").eq(j).val(total);
						    }
						}
						else{
							error = "请输入数字";
						}
						if(error){
						   // alert(error);
						   $(this).addClass("errorInput");
						}else{
                           $(this).removeClass("errorInput");
						}
					});
				}
			);
			
			function init(){
		 document.onmousemove = mouseMove; 
		}

		var mouseleft = 0;
		var mousetop = 0;
		function mouseMove(e){
		  if(!document.all){ 
			   mouseleft=e.pageX; 
			   mousetop=e.pageY; 
		  }else{ 
			   mouseleft=document.body.scrollLeft+event.clientX; 
			   mousetop=document.body.scrollTop+event.clientY; 
		  } 
		}

		$('.maxNumRow th').each(function(i){
                  $(this).hover(function(){
            			$(".hiddenRemarks").eq(i).css({"position": "absolute","display":"block"})   
         			   .animate({left: mouseleft, top: mousetop, opacity: "show" }, "fast");;	
            		},function(){
            			$(".hiddenRemarks").eq(i).css({"display":"none"}).animate({left: 0, top: 0, opacity: "hide" }, "slow");
            		});
			});
	
		$(document).keydown(function(keyE){
			currentName = document.activeElement.name;
			 currentArr = currentName.match(/\d+/g);
		     var k =Number(currentArr[0]);
		     var j = Number(currentArr[1]);
		     var key = keyE.keyCode
		     var newK=0;
		     var newJ =0;
			switch(key){
				case 38:
					if((k-1)>=0){
				       newK = (k-1);
				       newJ = j;
				       newI = newK*16+newJ;
				       $("input[name^=grade]").eq(newI).focus();
					}
					break;
				case 13:
					newK = k+1;
				     newJ = j;
				     newI = newK*16+newJ;
				       $("input[name^=grade]").eq(newI).focus();
				break;
				case 40:
					       newK = k+1;
					       newJ = j;
					       newI = newK*16+newJ;
					       $("input[name^=grade]").eq(newI).focus();
					break;
				case 37:
					if((j-1)>=0){
					       newK = k;
					       newJ = j-1;
					       newI = newK*16+newJ;
					       $("input[name^=grade]").eq(newI).focus();
						}
					
					break;
				case  39:
					    newK = k;
				       newJ = j+1;
				       newI = newK*16+newJ;
				       $("input[name^=grade]").eq(newI).focus();
					break;
							}
			});
		
});

</script>
<style type="text/css">
.errorInput{
  background:#d685b7;
}
.hiddenRemarks {
	display: none;
	z-index: 9999;
	margin: 0 auto;
	width: 150px;
	float : left;
	padding: 10px;
	position: absolute;
	background: #d3ecd0;
	padding: 10px;
	float: left;
    color:#000000;
}
.fixedTable{
{ 
  width:100%; 
  height:100%; 

}

.fixedRowCol
{ z-index:999; 
  position: relative; 
  top: expression(this.offsetParent.scrollTop); 
  left: expression(this.offsetParent.scrollLeft);
  
}  
.fixedCol
{   z-index:666; 
	position: relative; 
	left: expression(this.offsetParent.scrollLeft);
	background:#CCFFFF;
   
}  

.fixedRow
{ 
  position: relative; 
  top: expression(this.offsetParent.scrollTop); 
} 

</style>


<?php
	$month = $_GET['month'];
	if(!$month)exit("非法网址");
	if($month){
	    $actionPer = $_SESSION['UserName'];
	    $existsSql ="select a.* from grade_number a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.actionPer like '$actionPer' and b.subGroupIDs not like ',17,' and b.userName is not null ORDER BY b.id";
		$existsRet = mysql_query($existsSql);
		// $exceptExistsSql = "select b.userName from grade_number a right join grade_filter b on a.userName=b.userName where a.month like '$month' and a.actionPer like '$actionPer' and b.subGroupIDs not like ',17,' and a.userName is null ORDER BY b.id";
		// $exceptExistsRet = mysql_query($exceptExistsSql);
		
		$existsTempSql ="select a.* from grade_number_temp a left join grade_filter b on a.userName=b.userName where a.month like '$month' and a.actionPer like '$actionPer' and b.subGroupIDs not like ',17,' and b.userName is not null ORDER BY b.id";
		$existsTempRet = mysql_query($existsTempSql);
	}
	$sql = "select userName from grade_filter where  subGroupIDs not like ',17,' and status like '1' ORDER BY id ";
	$ret = mysql_query($sql);

	if(mysql_num_rows($existsRet)>0){
        $ret = $existsRet;
		$exists = 1;
        // $receive = mysql_fetch_assoc($existsRet);        
	}elseif(@mysql_num_rows($existsTempRet)>0){
	    $ret =$existsTempRet;
	}
?>
<form action=""  id="gradeForm">
<div class="bd_xuanze">
请选择要评议的月份 

<select class="month" name="month">
<?php 
$monthSql = "SELECT DISTINCT month FROM `grade_number` order by month desc";
$monthRet = mysql_query($monthSql);

while($monthRow = mysql_fetch_assoc($monthRet)){
    $monthRowArr[]= $monthRow;
}
 $time = time();
	 $today= date("Y-m",$time);
	 $lastMonth=$monthRowArr[0]['month'];
	 if($today !=$lastMonth){
	     if($month == $today)
            $checkedMonth = "selected";
         else
            $checkedMonth = "";		 
	     echo "<option value='".$today."' ".$checkedMonth.">".$today."</option>";
	}
  foreach ($monthRowArr as $monthVal){
      $checkedMonth="";
      if($month == $monthVal['month'])
         $checkedMonth = "selected";
      echo "<option value='$monthVal[month]' ".$checkedMonth.">$monthVal[month]</option>";
  }
	
?>
</select>
</div>

<input type="hidden" name="type" value="w">
<div class="fixedTable">
<table  width="1150px"  class="gradeTable" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
			<th rowspan="2" width="50px" align="center" valign="bottom" class="fixedCol">姓名</th>
			<th colspan="2" align="center" valign="bottom">基本能力（20分）</th>
			<th colspan="6" align="center" valign="bottom">业务能力（36分）</th>
			<th colspan="5" align="center" valign="bottom">工作态度（20分）</th>
			<th colspan="3" align="center" valign="bottom">工作业绩（24分）</th>
			<th rowspan="2" align="center" valign="bottom">总评分</th>
			<th rowspan="2" align="center" valign="bottom">意见或建议</th>
		</tr>
		<tr class="maxNumRow">
			<th align="center" valign="bottom">基础知识<br />
			（<span class="maxNum">8</span>分)<span class="hiddenRemarks">是否具备胜任本职工作的基础知识及相关政策法规</span></th>
			<th align="center" valign="bottom">业务知识<br />
			（<span class="maxNum">12</span>分）<span class="hiddenRemarks">是否具备胜任本职工作的专业知识和实际工作技能</span></th>
			<th align="center" valign="bottom">理解力<br />
			（<span class="maxNum">6</span>分）<span class="hiddenRemarks">是否能充分理解上级指示，干脆利落地完成本职工作任务</span></th>
			<th align="center" valign="bottom">判断力<br />
			（<span class="maxNum">6</span>分）<span class="hiddenRemarks">是否能充分理解上级意图，正确把握现状，随机应变，恰当处理</span></th>
			<th align="center" valign="bottom">表达力<br />
			（<span class="maxNum">6</span>分）<span class="hiddenRemarks">是否具备现任职务所要求的表达力，能否进行一般联络、说明工作</span></th>
			<th align="center" valign="bottom">创新力<br />
			（<span class="maxNum">6</span>分）<span class="hiddenRemarks">是否善于发现工作中的薄弱环节，不断改进自己的工作，积极制定工作目标和改进措施及提出合理化建议<</span></th>
			<th align="center" valign="bottom">学习力<br />
			（<span class="maxNum">6</span>分）<span class="hiddenRemarks">接受新知识的速度、方法、积极性</span></th>
			<th align="center" valign="bottom">沟通力<br />
			（<span class="maxNum">6</span>分）<span class="hiddenRemarks">在和单位内外的人员沟通时，是否具备使双方诚服接受同意或达成协议的能力</span></th>
			<th align="center" valign="bottom">纪律性<br />
			（<span class="maxNum">4</span>分）<span class="hiddenRemarks">是否严格遵守工作纪律和规章制度</span></th>
			<th align="center" valign="bottom">协作性<br />
			（<span class="maxNum">4</span>分）<span class="hiddenRemarks">在工作中是否充分考虑别人的处境，是否主动协助上级、同事做好工作</span></th>
			<th align="center" valign="bottom">积极性<br />
			（<span class="maxNum">4</span>分）<span class="hiddenRemarks">对分配的工作是否不讲条件，主动积极</span></th>
			<th align="center" valign="bottom">责任感<br />
			（<span class="maxNum">4</span>分）<span class="hiddenRemarks">能否主动承担责任，主动进行改进，向困难挑战</span></th>
			<th align="center" valign="bottom">执行力<br />
			（<span class="maxNum">4</span>分）<span class="hiddenRemarks">对领导分配的任务是否能积极、按时完成</span></th>
			<th align="center" valign="bottom">工作量<br />
			（<span class="maxNum">8</span>分）<span class="hiddenRemarks">工作量是否饱和，是否能充分安排工作时间完成工作任务</span></th>
			<th align="center" valign="bottom">工作效率<br />
			（<span class="maxNum">8</span>分）<span class="hiddenRemarks">积极完成工作，不浪费时间，积极主动提高工作效率</span></th>
			<th align="center" valign="bottom">工作质量<br />
			（<span class="maxNum">8</span>分）<span class="hiddenRemarks">工作完成是否正确、清晰。质量高，无错漏。</span></th>
		</tr>
	</thead>

	<tbody bgcolor="#ffffff">
     <?php
     $i=0;

     while ($row = mysql_fetch_assoc($ret)) {
	     
         if($row['gradeStr']){
             $gradeStr = explode(",",$row['gradeStr']);   
             $status = $row['status'];			 
         }else{
             $gradeStr =NULL;
         }
		 if($status != "1"){
     ?>
     <tr>
		<td align="center" class="fixedCol">
		<input type="hidden" name="userName[]" value="<?php echo $row['userName']; ?>">
		<?php
        echo $row['userName'];
        ?>
		</td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][0]" style="width:85%" value="<?php echo $gradeStr[0]?>"  /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][1]" style="width:85%" value="<?php echo $gradeStr[1]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][2]" style="width:85%" value="<?php echo $gradeStr[2]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][3]" style="width:85%" value="<?php echo $gradeStr[3]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][4]" style="width:85%" value="<?php echo $gradeStr[4]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][5]" style="width:85%" value="<?php echo $gradeStr[5]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][6]" style="width:85%" value="<?php echo $gradeStr[6]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][7]" style="width:85%" value="<?php echo $gradeStr[7]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][8]" style="width:85%" value="<?php echo $gradeStr[8]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][9]" style="width:85%" value="<?php echo $gradeStr[9]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][10]" style="width:85%" value="<?php echo $gradeStr[10]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][11]" style="width:85%" value="<?php echo $gradeStr[11]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][12]" style="width:85%" value="<?php echo $gradeStr[12]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][13]" style="width:85%" value="<?php echo $gradeStr[13]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][14]" style="width:85%" value="<?php echo $gradeStr[14]?>" /> </td>
		<td><input type="text" class="num" name="grade[<?php echo $i;?>][15]" style="width:85%" value="<?php echo $gradeStr[15]?>" /> </td>
		<td><input type="text" readonly  class="num" name="total[]" style="width:85%" value="<?php echo $row['total']; ?>" /> </td>
		<td><textarea name="remarks[]" rows="1" cols="15" ><?php echo $row['remarks'];?></textarea> </td>
	</tr>
     <?php
	 }else{
	 ?>
	   <tr>
		<td align="center" class="fixedCol">
		<input type="hidden" name="userName[]" value="<?php echo $row['userName']; ?>">
		<?php
        echo $row['userName'];
        ?>
		</td>
		<td><?php echo $gradeStr[0]?></td>
		<td><?php echo $gradeStr[1]?> </td>
		<td><?php echo $gradeStr[2]?> </td>
		<td><?php echo $gradeStr[3]?> </td>
		<td><?php echo $gradeStr[4]?> </td>
		<td><?php echo $gradeStr[5]?> </td>
		<td><?php echo $gradeStr[6]?> </td>
		<td><?php echo $gradeStr[7]?> </td>
		<td><?php echo $gradeStr[8]?> </td>
		<td><?php echo $gradeStr[9]?> </td>
		<td><?php echo $gradeStr[10]?> </td>
		<td><?php echo $gradeStr[11]?> </td>
		<td><?php echo $gradeStr[12]?> </td>
		<td><?php echo $gradeStr[13]?> </td>
		<td><?php echo $gradeStr[14]?> </td>
		<td><?php echo $gradeStr[15]?> </td>
		<td><?php echo $row['total']; ?> </td>
		<td><?php echo $row['remarks'];?> </td>
	</tr>
	 <?php
	 }
     $i++;
    }
    ?>
	</tbody>
</table>
</div>
<br>

<?php 
//签收确定


if($status!="1"){
?>
<input type="button" class="sub" value="提交" >
<?php if($exists!=1){?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" class="subTemp" value = "临时保存">
<?php }}?>
</form>
</div>

</body>
</html>
