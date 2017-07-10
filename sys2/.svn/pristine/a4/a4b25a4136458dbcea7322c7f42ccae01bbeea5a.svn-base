{include file="header.tpl"}
{*<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>*}
{*</script>*}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{*<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>*}
{*</script>*}
{literal}
    <script type="text/javascript">
$(document).ready(function(){
    function updateSendStatus(unitID){
        var t, u, d, dt, m;
        t = "post";
        u = "salarySendConfim.php";
        d = "unitID="+unitID;
        dt = "json";
         m = function(json){
        var i, n, k, v;
        $.each(json, function(i, n){
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
        var ret = confirm("确定" + $(this).val() + "?");
        if (ret == true) {
            ajaxAction(t, u, d, dt, m);
        }
    }
    //客户经理/单位二级联动
    linkage("select[name=mID]","select[name=unitID]",$('.js_unitManager').val());
});

    </script>
{/literal}

<div id="main" >
    <fieldset>
        <form method="GET">
            <input type="hidden" class="js_unitManager" value='{$js_unitManager}'>
            <table>
                <tr>
                    <td>
                        <span>费用年月</span>
                        <select name="month">
                            <option>--请选择月份--</option>
                            {html_options options=$salaryDateArr selected=$s_month}
                        </select>
                    </td>
                    {include file="commonTPL/unitManagerLinkage.tpl"}
                    <td>
                        <input type="submit" name="wCS" value="提交" />
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <table class="myTable">
        <thead>
        <tr>
            <th>状态</th>
            <th>客户经理</th>
            <th>单位名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        {foreach item=manager from=$unitManager }
            {foreach item=unit key=key  from=$manager}
                {if $key eq 'unit'}

                    {foreach item=unitList from=$unit}
                        {if $s_unitID eq $unitList.unitID}
                            <tr>
                                <td>
                                    {$unitList.unitName}
                                </td>
                                <td>
                                    {foreach item=salaryList from=$ret}
                                        {if $salaryList.unitID eq $unitList.unitID}
                                            <a href="{$httpPath|cat:'salaryManage/salaryManage.php?zID='|cat:'&month='|cat:$salaryList.month|cat:'&salaryDate='|cat:$salaryList.salaryDate|cat:'&unitID='|cat:$salaryList.unitID|cat:'&soInsDate='|cat:$salaryList.soInsDate|cat:'&comInsDate='|cat:$salaryList.comInsDate|cat:'&managementCostDate='|cat:$salaryList.managementCostDate}" target="_blank">{$salaryList.month|substr:4}	月</a> 	 |
                                        {/if}
                                    {/foreach}
                                </td>
                                <td>
                                    {$manager.mName}
                                </td>
                                <td>
                                    <input type="button" dataSrc="salaryZFChose.php?mID={$manager.mID}&unitID={$unitList.unitID}&process=salary" class="createFee"  value="新费用">
                                </td>
                            </tr>
                        {elseif !$s_unitID}
                            <tr>
                                <td>
                                    {$unitList.unitName}
                                </td>
                                <td>
                                    {foreach item=salaryList from=$ret}
                                        {if $salaryList.unitID eq $unitList.unitID}
                                            <a href="{$httpPath|cat:'salaryManage/salaryManage.php?zID='|cat:'&month='|cat:$salaryList.month|cat:'&salaryDate='|cat:$salaryList.salaryDate|cat:'&unitID='|cat:$salaryList.unitID|cat:'&soInsDate='|cat:$salaryList.soInsDate|cat:'&comInsDate='|cat:$salaryList.comInsDate|cat:'&managementCostDate='|cat:$salaryList.managementCostDate}" target="_blank">{$salaryList.month|substr:4}	月</a> 	 |
                                        {/if}
                                    {/foreach}
                                </td>
                                <td>
                                    {$manager.mName}
                                </td>
                                <td>
                                    <input type="button" dataSrc="salaryZFChose.php?mID={$manager.mID}&unitID={$unitList.unitID}&process=salary" class="createFee"  value="新费用">
                                </td>
                            </tr>
                        {/if}
                    {/foreach}
                {/if}
            {/foreach}
        {/foreach}
        </tbody>
    </table>
</div>
{include file="footer.tpl"}