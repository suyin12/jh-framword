{include file="header.tpl"}
<script type="text/javascript"
        src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="mainBody">
    <fieldset><legend><code>公积金申报表批次明细</code></legend>
<P class="info">申报日期:{$HFModifyDate}</p>
<p class="success"><img src="{$httpPath}/css/images/information.png"> 公积金 [ <span class="error"> 设立</span>  ] 人员名单</p>
<form name="listForm">
<table class="myTable">
	<thead>
		<tr style="text-align: center;">
			<th>序号</th>
			<th>公积金账户</th>
			<th>单位</th>
			<th>姓名</th>
			<th>证件类型</th>
			<th>身份证</th>
			<th>电脑号</th>
			<th>最高学历</th>
			<th>职称</th>
			<th>启用年月</th>
			<th>户籍</th>
			<th>基数</th>
			<th>移动电话</th>
			<th>婚姻状况</th>
			<th>配偶姓名</th>
			<th>配偶身份证</th>
			<th>状态</th>
            <th>备注</th>
			<th>提交人</th>
            <!--<th>签收人</th>
			<th>签收日期</th>-->

		</tr>
	</thead>
	<tbody>
		{foreach item=val from=$inRet}
		<tr>
			<td>{$val.num}</td>
			<td>{$val.housingFundID}</td>
			<td>{$val.unitName}</td>
			<td>{$val.name}</td>
			<td>{$val.IDType}</td>
			<td>{$val.pID}</td>
			<td>{$val.sID}</td>
			<td>{$val.education}</td>
			<td>{$val.proTitle}</td>
			<td>{$val.HFModifyDate}</td>
			<td>{$val.domicile}</td>
			<td>{$val.HFRadix}</td>
			<td>{$val.mobilePhone}</td>
			<td>{$val.marriage}</td>
			<td>{$val.spouseName}</td>
			<td>{$val.spousePID}</td>
			<td>{$val.housingFundStatus}</td>
            <td>{$val.remarks}</td>
			<td>{$val.sponsorName}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="19">无查询结果</td>
		</tr>
		{/foreach}
	</tbody>
</table>

    <p class="success"><img src="{$httpPath}/css/images/information.png"> 公积金 [ <span class="error"> 封存</span>  ] 人员名单</p>
<table class="myTable">
	<thead>
		<tr>
		<th>序号</th>
		<th>公积金账户</th>
		<th>单位</th>
		<th>姓名</th>
        <th>身份证</th>
		<th>公积金号</th>
		<th>状态</th>
		<th>员工编号</th>
		<th>客户经理</th>
		<th>签收人</th>
		<th>签收日期</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=val from=$outRet}
		<tr>
			<td>{$val.num}</td>
			<td>{$val.housingFundID}</td>
			<td>{$val.unitName}</td>
			<td>{$val.name}</td>
                                                                  <td>{$val.pID}</td>
			<td>{$val.HFID}</td>
			<td>{$val.housingFundStatus}</td>
			<td>{$val.uID}</td>
			<td>{$val.sponsorName}</td>
			<td>{$val.receiverName}</td>
			<td>{$val.receiveTime}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="9">无查询结果</td>
		</tr>
		{/foreach}
	</tbody>
	</table>
</form>
<form method="post"><input type="submit" name="intoExcel"
	value="保存为EXCEL"></form>
            
      </fieldset>      
</div>
{include file="footer.tpl"}