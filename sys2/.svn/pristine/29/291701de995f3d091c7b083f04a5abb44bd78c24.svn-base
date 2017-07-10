{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js></script>
{literal}
<script>
	$(document).ready(function(){
	$(".editTd").editable("soSql.php",{
			type:"text",
			submit:"确定",
			width:"10",
			submitdata:function(){
				var field=$(this).attr("title");
				return {field:field,btn:"editSoInsRemarks"};
			},
			event:"click",
			onblur: "cancel",
			placeholder:"",
			ajaxoptions:{dataType:"json"}
		});
	
	});
</script>
{/literal}
<div id="main">
      <fieldset><legend><code>社保申报表批次明细: </code></legend>

<P class="info">批次号:{$ret.0.batch} 申报日期:{$ret.0.soInsModifyDate}</p>
<form name="listForm">
		    <table class="myTable" width="100%">
		    <thead>
		    <tr >
			<th>转保账户</th>
			<th>标示</th>
		    <th>序号</th>
			<th>单位</th>
			<th>姓名</th>
			<th>身份证</th>
			<th>电脑号</th>
			<th>户籍</th>
			<th>基数</th>
			<th>养老</th>
			<th>医疗</th>
			<th>工伤</th>
			<th>失业</th>
			<th>状态</th>
            <th>备注</th>
			<th>客户经理</th>
			<th>签收人</th>
			<th>签收日期</th>
		</tr>
	</thead>
	<tbody>
		{foreach item=val from=$ret}
		<tr>
	     <td class="editTd" title="soInsID|{$val.uID}"></td>
	     <td class="editTd" title="spRemarks|{$val.uID}">{$val.spRemarks}</td>
		<td>{$val.num}</td>
			<td>{$val.unitName}</td>
			<td>{$val.name}</td>
			<td>{$val.pID}</td>
			<td>{$val.sID}</td>
			<td>{$val.domicile}</td>
			<td>{$val.radix}</td>
			<td>{$val.pension}</td>
			<td>{$val.hospitalization}</td>
			<td>{$val.employmentInjury}</td>
			<td>{$val.unemployment}</td>
			<td>{$val.soInsStatus}</td>
            <td>{$val.remarks}</td>
			<td>{$val.sponsorName}</td>
			<td>{$val.receiverName}</td>
			<td>{$val.receiveTime}</td>
		</tr>
		{foreachelse}
		<tr>
			<td colspan="14">无查询结果</td>
		</tr>
		{/foreach}
	</tbody>
</table>
</form>
 <form method="post">
     <input type="submit" name="intoExcel" value="保存为EXCEL">
 </form>
</fieldset>
</div>
{include file="footer.tpl"}
