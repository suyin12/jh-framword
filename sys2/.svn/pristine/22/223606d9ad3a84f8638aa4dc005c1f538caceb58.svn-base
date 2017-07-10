<?php
/**
 * 2010-3-24              
 * <<<
 * 待上岗员工收集资料情况表, 主要就分为上岗,待岗,及其有问题人员
 * status : 0 或者 空  为待处理人员
 * 1 上岗人员
 * 2 有问题人员
 * 
 * >>>
 * 
 * @author  yours  sToNe
 * @version 
 */
@session_start();
include_once ("../settings.inc");
if(!$_SESSION['UserName'])exit("页面已失效,请重新登陆");
$wInfoSql = "select * from cwps_user where groupID like '13'";
$wInfoRet = mysql_query($wInfoSql);
while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
    $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
}
//if ($wInfoArr[$_SESSION['UserName']]['SubGroupIDs'] != ",17,")
//    exit("无权访问");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.ufvalidator.1.0.1.min.js"></script>
<script type="text/javascript" src="../js/general.js"></script>
<script type="text/javascript" src="../js/jqModal.js"></script>
<script type="text/javascript" src="../js/jqModal.litejva8.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.litejava8.css" />

<script type="text/javascript">
$(document).ready(function(){
		//构造生成条件框函数
		function condition(model){
		    var year, month, date, lastMonth, lmd, ly, lm, ld;
		    var today = new Date();
		    year = today.getFullYear();
		    month = today.getMonth();
		    date = today.getDate();
		    time = today.getTime();
		    today.setMonth(today.getMonth() - 1);
		    ly = today.getFullYear();
		    lm = today.getMonth() + 1;
		    ld = today.getDate();
		    var m = model;
		    var condition, sel;
		    switch (m) {
		        case "name":
		        case "unit":
		        case "pID":
		        case "station":
			         var textVal =utf8ToStr(getQuery("textVal"));
			        if(IsEmpty(textVal)==true ||textVal=="null")
				        textVal="";
		            condition = "<input type=text name = textVal value="+textVal+" >"; 
		            break;
		        case "insertTime":
		        case "lastModifyTime":
		            var bT, eT;
		            bT = getQuery("bT");
		            eT = getQuery("eT");
		            if (bT && eT) {
		                condition = "<input class='req-string req-date' type='text' name=bT value= '" + bT + "'> 到 <input class='req-string req-date' type='text' name=eT value='" + eT + "'>(例如:2010-01-02)";
		            }
		            else {
		                condition = "<input class='req-string req-date' type='text' name=bT value= '" + ly + "-" + lm + "-" + ld + "'> 到 <input class='req-string req-date' type='text' name=eT value='" + year + "-" + (month + 1) + "-" + (date )+ "'>(例如:2010-01-02)";
		            }
		            break;
		            
		    }
		    $(".inputCon").empty();
		    $(".inputCon").append(condition).css({"display":"inline"});
		}
		
		
		//改变select相应的生成条件框
		$("select[name=con]").change(function(){
			var model = $(this).val();
		    condition(model);
		});
		var m = $("select[name=con]").val();
		$("select[name=con]").ready(function(){
			if(getQuery("con"))
				m= getQuery("con");
			$("select[name=con]").find("option[value="+m+"]").attr("selected","selected");
		    condition(m);
		});

		$("select[name=schedule]").ready(function(){
			if(getQuery("schedule"))
				s= getQuery("schedule");
			$("select[name=schedule]").find("option[value="+s+"]").attr("selected","selected");
		});
         //全选/不选
		 $(".chkAll").click(function(){
		        var cC, aC;
		        var formName = this.form.name;
		        var chkName = formName.replace("Form", "");
		        cC = this;
		        aC = ':checkbox[name^=' + chkName + 'Check]';
		        checkAll(cC, aC);
			    var num= 0; 
			  $(":checkbox[name=listCheck[]]:checked").each(function(k){
				   num=num+1;
				  });
			  $("#checkedNum").html(num+"行");
							
		    });


			//AJAX 更新提交
		    $(".sub").click(function(){
		        var formName = this.form.id;
		        var t, u, d, dt, m;
		        t = "post";
		        u = "wSql.php";
		        d = $("#" + formName).serialize() + "&btn=" + $("#" + formName + " :button").attr("name");
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

		              if(formName=="insertForm"){
		            successFun = function(){
		                ajaxAction(t, u, d, dt, m);
		            }
		            validator("input[name=insert]", "#insertForm", "#errorDiv", successFun);
                  }else{
                	  ajaxAction(t, u, d, dt, m);
                      }
		        
		    });   
			  //AJAX 更新提交
		    $(".subM").click(function(){
		        var formName = this.form.id;
		        var t, u, d, dt, m;
		        t = "post";
		        u = "wSql.php";
		        d = $(":checkbox[name^=listCheck[]]:checked").serialize() + "&type=updateSub&btn=" + $(this).attr("name");
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
                    var ret = confirm("确定变更状态为"+$(this).val());
		              if(ret==true){
		            	  var checkValid= isChecked(":checkbox[name^=listCheck[]]");
			   	           if(checkValid==false){	
			   	            	 ajaxAction(t, u, d, dt, m); 	           	   
			   	             }else{
			   		             alert("请选择需要更改的数据列");
			   		             }
                  }else{
                	     return false;
                      }
		        
		    });

			 $("input[name=output]").click(function(){
			            this.form.action="waitIntoExcel.php"
                        this.form.submit();
			    });  
			  
			 $(":checkbox[name=listCheck[]]").each(function(i){
				      $(this).click(function(){
				    	  var num= 0; 
				    	  $(":checkbox[name=listCheck[]]:checked").each(function(k){
					    	   num=num+1;
					    	  });
				    	  $("#checkedNum").html(num+"行");
					      });
	                });
        
});
</script>
<style type="text/css">
/*表单验证CSS*/
.red {
	color: red;
}

.form {
	float: left;
	background-color: #f0f0f0;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;	padding: 20px;
	margin: 0 10px 0 0;
}

.form .form-row {
	width: 100%;
	margin-bottom: 10px;
	float: left;
}

.form .label {
	float: left;
	width: 100px;
	margin: 6px 0 0 5px;
}

.form .input-container {
	float: left;
	width: 195px;
	text-align: right;
}

.form .input {
	width: 180px;
	height: 18px;
	border: 2px solid #c4c4c4;
}

.form .textarea {
	width: 180px;
	height: 120px;
	border: 2px solid #c4c4c4;
	font-family: Tahoma;
	font-size: 11px;
}

.form .error-input,.form .error-both .input,.form .error-same .input {
	background-color: #FFEFEF;
	border-color: #BB6666;
	color: #660000;
}

.form .error-div {
	float: right;
	margin: 7px 10px 0 0;
	color: #935;
	font-size: 10px;
}

.form .error-div-alternative {
	display: none;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	width: 400px;
	top: 0;
	left: 70%;
	position: absolute;
	z-index: 1000;
	margin-left: -400px;
	text-align: center;
	font-size: 16px;
	color: #934;
	padding: 20px 0 20px 0;
	background-color: #fee;
	border: solid 2px #d36;
	border-top-width: 0;
}

.form .error-same,.form .error-both {
	color: #fff;
	background-color: #b66;
	-moz-border-radius: 3px;
}

</style>
</head>
<body>
<div >
<?php 
if($_GET['con']){
    $field =$_GET['con'];
    $value = $_GET['textVal'];
    $scheldue = $_GET['schedule'];
    $basicSql = "select * from m_waitWorkList  ";
    $statusSql = " and status=0";

	switch($field){
	   case "insertTime":
	   case "lastModifyTime":
	     $eT = ++$_GET['eT'];
	     $conSql = " where ($field between '$_GET[bT]' and '$eT')";
		 break;
	  default:
	     $conSql ="where $field like '%$value%'";
	   break;
	}
    if($_GET['status']!=""){
        foreach ($_GET['status'] as $status){
            $statusStr .="'".$status."',";
        }
        $statusStr = rtrim($statusStr,",");
        $statusSql = " and status in ($statusStr)";
    }
   if($_GET['statusAll']=="all"){
      $statusAllSql = "  and dataToUnit like '1' and reterence like '1' and trainStatus like '1'";
    }
    $yesORno=$_GET['yesORno'];
    if($yesORno!=NULL){
        switch($scheldue){
            case "trainStatus":
            case "reterence":
            case "dataToUnit":
                $yesORnoSql=" and `$scheldue` like '$yesORno' ";
                break;
            default:
                $yesORnoSql=" and `trainStatus` like '$yesORno' and `reterence` like '$yesORno' and `dataToUnit` like '$yesORno'";
                
        }
    }else{
	  $yesORnoSql = "";
	}
    $orderSql = " order by $scheldue desc";
    $sql = $basicSql.$conSql.$statusSql.$yesORnoSql.$statusAllSql.$orderSql;
    $count= @mysql_num_rows(mysql_query($sql));
    require_once '../pagenationModel.class.php';
	$mypage = new Pagination();//使用分页类
	$mypage->form_mothod = "get";
	$mypage->page=$_GET['page'];//设置当前页
	$mypage->count=$count;//获取并设置数据库总记录数
	if($_GET['pageAll']=="all"){
		    $pageSize =$count;
	}else{
		    $pageSize=30;
	}
	$mypage->pagesize=$pageSize;//每页多少条记录
	$r_sql = $sql.$mypage->get_limit();//分页条件查询
	$ret = mysql_query($r_sql);
    while ($row = @mysql_fetch_assoc($ret)){
        $rowArr[] =$row;
    }
}
?>
<form action="" class="form" method="get" id="conForm" name="conForm" style="width:100%">
<div>
<div >
<span>查找方式:</span>
<select name=con>
<option value="name">姓名</option>
<option value="pID">身份证</option>
<option value="unit" >单位</option>
<option value="station">岗位</option>
<option value="insertTime" >添加日期</option>
<option value="lastModifyTime" >最后一次修改日期</option>
</select>

<span>内容:</span>
<div class="inputCon" ><!--这个DIV 用来从JS 生成相应的查询条件输入框 --></div>
<input type="submit" name="search" value="查找" style="display:inline;" />
<input type="radio"  name="yesORno" value="" checked />无
<input type="radio"  name="yesORno" value="1" <?php if($yesORno=="1") echo "checked";?>/>已
<input type="radio"  name="yesORno" value="0" <?php if($yesORno=="0") echo "checked";?>/>否
</div>

<div>
<span>排序方式:</span>
<select name=schedule>
<option value="unit">按单位</option>
<option value="name">按姓名</option>
<option value="pID">按身份证</option>
<option value="station">按岗位</option>
<option value="dataStatus">按资料递交情况</option>
<option value="trainStatus">按培训情况</option>
<option value="reterence">按证明人情况</option>
<option value="dataToUnit">按资料送达市局情况</option>
<option value="insertTime">按添加日期</option>
<option value="lastModifyTime" selected>按最后一次修改日期</option>
</select>
<input type="checkbox" value="0" name="status[2]" <?php if($_GET['status'][2]=="0") echo "checked"?>>待上岗人员
<input type="checkbox" value="1" name="status[0]" <?php if($_GET['status'][0]=="1") echo "checked"?>>上岗人员 
<input type="checkbox" value="2" name="status[1]" <?php if($_GET['status'][1]=="2") echo "checked"?>>问题人员
<input type="checkbox" value="all" name="statusAll" <?php if($_GET['statusAll']=="all") echo "checked"?>>手续齐全人员
<input type="checkbox" value="all" name="pageAll" <?php if($_GET['pageAll']=="all") echo "checked"?>>显示全部

</div>
</div>
</form>
<div style="width:100%" >
<form action="waitWorkUpdate.php" method="post" target="_blank" class="form"  name="listForm" id="listForm" >
  <div><a class="thickbox" href="../Parser/index.php?a=wMulModify&width=100%&amp;height=80%">导入培训成绩单</a></div>
  <div style="" id="modalWindow" class="jqmWindow jqmID1">
        <div id="jqmTitle">
            <button class="jqmClose">
                                    关闭 X
            </button>
            <span id="jqmTitleText"></span>
        </div>
        <iframe id="jqmContent" src=""></iframe>
    </div>  
   <div class="fixedTable" style="width:100%;height: 500px;">
    <table border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr class="fixedRow">
			<th width="40px;">全选/反选<input name="listChk" class=chkAll type="checkbox"></th>
			<th>状态</th>
			<th>单位名称</th>
			<th>岗位</th>
			<th>姓名</th>
			<th>交资料情况</th>
			<th>是否培训</th>
			<th>证明人来否</th>
			<th>资料交市局情况</th>
			<th>电话</th>
			<th>身份证号</th>
			<th>备注</th>
			<th>添加时间</th>
			<th>最后一次修改时间</th>
			<th>修改人员</th>
		</tr>
	</thead>
	<tbody bgcolor="#ffffff">
	
	<?php
	if($rowArr)
	    foreach ($rowArr as $val){
	        if($val['mark']== "1")
	           echo "<tr bgcolor='#87deac'>";
	        else
	           echo "<tr>";
	         foreach ($val as $k=> $v){
	             switch ($k){
		             case "ID":
		                 echo "<td><input type=checkbox   name=listCheck[] value = '".$v."' /></td>";
		                 break;
		             case "problem":break;
		             case "status":
		                   switch ($v){
		                       case "0": $v="等待..";break;
		                       case "1": $v="已上岗";break;
		                       case "2": $v="<span class=red>出问题</span>";break;
		                   }
		                   echo "<td>$v</td>";
		                 break;
		             case "trainStatus":
		             case "reterence":
		             case "dataToUnit":
		                 switch ($v){
		                       case "0": $v="<span class=red>否</span>";break;
		                       case "1": $v="已";break;
		                   }
		                   echo "<td>$v</td>";
		                 break;
		             case "unit":    
		             case "name":
		             case "station":    
		                  echo "<td>$v</td>";
		                 break;
		             case "mark":
		                 break;    
		             default:
		                 echo "<td>$v</td>";
		                 break;
	             }
	         }
	         echo "</tr>";
	    }else{
	        echo "<tr><td colspan=15>暂无查询结果</td></tr>";
	    }
	 ?>
	</tbody>
</table>
</div>
已选中的行数:<span id="checkedNum" class="red"></span>
<?php 
if($rowArr)
    echo "<span>" .$mypage->page_list($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'])."</span>";
?>
<input type="submit" name="update" value="编辑">
<input type="button" name="mark" class="subM" value="标记" />
<input type="button" name="deleteMark" class="subM" value="取消标记" />
<input type="button" name="dataStatus" class="subM" value="资料收齐" />
<input type="button" name="status" class="subM" value="上岗" />
<input type="button" name="trainStatus" class="subM" value="已培训" />
<input type="button" name="reterence" class="subM" value="已见证明人" />
<input type="button" name="dataToUnit" class="subM" value="已递交资料到市局" />
<input type="hidden" name="sql" value="<?php echo $sql;?>"/>
<input type ="button" name="output"  value="导出为EXCEL" />
</form>
</div>
<div style="width:100%">
<p>添加新待岗人员</p>
<form  class="form" name="insertForm" id="insertForm" >
<table width="100%" border="0" cellspacing="1" bgcolor="#666666">
	<thead bgcolor="#ffffff">
		<tr>
			<th>单位名称</th>
			<th>岗位</th>
			<th>姓名</th>
			<th>交资料情况</th>
			<th>是否培训</th>
			<th>证明人来否</th>
			<th>资料交市局情况</th>
			<th>电话</th>
			<th>身份证号</th>
			<th>备注</th>
		</tr>
	</thead>
	<tbody bgcolor="#ffffff">
		<tr>
		   <td><input type="text" name= unit  size=20 class='req-string' /></td>
		   <td><input type="text" name= station size=15 /></td>
		   <td><input type="text" name= name  size=10  class='req-string'/></td>
		   <td><input type="text" name= dataStatus size=20 /></td>
		   <td><select name= trainStatus ><option value="0">否</option><option value="1">已参加</option></select></td>
		   <td><select name= reterence  ><option value="0">否</option><option value="1">已来</option></select></td>
		   <td><select name= dataToUnit ><option value="0">否</option><option value="1">已递交</option></select></td>
		   <td><input type="text" name= phone  size=10 /></td>
		   <td><input type="text" name= pID size=20 /></td>
		   <td><textarea name= remarks ></textarea></td>
		</tr>
	
	</tbody>
</table>
<input type="button" name="insert" class="sub" value="添加新人员"/>
<div id="errorDiv" class="error-div-alternative"></div>
</form>
</div>
</div>
</body>
</html>
