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
              $("select[name=comInsDate]").change(function(){
                    $("#comInsDateForm").submit();
              });
            });
    </script>
{/literal}
<div id="main">
    <div>
        <fieldset><legend><code>商保平账</code></legend>
            <form id="comInsDateForm" method="get">
                <span>商保年月</span>
                <select name="comInsDate">
                    <option value="">---请选择---</option>
                    {html_options options=$comInsDateArr selected=$s_comInsDate} 
                </select>
            </form>
        </fieldset>
    </div>  
        {if $existsRet}
            <div>
                <fieldset><legend><code>商保平账表</code></legend>
                    <p class="notice">提示:下列数据,必需是进行平账,且客户经理审批确认完,数据才是准确的</p>
                    <table class="myTable">
                        <thead>
                            <tr>
                                <th rowspan="3">费用月份</th>
                                <th rowspan="3">单位名称</th>
                                <th rowspan="3">客户经理</th>
                                <th rowspan="3">参保人数</th>
                                <th rowspan="3">应收</th>
                                <th rowspan="3">冲减挂账</th>
                                <th colspan="2">实收</th>
                                <th colspan="1">欠款</th>
                                <th colspan="3">挂账</th>
                                <th rowspan="3">均衡值</th>
                                <th rowspan="3">状态和操作</th>
                            </tr>
                            <tr>
                                <th rowspan="2">本月</th>
                                <th rowspan="2">收回欠款</th>
                                <th rowspan="2">本月欠款</th>
                                <th rowspan="2">实缴</th>
                                <th rowspan="2">实际挂账</th>
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
                                                    <td>{$comSRet[$unitList.unitID].num}</td>
                                                    <td>
                                                        {assign var="out" value=round(($comSRet[$unitList.unitID].uTotal+$comSRet[$unitList.unitID].pTotal),2)}
                                                        {$out}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].4}
                                                       {assign var="writeDown" value=round(($pMR[$unitList.unitID].4.uComIns+$pMR[$unitList.unitID].4.pComIns),2)}
                                                            {$writeDown}
                                                        {/if}
                                                    </td>
                                                    <td>
                                                        {assign var="in" value=round(($feeUnitRet[$unitList.unitID].uTotal+$feeUnitRet[$unitList.unitID].pTotal+$pMRTmp[$unitList.unitID].1.uComIns+$pMRTmp[$unitList.unitID].1.pComIns+$pMRTmp[$unitList.unitID].2.uComIns+$pMRTmp[$unitList.unitID].2.pComIns),2)}
                                                        {$in}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].3}
                                                            {assign var="re" value=round(($pMR[$unitList.unitID].3.uComIns+$pMR[$unitList.unitID].3.pComIns),2)}
                                                            {$re}
                                                        {/if}
                                                    </td>
                                          
                                                    <td>
                                                        {if $pMR[$unitList.unitID].2}
                                                            {assign var="qian" value=round(($pMR[$unitList.unitID].2.uComIns+$pMR[$unitList.unitID].2.pComIns),2)}
                                                            {$qian}
                                                        {/if}
                                                    </td>
                                                    <td>
                                                     {$comRRet[$unitList.unitID].comInsR}
                                                    </td>
                                                    <td>
                                             	  {if (($feeUnitRet[$unitList.unitID].uTotal+$feeUnitRet[$unitList.unitID].pTotal+$pMRTmp[$unitList.unitID].1.uComIns+$pMRTmp[$unitList.unitID].1.pComIns+$pMRTmp[$unitList.unitID].2.uComIns+$pMRTmp[$unitList.unitID].2.pComIns-$comRRet[$unitList.unitID].comInsR)>0)}
                                                  {$feeUnitRet[$unitList.unitID].uTotal+$feeUnitRet[$unitList.unitID].pTotal+$pMRTmp[$unitList.unitID].1.uComIns+$pMRTmp[$unitList.unitID].1.pComIns+$pMRTmp[$unitList.unitID].2.uComIns+$pMRTmp[$unitList.unitID].2.pComIns-$comRRet[$unitList.unitID].comInsR}
                                                  {/if}
                                                    </td>
                                                    <td>
                                                        {if $pMR[$unitList.unitID].1}
                                                            {assign var="gua" value=round(($pMR[$unitList.unitID].1.uComIns+$pMR[$unitList.unitID].1.pComIns),2)}
                                                            {$gua}
                                                        {/if}
                                                    </td>
<!--                                                    <td>
                                                        {if $uAR[$unitList.unitID]}
														 {if $pMR[$unitList.unitID].1}
                                                            {math equation="x+y-w-v" w=$pMR[$unitList.unitID].1.uComIns  v=$pMR[$unitList.unitID].1.pComIns x=$uAR[$unitList.unitID].uComIns  y=$uAR[$unitList.unitID].pComIns  }
                                                        {else}
														      {math equation="x+y" x=$uAR[$unitList.unitID].uComIns  y=$uAR[$unitList.unitID].pComIns }
														{/if}
													   {/if}
                                                    </td>
                                                    <td>
                                                        {if $uAR[$unitList.unitID]}
                                                            {math equation="x+y" x=$uAR[$unitList.unitID].uComIns  y=$uAR[$unitList.unitID].pComIns  }
                                                        {/if}
                                                    </td>-->

                                                    <td>
                                                        {if round(($in+$write-$out-$gua-$qian),2)!=0}
                                                            <span class="red">{round(($in+$write-$out-$gua-$qian),2)}</span>
                                                        {/if}
                                                    </td>
                                                        <!--当平账递交审核之后,即可完成平账,也就是说,这里还要有一步,递交本月平账数据-->
                                                   <td>
                                                   {if array_key_exists($unitList.unitID,$feeUnitRet)}
                                           		    {if !$balDetailRet[$unitList.unitID]}
                                                       <a href="{$httpPath}comInsManage/comInsBalFeeDetail.php?unitID={$unitList.unitID}&comInsDate={$smarty.get.comInsDate}&month={$feeUnitRet[$unitList.unitID].month}">进行平账</a>
                                         			    {else}
		                                            		 {if $balDetailRet[$unitList.unitID].status eq '99'  || $balDetailRet[$unitList.unitID].status eq 0}
		                                                        <a href="{$httpPath}comInsManage/comInsBalFeeDetail.php?unitID={$unitList.unitID}&comInsDate={$smarty.get.comInsDate}&month={$feeUnitRet[$unitList.unitID].month}"><span class="red">{$balStatusArr[$balDetailRet[$unitList.unitID].status]}</span></a>
		                                                    {else}
		                                                            <a href="{$httpPath}comInsManage/comInsBalFeeDetail.php?unitID={$unitList.unitID}&comInsDate={$smarty.get.comInsDate}&month={$feeUnitRet[$unitList.unitID].month}&query=detail">{$balStatusArr[$balDetailRet[$unitList.unitID].status]}</a>
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