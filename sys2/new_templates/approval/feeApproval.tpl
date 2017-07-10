{if $smarty.get.type eq '4'}
    {include file="header.tpl"}
{else}    
    {include file="noLeftHeader.tpl"}
    <script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js></script>
{/if}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
{if $ret.0.confirmStatus neq '1'}
    <script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>
{/if}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
    <script>
    $(document).ready(function(){
              //审批流程加载,注意一下下列规则
                $("div[id$=AppPro]").each(function(i){
                    var appProID = $(this).attr('id') + "ID";
                    $(this).load("../approval/approvalProcessDetail.php", {
                        "appProID": $("input[name=" + appProID + "]").val()
                    });
                });
                 //提交
                $(".sub").click(function(){
                    var formID = $(this).parents("form").attr("id");
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "approvalSql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName;
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
                            var ret = confirm("确定" + $(this).text()+ "?");
                            if (ret == true) {
                                ajaxAction(t, u, d, dt, m);
                            }
                });
            });
    </script>
{/literal}

{if $smarty.get.type eq '4'}
    <div id="main">
        <fieldset><legend><code>冲减挂账审批</code></legend>
            <p class="notice">1.特别提醒,最后一个审批角色,必需再次完成数据确认,否则审批流程即使完成了,也不能完成冲减挂账!!切记</p>
            <table class="myTable" width="100%">
                <tr>
                    <th>名称</th>
                    <th>审批进程</th>
                </tr>
                <tr>
                    <td>
                        {$listRet.month}月< {$unit[$listRet.unitID].unitName} > 的<{$listRet.typeName}>审批
                    </td>
                    <td>
                        <input type="hidden" name="WDDetailAppProID" value="{$listRet.appProID}" />
                        <div id="WDDetailAppPro">
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>            
    {else}
        <div id="mainbody">  
        {/if}
        <fieldset><legend><code>[ {$typeArr[$smarty.get.type].name} ]审批: </code></legend>
            <form id="feeApprovalForm">
                <input type="hidden" name="type" value="{$smarty.get.type}" />
                <input type="hidden" name="unitID" value="{$smarty.get.unitID}">
                <input type="hidden" name="month" value="{$smarty.get.month}">
                <table class="myTable" width="100%">
                    <thead>
                        <tr>
                            <th>调整人姓名</th>
                            <th>被调整人姓名</th>
                            <th>个人社保</th>
                            <th>单位社保</th>
                            <th>个人公积金</th>
                            <th>单位公积金</th>
                            <th>单位商保</th>
                            <th>个人商保</th>
                            <th>管理费</th>
                            <th>残障金</th>
                            <th>单位其他费用</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach item=val from=$ret}
                            <tr>
                                <td>
                                    <input type="hidden" name="roleA[]" value="{$val.roleA}">
                                    <a href="{$httpPath}workerInfo/wManage.php?uID={$val.roleA}&update=true" target="_blank">{$nameR[$val.roleA].name}</a>
                                </td>
                                <td>
                                    <input type="hidden" name="roleB[]" value="{$val.roleB}">
                                    <a href="{$httpPath}workerInfo/wManage.php?uID={$val.roleB}&update=true" target="_blank">{$nameR[$val.roleB].name}</a>
                                </td>
                                <td>
                                    {$val.pSoInsMoney|defaultNULL:''}
                                </td>
                                <td>
                                    {$val.uSoInsMoney|defaultNULL:''}
                                </td>
                                <td>
                                    {$val.pHFMoney|defaultNULL:''}
                                </td>
                                <td>
                                    {$val.uHFMoney|defaultNULL:''}
                                </td>
                               <td>
                                   {$val.uComInsMoney|defaultNULL:''}
                                </td>
                               <td>
                                   {$val.pComInsMoney|defaultNULL:''}
                                </td>
                                <td>
                                    {$val.managementCostMoney|defaultNULL:''}
                                </td>
                                <td>
                                   {$val.uPDInsMoney|defaultNULL:''}
                                </td>
                                <td>
                                    {$val.uOtherMoney|defaultNULL:''}
                                </td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td colspan="2">合计</td>
                            <td>{$totalArr.1.pSoInsMoney}</td>
                            <td>
                                {$totalArr.1.uSoInsMoney}
                            </td>
                            <td>{$totalArr.1.pHFMoney}</td>
                            <td>
                                {$totalArr.1.uHFMoney}
                            </td>
                            <td>
                                {$totalArr.1.uComInsMoney}
                            </td>
                            <td>
                                {$totalArr.1.pComInsMoney}
                            </td>
                            <td>
                                {$totalArr.1.managementCostMoney}
                            </td>
                            <td>
                                {$totalArr.1.uPDInsMoney}
                            </td>
                            <td>
                                {$totalArr.1.uOtherMoney}
                            </td>
                        </tr>
                         </tbody>
                    </table>
                        {if $ret.0.confirmStatus neq '1'}
                            <table width="100%">
                            <tr>
                                <td>
                                    {if $nRet.proID && $smarty.get.type eq '4'}
                                        <form id="approvalForm">
                                            <input type="hidden" name="proID" value='{$nRet.proID}'>
                                            <input type="hidden" name="WDDetail" value='1'>
                                            <input type="button" class="sub" name="approvalSucc" value="审批通过"> 
                                            <input type="button" class="sub" name="approvalRollback" value="退回">
                                            备注: <textarea name="approvalRemarks"></textarea>
                                        </form>
                                    {/if}
                                </td>
                                <td><input type="button" class="sub" name="feeApprovalSuccBtn" value="数据确认" {if $listRet.status neq '1' && $smarty.get.type eq '4'}disabled{/if}  /></td>
                            </tr>
                            </table>
                {else}
                        <p class="success">数据已确认,无法再次操作</p>
                {/if}	
            </form>
        </fieldset>        
    </div>
    {include file="footer.tpl"}