{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>

	
	$(document).ready(function(){
	    //审批流程加载,注意一下下列规则
	    $("div[id$=AppPro]").each(function(i){
	        var appProID = $(this).attr('id') + "ID";
	        $(this).load("../approval/approvalProcessDetail.php", {
	            "appProID": $("input[name=" + appProID + "]").val()
	        });
	    });
		
		$(".tab").each(function(i){
			var viewType=getQuery('viewType');
		    var proSel = ($(this).attr('alt')).replace("Div","");
			if(proSel==viewType){
			   $(this).parent().css({'background':'#eddece'});
			}
		});
		   //提交
	    $(".sub").click(function(){
	        var formID = $(this).parents("form").attr("id");
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "approvalSql.php";
	        d = $("#" + formID).serialize() + "&btn=" + btnName;
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
	});
</script>
{/literal}
<div id="mainBody">
	<table class="myTable">
		<tr>
			<td colspan=3>
				工资表/费用表审批
			</td>
		</tr>
		<tr>
			<th>名称</th>
			<th>审批进程</th>
			<th></th>
		</tr>
		<tr>
			<td>
				{$listRet.month}月< {$unit[$listRet.unitID].unitName} > 的<{$listRet.typeName}>审批
			</td>
			<td>
				<input type="hidden" name="feeAppProID" value="{$listRet.appProID}" />
				<div id="feeAppPro">
				</div>
			</td>
			<td>
				[ <a href="{$httpPath|cat:'salaryManage/editDimissionSalary.php?zID='|cat:$pageArr.ret.0.zID|cat:'&month='|cat:$pageArr.ret.0.month|cat:'&unitID='|cat:$pageArr.ret.0.unitID|cat:'&extraBatch='|cat:$pageArr.ret.0.extraBatch}" target="_blank">查看本月详细数据</a>]
			</td>
		</tr>
	</table>
	<p>公式:</p>
	<div id="formulasChart">
			<table class="myTable">
				{$formulasChartStr}
			</table>
		</div>
		<table class="myTable">
				<tr>
					<td>
						应发工资 ={$formulasStr.pay}
					</td>
				</tr>
				<tr>
					<td>
						应缴纳税额 = 应发工资 - 个人社保 -个税起征额{$formulasStr.ratal}
					</td>
				</tr>
				<tr>
					<td>
						实发工资 = 应发工资 - 个税 - 个人社保  - 个人商保 - 收回社保欠款 - 收回商保欠款 -收回其他欠款- 房屋水电 - 互助会 {$formulasStr.acheive}
					</td>
				</tr>
				<tr>
					<td>
						单位挂账 = {$formulasStr.uAccount}
					</td>
				</tr>
				<tr>
					<td>总费用=应发工资+残障金+单位社保+单位商保+管理费+单位挂账 {$formulasStr.totalFee}</td>
				</tr>
			</table>
	  
		  <p>工资表明细(共<span class="red">{$num}</span>条记录)</p>
		<table class="myTable"  id="mainTable">
			<thead>
				<tr>
					<th>姓名</th>
					<th>单位</th>
					<th>部门</th>
					<th>工资账号</th>
					{foreach item=pVal from=$payStr.0}
					<th>{$newFieldArr.$pVal}</th>
					{/foreach}
					<th>应发工资</th>
					<th>应缴纳税额</th>
					<th>个税</th>
					<th>缴交基数</th>
					<th>个人社保</th>
					<th>个人商保</th>
					<th>收回社保欠款</th>
					<th>收回商保欠款</th>
					<th>收回其他欠款</th>
					<th>制社保卡</th>
					<th>制居住证</th>
					<th>房屋水电</th>
					<th>互助会</th>
					{foreach item=oVal from=$otherCostsStr.0}
					<th>{$newFieldArr.$oVal}</th>
					{/foreach}
					<th>实发工资</th>
				</tr>
			</thead>
			<tbody>
				{foreach item=sVal from=$salaryArr}
				{if $sVal.status eq '0'}
				<tr class="red">
				{else}
				<tr>
				{/if}
					{foreach item=sv key=sk from=$sVal}
					 {if $sk eq 'name'}
					  <th>
						<a href="{$httpPath|cat:'workerInfo/wManage.php?uID='|cat:$sVal.uID}" target="_blank">{$sv}</a>
					</th>
					{elseif $sk eq 'status' || $sk eq 'uID' }
						{continue}
					{else}
					<td>
						{if @is_numeric($sv) && $sk neq 'bID'}
							{$sv|string_format:"%.2f"}
						{else}
						  	{$sv}
						{/if}
					</td>
					  {/if}
					{/foreach}
				</tr>
				{/foreach}
				<tr>
					{foreach item=totalCell from=$salaryTotalArr}
					<td>
						{$totalCell}
					</td>
					{/foreach}
				</tr>
			</tbody>
		</table>
		<div>
			<p>费用表明细(共<span class="red">{$num}</span>条记录)</p>
			<table class="myTable"  id="mainTable">
				<thead>
					<tr>
						<th >姓名</th>
						<th >员工编号</th>
						<th >单位</th>
						<th >部门</th>
						<th >应发工资</th>
						<th >残障金</th>
						<th >社保</th>
						<th >商保</th>
						<th >管理费</th>
						<th >单位挂账</th>
						{foreach item=oVal from=$otherCostsStrFee.0}
				  		<th >{$newFieldArr.$oVal}</th>
						{/foreach}
						<th >总费用</th>
					</tr>
				</thead>
				<tbody>
					{foreach item=fVal from=$feeArr}
					{if $fVal.status eq '0'}
					<tr class="red">
					{else}
					<tr>
					{/if}
						{foreach item=fv key=fk from=$fVal}
						{if $fk eq 'name'}
						<th>
							<a href="{$httpPath|cat:'workerInfo/wManage.php?uID='|cat:$fVal.uID}" target="_blank">{$fv}</a>
						</th>
						{elseif $fk eq 'status'}
							{continue}
						{else}
						<td>
							{if @is_numeric($fv)}
							{$fv|string_format:"%.2f"}
						{else}
						  	{$fv}
						{/if}
						</td>
						{/if}
						{/foreach}
					</tr>
					{/foreach}
					<tr>
						{foreach item=totalCell from=$feeTotalArr}
						<td>
							{$totalCell}
						</td>
						{/foreach}
					</tr>
				</tbody>
			</table>
			</div>
		{$pageArr.pageList} 
		<table class="myTable">
		<thead>
			<tr>
				<th>审批确认</th>
				<th>数据确认</th>
			</tr>
		</thead>
	 	  {if $ret.0.confirmStatus neq '1'}
			<tr>
				<td>
					{if $nRet.proID }
					<form id="approvalForm">
					<input type="hidden" name="proID" value='{$nRet.proID}'>
					<input type="button" class="sub" name="approvalSucc" value="审批通过"> 
					<input type="button" class="sub" name="approvalRollback" value="退回">
					备注: <textarea name="approvalRemarks"></textarea>
					</form>
					{/if}
				</td>
				<td>
					<form id="addToLedgerForm">
					<input type="hidden" name="extraBatch" value='{$listRet.extraBatch}'>
					<input type="hidden" name="unitID"  value="{$listRet.unitID}">
					<input type="hidden" name="month"  value="{$listRet.month}">
					<input type="button" class="sub" name="addToLedgerBtn" value="数据确认" {if $listRet.status neq '1' }disabled{/if}  />
				    </form>
				</td>
			</tr>
		   	{else}
		   <tr>
		   	<td colspan=3><span class="red">数据已确认,无法再次操作</span></td>
		   </tr>	
			{/if}	
		</table>	
</div>
{include file="footer.tpl"}