{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">


{literal}
<script type="text/javascript">

$(document).ready(function(){


	$("input[name=addArchiveFee]").click(function(){
		var t,u,d,dt,m;
		t = "post";
		u = "aSQL.php";
		d = $("#addArchiveFeeForm").serialize();
		dt = "json";
		m = function(json){
				$.each(json,function(i,n){
						switch(i)
						{
						case "error1":
							alert(n);break;
						case "error2":
							alert(n);
							break;
						case "success":
							
						
								window.location.reload();
						
							break;
						}
					});
			};
			successfunc = function(){
				ajaxAction(t,u,d + "&btn=addArchiveFee",dt,m);
			};
			
		validator("input[name=addArchiveFee]","#addArchiveFeeForm","#errorDiv",successfunc);
		
	});

	$(".date").datepick();

	

	
});
</script>

{/literal}
<div id="main">
<fieldset>
<form id="addArchiveFeeForm" class="form">

{if $paytype eq 1}
<table class="myTable" >

{assign var="a" value=$the_archive.0}
以下是<span class="red" >{$a.name}({$a.pid})</span>的缴费记录：


<tr>
	<th>缴费日期</th>
	<th>缴费金额</th>
	<th>费用起始日期</th>
	<th>费用终止日期</th>
	<th>缴费人</th>
</tr>
{if $a.id == null}
<tr>
	<td colspan="5" >没有缴费记录</td>
</tr>
{else}
{foreach item=a from=$the_archive}
<tr>
	<td>{$a.paidOn}</td>
	<td>{$a.amount}</td>
	<td>{$a.period_s}</td>
	<td>{$a.period_e}</td>
	<td>{$a.paidBy}</td>
</tr>
{/foreach}
{/if}
</table>
{/if}

增加一条记录：<br />
<input type="hidden" name="userid" value="{$userid}" />
<input type="hidden" name="paytype" value="{$paytype}" />
缴费金额：<input type="text" name="amount" class="req-string req-numeric" />
起始日期：<input type="text" name="period_s" class="req-string req-date date" />
终止日期：<input type="text" name="period_e" class="req-string req-date date"  />
缴费人：<input type="text" name="paidBy"  class="req-string" />
缴费日期：<input type="text" name="paidOn"  class="req-string req-date date" value="{$current_date}"/>
<input type="button" name="addArchiveFee" value="确定" />
<div id="errorDiv" class="error-div-alternative"></div>
</form>
</fieldset>
</div>
{include file="footer.tpl"}