{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>
{literal}
<script type="text/javascript">

	$(document).ready(function(){
		//编辑数据
		 $(".editTd").editable("salarySql.php", {
	        type: "text",
	        submit: "确定",
	        width: "10",
	    	data: function(){
					var content = $(this).attr("title");
					return content;
				},
		        submitdata: function(){
	               var ID = $(this).attr("alt");
				    return {
						ID:ID,	
	   	                btn: "editDimissionSalaryBtn"
	    	            };
	    	        },
	    	        event: "click",
	    	        onblur: "cancel",
	    	        placeholder: "",
	    	        ajaxoptions: {
	    	            dataType: "json"
	    	        }
	    	    });
		//刷新页面,用checkbox来控制
		checkReload(":checkbox");	
	    //提交
	    $(".sub").click(function(){
	        var formID = this.form.id;
	        var btnName = $("#" + formID + " :button").attr("name")
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d = $("#" + formID).serialize() + "&btn=" + btnName+"&type=dimissionSalary";
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
	    //选择欲编辑的公式
	    $("input[name^=formulas]").each(function(i){
	        $(this).click(function(){
	            ret = confirm("确定编辑公式吗?");
	            if (ret) {
	                $("input[name^=formulas]").attr("readonly", true);
	                $(this).removeAttr("readonly");
	                this.focus();
	            }
	        });
	    });
	    
	    //设置点击列表设置参数
	    $(".chart").each(function(i){
	        $(this).click(function(){
	            var chartVal = $(this).attr("id");
	            $("input[name^=formulas]").each(function(k){
	                if (!$(this).attr("readonly")) {
	                    var val = $(this).val();
	                    val = val + chartVal;
	                    this.focus();
	                    $(this).val(val);
	                }
	            });
	        });
	    });
	});
</script>

<style>
.tableBoxOuter {
		width:100%;
		height:40em; 
	}
</style>
{/literal}
<div id="mainBody">
		<div>
		<p>公式设置(特别提醒:选择下表中项,设置公式,这里的公式只能整列计算,)</p>
		<div id="formulasChart">
			<table class="myTable">
				{$formulasChartStr}
			</table>
		</div>
		<form name=formulasSet id = formulasSet>
			<input type="hidden" name="zID" value='{$smarty.get.zID}'>
			<input type="hidden" name="unitID" value='{$unitID}'>
			<input type="hidden" name="month" value='{$smarty.get.month}'>
			<input type="hidden" name="ID" value='{$formulasID}'>
			<input type="hidden" name="extraBatch" value='{$extraBatch}'>
			<table>
				<td>
						应发工资 =
					</td>
					<td>
						<input type="text" name="formulas[pay]" value='{$formulasStr.pay}' readonly=true size=100 />
					</td>
				</tr>
				<!--
				<tr>
					<td>
						单位挂账 = 
					</td>
					<td>
						<input type="text" name="formulas[uAccount]" value='{$formulasStr.uAccount}' readonly=true size=100 />
					</td>
				</tr>
				-->
				<tr>
					<td>总费用=应发工资+残障金+单位社保+单位商保+管理费+单位挂账</td>
					<td>
						<input type="text" name="formulas[totalFee]" value='{$formulasStr.totalFee}' readonly=true size=100 />
					</td>
				</tr>
				<tr>
					<td>
						应缴纳税额 = 应发工资 - 个人社保 -个税起征额
					</td>
					<td>
						<input type="text" name="formulas[ratal]" value='{$formulasStr.ratal}' readonly=true size=100 />
					</td>
				</tr>
				<tr>
					<td>
						实发工资 = 应发工资 - 个税 - 个人社保  - 个人商保 - 收回社保欠款 - 收回商保欠款 -收回其他欠款- 房屋水电 - 互助会 
					</td>
					<td>
						<input type="text" name="formulas[acheive]" value='{$formulasStr.acheive}' readonly=true size=100 />
					</td>
				</tr>
				
			</table>
			<input type="button" name="subFormulas" class="sub" value="提交公式">
		</form>
	</div>
	{if $formulasID}
	<div>
		<span class="red">特别提示:必需优先设置"应发工资"相关的项目...(点击相关项,可进行修改)</span>
		<div>
			<p>费用明细表:    <input type="checkbox" class="reload" name="hideHeader" value="1" {if $smarty.get.hideHeader eq 'true'} checked='true' {/if} />  隐藏应发工资项
		</p>
			<form>
			<table class="myTable"  id="editTable">
			<thead>
					<tr>
						<th >姓名</th>
						<th>员工编号</th>
						{if $smarty.get.hideHeader neq 'true'}
						{foreach item=pVal from=$payStr.0}
						<th>{$newFieldArr.$pVal}</th>
						{/foreach}
						{/if}
						<th>应发工资</th>
						<th >残障金</th>
						<th >单位社保</th>
						<th>单位商保</th>
						<th >管理费</th>
						
						{foreach item=oVal from=$uOtherCostsStr.0}
				  		<th >{$newFieldArr.$oVal}</th>
						{/foreach}
						<th >总费用</th>
					</tr>
				</thead>
				<tbody>
						{foreach from=$feeArr item=val}
						 <tr>
						 	{foreach item=v from=$val key=k}
								{if $k eq 'ID' or $k eq 'confirmStatus'}
								{continue}
								{elseif $k eq 'uID'}
								<td><a href="{$httpPath}workerInfo/wManage.php?uID={$val.uID}" target="_blank">{$v}</a></td>
								{elseif $k eq 'pay' or $k eq 'totalFee'}
								<td class="highLight">{$v}</td>
								{else}
								<td {if $val.confirmStatus eq '0'} class="editTd" alt="{$val.ID}|{$k}" title="{$v}"{/if}>{$v}</td>
								{/if}
							{/foreach}
						 </tr>
					    {/foreach}	
				</tbody>
			<table>
			</form>
		</div>
		<div>
			<p>工资发放表</p>
			<table class="myTable"  id="mainTable">
			<thead>
				<tr>
					<th>姓名</th>
					<th>员工编号</th>
					<th>工资账号</th>
					<th>应发工资</th>
					<th>应缴纳税额</th>
					<th>个税</th>
					<th>个人社保</th>
					<th>个人商保</th>
					<th>收回社保欠款</th>
					<th>收回商保欠款</th>
					<th>收回其他欠款</th>
					<th>制社保卡</th>
					<th>制居住证</th>
					<th>房屋水电</th>
					<th>互助会</th>
					{foreach item=oVal from=$pOtherCostsStr.0}
					<th>{$newFieldArr.$oVal}</th>
					{/foreach}
					<th>实发工资</th>
				</tr>
			</thead>
			  <tbody>
						{foreach from=$salaryArr item=val}
						 <tr>
						 	{foreach item=v from=$val key=k}
								{if $k eq 'ID' or $k eq 'confirmStatus'}
								{continue}
								{elseif $k eq 'uID'}
								<td><a href="{$httpPath}workerInfo/wManage.php?uID={$val.uID}" target="_blank">{$v}</a></td>
								{elseif $k eq 'pay' or $k eq 'ratal' or $k eq 'pTax'  or $k eq 'acheive' or $k eq 'pSoInsMoney' or $k eq 'pComInsMoney' or $k eq 'soInsCardMoney' or $k eq 'residentCardMoney' or $k eq 'pOtherMoney' }
								<td class="highLight">{$v}</td>
								{else}
								<td {if $val.confirmStatus eq '0'} class="editTd" alt="{$val.ID}|{$k}" title="{$v}"{/if}>{$v}</td>
								{/if}
							{/foreach}
						 </tr>
					    {/foreach}	
				</tbody>
			</table>
		</div>
		<form method="post">
			<input type="submit" name="save" value="保存">
			<input type="submit" name="subApproval" value="提交审批">
		</form>
		{$showWindow}
	</div>
	{/if}
</div>
{include file="footer.tpl"}