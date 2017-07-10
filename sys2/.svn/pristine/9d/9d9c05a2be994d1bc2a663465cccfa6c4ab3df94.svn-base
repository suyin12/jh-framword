{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
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
							ajaxAction(t,u,d + "&btn=createPlan",dt,m);
						};

					validator("input[name=createPlan]","#createPlanForm","#errorDiv",successfunc);
					
			});


	

});
</script>

{/literal}
<div id="main">
<fieldset>   
<form name="searchplanForm" method="get" action="planManage.php">

<input type="hidden" name="sp" value="1" />
<a class="noSub positive" href="planCreate.php" >添加计划</a>
名称：<input type="text" name="pn" value="{$pn_s}" onFocus="this.value=''" />


创建人：<select name="cb" class="fc">
<option value="">----请选择----</option>
{html_options options=$recruiter_opt selected=$cb_s}</select>

创建日期：<input type="text" name="co" value="{$co_s}"  />

<input type="submit" value="查询" />

</form>
<hr />
<fieldset>
    <legend><code>招聘计划</code></legend>
   
<table class="myTable" width="100%">
    <thead>
<tr>
<th >招聘计划名称</th>
<th>需求岗位</th>
<th>招聘组长</th>
<th>招聘组员</th>
<th>招聘市场</th>
<th>填表人</th>
<th>填表日期</th>
<th>工作管理安排</th>
</tr>
</thead>
{foreach item=p from=$plans}
<tr>
<td><a href="planInfo.php?id={$p.id}" target="_blank">{$p.name}</a></td>
<td>{$p.requires}</td>
<td>{$p.leader}</td>
<td>{$p.member}</td>
<td>{$p.market}</td>
<td>{$p.mName}</td>
<td>{$p.createdOn}</td>
<td><a href="drDisplay.php?id={$p.id}" target="_blank" >场次安排</a></td>
</tr>

{foreachelse}
<td colspan="8" >无数据</td>
{/foreach}

</table>
{$pageList}
 </fieldset>

 </fieldset>
</div>
{include file="footer.tpl"}