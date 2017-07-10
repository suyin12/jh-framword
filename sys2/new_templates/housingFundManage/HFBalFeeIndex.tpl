{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
    <script>
    $(document).ready(function(){
              $("select[name=HFDate]").change(function(){
                    $("#HFDateForm").submit();
              });
              //费用处理
                    $(".editSub").each(function(i){
                            $(this).click(function(){
                                    var thisUrl = $(this).attr("alt");
                                    tipsWindown('导入公积金缴交明细','iframe:'+thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
                            });
                    });
                       //提交
                $(".aSub").click(function(){
                    var formID = $(this).parents("form").attr("id");
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "HFSql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName+"&housingFundID="+$(this).attr("alt") ;
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
<div id="main">
    <div>
        <fieldset><legend><code>公积金平账</code></legend>
            <form id="HFDateForm" method="get">
                <span>公积金年月</span>
                <select name="HFDate">
                    <option value="">---请选择---</option>
                    {html_options options=$HFDateArr selected=$s_HFDate} 
                </select>
            </form>
            <input type="button" class="editSub" alt="{$httpPath}excelAction/readExcel.php?a=HFFeeMulInsert&HFDate={$s_HFDate}" value="①导入公积金缴交明细  ">
        </fieldset>
    </div>
    <div>
        <fieldset><legend><code>公积金缴交明细</code></legend>
            <p class="notice">提示:如果删除公积金缴交明细的话,将会一并删除未签收的平账数据</p>   
            <form id="HFFeeDetailForm">
                <input type="hidden" name="HFDate" value="{$s_HFDate}">
                <table class="myTable">
                    <tr>
                        <th>公积金帐号</th>
                        <th>公积金年月</th>
                        <th>验证状态</th>
                        <th>操作</th>
                    </tr>
                    {foreach from=$housingFundIDArr item=existsRet}
                        <tr>
                            <td>
                                {$existsRet.housingFundID}
                            </td>
                            <td>
                                {$existsRet.HFDate}
                            </td>
                            <td>
                        {if !$existsRet.uID && $existsRet.HFDate}<a href='{$HFValidUrl}' target="_blank">点击验证</a>{elseif $existsRet.HFDate}验证成功{/if}
                    </td>
                    <td>
                        <a class="noSub" href="{$httpPath}housingFundManage/HFBalFeeDetail.php?HFDate={$s_HFDate}&housingFundID={$existsRet.housingFundID}" target="_blank">查看</a>
                         <a class="aSub" alt="{$existsRet.housingFundID}" name="deleteHFFeeDetail" >删除</a>
                    </td>
                </tr>
                {foreachelse}

                    {/foreach}
                    </table>
                </form>
            </fieldset>
        </div>
        {if $existsRet}
            <div>
                <fieldset><legend><code>公积金平账表</code></legend>
                    <p class="notice">提示:下列数据,必需是进行平账,且客户经理审批确认完,数据才是准确的</p>
                    <table class="myTable">
                        <thead>
                            <tr>
                                <th rowspan="3">费用月份</th>
                                <th rowspan="3">单位名称</th>
                                <th rowspan="3">客户经理</th>
                                <th rowspan="3">参保人数</th>
                                <th rowspan="3">实缴</th>
                                <th rowspan="3">冲减挂账</th>
                                <th colspan="2">实收</th>
                                <th colspan="1">欠款</th>
                                <th colspan="1">挂账</th>
                                <th rowspan="3">均衡值</th>
                                <th rowspan="3">状态和操作</th>
                                <th rowspan="3">备注</th>
                            </tr>
                            <tr>
                                <th rowspan="2">本月</th>
                                <th rowspan="2">收回欠款</th>
                                <th rowspan="2">本月欠款</th>
                                <th rowspan="2">本月挂账</th>
<!--                                <th rowspan="2">上月累计挂账</th>
                                <th rowspan="2">挂账总累计</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            {foreach item=manager from=$unitManager }
                                {foreach item=unit key=key   from=$manager}
                                    {if $key eq 'unit'}
                                        {foreach item=unitList from=$unit}
                                            {assign var="out" value=0}
                                            {assign var="in" value=0}
                                            {assign var="write" value=0}
                                            {assign var="re" value=0}
                                            {assign var="gua" value=0}
                                            {assign var="qian" value=0}
                                                <tr>
                                                    <td>
                                                        {$feeUnitRet[$unitList.unitID].month}
                                                    </td>
                                                    <td>
                                                        {$unitList.unitName|replace:"深圳市":""}
                                                    </td>
                                                    <td>
                                                        {$manager.mName}
                                                    </td>
                                                    <td>{$HF[$unitList.unitID].num}</td>
                                                    <td>
                                                     {assign var="out" value=round(($HF[$unitList.unitID].uTotal+$HF[$unitList.unitID].pTotal),2)}
                                                    {$out}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].4}
                                                            {assign var="writeDown" value=round(($pMR[$unitList.unitID].4.uHF+$pMR[$unitList.unitID].4.pHF),2)}
                                                            {$writeDown}
                                                        {/if}
                                                    </td>
                                                    <td>
                                                        {assign var="in" value=round(($feeUnitRet[$unitList.unitID].uTotal+$feeUnitRet[$unitList.unitID].pTotal+$pMRTmp[$unitList.unitID].1.uHF+$pMRTmp[$unitList.unitID].1.pHF+$pMRTmp[$unitList.unitID].2.uHF+$pMRTmp[$unitList.unitID].2.pHF),2)}
                                                        {$in}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].3}
                                                        {assign var="re" value=round(($pMR[$unitList.unitID].3.uHF+$pMR[$unitList.unitID].3.pHF),2)}
                                                        {$re}
                                                        {/if}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].2}
                                                            {assign var="qian" value=round(($pMR[$unitList.unitID].2.uHF+$pMR[$unitList.unitID].2.pHF),2)}
                                                            {$qian}
                                                        {/if}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].1}
                                                        {assign var="gua" value=round(($pMR[$unitList.unitID].1.uHF+$pMR[$unitList.unitID].1.pHF),2)}
                                                        {$gua}
                                                        {/if}
                                                    </td>
<!--                                                    <td>
                                                        {if $uAR[$unitList.unitID]}
														 {if $pMR[$unitList.unitID].1}
                                                            {math equation="x+y-w-v" w=$pMR[$unitList.unitID].1.uHF  v=$pMR[$unitList.unitID].1.pHF x=$uAR[$unitList.unitID].uHF  y=$uAR[$unitList.unitID].pHF  }
                                                        {else}
														      {math equation="x+y" x=$uAR[$unitList.unitID].uHF  y=$uAR[$unitList.unitID].pHF }
														{/if}
													   {/if}
                                                    </td>
                                                    <td>
                                                        {if $uAR[$unitList.unitID]}
                                                            {math equation="x+y" x=$uAR[$unitList.unitID].uHF  y=$uAR[$unitList.unitID].pHF  }
                                                        {/if}
                                                    </td>-->
                                                    <td>
                                                        {if round(($in+$write-$out-$gua-$qian),2)!=0}
                                                            <span class="red">{round(($in+$write-$out-$gua-$qian),2)}</span>
                                                        {/if}
                                                    </td>
                                                    <td>
                                                        <!--当平账递交审核之后,即可完成平账,也就是说,这里还要有一步,递交本月平账数据-->                                                     
                                                    {if array_key_exists($unitList.unitID,$feeUnitRet)}
                                           		    {if !$balDetailRet[$unitList.unitID]}
                                                       <a href="{$httpPath}housingFundManage/HFBalFee.php?unitID={$unitList.unitID}&HFDate={$smarty.get.HFDate}&month={$feeUnitRet[$unitList.unitID].month}">进行平账</a>
                                         			    {else}
		                                            		 {if $balDetailRet[$unitList.unitID].status eq '99'  || $balDetailRet[$unitList.unitID].status eq 0}
		                                                        <a href="{$httpPath}housingFundManage/HFBalFee.php?unitID={$unitList.unitID}&HFDate={$smarty.get.HFDate}&month={$feeUnitRet[$unitList.unitID].month}"><span class="red">{$balStatusArr[$balDetailRet[$unitList.unitID].status]}</span></a>
		                                                    {else}
		                                                            <a href="{$httpPath}housingFundManage/HFBalFee.php?unitID={$unitList.unitID}&HFDate={$smarty.get.HFDate}&month={$feeUnitRet[$unitList.unitID].month}&query=detail">{$balStatusArr[$balDetailRet[$unitList.unitID].status]}</a>
		                                        			    {/if}
                                           				  {/if}
                                                    {else}
					  									   本月费用表未通过审核
                                                    {/if}
                                                    </td>
                                                    <td>
                                                    </td>
                                                </tr>

                                        {/foreach}
                                    {/if}
                                {/foreach}
                            {/foreach}
                        </tbody>
                    </table>
                        </fieldset>
            </div>
        {/if}
    </div>
    {include file="footer.tpl"}