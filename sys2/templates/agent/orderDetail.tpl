{include file="header.tpl"}
<div id="main">
    <fieldset>
        <fieldset>
            <legend><code>状态信息</code></legend>
            <table width="100%">
                <tr height="40px">
                    <td>状态</td>
                    <td>{$statusTxt}</td>
                    <td>支付状态</td>
                    <td>{$payStatusTxt}</td>
                    <td>所属人</td>
                    <td>{$wxUserArr[$userID]['nickname']}</td>
                    <td>所属人电话</td>
                    <td>{$wxUserArr[$userID]['mobile']}</td>
                    <td>创建时间</td>
                    <td>{$createdTime}</td>
                    <td>留言信息</td>
                    <td>{$message}</td>
                </tr>
                <tr>
                    <td>订单总额</td>
                    <td>{$total}</td>
                    <td>已付款</td>
                    <td>{$payMoney}</td>
                    <td>订单修改人</td>
                    <td>{$sysUserArr[$lastModifyBy]['mName']}</td>
                    <td>订单修改时间</td>
                    <td>{$lastModifyTime}</td>
                    <td>修改备注</td>
                    <td>{$modifyRemarks}</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend><code>参保人详情</code></legend>
            <table class="myTable" width="100%">
                <thead>
                <tr>
                    <th rowspan="2">姓名</th>
                    <th colspan="4">社保</th>
                    <th colspan="4">公积金</th>
                    <th rowspan="2">服务费</th>
                </tr>
                <tr>
                    <th>起缴月</th>
                    <th>月数</th>
                    <th>每月费用</th>
                    <th>小计</th>
                    <th>起缴月</th>
                    <th>月数</th>
                    <th>每月费用</th>
                    <th>小计</th>
                </tr>
                </thead>
                {foreach from=$aOrderExtraArr item=aOE key=key}
                <tr>
                    <td>{$aOE.name}</td>
                    <td>{$aOE.soInsBeginMonth}</td>
                    <td>{$aOE.soInsNeedMonthNum}</td>
                    <td>{$aOE.soInsTotal}</td>
                    <td>{$aOE.soInsNeedMonthNumTotal}</td>
                    <td>{$aOE.HFBeginMonth}</td>
                    <td>{$aOE.HFNeedMonthNum}</td>
                    <td>{$aOE.HFTotal}</td>
                    <td>{$aOE.HFNeedMonthNumTotal}</td>
                    <td>{$aOE.mCostNeedMonthNumTotal}</td>
                </tr>
                {/foreach}
            </table>

        </fieldset>
    </fieldset>
</div>
{include file="footer.tpl"}