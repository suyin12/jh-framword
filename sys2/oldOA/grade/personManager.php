<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
@session_start();
//error_reporting(E_ALL & ~ (E_NOTICE | E_WARNING));
include_once ("../settings.inc");
//所有员工的信息
$wInfoSql = "select * from cwps_user where groupID like '13' and status like '1'";
$wInfoRet = mysql_query($wInfoSql);
while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
    $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
}
$personSql = "select * from grade_filter order by id";
$personRet = mysql_query($personSql);
while ($personRow = mysql_fetch_assoc($personRet)) {
    $personArr[$personRow['userName']] = array("subGroupIDs" => $personRow['subGroupIDs'] , "salary" => $personRow['salary'] , "pyPersent" => $personRow['pyPersent'] , "lhPersent" => $personRow['lhPersent'] , "status" => $personRow['status'] , "ID" => $personRow['id']);
}
$wInfoName = array_keys($wInfoArr);
$personName = array_keys($personArr);
$extraArr = array_diff($wInfoName, $personName);
	if($_SESSION['SubGroupIDs']!=',17,')exit("无权访问");
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script>
  $(document).ready(function(){
	  function formatFloat(src, pos){
			return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);
		}	   
	  $(":text").each(
				function(i){
					$(this).blur(function(){
							var focusI= i;
							var j = parseInt(i/4) ;						  
							var error;							
							var num = $(this).val();
							if(!isNaN(num)){
							    if( num < 0){
		                            error = "输入的数字不能小于'0'";
								}else{
									var pyVal,lhVal;
									if($(this).attr("name").indexOf("pyPersent") == 0){
										    pyVal = Number ($(this).val());
										    if(pyVal>1){
                                                   error="比例系数不能大于1";
											    }
                                            lhVal = 1 - pyVal;
                                            lhVal =formatFloat(lhVal,4);
                                            $("input[name^=lhPersent]").eq(j).val(lhVal);
										}
							    }
							}else{
								error = "请输入数字";
							}
							if(error){
							   alert(error);
							   $(this).addClass("errorInput");
							}else{
	                           $(this).removeClass("errorInput");
							}
							
						});
					}
				);
	  
	  $(".sub").click(function(){
	    	var t = "post";
	        var u = "sqlAction.php";
	        var d = $(this).attr("name")+"=1&"+$("#personForm").serialize();
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
		       var checkValid= validChecked();
	           var valid = validData();
	           if(checkValid==false){
	            if(valid == true  ){
	            	 ajaxAction(t, u, d, dt, m);
		            }
	           	   
	             }else{
		             alert("请选择需要更改的数据列");
		             }
	        }else {
	            return false;
	        }
      });

   //验证是否选中数据源
	function validChecked(){
		     var checkValue;
            $(":checkbox:checked").each(function(i){
                checkValue +=$(this).val();
                });
          if(IsEmpty(checkValue)==true){
                 return true;
              }else{
                 return false;
              }
		}
   //验证为空
   function IsEmpty(v){
		switch (typeof v){
			case 'undefined' : return true;break;
			case 'string' : if(trim(v).length == 0) return true; break;
			case 'boolean' : if(!v) return true; break;
			case 'number' : if(0 === v) return true; break;
			case 'object' :
					if(null === v) 
					  return true;
					if(undefined !== v.length && v.length==0)
					  return true;
					for(var k in v){
					    	return false;
						}
					 return true;
					break;
	}
	return false;
	}
  //去除空格
 function trim(str){
      return str.replace(/(^[\\s]*)|([\\s]*$)/g, "");
  }	
  //验证输入数据的正确性
  function validData(){
	var error;	
	  $(":text").each(function(i){
							var num = $(this).val();
							if(!isNaN(num)){
							    if( num < 0){
		                            error = "输入的数字不能小于'0'";
								}else{
									if($(this).attr("name").indexOf("pyPersent") == 0){
										   var pyVal;
										    pyVal = Number ($(this).val());
										    if(pyVal>1){
                                                 error="比例系数不能大于1";
											    }
									}}
							}else{
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
  }
				
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
});
</script>
<style type="text/css">
.errorInput{
  background:#d685b7;
}
.hiddenRemarks{
  display:none;
}
.fixedTable{
{ 
  width:700px; 
  height:600px; 
  overflow: auto; 
  position: relative;
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
</head>
<body>
<br>
<span style="color: red; font-size: 20px;">提示:更改某个人的信息时,必须在选择框中打钩</span>
<form name="personForm" id="personForm" action=""><input type="button"
	name="attendSub" class="sub" value="参加评议并更新信息"> <input type="button"
	name="outSub" class="sub" value="退出评议">
<div class="fixedTable">
<table width="90%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#CCFFFF">
		<tr class="fixedRow" >
			<th></th>
			<th>姓名</th>
			<th>绩效工资</th>
			<th>群众评议比例</th>
			<th>量化系数比例</th>
			<th>排序编号</th>
			<th>参与状态</th>
		</tr>
	</thead>
	<tbody bgcolor="#ffffff">
	   <?php
    foreach ($personArr as $perK => $perV) {
        if ($perV['status'] == "1") {
            $status = "参加";
        } else {
            $status = "<span style='color:red'>否</span>";
        }
        echo "<tr>";
        echo "<input type=hidden name=subGroupIDs[$perK] value='" . $wInfoArr[$perK]['SubGroupIDs'] . "' />";
        echo "<td width=5%><input type=checkbox name=checkPer[$perK] value='" . $perK . "' /></td>";
        echo "<td width=14%>" . $perK . "</td>";
        echo "<td width=14%><input type=text name=salary[$perK] value='" . $perV['salary'] . "' size=6 /></td>";
        echo "<td width=14%><input type=text name=pyPersent[$perK] value='" . $perV['pyPersent'] . "' size=6 /></td>";
        echo "<td width=14%><input type=text readonly name=lhPersent[$perK] value='" . $perV['lhPersent'] . "' size=6 /></td>";
        echo "<td width=14%><input type=text name=ID[$perK] value='" . $perV['ID'] . "' size=6  /></td>";
        echo "<td width=16%>" . $status . "</td>";
        echo "</tr>";
    }
    foreach ($extraArr as $extraK => $extraV) {
        echo "<tr>";
        echo "<input type=hidden name=subGroupIDs[$extraV] value='" . $wInfoArr[$extraV]['SubGroupIDs'] . "' />";
        echo "<td width=5%><input type=checkbox name=checkPer[$extraV] value='" . $extraV . "' /></td>";
        echo "<td width=14%>" . $extraV . "</td>";
        echo "<td width=14%><input type=text name=salary[$extraV] value='' size=6  /></td>";
        echo "<td width=14%><input type=text  name=pyPersent[$extraV] value='' size=6 /></td>";
        echo "<td width=14%><input type=text readonly name=lhPersent[$extraV] value='' size=6  /></td>";
        echo "<td width=14%><input type=text name=ID[$extraV] value='' size=6  /></td>";
        echo "<td width=16%><span style='color:red'>否</span></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</div>
</form>
</body>
</html>
</div>
</body>
</html>