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
           //提交
	    $(".sub").click(function(){
	        var formID = this.form.id;
	        var btnName = $(this).attr("name")
	        var t, u, d, dt, m;
	        t = "post";
	        u = "soSql.php";
	        d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=soFee";
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
	            var ret = confirm("确定" + $(this).val() + "?");
	            if (ret == true) {
	                ajaxAction(t, u, d, dt, m);
	            }
	    });
	});
</script>
{/literal}
<div id="main">
	{if $smarty.get.query neq 'detail'}
	<form id="soInsBalFeeForm" name="soInsBalFeeForm">
	<input type="hidden" name="unitID" value="{$smarty.get.unitID}">
	<input type="hidden" name="month" value="{$smarty.get.month}">
	<input type="hidden" name="soInsDate" value="{$smarty.get.soInsDate}">
	<input type="button" class="sub" name="soBalFeeBtn" value="提交平账结果">
	<p>共<span class="red">{math equation="x+y" x=$extraSoR|@count y=$ofR|@count}</span>条记录</p>
	<table class="myTable">
		<thead>
			<tr>
				<th rowspan="2">员工编号</th>
				<th rowspan="2">姓名</th>
				<th colspan="2">实缴</th>
				<th colspan="2">实收</th>
				<th rowspan="2">个人欠/挂</th>
				<th rowspan="2">单位欠/挂</th>
			</tr>
			<tr>
				<th>个人</th>
				<th>单位</th>
				<th>个人</th>
				<th>单位</th>
			</tr>
			<tbody>
				{foreach from=$extraSoR item=val}
				 <tr>
				 	<td>{$val.uID}</td>
					<td><a href="{$httpPath}workerInfo/wManage.php?uID={$val.uID}" target='_blank'>{$val.name}</a></td>
					<td>{$val.pTotal}</td>
					<td>{$val.uTotal}</td>
					<td></td>
					<td></td>
					<td><input type="text" name="pSoInsMoney[{$val.uID}]" value="-{$val.pTotal}" size=6 readonly></td>
					<td><input type="text" name="uSoInsMoney[{$val.uID}]" value="-{$val.uTotal}" size=6 readonly></td>
					<input type="hidden"  name="uPDInsMoney[{$val.uID}]" value="{if $wRet[$val.uID].PDIns eq '1'}{$uPDIns}{else}0{/if}" >
					<input type="hidden" name="managementCostMoney[{$val.uID}]" value="{$mCostFeeArr[$val.uID]}">
				 </tr>
				{/foreach}
				{foreach from=$ofR item=val}
				 <tr>
				 	<td>{$val.uID}</td>
					<td><a href="{$httpPath}workerInfo/wManage.php?uID={$val.uID}" target='_blank'>{$val.name}</a></td>
					<td>{$soR[$val.uID].pTotal}</td>
					<td>{$soR[$val.uID].uTotal}</td>
					<td>{$val.pSoIns}</td>
					<td>{$val.uSoIns}</td>
					<td>{if ($val.pSoIns-$soR[$val.uID].pTotal) neq 0}{if ($curRMRet[$val.uID].pSoInsMoney-($val.pSoIns-$soR[$val.uID].pTotal))==0}{$val.pSoIns-$soR[$val.uID].pTotal}{else}<input type="text" name="pSoInsMoney[{$val.uID}]" value="{$val.pSoIns-$soR[$val.uID].pTotal}" size=6 readonly>{/if}{/if}</td>
                    <td>{if ($val.uSoIns-$soR[$val.uID].uTotal) neq 0}{if ($curRMRet[$val.uID].uSoInsMoney-($val.uSoIns-$soR[$val.uID].uTotal))==0}{$val.uSoIns-$soR[$val.uID].uTotal}{else}<input type="text" name="uSoInsMoney[{$val.uID}]" value="{$val.uSoIns-$soR[$val.uID].uTotal}" size=6 readonly>{/if}{/if}</td>
				    {if $val.uPDIns==0 && $wRet[$val.uID].PDIns == '1'&& ($curRMRet[$val.uID].uPDInsMoney-$uPDIns)!=0}
					<input type="hidden"  name="uPDInsMoney[{$val.uID}]" value="{$uPDIns}" >
					{/if}
                     {if $val.managementCost==0&&($mCostFeeArr[$val.uID]-$val.managementCost>0)&&($soR[$val.uID].pTotal>0||$soR[$val.uID].uTotal>0||$val.pay>0)}
					 <input type="hidden" name="managementCostMoney[{$val.uID}]" value="{$mCostFeeArr[$val.uID]-$val.managementCost}">

                 </tr>
				{/foreach}
			</tbody>
		</thead>
	</table>
	</form>
	{else}
	  <p>共<span class="red">{$ret|@count}</span>条记录</p>
	<table class="myTable">
		<thead>
			<form name="cSequenceForm">
				<tr>
					{foreach key=key item = fieldName from=$newFieldArr}
					<th>{$fieldName}</th>
					{/foreach}
				</tr>
			</form>
		</thead>
		<tbody>
			{foreach item = val from =$ret}
			<tr>
				{foreach item=v from=$val }
				<td>
					{$v}
				</td>
				{/foreach}
			</tr>
			{/foreach}
		</tbody>
	</table>
	{/if}
</div>
{include file="footer.tpl"}