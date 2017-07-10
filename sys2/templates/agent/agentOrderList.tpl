{include file="header.tpl"}
<div id="main">
    <fieldset>
        <div class="left">
            <form name="searchArchives" method="get" action="{$actionURL}">
                <table height="70px">
                    <tr>
                        <td colspan="2">
                            <strong>请选择查询条件</strong>
                            <select name="m">{html_options options=$modelArr selected=$s_m}</select>
                            <input type="text" name="c" value="{$s_c}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>支付状态</strong>
                       {foreach  from =$payStatusArr key=key item=value}
                            <input type="checkbox" name="payStatus[]" value="{$key}" {if in_array($key,$s_payStatusArr)}checked{/if}>{$value}
                       {/foreach}
                        </td>
                        <td>
                            　<input type="submit" value="查询"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </fieldset>
    <div>
        <fieldset>
            <legend><code>结果</code></legend>
            <table class="myTable">
                <tr>
                    <th>支付状态</th>
                    <th>订单号</th>
                    <th>订单总额</th>
                    <th>已付款</th>
                    <th>订单状态</th>
                    <th>取消原因</th>
                    <th>所属人电话</th>
                    <th>所属人微信号</th>
                </tr>
                {foreach item=aO key=key from=$aOrderArr}
                    {if $aO}
                        <tr>
                            <td>{$aO.payStatusTxt}</td>
                            <td><a href="orderDetail.php?orderID={$aO.orderID}">{$aO.orderID}</a></td>
                            <td>{$aO.total}</td>
                            <td>{$aO.payMoney}</td>
                            <td>{$aO.statusTxt}</td>
                            <td>{$aO.cancelReasonTxt}</td>
                            <td>{$wxUserArr[$aO.userID]['mobile']}</td>
                            <td>{$wxUserArr[$aO.userID]['nickname']}</td>
                        </tr>
                    {else}
                        <tr><td colspan="12"><font color="red">无</font></td></tr>
                    {/if}
                {/foreach}
            </table>
            <form method="post">
                <div class="tt">
                    <div class="left">{$pageList}</div>
                    <div class="right">
                        {*<input type="checkbox" name="codeVison" value="1" >编码格式版本*}
                        {*<input type="submit"  name="intoExcel"  value="保存为EXCEL"/>*}
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>
{include file="footer.tpl"}