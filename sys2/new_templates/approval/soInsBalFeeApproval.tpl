{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>

<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>
{literal}
    <script>
	
            $(document).ready(function(){
                $(".editTd").editable("../salaryManage/salarySql.php", {
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
                    u = "../salaryManage/salarySql.php";
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
            });
    </script>
{/literal}
<div id="mainBody">
    <fieldset>
        <legend><code>本月欠/挂/冲减明细</code></legend>     
        <p class="notice">提示,单击金额进行修改</p>
        <table class="myTable" id="editTable" width="100%">
            <form class="selForm" method="post">
                <input type="hidden" name="selPost" value="1" />
                <thead>
                    <tr>
                        <th rowspan=2>姓名</th>
                        <th rowspan=2>残障金</th>
                        <th colspan=2>社保</th>
                        <th rowspan=2>
                            <select class="selPost" name=managementCostMoneySel>
                                <option value="">管理费</option>
                                {html_options values= $managementCostMoneyArr  output=$managementCostMoneyArr 	selected=$s_managementCostMoneySel}
                            </select>
                        </th>
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
                        <th>单位</th>
                        <th>个人</th>
                    </tr>
                </thead>
            </form>
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
                                <td class="editTd" title="{$k|cat:'|'|cat:$list.uID|cat:'|'|cat:$list.type}">
                                {if $v!=0}{$v}{/if}
                            </td>
                        {/if} 
                    {/foreach} 

                    <td>
                        {if $list.type eq '1'} 
                            <a class="noSub" href="{$httpPath|cat:'salaryManage/'|cat:'editAccountTheir.php?'|cat:$smarty.server.QUERY_STRING|cat:'&roleB='|cat:$list.uID}"> 调账</a>
                        {/if} 
                        {if $eAR[$list.uID] }  
                            <a class="noSub" href="{$httpPath|cat:'salaryManage/'|cat:'editAccountTheir.php?'|cat:$smarty.server.QUERY_STRING|cat:'&roleB='|cat:$list.uID}"> 查看调账</a>
                        {/if}
                        </td>
                </tr>
            {/foreach}
            </tbody>
            <tfoot>
            {foreach from=$totalMoneyArr item=tMV key=tMK}
                <tr>
                    <td >{$type.$tMK}合计:</td>
                    {foreach from=$tMV item=tV}

                        <td>{if $tV != 0}{$tV}{/if}</td>
                    {/foreach}
                    <td></td>
                    <td></td>
                </tr>
            {/foreach}
            </tfoot>
</table>
<a class="noSub" href="{$httpPath}salaryManage/editAccountCompany.php?{$smarty.server.QUERY_STRING}">公司挂账</a>
<a class="noSub" href="{$httpPath}salaryManage/editWriteDownMoney.php?{$smarty.server.QUERY_STRING}">冲减挂账</a>
</fieldset>
<div>
    {$showWindow}
</div>
</div>
{include file="footer.tpl"}