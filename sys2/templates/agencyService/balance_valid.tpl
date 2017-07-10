{include file="header.tpl"}
<div id="main">

    <div>
        <fieldset><legend><code>验证资金往来备忘录明细</code></legend>
            {if $errMsg}
            <p class="error">错误代码共:{$errMsg|@count}条
                <br/>
                修改社保缴交明细
                <br/>
                {foreach item=error from=$errMsg}
                    {$error}
                    <br/>
                {/foreach}
                {else}
                恭喜你,费用表验证成功!!
                {/if}
            </p>
            <input type="button" name="next" value="关闭" onclick="javascript: window.opener.location.reload();window.close();" />
    </div>
</div>
{include file="footer.tpl"}