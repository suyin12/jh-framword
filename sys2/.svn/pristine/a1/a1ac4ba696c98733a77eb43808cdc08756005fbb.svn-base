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
                d = $("#" + formID).serialize() + "&btn=" + btnName + $(this).attr("alt");
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
        });
    </script>
{/literal}
<div id="main">
    <div>
        <fieldset>
            <legend><code>详情</code></legend>

            <p class="notice">只显示前20条记录</p>

            <div id="tabsJ">
                <ul>
                    {foreach item=val key=key from=$statusArr}
                        <li {if $s_status eq $key}id="current"{/if}>
                            <a href="{$httpPath}agencyService/balance.php?status={$key}{$queryString}">
                                <span class="red">{$val}   (<i>{count($arr.$key)}</i>  ) </span>
                            </a>
                        </li>
                    {/foreach}
                </ul>
            </div>

            <table class="myTable">
                <thead>
                <tr>
                    {if $s_status eq 1}
                    <th>账套</th>
                    <th>单位</th>
                    <th>姓名</th>
                    <th>身份证</th>
                    <th>实收社保</th>
                    <th>实收社保补缴</th>
                    <th>实缴社保</th>
                    <th>实收公积金</th>
                    <th>实缴公积金</th>
                    <th>实收管理费</th>
                    <th>应收管理费</th>
                    {elseif $s_status eq 2}
                     <th>姓名</th>
                     <th>身份证</th>
                     <th>实缴社保</th>
                     <th>实缴公积金</th>
                     <th>应收管理费</th>
                    {/if}
                </tr>
                </thead>
                <tbody>
                {foreach item=val name=foo  from=$arr[$s_status] }
                    {if $smarty.foreach.foo.index eq 20 }
                        {break}
                    {/if}
                <tr>
                    {foreach item=v key=k from=$val}
                        {if $k eq "name"}
                            <td><a href="{$httpPath}agencyService/balance_detail.php?m=basicFee&month={$s_month}&name={$v}" target="_blank">{$v}</a></td>
                        {else}
                            <td>{$v}</td>
                        {/if}

                    {/foreach}
                </tr>
                {/foreach}
                </tbody>
            </table>
            <form method="post">
                <input name="download" value="下载明细"  type="submit">
            </form>
        </fieldset>
    </div>
</div>
{include file="footer.tpl"}