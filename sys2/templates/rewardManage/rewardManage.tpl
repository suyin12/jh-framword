{include file="header.tpl"}

<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>

<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>

<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
    <script>

	
            $(document).ready(function(){
                //提交
                $(".aSub").click(function(){
                    var formID = $(this).parents("form").attr("id");
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "sql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=reward";
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
                    var ret = confirm("确定" + $(this).text() + "?");
                    if (ret == true) {
                        ajaxAction(t, u, d, dt, m);
                    }
                });
	    
                //全选反选
                $(".chkAll").click(function(){
                    var cC, aC;
                    var allChkName = this.name;
                    var chkName = allChkName.replace("Chk", "");
                    cC = this;
                    aC = ':checkbox[name^=' + chkName + 'Check]';
                    checkAll(cC, aC);
                });
	    
                //费用处理
                $(".editSub").each(function(i){
                    $(this).click(function(){
                        var thisUrl = $(this).attr("alt");
                        tipsWindown('下载报表', 'iframe:' + thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
                    });
                });
	    
                //审批流程加载,注意一下下列规则
                    $("div[id$=AppPro]").each(function(i){
                            var appProID=$(this).attr('id')+"ID";
                            $(this).load("../approval/approvalProcessDetail.php", {
                       "appProID": $("input[name="+appProID+"]").val()});
                    });
            });
    </script>
{/literal}
<div id="main">
    
    <div>
        <fieldset>
            <legend><code>审批进程预览</code></legend>
            <table class="myTable">
                <tr>
                    <th>审批名称</th>
                    <th>审批进程</th>
                    <th>操作</th>
                </tr>
                {foreach item=val key=key from=$exAppArr}
                    <tr>
                        <td>
                            {$authArr.approval[$val.type].typeName}[{$val.extraBatch}]
                            {$authArr[$val.type].typeName}
                            <input type="hidden" name="{$key}AppProID" value="{$val.appProID}" />
                        </td>
                        <td>
                            <div  id="{$key}AppPro"></div>
                        </td>
                        <td>
                            <a class="noSub" href="{$httpPath}approval/approvalIndex.php">审批</a>
                            <a class="noSub" href="{$httpPath|cat:$val.URL}">查看数据</a>
                        </td>
                    </tr>
                {/foreach}
            </table>
        </fieldset>
    </div>
     <fieldset>
     <fieldset class="left halfWidth">
        <legend><code>未处理的原始奖金表</code></legend>
        <form id="delRewardFeeForm" name="delRewardFeeForm">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>全选<input type="checkbox" name="rewardChk" class="chkAll"/></th>
                        <th>批次</th>
                        <th>费用年月</th>
                        <th>奖金年月</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach from=$exRet item=exVal}
                        <tr>
                            <td>
                                <input type="checkbox" name="rewardCheck[]" value='{$exVal.month}|{$exVal.unitID}|{$exVal.extraBatch}'>
                            </td>
                            <td>
                                第{$exVal.extraBatch}次奖金
                            </td>
                            <td>
                                {$exVal.month}
                            </td>
                            <td>
                                {$exVal.rewardDate}
                            </td>
                            <td>
                                <a href="detail.php?a=reward&zID={$exVal.zID}&extraBatch={$exVal.extraBatch}&unitID={$exVal.unitID}&month={$exVal.month}">查看</a>
                                {if !$ret[$exVal.extraBatch]} 
                                    | <a href="makeRewardFee.php?unitID={$exVal.unitID}&month={$exVal.month}&extraBatch={$exVal.extraBatch}&displaySp=true&fixTable=true">制作奖金费用表</a>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}
                    <tr>
                        <td><input type="button" class="aSub" name="delRewardFeeBtn" value="删除"></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </fieldset>       
    <fieldset class="right halfWidth">
        <legend><code>处理后的奖金费用表</code></legend>
        <form id="delFeeForm" name="delFeeForm">
            <input name="unitID" type="hidden" value="{$smarty.get.unitID}">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>费用年月</th>
                        <th>奖金年月</th>
                        <th>第?笔</th>
                        <th>总费用</th>
                        <th>个税合计</th>
                        <th>实发合计</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach item=val key=key from=$ret}
                        <tr>
                            <td>
                                <input type="hidden" name="month" value="{$smarty.get.month}">
                                {if $val.acheive}
                                    <a href='{$httpPath}rewardManage/exportExcel.php?month={$val.month}&unitID={$val.unitID}&extraBatch={$val.extraBatch}&type=fee&output=true'>{$val.month}</a>
                                {else}    
                                <a href="{$httpPath}rewardManage/makeRewardFee.php?month={$val.month}&unitID={$val.unitID}&extraBatch={$val.extraBatch}&displaySp=true&fixTable=true"> {$val.month}</a>
                                {/if}
                             </td>
                            <td>
                                <input type="hidden" name="rewardDate" value="{$val.rewardDate}">
                                {if $val.acheive}
                                    <a href='{$httpPath}rewardManage/exportExcel.php?month={$val.month}&unitID={$val.unitID}&extraBatch={$val.extraBatch}&type=salary&output=true'>{$val.rewardDate}</a>
                                {else}  
                                <a href="{$httpPath}rewardManage/makeReward.php?month={$val.month}&unitID={$val.unitID}&extraBatch={$val.extraBatch}&displaySp=true&fixTable=true">{$val.rewardDate}</a>
                                {/if}
                             </td>
                            <td>
                                <input type="hidden" name="extraBatch" value="{$val.extraBatch}">
                                {$val.extraBatch}
                            </td>
                            <td>
                                {$val.totalFee}
                            </td>
                            <td>
                                {$val.pTax}
                            </td>
                            <td>
                                {$val.acheive}
                            </td>
                            <td>
                                {if $val.confirmStatus neq '1'}
                                    <a name="delFeeBtn" class="aSub" href="#">删除</a>    
                                {/if}
                                <a class="editSub noSub" alt='{$httpPath}rewardManage/exportExcel.php?month={$val.month}&unitID={$val.unitID}&extraBatch={$val.extraBatch}'>下载报表</a>
                            </td>
                        {/foreach}
                    </tr>
                </tbody>
            </table>
        </form>
    </fieldset>
    </fieldset>
    <div>
        {$showWindow}
    </div>
</div>
{include file="footer.tpl"}