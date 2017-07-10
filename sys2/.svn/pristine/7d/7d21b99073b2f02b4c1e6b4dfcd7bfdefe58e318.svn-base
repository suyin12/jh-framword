{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="main">
    <fieldset>
        <legend><code>个人欠/挂/冲减明细</code></legend>     
        <p class="notice">特别提示:因为涉及到单位整体冲减的问题,此挂账金额,不能做为挂账凭证!!</p>
        <table class="myTable" id="editTable" width="100%">
            <input type="hidden" name="selPost" value="1" />
            <thead>
                <tr>
                    <th rowspan=2>费用月份</th>
                    <th rowspan=2>批次</th>
                    <th rowspan=2>姓名</th>
                    <th rowspan=2>单位名称</th>
                    <th rowspan=2>残障金</th>
                    <th colspan=2>社保</th>
                    <th colspan=2>公积金</th>
                    <th colspan=2>商保</th>
                    <th rowspan=2>管理费</th>
                    <th rowspan=2> 单位挂账</th>
                    <th colspan=2>其他</th>
                    <th rowspan=2> 类型</th>
                    <th rowspan=2> 备注</th>
                    <th rowspan=2> 状态</th>

                </tr>
                <tr>
                    <th>单位</th>
                    <th>个人</th>
                    <th>
                        单位
                    </th>
                    <th>
                        个人
                    </th>
                    <th>
                        单位
                    </th>
                    <th>
                        个人
                    </th>
                    <th>单位</th>
                    <th>个人</th>
                </tr>
            </thead>
            <form method="post" action="" id="prsReForm">
                <tbody>
                    {foreach from=$ret item=list}
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
                                 {elseif $k eq 'status'}
                                          <td>  <span class="red">{$status.$v} </span> </td>
                                 {elseif $k eq 'unitName'}
                                     <td>{$v}</td>
                                {else}
                                    <td>
                                        {if is_numeric($v) and $v==0}
                                        {else}
                                            {$v}
                                        {/if}   
                                    </td>
                                {/if} 
                            {/foreach} 

                    </tr>
                    {foreachelse}    
                        <tr><td colspan="15">此人无欠/挂记录</td></tr>
                        {/foreach}
                <tr><td colspan="17"></td><td><a  class="noSub" href="prsMoneyModify.php?uID={$smarty.get.uID}">调账</a></td></tr>
                            </table>
                    </form>
                    </fieldset>
                     <fieldset>
        				<legend><code>工资(最多显示20条)</code></legend>
        				<table class="myTable" width="100%">
        				<thead>
        				<tr>
        				<th>单位</th>
        				<th>月份</th>
        				<th>批次</th>
        				<th>应发</th>
        				<th>实发</th>
        				<th>单位社保</th>
        				<th>个人社保</th>
        				<th>单位公积金</th>
        				<th>个人公积金</th>
        				<th>单位商保</th>
        				<th>个人商保</th>
        				<th>管理费</th>
        				<th>发放账号</th>
        				<th>明细</th>
        				</tr>
        				</thead>
        				<tbody>
        				{foreach from=$fRet item=val}
        				<tr>
        				<td>{$unit[$val.unitID].unitName}</td>
        				<td>{$val.month}</td>
        				<td>{$val.extraBatch+1}</td>
        				<td>{$val.pay}</td>
        				<td>{$val.acheive}</td>
        				<td>{$val.uSoIns}</td>
        				<td>{$val.pSoIns}</td>
        				<td>{$val.uHF}</td>
        				<td>{$val.pHF}</td>
        				<td>{$val.uComIns}</td>
        				<td>{$val.pComIns}</td>
        				<td>{$val.managementCost}</td>
        				<td>{$val.bID}</td>
        				<td>
        				<form method="post" target="_blank" action="{$httpPath}salaryManage/exportExcel.php?month={$val.month}&extraBatch={$val.extraBatch}&unitID={$val.unitID}&type=fee&output=true">
        				<input name="name" type="hidden" value="{$val.name}"/>
        				<input type="submit" name="search" value="费用明细" />
        				</form>
        				<form method="post" target="_blank" action="{$httpPath}salaryManage/exportExcel.php?month={$val.month}&extraBatch={$val.extraBatch}&unitID={$val.unitID}&type=salary&output=true">
        				<input name="name" type="hidden" value="{$val.name}"/>
        				<input type="submit" name="search" value="工资明细" />
        				</form>
        				</td>
        				</tr>
        				{/foreach}
        				</tbody>
        				</table>
        			 </fieldset>
        			 <fieldset>
        				<legend><code>奖金(最多显示20条)</code></legend>
        				<table class="myTable" width="100%">
        				<thead>
        				<tr>
        				<th>单位</th>
        				<th>月份</th>
        				<th>批次</th>
        				<th>应发</th>
        				<th>实发</th>
        				<th>发放账号</th>
        				<th>明细</th>
        				</tr>
        				</thead>
        				<tbody>
        				{foreach from=$rRet item=val}
        				<tr>
        				<td>{$unit[$val.unitID].unitName}</td>
        				<td>{$val.month}</td>
        				<td>{$val.extraBatch}</td>
        				<td>{$val.pay}</td>
        				<td>{$val.acheive}</td>
        				<td>{$val.bID}</td>
        				<td>
        				<form method="post" target="_blank" action="{$httpPath}rewardManage/exportExcel.php?month={$val.month}&extraBatch={$val.extraBatch}&unitID={$val.unitID}&type=salary&output=true">
        				<input name="name" type="hidden" value="{$val.name}"/>
        				<input type="submit" name="search" value="奖金明细" />
        				</form>
        				</td>
        				</tr>
        				{/foreach}
        				</tbody>
        				</table>
        			 </fieldset>	
        			 <fieldset>
        				<legend><code>实缴(最多显示20条)</code></legend>
        				<table class="myTable halfWidth left"  >
        				<thead>
        				<tr>
        				<th>社保账号</th>
        				<th>单位</th>
        				<th>月份</th>
        				<th>总合计</th>
        				<th>单位合计</th>
        				<th>个人合计</th>
        				<th>基数</th>
        				</tr>
        				</thead>
        				<tbody>
        				{foreach from=$soInsRet item=val}
        				<tr>
        				<td>{$val.soInsID}</td>
        				<td>{$unit[$val.unitID].unitName}</td>
        				<td>{$val.soInsDate}</td>
        				<td>{$val.total}</td>
        				<td>{$val.uTotal}</td>
        				<td>{$val.pTotal}</td>
        				<td>{$val.radix}</td>
        				</tr>
        				{/foreach}
        				</tbody>
        				</table>
        				<table class="myTable halfWidth right" >
        				<thead>
        				<tr>
        				<th>公积金账号</th>
        				<th>单位</th>
        				<th>月份</th>
        				<th>总合计</th>
        				<th>单位合计</th>
        				<th>个人合计</th>
        				<th>基数</th>
        				</tr>
        				</thead>
        				<tbody>
        				{foreach from=$HFRet item=val}
        				<tr>
        				<td>{$val.housingFundID}</td>
        				<td>{$unit[$val.unitID].unitName}</td>
        				<td>{$val.HFDate}</td>
        				<td>{$val.total}</td>
        				<td>{$val.uTotal}</td>
        				<td>{$val.pTotal}</td>
        				<td>{$val.HFRadix}</td>
        				</tr>
        				{/foreach}
        				</tbody>
        				</table>
        			 </fieldset>
                    </div>
                     </fieldset>	
                    {include file="footer.tpl"}