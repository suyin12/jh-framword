{include file="header.tpl"}
<div id="main">
    <fieldset>
        <p>
            <!-- 更新的时候form  disable=flase 查看时 disable=true -->
            <input type="hidden" name="oldUID" value={$uID}>
            <input type="hidden" name="oldUnitID" value={$s_unitID}>
        </p>
        <table width="100%" border="0">
            <table width="100%" height="150">
                <tr>
                    <td width="4%">员工编号</td>
                    <td width="14%">{$uID}</td>
                    <td width="11%">在职状态:<span class="red">*</span></td>
                    <td width="21%">{if $s_status eq 1 }在职
                        {elseif $s_status eq 2}入职手续办理中
                            {elseif  $s_status eq 0}离职<input type="button" name="reEntry" value="复职" />
                                {else}未知状态{/if}</td>
                                    <td width="6%">员工类型<span class="red">*</span></td>
                                    <td width="10%">{$type.$s_type}</td>
                                    <td width="6%">&nbsp;</td>
                                    <td width="28%">&nbsp;</td>
                                </tr>

                                <tr>
                                    <td height="30" colspan="8" bgcolor="#EFEFEF"> <p><strong>

                                                员工的基本信息</strong></p></td>
                                </tr>
                                <tr>
                                    <td>姓名<span class="red">*</span></td>
                                    <td>{$name}</td>
                                    <td>身份证号码<span class="red">*</span></td>
                                    <td>{$pID}</td>
                                    <td> 开户银行</td>
                                    <td>{$blank}</td>
                                    <td>工资账号</td>
                                    <td>{$bID}</td>
                                </tr>
                                <tr>
                                    <td>单位<span class="red">*</span></td>
                                    <td>{$unitName}</td>
                                    <td>分公司<span class="red">*</span></td>
                                    <td>{$filiale}</td>
                                    <td>部门<span class="red">*</span></td>
                                    <td>{$department}</td>
                                    <td>岗位</td>
                                    <td>{$station}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <div >
                                <table width="100%" height="400">
                                    <tr>
                                        <td height="30" colspan="14" bgcolor="#EFEFEF">
                                            <p><strong>员工的详细信息</strong>	</p>
                                        </td>
                                    </tr>
                                    <tr height="30px">
                                        <td >移动电话</td>
                                        <td >{$mobilePhone}</td>
                                        <td >固定电话</td>
                                        <td >{$telephone}</td>
                                        <td >联系人</td>
                                        <td >{$contact}</td>
                                        <td >联系电话</td>
                                        <td >{$contactPhone}</td>
                                    </tr>
                                    <tr height="30px">
                                        <td>民族</td>
                                        <td>{$nation.$s_nation}</td>
                                        <td>家庭地址</td>
                                        <td>{$homeAddress}</td>
                                        <td>现居住地地址</td>
                                        <td>{$workAddress}</td>
                                        <td>学校</td>
                                        <td>{$school}</td>
                                    </tr>
                                    <tr height="30px">
                                        <td>性别</td>
                                        <td>{$sex.$s_sex}</td>
                                        <td>政治面貌</td>
                                        <td>{$role.$s_role}</td>
                                        <td>最高学历</td>
                                        <td>{$education.$s_education}</td>
                                        <td>
					                        毕业年月
					                    </td>
					                    <td>
					                       {$dateOfGraduation}
					                    </td>
                                        <td>婚姻状况</td>
                                        <td>{$marriage.$s_marriage}</td>
                                    </tr>
                                    <tr height="30px">
                                        <td>
                                            配偶姓名
                                        </td>
                                        <td>
                                            {$spouseName}
                                        </td>
                                        <td>
                                            配偶身份证 
                                        </td>
                                        <td>
                                            {$spousePID}
                                        </td>

                                    </tr>
                                    <tr height="30px">
                                        <td> 
                                            技能等级  <span class="red">*</span></td>
                                        <td>{$proLevel.$s_proLevel}</td>                   
                                        <td >  
                                            职称    <span class="red">*</span>
                                        </td>
                                        <td>{$proTitle.$s_proTitle}</td>                                       
                                        <td >  
                                            广东节育报告单号
                                        </td>
                                        <td>{$birthID}</td> 
                                    </tr>
                                    <tr height="30px">
					                <td >  
					          	  数码图像号
					                    </td>
					                     <td>{$photoID}</td>
					                     <td>
					                     就业登记日期
					                    </td>
					                     <td>{$jobRegModifyDate}</td>
					                </tr>
                                    
                                    <tr height="30px">
				                  {foreach name=foo from=$wInfoExtraField item=val key=key}
				                   {if $smarty.foreach.foo.iteration%5 eq '0' }
				                   </tr><tr height="30px">
				                    <td>{$val}</td>
				                     <td>{$wInfoExtraFieldVal.$key}</td>     
				                      {else}   
				                      <td>{$val}</td>
				                     <td>{$wInfoExtraFieldVal.$key}</td>     
				                     {/if}    
				                     {/foreach}
				                     </tr>
                                    <tr>
                                        <td height="30" colspan="14" bgcolor="#EFEFEF"><p><strong>员工的合同信息</strong></p></td>
                                    </tr>
                                    <tr height="30px">
                                        <td>档案编号<span class="red">*</span></td>
                                        <td>{$dID}</td>
                                        <td>入职日期<span class="red">*</span></td>
                                        <td>{$mountGuardDay}</td>
                                        <td >  
				              	合同类型    
				                    </td>
				                    <td>
				                      <select name="cType" >
				                            {html_options options=$cType  selected=$s_cType}
				                        </select>
				                    </td>
                                        <td>合同起始日期</td>
                                        <td>{$cBeginDay}</td>
                                        <td>合同终止日期</td>
                                        <td>{$cEndDay}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                   <tr height="30px">
                                        <td>互助会</td>
                                        <td><input type="checkbox" name="helpCost" value="1" {if $helpCost eq 1}  checked{/if}></td>
                                        <td>商保</td>
                                        <td> <input type="checkbox" name="comInsurance" value="1" {if $comInsurance  eq 1}  checked{/if}></td>
                                        <td>管理费<span class="red">*</span></td>
                                        <td> {$managementCost}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="30" colspan="8" bgcolor="#EFEFEF"> <p><strong>员工的保险信息</strong></p></td>
                                    </tr>
                                    <tr height="30px">
                                        <td>户籍类型<span class="red">*</span></td>
                                        <td>{$domicile.$s_domicile}</td>
                                        <td>投保日期<span class="red">*</span></td>
                                        <td>{$soInsBuyDate}</td>
                                        <td>社保更改日期<span class="red">*</span>
                                        </td>
                                        <td>
                                            {$soInsModifyDate}
                                        </td>
                                        <td>社保号<span class="red">*</span></td>
                                        <td>{$sID}</td>
                                    </tr>
                                   <tr height="30px">
                                        <td>养老</td>
                                        <td><input type="checkbox" name="pension" value="1" {if $pension  eq 1}  checked{/if}></td>
                                        <td>医疗</td>
                                        <td>{html_radios  name=hospitalization options=$hospitalization checked=$s_hospitalization}</td>
                                        <td>工伤</td>
                                        <td><input type="checkbox" name="employmentInjury" value="1" {if $employmentInjury  eq 1}  checked{/if}></td>
                                        <td>失业</td>
                                        <td><input type="checkbox" name="unemployment" value="1" {if $unemployment  eq 1}  checked{/if}></td>
                                    </tr>
                                    <tr>
                                        <td>残障金</td>
                                        <td><input type="checkbox" name="PDIns" value="1" {if $PDIns  eq 1}  checked{/if}> </td>
                                        <td>利手</td>
                                        <td>{html_radios  name=hand options=$hand checked=1 checked=$s_hand} </td>
                                        <td>基数<span class="red">*</span></td>
                                        <td>{$radix}</td>
                                    </tr>
                                    <tr>
                                        <td height="30" colspan="14" bgcolor="#EFEFEF">
                                            <strong>&nbsp;&nbsp;员工住房公积金信息</strong>
                                        </td>
                                    </tr>
                                    <tr height="30px">
                                        <td>公积金启用日期</td>
                                        <td>{$HFBuyDate}</td>
                                        <td>公积金更改日期<span class="red">*</span></td>
                                        <td>{$HFModifyDate}</td>
                                        <td >个人公积金号 </td>
                                        <td>{$HFID}</td>
                                    </tr>
                                    <tr>
                                        <td>基数</td>
                                        <td>{$HFRadix}</td>
                                        <td>个人比例</td>
                                        <td>{$pHFPer}</td>
                                        <td>单位比例</td>
                                        <td>{$uHFPer}</td>

                                    </tr>
                                </table>

                                <table width="100%" border="0">
                                    <tr>
                                        <td width="471" height="30">
                                            <strong>备注</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea name= "remarks" cols="50" rows="5">{$remarks}</textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>   

                        </table>

                </div>

                {include file="footer.tpl"}