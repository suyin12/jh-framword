{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){


			$("input[name=createAssess]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createAssessForm").serialize();
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
							ajaxAction(t,u,d + "&btn=createAssess",dt,m);
						};

					validator("input[name=createAssess]","#createAssessForm","#errorDiv",successfunc);
					
			});


});
</script>
{/literal}
<div id="main">
<fieldset>
<div class="fForm">
<form name="searchassessForm" method="get" action="marketAssess.php">
<input type="hidden" name="searchassess" value="1" />
<a class="noSub positive" href="marketAssessCreate.php">添加市场评估</a>
<lable>概要：</lable></td><td><input type="text" name="subject" value="{$subject_s}" onFocus="this.value=''" class="fc" />


填写人：<select name="createdBy" class="fc">
<option value="0">----请选择----</option>
{html_options options=$recruiter_opt selected=$recruiter_s}</select>


创建日期：<input type="text" name="createdOn" value="{$createdOn_s}" class="fc" />



<input type="submit" value="查询" />


</form>

</div>
<hr />
 <fieldset>
    <legend>
    <code>市场评估</code>
    </legend>
<table class="myTable" width="100%">
<tr>
<th >市场评估概要</th>
<th>岗位</th>
<th>招聘时间</th>
<th>合适的市场</th>
<th>不合适的市场</th>
<th>填写人</th>
<th>填写日期</th>
</tr>

{foreach item=a from=$assesses}
<tr>
<td><a href="assessInfo.php?id={$a.id}" target="_blank">{$a.subject}</a></td>
<td>{$a.name}</td>
<td>{$a.period_s}至{$a.period_e}</td>
<td>{$a.proper}</td>
<td>{$a.improper}</td>
<td>{$a.mName}</td>
<td>{$a.createdOn}</td>
</tr>
{foreachelse}
<td colspan="7" >无数据</td>
{/foreach}
</table>

{$pageList}

</filedset>
</fieldset>
</div>
{include file="footer.tpl"}