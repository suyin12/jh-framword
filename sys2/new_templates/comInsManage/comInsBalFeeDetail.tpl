{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
    <script>
    $(document).ready(function(){
               //提交
                $(".sub").click(function(){
                    var formID = this.form.id;
                    var btnName = $(this).attr("name")
                    var t, u, d, dt, m;
                    t = "post";
                    u = "comSql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=comInsFee";
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
                });
            });
    </script>
{/literal}
<div id="main">
    {if $smarty.get.query neq 'detail'}
        <form id="comInsBalFeeForm" name="comInsBalFeeForm">
            <input type="hidden" name="unitID" value="{$smarty.get.unitID}">
            <input type="hidden" name="month" value="{$smarty.get.month}">
            <input type="hidden" name="comInsDate" value="{$smarty.get.comInsDate}">
            <input type="button" class="sub" name="comInsBalFeeBtn" value="提交平账结果">
            <p>共<span class="red">{$margin|count}</span>条记录</p>
            <table class="myTable">
                <thead>
                    <tr>
                        <th rowspan="2">员工编号</th>
                        <th rowspan="2">姓名</th>
                        <th colspan="2">应收</th>
                        <th colspan="2">实收</th>
                        <th rowspan="2">个人欠/挂</th>
                        <th rowspan="2">单位欠/挂</th>
                    </tr>
                    <tr>
                        <th>个人</th>
                        <th>单位</th>
                        <th>个人</th>
                        <th>单位</th>
                    </tr>
                <tbody>
                    {foreach from=$margin item=val key=k}
                        <tr>
                            <td>{$k}</td>
                            <td><a href="{$httpPath}workerInfo/wManage.php?uID={$k}" target='_blank'>{$wRet[$k].name|default:$ofR[$k].name}</a></td>
                            <td>{$comInsR[$k].pComInsMoney}</td>
                            <td>{$comInsR[$k].uComInsMoney}</td>
                            <td>{$ofR[$k].pComIns}</td>
                            <td>{$ofR[$k].uComIns}</td>
                            <td>{if $val.pMargin}<input type=text name="pComInsMoney[{$k}]" value="{$val.pMargin}" size="5" />{/if}</td>
                            <td>{if $val.uMargin}<input type=text name="uComInsMoney[{$k}]" value="{$val.uMargin}"  size="5" />{/if}</td>
                        </tr>    
                     {/foreach}   
                </tbody>
                </thead>
            </table>
        </form>
    {else}
        <p>共<span class="red">{$ret|@count}</span>条记录</p>
        <table class="myTable">
            <thead>
            <form name="cSequenceForm">
                <tr>
                    {foreach key=key item = fieldName from=$newFieldArr}
                        <th>{$fieldName}</th>
                    {/foreach}
                </tr>
            </form>
            </thead>
            <tbody>
                {foreach item = val from =$ret}
                    <tr>
                        {foreach item=v from=$val }
                            <td>
                                {$v}
                            </td>
                        {/foreach}
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
</div>
{include file="footer.tpl"}