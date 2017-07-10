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
                $(".editTd").editable("salarySql.php", {
                    type: "text",
                    submit: "确定",
                    width: "10",
                    submitdata: function(){
                        var field = $(this).attr("title");
                        var month = getQuery('month');
                        var unitID = getQuery('unitID');
                        return {
                            month: month,
                            field: field,
                            unitID: unitID,
                            btn: "prsReBtn"
                        };
                    },
                    event: "click",
                    onblur: "cancel",
                    placeholder: "",
                    ajaxoptions: {
                        dataType: "json"
                    }
                });
	    
                //提交
                $(".aSub").click(function(){
                    var formID = $(this).parents("form").attr("id");
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "salarySql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=fee";
                             if (btnName == "delPrsReBtn") {
                                    d = "ID="+$(this).attr("alt") +"&btn=" + btnName ;
                            }
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
                                    if (btnName == "changeRadix") {
                                        var thisUrl = location.href;
                                        window.location.href = thisUrl + "&societyAvg=" + $("input[name=societyAvg]").val() + "&pComInsMoneyRadix=" + $("input[name=pComInsMoneyRadix]").val() + "&uComInsMoneyRadix=" + $("input[name=uComInsMoneyRadix]").val() + "&helpCost=" + $("input[name=helpCost]").val();
                                    }
                                    else {
                                        window.location.reload();
                                    }
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
	    
                //筛选条件的POST提交.. wInfo.php
                $(".selPost").change(function(){
                    $(".selForm").submit();
                });
                //费用处理
                $(".editSub").each(function(i){
                    $(this).click(function(){
                        var thisUrl = $(this).attr("alt");
                        tipsWindown('调整费用', 'iframe:' + thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
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
        <fieldset class="theight-1">
        <fieldset class="left halfWidth cHeight">
            <legend><code>各个系数调整</code></legend>
             <p class="notice">特别提示:在这里可以临时设置本月的商保,及互助会收取金额.(只在本月生效)</p>
            <form id="changeRaixForm">
                <input name="unitID" type="hidden" value="{$smarty.get.unitID}">
                <input name="month" type="hidden" value="{$smarty.get.month}">
                <p>当前商保基数:个人商保:
                    <input type=text name="pComInsMoneyRadix" size="5" value='{$pComInsMoneyRadix}'>
                    单位商保:
                    <input type=text name="uComInsMoneyRadix" size="5" value='{$uComInsMoneyRadix}'>
                </p>
                <p>当前互助会费:互助会收费标准
                    <input type=text name="helpCost" size="6" value='{$helpCost}'>
                </p>
                {if $originalFeeCount<= 0}
                    <input type="button" class="aSub" name="changeRadix" value="修改">
                {else}
                    <input type="button" value="无法修改,请删除费用表">
                {/if}
            </form>
        </fieldset>
             <fieldset class="right halfWidth cHeight">
            <legend><code>审批进程预览</code></legend>
            <table class="myTable" width="100%">
                <tr>
                    <th>审批名称</th>
                    <th>审批进程</th>
                    <th>操作</th>
                </tr>
                {foreach item=val key=key from=$exAppArr}
                    <tr>
                        <td>
                            {$authArr.approval[$key].typeName}
                            <input type="hidden" name="{$key}AppProID" value="{$val.appProID}" />
                        </td>
                        <td>
                            <div  id="{$key}AppPro"></div>
                        </td>
                        <td>
                            <a class="noSub" href="{$httpPath}approval/approvalIndex.php">审批</a>
                            <a class="noSub" href="{$httpPath|cat:$val.URL}">查看</a>
                        </td>
                    </tr>
                {/foreach}
            </table>
        </fieldset>
        </fieldset>
    </div>
    <fieldset >
    <fieldset class="left">
        <legend><code>未处理的原始费用表</code></legend>
        <p class="notice">特别提示:预重新制作费用表,<br>请先删除处理有的费用表,再删除未处理的原始费用表</p>
        <form id="delOriginalFeeForm" name="delOriginalFeeForm">
            <table class="myTable">
                <thead>
                    <tr>
                        <th>选择</th>
                        <th>批次</th>
                        <th>工资年月</th>
                        <th>社保年月</th>
                        <th>公积金年月</th>
                        <th>商保年月</th>
                        <th>管理费年月</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="checkbox" name="feeCheck" value='{$oret.0.month}|{$oret.0.unitID}'>
                        </td>
                        <td>首次工资费用</td>
                        <td>
                            {$oret.0.salaryDate}
                        </td>
                        <td>
                            {$oret.0.soInsDate}
                        </td>
                        <td>
                            {$oret.0.HFDate}
                        </td>
                        <td>
                            {$oret.0.comInsDate}
                        </td>

                        <td>
                            {$oret.0.managementCostDate}
                        </td>
                        <td>
                            <a href="detail.php?a=originalFee&zID={$oret.0.zID}&unitID={$oret.0.unitID}&month={$oret.0.month}">查看</a>
                            {if !$ret} 
                                | <a href="makeFee.php?unitID={$oret.0.unitID}&month={$oret.0.month}&displaySp=true&fixTable=true">制作</a>
                            {/if}
                        </td>
                    </tr>
                    {foreach from=$mulAFee item=mOV}                        
                        <tr>
                            <td>
                                <input type="checkbox" name="mulFeeCheck[]" value='{$mOV.month}|{$mOV.unitID}|{$mOV.extraBatch}'>
                            </td>
                            <td>第{$mOV.extraBatch+1}次工资费用</td>
                            <td>
                                {$mOV.salaryDate}
                            </td>
                            <td>
                                {$mOV.soInsDate}
                            </td>
                            <td>
                                {$mOV.HFDate}
                            </td>
                            <td>
                                {$mOV.comInsDate}
                            </td>

                            <td>
                                {$mOV.managementCostDate}
                            </td>
                            <td>
                                <a href="detail.php?a=mulFee&zID={$mOV.zID}&unitID={$mOV.unitID}&month={$mOV.month}&extraBatch={$mOV.extraBatch}">查看</a>
                                {if !$mulAFeeYet[$mOV.extraBatch]} 
                                    | <a href="makeFee_mul.php?unitID={$mOV.unitID}&month={$mOV.month}&extraBatch={$mOV.extraBatch}&displaySp=true&fixTable=true">制作</a>
                                {/if}
                            </td>
                        </tr>
                    {/foreach}   
                </tbody>
            </table>
                    <input type="button" class="aSub" name="delOriginalFeeBtn" value="删除">
        </form>
    </fieldset>
    <fieldset class="right halfWidth">
        <legend><code>处理后的原始费用表</code></legend>
        <form id="delFeeForm" name="delFeeForm" >
            <p class="notice">特别提示:删除处理后的费用表,将一并删除本月的社保,商保,管理费欠/挂记录,<br>但冲减记录,社保卡,居住证等相关费用,不会被删除</p>
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>选择</th>
                        <th>批次</th>
                        <th>总费用</th>
                        <th>实发工资</th>
                        <th>人数</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {if $ret.0.confirmStatus neq '1'}
                                <input type="checkbox" name="feeCheck" value='{$smarty.get.month}|{$smarty.get.unitID}'>
                            {/if}
                        </td>
                        <td>首次费用</td>
                        <td>
                            {$feeTotalPay}
                        </td>
                        <td>
                            {$acheive}
                        </td>
                        <td>
                            {$feeNum}
                        </td>
                        <td>
                            {if $feeTotalPay}
                                <a href="{$httpPath}salaryManage/exportExcel.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}&type=fee&output=true">费用表</a>
                            {else}
                                <a href="makeFee.php?unitID={$ret.0.unitID}&month={$ret.0.month}&displaySp=true&fixTable=true">费用表</a>
                            {/if}
                            {if $acheive}
                                | <a href="{$httpPath}salaryManage/exportExcel.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}&type=salary&output=true">发放表</a>
                            {else}
                                | <a href="makeSalaryFee.php?unitID={$ret.0.unitID}&month={$ret.0.month}&displaySp=true&fixTable=true">发放表</a>
                            {/if}
                                | <a class="editSub" alt='{$httpPath}salaryManage/exportExcel.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}'>下载报表</a>
                        </td>
                    </tr>
                    {foreach from=$mulAFee item=mOV  key=mOK}   
                        <tr>
                            <td>
                                <input type="checkbox" name="mulFeeCheck[]" value='{$mOV.month}|{$mOV.unitID}|{$mOV.extraBatch}'>
                            </td>
                            <td>第{$mOK+1}次费用</td>
                            <td>
                                {$mulTotalFee.fee.$mOK.totalFee}
                            </td>
                            <td>
                                {$mulTotalFee.salary.$mOK.acheive}
                            </td>
                            <td>
                                {$mulTotalFee.fee.$mOK.num}
                            </td>
                            <td>
                                {if $mulTotalFee.fee.$mOK.totalFee}
                                    <a href='{$httpPath}salaryManage/exportExcel.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}&extraBatch={$mOV.extraBatch}&type=fee&output=true'>费用表</a>
                                {else}
                                    <a href="makeFee_mul.php?unitID={$mOV.unitID}&month={$mOV.month}&extraBatch={$mOV.extraBatch}&displaySp=true&fixTable=true">费用表</a>
                                {/if}
                                {if !$mulTotalFee.salary.$mOK.acheive}
                                | <a href="makeSalaryFee_mul.php?unitID={$mOV.unitID}&month={$mOV.month}&extraBatch={$mOV.extraBatch}&displaySp=true&fixTable=true">发放表</a>
                                {else}
                                | <a href='{$httpPath}salaryManage/exportExcel.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}&extraBatch={$mOV.extraBatch}&type=salary&output=true'>发放表</a>
                                {/if}
                                |<a class="editSub" alt='{$httpPath}salaryManage/exportExcel.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}&extraBatch={$mOV.extraBatch}'>下载报表</a>
                                </td>
                        </tr>
                    {/foreach}
                       
                </tbody>
            </table>
             <input type="button" class="aSub" name="delFeeBtn" value="删除">
        </form>
    </fieldset>
     </fieldset>               
    <fieldset>
        <legend><code>本月欠/挂/冲减明细</code></legend>     
        <p class="notice">提示,单击金额进行修改</p>
        <table class="myTable" width="100%" id="editTable">
            <form class="selForm" method="post">
                <input type="hidden" name="selPost" value="1" />
                <thead>
                    <tr>
                        <th rowspan=2>姓名</th>
                        <th rowspan=2>残障金</th>
                        <th colspan=2>社保</th>
                        <th colspan=2>公积金</th>
                        <th colspan=2>商保</th>
                        <th rowspan=2>
                            <select class="selPost" name=managementCostMoneySel>
                                <option value="">管理费</option>
                                {html_options values= $managementCostMoneyArr  output=$managementCostMoneyArr 	selected=$s_managementCostMoneySel}
                            </select>
                        </th>
    <!--                    <th rowspan=2>
                            <select class="selPost" name=soInsCardMoneySel>
                                <option value="">制社保卡</option>
                        {html_options values= $soInsCardMoneyArr  output=$soInsCardMoneyArr 	selected=$s_soInsCardMoneySel}
    </select>
    </th>
    <th rowspan=2>
    <select class="selPost" name=residentCardMoneySel>
    <option value="">制居住卡</option>
                        {html_options values= $residentCardMoneyArr  output=$residentCardMoneyArr 	selected=$s_residentCardMoneySel}
    </select>
    </th>-->
                        <th rowspan=2>
                            <select class="selPost" name=uAccountSel>
                                <option value="">单位挂账</option>
                                {html_options values= $uAccountArr  output=$uAccountArr 	selected=$s_uAccountSel}
                            </select>
                            <br/>
                            (指定费用)
                        </th>
                        <th colspan=2>其他</th>
                        <th rowspan=2>
                            <select class="selPost" name=typeSel>
                                <option value="">类型</option>
                                {html_options options= $type	selected=$s_typeSel}
                            </select>
                        </th>
                        <th rowspan=2>操作</th>
                    </tr>
                    <tr>
                        <th>
                            <select class="selPost" name=uSoInsMoneySel>
                                <option value="">单位</option>
                                {html_options values= $uSoInsMoneyArr	output=$uSoInsMoneyArr	selected=$s_uSoInsMoneySel}
                            </select>
                        </th>
                        <th>
                            <select class="selPost" name=pSoInsMoneySel>
                                <option value="">个人</option>
                                {html_options values= $pSoInsMoneyArr	output=$pSoInsMoneyArr	selected=$s_pSoInsMoneySel}
                            </select>
                        </th>
                        <th>
                            <select class="selPost" name=uHFMoneySel>
                                <option value="">单位</option>
                                {html_options values= $uHFMoneyArr	output=$uHFMoneyArr	selected=$s_uHFMoneySel}
                            </select>
                        </th>
                        <th>
                            <select class="selPost" name=pHFMoneySel>
                                <option value="">个人</option>
                                {html_options values= $pHFMoneyArr	output=$pHFMoneyArr	selected=$s_pHFMoneySel}
                            </select>
                        </th>
                        <th>
                            <select class="selPost" name=uComInsMoneySel>
                                <option value="">单位</option>
                                {html_options values= $uComInsMoneyArr	output=$uComInsMoneyArr	selected=$s_uComInsMoneySel}
                            </select>
                        </th>
                        <th>
                            <select class="selPost" name=pComInsMoneySel>
                                <option value="">个人</option>
                                {html_options values= $pComInsMoneyArr	output=$pComInsMoneyArr	selected=$s_pComInsMoneySel}
                            </select>
                        </th>
                        <th>单位</th>
                        <th>个人</th>
                    </tr>
                </thead>
            </form>
            <form method="post" action="" id="prsReForm">
                <tbody>
                    {foreach from=$reRet item=list}
                        <tr>
                            {foreach from=$list key=k item=v}
                                {if $k eq 'uID' || $k eq 'ID'}
                                    {continue}
                                {elseif $k eq 'type'}
                                    <td>
                                        {$type.$v}
                                    </td>
                                {elseif $k eq 'name'}
                                    <td>
                                        <a href="{$httpPath}workerInfo/wManage.php?uID={$list.uID}" target="_blank">{$v}</a>
                                    </td>
                                {else}
                                    <td {if $smarty.get.modify eq 'true'} class="editTd" title="{$k|cat:'|'|cat:$list.uID|cat:'|'|cat:$list.type}" {/if}>
                                    {if $v!=0}{$v}{/if}
                                </td>
                            {/if} 
                        {/foreach} 

                        {if $list.type eq '1'} 
                            <td>
                                <input type=button name="editAccountTheir" class="editSub" alt="{$httpPath|cat:'salaryManage/'|cat:'editAccountTheir.php?'|cat:$smarty.server.QUERY_STRING|cat:'&roleB='|cat:$list.uID}" value="调账">
                                {if $eAR[$list.uID] }  
                                    <input type=button name="editAccountTheir" class="editSub" alt="{$httpPath|cat:'salaryManage/'|cat:'editAccountTheir.php?'|cat:$smarty.server.QUERY_STRING|cat:'&roleB='|cat:$list.uID}" value="查看调账">
                                {/if}
                                {if $smarty.get.modify eq 'true'}  
                                    <input type=button class="aSub" name="delPrsReBtn"  alt="{$list.ID}" value="删除" >
                                {/if}
                            </td>
                        {else} 
                            <td>
                            {if $smarty.get.modify eq 'true'}   <input type=button class="aSub" name="delPrsReBtn"  alt="{$list.ID}" value="删除" >{/if}
                        </td>
                    {/if} 
                </tr>
            {/foreach}
           
        </tbody>
         <tfoot>
            {foreach from=$totalMoneyArr item=tMV key=tMK}
                <tr>
                    <td class="red">{$type.$tMK}合计:</td>
                    {foreach from=$tMV item=tV}

                        <td>{if $tV != 0}{$tV}{/if}</td>
                    {/foreach}
                    <td></td>
                    <td></td>
                </tr>
            {/foreach}
            </tfoot>
           
    </form>
</table>    
<input type=button name="editAccountCompany" class="editSub" alt="{$httpPath|cat:'salaryManage/'|cat:'editAccountCompany.php?'|cat:$smarty.server.QUERY_STRING}" value="公司挂账">      
<input type=button name="editWriteDownMoney" class="editSub" alt="{$httpPath|cat:'salaryManage/'|cat:'editWriteDownMoney.php?'|cat:$smarty.server.QUERY_STRING}" value="冲减挂账">      
</fieldset>
<div>
    {$showWindow}
</div>
</div>
{include file="footer.tpl"}