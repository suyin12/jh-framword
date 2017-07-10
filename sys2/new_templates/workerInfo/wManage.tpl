{include file="header.tpl"}
<script type="text/javascript" src='{$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js'></script>
<script type="text/javascript" src='{$httpPath}lib/js/jquery.datepick.js' ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$httpPath}lib/js/general.js"></script>
<script type="text/javascript" src='{$httpPath}lib/js/jquery.jeditable.js'></script>
{literal}

    <script type="text/javascript">
    $(document).ready(function(){

            $(".date").datepick();
                        //修改员工信息
            $(".editTd").editable("wSql.php", {
                    type: "text",
                    submit: "确定",
                    width: "10",
                    submitdata: function(){
                        var ID = $(this).attr("title");                        
                        return { 
                            ID:ID,					
                            btn: "wChangeBtn"
                        };
                    },
                    event: "click",
                    onblur: "cancel",
                    placeholder: "",
                    ajaxoptions: {
                        dataType: "json"
                    }
                });
                      //修改离职信息
               $(".editDimissionTd").editable("wSql.php", {
                    type: "text",
                    submit: "确定",
                    width: "10",
                    submitdata: function(){
                        var ID = $(this).attr("title");                        
                        return { 
                            ID:ID,					
                            btn: "wDimissionChangeBtn"
                        };
                    },
                    event: "click",
                    onblur: "cancel",
                    placeholder: "",
                    ajaxoptions: {
                        dataType: "json"
                    }
                });
            $("input[name=dimission]").click(function(){
                    successFun = function(){
                                    var formName = "dimissionForm";
                                    var t,u,d,dt,m;
                                    t = "post";
                                    u = "wDimission.php";
                                    d = $("#" + formName).serialize() + "&dimission=dimissionForm&btn=" + 
                                            $("#" + formName + ":button").attr("name");
                                    dt = "json";
                                    m = function(json){
                                            var i,n;
                                            $.each(json,function(i,n){
                                                    switch(i)
                                                    {
                                                    case "error":
                                                            alert(n);
                                                            break;
                                                    case "error2":
                                                            alert(n);
                                                            break;						

                                                    case "success":
                                                            alert(n);
                                                            window.location.reload();
                                                            break;
                                                    }
                                            });
                                    };
                                    if((ret = confirm("确认要为该员工办理离职么？"))== true)
                                    {
                                            ajaxAction(t,u,d,dt,m);
                                    }
                                    else
                                            return false;
                            };
                    validator("input[name=dimission]","#dimissionForm","#errorDiv",successFun);
            });

            $("#hideShow").click(function(){
                            $("#hideArea").toggle("slow");
            });

            // 复职
            $("input[name=reEntry]").click(function(){
                    var t,u,d,dt,m;
                    t = "post";
                    u = "wSql.php";
                    d = "uid=" + $("input[name=oldUID]").val();
                    dt = "json";
                    m = function(json){
                            var i,n;
                            $.each(json,function(i,n){
                                    switch(i)
                                    {
                                    case "error":
                                    case "error2":
                                    case "error3":	
                                            alert(n);
                                            break;
                                    case "fatal":
                                            alert(n);
                                            break;
                                    case "success":
                                            window.location.href = "wPersonInfo.php?uID=" + $("input[name=oldUID]").val() + "&update=true";
                                            break;
                                    }
                            });
                    };

                    if(confirm("确认要为该员工复职？")== true)
                    {
                            ajaxAction(t,u,d+"&btn=reentry" ,dt,m);
                    }
		
            });

    });
    </script>
{/literal}
<div id="main">
    <fieldset>
    <p>
        <!-- 更新的时候form  disable=flase 查看时 disable=true -->
        <input type="hidden" name="oldUID" value={$uID}>
        <input type="hidden" name="oldUnitID" value={$s_unitID}>
    </p>
    <fieldset>
        <legend><code>单位属性</code></legend>
        <table width="100%">
            <tr>
                <td>员工编号</td>
                <td >{$uID}</td>
                <td >在职状态</td>
                <td >{if $s_status eq 1 }在职
                    {elseif $s_status eq 2}入职手续办理中
                        {elseif  $s_status eq 0}离职<input type="button" name="reEntry" value="复职" />
                            {else}未知状态{/if}</td>
                 <td >员工类型<span class="red">*</span></td>
                 <td >{$type.$s_type}</td>
                 <td >修改人</td>
                 <td >{$sponsorName}</td>
                 <td >修改时间</td>
                 <td >{$lastModifyDate}</td>
                 <td >修改备注</td>
                 <td >{$modifyRemarks|truncate:40:"......等":true}</td>
             </tr>
         </table>
     </fieldset>
                    <fieldset>
                        <legend><code>员工的基本信息</code></legend>
                        <table width="100%">
                            <tr>
                                <td>姓名<span class="red">*</span></td>
                                <td class="editTd" title="{$uID}|name" >{$name}</td>
                                <td>身份证号码<span class="red">*</span></td>
                                <td class="editTd" title="{$uID}|pID" >{$pID}</td>
                                <td> 开户银行</td>
                               <td class="editTd" title="{$uID}|blank" >{$blank}</td>
                                <td>工资账号</td>
                                <td class="editTd" title="{$uID}|bID" >{$bID}</td>
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
                    </fieldset>
                                 <a id="hideShow" class="noSub">显示/隐藏详细 </a>
                                 <a class="noSub positive" href='wPersonInfo.php?uID={$uID}&update=true'> 编辑</a>  
                                 <a class="noSub positive" href="{$httpPath}feeAdvancedManage/prsMoney.php?uID={$uID}">欠/挂查询</a>  
                                 <a class="noSub positive" href="{$httpPath}agencyService/residentialCardCreate.php?id={$uID}">办理居住证[{if $paper_status eq null}无记录{else}{$paper_status|replace:"1":"已申请"|replace:"2":"办理中..."|replace:"3":"办理中..."|replace:"4":"已办好"}{/if}]</a>
                    <div id="hideArea" style="display:none;">
                        <fieldset>
                            <legend><code>员工的详细信息</code></legend>
                            <table  width="100%">
                                <tr height="30px">
                                    <td >移动电话</td>
                                    <td class="editTd" title="{$uID}|mobilePhone" >{$mobilePhone}</td>
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
                                    <td>毕业年月</td>
                                    <td>{$dateOfGraduation}</td>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                                    {foreach name=foo from=$wInfoExtraField item=val key=key}
                                      {if $smarty.foreach.foo.iteration%5 eq '0' }
                                      </tr><tr height="30px">
	                                      {switch $key}
	                                      {case "spID"}
	                                      <td>{$val}</td>
	                                       <td   class="editTd" title="{$uID}|{$key}">{$wInfoExtraFieldVal.$key}</td>
	                                      {/case}
	                                      {default}
	                                      <td>{$val}</td>
	                                       <td>{$wInfoExtraFieldVal.$key}</td>
	                                      {/default}
	                                      {/switch}
                                     {else}
	                                     {switch $key}
	                                      {case "spID"}
	                                      <td>{$val}</td>
	                                       <td class="editTd" title="{$uID}|{$key}">{$wInfoExtraFieldVal.$key}</td>
	                                      {/case}
	                                      {default}
	                                      <td>{$val}</td>
	                                       <td>{$wInfoExtraFieldVal.$key}</td>
	                                      {/default}
	                                      {/switch}
                                    {/if}
                                     {/foreach}  
                                </tr>
                                <tr>
					                <td >  
					          	  数码图像号
					                    </td>
					                     <td>{$photoID}</td>
					                     <td>
					                     就业登记日期
					                    </td>
					                     <td>{$jobRegModifyDate}</td>
					                </tr>
                            </table>
                        </fieldset>            
                        <fieldset>
                            <legend><code>员工的合同信息</code></legend>
                            <table width="100%">
                                <tr>
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
                                <tr>
                                    <td>互助会</td>
                                    <td><input type="checkbox" name="helpCost" value="1" {if $helpCost eq 1}  checked{/if}></td>
                                    <td>商保</td>
                                    <td> <input type="checkbox" name="comInsurance" value="1" {if $comInsurance  eq 1}  checked{/if}></td>
                                    <td>管理费<span class="red">*</span></td>
                                    <td> {$managementCost}</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </fieldset>            
                        <fieldset>
                            <legend><code>员工的保险信息</code></legend>
                            <table width="100%">
                                <tr>
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
                                <tr>
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
                            </table>
                        </fieldset>            
                        <fieldset>
                            <legend><code>员工住房公积金信息</code></legend>
                            <table width="100%">
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
                        </fieldset>            
                        <fieldset>
                            <legend><code>备注</code></legend>
                            <table width="100%" border="0">
                                <tr>
                                    <td>
                                        <textarea name= "remarks" cols="50" rows="5">{$remarks}</textarea>
                                    </td>
                                </tr>
                            </table>
                    </div>   


                    <form id="dimissionForm" method="post" class="form" >
                        <table  width="100%">

                            <tr>
                                <td height="30" colspan="8" bgcolor="#EFEFEF"> <p><strong>员工离职办理</strong></p></td>
                            </tr>
                            <tr>
                                 <td>离职日期<span class="red" >*</span></td>
                                <td>&nbsp;&nbsp;离职原因<span class="red">*</span></td>
                                <td>社保封停日期(默认今天)</td>
                                <td>封存公积金日期(默认今天)<td>    
                                <td>离职备注</td>
                            </tr>
                            <tr>
                                <td> <input type="hidden" name="uID" id="uID" value={$uID}  />
                                <input type="text" name="dimissionDate"  class="date req-string req-date date" value='' /></td>
                                <td><input type="radio" name="dimissionType" id="dimissionType" value="1" checked  />1 主动离职&nbsp;&nbsp;
                                    <input type="radio" name="dimissionType" value="2"   />2 被辞退</td>
                                <td> <input type="text" name="soInsModifyDate"  class="date req-string req-date date" value='{$today}' /><td
                                <td> <input type="text" name="HFModifyDate"  class="date req-string req-date date" value='{$today}' /><td>    
                                <td ><textArea rows="3" cols="20" name="dimissionReason" id="dimissionReason" ></textArea></td>
                                <td><input type="button" name="dimission" value="确定离职" />  </td>         
                            </tr>
                            {if $dimissionRecord}    
                                <tr>
                                    <td height="30" colspan="8" bgcolor="#EFEFEF"> <p><strong>离职记录</strong></p></td>
                                </tr>
                                <tr>
                                <table class="myTable">
                                    <tr>
                                        <th>上次入职日期</th>
                                        <th>上次入职单位</th>
                                        <th>离职日期</th>
                                        <th>离职原因</th>
                                        <th>离职备注</th>
                                        <th>办理时间</th>
                                        <th>办理人</th>
                                    </tr>
                                    {foreach name=rfoo item=r from=$dimissionRecord}


                                        <tr>
                                            <td>{$r.entryDate}</td>
                                            <td>{$unitAll[$r.lastUnitID].unitName}</td>
                                            <td {if $smarty.foreach.rfoo.index eq '0'}class="editDimissionTd"  title="{$r.uID}|dimissionDate|{$r.ID}"{/if} >{$r.dimissionDate}</td>
                                            <td>{$r.dimissionReason|replace:"1":"主动离职"|replace:"2":"被辞退"}</td>
                                            <td>{$r.dimissionRemarks}</td>
                                            <td>{$r.createdOn}</td>
                                            <td>{$r.mName}</td>
                                        </tr>
                                        {foreachelse}
                                            <td colspan="6">无离职记录</td>
                                            {/foreach}
                                            </table>

                                            </tr>
                                            {/if}
                                                {if $hisRet}
                                                    <tr>
                                                        <td height="30" colspan="8" bgcolor="#EFEFEF">   <p><strong>员工修改历史记录</strong></p></p></td>
                                                    </tr>

                                                    <table class="myTable">
                                                        <tr>
                                                            <th>操作人</th>
                                                            <th>操作时间</th>
                                                            <th>修改备注</th>
                                                            <th>查看详情</th>
                                                        </tr>
                                                        {foreach from=$hisRet item=val}
                                                            <tr>
                                                                <td>
                                                                    {$val.sponsorName}
                                                                </td>
                                                                <td>
                                                                    {$val.lastModifyDate}
                                                                </td>
                                                                <td> {$val.modifyRemarks|truncate:70:"......等":true}</td>
                                                                <td><a href="wPersonInfoList.php?uID={$val.uID}&lastModifyTime={$val.lastModifyDate}">查看详情</a></td>
                                                            </tr>
                                                        {/foreach}
                                                    </table>  
                                                {/if}
                                                <tr>
                                                <div id="errorDiv" class="error-div-alternative"></div>
                                                </tr>
                                            </table> 
                                        </form>
                                    </table>
                                </fieldset>  
                                </fieldset>
                            </div>

                            {include file="footer.tpl"}