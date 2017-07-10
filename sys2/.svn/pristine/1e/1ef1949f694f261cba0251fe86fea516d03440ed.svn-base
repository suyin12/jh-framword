{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/post.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="main">
          <form method="GET" class="form" id="wSForm" action="wInfo.php">
            <div>
                <table width="100%" border="0">
                    <tr>
                        <td width="11%">
                            &nbsp; 请选择查询条件
                        </td>
                        <td width="23%">
                            &nbsp; 
                            <select name=m class="req-string">
                                {html_options options=$model}
                            </select>
                        </td>
                        <td width="15%">
                            &nbsp; <input type="text" name="c" value={$condition|default:"模糊查询,可用缩写"}>
                        </td>
                        <td width="51%">
                            <p><input type="button" name="wS" value="查询"></p>
                        </td>
                    </tr>
                </table>
            </div>
        </form><!-- 更新的时候form  disable=flase 查看时 disable=true -->
        <form method="post" class="form" id="wUPForm" {$smarty.get.update|default:"disabled"}>
            <p><input type="hidden" name="oldUID" value={$uID}><input type="hidden" name="oldUnitID" value={$s_unitID}></p>
            <fieldset>
            <legend><code>员工单位属性</code></legend>
            <table width="100%" border="0">
                <tr height="30px">
                    <td >
                        员工编号 
                    </td>
                    <td>
                        {$uID} 
                    </td>
                     <td>
                        员工类型<span class="red">*</span>
                    </td>
                    <td>
                            <select class="req-string" name="type">
                                {html_options options=$type selected=$s_type}
                            </select>
                    </td>
                    <td>
                        岗位
                    </td>
                    <td>
                        <input type="text" name="station" value="{$station}" />
                    </td>
                    </tr>
                  <tr height="30px">
                           <td >
                        所属单位<span class="red">*</span>
                    </td>
                    <td>
                            {$unit.$s_unitID}
                             [ <a href="wChangeUnit.php?uID={$uID}">单位转签 </a>]   
                    </td>
                    <td>
                        分公司
                    </td>
                    <td >
                        <input type="text" name="filiale" value="{$filiale}" />
                    </td>
                    <td>
                        部门<span class="red">*</span>
                    </td>
                    <td>
                        <input type="text" name="department" value="{$department}" />
                    </td>
                </tr>
            </table>
            </fieldset>
            <fieldset>
            <legend><code>员工的基本信息</code></legend>
            <table width="100%"  border="0">           
                <tr height="30px">
                    <td>
                        姓名<span class="red">*</span>
                    </td>
                    <td width="15%">
                        <input type="text" class="req-string" name="name" value="{$name}" />
                    </td>
                    <td>
                        性别 <span class="red">*</span>
                    </td>
                    <td >
                        <select name="sex" class="req-string">
                            {html_options options=$sex selected=$s_sex}
                        </select>
                    </td> 
                    <td>
                        身份证号码<span class="red">*</span>
                    </td>
                    <td width="17%">
                        <input type="text" class="req-string" maxlength="18" name="pID" value="{$pID}" />
                    </td>
                    <td>
                        移动电话 
                    </td>
                    <td>
                        <input type="text" name="mobilePhone" value="{$mobilePhone}" />
                    </td>
                </tr>
                <tr height="30px">
                <td>
                        固定电话 
                    </td>
                    <td>
                        <input type="text" name="telephone" value="{$telephone}" />
                    </td> 
            	<td>
                        婚姻状况 
                    </td>
                    <td>
                        <select name="marriage">
                            {html_options options=$marriage selected=$s_marriage}
                        </select>
                    </td>        
           		   <td>
                     配偶姓名
                    </td>
                    <td>
                        <input type="text" name="spouseName" value="{$spouseName}" />
                    </td>
                    <td>
                     配偶身份证 
                    </td>
                    <td>
                        <input type="text" name="spousePID" value="{$spousePID}" />
                    </td>       
                </tr>
                <tr height="30px">
               		 <td>
                        联系人 
                    </td>
                    <td>
                        <input type="text" name="contact" value="{$contact}" />
                    </td>
                    <td>
                        联系电话 
                    </td>
                    <td>
                        <input type="text" name="contactPhone" value="{$contactPhone}" />
                    </td>                
                 </tr>
                </tr>
                </table>
                </fieldset>
            <fieldset>
            <legend><code>员工的详细信息</code></legend>
            <table width="100%"  border="0">      
                <tr height="30px">
                <td >
                        开户银行 
                    </td>
                    <td >
                        <input type="text" name="blank" value="{$blank}" />
                    </td>
                    <td >
                        工资账号 
                    </td>
                    <td >
                        <input type="text" class="req-numeric" name="bID" value="{$bID}" />
                    </td>
                    <td >
                        民族 
                    <span class="red" class="req-string">*</span>
                    </td>
                    <td>
                        <select name="nation" >
                            {html_options options=$nation selected=$s_nation}
                        </select>
                    </td>
                    <td>
                  	  政治面貌  <span class="red">*</span>
                    </td>
                    <td>
                        <select name="role" class="req-string">
                            {html_options options=$role selected=$s_role}
                        </select>
                    </td>
                    
                </tr>
               <tr height="30px">
                    <td>
                        学校 
                    </td>
                    <td>
                        <input type="text" name="school" value="{$school}" />
                    </td>
                    <td >
                        最高学历  <span class="red">*</span>
                    </td>
                    <td>
                      <select name="education" class="req-string">
                            {html_options options=$education  selected=$s_education}
                        </select>
                    </td>
                    <td>
                        毕业年月
                    </td>
                    <td>
                        <input type="text" name="dateOfGraduation" value="{$dateOfGraduation}" />
                    </td>
                    <td>
                        家庭地址 
                    </td>
                    <td>
                        <input type="text" name="homeAddress" value="{$homeAddress}" />
                    </td>
                </tr>
                <tr height="30px">
                <td>
                        现居住地地址 
                    </td>
                    <td>
                        <input type="text" name="workAddress" value="{$workAddress}" />
                    </td>
                 <td> 
       	      技能等级  <span class="red">*</span>
                    </td>
                    <td>
                      <select name="proLevel" class="req-string">
                            {html_options options=$proLevel  selected=$s_proLevel}
                        </select>
                    </td>                   
                  <td >  
          	  职称    <span class="red">*</span>
                    </td>
                    <td>
                      <select name="proTitle" class="req-string">
                            {html_options options=$proTitle  selected=$s_proTitle}
                        </select>
                    </td>
              		<td >  
          	广东节育报告单号
                    </td>
                     <td><input type="text" name="birthID" value="{$birthID}" /></td> 
                </tr>
                <tr height="30px">
                <td >  
          	  数码图像号
                    </td>
                     <td><input type="text" name="photoID" value="{$photoID}" /></td>
                     <td>
                     就业登记日期
                    </td>
                     <td><input type="text" name="jobRegModifyDate" value="{$jobRegModifyDate}" /></td>
                </tr>
                    <tr height="30px">
                  {foreach name=foo from=$wInfoExtraField item=val key=key}
                   {if $smarty.foreach.foo.iteration%5 eq '0' }
                   </tr><tr height="30px">
                    <td>{$val}</td>
                     <td><input type="text" name="{$key}" value="{$wInfoExtraFieldVal.$key}" /></td>     
                      {else}   
                      <td>{$val}</td>
                     <td><input type="text" name="{$key}" value="{$wInfoExtraFieldVal.$key}" /></td>     
                     {/if}    
                     {/foreach}
                     </tr>
                     </table>
                </fieldset>
            <fieldset>
            <legend><code>员工的合同信息</code></legend>
                <table width="100%"  border="0">      
               <tr height="30px">
                	<td width="81">
                        档案编号
                    </td>
                    <td width="168">
                        <input type="text" name="dID" value="{$dID}" />
                    </td>
                    <td>
                        入职日期<span class="red">*</span>
                    </td>
                    <td>
                        <input type="text" class="req-string req-date" name="mountGuardDay" value="{$mountGuardDay}" />
                    </td>
                    <td >  
		              	合同类型    
				                    </td>
				                    <td>
				                      <select name="cType" >
				                            {html_options options=$cType  selected=$s_cType}
				                        </select>
				                    </td>
                    <td>
                        合同起始日期 
                    </td>
                    <td>
                        <input type="text" class="req-date" name="cBeginDay" value="{$cBeginDay}" />
                    </td>
                    <td>
                        合同终止日期 
                    </td>
                    <td >
                        <input type="text" class="req-date" name="cEndDay" value="{$cEndDay}" />
                    </td>
                </tr>
                <tr height="30px">
                    <td>
                        管理费<span class="red">*</span>
                    </td>
                    <td>
                        <input type="text" class="req-notnull req-numeric" name="managementCost" value='{$managementCost}' />
                    </td>
                    <td>
                        商保
                    </td>
                    <td>
                        <input type="checkbox" name="comInsurance" value="1" {if $comInsurance  eq 1}  checked{/if} />
                    </td>
                    <td>
                        互助会
                    </td>
                    <td >
                        <input type="checkbox" name="helpCost" value="1" {if $helpCost  eq 1}  checked{/if} />
                    </td>
                </tr>
                </table>
                </fieldset>
            <fieldset>
            <legend><code>员工的保险信息</code></legend>
            <table width="100%"  border="0">  
               <tr height="30px">
                    <td>
                        户籍类型<span class="red">*</span>
                    </td>
                    <td>
                        <select name="domicile">
                            {html_options options=$domicile selected=$s_domicile}
                        </select>
                    </td>
                    <td>
                        投保日期<span class="red">*</span>
                    </td>
                    <td>
                        <input type="text" class="req-string req-date" name="soInsBuyDate" value="{$soInsBuyDate}" />
                    </td>
                    <td>
                        社保更改日期<span class="red">*</span>
                    </td>
                    <td>
                        {$soInsModifyDate}
                    </td>
                </tr>
               <tr height="30px">
                 <td>
                        社保号<span class="red">*</span>
                    </td>
                    <td>
                        <input type="text" name="sID" class="req-numeric" value="{$sID}" />
                    </td>
                    <td>
                        基数<span class="red">*</span>
                    </td>
                    <td>
                        <p><input type="text" name="radix" class="req-notnull req-numeric" value="{$radix}" /></p><p>&nbsp;</p>
                    </td>
                </tr>
                <tr height="30px">
                    <td >
                        养老<input type="checkbox" name="pension" value="1" {if $pension  eq '1'}  checked{/if} />
                    </td>
                    <td colspan="3">
                        <p>医疗{html_radios  name=hospitalization options=$hospitalization checked=$s_hospitalization} </p>
                    </td>
                </tr>
                <tr height="30px">
                    <td >
                        工伤<input type="checkbox" name="employmentInjury" value="1" {if $employmentInjury  eq '1'} checked{/if} />
                    </td>
                    <td >
                        失业<input type="checkbox" name="unemployment" value="1" {if $unemployment  eq '1'}  checked{/if} />
                    </td>
                    <td >
                        残障金<input type="checkbox" name="PDIns" value="1" {if $PDIns  eq '1'}  checked{/if} />
                    </td>
                    <td >
                        利手{html_radios  name=hand options=$hand checked=1 checked=$s_hand}
                    </td>
                </tr>
            </table>
            </fieldset>
            <fieldset>
            <legend><code>员工的保险信息</code></legend>
            <table width="100%">            
              <tr height="30px">
              <td>公积金启用日期</td>
              <td><input type="text" class="req-date" name="HFBuyDate" value="{$HFBuyDate}" />
              <input type="hidden"  name="housingFund" value="{$housingFund}" />
              </td>
              <td>公积金更改日期<span class="red">*</span></td>
              <td>{$HFModifyDate}</td>
               <td >个人公积金号 </td>
               <td><input type="text" name="HFID" class="req-numeric" value="{$HFID}" /></td>
               </tr>
               <tr>
               <td>基数</td>
               <td><input type="text" name="HFRadix" class="req-numeric" value="{$HFRadix}" /></td>
                <td>个人比例</td>
               <td><input type="text" name="pHFPer" class="req-numeric" value="{$pHFPer}" /></td>
                <td>单位比例</td>
               <td><input type="text" name="uHFPer" class="req-numeric" value="{$uHFPer}" /></td>
               
              </tr>
              </table>
               </fieldset>
            <table width="100%" border="0">
                <tr>
                    <td height="30">
                        <strong>备注</strong>
                    </td>
                    <td  height="30"><strong>修改备注</strong></td>
                </tr>
                <tr>
                    <td>
                        <textarea name= "remarks" cols="50" rows="5">{$remarks}</textarea>
                    </td>
                    <td>
                        <textarea name= "modifyRemarks"  class="req-string"  cols="50" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td height="50">
                        <input type="button" name="wUP" value="更新" {$smarty.get.update|default:"disabled"}>
                    </td>
                </tr>
            </table>
            
            <div id="errorDiv" class="error-div-alternative">
            </div>
        </form>
    </div>
    {include file="footer.tpl"}