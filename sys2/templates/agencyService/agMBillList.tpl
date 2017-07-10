{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=modifydate],select[name=type],select[name=payment]").change(function(){
        $("#billDateForm").submit();
  	});
	
});
function fun1($s){
	var t=$(".son"+$s+"").is(":visible");
	if(t==false){
		$.ajax({
			url:'getBillson.php',
			data:$("#billDateForm").serialize()+"&fID="+$s,
			type:'GET',
			dataType:'text',
			success:function(re){
				$("."+$s+"").after(re);
			}
		});
	}
	if(t==true){
		$(".son"+$s+"").remove();
	}
}
</script>
{/literal}
<!--
可以查看缴费信息费用等
-->
<div id="main">
	<fieldset class="theight-4">
	   <form id="billDateForm" method="get">
		  <div class="left"><strong>请选择查询条件：</strong><select name="m">{html_options options=$m selected=$smarty.get.m}</select>
		     <input type="text" name="c" value="{$smarty.get.c}"/><input type="submit" value=查询>
		  </div>
	      <div class="right">
	         <a class="noSub positive" href="agencyManage.php" >列表</a>
	         <a class="noSub positive" href="aCreateManage.php" >登记</a>
	         <a class="noSub positive" href="agMPayList.php">缴费</a>
	         <a class="noSub positive" href="agMFeelist.php">平账\入账</a>
	         <a class="noSub positive" href="agMBillList.php?modifydate={$date}">流水账记录</a>
	      	 <a class="noSub positive" href="aClearing.php" >结算</a>
	      </div>
    </fieldset>
    <div>
	    <fieldset>
		    <legend><code>结果</code></legend>
		    <table class="myTable">
				<tr>
					<th>序号</th>
					<th>姓名</th>
					<th>身份证号</th>
					<th>交易备注</th>
					<th>费用年月</th>
					<th>
						<select name="type">
						  <option value="">选择类型</option>
	           			  {html_options options=$billtype selected=$smarty.get.type}
	           		  	</select>
	           		</th>
					<th>
						<select name="payment">
						  <option value="">选择明细</option>
	           			  {html_options options=$billpayment selected=$smarty.get.payment}
	           		  	</select>
					</th>
					<th>收入(元)</th>
					<th>支出(元)</th>
					<th>余额</th>
					<th>状态</th>
					<th>操作人</th>
					<th>创建时间</th>
					<th>
						<select name="modifydate">
						  <option value="">最近三个月</option>
	           			  {html_options options=$modifydate selected=$smarty.get.modifydate}
	           		  	</select>
	           		</th>
				</tr>
				{if $smarty.get.modifydate}
				{foreach item=ba key=key from=$bill name=name}
				
				<tr class="{$ba.fID}" onclick="fun1('{$ba.fID}')">
					<td>{$smarty.foreach.name.iteration}</td>
					<td><a href="aManage.php?id={$ba.fID}">{$ba.name}</a></td>
					<td>{$ba.pID}</td>
					<td>{$ba.mess}</td>
					<td>{$ba.paydate}</td>
					<td>{$billtype[$ba.type]}</td>
					<td>{$billpayment[$ba.payment]}</td>
					<td>{if $ba.income==0}{else}+{$ba.income}{/if}</td>
					<td>{if $ba.expenditure==0}{else}-{$ba.expenditure}{/if}</td>
					<td>{if $ba.remains=='0'}{else}{$ba.remains}{/if}</td>
					<td>{$billstatus[$ba.status]}</td>
					<td>{$ba.lastModifyBy}</td>
					<td>{$ba.lastModifyTime}</td>
				</tr>
				{/foreach}
				{else}
				<tr><td colspan="12"><font color="red">无此类信息</font></td></tr>
				{/if}
			</table>
			<div class="tt">
				<div class="left">{$pageList}</div>
				<div class="right">
					<input type="checkbox" name="codeVison" value="1" >下载最新版本
					<input type="submit"  name="intoExcel"  value="保存为EXCEL"/>
				</div>
			</div>
		</fieldset>
		</form>
	</div>
</div>
{include file="footer.tpl"}