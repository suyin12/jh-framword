{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">

<div id="main">
<fieldset>
<p>档案管理人数统计表：</p>
<table class="myTable">
<tr>
<th>类别</th>
<th>总人数</th>

</tr>
{foreach key=k item=v from=$data}


<tr>
<td>
	<a href="archives.php?type={$k}">{$typeArr.$k} </a>
</td>
<td>{$v.total}</td>

</tr>


{/foreach}
</table>

</fieldset>

</div>
{include file="footer.tpl"}