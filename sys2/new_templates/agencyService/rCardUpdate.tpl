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

		
			$("input[name=rCardUpdate]").click(function(){
				
					var t,u,d,dt,m;
					t = "post";
					u = "aSQL.php";
					d = $("#rCardUpdateForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "error":
										alert(n);
										break;
									case "success":
										if(confirm(n+"，确定将结束添加，取消则继续添加") == true)
										{
											window.close();
										}
										else
										{
											window.location.reload();
										}
										break;
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=rCardUpdate",dt,m);
						};
						
					validator("input[name=rCardUpdate]","#rCardUpdateForm","#errorDiv",successfunc);
					
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
<style>
<!--

.insertForm {
	background:#BBE4D9;
	padding:60px 20px 110px 40px;
	margin-right:400px;
	width:600px;
	height:100px;

}

.insertForm li {
	color:#385065;
	margin-botton:5px;
	margin-top:5px;
	height:50px;
}
.xx {
	width:300px;
	position:absolute;
	left:250px;
	
}

.insertForm li lable {
	font-size:large;
}
.insertFormSubmit {
	background:#BBE4D9;
	padding:20px 20px 20px 40px;
	margin-right:400px;
	width:600px;
}
.insertFormSubmit li {
	margin-left:200px;
	margin-bottom:10px;
		
}

-->
</style>
{/literal}
<div id="main">
<div id="mainBody" class="right">


<form id="rCardUpdateForm" class="form">
<input type="hidden" name="id" value="{$the_paper.id}" />
姓名<input type="text" name="name" class="req-string" value="{$the_paper.name}"/>
曾用名<input type="text" name="oldname" value="{$the_paper.oldname}"/>
性别<select name="sex" class="req-string">{html_options options=$c_sex selected=$the_paper.sex}</select>
民族<select name="nation" class="req-string">{html_options options=$c_nation selected=$the_paper.nation}</select>  <br /><br />
身份证号码<input type="text" name="idcard" style="width:200px" class="req-string" value="{$the_paper.idcard}"/> 
社保号<input type="text" name="solNumber" value="{$the_paper.solNumber}" />


婚姻状况<select name="marriage" class="req-string">{html_options options=$c_marriage selected=$the_paper.marriage}</select>

政治面貌<select name="politics" class="req-string"><option value="">--请选择--</option>{html_options options=$c_politics selected=$the_paper.politics}</select>  <br /><br />
户籍地址<input type="text" name="hkAddr" style="width:400px" class="req-string" value="{$the_paper.hukouAddress}"/>
户籍地址类型<select name="hkAddrType" class="req-string"><option value="">--请选择--</option>{html_options options=$c_hukouAddressType selected=$the_paper.hukouAddressType}</select>  <br /><br />
数码照相图像号<input type="text" name="picNumber" class="req-string" value="{$the_paper.picNumber}"/>
服务处所全称<input type="text" name="location" style="width:200px;" value="{$the_paper.location}"/>
工资<input type="text" name="salary" class="req-string" value="{$the_paper.salary}"/>  <br /><br />
文化程度<select name="education" class="req-string">{html_options options=$c_education selected=$the_paper.education}</select>
职称<select name="title" class="req-string">{html_options options=$c_title selected=$the_paper.title}</select>
职业技能等级<select name="level" class="req-string">{html_options options=$c_skillLevel selected=$the_paper.skillLevel}</select>
就业类型<select name="employmentType" class="req-string">{html_options options=$c_employmentType selected=$the_paper.employmentType}</select>  <br /><br />
合同起始日期<input type="text" name="conStart" class="req-string" value="{$the_paper.contractStart}"/>
合同终止日期<input type="text" name="conEnd" class="req-string" value="{$the_paper.contractEnd}"/>
本单位工作起始日期<input type="text" name="curUnitStart" class="req-string" value="{$the_paper.currentUnitStart}"/> 
参加工作时间<input type="text" name="beginWork" value="{$the_paper.beginWork}"/><br /><br />
<br />
广东省流动人口避孕节育情况报告单 <select name="planBirth" id="planBirth" class="req-string">{html_options options=$c_planBirthReport selected=$the_paper.planBirthReport}</select>
{if $the_paper.planBirthReport eq 1}
报告单编号<input type="text" name="reportNum" class="req-string" value="{$the_paper.planBirthReportNumber}"/> 
{else}
报告单编号<input type="text" name="reportNum" class="req-string" value="无" disabled="disabled"/>
{/if}
<br /><br />

<br />
现居住地址<input type="text" name="rAddr" style="width:400px" value="未用" class="req-string"/>
 <br /><br />
房屋地址信息编码<input type="text" name="houseNum" style="width:300px"  class="req-string" value="{$the_paper.houseNumber}" /> <br /><br />
<!--来深居住事由<select name="comeReason" class="req-string"><option value="">未用</option></select>-->
住所类别<select name="houseType"  class="req-string"><option value="">--请选择--</option>{html_options options=$c_houseType selected=$the_paper.houseType}</select> 
居住方式<select name="rType"  class="req-string"><option value="">--请选择--</option>{html_options options=$c_residentialType selected=$the_paper.residentialType}</select> 
来深日期<input type="text" name="cDate"  class="req-string" value="{$the_paper.comeDate}"/> <br /><br />

入住日期<input type="text" name="rDate"  class="req-string" value="{$the_paper.residentialDate}"/> 
本人移动电话<input type="text" name="mobile" value="{$the_paper.mobile}" class="req-string"/>
本人固定电话<input type="text" name="tele" value="{$the_paper.telephone}" />  <br /><br />
紧急人姓名<input type="text" name="uname" value="{$the_paper.urgentContacter}"/>
紧急人移动电话<input type="text" name="umobile" value="{$the_paper.ucMobile}"/>
紧急人固定电话<input type="text" name="utele" value="{$the_paper.ucTelephone}" /> <br /><br />
<br />
<!--是否办理居住证<select name="firstApp" class="req-string"><option value="">--请选择--</option>{html_options options=$c_firstApp}</select>&nbsp;&nbsp;-->
<input type="button" name="rCardUpdate" value="确定" /><input type="reset" />

<div id="errorDiv" class="error-div-alternative"></div>

</form>
</div>
</div>
{include file="footer.tpl"}