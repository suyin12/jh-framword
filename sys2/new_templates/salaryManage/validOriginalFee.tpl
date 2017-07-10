{include file="header.tpl"}
<div id="main">
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
        <p>验证原始费用表</p>
        {if $errMsg} 
            <p>错误代码共:<span class="red">{$errMsg|@count}条</span></p>
            {if $smarty.get.whatDate=='salaryDate'}
            <p><a href="{$httpPath}salaryManage/detail.php?a=originalFee&{$smarty.server.QUERY_STRING}" target="_blank">修改原始费用表</a></p>
            {elseif $smarty.get.whatDate=='mulFee'}
            <p><a href="{$httpPath}salaryManage/detail.php?a=mulFee&{$smarty.server.QUERY_STRING}" target="_blank">修改原始费用表</a></p>
            {/if}
            {foreach item=error from=$errMsg} 
                {$error} <br>
            {/foreach} 
        {elseif $result}<span>恭喜你,费用表验证成功!!</span>
        {else}
            <p>验证失败,请联系管理员,出错情况未知...</p>
        {/if}
        <input type="button" name="next" value="关闭" onclick="javascript: window.opener.location.reload();window.close();" />
    </div>
</div>
</div>
{include file="footer.tpl"}