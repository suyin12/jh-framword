{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=soInsDate]").change(function(){
		$("#soInsDateForm").submit();
	});
	$("select[name=HFDate]").change(function(){
		$("#HFDateForm").submit();
	});
});
</script>
{/literal}
<div id="main">
    <div>
        <fieldset><legend><code>缴交年月</code></legend>
        <form id="soInsDateForm" method="get">
            <span>社保年月</span>
            <select name="soInsDate">
                <option value="">---请选择---</option>
                {html_options options=$cmonths selected=$cmonth} 
            </select>
        </form>
        <form id="HFDateForm" method="get">
            <span>公积金年月</span>
            <select name="HFDate">
                <option value="">---请选择---</option>
                {html_options options=$hmonths}
            </select>
        </form>
             </fieldset>
            </div>
            <div>
                <fieldset><legend><code>历史数据</code></legend>
        <form id="">
        	{if $smarty.get.HFDate}
        	 <table class="myTable">
            	<tr>
            		<th>序号</th>
            		<th>姓名</th>
            		<th>身份证号码</th>
            		<th>缴存基数</th>
            		<th>单位缴存比例</th>
            		<th>个人缴存比例</th>
            		<th>缴存额</th>
            	</tr>
            	{foreach from=$SoArr item=So name=name}
            	<tr>
            		<td>{$smarty.foreach.name.iteration}</td>
            		<td>{$So.name}</td>
            		<td>{$So.pID}</td>
            		<td>{$So.HFRadix}</td>
            		<td>{$So}</td>
            		<td>{$So}</td>
            		<td>{$So.HFTotal}</td>
            	</tr>
            	{/foreach}
            	</table>
        	{else}
            <table class="myTable">
            	<tr>
            		<th colspan="4"></th>
            		<th colspan="3">应收金额</th>
            		<th colspan="3">养老保险</th>
            		<th colspan="3">医疗保险</th>
            		<th colspan="2">工伤保险</th>
            		<th colspan="3">失业保险</th>
            		<th colspan="2">生育保险</th>
            	</tr>
                <tr>
                    <th>序号</th>
                    <th>个人编号</th>
                    <th>姓名</th>
                    <th>身份证号</th>
                    <th>应收合计</th>
                    <th>个人合计</th>
                    <th>单位合计</th>
                    <th>缴费基数</th>
                    <th>个人</th>
                    <th>单位</th>
                    <th>缴费基数</th>
                    <th>个人</th>
                    <th>单位</th>
                    <th>缴费基数</th>
                    <th>单位</th>
                    <th>缴费基数</th>
                    <th>个人</th>
                    <th>单位</th>
                    <th>缴费基数</th>
                    <th>单位</th>
                </tr>
                {foreach from=$SoArr item=So name=name}
                <tr>
                    <td>{$smarty.foreach.name.iteration}</td>
                    <td>{$So.sID}</td>
                    <td>{$So.name}</td>
	                <td>{$So.pID}</td>
	                <td>{$So.Total}</td>
                    <td>{$So.pTotal}</td>
	                <td>{$So.uTotal}</td>
	                <td>{$So.PRadix}</td>
                    <td>{$So.pPension}</td>
	                <td>{$So.uPension}</td>
	                <td>{$So.HRadix}</td>
                    <td>{$So.pHospitalization}</td>
	                <td>{$So.uHospitalization}</td>
	                <td>{$So.EIRadix}</td>
                    <td>{$So.uEmploymentInjury}</td>
	                <td>{$So.URadix}</td>
	                <td>{$So.pUnemployment}</td>
	                <td>{$So.uUnemployment}</td>
	                <td>{$So.BRadix}</td>
	                <td>{$So.uBirth}</td>
	            </tr>
                {/foreach}
                </table>
                {/if}
        </form>
         <input type="submit"  name="intoExcel"  value="保存为EXCEL"  />
               </fieldset>
        </div>      
</div>
{include file="footer.tpl"}