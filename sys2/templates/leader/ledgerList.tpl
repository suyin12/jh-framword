{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
<script type="text/javascript" src="{$httpPath}lib/js/tablejq.min.js"></script>
{literal}
<script type="text/javascript">
    $(document).ready(function(){
        FixTable('MyTable',1,1187,500);
        $("select[name=month]").change(function(){
            $("#monthForm").submit();
        });
    });
</script>
{/literal}
<div id="main">
    <form method="get" id="monthForm">
    <strong>&nbsp;&nbsp;&nbsp;&nbsp;选择台账年月：</strong>
        <select name="month">
            {html_options options=$Ret_month_arr selected=$smarty.get.month}
        </select>
    </form>
	<fieldset>
        <legend><code>本月未完成台账的单位</code></legend>
    <table class="myTable">
        <tr>
        {foreach from=$u_info_arr key=key item =val name=foo}
            {if $smarty.foreach.foo.iteration % 6 == 0}
            <td>{$val['unitName']}</td></tr><tr>
            {else}
            <td>{$val['unitName']}</td>
            {/if}
        {/foreach}
        </tr>
    </table>
	</fieldset>
	<fieldset>
	<legend><code>本月已完成的台账清单</code></legend>
		<table id="MyTable" class="myTable">
            <thead>
            <tr><th rowspan='3'>单位</th><th rowspan='3'>在职人数</th><th colspan='2'>应到金额</th><th colspan='6'>收入</th><th colspan='2'>支出</th><th colspan='6'>欠款</th><th rowspan='3'>备注</th></tr>
            <tr><th>实际到账</th><th rowspan='2'>冲减挂账</th><th rowspan="2">应发工资</th><th colspan='2'>管理费</th><th>保险</th><th rowspan="2">挂账</th><th rowspan='2'>收入合计</th><th rowspan='2'>实发工资</th><th rowspan='2'>个税</th><th colspan='5'>本月欠款</th><th rowspan='2'>累计欠款合计</th></tr>
            <tr><th>金额</th><th>人数</th><th>金额</th><th>残障金</th><th>累计社保欠款</th><th>累计公积金欠款</th><th>累计商保欠款</th><th>管理费累计欠款</th><th>累计工资欠款</th></tr>
            </thead>
			<tbody>
				{foreach from=$fVal key=key item =val}
                <tr>
                	<td>{$val['unitID']}</td>
                	<td>{$val['num']}</td>
                	<td>{$val['totalFeeR']}</td>
                	<td>{$val['WDMoney']}</td>
                	<td>{$val['salaryS']}</td>
                	<td>{$val['mCostNum']}</td>
                	<td>{$val['managementCost']}</td>
                	<td>{$val['uPDInsS']}</td>
                	<td>{$val['uAccountSp']}</td>
                	<td>{$val['totalFeeR']}</td>
                	<td>{$val['salaryR']}</td>
                	<td>{$val['pTax']}</td>
                    <td>{$val['soInsMoneySum']}</td>
                    <td>{$val['HFMoneySum']}</td>
                    <td>{$val['comInsMoneySum']}</td>
                    <td>{$val['mCostMoneySum']}</td>
                    <td>{$val['salaryMoneySum']}</td>
                    <td>{$val['sumMoney']}</td>
                    <td>{$val['remarks']}</td>
                </tr>
                {/foreach}
                <tr>
                {foreach from=$total key=key item=val}
                <td>{$val}</td>
                {/foreach}
                </tr>
			</tbody>
		</table>
        <form method="post">
            <div class="tt">
                <div class="right">
                    <input type="submit"  name="intoExcel"  value="保存为EXCEL"/>
                </div>
            </div>
        </form>
	</fieldset>
</div>
{include file="footer.tpl"}