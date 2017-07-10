{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

			$("input[name=createAssess]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createAssessForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "exist":
										alert(n);
										break;
									case "error":
										alert(n);
										break;
									case "success":
										if(confirm(n+"，确定将结束添加评估，取消则继续添加") == true)
										{
											window.close();
										}
										else
										{
											window.location.reload();
										}
										break;
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=createAssess",dt,m);
						};

					validator("input[name=createAssess]","#createAssessForm","#errorDiv",successfunc);
					
			});

			$(".date").datepick();
			
	

});
</script>
<style>
legend {
	font-size:18px;
}
</style>
{/literal}
<div id="main">

<form id=createAssessForm class="form">


<fieldset>
<legend><code>基本情况</code></legend>
评估概要<input type="text" name="subject" size="103" class="req-string" /> <br />


招聘岗位：<select name="position">{html_options options=$positions}</select> <br />
招聘时间：<input type="text" class="date" name="period_s" />至<input type="text" class="date" name="period_e" /><br />
</fieldset>
<br />
<fieldset>
<legend><code>岗位情况</code></legend>
工资水平<input type="text" name="salary" /> 市场价：<input type="text" name="marketPrice"/>
		福利水平<input type="text" name="welfare" />市场情况:<input type="text" name="marketSituation"/>
		工作强度<input type="text" name="intensity" />
</fieldset>
<br />
<fieldset>
<legend><code>市场反馈</code></legend>
用工单位的问题：<input type="text" name="problem"/><br />
市场供应情况：<input type="text" name="provision" /> <br />
</fieldset>
<br />
<fieldset>
<legend><code>渠道情况</code></legend>
<table>
<td>适合的市场</td><td> <select name="proper[]" multiple="multiple" size="6">{html_options options=$markets}</select></td>
<td>不适合的市场</td><td><select name="improper[]" multiple="multiple" size="6">{html_options options=$markets}</select></td>
<td>建议新增加的市场</td><td><select name="increase[]" multiple="multiple" size="6">{html_options options=$markets}</select></td>
</table>
</fieldset>
<br />
<fieldset>
<legend><code>其他情况</code></legend>
<textarea rows="3" cols="100" class="req-string" name="other"></textarea> <br />
</fieldset>
<br />
<fieldset>
<legend><code>改善建议</code></legend>
<textarea rows="3" cols="100" class="req-string" name="suggestion"></textarea>
</fieldset>

<input type="button" name="createAssess" value="提交" />
<input type="reset" value="重置" />




</table>

<div id="errorDiv" class="error-div-alternative"></div>

</form>




</div>
</div>
{include file="footer.tpl"}