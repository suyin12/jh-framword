{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>
	$(document).ready(function(){
    // 客户经理/单位二级联动
    $("select[name=mID]").change(function(){
        var j_d = $(".j_unitManager").val();
        j_d = eval(j_d);
        
        $.each(j_d, function(i, n){
            if ($("select[name=mID]").val() == n.mID) {
                $("select[name=unitID] option:not(:eq(0))").remove();
                $.each(n.unit, function(j, v){
                    $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                    v.unitName +
                    "</option>");
                });
                
            }
            if (!$("select[name=mID]").val()) {
                $.each(n.unit, function(j, v){
                    $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                    v.unitName +
                    "</option>");
                });
            }
        });
    });
	
	$(".chkAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("class");
        var chkName = thisName.replace("All", "");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
    });
	 //验证选择项
	$("input[name=create]").click(function(){
	        var val1 = $("select[name=zID]").val();
		    var val2 = $("select[name=salaryDate]").val();
		    var val3 = $("select[name=soInsDate]").val();
			var val4 = $("select[name=comInsDate]").val();
			var val5 = $("select[name=month]").val();
			var val6 = $("select[name=managementCostDate]").val();
			if(val1&&val2&&val3&&val4&&val5&&val6){
				if(isChecked(".chk")){
					alert("请选择需垫付工资的离职人员");
				}else{
				$("#choseForm").submit();
				}
			}else{
				alert("请选择相关的年月项");
			}
		 });
		 //选择工资账套
	 $("select[name=zID]").change(function(){
		 	var val=$(this).val();
			if(val=="newZF"){
				window.open('manageZF.php');
			}
			});	 
		    //提交
	    $(".aSub").click(function(){
	        var btnName = $(this).attr("name");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
		  	d = "field="+$(this).attr("alt") +"&btn=" + btnName ;
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
<div id="main">
	<input	type="hidden" class="j_unitManager" value='{$j_unitManager}'>
		<div>
			<form method="GET" class="form" id="wCSForm" action="">
				<div id="condition">
					<table>
						<tr >
							
							<td>客户经理						
								<select name="mID">
									<option value="">--请选择--</option>
									{foreach from = $unitManager item = val} 
									{html_options	values=$val.mID output= $val.mName selected= $s_mID}
									 {/foreach}
								</select>
						
								<strong>单位</strong> 
								<select name="unitID">
								<option value="">---------------请选择------------</option>
								{foreach from= $unitManager item= val key=k } 
									{foreach from= $val	item=u key= k}
									 {if $k eq "unit"}
									 {foreach from= $u item= m key= n}
										{html_options values= $m.unitID output= $m.unitName|replace:"深圳市":""	selected=$s_unitID}
									 {/foreach}
									 {/if}
									 {/foreach} 
								   {/foreach}
							</select>
							</td>
						</tr>
						<tr >
							<td>
								<p>选择离职日期:</p>
								<input  type='text' name='bT' value= '{$bT}' > 到 
								<input  type='text' name='eT' value='{$eT}' >(例如:2010-01-02)
							</td>
							<td>
								<input type="submit" name="wCS" value="提交" />
							</td>
						</tr>
					</table>
				</div>
			</form>
			</div>
			<div>
				<p>最近10个批次的离职工资垫付:</p>
			<form>
			<table class="myTable">
				<thead>
					<tr>
						<th>费用年月</th>
						<th>单位</th>
						<th>批次</th>
						<th>工资年月</th>
						<th>社保年月</th>
						<th>商保年月</th>
						<th>管理费年月</th>
						<th>人数</th>
						<th>应发</th>
						<th>个税</th>
						<th>实发</th>
						<th>总费用</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
						{foreach from=$exRet item=val }
						  <tr>
						  {foreach from=$val key=k item=v}
						  {if $k eq 'unitID'}
						    <td>{$unitArr.$v.unitName}</td>
						  {elseif $k eq 'confirmStatus' or $k eq 'zID' or $k eq 'appProID' or $k eq 'status'}	
						  {continue}
						  {else}
						  	<td>{$v}</td>
						  {/if}	
						  {/foreach}
						  <td>
							<a name="edit" href="{$httpPath}salaryManage/editDimissionSalary.php?month={$val.month}&extraBatch={$val.extraBatch}&zID={$val.zID}&unitID={$val.unitID}&modify=true">查看</a>
							{if $val.confirmStatus neq '1'}
							| <a name="delDimissionSalaryBtn" class="aSub" alt="{$val.month}|{$val.unitID}|{$val.extraBatch}">删除</a>
							| <a href="{$httpPath}approval/dimissionSalary.php?appProID={$val.appProID}">{if $val.status eq '5'}审批进行中{elseif $val.status eq '1'}已审批{elseif $val.status eq '99'}审批被退回{else}未提交审批{/if}</a>
							|  <span class="red">数据未确认</span>
							{else}
							<span class="red">数据已确认</span>
							{/if}
							</td>
						  </tr>
						 {foreachelse}
						 <tr>
						 	<Td colspan="13">暂无申请记录</Td>
						 </tr> 
						{/foreach}
						
				</tbody>
			</table>
		</form>
			</div>
			<div>
				{if $ret.ret}
				<p>离职名单预览:</p>
				<form method="post" action="{$url}" id="choseForm" target="_blank">
						<table class="myTable">
							<thead>
								<tr>
									<th>全选/反选<br><input name="editFeeChk" class='chkAll' type="checkbox"></th>
									{foreach from=$ret.ret.0 key=k item=v}
									{if $k neq 'ID'}
									<th>{$engToChsArr.$k}</th>
									{/if}
									{/foreach}
								</tr>
								<tbody>
									{foreach from=$ret.ret key=key item=val}
									<tr>
										<td><input name="dimissionID[]" class="chk" type="checkbox" value="{$val.ID}"></td>
										{foreach from=$val item=v key=k}
											{if $k neq 'ID'}
											<td>{$v}</td>
											{/if}
										{/foreach}
									</tr>
									{/foreach}
								</tbody>
							</thead>
						</table>
						{$ret.pageList}
						<table class="myTable">
								<tr>
									<td>
										<select name="zID">
										   <option value="">请选择帐套</option>
										   <option value="newZF">新建/修改帐套</option>
										   {html_options options=$ZFArr }
										  </select>
									</td>
									<td>	  
										  <select name="month">
										  	<option value="">费用产生年月</option>
											{html_options options=$DateArr }
										  </select>
									</td>
									<td>	  
										  <select name="salaryDate">
										  	<option value="">工资年月</option>
											{html_options options=$DateArr }
										  </select>
									</td>
									<td>	  
										  <select name="soInsDate">
										  	<option value="">社保年月</option>
											{html_options options=$DateArr}
										  </select>
									</td>
									<td>	  
										  <select name="comInsDate">
										  	<option value="">商保年月</option>
											{html_options options=$DateArr}
										  </select>
									  </td>
								      <td>	  
										  <select name="managementCostDate">
										  	<option value="">管理费年月</option>
											{html_options options=$DateArr }
										  </select>
									 </td>
									<td> 
										    <input type="button" name="create" value="确定">
									 </td>		
										</tr>
							</table>	
				</form>
			  {else}
			  <table class="mytable">
			  	<tr>
			  		<td>没有查询结果</td>
			  	</tr>
			  </table>
			  {/if}	
			</div>
</div>			
{include file="footer.tpl"}			