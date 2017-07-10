{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
    <script type="text/javascript">
        //soSoInsList.tpl
        $(document).ready(function () {
            //select-> change get 提交
            formSubmit("", "select[name=batch]", "change", ".conditionForm");

//            formSubmit("", "select[name=zhuanyuan]", "change", ".conditionForm");

            //提交
            $(".sub").click(function(){
                var formID = this.form.id;
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "managerSql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName;
                dt = "json";
                m = function(json){
                    var i, n, k, v;
                    $.each(json, function(i, n){
                        switch (i) {
                            case "result":
                                if(n==0){
                                    alert(json.msg);
                                }else{
                                    alert(json.msg);
                                    window.location.reload();
                                }
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
    <fieldset>
        <legend><code>请选择</code></legend>
        <form method="get" class="conditionForm">
            <span>批次号</span>
            <select name="batch">
                <option value="">---请选择---</option>
                {html_options values= $batchArr output= $batchArr selected=$s_batch}
            </select>
            <!--		修改添加公积金专员分单位处理START		-->
            {*<span>公积金专员</span>*}
            {*<select name="zhuanyuan">*}
            {*<option label="全部" value="0">全部</option>*}
            {*{html_options options = $zhuanyuan_opt selected=$zhuanyuan_s}*}
            {*</select>*}
            <!--		修改添加公积金专员分单位处理END 		-->
        </form>
        <form id="createForm" name="createForm" method="post" action="">
            <input type="button" class="sub" value="更新报表" name="createHFList">
            <input type="submit" value="下载本月数据" name="intoExcel"/>
        </form>
    </fieldset>
    <fieldset>
        <legend><code>公积金申报表</code></legend>
        <p class="notice"> (注: 需要签收,才可以查看公积金申报表信息)</p>

        <form name="listForm" id="listForm">
            <table class="myTable" width="100%">
                <thead>
                <tr style="text-align:center;">
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
                {foreach item=val  from=$HFListArr}
                    <tr>
                        <td>
                            {if $val.status neq '1' }
                                <input type="checkbox" name="chkList[]"
                                       value='{$val.HFModifyDate|cat:"|"|cat:$val.sponsorName|cat:"|"|cat:$val.extraBatch}|{$val.type}'>
                            {/if}
                        </td>
                        <td>
                            {if $val.status eq '1'}<a
                                href="HFListDetail.php?n={$val.sponsorName|escape:'url'}&d={$val.HFModifyDate}&e={$val.extraBatch}&type={$val.type}"
                                target="_blank">
                                <font color="#FF0000">
                                    {$val.HFModifyDate|substr:5}
                                </font>
                                </a>
                            {else}
                                <a href="HFListDetail.php?n={$val.sponsorName|escape:'url'}&d={$val.HFModifyDate}&e={$val.extraBatch}&type={$val.type}"
                                   target="_blank">
                                    {$val.HFModifyDate|substr:5}
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
                            {if $val.type=='9'}个代{/if}
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
                            目前不存在本月公积金申报数据
                        </td>
                    </tr>
                {/foreach}
                <tr>
                    <td colspan="8">
                        <input type="button" class="sub" name="receiveHFList" value="签收">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </fieldset>
</div>
{include file="footer.tpl"}