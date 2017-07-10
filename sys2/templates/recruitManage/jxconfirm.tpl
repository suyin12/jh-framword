{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet"
	type="text/css">


{literal}
<script type="text/javascript">
	$(document).ready(function() {
		//	$("input[name=jxconfirm]").click(function(){
		//
		//        var t,u,d,dt,m;
		//        t = "post";
		//        u = "mSQL.php";
		//        d = $("#jxconfirmForm").serialize() ;
		//        dt = "json";
		//        m = function(json){
		//            	var i,n;
		//            	$.each(json,function(i,n){
		//                		switch(i)
		//                		{
		//                		case "error":
		//                		case "error2":
		//                		case "error3":
		//                    		alert(n);break;
		//                		case "success":
		//                    		alert(n);window.location.reload();break;
		//                		}
		//                	});
		//            };
		//		if(confirm("确认?") == true)
		//			ajaxAction(t,u,d+"&btn=jxconfirm",dt,m);
		//		else
		//			return false;
		//	});

	});
</script>
{/literal}
<div id="main">
	<fieldset>
		<legend>
			<code>生成招聘统计数据</code>
		</legend>
        <p class="notice">特别提示:  当前结算日期为:  每月  {$statisticsDate}  号</p>
		<form id="jxconfirmForm" method="post">
			<select class="req-string" name="month">
				<option value="">--选择年月--</option> {html_options options=$DateArr	selected=$s_month}
			</select>
			
			 <input type="submit" name="jxconfirm" value="确定" /> 
			 <input 	type="button" name="jxdelete" value="清空">
			
		</form>


		<fieldset>
			<legend>
				<code>按招聘人员统计</code>
			</legend>
			<table class="myTable" width="100%">
				<tr>
					{foreach item=val from=$recruitManagerStatistics_head}
					<th>{$val}</th> {/foreach}
				</tr>
				{foreach item=val from=$recruitManagerStatistics}
				<tr>
				{foreach item=tv key=tk from=$recruitManagerStatistics_head}
					<td>{$val.$tk}</td> {/foreach}
				</tr>
				{/foreach}
			</table>
		</fieldset>
		<fieldset>
			<legend>
				<code>按招聘市场统计</code>
			</legend>
			<table class="myTable" width="100%">
				<tr>
					{foreach item=val from=$marketStatistics_head}
					<th>{$val}</th> {/foreach}
				</tr>
					{foreach item=val from=$marketStatistics}
				<tr>
					{foreach item=tv key=tk from=$marketStatistics_head}
					<td>{$val.$tk}</td> {/foreach}
				</tr>
				{/foreach}
			</table>
		</fieldset>
		<fieldset>
			<legend>
				<code>按岗位统计</code>
			</legend>
		
		<table class="myTable" width="100%">
			<tr>
				{foreach item=val from=$positionStatistics_head}
				<th>{$val}</th> {/foreach}
			</tr>
				{foreach item=val from=$positionStatistics}
				<tr>
					{foreach item=tv key=tk from=$positionStatistics_head}
					<td>{$val.$tk}</td> {/foreach}
				</tr>
				{/foreach}
		</table>
		</fieldset>
	</fieldset>
</div>
{include file="footer.tpl"}
