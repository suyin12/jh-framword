{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
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

                            $("input[name=editrequire]").click(function(){
			
                                    var t,u,d,dt,m;
                                    t = "post";
                                    u = "mSQL.php";
                                    d = $("#updateRequireForm").serialize();
                                    dt = "json";
                                    m = function(json){
                                                    $.each(json,function(i,n){
                                                            switch(i)
                                                            {
                                                            case "error":
                                                            case "error2":
                                                                    alert(n);
                                                                    break;
                                                            case "success":
                                                                    alert(n);
                                                                    break;
                                                            }
                                                    });
                                            };

                                    successfunc = function(){
                                            ajaxAction(t,u,d + "&btn=editrequire",dt,m);
                                    };

                                    validator("input[name=editrequire]","#updateRequireForm","#errorDiv",successfunc);
				
                            });
	

    });
    </script>
{/literal}
<div id="main">
    <form id="updateRequireForm" class="form">
        <input type="hidden" name="demandID" value="{$demandID}" />
        <table border="2" class="myTable">
            <tr>
                <td>上岗日期</td><td><input type="text" name="deadline" class="req-string req-date" value="{$the_require.deadline}" /></td>
                <td>需求人数</td><td><input type="text" name="required" class="req-string ret-numeric" value="{$the_require.required}" /></td>
            </tr>

            <tr>
                <td>岗位名称<span class="red">*</span></td><td>
                    <input type="hidden" name="positionID" value="{$the_require.positionID}" /> 
                    <input type="text" name="name" class="req-string" value="{$the_require.name}"/></td>

                <td>用工单位<span class="red">*</span></td><td>
                    <select name="unitId" class="req-string">
                        <option value="">---------请选择用工单位--------</option>
                        {assign var="unit_selected" value=$the_require.unitId}
                        {html_options options=$allunits selected=$unit_selected}
                    </select></td>

                <td>工作地点<span class="red">*</span></td>
                <td><input type="text" name="workPlace"  class="req-string" value="{$the_require.workPlace}"/></td>
                <td>快捷字母</td><td><input type="text" name="shortcut" value="{$the_require.shortcut}"/></td>
            </tr>


            <tr>
                <td>年龄<span class="red">*</span></td>
                <td><input type="text" name="posAge" value="{$the_require.posAge}"/></td>

                <td>性别<span class="red">*</span></td>
                <td><input type="text" name="posSex"  value="{$the_require.posSex}"/></td>

                <td>学历<span class="red">*</span></td>
                <td><input type="text" name="posDegree"  value="{$the_require.posDegree}"/></td>

                <td>身高<span class="red">*</span></td>
                <td><input type="text" name="posHeight"  value="{$the_require.posHeight}"/></td>
            </tr>


            <tr>
                <td>岗位要求<span class="red">*</span></td><td colspan="7">
                    <textArea rows="10" cols="120" name="posOther" >{$the_require.posOther}</textArea></td>
            </tr>

            <tr>
                <td>岗位职责<span class="red">*</span></td><td colspan="7">
                    <textArea rows="10" cols="120" name="duty" >{$the_require.duty}</textArea></td>
            </tr>

            <tr>
                <td rowspan="9">薪酬福利</td>
                <td>试用期工资</td>
                <td colspan="2">基本工资<span class="red">*</span>
                    <input type="text" name="trialBasicSalary"  size="30" value="{$the_require.trialBasicSalary}"/></td>

                <td colspan="2">综合工资<span class="red">*</span>
                    <input type="text" name="trialTotalSalary"  size="30" value="{$the_require.trialTotalSalary}"/></td>
                <td colspan="2">年薪<span class="red">*</span>
                    <input type="text" name="trialSalaryPerYear"  size="30" value="{$the_require.trialSalaryPerYear}"/></td>

            </tr>

            <tr>
                <td>转正后工资</td>
                <td colspan="2">基本工资<span class="red">*</span>
                    <input type="text" name="officialBasicSalary"  size="30" value="{$the_require.officialBasicSalary}" /></td>


                <td colspan="2">综合工资<span class="red">*</span>
                    <input type="text" name="officialTotalSalary"  size="30" value="{$the_require.officialTotalSalary}"/></td>
                <td colspan="2">年薪<span class="red">*</span>
                    <input type="text" name="officialSalaryPerYear"  size="30" value="{$the_require.officialSalaryPerYear}"/></td>

            </tr>


            <tr>
                <td>保险<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="insurance"  size="100" value="{$the_require.insurance}"/></td>
            </tr>
            <tr>
                <td>日工作时间<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="dailyWorkHour"   size="100" value="{$the_require.dailyWorkHour}"/></td>
            </tr>
            <tr>
                <td>周工作时间<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="weeklyWorkHour"  size="100" value="{$the_require.weeklyWorkHour}"/></td>
            </tr>
            <tr>
                <td>工作班制<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="shift"   size="100" value="{$the_require.shift}"/></td>
            </tr>
            <tr>
                <td>夜班补助<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="nightShiftAllowance"   size="100" value="{$the_require.nightShiftAllowance}"/></td>
            </tr>
            <tr>
                <td>食宿<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="accommodation"   size="100" value="{$the_require.accommodation}"/></td>
            </tr>
            <tr>
                <td>其他福利<span class="red">*</span></td><td colspan="6">
                    <input type="text" name="benefit"   size="100" value="{$the_require.benefit}"/></td>
            </tr>


        </table>
        <div id="errorDiv" class="error-div-alternative"></div>
        <p>
            {if $the_require.status eq 1 || $the_require.status eq 2}
                <input type="button" name="editrequire" value="提交" /> 
            {/if}
        </p>

    </form>




</div>
{include file="footer.tpl"}