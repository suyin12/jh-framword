{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/post.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="main">
       <!-- 更新的时候form  disable=flase 查看时 disable=true -->
        <form method="post" class="form" id="wUPForm">
            <p><input type="hidden" name="oldUID" value={$uID}>
                    <input type="hidden" name="name" value={$name}>
                    </p>
            <table width="100%" border="0">
                <tr>
                       <td>
                        姓名<span class="red">*</span>
                    </td>
                    <td width="15%">
    {$name}[<a href='wPersonInfo.php?uID={$uID}&update=true'>修改其他信息</a>]
                    </td>
                    <td  height="54">
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
                    </tr>
	<tr>
                         <td >
                        所属单位<span class="red">*</span>
                    </td>
                    <td>
                        <select name="unitID" class="req-string">
    {html_options options=$unit selected = $s_unitID}
                        </select>
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
                    <td>
                        岗位
                    </td>
                    <td>
                        <input type="text" name="station" value="{$station}" />
                    </td>
                </tr>
            </table>
            <table width="100%" height="200" border="0">
                <tr>
                    <td height="30" colspan="8" bgcolor="#EFEFEF">
                        <p><strong>&nbsp;&nbsp;员工的合同信息</strong></p>
                    </td>
                </tr>
                <tr>
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
                <tr>
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
                <tr>
                    <td height="30" colspan="8" bgcolor="#EFEFEF">
                        <p><strong>&nbsp;&nbsp;员工的保险信息 </strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        投保日期<span class="red">*</span>
                    </td>
                    <td>
                        <input type="text" class="req-string req-date" name="soInsBuyDate" value="{$soInsBuyDate}" />
                    </td>
                    <td>
                        基数<span class="red">*</span>
                    </td>
                    <td>
                     <input type="text" name="radix" class="req-notnull req-numeric" value="{$radix}" />
                    </td>
                </tr>
                <tr>
                    <td width="6%" height="6%">
                        养老<input type="checkbox" name="pension" value="1" {if $pension  eq '1'}  checked{/if} />
                    </td>
                    <td height="6%" colspan="3">
                        <p>医疗{html_radios  name=hospitalization options=$hospitalization checked=$s_hospitalization} </p>
                    </td>
                </tr>
                <tr>
                    <td height="6%">
                        工伤<input type="checkbox" name="employmentInjury" value="1" {if $employmentInjury  eq '1'} checked{/if} />
                    </td>
                    <td height="6%">
                        失业<input type="checkbox" name="unemployment" value="1" {if $unemployment  eq '1'}  checked{/if} />
                    </td>
                    <td height="6%">
                        残障金<input type="checkbox" name="PDIns" value="1" {if $PDIns  eq '1'}  checked{/if} />
                    </td>
                    <td height="6%">
                        利手{html_radios  name=hand options=$hand checked=1 checked=$s_hand}
                    </td>
                </tr>
            </table>
            <table width="100%">
              <tr>
               <td height="30" colspan="14" bgcolor="#EFEFEF">
                        <strong>&nbsp;&nbsp;员工住房公积金信息</strong>
               </td>
              </tr>
              <tr height="50px">
              <td>公积金启用日期</td>
              <td><input type="text" class="req-date" name="HFBuyDate" value="{$HFBuyDate}" />
              <input type="hidden"  name="housingFund" value="{$housingFund}" />
              </td>
               <td>基数</td>
               <td><input type="text" name="HFRadix" class="req-numeric" value="{$HFRadix}" /></td>
                <td>个人比例</td>
               <td><input type="text" name="pHFPer" class="req-numeric" value="{$pHFPer}" /></td>
                <td>单位比例</td>
               <td><input type="text" name="uHFPer" class="req-numeric" value="{$uHFPer}" /></td>
               
              </tr>
              </table>       
              <table width="200px" border="0" algin="center">
                <tr>
                    <td height="50">
                        <input type="button" name="wUP" value="保存" >
                    </td>
                    <td>
                       <input type="button" name="feeChange" value="费用转移" onClick="javascript:window.location.href='{$httpPath}feeAdvancedManage/prsMoney.php?uID={$uID}&modify=true'">
                    </td>
                </tr>
            </table>
            <div id="errorDiv" class="error-div-alternative">
            </div>
        </form>
    </div>
    {include file="footer.tpl"}