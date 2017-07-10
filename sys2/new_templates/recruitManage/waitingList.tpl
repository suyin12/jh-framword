{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">


{literal}
<script type="text/javascript">

$(document).ready(function(){

	   // 全选/反选
    $('#allunits').click(function(){
        if ($(this).attr('checked') == true){
            $(".units").attr('checked', true);
        }
        else {
            $('.units').attr('checked', false);
        }
    });


   	$("input[name=wlunits]").click(function(){


   		var t,u,d,dt,m;
   		t = "post";
   		u = "mSQL.php";
   		d = $("#wlunitsForm").serialize();
   		dt = "script";
   		m = function(ret){
				if(ret == 1)
				{
					$("#wlunitsForm").attr("action","talentsList.php");
					$("#wlunitsForm").submit();
				}
				else if(ret == 2)
				{
					$("#wlunitsForm").attr("action","talentsList2.php");
					$("#wlunitsForm").submit();
				}
				else if(ret == -1)
				{
					alert("只有同为特定分配和同为非特定分配的才能合并处理");
				}
				else if(ret == -2)
				{
					alert("大类的单位不能合并处理");
				}
				else
				{
					alert( ret + "单位的待岗名单类型错误");
				}
				
   	   		};

   	   		if(d)
		   	   	ajaxAction(t,u,d + "&btn=wlunits" ,dt,m);
   	   		else
   	   	   		alert("请先选择要合并处理的单位");
    });

	
});
</script>
{/literal}
<div id="main">
    <fieldset>
<fieldset class="left">
<legend><code>待岗名单管理</code></legend>    
<form id="wlunitsForm" method="get" action="">
<table class="myTable">
<tr>
<th><input type="checkbox" id="allunits" />全选</th>
<th>单位</th>
<th>超过5天</th>
<th>超过10天</th>
<th>超过30天</th>
<th>待岗人数</th>
<th>处理</th>
</tr>
{foreach item=record key=unitid from=$waitingList}

<tr>
<td><input type="checkbox" name="unit[]" class="units" value="{$unitid}" /></td>
<td>{$record.name}</td>


<td>{$record.day5}</td>
<td>{$record.day10}</td>
<td>{$record.day30}</td>
<td>{$record.num}</td>


{if $record.type eq 1}
<td><a href="talentsList.php?unit[]={$unitid}" target="_blank">处理</a></td>
{else}
<td><a href="talentsList2.php?unit[]={$unitid}" target="_blank">处理</a></td>
{/if}

</tr>

{foreachelse}
<td colspan="4">无数据</td>
{/foreach}
</table>
<input type="button" name="wlunits" value="合并处理" />
</form>
</fieldset>
<!--<fieldset class="right halfWidth">
<legend><code>各客户经理管理单位</code></legend>  
<form id="wlmanagersForm" method="get" action="">
<table class="myTable" width="100%">
<tr>
<th>客户经理</th>
<th>待岗人数</th>

</tr>
{foreach item=r from=$wlmanagers}
<tr>

<td>{if $r.signTo neq '0'}<a href="talentsList2.php?st={$r.signTo}">{/if}{$r.mName}{if $r.signTo neq '0'}<a href="talentsList2.php?st={$r.signTo}"></a>{/if}</td>
<td>{$r.num}</td>
</tr>
{/foreach}
</table>
</form>
</fieldset>-->
</fieldset>
</div>
{include file="footer.tpl"}