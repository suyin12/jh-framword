{include file="header.tpl"}
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="screen"	href="../css/51main.css" />
<link rel="stylesheet" type="text/css" media="screen"	href="../css/jqModal.css" />
<link rel="stylesheet" type="text/css" media="screen"	href="../css/jqModal.litejava8.css" />

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/51jquery.js"></script> 
<script type="text/javascript" src="../js/jqModal.js"></script> 
<script	type="text/javascript" src="../js/jqModal.litejva8.js"></script>
<div id="main">
<fieldset>
<fieldset>
<legend>
<code>导入费用明细表:</code>
</legend>
<div id="list">
 <ul>
	<li><a class="thickbox" title="导入前程无忧资金往来备忘录"
		href="{$url}?table={$tableline[0]}">
	①:导入前程无忧资金往来备忘录</a></li>
	<li><a class="thickbox" title="导入社保费用明细表"
		href="{$url}?table={$tableline[1]}">
	②:导入社保费用明细表</a></li>
	<li><a class="thickbox" title="导入社保补缴明细表"
		href="{$url}?table={$tableline[2]}">
	③:导入社保补缴明细表</a></li>
	<!--
	<li><a class="thickbox" title="导入当月正常在册人员名单"
		href="{$url}?table={$tableline[3]}%">
	④:导入当月正常在册人员名单</a></li>-->
	<li><a class="thickbox" title="导入农民工合作医疗缴交明细"
		href="{$url}?table={$tableline[4]}">
	④:导入农民工合作医疗缴交明细</a></li>
	<li><a class="thickbox" title="导入银行缴存明细"
		href="{$url}?table={$tableline[5]}">
	⑤:导入住房公积金缴存明细</a></li>
</ul>
 </div>
 </fieldset>

<fieldset>
<legend>
 <code>管理/删除各月份数据:</code>
</legend>
<div id="tab">
<form name="manageForm" action="">
<table class="myTable" width="60%">
	<tr>
		<th>全选<br />
		<input type="checkbox" class="checkAll" value="so_bal_2"></th>
		<th>选择要删除的的数据表:</th>
		<th></th>
	</tr>
	<tbody >
		<tr>
			<td><input type="checkbox" name="checkName[]" value="so_bal_2"></td>
			<td>社保缴交明细表</td>
			<td></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="checkName[]" value="so_bal_5"></td>
			<td>社保补缴明细表</td>
			<td></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="checkName[]" value="so_bal_2_tmp"></td>
			<td>农民工合作医疗缴交明细</td>
			<td></td>
		</tr>
		<tr>
			<td><input type="checkbox" name="checkName[]" value="so_bal_3"></td>
			<td>前程无忧资金往来备忘录</td>
			<td></td>
		</tr>
		<!--
		<tr>
			<td><input type="checkbox" name="checkName[]" value="so_bal_4"></td>
			<td>正常在册名单</td>
			<td></td>
		</tr>
		-->
         <tr>
			<td><input type="checkbox" name="checkName[]" value="so_bal_6"></td>
			<td>银行缴存明细</td>
			<td></td>
		</tr>
		<tr>
			<td>年月</td>
			<td><input type="text" name="delMonth" value="<输入格式,如'200901'>" /></td>
			<td><input type="button" class="delBtn" value="删除" /></td>
		</tr>
	</tbody>
</table>
</form>
</div>
</fieldset>
<fieldset>
<legend>
<code>选择要操作的月份数据</code>
</legend>
<div>
<select class="month"  name="month">
<option value="" selected>--请选择--</option>
  {html_options options=$ymonth }
  
</select>
</div>
<div class="btnList2">
<ul>
    <li>
	<a name="insert" class='sub' href="#"><img src="../css/images/OA/so_ch_2.gif" /></a>
	</li>
	<li>
	<a name="distill" class='sub' href="#"><img src="../css/images/OA/so_ch_6.gif" /></a>
	</li>
	<li>
	<a name="convert" class='sub' href="#"><img src="../css/images/OA/so_ch_1.gif" /></a>
	</li>
	<li>
	<a name="merge" class='sub' href="#"><img src="../css/images/OA/so_ch_7.gif" /></a>
	</li>
</ul>
</div>
<div id="output"></div>
<div style="" id="modalWindow" class="jqmWindow jqmID1">
<div id="jqmTitle">
<button class="jqmClose">关闭 </button>
<span id="jqmTitleText"></span></div>
<iframe id="jqmContent" src=""></iframe></div>

<div><!--<input type="radio" name="radioName[]" title="balUnitDetail.php" />查看各月单位欠款/挂账概况-->
<!--<input type="radio" name="radioName[]" title="balError.php" checked="checked"/>查看各月个人欠款/挂账概况-->
</div>

<div id="errorRet"></div>
</fieldset>

</fieldset>
</div>

{include file="footer.tpl"}