{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=createPlan]").click(function(){
				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createPlanForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "exist":
									case "error":
									case "error2":
										alert(n);
										break;
									case "success":
										/*
										var info,id;
										$.each(n,function(j,m){
											switch(j)
											{
											case "id":
												id = m;break;
											case "info":
												info = m;break;
									
											}
										});
										
										if(confirm(info+id+"，确定将进入工作管理进行安排，取消则修改计划") == true)
										{
											window.location.href = "";
										}
										else
										{
										}
										*/
										alert(n);
										window.location.href = "planManage.php";
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=createPlan",dt,m);
						};

					validator("input[name=createPlan]","#createPlanForm","#errorDiv",successfunc);
					
			});
	
			$(".date").datepick();
			
});
</script>

{/literal}
<div id="main">


<form id="createPlanForm" class="form">


招聘需求<br />
<select name="requires[]" multiple="multiple" size="4" style="width:500px;">
{html_options options=$requires_opt selected=$demands_selected}</select><br />

计划名称<br />
<input type="text" name="name" size="103" class="req-string"/><br />


招聘组长<br />
<select name="leader" style="width:100px;">
				{html_options options=$recruiter_opt}
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
				
招聘组员<br />
<select multiple="multiple" name="member[]" size="4" style="width:100px;">
			{html_options options=$recruiter_opt}
</select>
<br />

招聘渠道<br />
<select name="market[]" multiple="multiple" size="4">{html_options options=$markets}</select><br />

招聘期限<br />
<input type="text" class="date req-string req-date" name="period_s" />至<input type="text" class="date req-string req-date" name="period_e"/><br />

特殊提醒：<br />
<textarea rows="3" cols="100" name="reminder" ></textarea><br />

该工作计划：是否是紧急<input type="checkbox" name="is_urgent" value="1"/>
			是否是困难<input type="checkbox" name="is_difficult" value="1" />
			是否要花钱的<input type="checkbox" name="is_spend" value="1"/>
			普通<input type="checkbox" name="is_normal" value="1" />

<br /><br />
以上如果选择前三项，请继续填写<hr />
广告安排<br />
		海报<input type="text" name="ad_poster" />
		X展架<input type="text" name="ad_xboard" />
		宣传单<input type="text" name="ad_leaflet"/>
		招聘市场<input type="text" name="ad_market" />
		其他媒体<input type="text" name="ad_media"/><br />

费用预算:广告费<input type="text" name="bg_adv" /> 场地费：<input type="text" name="bg_ground"/> 
		其他费用：<input type="text" name="bg_other" /><br />

<input type="button" name="createPlan" value="确定" /><input type="reset" value="重置" />
</form>
<div id="errorDiv" class="error-div-alternative"></div>
</div>




</div>
{include file="footer.tpl"}