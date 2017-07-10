<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/**
 * 2010-3-25              
 * <<<>>>
 * 
 * @author  yours  sToNe
 * @version 
 */
@session_start();
include_once ("../settings.inc");
$wInfoSql = "select * from cwps_user where groupID like '13'";
$wInfoRet = mysql_query($wInfoSql);
while ($wInfoRow = mysql_fetch_assoc($wInfoRet)) {
    $wInfoArr[$wInfoRow['UserName']] = array("SubGroupIDs" => $wInfoRow['SubGroupIDs'] , "RoleID" => $wInfoRow['RoleID']);
}
foreach ($_POST['listCheck'] as $val) {
    $valStr .= "'" . $val . "',";
}
$valStr = rtrim($valStr, ",");
$sql = "select * from m_waitWorkList where ID in ($valStr) order by ID desc";
$ret = mysql_query($sql);
while ($row = @mysql_fetch_assoc($ret)) {
    $rowArr[] = $row;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.ufvalidator.1.0.1.min.js"></script>
<script type="text/javascript" src="../js/general.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
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
                      window.opener.location.reload();
	                        break;
	                }
	            });
	            
	        };
           
	            successFun = function(){
	                ajaxAction(t, u, d, dt, m);
	            }
	            
	            validator("input[name=insert]", "#insertForm", "#errorDiv", successFun);
	        
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
	width: 100%;
	background-color: #f0f0f0;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	padding: 20px;
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
<form class="form" name=updateForm id=updateForm >
<table>
	<thead>
		<tr>
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
			<th>出现的问题</th>
		</tr>
	</thead>
	<tbody>
	
	<?php
//	print_r($rowArr);
if ($rowArr)
    foreach ($rowArr as $val) {
        echo "<tr>";
        foreach ($val as $k => $v) {
            switch ($k) {
                case "ID":echo "<input type=hidden name=ID[] value= '".$v."' />";
                    break;
                case "status":
                    echo "<td><select name ='".$k."[]'>";
                    if ($v == "0") {
                        echo "<option value='0' selected>等待..</option>
		                         <option value='1'>已上岗</option>
		                         <option value='2'>出问题</option>";
                    } elseif ($v == "1") {
                        echo "<option value='0' >等待..</option>
		                         <option value='1' selected>已上岗</option>
		                         <option value='2'>出问题</option>";
                    } elseif ($v == "2") {
                        echo "<option value='0' >等待..</option>
		                         <option value='1'>已上岗</option>
		                         <option value='2' selected>出问题</option>";
                        echo "</select></td>";
                    }
                    break;
                case "trainStatus":
                case "reterence":
                case "dataToUnit":
                    echo "<td><select name ='".$k."[]'>";
                    if ($v == "0") {
                        echo "<option value='0' selected>否</option>
		                         <option value='1'>已</option>";
                    } else {
                        echo "<option value='0' >否</option>
		                            <option value='1' selected>已</option>";
                    }
                    echo "</select></td>";
                    break;
                case "insertTime":
                case "lastModifyTime":
                case "actionPer":
                    break;
                case "remarks":
                case "problem":
                    echo "<td><textarea name='".$k."[]'>$v</textarea></td>";
                    break;
                default:
                    echo "<td><input type=text name='".$k."[]' value='$v' size=10 /></td>";
                    break;
            }
        }
        echo "</tr>";
    }
else {
    echo "<tr><td>暂无查询结果</td></tr>";
}
?>
	</tbody>
</table>
<input type="button" name="update" class="sub" value="更新">
</form>
</body>
</html>
</div>
</body>
</html>