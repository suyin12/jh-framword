{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>

{literal}
<script type="text/javascript">

$(document).ready(function(){


	$("#backupReason").change(function(){
		var option = $("#backupReason option:selected").val();
		var id;
		if(option == 0)
		{
			$("#backupReasonDiv").empty();
			$("#backupReasonDiv").html("<br />请输入原因：<input type=\"text\" name=\"backupReasonText\" style=\"width:400px;\" class=\"req-string\" />");
		}
		else
		{
			
			//$("#backupReasonDiv").html("<i> option>0 <//i>");
			$("#backupReasonDiv").empty();
			//$.get("ajax.php",{id:option,btn:"addrequire"},function(data,textStatus){$("#resText").html(data);});
		}	
	});


	$("input[name=dobackup]").click(function(){
		var t,u,d,dt,m;
		t = "post";
		u = "mSQL.php";
		d = $("#backupTalentsForm").serialize();
		dt = "json";
		m = function(json){
				var i,n;
				$.each(json,function(i,n){
					switch(i)
					{
					case "error":
						alert(n);break;
					case "success":
						alert(n);break;
					}
				});
			};

		successfunc = function(){
				ajaxAction(t,u,d + "&btn=dobackup",dt,m);
			};

		validator("input[name=dobackup]","#backupTalentsForm","#errorDiv",successfunc);
	});



	
});
</script>

{/literal}
<div id="main">
<fieldset>


<form id="backupTalentsForm" method="post" class="form">

{foreach item=talents from=$backup_talents}
<table class="myTable" width="100%">
<!-- 基本资料 -->
<tr>
<th>姓名</th><td><input type="hidden" name="bctalents[]" value="{$talents.talentID}" />{$talents.name}</td>
<th>性别</th><td>{$talents.sex|replace:"1":"男"|replace:"2":"女"}</td>
<th>身份证号</th><td>{$talents.idCard}</td>

<th>应聘岗位</th><td>{$talents.positionName}</td>    
<th></th><td></td>
</tr>

<!-- 联系方式 -->
<tr>
<th>联系电话</th><td>{$talents.telephone}</td>
<th>提交时间</th><td>{$talents.signTime}</td>
<th>最后修改人</th><td>{$talents.nameLastModifiedBy}</td>
<th>修改时间</th><td>{$talents.lastModifyTime}</td>
<th></th><td></td>    
</tr>

<!-- 退回相关 -->
<tr>
<th>交资料情况</th><td>{$talents.d_material|replace:1:"无"|replace:2:"户口本"|replace:3:"计生证"|replace:4:"体检表"|replace:5:"户口本,计生证"|replace:6:"户口本,体检表"|replace:7:"计生证,体检表"|replace:8:"户口本,计生证,体检表"}</td>
<th>是否培训</th><td>{$talents.d_train|replace:1:"是"|replace:2:"否"}</td>
<th>是否见证明人</th><td>{$talents.d_reference|replace:1:"是"|replace:2:"否"}</td>
<th>是否资料递交市局</th><td>{$talents.d_commit|replace:1:"是"|replace:2:"否"}</td>
<th>培训成绩</th><td>{$talents.marks}</td>
</tr>

</table>
{/foreach}

退回的原因：<select name="backupReason" id="backupReason">
{html_options options=$c_backupReason}
</select>

<div id="backupReasonDiv">
</div>
<div id="errorDiv" class="error-div-alternative">
</div>


<input type="button" name="dobackup" value="确定" />
</form>
</fieldset>
</div>
{include file="footer.tpl"}