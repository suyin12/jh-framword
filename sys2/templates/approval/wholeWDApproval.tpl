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
<div id="main">
    <fieldset>
	<p class="notice">1.特别提醒,最后一个审批角色,必需再次完成数据确认,否则审批流程即使完成了,也不能完成冲减挂账!!切记</p>
        <legend><code>工资表/费用表审批</code></legend>
        <table class="myTable">
		<tr>
			<th>名称</th>
			<th>审批进程</th>
		</tr>
		<tr>
			<td>
				{$listRet.month}月< {$unit[$listRet.unitID].unitName} > 的<{$listRet.typeName}>审批
			</td>
			<td>
				<input type="hidden" name="WDWholeAppProID" value="{$listRet.appProID}" />
				<div id="WDWholeAppPro">
				</div>
			</td>
		</tr>
	</table>
	<form id="feeApprovalForm">
		<input type="hidden" name="type" value="wholeWD" />
		<input type="hidden" name="unitID" value="{$smarty.get.unitID}">
		<input type="hidden" name="month" value="{$smarty.get.month}">
        <legend><code>[ {$typeArr[$smarty.get.type].name} ]审批: </code></legend>
	<table class="myTable">
		<thead>
			<tr>
				<th>单位名称</th>
				<th>申请冲减金额</th>
				<th>查看</th>
			</tr>
		</thead>
		<tbody>
			{foreach item=val from=$ret}
			<tr>
				<td>
					<input type="hidden" name="roleA[]" value="{$val.roleA}">
					{$val.unitName}
				</td>
				<td>
					{$val.wholeWD}
				</td>
				<td> <a href="{$typeArr[$smarty.get.type].url}?unitID={$val.unitID}&month={$val.month}&soInsDate={$val.soInsDate}" target="_blank">查看详情</a></td>
			</tr>
			{/foreach}
			<tr>
				<td>
					{if $nRet.proID}
					<form id="approvalForm">
					<input type="hidden" name="proID" value='{$nRet.proID}'>
					<input type="button" class="sub" name="approvalSucc" value="审批通过"> 
					<input type="button" class="sub" name="approvalRollback" value="退回">
					备注: <textarea name="approvalRemarks"></textarea>
					</form>
					{/if}
				</td>
				<td><input type="button" class="sub" name="feeApprovalSuccBtn" value="数据确认" {if $listRet.status neq '1'}disabled{/if} /></td>
				<td><input type="button" class="sub"  name="rollback" value="退回"  {if $listRet.status eq '1'}disabled{/if} ></td>
			</tr>
		</tbody>
	</table>
	</form>
    </fieldset>
</div>
{include file="footer.tpl"}