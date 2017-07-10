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
	        ret = confirm("临时保存评分结果?提示：这将会清除历史暂存记录");
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
					var k = i%7;
					var max = Number($(".maxNum").eq(k).html());
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
						var k = i%7;
						var max = Number($(".maxNum").eq(k).html());
						var num = $(this).val();
						if(!isNaN(num)){
						    if(!num || num <= 0){
	                            error = "输入的数字不能为'空'或者小于等于'0'";
							}
						    else if(num>max){
	                              error = "您的评分超过最高值 : "+ max;
							}else{
								num=formatFloat(num,1);
								$(this).val(num);
						    	 var j = parseInt(i/7) ;
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
				       newI = newK*7+newJ;
				       $("input[name^=grade]").eq(newI).focus();
					}
					break;
				case 13:
					newK = k+1;
				     newJ = j;
				     newI = newK*7+newJ;
				       $("input[name^=grade]").eq(newI).focus();
				break;
				case 40:
					       newK = k+1;
					       newJ = j;
					       newI = newK*7+newJ;
					       $("input[name^=grade]").eq(newI).focus();
					break;
				case 37:
					if((j-1)>=0){
					       newK = k;
					       newJ = j-1;
					       newI = newK*7+newJ;
					       $("input[name^=grade]").eq(newI).focus();
						}
					
					break;
				case  39:
					    newK = k;
				       newJ = j+1;
				       newI = newK*7+newJ;
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
$monthSql = "SELECT DISTINCT month FROM `grade_number` where month > '2010-09' order by month desc";
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
<p style="color:red;font-size: 24px;">考评标准: 优秀：12-15  &nbsp &nbsp &nbsp &nbsp     较好：8-11分 &nbsp &nbsp &nbsp &nbsp &nbsp     一般：4-7  &nbsp &nbsp &nbsp &nbsp    较差：0-3</p>
<input type="hidden" name="type" value="w">
<div class="fixedTable">
<table  width="850px"  class="gradeTable" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff" style="font-size:11px">
		<tr>
			<th rowspan="2" width="50px" align="center" valign="bottom" class="fixedCol">姓名</th>
			<th colspan="4" align="center" valign="bottom">工作态度（55分）</th>
			<th colspan="3" align="center" valign="bottom">工作业绩（45分）</th>
			<th rowspan="2" align="center" valign="bottom">总评分</th>
			<th rowspan="2" align="center" valign="bottom">意见或建议</th>
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
		<td><input type="text" size=6 class="num" name="grade[<?php echo $i;?>][0]"  value="<?php echo $gradeStr[0]?>"  /> </td>
		<td><input type="text" size=6  class="num" name="grade[<?php echo $i;?>][1]"  value="<?php echo $gradeStr[1]?>" /> </td>
		<td><input type="text" size=6  class="num" name="grade[<?php echo $i;?>][2]"  value="<?php echo $gradeStr[2]?>" /> </td>
		<td><input type="text" size=6  class="num" name="grade[<?php echo $i;?>][3]" " value="<?php echo $gradeStr[3]?>" /> </td>
		<td><input type="text" size=6  class="num" name="grade[<?php echo $i;?>][4]"  value="<?php echo $gradeStr[4]?>" /> </td>
		<td><input type="text" size=6  class="num" name="grade[<?php echo $i;?>][5]"  value="<?php echo $gradeStr[5]?>" /> </td>
		<td><input type="text" size=6  class="num" name="grade[<?php echo $i;?>][6]"  value="<?php echo $gradeStr[6]?>" /> </td>
		<td><input type="text" size=6  readonly  class="num" name="total[]" value="<?php echo $row['total']; ?>" /> </td>
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
