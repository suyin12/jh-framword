{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("input[name=c]").one("click", function(){
        $(this).val("");
        $(":checkbox[name=s_status_stop]").attr("checked",false);
    });
    $("select[name=status]").change(function(){
        var t=$(this).val();
		if(t=="0"){
			$(":checkbox[name=s_status_stop]").attr("checked",false);
		}else{
			$(":checkbox[name=s_status_stop]").attr("checked",true);
		}
    });
});
</script>
{/literal}
<div id="main">
	<fieldset>
		<div class="left">
		  <form name="searchArchives" method="get" action="{$actionURL}">
		  <table height="70px">
			  <tr>
			     <td colspan="2">
			     	<strong>请选择查询条件</strong>
			     		<select name="m">{html_options options=$m selected=$s_m}</select>
					  	 <input type="text" name="c" value="{$s_c}"/>
				 </td>
				 <td>
				 	<input name="s_status_stop" type="checkbox" value="1" {$s_status_stop|default:checked}/> 不包含停交人员
                 </td>
			  </tr>
		  	<tr>
		  		<td>
		  			<strong>{$roleName}　</strong>
		  			<select name="mID">
			            <option value="">--请选择--</option>
						{foreach from = $unitManager item = val} 
						{html_options values=$val.mID output= $val.mName selected=$s_mID} {/foreach}
					 </select>
		  		</td>
		  		<td>
			  		　<strong>状态</strong>
					 <select name="status">
					 	<option value="">--请选择--</option>
					 	{html_options options=$status selected=$s_status}
					 </select>
		  		</td>
		  		<td>
                    　<input type="submit" value="查询"/>
                </td>
		  	</tr>
		     </table>
	   	</form>
	   </div>
	      <div class="right">
	      	 <a class="noSub positive" href="agencyManage.php" >列表</a>
	         <a class="noSub positive" href="aCreateManage.php" >登记</a>
	         <a class="noSub positive" href="agMPayList.php">缴费</a>
             <a class="noSub positive" href="aCreateList.php" >申报</a>
	         <a class="noSub positive" href="agMFeelist.php">平账\入账</a>
	         <a class="noSub positive" href="agMBillList.php?modifydate={$modifydate}">流水账记录</a>
	      </div>
    </fieldset>
    <div>
	    <fieldset>
		    <legend><code>结果</code></legend>
			<table class="myTable">
				<tr>	
					<th>状态</th>
					<th>档案号</th>
					<th>姓名</th>
					<th>身份证号</th>
					<th>联系电话</th>
					<th>社保电脑号</th>
					<th>关系来源</th>
					<th>管理费</th>
					<th>户籍</th>
					<th>医保类型</th>
					<th>备注</th>
					<th>最新代理期限(社保)</th>
					<th>最新代理期限(公积金)</th>
				</tr>
				{foreach item=sa key=key from=$siagency}
				{if $sa}
				<tr>
					<td>{if $sa.status=="2" || $sa.status=="5" || $sa.status=="0"}{$status[$sa.status]}{/if}</td>
					<td>{$sa.dID}</td>
					<td><a href="aManage.php?id={$sa.id}">{$sa.name}</a></td>
					<td>{$sa.pID}</td>
					<td>{$sa.mobilePhone}</td>
					<td>{$sa.sID}</td>
					<td>{$sa.relationalName}</td>
					<td>{if $sa.managementCost=="0"}免{else}{$sa.managementCost}{/if}</td>
					<td>{$domicile[$sa.domicile]}</td>
					<td>{$hospitalization[$sa.hospitalization]}</td>
					<td>{$sa.remarks}</td>
					<td>{if $sa.soInsurance==0}|{else}{if $sa.cBeginDay=="0000-00-00"}{else}{$sa.cBeginDay}{/if}|{if $sa.cEndDay=="0000-00-00"}{else}{$sa.cEndDay}{/if}{/if}</td>
					<td>{if $sa.housingFund==0}|{else}{if $sa.hBeginDay=="0000-00-00"}{else}{$sa.hBeginDay}{/if}|{if $sa.hEndDay=="0000-00-00"}{else}{$sa.hEndDay}{/if}{/if}</td>
				</tr>
				{else}
				<tr><td colspan="12"><font color="red">无此类信息</font></td></tr>
				{/if}
				{/foreach}
			</table>
			<form method="post">
				<div class="tt">
					<div class="left">{$pageList}</div>
					<div class="right">
						<input type="checkbox" name="codeVison" value="1" >编码格式版本
						<input type="submit"  name="intoExcel"  value="保存为EXCEL"/>
					</div>
				</div>
			</form>
		</fieldset>
	</div>
</div>
{include file="footer.tpl"}