{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=createMarket]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createMarketForm").serialize();
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
							ajaxAction(t,u,d + "&btn=createMarket",dt,m);
						};

					validator("input[name=createMarket]","#createMarketForm","#errorDiv",successfunc);
					
			});

	

});
</script>
{/literal}
<div id="main">
    <fieldset>
        <legend>
    <code>渠道管理</code>
    </legend>
<a class="noSub positive" href="marketCreate.php" target="_blank" >添加渠道</a>
<table class="myTable" width="100%">
<tr>

<th width="200">名称</th>
<th>区域</th>
<th>地址</th>
<th>开发时间</th>
<th>开发人</th>
<th>费用情况</th>
<th>有效期</th>
<th>特色</th>
<th>距离(Km)</th>
<th>状态</th>

</tr>

{foreach item=m from=$markets_info}
<tr>
<td><a href="marketUpdate.php?id={$m.marketID}" target="_blank">{$m.name}</a></td>
<td title="{$m.name}">{$m.district}</td>
<td>{$m.address}</td>
<td>{$m.openDate}</td>
<td>{$m.mName}</td>
<td>{$m.fee}</td>
<td>{$m.period_s}至{$m.period_e}</td>
<td>{$m.special}</td>
<td>{$m.distance}</td>
<td>{$m.active|replace:"1":"活动"|replace:"0":"禁用"}</td>
</tr>
{foreachelse}
<td colspan="10">无数据</td>
{/foreach}

</table>


{$pageList}








</fieldset>
</div>
{include file="footer.tpl"}