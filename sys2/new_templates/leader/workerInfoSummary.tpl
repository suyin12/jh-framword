{include file="header.tpl"}
<div id="main" >
    <fieldset>   
<p class="success">目前派遣员工总数为:<span class="error">{$unitCount|@array_sum}</span>人</p>
{foreach item= val  key=key from= $unitManager}
{if $val.unit}
	<table class="myTable" width="100%" >
		<thead>
			<tr>
				<th width="7%">序号</th>
				<th width="35%">用工单位</th>
				<th width="8%">人数</th>
				<th width="20%">单位地址</th>
				<th width="10%">现客户经理</th>
<!--				<th width="10%"></th>-->
			</tr>
		</thead>
		<tbody>
		
		{foreach item=v key=k from=$val}
			{if $k eq "unit"}
				{foreach item=unit key=k from=$v}
				{assign var="unitID" value=$unit.unitID}
			<tr class="oneRow">
				<td>{$unitID}</td>
				<td>{$unit.unitName}</td>
				<td><span name="uTotal{$key}">{$unitCount.$unitID|default:"0"}</span></td>
				<td>{$unit.unitAddr}</td>
				<td>{$val.mName}</td>
<!--				<td></td>-->
			</tr>
				{/foreach}
			{/if}
		{/foreach}
			<tr>
				<td></td>
				<td></td>
				<td>总计 [ <span class="total red">{$managerCount[$val['mID']]}</span> ]人</td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
	{/if}
{/foreach}
</fieldset>
</div>
{include file="footer.tpl"}