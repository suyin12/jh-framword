{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=updateMarket]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#updateMarketForm").serialize();
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
							ajaxAction(t,u,d + "&btn=updateMarket",dt,m);
						};

					validator("input[name=updateMarket]","#updateMarketForm","#errorDiv",successfunc);
					
			});

			$(".date").datepick();

			$(".contactinfo").each(function(i){
   				$(this).click(function(){
   					if(confirm("确定要删除这个联系人么？") == true )
   					{
   	   				var id = $(this).attr("id");
   	   				
   	   				$.get("ajax.php",{id:id,btn:"marketupdate"},function(data,textStatus){window.location.reload();});
   					}
   					else
   	   					return false;
   	   				
   	   			});
   			});

   			$("input[name=addmarketcontact]").click(function(){
   				var t,u,d,dt,m;
				t = "post";
				u = "mSQL.php";
				d = $("#addmarketcontactForm").serialize();
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
						
						ajaxAction(t,u,d + "&btn=addmarketcontact",dt,m);
					};

				validator("input[name=addmarketcontact]","#addmarketcontactForm","#errorDiv",successfunc);
				
   	   		});

   			$("input[name=active]").click(function(){
   	   			var t,u,d,dt,m;
   	   			t = "post";
   	   			u = "mSQL.php";
   	   			d = $("#updateMarketForm").serialize();
   	   			dt = "json";
   	   			m = function(json){
   	   	   				$.each(json,function(i,n){
   	   	   	   				switch(i)
   	   	   	   				{
   	   	   	   				case "error":
   	   	   	   	   				alert(n);break;
   	   	   	   				case "success":
   	   	   	   	   				alert(n);window.location.reload();break;
   	   	   	   				}
   	   	   	   			});
   	   	   			};
   	   	   		ajaxAction(t,u,d+"&btn=active",dt,m);
   	   		});

});
</script>

{/literal}
<div id="main">
<fieldset>
    <legend><code>市场信息更新</code></legend>
<form id="updateMarketForm" class="form">

<input type="hidden" name="marketID" value="{$market.marketID}" />
市场名称<input type="text" name="name" class="req-string" value="{$market.name}"/>
所属区域<input type="text" name="district" value="{$market.district}"/>
地址<input type="text" name="address" value="{$market.address}"/>
交通路线<input type="text" name="line" value="{$market.line}"/> <br />

开发时间<input type="text" name="openDate" value="{$market.openDate}" class="date"/>
开发人<select name="openBy" class="req-string req-numeric ">
	<option value="">------请选择------</option>
	{html_options options=$users selected=$market.openBy}</select>

有效期：<input type="text" name="period_s" value="{$market.period_s}" class="date" />
至<input type="text" name="period_e" value="{$market.period_e}" class="date" />  <br />

费用状况<input type="text" name="fee" value="{$market.fee}"/>
合作状态<input type="text" name="status" value="{$market.status}"/>
展位区域<input type="text" name="area" value="{$market.area}"/>
距离里程<input type="text" name="distance" class="req-string req-numeric" value="{$market.distance}" />   <br />
其它信息<textarea rows="4" cols="60" name="other" >{$market.other}</textarea> <br />


市场特色<textarea rows="4" cols="60" name="special" >{$market.special}</textarea><br />
适合岗位<textarea rows="4" cols="60" name="properposition" >{$market.properposition}</textarea><br />
注意事项<textarea rows="4" cols="60" name="attention" >{$market.attention}</textarea><br />
<br />
</form>
联系人信息：<br />
{foreach item=c from=$contactinfo}
姓名<input type="text" name="name" value="{$c.name}" />
职务<input type="text" name="job" value="{$c.job}" />
负责事项<input type="text" name="affair" value="{$c.affair}" />
固定电话<input type="text" name="telephone" value="{$c.telephone}" />
手机<input type="text" name="mobile" value="{$c.mobile}" />
<input type="button" id="{$c.id}" class="contactinfo" value="删除" /><br />
{/foreach}
<form id="addmarketcontactForm" class="form">
<input type="hidden" name="marketID" value="{$market.marketID}" />
姓名<input type="text" name="name" class="req-string" />
职务<input type="text" name="job" class="req-string" />
负责事项<input type="text" name="affair" class="req-string" />
固定电话<input type="text" name="telephone" class="req-string" />
手机<input type="text" name="mobile" class="req-string" />
<input type="button" name="addmarketcontact"  value="添加" />
<div id="errorDiv" class="error-div-alternative"></div><br />
</form>

<input type="button" name="updateMarket" value="更新" />
{if $market.active eq 1}
<input type="button" name="active" value="禁用" />
{else}
<input type="button" name="active" value="启用" />
{/if}

</fieldset>
</div>
{include file="footer.tpl"}