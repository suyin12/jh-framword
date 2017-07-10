{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
{literal}
<script>
$(document).ready(function(){

	
	$("input[name=changepass]").click(function(){
			successFun = function(){
					$("#passForm").submit();
				};
				
			validator("input[name=changepass]","#passForm","#errorDiv",successFun);
	});





	
});
</script>
{/literal}
<div id="main">

<form method="post" class="form" id="passForm">

<table class="myTable"> 
<tr><td>用户名：</td><td><input  type="hidden" name="mID" value="{$user.mID}" /><input  type="text" name="mName" value="{$user.mName}" disabled/></td></tr>

<tr><td>原密码：</td><td><input type="password" name="oldpass" class="req-string"/></td></tr>

<tr><td>新密码：<span>(5-20位)</span></td><td><input type="password" name="newpass" class="req-string"/></td></tr>

<tr><td>请确认新密码：<span>(5-20位)</span></td><td><input type="password" name="newpass2" class="req-string"/></td></tr>
<tr><td><input type="button" name="changepass" value="确定"  /></td></tr>

</table>  
<div id="errorDiv" class="error-div-alternative"></div>
</form>


</div>
</div>
{include file="footer.tpl"}