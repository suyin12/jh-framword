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
	        d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=fee";
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
		 //提交
	    $(".aSub").click(function(){
	        var formID = $(this).parents("form").attr("id");
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d = "ID="+$(this).attr("alt") + "&btn=" + btnName + "&type=fee";
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
		        var ret = confirm("确定" + $(this).text()+ "?");
		        if (ret == true) {
		            ajaxAction(t, u, d, dt, m);
		        }
	    });
	    //全选反选
	    $(".chkAll").click(function(){
	        var cC, aC;
	        var allChkName = this.name;
	        var chkName = allChkName.replace("Chk", "");
	        cC = this;
	        aC = ':checkbox[name^=' + chkName + 'Check]';
	        checkAll(cC, aC);
	    });
	    //自动调整
	    $(".auto").each(function(i){
	        $(this).click(function(){
				$("input[name^=editAccountCheck]").eq(i).attr("checked",true);
				$(".margin").eq(i).removeClass("red");
	            var sA = cA = mA = uA = aTotal = mTotal = marginS= pM =sM = cM = mM = oM = margin =0;
	            if ($(":checkbox[name^=sA]").eq(i).attr("checked") == true) 
	                sA = Number($(".uSoInsAccount").eq(i).text());
	            if ($(":checkbox[name^=cA]").eq(i).attr("checked") == true) 
	                cA = Number($(".uComInsAccount").eq(i).text());
	            if ($(":checkbox[name^=mA]").eq(i).attr("checked") == true) 
	                mA = Number($(".managementCostAccount").eq(i).text());
	            if ($(":checkbox[name^=uA]").eq(i).attr("checked") == true) 
	                uA = Number($(".uAccount").eq(i).text());
	            aTotal = Number(sA + cA + mA + uA);
				var pMS = Number($(".uPDInsMoney").eq(i).text());
	            var sMS = Number($(".uSoInsMoney").eq(i).text());
	            var cMS = Number($(".uComInsMoney").eq(i).text());
	            var mMS = Number($(".managementCostMoney").eq(i).text());
	            var oMS = Number($(".uOtherMoney").eq(i).text());
				mTotalS = Number(pMS+sMS+cMS+mMS+oMS);
				marginS = Number(aTotal + mTotalS);
				if(marginS>=0){
					pM =pMS<0? -pMS:0;
					sM= sMS<0?-sMS:0;
					cM = cMS<0?-cMS:0;
					mM=mMS<0? -mMS:0;
					oM = oMS<0?-oMS:0;
				}else{
					alert("调整失败,'挂账额度'<'需调整的欠款额度',需手工调整");
				}
				$("input[name^=uPDInsMoney]").eq(i).val(pM);
				$("input[name^=uSoInsMoney]").eq(i).val(sM);
				$("input[name^=uComInsMoney]").eq(i).val(cM);
				$("input[name^=managementCostMoney]").eq(i).val(mM);
				$("input[name^=uOtherMoney]").eq(i).val(oM);
				mTotal = Number(pM+sM+cM+mM+oM) ;
			    margin = Number((aTotal-mTotal).toFixed(2));
				$(".margin").eq(i).text(margin);
				if(margin<0){
					$(".margin").eq(i).addClass("red");
				}
	        });
	    });
		
		//手动调整
		$("input[name *='Money']").each(function(j){
			$(this).blur(function(){
				 var i =parseInt( j/ 5);
				var thisVal = Number($(this).val());
				if( isNaN($(this).val()) || thisVal<0){
					$(this).val("0");
					$(".margin").eq(i).text("");
					alert("请输入一个正数");
					return false;
				}
			 $(".margin").eq(i).removeClass("red");
			 var sA = cA = mA = uA = aTotal = mTotal = pM = sM = cM = mM = oM = margin =0;
	            if ($(":checkbox[name^=sA]").eq(i).attr("checked") == true) 
	                sA = Number($(".uSoInsAccount").eq(i).text());
	            if ($(":checkbox[name^=cA]").eq(i).attr("checked") == true) 
	                cA = Number($(".uComInsAccount").eq(i).text());
	            if ($(":checkbox[name^=mA]").eq(i).attr("checked") == true) 
	                mA = Number($(".managementCostAccount").eq(i).text());
	            if ($(":checkbox[name^=uA]").eq(i).attr("checked") == true) 
	                uA = Number($(".uAccount").eq(i).text());
		         aTotal = Number(sA + cA + mA + uA);
				pM = Number($("input[name^=uPDInsMoney]").eq(i).val());
			    sM = Number($("input[name^=uSoInsMoney]").eq(i).val());
	            cM = Number($("input[name^=uComInsMoney]").eq(i).val());
	            mM = Number($("input[name^=managementCostMoney]").eq(i).val());
	            oM = Number($("input[name^=uOtherMoney]").eq(i).val());
				mTotal = Number(pM+sM+cM+mM+oM) ;
				margin = Number((aTotal-mTotal).toFixed(2));
				$(".margin").eq(i).text(margin);
					if(margin<0){
						$(this).val("0");
					$(".margin").eq(i).text("");
					alert("输入的需调整值大于挂账,请重新输入");
					return false;
					}
			});
		});
	});
</script>
{/literal}
<div id="mainBody">
	<span class="red">注意:
		<br/>
		1.下面的欠款均为累计欠款,但挂账为本月挂账,也就是说,这里的调整挂账,实质上是一种用本月其他项目的挂账来收回欠款的功能,同时也包括了本月欠款收回功能
		<br/>
		2. 自动调整的优先顺序为:挂账部分: 单位挂账>社保挂账>商保挂账>管理费挂账  
	</span>
	<form id="editAccount" name="editAccount">
		<input type="hidden" name="month" value='{$smarty.get.month}'>
		<input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
	<table class="myTable">
		<thead>
			<tr>
				<th rowspan="2">全选/反选
					<br/>
				   <input name="editAccountChk" class=chkAll type="checkbox">
				</th>
				<th rowspan="2">操作</th>
				<th rowspan="2">姓名</th>
				<th colspan="4">单位挂账</th>
				<th colspan="5">单位欠款</th>
				<th rowspan="2">均衡值</th>
			</tr>
			<tr>
				<th>社保</th>
				<th>商保</th>
				<th>管理费</th>
				<th>单位挂账</th>
				<th>残障金</th>
				<th>社保</th>
				<th>商保</th>
				<th>管理费</th>
				<th>其他</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$ret item=val}
			<tr>
				<td>
				{if  $retMA[$val.uID].status neq '1'}
					<input type="checkbox" name="editAccountCheck[{$val.uID}]" value="{$val.uID}">
				{else}
				{assign var='status' value='1' }
				{/if}
				</td>
				<td>
					<a  class="auto">自动调整</a>
					{if $retMA[$val.uID].ID && $retMA[$val.uID].status eq '0'}
					|  <a class="aSub" name="deleteAccount" alt="{$retMA[$val.uID].ID}">删除</a>
					{elseif $retMA[$val.uID].status eq '1'}
					|  已签收
					{elseif $retMA[$val.uID].status eq '99'}
					|  <span class="red">已退回</span>
					|  <a class="aSub" name="deleteAccount" alt="{$retMA[$val.uID].ID}">删除</a>
					{/if}
				</td>
				<td>
					{$val.name}
				</td>
				<td>
					<span class="uSoInsAccount">{$val.uSoInsMoney}</span>
					{if $val.uSoInsMoney gt 0}
					<input type="checkbox" name="sA[{$val.uID}]" value="uSoInsMoney" >
					{/if}
				</td>
				<td>
					<span class="uComInsAccount">{$val.uComInsMoney}</span>
					{if $val.uComInsMoney gt 0 }
					<input type="checkbox" name="cA[{$val.uID}]" value="uComInsMoney"  >
					{/if}
				</td>
				<td>
					<span class="managementCostAccount">{$val.managementCostMoney}</span>
					{if $val.managementCostMoney gt 0}
					<input type="checkbox" name="mA[{$val.uID}]" value="managementCostMoney" >
					{/if}
				</td>
				<td>
					<span class="uAccount">{$val.uAccount}</span>
					{if $val.uAccount gt 0}
					<input type="checkbox" name="uA[{$val.uID}]" value="uAccount" checked=checked >
					{/if}
				</td>
				<td>
					<span class="uPDInsMoney">{$retM[$val.uID].uPDInsMoney} </span>
					<input type="text" name='uPDInsMoney[{$val.uID}]' value="{$retMA[$val.uID].uPDInsMoney}" size="5" {if $retM[$val.uID].uPDInsMoney==0}readOnly{/if}>
				</td>
				<td>
					<span class="uSoInsMoney">{$retM[$val.uID].uSoInsMoney} </span>
					<input type="text" name='uSoInsMoney[{$val.uID}]' value="{$retMA[$val.uID].uSoInsMoney}" size="5" {if $retM[$val.uID].uSoInsMoney==0}readOnly{/if}>
				</td>
				<td>
					<span class="uComInsMoney">{$retM[$val.uID].uComInsMoney}</span>
					<input type="text" name='uComInsMoney[{$val.uID}]' value="{$retMA[$val.uID].uComInsMoney}" size="5" {if $retM[$val.uID].uComInsMoney==0}readOnly{/if}>
				</td>
				<td>
					<span class="managementCostMoney">{$retM[$val.uID].managementCostMoney}</span>
					<input type="text" name='managementCostMoney[{$val.uID}]' value="{$retMA[$val.uID].managementCostMoney}" size="5" {if $retM[$val.uID].managementCostMoney==0}readOnly{/if}>
				</td>
				<td>
					<span class="uOtherMoney">{$retM[$val.uID].uOtherMoney}</span>
					<input type="text" name='uOtherMoney[{$val.uID}]' value="{$retMA[$val.uID].uOtherMoney}" size="5" {if $retM[$val.uID].uOtherMoney==0}readOnly{/if}>
				</td>
				<td>
					<span class="margin"></span>
				</td>
			</tr>
			{foreachelse}
			<tr><td colspan="12">没有需要调整的数据</td></tr>
			{/foreach}
			<tr>
				{if  $retMA[$val.uID].status neq '1'}
				<td><input type="button" class="sub" name="editAccountMineBtn"  value="提交"></td>
				{/if}
			</tr>
		</tbody>
	</table>
	
	</form>
</div>
{include file="footer.tpl"}