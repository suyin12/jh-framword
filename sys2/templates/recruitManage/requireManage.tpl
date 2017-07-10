{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">

{literal}
<script type="text/javascript">

$(document).ready(function(){

		    $('#CK').click(function(){
		        if ($(this).attr('checked') == true) {
		            $(".ckb").attr('checked', true);
		        }
		        else {
		            $('.ckb').attr('checked', false);
		        }
		    });
		  //刷新页面,用checkbox来控制
            checkReload(":checkbox[name=history]");
		  
			$("input[name=createRequire]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createRequireForm").serialize();
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
							ajaxAction(t,u,d + "&btn=createRequire",dt,m);
						};

					validator("input[name=createRequire]","#createRequireForm","#errorDiv",successfunc);
					
			});

			// 签收处理
		    $(".doSub").click(function(){
		    	 var btnName = $(this).attr("name")
		        var t,u,d,dt,m;
		        t = "post";
		        u = "mSQL.php";
		        d = $("form[name=demandsForm]").serialize() ;
		        dt = "json";
		        m = function(json){
		            	var i,n;
		            	$.each(json,function(i,n){
		                	switch(i){		             
		                	case "error":
		                   	case "error2":
		                   	case "error3":
		                    	alert(n);break;
		                	case "success":
		                    	alert(n);
		                    	window.location.reload();break;
		                	}
		                });
		            };
		         if(d){
		        	 var ret = confirm("确定" + $(this).val() + "?");
		                if (ret == true) {
		             ajaxAction(t,u,d + "&btn="+btnName,dt,m);
		                }
		         }
		         else
		             alert("您未选择任何记录，无法操作！");
		    });
			//日历
			$(".date").datepick();
			
		     //提交
		    $(".aSub").click(function(){
		        var btnName = $(this).attr("name");
				var demandID= $(this).attr("title");
		        var t, u, d, dt, m;
		        t = "post";
		        u = "mSQL.php";
		        d =  "btn=" + btnName + "&demandID="+demandID;
		        dt = "json";
		        m = function(json){
		            var i, n, k, v;
		            $.each(json, function(i, n){
		                switch (i) {
		                    case "error":
		                        alert(n);
		                        break;
		                    case "succ":
		                        alert(n);
		                        window.location.reload();
		                        break;
		                }
		            });
		        };
		        var ret = confirm("确定" + $(this).text() + "?");
		        if (ret == true) {
		            ajaxAction(t, u, d, dt, m);
		        }
		    });

});
</script>
<style>

.addcolor td{
	background:#BEFF8D;
}

</style>
{/literal}
<div id="main">
<a class="noSub positive" href="addRequire.php" >添加需求</a>
<hr />
<form name="demandsForm" class="form" method="post" action="planCreate.php">
<fieldset>
    <legend>
    <code>待处理的需求（未签收或者是已退回的需求）</code>
    </legend>
<table class="myTable" width="100%">
    <thead>
<tr>
<th>全选<input type="checkbox" id="CK" /></th>
<th>序号</th>
<th >岗位名称</th>
<th>用工单位</th>
<th>需求数</th>
<th>签收状态</th>
<th>退回原因</th>
<th>填写人</th>
<th>填写日期</th>
<th>工作地点</th>
<th>转正后工资</th>
</tr>
</thead>
{foreach item=r key=k from=$requires_waiting}
<tr>
<td>
<input type="checkbox" name="demands[]" class="ckb" value="{$r.demandID}" />
</td>
<td>{$k+1}</td>
<td><a href="requireInfo.php?id={$r.demandID}" target="_blank">{$r.name}</a></td>
<td>{$r.unitName|replace:"深圳市":""|truncate:30}</td>
<td>{$r.required}</td>
<td>{$r.status|replace:"1":"未签收"|replace:"2":"已退回"|replace:"3":"已签收"}</td>
<td>{$r.rbackReason}</td>
<td>{$r.mName}</td>
<td>{$r.rCreatedOn}</td>
<td>{$r.workPlace}</td>
<td>{$r.officialTotalSalary}</td>
</tr>


{foreachelse}
<td colspan="13" >无数据</td>
{/foreach}

</table>

<p><input type="button"  class="doSub"  name="dosign" value="签收" />
退回原因:<input type="text" name="rbackReason" class="req-string"/><input type="button"  class="doSub"  name="dounsign" value="退回" />
<input type="button" class="doSub"  name="delRequire" value="删除" />
<!--&nbsp;&nbsp;&nbsp;<input type="submit" id="makeplan" value="制订招聘计划" />-->
</p>
</fieldset>
</form>

<fieldset>
    <legend>
    <code>已处理的需求（已签收）</code>
    </legend>
<form name="searchrequireForm" class="form" method="get" action="requireManage.php">
<input type="hidden" name="sr" value="1" />
用工单位：<select name="u">
<option value="">----请选择----</option>
{html_options options=$units selected=$unit_s}
</select>创建人：<select name="cb" class="fc">
<option value="">----请选择----</option>
{html_options options=$recruiter_opt selected=$recruiter_s}</select>
签收状态: <select name="status"><option value="">----请选择----</option>{html_options options=$status_opt selected=$status_s}</select>
创建日期：</td><td><input type="text" name="co" value="{$co_s}" class="date"  />
<input type="submit" value="查询" />
</form>
 <input type="checkbox" name="history" value="1" {if $smarty.get.history eq 'true'} checked='true' {/if} />  显示失效需求
<table class="myTable" width="100%">
    <thead>
<tr>
<th>序号</th>
<th >岗位名称</th>
<th >用工单位</th>
<th>上岗日期</th>
<th>需求数</th>
<th>上岗人数</th>
<th>填写人</th>
<th>填写日期</th>
<th>签收日期</th>
<th>详情</th>
</tr>
</thead>
{foreach item=r key=k from=$requires_info}
{if $r.status eq '0'}
<tr class=red>
<!--<td><a href="requireInfo.php?id={$r.demandID}" target="_blank">{$r.name}</a></td>-->
<td>{$k+1}</td>
<td><a href="{$httpPath}recruitManage/requireInfo.php?id={$r.demandID}">{$r.name}</a></td>
<td>{$r.unitName|replace:"深圳市":""|truncate:30}</td>
<td>{$r.deadline|date_format:"%Y/%m/%d"}</td>
<td>{$r.required}</td>
<td>{$r.yetTotal}</td>
<td>{$r.mName}</td>
<td>{$r.rCreatedOn|date_format:"%m/%d"}</td>
<td>{$r.receiverTime|date_format:"%m/%d"}</td>
<td>
	<a href="{$httpPath}recruitManage/tInfoStatus.php?m=name&c=&wS=查询&unitID={$r.unitID}&positionID={$r.positionID}" class="noSub  positive">查看</a>
	<a class="aSub" name="demandAction"  title="{$r.demandID}|status|3">启用</a>
</td>
</tr>
{else}
<tr>
<!--<td><a href="requireInfo.php?id={$r.demandID}" target="_blank">{$r.name}</a></td>-->
<td>{$k+1}</td>
<td><a href="{$httpPath}recruitManage/requireInfo.php?id={$r.demandID}">{$r.name}</a></td>
<td>{$r.unitName|replace:"深圳市":""|truncate:30}</td>
<td>{$r.deadline|date_format:"%Y/%m/%d"}</td>
<td>{$r.required}</td>
<td>{$r.yetTotal}</td>
<td>{$r.mName}</td>
<td>{$r.rCreatedOn|date_format:"%m/%d"}</td>
<td>{$r.receiverTime|date_format:"%m/%d"}</td>
<td>
	<a href="{$httpPath}recruitManage/tInfoStatus.php?m=name&c=&wS=查询&unitID={$r.unitID}&positionID={$r.positionID}" class="noSub  positive">查看</a>
	<a class="aSub" name="demandAction" title="{$r.demandID}|status|0">失效</a>
</td>
</tr>
{/if}
{foreachelse}
<td colspan="13" >无数据</td>
{/foreach}

</table>
{$pageList}
    </fieldset>


</div>
{include file="footer.tpl"}