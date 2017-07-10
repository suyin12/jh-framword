{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("input[name=drCondition]").click(function(){
		
			successFun = function(){

			$("#drConditionForm").submit();
			};
			validator("input[name=drCondition]","#drConditionForm","#errorDiv",successFun);
	});

	$("input[name=date_from]").datepick();
	$("input[name=date_to]").datepick();

	$("#all_markets").click(function(){
		 if ($(this).attr('checked') == true) {
	            $(".markets").attr('checked', true);
	        }
	        else {
	            $('.markets').attr('checked', false);
	        }
	});

	$("#all_users").click(function(){
		 if ($(this).attr('checked') == true) {
	            $(".users").attr('checked', true);
	        }
	        else {
	            $('.users').attr('checked', false);
	        }
	});

	$("#cur_week").click(function(){
		if($(this).attr('checked') == true)
		{
			$("input[name=date_from]").attr("disabled","disabled").attr("class","");
			$("input[name=date_to]").attr("disabled","disabled").attr("class","");
		}
		else
		{
			$("input[name=date_from]").attr("disabled","").attr("class","req-string req-date");
			$("input[name=date_to]").attr("disabled","").attr("class","req-string req-date");
		}
	});
	
	
});
</script>

{/literal}
<div id="main">
<fieldset>
<a class="noSub positive" href="{$cwURL}"  >查看本周安排</a>
<a class="noSub positive" href="{$nwURL}" >查看下周安排</a>
<form method="get" id="drConditionForm" action="drDisplay.php" class="form">
    <fieldset class="left halfWidth">
    <legend>
    <code>请选择市场&nbsp;&nbsp;全选<input type="checkbox" id="all_markets" /></code>
    </legend>
{foreach item=market key=marketID from=$markets}
{foreach item=market_ckecked key=market_name from=$market}
<li><input type="checkbox" value="{$marketID}" name="markets[]" class="markets" {$market_ckecked}/>&nbsp;&nbsp;{$market_name}</li>
{/foreach}
{/foreach}
</fieldset>
<!--<div class="myCheckbox" >
<div class="myCheckboxTitle">请选择人员&nbsp;&nbsp;全选<input type="checkbox" id="all_users" /></div>
<div class="myCheckboxContent">
{foreach item=user key=mID from=$users} {foreach item=user_checked
			key=user_name from=$user}
<li><input type="checkbox" value="{$mID}" name="users[]" class="users" {$user_ckecked}/>&nbsp;&nbsp;{$user_name}</li>
{/foreach}
{/foreach}
</div>
</div>
-->
   <fieldset class="right halfWidth">
    <legend>
    <code>请选择时间&nbsp;&nbsp;本周<input type="checkbox" id="cur_week" name="cur_week" value="1"/></code>
    </legend>

<li>起始时间&nbsp;&nbsp;<input type="text" name="date_from" class="req-string req-date" /></li>
<li>终止时间&nbsp;&nbsp;<input type="text" name="date_to" class="req-string req-date" /></li>

<p><input type="button" name="drCondition" value="确定" /></p>
</fieldset>

<div id="errorDiv" class="error-div-alternative">
</div>
</form>
</fieldset>
</div>
{include file="footer.tpl"}