{include file="header.tpl"}
<script type="text/javascript"
        src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="main">
          <fieldset><legend><code>就业登记清单批次明细 </code></legend>

<P class="info">申报日期:{$jobRegModifyDate}</p>
<p class="success"><img src="{$httpPath}/css/images/information.png">就业登记[ <span class="error"> 新增</span>  ] 人员名单</p>
<form name="listForm">
<table class="myTable">
	<thead>
		<tr style="text-align: center;">
			<th>序号</th>
			<th>单位</th>
			<th>姓名</th>
			<th>身份证</th>			
			<th>状态</th>
			<th>客户经理</th>
			<th>签收人</th>
			<th>签收日期</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=val from=$inRet}
		<tr>
			<td>{$val.num}</td>
			<td>{$val.unitName}</td>
			<td>{$val.name}</td>
			<td>{$val.pID}</td>
			<td>{$val.jobRegStatus}</td>
			<td>{$val.sponsorName}</td>
			<td>{$val.receiverName}</td>
			<td>{$val.receiveTime}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="19">无查询结果</td>
		</tr>
		{/foreach}
	</tbody>
</table>
<p class="success"><img src="{$httpPath}/css/images/information.png">就业登记[ <span class="error">终止</span>  ] 人员名单</p>
<table class="myTable">
	<thead>
		<tr>
		<th>序号</th>
		<th>单位</th>
		<th>姓名</th>
                                             <th>身份证</th>
		<th>状态</th>
		<th>员工编号</th>
		<th>客户经理</th>
		<th>签收人</th>
		<th>签收日期</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=val from=$outRet}
		<tr>
			<td>{$val.num}</td>
			<td>{$val.unitName}</td>
			<td>{$val.name}</td>
                                                    <td>{$val.pID}</td>
			<td>{$val.jobRegStatus}</td>
			<td>{$val.uID}</td>
			<td>{$val.sponsorName}</td>
			<td>{$val.receiverName}</td>
			<td>{$val.receiveTime}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="9">无查询结果</td>
		</tr>
		{/foreach}
	</tbody>
	</table>
</form>
<form method="post"><input type="submit" name="intoExcel"
	value="保存为EXCEL"></form>
</fieldset>
</div>
{include file="footer.tpl"}