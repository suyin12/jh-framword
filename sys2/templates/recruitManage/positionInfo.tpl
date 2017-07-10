{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
{literal}
<script type="text/javascript">

$(document).ready(function(){		
			$("input[name=updatePosition]").click(function(){
			
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#updatePositionForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "error":
										alert(n);
										break;
									case "success":
										alert(n);
										window.location.reload();
										break;
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=updatePosition",dt,m);
						};

					validator("input[name=updatePosition]","#updatePositionForm","#errorDiv",successfunc);
					
			});

			$("input[name=updposwithbackup]").click(function(){
			
				var t,u,d,dt,m;
				t = "post";
				u = "mSQL.php";
				d = $("#updatePositionForm").serialize();
				dt = "json";
				m = function(json){
						$.each(json,function(i,n){
							switch(i)
							{
							case "error":
								alert(n);
								break;
							case "success":
								alert(n);
								break;
							}
						});
					};

				successfunc = function(){
					ajaxAction(t,u,d + "&btn=updposwithbackup",dt,m);
				};

				validator("input[name=updposwithbackup]","#updatePositionForm","#errorDiv",successfunc);
				
			});
		
			//岗位流程具体项目显示
				$(".alertDetail").change(function(){
				 var v=	$(this).val();
				var j_r = $(".j_r").val();
			    j_r =eval(j_r);
				var list="";
				$.each(j_r, function(i, n){					
						if(v==n.ID){
								list =n.detail;							
						}
				});
				$(".detailList").html(list);
			});
});
</script>
{/literal}
<div id="main">
<fieldset>
 <input type="hidden" class="j_r"  value='{$j_r}' >
<form id="updatePositionForm" class="form">
<table border="2" class="myTable">
<tr>
<td>岗位名称<span class="red">*</span></td><td>
<input type="hidden" name="positionID" value="{$the_position.positionID}" /> 
<input type="hidden" name="lastPositionID" value="{$the_position.lastPositionID}" /> 
<input type="text" name="name" class="req-string" value="{$the_position.name}"/></td>

<td>用工单位<span class="red">*</span></td><td>
<select name="unitId" class="req-string">
<option value="">---------请选择用工单位--------</option>
{assign var="unit_selected" value=$the_position.unitId}
{foreach from=$units item=val key=key}
{html_options values=$key output=$val.unitName selected=$unit_selected}
{/foreach}
</select></td>

<td>工作地点<span class="red">*</span></td>
<td><input type="text" name="workPlace" value="{$the_position.workPlace}"/></td>
<td>快捷字母</td><td><input type="text" name="shortcut" value="{$the_position.shortcut}"/></td>
</tr>


<tr>
<td>年龄<span class="red">*</span></td>
<td><input type="text" name="posAge"  value="{$the_position.posAge}"/></td>

<td>性别<span class="red">*</span></td>
<td><input type="text" name="posSex"  value="{$the_position.posSex}"/></td>

<td>学历<span class="red">*</span></td>
<td><input type="text" name="posDegree"  value="{$the_position.posDegree}"/></td>

<td>身高<span class="red">*</span></td>
<td><input type="text" name="posHeight"  value="{$the_position.posHeight}"/></td>
</tr>


<tr>
<td>岗位要求<span class="red">*</span></td><td colspan="7">
<textArea rows="10" cols="120" name="posOther" >{$the_position.posOther}</textArea></td>
</tr>

<tr>
<td>岗位职责<span class="red">*</span></td><td colspan="7">
<textArea rows="10" cols="120" name="duty" >{$the_position.duty}</textArea></td>
</tr>

<tr>
<td rowspan="9">薪酬福利</td>
<td>试用期工资</td>
<td colspan="2">基本工资<span class="red">*</span>
<input type="text" name="trialBasicSalary"  size="30" value="{$the_position.trialBasicSalary}"/></td>
<td colspan="2">综合工资<span class="red">*</span>
<input type="text" name="trialTotalSalary"  size="30" value="{$the_position.trialTotalSalary}"/></td>
<td colspan="2">年薪<span class="red">*</span>
<input type="text" name="trialSalaryPerYear"  size="30" value="{$the_position.trialSalaryPerYear}"/></td>
</tr>
<tr>
<td>转正后工资</td>
<td colspan="2">基本工资<span class="red">*</span>
<input type="text" name="officialBasicSalary"  size="30" value="{$the_position.officialBasicSalary}" /></td>
<td colspan="2">综合工资<span class="red">*</span>
<input type="text" name="officialTotalSalary"  size="30" value="{$the_position.officialTotalSalary}"/></td>
<td colspan="2">年薪<span class="red">*</span>
<input type="text" name="officialSalaryPerYear"  size="30" value="{$the_position.officialSalaryPerYear}"/></td>

</tr>
<tr>
<td>保险<span class="red">*</span></td><td colspan="6">
<input type="text" name="insurance"  size="100" value="{$the_position.insurance}"/></td>
</tr>
<tr>
<td>日工作时间<span class="red">*</span></td><td colspan="6">
<input type="text" name="dailyWorkHour"  size="100" value="{$the_position.dailyWorkHour}"/></td>
</tr>
<tr>
<td>周工作时间<span class="red">*</span></td><td colspan="6">
<input type="text" name="weeklyWorkHour"  size="100" value="{$the_position.weeklyWorkHour}"/></td>
</tr>
<tr>
<td>工作班制<span class="red">*</span></td><td colspan="6">
<input type="text" name="shift"  size="100" value="{$the_position.shift}"/></td>
</tr>
<tr>
<td>夜班补助<span class="red">*</span></td><td colspan="6">
<input type="text" name="nightShiftAllowance"  size="100" value="{$the_position.nightShiftAllowance}"/></td>
</tr>
<tr>
<td>食宿<span class="red">*</span></td><td colspan="6">
<input type="text" name="accommodation"  size="100" value="{$the_position.accommodation}"/></td>
</tr>
<tr>
<td>其他福利<span class="red">*</span></td><td colspan="6">
<input type="text" name="benefit"  size="100" value="{$the_position.benefit}"/></td>
</tr>
<tr>
<td rowspan="4">岗位流程</td>
<td>复试流程<span class="red">*</span></td><td colspan="2">
<select name="reexamineProcedureID"   class="alertDetail req-string"  style="width:150px">
<option value="">------请选择--------</option>
<option value="" class="newProcedurer">####新增#####</option>
{foreach from=$recruitProcedurerArr['1'] key=key item=val}
{html_options values=$val.ID output=$val.name selected=$the_position.reexamineProcedureID}
{/foreach}
</select>
<td rowspan="4" colspan="4"><span class="detailList"></span></td>
</tr>
<tr>
<td>培训流程</td><td colspan="2">
<select name="trainProcedureID"  class="alertDetail"  style="width:150px">
<option value="">------请选择--------</option>
<option value="" class="newProcedurer">####新增#####</option>
{foreach from=$recruitProcedurerArr['2'] key=key item=val}
{html_options values=$val.ID output=$val.name selected=$the_position.trainProcedureID}
{/foreach}
</select>
</tr>
<tr>
<td>需提交资料<span class="red">*</span></td><td colspan="2">
<select name="materialProcedureID"  class="alertDetail req-string"  style="width:150px">
<option value="">------请选择--------</option>
<option value="" class="newProcedurer">####新增#####</option>
{foreach from=$recruitProcedurerArr['4'] key=key item=val}
{html_options values=$val.ID output=$val.name selected=$the_position.materialProcedureID}
{/foreach}
</select>
</tr>
<tr>
<td>待岗辅助项</td><td colspan="2">
<select name="waitProcedureID" class="alertDetail"   style="width:150px">
<option value="">------请选择--------</option>
<option value="" class="newProcedurer">####新增#####</option>
{foreach from=$recruitProcedurerArr['3'] key=key item=val}
{html_options values=$val.ID output=$val.name selected=$the_position.waitProcedureID}
{/foreach}
</select>
</tr>
<td colspan="8" align="center">
<input type="button" name="updatePosition" value="更新" />
<input type="button" name="updposwithbackup" value="更新并将旧信息存储为历史数据" />
</td>
</tr>
</table>
<div id="errorDiv" class="error-div-alternative"></div>
</form>
</fieldset>
</div>
{include file="footer.tpl"}