{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/lefttree.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">


{literal}
<script type="text/javascript">

$(document).ready(function(){

	$("input[name=siAgencyCreate]").click(function(){
		

		var t,u,d,dt,m;
		t = "post";
		u = "aSQL.php";
		d = $("#siAgencyCreateForm").serialize();
		dt = "json";
		m = function(json){
				$.each(json,function(i,n){
						switch(i)
						{
						case "error":
							alert(n);
							break;
						case "success":
							if(confirm(n+"，确定将继续添加新的代理人员，取消则返回") == true)
							{
								window.location.reload();
							}
							else
							{
								window.location.href = "siAgencyCreate.php";
							}
							break;
						}
					});
			};
			successfunc = function(){
				ajaxAction(t,u,d + "&btn=siAgencyCreate",dt,m);
			};
			
		validator("input[name=siAgencyCreate]","#siAgencyCreateForm","#errorDiv",successfunc);

		
	});

	$(".date").datepick();
	
});
</script>
<style>

div.fForm {
	background-color:#BBE3FB;
	padding:20px 20px 20px 20px;

}
div.fForm form table tr td{
	height:25px;
}

.fc {
	width:200px;

}

.table_tr_grey td {
	background:#DFDFDF;
	color:#777777;
}
.table_tr_grey td a{
		background:#DFDFDF;
	color:#777777;
}
.table_tr_green td {
	background:#DDF1D7;
	color:black;
}
.table_tr_green td a {
	background:#DDF1D7;
color:black;
}
.table_tr_green2 td {
	background:#6BC767;
color:black;
}
.table_tr_green2 td a {
	background:#6BC767;
color:black;
}

</style>
{/literal}
<div id="main">
<div id="lefttree" class="left">{include file="leftTree.tpl"}</div>
<div id="centertree" class="lrnone"><a href="javascript:prqq()"><br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
&nbsp;&nbsp;&nbsp;</a></div>
<div id="mainBody" class="right">

<form id="siAgencyCreateForm" class="form">
<table>
<tr>
<td>姓名</td><td> <input type="text" name="name" class="req-string" /></td>
</tr>
<tr>
<td>身份证号</td><td><input type="text" name="idcard" /></td>
</tr>
<tr>
<td>电脑号</td><td><input type="text" name="pcno" /></td>
</tr>
<tr>
<td>代理期限始</td><td><input type="text" name="period_s" class="date req-string req-date" /></td>
</tr>
<tr>
<td>代理期限终</td><td><input type="text" name="period_e" class="date req-string req-date" /></td>
</tr>
<tr>
<td>月管理费</td><td><input type="text" name="manageFee" class="req-string req-numeric"/></td>
</tr>
<tr>
<td>社保缴交年月</td><td><input type="text" name="siStart" class="date req-date" /></td>
</tr>
<tr>
<td>联系电话</td><td><input type="text" name="telephone" /></td>
</tr>
<tr>
<td><input type="button" name="siAgencyCreate" value="确定" />
<input type="reset" value="重置" /></td>
</tr>
</table>
<div id="errorDiv" class="error-div-alternative"></div>
</form>




























</div>
</div>
{include file="footer.tpl"}