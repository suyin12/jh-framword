{include file="header.tpl"}
<script type="text/javascript" src='{$httpPath}lib/js/general.js'></script>
<script src="{$httpPath}lib/jquery/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="{$httpPath}lib/js/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript" src="{$httpPath}lib/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="{$httpPath}lib/js/jquery.datepick.js"></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">
$(document).ready(function(){
    //更改员工户籍类型,社保状态随之更改.. aCreateManage.php
    $(":radio[name=domicile]").change(function(){
        var domicileVal = $(this).val();
            switch (domicileVal) {
                //深户,如果是全日制员工默认四险(综合)
                case "1":
                	$(":radio[name=hospitalization]").each(function(i){
          			  switch (i) {
          			  	     case 1:
           			  	    	$(this).attr("checked", true);
                                break;
          			  }
                	});
                	break;
                //非深户,如果是全日制员工默认四险(住院)
                case "2":
                	$(":radio[name=hospitalization]").each(function(i){
          			  switch (i) {
          			  	     case 2:
           			  	    	$(this).attr("checked", true);
                                break;
          			  }
                	});
                	break;
            }
    });
    //参保提交登记
    $("#perInfoForm").validationEngine();
    $("#perInfoForm").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) });
    $("#aCM").click(function(){
		var id=$("input[name=id]").val();
    	var validStatus = $("#perInfoForm").validationEngine('validate');
    	$("#HFID").validationEngine('hide');
    	if(validStatus){
        	 var btnName='aCMinsert';
	         var t, u, d, dt, m;
	         t = "post";
	         u = "aSQL.php";
	         d = $("#perInfoForm").serialize() + "&btn="+btnName;
	         dt = "json";
	         m = function (json) {
	             var i, n, k, v;
	             $.each(json, function (i, n) {
	                 switch (i) {
	                     case "error":
	                         alert(n);
	                         break;
	                     case "succ":
	                    	 if(confirm(n+",是否转到下一步缴费？？")== true)
	                         {
	                    		 window.location.replace("agMPayList.php");
	                         }
	                         break;
	                 }
	             });
	         }
		     //验证社保购买项
	         var vSoIns = validSoIns();
	         if (IsEmpty(vSoIns)) {
	           if (vSoIns != false) 
	               ajaxAction(t, u, d, dt, m);
	         }
	         else {
	               var ret = confirm(vSoIns);
	               if (ret == true) {
	                   ajaxAction(t, u, d, dt, m);
	               }
	         }
        }
        
    });	
    //更改医疗模式,错误:深户购买非一档报错,提示性警告:非深户可购买综合,或合作医疗时
    function validSoIns(){
        var hospitalizationVal = $(":radio[name=hospitalization]:checked").val();
        var domicileVal = $(":radio[name=domicile]:checked").val();
		var emptyHosp = IsEmpty(hospitalizationVal);
        var errMsg;
		if(emptyHosp !=true){
        if (domicileVal == "1" && hospitalizationVal != "1" && hospitalizationVal != "0") {
            errMsg = "深户只能购买一档!!";
            alert(errMsg);
            return false;
        }
        if (domicileVal == "2" && hospitalizationVal != "2" && hospitalizationVal != "0") 
            errMsg = "参保人员为非深户,确定不购买二档?";
		}
        return errMsg;
    }
	//...时间控件和验证控件js代码和加载时间上下顺序要一致，时间在下
	$(".date").datepick();

});
</script>
{/literal}
<div id="main">
<fieldset class="center">
			<legend>
				<code>请填写信息</code>
			</legend>
        <form id="perInfoForm">
        <fieldset>		
        <table width="100%">
        	<input type="hidden" name="id" value="{$id}"/>
            <tr height="40px">
                <td class="PerInfoWidth">姓名<span class="red">*</span></td>
                <td><input type="text" class="validate[required]" name="name"/></td>
                <td>性别<span class="red">*</span></td> 
                <td>
                	<select name="sex">
		                <option value="">------请选择------</option>
		            	{html_options values=$sex_ids output=$sex_names}
            		</select>
            	</td>
            	<td>身份证<span class="red">*</span></td>
                <td><input type="text" name="pID" maxlength="18"  class="validate[required,minSize[15],maxSize[18],ajax[ajaxNameCallPhp]] text-input" data-prompt-position="topRight:-20" id="pID"/></td>
                <td>档案号</td>
				<td>{$dID}<input type="hidden" name="dID" value="{$dID}"/></td>
             </tr>
             <tr height="40px">
				<td>移动电话<span class="red">*</span></td>
            	<td><input type="text" name="mobilePhone"/></td>
				<td>银行账号</td>
                <td><input type="text" name="bID"/></td>
            	<td>开户银行</td>
            	<td><input type="text" name="bank"/></td>
				<td>家庭地址</td>
                <td><input type="text" name="homeAddress"/></td>
             </tr>
             <tr height="40px">
             <td> 婚姻状况  <span class="red">*</span></td>
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
                        联系电话 
                </td>
                <td>
                     <input type="text" name="telephone" value="" />
                </td>
                <td>
                     配偶身份证 
                </td>
                <td>
                     <input type="text" name="spousePID" value="" />
                </td>
             </tr>
             <tr height="40px">
            	<td>最高学历<span class="red">*</span></td>
                <td>
                   <select name="education">
                       {html_options options=$education  selected=61}
                   </select>
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
                <td>工作地址</td>
                <td><input type="text" name="workAddress"/></td>
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
                <td><input type="text" name="soInsBuyDate" class="req-string date" value="{$today}"/></td>
                <td>缴交基数<span class="red">*</span></td>
                <td><input type="text" name="radix" value=""/></td>
                <td>有效期限<span class="red">*</span></td>
                <td><input type="text" name="cBeginDay" class="req-string date" value="{$cBeginDay}" style="width:70px;"/>至<input type="text" name="cEndDay" class="req-string date" value="{$cEndDay}" style="width:70px;"/></td>
                <td>社保号电脑号<span class="red">*</span></td>
                <td><input type="text" name="sID" maxlength="10" class='validate[ajax[ajaxNameCallPhp]]' data-prompt-position="topRight:-50px" id="sID"/></td>
             </tr>
             <tr height="40px">
                <td>管理费<span class="red">*</span></td>
                <td><input type="text" name="managementCost"/></td>
                <td>户籍类型<span class="red">*</span></td>
                <td>{html_radios  name=domicile options=$domicile checked=1}</td>
                <td>医疗<span class="red">*</span></td>
                <td>{html_radios  name=hospitalization options=$hospitalization checked=1}</td>
             </tr>
             <tr height="40px">
                <td>养老<span class="red">*</span><input type="checkbox" name="pension" value="1" checked="checked"/></td>
                <td>工伤<span class="red">*</span><input type="checkbox" name="employmentInjury" value="1" checked="checked"/></td>
                <td>失业<span class="red">*</span><input type="checkbox" name="unemployment" value="1" checked="checked"/></td>
                <td>残障险<input type="checkbox" name="PDIns" value="1" checked="checked"/></td>
             </tr>
        </table>
		</fieldset>
		<fieldset>
             <legend><code>公积金信息</code></legend>
             <table width="100%">
               <tr height="40px">
                 <td class="PerInfoWidth">公积金启用日期</td>
                 <td><input type="text" name="HFBuyDate" class="req-string date" value=""/></td>
                 <td>个人公积金号 </td>
                 <td><input type="text" name="HFID" class="validate[ajax[ajaxNameCallPhp]]" id="HFID"/></td>
                 <td>基数</td>
                 <td><input type="text" name="HFRadix" value=""/></td>
                 <td>有效期限</td>
                 <td><input type="text" name="hBeginDay" class="req-string date"  style="width:70px;"/>至<input type="text" name="hEndDay" class="req-string date" value="" style="width:70px;"/></td>
                 <td>个人比例</td>
                 <td><input type="text" name="pHFPer" value=""/></td>
                 <td>单位比例</td>
                 <td><input type="text" name="uHFPer" value=""/></td>
			   </tr>
             </table>
          </fieldset>
          <fieldset>
             <table width="100%">
              	<tr height="40px">
              		<td class="PerInfoWidth">关系来源<span class="red">*</span></td>
              		<td><input type="text" name="relationalName" class="halfWidth"/></td>
              	</tr>
            	<tr height="40px">
              		<td>备　　注</td>
              		<td><textarea name= "remarks" class="halfWidth" rows="5"></textarea></td>
              	</tr>
             </table>
          </fieldset>
		<button type="button" class="right" id="aCM" >提交</button>		
     </form>
    </fieldset>
</div>
{include file="footer.tpl"}