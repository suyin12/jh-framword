{include file="header.tpl"}
<div id="main">
    <fieldset>
	    <fieldset>
	         <legend><code>个人基本信息</code></legend>
	          <table width="100%">
	            <tr height="40px">
	                <td class="PerInfoWidth">姓名<span class="red">*</span></td>
	                <td>{$name}</td>
	                <td>状态</td> 
	                <td>{$status.$s_status}</td>
	                <td>性别<span class="red">*</span></td> 
	                <td>{$sex.$s_sex}</td>
	            	<td>身份证<span class="red">*</span></td>
	                <td>{$pID}</td>
					<td>档案编号<span class="red">*</span></td>
	                <td>{$dID}</td>
	             </tr>
	             <tr height="40px">
					<td>联系电话<span class="red">*</span></td>
	            	<td>{$mobilePhone}</td>
					<td>银行账号</td>
	                <td>{$bID}</td>
	            	<td>开户银行</td>
	            	<td>{$bank}</td>
					<td>快递地址</td>
	                <td>{$homeAddress}</td>
	             </tr>
	              <tr height="40px">
             <td> 婚姻状况  <span class="red">*</span></td>
                <td >
                    {$marriage.$s_marriage}
                </td>         
           		<td>
                     配偶姓名
                </td>
                <td>
                    {$spouseName}
                </td>
                <td>
                        联系电话 
                </td>
                <td>
                   {$telephone}
                </td>
                <td>
                     配偶身份证 
                </td>
                <td>
                   {$spousePID}
                </td>
             </tr>
             <tr height="40px">
            	<td>最高学历<span class="red">*</span></td>
                <td>
                   {$education.$s_education}
                </td>
                <td>
				 技能等级  <span class="red">*</span>
                </td>
                <td>
                    {$proLevel.$s_proLevel}
                </td>                   
                <td >  
          	  	职称    <span class="red">*</span>
                </td>
                <td>
                    {$proTitle.$s_proTitle}
                </td>
                <td>工作地址</td>
	            <td>{$workAddress}</td>
             </tr>
			</table>
	     </fieldset>
   		 <fieldset>
			<legend>
				<code>参加保险信息</code>
			</legend>
			<table width="100%">
			 <tr height="40px">
			 	<td class="PerInfoWidth">购买日期<span class="red">*</span></td>
               <td>{if $soInsBuyDate=="0000-00-00"}{else}{$soInsBuyDate}{/if}</td>
                <td>社保封停日期</td>
                <td>{if $soInsModifyDate=="0000-00-00"}{else}{$soInsModifyDate}{/if}</td>
                <td>有效期限<span class="red">*</span></td>
                <td>{if $cBeginDay=="0000-00-00"}{else}{$cBeginDay}{/if}至{if $cEndDay=="0000-00-00"}{else}{$cEndDay}{/if}</td>
                <td>社保电脑号</td>
                <td>{$sID}</td>
             </tr>
             <tr height="40px">
                <td>管理费<span class="red">*</span></td>
                <td>{if $managementCost=="0"}免{else}{$managementCost}{/if}</td>
                <td>缴交基数<span class="red">*</span></td>
                <td>{$radix}</td>
                <td>户籍类型<span class="red">*</span></td>
                <td>{$domicile.$s_domicile}</td>
                <td>医疗<span class="red">*</span></td>
                <td>{$hospitalization.$s_hospitalization}</td>
             </tr>
             <tr height="40px">
                <td>养老<span class="red">*</span>
                <input type="checkbox" name="pension" {if $pension eq 1}  checked{/if}/></td>
                <td>工伤<span class="red">*</span>
                <input type="checkbox" name="employmentInjury" {if $employmentInjury eq 1}  checked{/if}/></td>
                <td>失业<span class="red">*</span>
                <input type="checkbox" name="unemployment" {if $unemployment eq 1}  checked{/if}/></td>
                <td>残障险<input type="checkbox" name="PDIns" {if $PDIns eq 1}  checked{/if}/></td>
             </tr>
        </table>
		</fieldset>
		<fieldset>
             <legend><code>公积金信息</code></legend>
             <table width="100%">
               <tr height="40px">
                 <td>公积金启用日期</td>
                 <td>{if $HFBuyDate=="0000-00-00"}{else}{$HFBuyDate}{/if}</td>
                 <td>公积金封停日期</td>
                 <td>{if $HFModifyDate=="0000-00-00"}{else}{$HFModifyDate}{/if}</td>
                 <td>个人公积金号 </td>
                 <td>{$HFID}</td>
                 <td>基数</td>
                 <td>{$HFRadix}</td>
                 <td>有效期限　　　</td>
                 <td>{if $hBeginDay=="0000-00-00"}{else}{$hBeginDay}{/if}至{if $hEndDay=="0000-00-00"}{else}{$hEndDay}{/if}</td>
                 <td>单位比例　　　</td>
                 <td>{$uHFPer}</td>
                 <td>个人比例　　　</td>
                 <td>{$pHFPer}</td>
			   </tr>
             </table>
          </fieldset>
          <fieldset>
             <table width="100%">
              	<tr height="40px">
              		<td class="PerInfoWidth"><strong>关系来源</strong></td>
              		<td><input type="text" name="relationalName" class="halfWidth" value="{$relationalName}"/></td>
              	</tr>
            	<tr height="40px">
              		<td><strong>备　　注</strong></td>
              		<td><textarea name= "remarks" class="halfWidth" rows="5">{$remarks}</textarea></td>
              	</tr>
             </table>
         </fieldset>        
</fieldset>  
</div>
{include file="footer.tpl"}