{include file="header.tpl"}
<div id="mainBody">
<div>
<form method="GET" class="form" id="wSForm" action={$actionURL} target="_blank">

<p>快速查询员工信息</p>
<table >
	<tr>
		<td ><strong>请选择查询条件</strong></td>
		<td >
			<select name="m" class="req-string">
			{html_options options=$m selected=$s_m}
			</select>
		</td>
		<td ><input type="text" name="c" value="{$c}" />	</td>	
		<td ><input type="submit" name="wS" value="查询" /></td>
	</tr>
</table>
</form>
</div>
	
		
	
	<div>
                                   <fieldset><legend><code>验证缴交明细</code></legend>
		{if $errMsg} 
		<p class="error">错误代码共:{$errMsg|@count}条
                                            <br/>
		<a href="{$httpPath}soInsManage/soInsFeeDetail.php?{$smarty.server.QUERY_STRING}">修改社保缴交明细</a>
                                             <br/>
		{foreach item=error from=$errMsg} 
		{$error} 
		<br/>
		{/foreach} 
		{elseif $result}<span>恭喜你,费用表验证成功!!</span>
		{else}
		验证失败,请联系管理员,出错情况未知...
		{/if}
                                           </p>
		<input type="button" name="next" value="关闭" onclick="javascript: window.opener.location.reload();window.close();" />
	</div>
</div>
{include file="footer.tpl"}