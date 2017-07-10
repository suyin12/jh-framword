{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=rCardCreate]").click(function(){
				
					var t,u,d,dt,m;
					t = "post";
					u = "aSQL.php";
					d = $("#rCardCreateForm").serialize();
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
							ajaxAction(t,u,d + "&btn=rCardCreate",dt,m);
						};
						
					validator("input[name=rCardCreate]","#rCardCreateForm","#errorDiv",successfunc);
					
			});

			$("input[name=cDate]").datepick();
			$("input[name=rDate]").datepick();
			$("input[name=conStart]").datepick();
			$("input[name=conEnd]").datepick();
			$("input[name=curUnitStart]").datepick();
			
			$("#planBirth").change(function(){
				var v = $("#planBirth option:selected").val();
				if( v == 0)
					$("input[name=reportNum]").attr("disabled","disabled").attr("value","无");
				else
					$("input[name=reportNum]").attr("disabled","").attr("value","");
			});

			

	

});
</script>

{/literal}
<div id="main">

<form id="rCardCreateForm" class="form">
姓名<input type="text" name="name" class="req-string" value="{$worker.name}"/>
曾用名<input type="text" name="oldname" />
性别<select name="sex" class="req-string"><option value="">--请选择--</option>{html_options options=$c_sex selected=$worker.sex}</select>
民族<select name="nation" class="req-string"><option value="">--请选择--</option>{html_options options=$c_nation selected=$worker.nation}</select>  <br /><br />
身份证号码<input type="text" name="idcard" style="width:200px" class="req-string" value="{$worker.pID}"/> 
社保号<input type="text" name="solNumber" value="{$worker.sID}" />
婚姻状况<select name="marriage" class="req-string"><option value="">--请选择--</option>{html_options options=$c_marriage selected=$worker.marriage}</select>
政治面貌<select name="politics" class="req-string"><option value="">--请选择--</option>{html_options options=$c_politics selected=$worker.role}</select>  <br /><br />
户籍地址<input type="text" name="hkAddr" style="width:400px" class="req-string" value="{$worker.homeAddress}"/>
户籍地址类型<select name="hkAddrType" class="req-string"><option value="">--请选择--</option>{html_options options=$c_hukouAddressType}</select>  <br /><br />
数码照相图像号<input type="text" name="picNumber" value="{$worker.photoID}" class="req-string"/>
服务处所全称<input type="text" name="location" style="width:200px" value="罗湖"/>
工资<input type="text" name="salary" class="req-string" value="{$worker.radix}"/>  <br /><br />
文化程度<select name="education" class="req-string"><option value="">--请选择--</option>{html_options options=$c_education selected=$worker.education}</select>
职称<select name="title" class="req-string"><option value="">--请选择--</option>{html_options options=$c_title selected=$worker.proTitle}</select>
职业技能等级<select name="level" class="req-string"><option value="">--请选择--</option>{html_options options=$c_skillLevel selected=$worker.proLevel}</select>
就业类型<select name="employmentType" class="req-string"><option value="">--请选择--</option>{html_options options=$c_employmentType selected=5}</select>  <br /><br />
合同起始日期<input type="text" name="conStart" class="req-string" value="{$worker.cBeginDay}"/>
合同终止日期<input type="text" name="conEnd" class="req-string" value="{$worker.cEndDay}"/>
本单位工作起始日期<input type="text" name="curUnitStart" class="req-string" value="{$worker.cBeginDay}"/> 
参加工作时间<input type="text" name="beginWork" value="{$worker.cBeginDay}"/><br /><br />
<br />
广东省流动人口避孕节育情况报告单 <select name="planBirth" id="planBirth" class="req-string"><option value="">--请选择--</option>{html_options options=$c_planBirthReport selected=0}</select>
报告单编号<input type="text" name="reportNum"   value="{$worker.birthID}"/> <br /><br />
<br />
现居住地址<input type="text" name="rAddr" style="width:400px" value="" class="req-string"/>
 <br /><br />
房屋地址信息编码<input type="text" name="houseNum" style="width:300px"  class="req-string" /> <br /><br />
来深居住事由<select name="comeReason" class="req-string"><option value="">--请选择--</option>{html_options options=$c_comereason selected=1}</select>
住所类别<select name="houseType"  class="req-string"><option value="">--请选择--</option>{html_options options=$c_houseType selected=3}</select> 
居住方式<select name="rType"  class="req-string"><option value="">--请选择--</option>{html_options options=$c_residentialType selected=4}</select> 
来深日期<input type="text" name="cDate"  class="req-string" value="{$worker.cBeginDay}"/> <br /><br />

入住日期<input type="text" name="rDate"  class="req-string" value="{$worker.cBeginDay}"/> 
本人移动电话<input type="text" name="mobile" value="{$worker.mobilePhone}" class="req-string"/>
本人固定电话<input type="text" name="tele" value="{$worker.telephone}" />  <br /><br />
紧急人姓名<input type="text" name="uname" value="{$worker.contact}"/>
紧急人移动电话<input type="text" name="umobile" value="{$worker.contactPhone}"/>
紧急人固定电话<input type="text" name="utele" /> <br /><br />
<br />
是否是首次申领<select name="firstApp" class="req-string"><option value="">--请选择--</option>{html_options options=$c_firstApp}</select>&nbsp;&nbsp;
<input type="button" name="rCardCreate" value="确定" /><input type="reset" />

<div id="errorDiv" class="error-div-alternative"></div>

</form>
</body>
</div>
{include file="footer.tpl"}