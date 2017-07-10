{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=archiveCreate1]").click(function(){
					var t,u,d,dt,m;
					t = "post";
					u = "aSQL.php";
					d = $("#archiveCreateForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "error1":
										alert(n);break;
									case "error2":
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
							ajaxAction(t,u,d + "&btn=archiveCreate1",dt,m);
						};
						
					validator("input[name=archiveCreate1]","#archiveCreateForm","#errorDiv",successfunc);
					
			});

			$("input[name=archiveCreate2]").click(function(){
				var t,u,d,dt,m;
				t = "post";
				u = "aSQL.php";
				d = $("#archiveCreateForm").serialize();
				dt = "json";
				m = function(json){
						$.each(json,function(i,n){
								switch(i)
								{
								case "error1":
									alert(n);break;
								case "error2":
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
						ajaxAction(t,u,d + "&btn=archiveCreate2",dt,m);
					};
					
				validator("input[name=archiveCreate2]","#archiveCreateForm","#errorDiv",successfunc);
				
		});

			$("input[name=archiveCreate3]").click(function(){
				var t,u,d,dt,m;
				t = "post";
				u = "aSQL.php";
				d = $("#archiveCreateForm").serialize();
				dt = "json";
				m = function(json){
						$.each(json,function(i,n){
								switch(i)
								{
								case "error1":
									alert(n);break;
								case "error2":
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
						ajaxAction(t,u,d + "&btn=archiveCreate3",dt,m);
					};
					
				validator("input[name=archiveCreate3]","#archiveCreateForm","#errorDiv",successfunc);
				
		});

			$("input[name=archiveCreate4]").click(function(){
				var t,u,d,dt,m;
				t = "post";
				u = "aSQL.php";
				d = $("#archiveCreateForm").serialize();
				dt = "json";
				m = function(json){
						$.each(json,function(i,n){
								switch(i)
								{
								case "error1":
									alert(n);break;
								case "error2":
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
						ajaxAction(t,u,d + "&btn=archiveCreate4",dt,m);
					};
					
				validator("input[name=archiveCreate4]","#archiveCreateForm","#errorDiv",successfunc);
				
		});

			$("input[name=manageDate]").datepick();

			

	

});
</script>
{/literal}
<div id="main">
    <fieldset>
<a class="block" href="archiveCreate.php?type=1">派遣员工</a>&nbsp;&nbsp;&nbsp;
<a class="block" href="archiveCreate.php?type=2">代理员工</a>&nbsp;&nbsp;&nbsp;
<a class="block" href="archiveCreate.php?type=3">个人代理</a>&nbsp;&nbsp;&nbsp;
<a class="block" href="archiveCreate.php?type=4">增值类服务</a></p><br /><br />
<form id="archiveCreateForm" method="post" class="form">
姓名<input type="text" name="name" value="{$worker.name}" class="req-string"/>&nbsp;&nbsp;&nbsp;
性别<select name="sex" class="req-string"><option value="">请选择</option>{html_options options=$c_sex selected=$worker.sex}</select>&nbsp;&nbsp;&nbsp;
身份证号码<input type="text" name="idcard" value="{$worker.pID}" class="req-string"/><br /><br />
联系电话1<input type="text" name="tel1" class="req-string" value="{$worker.mobilePhone}"/>&nbsp;&nbsp;&nbsp;
联系电话2<input type="text" name="tel2" />&nbsp;&nbsp;&nbsp;
联系电话3<input type="text" name="tel3" /><br /><br />

{if $type eq 1}
档案编号<input type="text" name="filenumber" value="{$worker.dID}" class="req-string" />&nbsp;&nbsp;&nbsp;
来档单位<input type="text" name="fromunit" class="req-string" />&nbsp;&nbsp;&nbsp;
用工单位<input type="text" name="workunit" value="{$worker.unitName}" class="req-string"/><br /><br />
客户经理<select name="manager" class="req-string" ><option value="">请选择</option>{html_options options=$managers selected=$managerID}</select>&nbsp;&nbsp;&nbsp;
是否办理就业登记<select name="jobreg" class="req-string" ><option value="">请选择</option>{html_options options=$yesno}</select><br /><br />
档案托管日期<input type="text" name="manageDate" class="req-string date" />&nbsp;&nbsp;&nbsp;
员工离职日期<input type="text" name="dimissionDate" disabled value="{$worker.dimissionDate}"/>(须在员工管理办理离职)<br /><br />
备注<textarea name="remarks" rows="4" cols="80" ></textarea><br /><br />
<p><input type="button" name="archiveCreate1" value="确定" /><input type="reset" /></p>

{elseif $type eq 2}
档案编号<input type="text" name="filenumber" class="req-string" />&nbsp;&nbsp;&nbsp;
代理单位<input type="text" name="workunit" class="req-string" />&nbsp;&nbsp;&nbsp;
来档单位<input type="text" name="fromunit" class="req-string" /><br /><br />
客户经理<select name="manager" class="req-string" ><option value="">请选择</option>{html_options options=$managers selected=$managerID}</select>&nbsp;&nbsp;&nbsp;
是否办理就业登记<select name="jobreg" class="req-string"><option value="">请选择</option>{html_options options=$yesno}</select>&nbsp;&nbsp;&nbsp;
档案托管日期<input type="text" name="manageDate" class="req-string date"/><br /><br />
费用标准<input type="text" name="feeprice" />
                 <br /><br /> 
备注<textarea name="remarks" rows="4" cols="80" ></textarea><br /><br />
<p><input type="button" name="archiveCreate2" value="确定" /><input type="reset" /></p>

{elseif $type eq 3}
档案编号<input type="text" name="filenumber" class="req-string" />&nbsp;&nbsp;&nbsp;
来档单位<input type="text" name="fromunit" />&nbsp;&nbsp;&nbsp;
工作单位<input type="text" name="workunit" />&nbsp;&nbsp;&nbsp;
档案托管日期<input type="text" name="manageDate" class="req-string date"/><br /><br /> 
紧急联系人<input type="text" name="uc" />&nbsp;&nbsp;&nbsp;
紧急联系人电话<input type="text" name="uctel" /><br /><br />
协议期限<input type="text" name="feedate" />
费用标准<input type="text" name="feeprice" />
             <br /><br /> 
备注<textarea name="remarks" rows="4" cols="80" ></textarea><br /><br />
<p><input type="button" name="archiveCreate3" value="确定" /><input type="reset" /></p>

{else}
协议编号<input type="text" name="filenumber" />&nbsp;&nbsp;&nbsp;
户政业务类别<select name="hztype" ><option value="">请选择</option>{html_options options=$huzheng_type}</select>&nbsp;&nbsp;&nbsp;
托管地点<input type="text" name="fromunit" /><br /><br />
用工单位<input type="text" name="workunit" />&nbsp;&nbsp;&nbsp;
用工单位联系人<input type="text" name="unitc" />&nbsp;&nbsp;&nbsp;
联系人电话<input type="text" name="unitctel" />&nbsp;&nbsp;&nbsp;
档案托管日期<input type="text" name="manageDate" class="req-string date"/><br /><br /> 

协议期限<input type="text" name="feedate" />
费用标准<input type="text" name="feeprice" />
                    <br /><br /> 
备注<textarea name="remarks" rows="4" cols="80" ></textarea><br /><br />
<p><input type="button" name="archiveCreate4" value="确定" /><input type="reset" /></p>
{/if}

<div id="errorDiv" class="error-div-alternative"></div>
</form>

</fieldset>

</div>
{include file="footer.tpl"}