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
                    <td>创建时间</td>
                    <td>{$createdTime}</td>
                    <td>留言信息</td>
                    <td>{$message}</td>
                </tr>
                <tr height="40px">
                    <td>所属人</td>
                    <td>{$wxUserArr[$userID]['nickname']}</td>
                    <td>所属人电话</td>
                    <td>{$wxUserArr[$userID]['mobile']}</td>
                    <td>订单修改人</td>
                    <td>{$sysUserArr[$lastModifyBy]['mName']}</td>
                    <td>订单修改时间</td>
                    <td>{$lastModifyTime}</td>
                    <td>修改备注</td>
                    <td>{$modifyRemarks}</td>
                </tr>
                <tr height="40px">
                    <td>订单总额</td>
                    <td>{$total}</td>
                    <td>已付款</td>
                    <td>{$payMoney}</td>
                    <td>退款金额</td>
                    <td>{$refundMoney}</td>
                </tr>
            </table>
        </fieldset>
        <a class="noSub positive" href='checkRefund.php?orderID={$orderID}'> 退款核算</a>
        <fieldset>
            <legend><code>退保详情</code></legend>
            <table class="myTable" width="100%">
                <thead>
                <tr>
                    <th>姓名</th>
                    <th>社保停缴月</th>
                    <th>公积金停缴月</th>
                </tr>
                </thead>
                {foreach from=$data item=aOR key=key}
                    <tr>
                        <td>{$aOR.name}</td>
                        <td>{$aOR.soInsStopMonth}</td>
                        <td>{$aOR.HFStopMonth}</td>
                    </tr>
                {/foreach}
            </table>
        </fieldset>
        <fieldset>
            <legend><code>退款账户</code></legend>
            <table width="100%">
                <tr height="40px">
                    <td>开户行</td>
                    <td>{$setArr['bankInitArr'][$bankInfo.bankID]['name']}</td>
                    <td>开户支行</td>
                    <td>{$bankInfo.bankAddress}</td>

                </tr>
                <tr>
                    <td>账号</td>
                    <td>{$bankInfo.bID}</td>
                    <td>姓名</td>
                    <td>{$bankInfo.name}</td>
                    <td>手机</td>
                    <td>{$bankInfo.phone}</td>

                </tr>
            </table>
        </fieldset>
    </fieldset>
</div>
{include file="footer.tpl"}