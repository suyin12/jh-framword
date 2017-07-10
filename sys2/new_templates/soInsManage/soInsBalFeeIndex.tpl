{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
    <script>
    $(document).ready(function(){
              $("select[name=soInsDate]").change(function(){
                    $("#soInsDateForm").submit();
              });
              //费用处理
                    $(".editSub").each(function(i){
                            $(this).click(function(){
                                    var thisUrl = $(this).attr("alt");
                                    tipsWindown('导入社保缴交明细','iframe:'+thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
                            });
                    });
                       //提交
                $(".aSub").click(function(){
                    var formID = $(this).parents("form").attr("id");
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "soSql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName+"&soInsID="+$(this).attr("alt") ;
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
        <fieldset><legend><code>社保平账</code></legend>
          
        <form id="soInsDateForm" method="get">
              <span>社保年月</span>
            <select name="soInsDate">
                <option value="">---请选择---</option>
                {html_options options=$soInsDateArr selected=$s_soInsDate} 
            </select>
        </form>
            <input type="button" class="editSub" alt="{$httpPath}excelAction/readExcel.php?a=soInsFeeMulInsert&soInsDate={$s_soInsDate}" value="①导入缴交明细 ">
            <input type="button" class="editSub"  alt="{$httpPath}excelAction/readExcel.php?a=soInsFeeCooMulInsert&soInsDate={$s_soInsDate}" value="②导入合作医疗明细 ">
             </fieldset>
            </div>
            <div>
                <fieldset><legend><code>社保缴交明细</code></legend>
            <p class="notice">提示:如果删除社保缴交明细的话,将会一并删除未签收的平账数据</p>
        <form id="soInsFeeDetailForm">
            <input type="hidden" name="soInsDate" value="{$s_soInsDate}">
            <table class="myTable">
                <tr>
                    <th>社保帐号</th>
                    <th>社保年月</th>
                    <th>验证状态</th>
                    <th>操作</th>
                </tr>
                {foreach from=$soInsIDArr item=existsRet}
                    <tr>
                        <td>
                            {$existsRet.soInsID}
                        </td>
                        <td>
                            {$existsRet.soInsDate}
                        </td>
                        <td>
                    {if !$existsRet.uID && $existsRet.soInsDate}<a href='{$soInsValidUrl}' target="_blank">点击验证</a>{elseif $existsRet.soInsDate}验证成功{/if}
                </td>
                <td>
                    <a class="noSub" href="{$httpPath}soInsManage/soInsFeeDetail.php?soInsDate={$s_soInsDate}&soInsID={$existsRet.soInsID}" target="_blank">查看</a>
					<a class="aSub" alt="{$existsRet.soInsID}" name="deleteSoInsFeeDetail" >删除</a>
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
                <fieldset><legend><code>社保平账表</code></legend>
                <p class="notice">提示:下列数据,必需是进行平账,且客户经理审批确认完,数据才是准确的(但是,兼职工伤的人员平账可能会出错,需人工处理)</p>
                <table class="myTable">
                    <thead>
                        <tr>
                            <th rowspan="3">费用月份</th>
                            <th rowspan="3">单位名称</th>
                            <th rowspan="3">客户经理</th>
                            <th rowspan="3">参保人数</th>
                            <th rowspan="3">实缴</th>
                            <th rowspan="3">冲减挂账</th>
                            <th colspan="3">实收</th>
                            <th colspan="1">欠款(残障金)</th>
                            <th colspan="1">挂账<br>(不包括残障金)</th>
                            <th rowspan="3">均衡值</th>
                            <th rowspan="3">状态和操作</th>
                        </tr>
                        <tr>
                            <th rowspan="2">本月</th>
                            <th rowspan="2">残障金</th>
                            <th rowspan="2">收回欠款</th>
                            <th rowspan="2">本月欠款</th>
                            <th rowspan="2">本月挂账</th>
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
                                    {assign var="PDIns" value=0}
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
                                                <td>{$soIns[$unitList.unitID].num}</td>
                                                <td>
                                                    {assign var="out" value=round(($soIns[$unitList.unitID].uTotal+$soIns[$unitList.unitID].pTotal),2)}
                                                    {$out}
                                                </td>
                                                <td>
                                                    {if $pMR[$unitList.unitID].4}
                                                    {assign var="writeDown" value=round(($pMR[$unitList.unitID].4.uSoIns+$pMR[$unitList.unitID].4.pSoIns+$pMR[$unitList.unitID].4.uPDIns),2)}
                                                    {$writeDown}
                                                    {/if}
                                                </td>
                                                <td>
                                                   {assign var="in" value=round(($feeUnitRet[$unitList.unitID].uTotal+$feeUnitRet[$unitList.unitID].pTotal+$pMRTmp[$unitList.unitID].1.uSoIns+$pMRTmp[$unitList.unitID].1.pSoIns+$pMRTmp[$unitList.unitID].1.uPDIns+$pMRTmp[$unitList.unitID].2.uSoIns+$pMRTmp[$unitList.unitID].2.pSoIns),2)}
                                                   {$in}
                                                </td>
                                                <td>
                                                    {assign var="PDIns" value=round(($feeUnitRet[$unitList.unitID].uPDIns+$pMR[$unitList.unitID].3.uPDIns),2)}
                                                    {$PDIns}
                                                </td>
                                                <td>
                                                    {if $pMR[$unitList.unitID].3}
                                                        {assign var="re" value=round(($pMR[$unitList.unitID].3.uSoIns+$pMR[$unitList.unitID].3.pSoIns),2)}
                                                        {$re}
                                                    {/if}
                                                </td>
                                                <td>
                                                    {if $pMR[$unitList.unitID].2}
                                                        {assign var="qian" value=round(($pMR[$unitList.unitID].2.uSoIns+$pMR[$unitList.unitID].2.pSoIns),2)}
                                                        {$qian}
                                                    {/if}
                                                </td>
                                                <td>
                                                    {if $pMR[$unitList.unitID].1}
                                                        {assign var="gua" value=round(($pMR[$unitList.unitID].1.uSoIns+$pMR[$unitList.unitID].1.pSoIns),2)}
                                                        {$gua}
                                                    {/if}
                                                </td>                                            
                                                <td>
                                                    {if round(($in+$write-$out-$gua-$qian),2)!=0}
                                                      <span class="red">{round(($in+$write-$out-$gua-$qian),2)}</span>
                                                    {/if}
                                                </td>
                                                <td>
                                                    <!--当平账递交审核之后,即可完成平账,也就是说,这里还要有一步,递交本月平账数据-->
                                                    {if array_key_exists($unitList.unitID,$feeUnitRet)}
                                           		    {if !$balDetailRet[$unitList.unitID]}
                                                       <a href="{$httpPath}soInsManage/soInsBalFee.php?unitID={$unitList.unitID}&soInsDate={$smarty.get.soInsDate}&month={$feeUnitRet[$unitList.unitID].month}">进行平账</a>
                                         			    {else}
		                                            		 {if $balDetailRet[$unitList.unitID].status eq '99' || $balDetailRet[$unitList.unitID].status eq 0}
		                                                        <a href="{$httpPath}soInsManage/soInsBalFee.php?unitID={$unitList.unitID}&soInsDate={$smarty.get.soInsDate}&month={$feeUnitRet[$unitList.unitID].month}"><span class="red">{$balStatusArr[$balDetailRet[$unitList.unitID].status]}</span></a>
		                                                    {else}
		                                                            <a href="{$httpPath}soInsManage/soInsBalFee.php?unitID={$unitList.unitID}&soInsDate={$smarty.get.soInsDate}&month={$feeUnitRet[$unitList.unitID].month}&query=detail">{$balStatusArr[$balDetailRet[$unitList.unitID].status]}</a>
		                                        			    {/if}
                                           				  {/if}
                                                    {else}
					  									   本月费用表未通过审核
                                                    {/if}
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