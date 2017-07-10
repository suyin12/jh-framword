{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=updatePlan]").click(function(){
			
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#updatePlanForm").serialize();
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
							ajaxAction(t,u,d + "&btn=updatePlan",dt,m);
						};

					validator("input[name=updatePlan]","#updatePlanForm","#errorDiv",successfunc);
					
			});

			$("input[name=copyPlan]").click(function(){
				var t,u,d,dt,m;
				t = "post";
				u = "mSQL.php";
				d = $("#updatePlanForm").serialize();
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
				ajaxAction(t,u,d + "&btn=copyPlan",dt,m);
			});
	

			$(".date").datepick();
});
</script>
{/literal}
<div id="main">

<div id="mainBody" class="right">

<form id="updatePlanForm" class="form">


<input type="hidden" name="id" value="{$plan.id}" />

计划名称<input type="text" name="name" size="103" class="req-string" value="{$plan.name}"/><br />
招聘需求<select name="requires[]" multiple="multiple" size="4" style="width:200px;" disabled>
{html_options options=$requires_opt selected=$requires_s}</select><br />





招聘组长<select name="leader" style="width:100px;">
				{html_options options=$recruiter_opt selected=$leader_s}
		</select><br />
				
招聘组员<select multiple="multiple" name="member[]" size="4" style="width:100px;">
			{html_options options=$recruiter_opt selected=$member_s}
</select>
<br />

招聘渠道<select name="market[]" multiple>
{html_options options=$markets_opt selected=$market_s}
</select><br />

招聘期限<input type="text" class="date" name="period_s" value="{$plan.period_s}"/>
至<input type="text" class="date" name="period_e" value="{$plan.period_e}"/><br />


特殊提醒<textarea rows="3" cols="100" class="req-string" name="reminder" >{$plan.reminder}</textarea><br />

招聘难点<textarea name="difficulty" rows="3" cols="100" class="req-string">{$plan.difficulty}</textarea><br />

该工作计划：是否是紧急
{if $plan.is_urgent eq 1}
<input type="checkbox" name="is_urgent" checked />
{else}
<input type="checkbox" name="is_urgent" />
{/if}
			是否是困难
{if $plan.is_difficult eq 1}
<input type="checkbox" name="is_difficult" checked />
{else}
<input type="checkbox" name="is_difficult" />
{/if}
			是否要花钱的
{if $plan.is_spend eq 1}
<input type="checkbox" name="is_spend" checked />
{else}
<input type="checkbox" name="is_spend" />
{/if}
			普通
{if $plan.is_normal eq 1}
<input type="checkbox" name="is_normal" checked />
{else}
<input type="checkbox" name="is_normal" />
{/if}
<hr />

广告安排：海报<input type="text" name="ad_poster" value="{$plan.ad_poster}"/>
		X展架<input type="text" name="ad_xboard" value="{$plan.ad_xboard}"/>
		宣传单<input type="text" name="ad_leaflet" value="{$plan.ad_leaflet}"/>
		招聘市场<input type="text" name="ad_market" value="{$plan.ad_market}"/>
		其他媒体<input type="text" name="ad_media" value="{$plan.ad_media}"/><br />
		
费用预算:广告费<input type="text" name="bg_adv" value="{$plan.bg_adv}"/> 
		场地费：<input type="text" name="bg_ground" value="{$plan.bg_ground}"/> 
		其他费用：<input type="text" name="bg_other" value="{$plan.bg_other}"/><br />
		
<input type="button" name="updatePlan" value="更新" />
<input type="button" name="copyPlan" value="复制计划" />

<div id="errorDiv" class="error-div-alternative"></div>


</form>





</div>
</div>
{include file="footer.tpl"}