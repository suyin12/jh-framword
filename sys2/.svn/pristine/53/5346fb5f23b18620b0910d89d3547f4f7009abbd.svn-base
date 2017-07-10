{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>

{literal}
<script type="text/javascript">

$(document).ready(function(){
	
	formSubmit("", "select[name=batch_m]", "change", ".batchForm");
	
});


</script>
<style>
<!--


-->
</style>
{/literal}
<div id="main">
    <fieldset>   
 <p class="notice">注：1.单位一栏表示在本月内上岗的人数，入职和金额都对应的是这些人<br>
2.其他数据则是在本月产生的全部数据，不分单位<br>
3.……</p>
<a class="noSub positive" href="jxconfirm.php" >生成招聘数据统计</a>

<form id="batchForm" class="batchForm" method="get" >
<select name="batch_y">
{html_options options=$batchy_opt selected=$batchy_s}
</select>
<select name="batch_m">
{html_options options=$batchm_opt selected=$batchm_s}
</select>
<!--<input type="submit" name="batch" />-->
</form>



<table class="myTable" width="100%">
<tr>
{foreach item=o from=$xxx_head}
<th>{$o|replace:"深圳市":""|replace:"深圳":""}</th>
{/foreach}
</tr>
{if $xxx neq null}
{foreach item=jx key=name from=$xxx}
<tr>
<td>{$name}</td>
{foreach item=r from=$jx}
<td>{$r}</td>
{/foreach}
</tr>

{/foreach}

<tr>
{foreach item=o from=$xxx_sum}
<td>{$o}</td>
{/foreach}
</tr>
{else}
<tr>
<td colspan="13">无数据</td>
</tr>
{/if}
</table>

<!---->
<!--<hr />-->
<!--<a href="#st1">分岗位分人员招聘人数统计</a>|-->
<!--<a href="#st2">绩效统计表（部分数据）</a>|-->
<!--<a href="#st3">需求满足率</a>-->
<!--<hr />-->
<!--分岗位分人员招聘人数统计&nbsp;&nbsp;<a name="st1" href="#top">TOP</a>-->
<!--<table class="myTable" id="table1">-->
<!---->
<!--<tr>-->
<!--<th></th>-->
<!--{foreach key=p item=number from=$data name=user}-->
<!---->
<!--{if $smarty.foreach.user.index eq 0}-->
<!--{foreach key=m item=num from=$number}-->
<!--<th>{$m}</th>-->
<!--{/foreach}-->
<!--{/if}-->
<!---->
<!--{/foreach}-->
<!--</tr>-->
<!---->
<!---->
<!--{foreach key=p item=number from=$data}-->
<!---->
<!---->
<!--<tr>-->
<!--<th>{$p|replace:"深圳市":""|replace:"深圳":""|replace:"有限公司":""}</th>-->
<!--{foreach key=m item=num from=$number name=digit}-->
<!--{if $smarty.foreach.digit.index eq 4}-->
<!--<th>{$num}</th>-->
<!--{else}-->
<!--<td>{$num}</td>-->
<!--{/if}-->
<!--{/foreach}-->
<!--</tr>-->
<!---->
<!---->
<!--{/foreach}-->
<!---->
<!--</table>-->
<!---->
<!---->
<!---->
<!---->
<!--绩效统计表（部分数据）&nbsp;&nbsp;<a name="st2" href="#top">TOP</a>-->
<!--<table class="myTable" id="table2">-->
<!--<tr>-->
<!--<th></th>-->
<!--{foreach key=user item=data from=$jixiao name=ji}-->
<!--{foreach key=unit item=num from=$data}-->
<!---->
<!--{if $smarty.foreach.ji.index eq 0}-->
<!--<th>{$unit|replace:"深圳市":""|replace:"深圳":""|replace:"有限公司":""}</th>-->
<!--{/if}-->
<!---->
<!---->
<!--{/foreach}-->
<!--{/foreach}-->
<!--</tr>-->
<!---->
<!---->
<!--{foreach key=user item=data from=$jixiao name=ji}-->
<!---->
<!--<tr>-->
<!---->
<!--<th>{$user}</th>-->
<!--{foreach key=k item=num from=$data}-->
<!--<td>{$num}</td>-->
<!--{/foreach}-->
<!---->
<!--</tr>-->
<!--{/foreach}-->
<!--</table>-->
<!---->
<!---->
<!--需求满足率&nbsp;&nbsp;<a name="st3" href="#top">TOP</a>-->
<!--<table class="myTable" id="table3">-->
<!--<tr>-->
<!--<th>需求岗位</th>-->
<!--<th>招聘人数</th>-->
<!--<th>截止日期</th>-->
<!--<th>需求数</th>-->
<!--<th>满足率</th>-->
<!--</tr>-->
<!--{foreach item=re from=$rate}-->
<!---->
<!--<tr >-->
<!--<th>{$re.name}</th>-->
<!--<td>{$re.num}</td>-->
<!--<td>{$re.date}</td>-->
<!--<td>{$re.required}</td>-->
<!--<td>{$re.rate}%</td>-->
<!--</tr>-->
<!--{/foreach}-->
<!--</table>-->




</fieldset>
</div>
{include file="footer.tpl"}