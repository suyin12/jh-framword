{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
    <script>
        $(document).ready(function () {
            $("select[name=month]").change(function () {
                $("#form").submit();
            });
            //费用处理
            $(".editSub").each(function (i) {
                $(this).click(function () {
                    var thisUrl = $(this).attr("alt");
                    tipsWindown('导入', 'iframe:' + thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
                });
            });
            //提交
            $(".aSub").click(function () {
                var formID = $(this).parents("form").attr("id");
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "balance_sql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName  + $(this).attr("alt");
                dt = "json";
                m = function (json) {
                    var i, n, k, v;
                    $.each(json, function (i, n) {
                        switch (i) {
                            case "error":
                                alert(n);
                                break;
                            case "succ":
                                alert(n);
                                window.location.reload();
                                break;
                        }
                    });
                };
                var ret = confirm("确定" + $(this).text() + "?");
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            });

            //显示/隐藏
            $("#hideShow").click(function(){
                $("#hideArea").toggle("slow");
            });

        });
    </script>
{/literal}
<div id="main">
    <div>
        <fieldset>
            <legend><code>平账</code></legend>
            <form id="form" method="get">
                <span>平账年月</span>
                <select name="month">
                    <option value="">---请选择---</option>
                    {html_options options=$monthArr selected=$s_month}
                </select>
                <a class="aSub" name="empty" alt="">清空数据</a>
            </form>
            <input type="button" class="editSub"
                   alt="{$httpPath}excelAction/readExcel.php?a=balance_soInsFeeMulInsert&soInsDate={$s_month}"
                   value="①导入社保明细 ">
            <input type="button" class="editSub"
                   alt="{$httpPath}excelAction/readExcel.php?a=balance_soInsFeeCooMulInsert&soInsDate={$s_month}"
                   value="②导入社保补缴明细">
            <input type="button" class="editSub"
                   alt="{$httpPath}excelAction/readExcel.php?a=balance_HFFeeMulInsert&HFDate={$s_month}"
                   value="③导入公积金缴交明细 ">
            <input type="button" class="editSub"
                   alt="{$httpPath}excelAction/readExcel.php?a=balance_basicSoInsFeeMulInsert&month={$s_month}"
                   value="④[社保]备忘录 ">
			<input type="button" class="editSub"
                   alt="{$httpPath}excelAction/readExcel.php?a=balance_basicHFFeeMulInsert&month={$s_month}"
                   value="⑤[公积金]备忘录 ">	   
        </fieldset>
    </div>
    <div>

        <fieldset>
            <form id="detailForm">
                <input type="hidden" name="month" value="{$s_month}">
                <fieldset>
                <legend><code>资金往来备忘录</code></legend>
                <table class="myTable halfWidth">
                    <tr>
                        <th>账套编号</th>
                        <th>实收社保</th>
                        <th>实收社保补缴</th>
                        <th>实收公积金</th>
                        <th>实收管理费</th>
                        <th>验证状态</th>
                        <th>操作</th>
                    </tr>
                    {foreach from=$b_r item=v}
                        <tr>
                            <td>
                                {$v.feeID}
                            </td>
                            <td>
                                {$v.soInsTotal}
                            </td>
                            <td>
                                {$v.soInsSecTotal}
                            </td>
                            <td>
                                {$v.HFTotal}
                            </td>
                            <td>
                                {$v.mCost}
                            </td>
                            <td>
                               <!-- {if $b_v && $b_v[$v.feeID][status] eq 0}<a href='{$validUrl}?month={$s_month}&feeID={$v.feeID}' target="_blank">
                                        点击验证</a>{else}<a href="{$httpPath}agencyService/balance.php?month={$s_month}&feeID={$v.feeID}" target="_blank">进行平账</a>{/if}
                            -->
                                <a href="{$httpPath}agencyService/balance.php?month={$s_month}&feeID={$v.feeID}" target="_blank">进行平账</a>
                            </td>
                            <td>
                                <a class="noSub"
                                   href="{$httpPath}agencyService/balance_detail.php?m=basicFee&month={$s_month}&feeID={$v.feeID}"
                                   target="_blank">查看</a>
                                <a class="aSub" alt="&m=basicFee&month={$s_month}&keyID={$v.feeID}" name="deleteDetail">删除</a>
                            </td>
                        </tr>
                        {foreachelse}

                    {/foreach}
                </table>
                </fieldset>
                <fieldset>
                <legend><code>社保及公积金缴交明细</code></legend>
                <a id="hideShow" class="noSub">显示/隐藏 </a>
                <div id="hideArea" style="display: none">
                <table class="myTable halfWidth">
                    <tr>
                        <th>社保账号</th>
                        <th>社保合计</th>
                        <th>管理费合计</th>
                        <th>验证状态</th>
                        <th>操作</th>
                    </tr>
                    {foreach from=$s_r item=v}
                        <tr>
                            <td>
                                {$v.soInsID}
                            </td>
                            <td>
                                {$v.total}
                            </td>

                            <td>
                                {$v.mCost}
                            </td>
                            <td>
                                {if !$v.uID && $existsRet.soInsDate}<a href='{$soInsValidUrl}' target="_blank">
                                        点击验证</a>{elseif $existsRet.soInsDate}验证成功{/if}
                            </td>
                            <td>
                                <a class="noSub"
                                   href="{$httpPath}agencyService/balance_detail.php?m=soIns&soInsDate={$s_month}&soInsID={$v.soInsID}"
                                   target="_blank">查看</a>
                                <a class="aSub" alt="&m=soIns&month={$s_month}&keyID={$v.soInsID}" name="deleteDetail">删除</a>
                            </td>
                        </tr>
                        {foreachelse}
                    {/foreach}
                    <tr>
                        <td>合计:</td>
                        {foreach item=totalCell from=$soInsTotalArr}
                            <td>
                                {if  is_numeric($totalCell)}
                                    {$totalCell|string_format:"%.2f"|defaultNULL:''}
                                {else}
                                    {$totalCell}
                                {/if}

                            </td>
                        {/foreach}
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <th>公积金账号</th>
                        <th>公积金合计</th>
                        <th>管理费合计</th>
                        <th>验证状态</th>
                        <th>操作</th>
                    </tr>
                    {foreach from=$h_r item=v}
                        <tr>
                            <td>
                                {$v.housingFundID}
                            </td>
                            <td>
                                {$v.total}
                            </td>

                            <td>
                                {$v.mCost}
                            </td>
                            <td>
                                {if !$existsRet.uID && $existsRet.soInsDate}<a href='{$soInsValidUrl}' target="_blank">
                                        点击验证</a>{elseif $existsRet.soInsDate}验证成功{/if}
                            </td>
                            <td>
                                <a class="noSub"
                                   href="{$httpPath}agencyService/balance_detail.php?m=HF&HFDate={$s_month}&housingFundID={$v.housingFundID}"
                                   target="_blank">查看</a>
                                <a class="aSub" alt="&m=HF&month={$s_month}&keyID={$v.housingFundID}" name="deleteDetail">删除</a>
                            </td>
                        </tr>
                        {foreachelse}
                    {/foreach}
                    <tr>
                        <td>合计:</td>
                        {foreach item=totalCell from=$HFTotalArr}
                            <td>
                                {if  is_numeric($totalCell)}
                                    {$totalCell|string_format:"%.2f"|defaultNULL:''}
                                {else}
                                    {$totalCell}
                                {/if}

                            </td>
                        {/foreach}
                    </tr>
                </table>
                </div>
            </form>
        </fieldset>
        </div>
</div>
{include file="footer.tpl"}