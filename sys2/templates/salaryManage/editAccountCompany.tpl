{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script type="text/javascript">

	$(document).ready(function(){
	    //提交
	    $(".sub").click(function(){
	        var formID = this.form.id;
	        var btnName = $(this).attr("name")
	        var chkName = ":checkbox[name^=editAccountCheck]";
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d = $("#" + formID).serialize() + "&" + $("#editAccount").serialize() + "&btn=" + btnName + "&type=fee";
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
	        if (isChecked(chkName) == false) {
	            var ret = confirm("确定" + $(this).val() + "?");
	            if (ret == true) {
	                ajaxAction(t, u, d, dt, m);
	            }
	        }
	        else {
	            alert("请勾选要操作的数据");
	        }
	    });
	    //筛选条件的POST提交.. 
	    $(".selPost").change(function(){
	        $(".selForm").submit();
	    });
	    //提交
	    $(".aSub").click(function(){
	        var formID = $(this).parents("form").attr("id");
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d = "ID=" + $(this).attr("alt") + "&btn=" + btnName + "&type=fee";
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
	        var ret = confirm("确定" + $(this).text() + "?");
	        if (ret == true) {
	            ajaxAction(t, u, d, dt, m);
	        }
	    });
	  
});
</script>
{/literal}
<div id="mainBody">
    <fieldset>
	<table class="myTable" width="100%">
		<thead>
			<tr>
				<th rowspan="2">请选择 </th>
				<th rowspan="2">姓名</th>
				<th colspan="5">单位挂账</th>
				<th rowspan="2">公司挂账总额</th>
				<th rowspan="2">状态</th>
			</tr>
			<tr>
				<form class="selForm" method="post">
					<input type="hidden" name="selPost" value="1" />
					<th>
						<select class="selPost" name=uPDInsMoneySel>
							<option value="">残障金</option>
							{html_options values= $uPDInsMoneyArr	output=$uPDInsMoneyArr	selected=$s_uPDInsMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=uSoInsMoneySel>
							<option value="">社保</option>
							{html_options values= $uSoInsMoneyArr	output=$uSoInsMoneyArr	selected=$s_uSoInsMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=uComInsMoneySel>
							<option value="">商保</option>
							{html_options values= $uComInsMoneyArr	output=$uComInsMoneyArr	selected=$s_uComInsMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=managementCostMoneySel>
							<option value="">管理费用</option>
							{html_options values= $managementCostMoneyArr  output=$managementCostMoneyArr 	selected=$s_managementCostMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=uOtherMoneySel>
							<option value="">其他</option>
							{html_options values= $uOtherMoneyArr  output=$uOtherMoneyArr 	selected=$s_uOtherMoneySel}
						</select>
					</th>
				</form>
			</tr>
		</thead>
		<tbody>
			<form id="editAccount" name="editAccount">
				<input type="hidden" name="month" value='{$smarty.get.month}'>
				<input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
				{foreach from=$ret item=val}
				<tr>
					<td>
						{if  $retMA[$val.uID].status neq '1'}
						<input type="checkbox" name="editAccountCheck[]" value="{$val.uID}">
						{else}
						{assign var='status' value='1' }
						{/if}
					</td>
					<td>
						{$val.name}
					</td>
					<td>
						<span class="uPDInsAccount">{$val.uPDInsMoney}</span>
						{if $val.uPDInsMoney gt 0}
						<input type="checkbox" name="pA[{$val.uID}]" value="uPDInsMoney" checked=checked>
						<input type="hidden" name='uPDInsMoney[{$val.uID}]' value="{$val.uPDInsMoney}"  />
						{/if}
					</td>
					<td>
						<span class="uSoInsAccount">{$val.uSoInsMoney}</span>
						{if $val.uSoInsMoney gt 0}
						<input type="checkbox" name="sA[{$val.uID}]" value="uSoInsMoney">
						<input type="hidden" name='uSoInsMoney[{$val.uID}]' value="{$val.uSoInsMoney}" />
						{/if}
					</td>
					<td>
						<span class="uComInsAccount">{$val.uComInsMoney}</span>
						{if $val.uComInsMoney gt 0 }
						<input type="checkbox" name="cA[{$val.uID}]" value="uComInsMoney" checked=checked>
						<input type="hidden" name='uComInsMoney[{$val.uID}]' value="{$val.uComInsMoney}" />
						{/if}
					</td>
					<td>
						<span class="managementCostAccount">{$val.managementCostMoney}</span>
						{if $val.managementCostMoney gt 0}
						<input type="checkbox" name="mA[{$val.uID}]" value="managementCostMoney" checked=checked>
						<input type="hidden" name='managementCostMoney[{$val.uID}]' value="{$val.managementCostMoney}" />
						{/if}
					</td>
					<td>
						<span class="uOtherAccount">{$val.uOtherMoney}</span>
						{if $val.uAccount gt 0}
						<input type="checkbox" name="uA[{$val.uID}]" value="uOtherMoney">
						<input type="hidden" name='uOtherMoney[{$val.uID}]' value="{$val.uOtherMoney}" />
						{/if}
					</td>
					<td>
						<span class="accountTotal">
							{$aT[$val.uID]}
						</span>
					</td>
					<td>
					{if $retMA[$val.uID].status eq '0'}
					   未签收
					{elseif $retMA[$val.uID].status eq '1'} 
						已签收   
					{elseif $retMA[$val.uID].status eq '99'} 
					    已退回
					{/if}
				    {if $retMA[$val.uID].ID && $retMA[$val.uID].status neq '1'}
					|  <a class="aSub" name="deleteAccount" alt="{$retMA[$val.uID].ID}">删除</a>
					{/if}
					</td>
				</tr>
				{foreachelse}
				<tr>
					<td colspan="12">
						没有需要调整的数据
					</td>
				</tr>
				{/foreach}
			<tr>
				<td>
					{if  $retMA[$val.uID].status neq '1'}
					<input type="button" class="sub" name="editAccountCompanyBtn" value="提交">
					{/if}
				</td>
			</tr>
			</form>
		</tbody>
	</table>
 </fieldset>
</div>
{include file="footer.tpl"}