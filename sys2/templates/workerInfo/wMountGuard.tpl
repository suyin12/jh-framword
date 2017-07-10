{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/post.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="main">
            <form method="post" class="form" id="wMGForm">
            <fieldset>
            <legend><code>单位属性</code></legend>
            <table width="100%" border="0">
                <tr>
                    <td>
                        员工编号
                    </td>
                    <td>
                    {if $tid}
                    	<input type="hidden" name="tid" value="{$tid}" />
                    	<input type="text" name="uID" readonly="readonly" value="{$uID_s}" />
                    {else}
                    	<input type="text" name="uID" readonly="readonly" value="请选择单位" />
                    {/if}
                    </td>
                    <td>
                        资料的完整性<span class="red">*</span>
                    </td>
                    <td>
                        <select name="status" class="req-string">
                            {html_options options=$status selected=1}
                        </select>
                    </td>
                      <td>
                        员工类型<span class="red">*</span>
                    </td>
                    <td>
                        <select class="req-string" name="type">
                            {html_options options=$type selected=1}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        所属单位<span class="red">*</span>
                    </td>
                    <td>
                        <select name="unitID" class="req-string">
							<option value="">---------请选择单位----------</option>
                            {html_options options=$unit selected=$unit_s}
                        </select>
                    </td>
                    <td >
                        分公司
                    </td>
                    <td>
                        <input type="text" name="filiale" value="" />
                    </td>
                    <td>
                        部门
                    </td>
                    <td>
                        <input type="text" name="department" value="" />
                    </td>
                    <td>
                        岗位
                    </td>
                    <td>
                        <input type="text" name="station" value="{$position}" />
                    </td>
                </tr>
            </table>
            </fieldset>
            <fieldset>
            <legend><code>员工的基本信息</code></legend>
            <table width='100%'>
                <tr height="50px">
                    <td  >
                        姓名<span class="red">*</span>
                    </td>                   
                    <td  >	
                        <input type="text" class="req-string" name="name" value="{$name}" />   
                    </td>
              <td>
                        性别 <span class="red">*</span>
                    </td>
                    <td >
                        <select name="sex" class="req-string">
                            {html_options options=$sex selected=$sex_s}
                        </select>
                    </td>       
                    <td >
                        身份证号码<span class="red">*</span>
                    </td>
                    <td >
                        <input type="text" class="req-string" maxlength="18" name="pID" value="{$idCard}" />
                    </td> 
                    <td height="30">
                        移动电话 
                    </td>
                    <td height="30">
                      <input type="text" name="mobilePhone" value="{$mobile}" class="req-string" />
                    </td>
          		  <td>
                        固定电话 
                    </td>
                    <td>
                        <input type="text" name="telephone" value="" />
                    </td> 
                </tr>
                <tr>
                  <td>
                        联系人 
                    </td>
                    <td>
                        <input type="text" name="contact" value="" />
                    </td>
                    <td>
                        联系电话 
                    </td>
                    <td>
                        <input type="text" name="contactPhone" value="" />
                    </td>
                 <td>
                        婚姻状况  <span class="red">*</span>
                    </td>
                    <td >
                        <select name="marriage" class="req-string">
                            {html_options options=$marriage}
                        </select>
                    </td>         
           			<td>
                     配偶姓名
                    </td>
                    <td>
                        <input type="text" name="spouseName" value="" />
                    </td>
                    <td>
                     配偶身份证 
                    </td>
                    <td>
                        <input type="text" name="spousePID" value="" />
                    </td>
                  
                </tr>
              
                <tr height="50px">
                  {foreach name=foo from=$wInfoExtraField item=val key=key}
                   {if $smarty.foreach.foo.iteration%5 eq '0' }
                   </tr><tr height="30px">
                    <td>{$val}</td>
                     <td><input type="text" name="{$key}" value="" /></td>
                      {else}   
                      <td>{$val}</td>
                     <td><input type="text" name="{$key}" value="" /></td>
                     {/if}    
                     {/foreach}
                </tr>
                </table>
            </fieldset>
            <fieldset>
            <legend><code>员工的详细信息</code></legend>
                <table width='100%'>
                <tr height="50">
                <td width="77">
                        开户银行 
                    </td>
                    <td width="180">
                        <input type="text" name="blank" value="" />
                    </td>
                    <td width="61">
                        工资账号 
                    </td>
                    <td>
                        <input type="text" class="req-numeric" name="bID" value="" />
                    </td>
                    <td >
                        民族 
                    <span class="red" class="req-string">*</span>
                    </td>
                    <td>
                        <select name="nation" >
                            {html_options options=$nation selected=1}
                        </select>
                    </td>
                    <td>
                        政治面貌  <span class="red">*</span>
                    </td>
                    <td>
                        <select name="role" class="req-string">
                            {html_options options=$role selected=4}
                        </select>
                    </td>
                </tr>
                <tr height="50">
                    <td height="30" >
                        学校 
                    </td>
                    <td height="30">
                      <input type="text" name="school" value="" />
                    </td>
                    <td >
                        最高学历  <span class="red">*</span>
                    </td>
                    <td>
                      <select name="education" class="req-string">
                            {html_options options=$education  selected=61}
                        </select>
                    </td>
                    <td >
                        毕业年月 
                    </td>
                    <td>
                        <input type="text" name="dateOfGraduation" value="" />
                    </td>
                     <td >
                        家庭地址 
                    </td>
                    <td>
                        <input type="text" name="homeAddress" value="" />
                    </td>
                    
                </tr>
                <tr>
                <td >
                        现居住地址 
                    </td>
                    <td>
                        <input type="text" name="workAddress" value="" />
                    </td>
                 <td> 
       	      技能等级  <span class="red">*</span>
                    </td>
                    <td>
                      <select name="proLevel" class="req-string">
                            {html_options options=$proLevel  selected=9}
                        </select>
                    </td>                   
                  <td >  
          	  职称    <span class="red">*</span>
                    </td>
                    <td>
                      <select name="proTitle" class="req-string">
                            {html_options options=$proTitle  selected=9}
                        </select>
                    </td>
              		<td >  
          	广东节育报告单号
                    </td>
                     <td><input type="text" name="birthID" value="" /></td> 
                </tr>
                <tr height="50">
                <td >  
          	  数码图像号
                    </td>
                     <td><input type="text" name="photoID" value="" /></td>
                     <td>
                     就业登记日期
                    </td>
                     <td><input type="text" name="jobRegModifyDate" value="" /></td>
                </tr>
                        </table>
                        </fieldset>
            <fieldset>
            <legend><code>员工的合同信息</code></legend>
            <table width='100%'>
                <tr height="70">
                	<td width="81" >
                        档案编号
                    </td>
                    <td width="168">
                        <input type="text" name="dID" value="" />
                    </td>
                    <td height="30" >入职日期<span class="red">*</span></td>
                    <td><input type="text" class="req-string req-date" name="mountGuardDay" value="" /></td>
                    <td >  
              	合同类型    
                    </td>
                    <td>
                      <select name="cType" >
                            {html_options options=$cType  selected=1}
                        </select>
                    </td>
                    <td height="30" >合同起始日期</td>
                    <td><input type="text" name="cBeginDay" class="req-date" value="" /></td>
                    <td colspan="1">合同终止日期 </td>
                    <td><input type="text" name="cEndDay" class="req-date" value="" /></td>
                    <td >&nbsp;</td>
                </tr>
                <tr>
                    <td height="30" >
                        管理费<span class="red">*</span>
                    </td>
                    <td height="30">
                      <input type="text"  name="managementCost" value="" />
                    </td>
                    <td colspan='2'>商保
                          <input type="checkbox" name="comInsurance" value="1" /> 
                    </td>
                      <td colspan='2'> 互助会                        <input type="checkbox" name="helpCost" value="1" />   </td>
                </tr>
                <tr>
                        </table>
                        </fieldset>
            <fieldset>
            <legend><code>员工的社保信息</code></legend>
            <table width='100%'>
                <tr height="70">
                    <td height="30" >
                        户籍类型<span class="red">*</span>
                    </td>
                    <td><select name="domicile" class="req-string">
                      
                            {html_options options=$domicile}
                        
                    </select>
                        
                    </td>
                    <td height="30" >投保日期  <span class="red">*</span></td>
                    <td><input type="text" class="req-string req-date" name="soInsBuyDate" value="" /></td>
                    <td >社保号 </td>
                    <td><input type="text" name="sID" class="req-numeric" value="" /></td>
                    <td>基数<span class="red">*</span></td>
                    <td><input type="text" name="radix" class="req-string req-numeric" value="" /></td>
                </tr>
            </table>
            <div align="left">
                <!-- 这几个保险的前后顺序不准挪动,JS里面有按顺序获取他们的值	-->
<table width="100%" height="0%" border="0" cellspacing="10">
                    <tr>
                        <td width="6%">
                            养老<input type="checkbox" class="soInsField" name="pension" value="1" />
                        </td>
                        <td colspan="4">
                            医疗{html_radios class="soInsField"  name=hospitalization options=$hospitalization}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            工伤<input type="checkbox" class="soInsField" name="employmentInjury" value="1" />
                        </td>
                        <td width="6%">
                            失业<input type="checkbox" class="soInsField" name="unemployment" value="1" />
                        </td>
                        <td width="7%">
                            残障金<input type="checkbox" class="soInsField" name="PDIns" value="1" />
                        </td>
                        <td width="73%">
                            利手{html_radios  name=hand options=$hand checked=1}
                        </td>
                    </tr>
                    </table>
            </fieldset>
            <fieldset>
            <legend><code>员工住房公积金信息</code></legend>
            <table width='100%'>
              <tr height="50px">
              <td>公积金启用日期</td>
              <td><input type="text" class="req-date" name="HFBuyDate" value="" /></td>
               <td >个人公积金号 </td>
               <td><input type="text" name="HFID" class="req-numeric" value="" /></td>
               <td>基数</td>
               <td><input type="text" name="HFRadix" class="req-numeric" value="" /></td>
                <td>个人比例</td>
               <td><input type="text" name="pHFPer" class="req-numeric" value="" /></td>
                <td>单位比例</td>
               <td><input type="text" name="uHFPer" class="req-numeric" value="" /></td>
               
              </tr>
              </table>
            <table>
                <tr>
                    <td width="471" height="30">
                        <p><strong>备注</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea name= "remarks" cols="100" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td height="50">
                        <input type="button" name="wMG" value="提交" />
                    </td>
                </tr>
            </table>
            </fieldset>
            <div id="errorDiv" class="error-div-alternative">
            </div>
        </form>
   
</div>
{include file="footer.tpl"}