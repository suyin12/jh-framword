{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/4.js>
</script>

<div id="main">
   <fieldset><legend><code>社保申报表批次明细: </code></legend>

<P class="info">批次号:{$ret.0.batch}  共{$ret|@count}条记录</p>
<form name="listForm">
 <table class="myTable">
	<thead>
		<tr>
		    <th>序号</th>
			<th>姓名</th>
			<th>身份证</th>
			<th>性别</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=val from=$ret}
		<tr>
			<td>{$val.num}</td>
			<td>{$val.name}</td>
			<td>{$val.pID}</td>
			<td>{$val.sex}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="14">无查询结果</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</form>
</fieldset>
</div>
{include file="footer.tpl"}
