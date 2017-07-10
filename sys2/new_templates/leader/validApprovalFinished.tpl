{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>

</script>
{/literal}
<div id="main">
	<table class="myTable">
		<thead>
			<tr>
				<th>审批流程名称</th>
				<th>状态</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$ret item=val}
			<tr>
			   <td>{$val.typeName}</td>
			   <td>
                   {if $val.status neq '1'}
				       <span class="red">未完成审批</span>
				   {else}
				       已完成审批
				   {/if}
			  </td>
			   <td>
				   	{if $val.status neq '1'}
				   <a href='{$httpPath}approval/approvalIndex.php'>进入审批流程</a>
				   {else}
				    <a href='{$httpPath}approval/approvalIndex.php?process=history'>进入审批流程</a>
				   {/if}
			   </td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>
{include file="footer.tpl"}