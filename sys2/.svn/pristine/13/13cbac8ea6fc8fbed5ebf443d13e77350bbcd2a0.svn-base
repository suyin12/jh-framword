{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){


			$("input[name=updateAssess]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#updateAssessForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "error":
										alert(n);
										break;
									case "success":
										alert(n);
										window.location.reload();
										break;
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=updateAssess",dt,m);
						};

					validator("input[name=updateAssess]","#updateAssessForm","#errorDiv",successfunc);
					
			});


});
</script>
{/literal}
<div id="main">
<div id="mainBody" class="right">



<form id="updateAssessForm" class="form">


<input type="hidden" name="id" value="{$assess.id}" />
评估概要

<input type="text" name="subject" size="103" class="req-string" value="{$assess.subject}"/> <br />

招聘岗位：<select name="position">{html_options options=$positions selected=$assess.position}</select>
招聘时间：<input type="text" class="date" name="period_s" value="{$assess.period_s}" />
	至<input type="text" class="date" name="period_e" value="{$assess.period_e}"/><br />
岗位情况：工资水平<input type="text" name="salary" value="{$assess.salary}"/> 
		市场价：<input type="text" name="marketPrice" value="{$assess.marketPrice}"/>
		福利水平<input type="text" name="welfare" value="{$assess.welfare}"/>
		市场情况:<input type="text" name="marketSituation" value="{$assess.marketSituation}"/>
		工作强度<input type="text" name="intensity" value="{$assess.intensity}"/>	<br />
市场反馈：用工单位的问题：<input type="text" name="problem" value="{$assess.problem}"/>
市场供应情况：<input type="text" name="provision" value="{$assess.problem}"/> <br />	
渠道情况：  适合的市场 <select name="proper[]" multiple="multiple" size="6">
{html_options options=$markets selected=$proper_s}</select>
不适合的市场<select name="improper[]" multiple="multiple" size="6">
{html_options options=$markets selected=$improper_s}</select>
建议新增加的市场<select name="increase[]" multiple="multiple" size="6">
{html_options options=$markets selected=$increase_s}</select> <br />
其他情况：<textarea rows="3" cols="100" class="req-string" name="other" >{$assess.other}</textarea> <br />
改善建议：<textarea rows="3" cols="100" class="req-string" name="suggestion">{$assess.suggestion}</textarea>


<input type="button" name="updateAssess" value="更新" />

<div id="errorDiv" class="error-div-alternative"></div>

</form>

</div>
</div>
{include file="footer.tpl"}