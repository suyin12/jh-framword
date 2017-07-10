{include file="header.tpl"}
<script type="text/javascript" src='{$httpPath}lib/js/jquery.datepick.js' ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
   	 		var id=$("input[name=id]").val();
   	 		//办理社保、公积金的停交
            $("input[name=modify]").click(function(){
            	var soInsModifyDate=$("input[name=soInsModifyDate]").val();
            	var HFModifyDate=$("input[name=HFModifyDate]").val();
            	var status = $("input[name=status]").val();
            	if(status == 0){
            		confirm("该人员已经停交");
                }else{
	                if((ret = confirm("社保封停日期　　　公积金封停日期\n"+soInsModifyDate+"　　　 "+HFModifyDate+""))== true)
	                {
		                $.ajax({
			                url:"aSQL.php",
			                data:"id="+id+"&soInsModifyDate="+soInsModifyDate+"&HFModifyDate="+HFModifyDate+"&btn=modify",
			                type:'POST',
			                dataType:'text',
			                success:function(re){
				                alert(re);
				                window.location.reload();
			                }
			            });
		            }
		            else
	               return false;
                }
            });
            $("#hideShow").click(function(){
            	$("#hideArea").toggle("slow");
            });
            $("input[name=reEntry]").click(function(){
                if(confirm("确认要为他恢复社保正常？")== true)
                {
                	$.ajax({
    	                url:"aSQL.php",
    	                data:"id=" + $("input[name=id]").val() + "&btn=reentry",
    	                type:'POST',
    	                dataType:'json',
    	                success:function(json){
    	           			var i,n;
    	                    $.each(json,function(i,n){
    	                    	switch(i)
    	                    	{
    							case "error":
    	                        	alert(n);
    	                        	break;
    	                        case "succ":
    	                        	alert(n);
    	                        	window.location.href = "aUpdateManage.php?id=" + $("input[name=id]").val();
    	                            break;
    	                        }
    	                    });
    	                }
    	            });
                }
        	});
            $(".date").datepick();
    });
    </script>
{/literal}
<div id="main">
    <fieldset>
    <fieldset>
        <legend><code>个人属性</code></legend>
        <table width="100%">
            <tr height="40px">
                <td class="PerInfoWidth">社保号</td>
                <td>{$sID}</td>
                <td>缴费情况</td> 
                <td>{$status.$s_status}{if  $s_status eq 0}<input type="button" name="reEntry" value="恢复"/>{/if}</td>
                <td>修改人</td>
                <td>{$lastModifyBy}</td>
                <td>修改时间</td>
                <td>{$lastModifyTime}</td>
                <td>修改备注</td>
                <td>{$modifyRemarks|truncate:40:"......等":true}</td>
             </tr>
         </table>
     </fieldset>
     <fieldset>
         <legend><code>参保人员的基本信息</code></legend>
          <table width="100%">
            <tr height="40px">
                <td class="PerInfoWidth">姓名<span class="red">*</span></td>
                <td>{$name}</td>
                <td>性别<span class="red">*</span></td> 
                <td>{$sex.$s_sex}</td>
            	<td>身份证<span class="red">*</span></td>
                <td>{$pID}</td>
                <td>档案号</td>
				<td>{$dID}<input type="hidden" name="dID" value="{$dID}"/></td>
             </tr>
             <tr height="40px">
				<td>联系电话<span class="red">*</span></td>
            	<td>{$mobilePhone}</td>
				<td>银行账号</td>
                <td>{$bID}</td>
            	<td>开户银行</td>
            	<td>{$bank}</td>
				<td>家庭地址</td>
                <td>{$homeAddress}</td>
             </tr>
             <tr height="40px">
             <td> 婚姻状况  <span class="red">*</span></td>
                <td>
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
           <a id="hideShow" class="noSub">显示/隐藏详细 </a>
           <a class="noSub positive" href='aUpdateManage.php?id={$id}'> 编辑</a>  
           <a class="noSub positive" href="{$httpPath}agencyService/agreeMent.php?id={$id}&A=true" target="_blank">生成社保协议</a>
		   <a class="noSub positive" href="{$httpPath}agencyService/agreeMent.php?id={$id}&B=true" target="_blank">生成公积金协议</a>
		   <a class="noSub positive" id="late" href='agMLateList.php?fID={$id}&paydate={$paydate}' target="_blank"> 补缴</a> 
			余额：<span id="remains">{$remains}</span>&nbsp;
			<a class="noSub positive"  href="{$httpPath}agencyService/agMPayList.php?id={$id}">续费</a>
    <div id="hideArea" style="display:none;">
   		 <fieldset>
			<legend>
				<code>参加保险信息</code>
			</legend>
			<table width="100%">
			 <tr height="40px">
			 	<td class="PerInfoWidth">购买日期<span class="red">*</span></td>
                <td>{if $soInsBuyDate=="0000-00-00"}{else}{$soInsBuyDate}{/if}</td>
                <td>有效期限<span class="red">*</span></td>
                <td>{if $cBeginDay=="0000-00-00"}{else}{$cBeginDay}{/if}至{if $cEndDay=="0000-00-00"}{else}{$cEndDay}{/if}</td>
                <td>社保号电脑号<span class="red">*</span></td>
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
                 <td>个人公积金号</td>
                 <td>{$HFID}</td>
                 <td>基数　　　</td>
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
	</div>   
        <form id="modifyForm" method="post" class="form" >
           <table  width="30%">
	           <tr>
	               <td height="30" colspan="3" bgcolor="#EFEFEF"><p><strong>社保、公积金停交办理</strong></p></td>
	           </tr>
	           <tr>
		           <td>社保封停日期</td>
		           <td>公积金封停日期</td>
		           <td>操作</td>
	           </tr>
	           <tr>
		           <td><input type="hidden" name="id" id="id" value={$id}><input type="hidden" name="status" id="status" value={$s_status}>
					   <input type="text" name="soInsModifyDate"  class="req-string date" value='{if $s_status=="0"}{$soInsModifyDate}{else}{$today}{/if}'/></td>
		           <td><input type="text" name="HFModifyDate"  class="req-string date" value='{if $s_status=="0"}{$HFModifyDate}{else}{$today}{/if}'/></td>
		           <td><input type="button" name="modify" value="确定" /></td>         
	           </tr>
	           <tr>
	               <td height="30" colspan="4" bgcolor="#EFEFEF"><p><strong>员工修改历史记录</strong></p></td>
	           </tr>
	           <table class="myTable">
				   <tr>
					   <th>操作人</th>
					   <th>操作时间</th>
					   <th>修改备注</th>
					   <th>查看详情</th>
				   </tr>
				   {foreach from=$hisRet item=h}
				   <tr>
					   <td>{$h.lastModifyBy}</td>
					   <td>{$h.lastModifyTime}</td>
					   <td>{$h.modifyRemarks|truncate:70:"......等":true}</td>
					   <td><a href="aPersonInfoList.php?id={$h.id}&lastModifyTime={$h.lastModifyTime}">查看详情</a></td>
				   </tr>
				   {/foreach}
	           </table>  
           </table> 
		</form>
</fieldset>  
</div>
{include file="footer.tpl"}