{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){		
			$("input[name=createPositionAndRequire]").click(function(){				
					var t,u,d,dt,m,lastid;
					t = "post";
					u = "mSQL.php";
					d = $("#createPositionForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
								if(i == "lastid")
									lastid = n;
									switch(i)
									{
									case "error":
										alert(n);
										break;
									case "exist_error":
										alert(n);
										window.location.href= "positionManage.php";
										break;
									case "success":
										alert(n);		
										window.location.href = "addRequire.php?id=" + lastid ;
										break;
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=createPosition",dt,m);
						};
					validator("input[name=createPositionAndRequire]","#createPositionForm","#errorDiv",successfunc);			
			});
			
			$("input[name=createPositionNormal]").click(function(){
				var t,u,d,dt,m;
				t = "post";
				u = "mSQL.php";
				d = $("#createPositionForm").serialize();
				dt = "json";
				m = function(json){
						$.each(json,function(i,n){
								switch(i)
								{
								case "error":
									alert(n);
									break;
								case "exist_error":
									alert(n);
									break;
								case "success":
									if(confirm(n+"，确定将结束添加计划，取消则继续添加计划") == true)
									{
										window.close();
									}
									else
									{
										window.location.reload();
									}
									break;
								}
							});
					};
					successfunc = function(){
						ajaxAction(t,u,d + "&btn=createPosition",dt,m);
					};
				validator("input[name=createPositionNormal]","#createPositionForm","#errorDiv",successfunc);	
		});		
			
			//岗位流程具体项目显示
			$(".alertDetail").change(function(){
			 var v=	$(this).val();
			var j_r = $(".j_r").val();
		    j_r =eval(j_r);
			var list="";
			$.each(j_r, function(i, n){	
				$.each(n.detail, function(x, y){
					if(v==n.ID){
							list +=y.name+"=>";							
					}
				});		           
			});
			$(".detailList").html(list);
		});

});
</script>

{/literal}
<div id="main">
 <input type="hidden" class="j_r"  value='{$j_r}' >
<form id="createPositionForm" class="form">

<table border="2" class="myTable">
<tr>
<td>岗位名称<span class="red">*</span></td><td><input type="text" name="name" class="req-string" /></td>

<td>用工单位<span class="red">*</span></td>
<td>

<select name="unitID" class="req-string">
<option value="">---------请选择用工单位--------</option>
{html_options options=$units selected=$unit}
</select>

</td>

<td>工作地点<span class="red">*</span></td><td><input type="text" name="workPlace" class="req-string"/></td>
<td>快捷字母</td><td><input type="text" name="shortcut" /></td>
</tr>


<tr>
<td>年龄<span class="red">*</span></td><td><input type="text" name="posAge" class="req-string"/></td>

<td>性别<span class="red">*</span></td><td><input type="text" name="posSex" class="req-string" /></td>

<td>学历<span class="red">*</span></td><td><input type="text" name="posDegree" class="req-string" /></td>

<td>身高<span class="red">*</span></td><td><input type="text" name="posHeight" class="req-string" /></td>
</tr>


<tr>
<td>岗位要求<span class="red">*</span></td><td colspan="7"><textArea rows="10" cols="120" name="posOther" class="req-string" ></textArea></td>
</tr>

<tr>
<td>岗位职责<span class="red">*</span></td><td colspan="7"><textArea rows="10" cols="120" name="duty" class="req-string" ></textArea></td>
</tr>

<tr>
<td rowspan="9">薪酬福利</td>
<td>试用期工资</td>
<td colspan="2">基本工资<span class="red">*</span><input type="text" name="trialBasicSalary" size="30" class="req-string"/></td>

<td colspan="2">综合工资<span class="red">*</span><input type="text" name="trialTotalSalary"   size="30" class="req-string"/></td>
<td colspan="2">年薪<span class="red">*</span><input type="text" name="trialSalaryPerYear"  size="30" /></td>

</tr>

<tr>
<td>转正后工资</td>
<td colspan="2">基本工资<span class="red">*</span><input type="text" name="officialBasicSalary"   size="30" class="req-string"/></td>


<td colspan="2">综合工资<span class="red">*</span><input type="text" name="officialTotalSalary"   size="30" class="req-string"/></td>
<td colspan="2">年薪<span class="red">*</span><input type="text" name="officialSalaryPerYear"   size="30" /></td>

</tr>


<tr>
<td>保险<span class="red">*</span></td><td colspan="6"><input type="text" name="insurance"   size="100" /></td>
</tr>

<tr>
<td>日工作时间<span class="red">*</span></td><td colspan="6"><input type="text" name="dailyWorkHour"   size="100" /></td>
</tr>
<tr>
<td>周工作时间<span class="red">*</span></td><td colspan="6"><input type="text" name="weeklyWorkHour"   size="100" /></td>
</tr>
<tr>
<td>工作班制<span class="red">*</span></td><td colspan="6"><input type="text" name="shift"   size="100" /></td>
</tr>
<tr>
<td>夜班补助<span class="red">*</span></td><td colspan="6"><input type="text" name="nightShiftAllowance"   size="100" /></td>
</tr>
<tr>
<td>食宿<span class="red">*</span></td><td colspan="6"><input type="text" name="accommodation"   size="100" /></td>
</tr>
<tr>
<td>其他福利<span class="red">*</span></td><td colspan="6"><input type="text" name="benefit"   size="100" /></td>
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
<tr>
<td colspan="8" align="center">
<input type="button" name="createPositionAndRequire" value="确定并立即增加需求" />
<input type="button" name="createPositionNormal" value="确定但不立即增加需求" />
<input type="reset" value="重置" /></td>
</tr>

</table>
<div id="errorDiv" class="error-div-alternative"></div>


</form>




</div>
</div>
{include file="footer.tpl"}
