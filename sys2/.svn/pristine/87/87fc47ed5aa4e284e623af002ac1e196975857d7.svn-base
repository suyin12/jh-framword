{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/4.js>
</script>
<div id="main">
    <fieldset>
        <legend><code>请选择</code></legend>
        <form method="get" class="conditionForm">

            <span>批次号</span>
            <select name="batch">
                <option value="">---请选择---</option>
                {html_options values= $batch output= $batch selected=$s_batch}
            </select>
            <!--		修改添加社保专员分单位处理START		-->
            <span>社保专员</span>
            <select name="zhuanyuan">
                <option label="全部" value="0">全部</option>
                {html_options options = $zhuanyuan_opt selected=$zhuanyuan_s}
            </select>
            <!--		修改添加社保专员分单位处理END 		-->
        </form>
        <form action="" method="post">
            <input type="submit" value="下载本月数据" name="intoExcel"/>
        </form>
    </fieldset>
    <fieldset>
        <legend><code>社保申报表</code></legend>
        <p class="notice"> (注: 需要签收,才可以查看社保申报表信息)</p>

        <form name="listForm" id="listForm">
            <input type="hidden" name="zy" value="{$zhuanyuan_s}"/>
            <table class="myTable" width="100%">
                <thead>
                <tr>
                    <th>√</th>
                    <th>申报日期</th>
                    <th>提交人</th>
                    <th>提交日期</th>
                    <th>类别</th>
                    <th>签收人</th>
                    <th>签收日期</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody>
                {foreach item=val  from=$ret}
                    <tr>
                        <td>
                            {if $val.status neq '1' }
                                <input type="checkbox" name="chkList[]"
                                       value='{$val.soInsModifyDate|cat:"|"|cat:$val.sponsorName|cat:"|"|cat:$val.extraBatch}|{$val.type}'>
                            {/if}
                        </td>
                        <td>
                            {$val.receiverID}
                            {if $val.status eq '1'}<a
                                href="soInsListDetail.php?n={$val.sponsorName|escape:'url'}&d={$val.soInsModifyDate}&e={$val.extraBatch}&type={$val.type}"
                                target="_blank">
                                <font color="#FF0000">
                                    {$val.soInsModifyDate|substr:5}
                                </font>
                                </a>
                            {else}
                                <a href="soInsListDetail.php?n={$val.sponsorName|escape:'url'}&d={$val.soInsModifyDate}&e={$val.extraBatch}&type={$val.type}"
                                   target="_blank">
                                    {$val.soInsModifyDate|substr:5}
                                </a>
                            {/if}
                        </td>
                        <td>
                            {$val.sponsorName}
                        </td>
                        <td>
                            {$val.sponsorTime}
                        </td>
                        <td>
                            {if $val.type=="9"}个代{/if}
                        </td>
                        <td>
                            {if $val.status neq '0'}
                                {$val.receiverName}
                            {else}
                            {/if}
                        </td>
                        <td>
                            {if $val.status neq '0'}
                                {$val.receiveTime}
                            {else}
                            {/if}
                        </td>
                        <td>
                            {if $val.status eq '1' }
                                已签收
                            {elseif $val.status eq '0'||$val.status eq '2'}
                                未签收
                            {else}
                                出错了
                            {/if}
                        </td>
                    </tr>
                    {foreachelse}
                    <tr>
                        <td colspan="8">
                            目前不存在本月社保申报数据
                        </td>
                    </tr>
                {/foreach}
                <tr>
                    <td colspan="8">
                        <input type="button" class="sub" name="receive" value="签收">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </fieldset>
</div>
{include file="footer.tpl"}