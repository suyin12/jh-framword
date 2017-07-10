{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/fixedTable.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){
	
	$(":checkbox[name=talents[]]").each(function(i){
		
		$(this).click(function(){
			var total=0;
			$(":checkbox[name=talents[]]:checked").each(function(j){
					total=total+1;
				});
			$("#panel").html("已选中" + total + "行");
		});
		
	});


	// 更改上岗状态
    $(".processOnDuty").each(function(i){	 
	     $(this).click(function(){
		        var t,u,d,dt,m;
		        t = "post";
		        u = "mSQL.php";
		        d = $("form[name=talentsListForm]").serialize() ;
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
		        if(d)
		            ajaxAction(t,u,d + "&btn=processOnDuty&type=" + i ,dt,m);
		        else
		            alert("您未选择任何记录，无法更新！");    
	    });

    });

	// 更改标记颜色
    $(".addcolor").each(function(i){	 
	     $(this).click(function(){
		        var t,u,d,dt,m;
		        t = "post";
		        u = "mSQL.php";
		        d = $("form[name=talentsListForm]").serialize() ;
		        dt = "json";
		        m = function(json){
		            	var i,n;
		            	$.each(json,function(i,n){
			            	switch(i)
			            	{
			            	case "error":
			                	alert(n);
			                	break;
			     
			            	case "success":
			                	window.location.reload();
			                	break;
			            	}
		            	});
		            };
		        if(d)
		            ajaxAction(t,u,d + "&btn=addcolor&type=" + i ,dt,m);
		        else
		            alert("您未选择任何记录，无法标记！");    
	    });

    });

    // 更改 交资料的情况
    $("input[name=materialUpd]").click(function(){
        var t,u,d,dt,m;
        t = "post";
        u = "mSQL.php";
        d = $("form[name=talentsListForm]").serialize();
        dt = "json";
        m = function(json){
            	var i,n;
            	$.each(json,function(i,n){
                	switch(i)
                	{
                	case "error":
                	case "error2":
                    	alert(n);break;
                	case "success":
						window.location.reload();
                    	break;
                	}
                });
            };

        if(d)
            ajaxAction(t,u,d+ "&btn=materialUpd",dt ,m);
        else
            alert("您未选择任何人员，无法操作");
    });

    //  添加待岗名单的备注
    $("input[name=posRemarks]").blur(function(){
        var t,u,d,dt,m;
        t = "post";
        u = "mSQL.php";
        d = $("form[name=talentsListForm]").serialize();
        dt = "json";
        m = function(json){
        	var i,n;
        	$.each(json,function(i,n){
            	switch(i)
            	{
            	case "error":
            	case "error2":
                	alert(n);break;
            	case "success":
					window.location.reload();
                	break;
            	}
            });
        };

        if(d)
            ajaxAction(t,u,d+ "&btn=posRemarks",dt ,m);
        else
            alert("您未选择任何人员，无法操作");
        
    });

    //  添加待岗名单的备注
    $("input[name=unitRemarks]").blur(function(){
        var t,u,d,dt,m;
        t = "post";
        u = "mSQL.php";
        d = $("form[name=talentsListForm]").serialize();
        dt = "json";
        m = function(json){
        	var i,n;
        	$.each(json,function(i,n){
            	switch(i)
            	{
            	case "error":
            	case "error2":
                	alert(n);break;
            	case "success":
					window.location.reload();
                	break;
            	}
            });
        };

        if(d)
            ajaxAction(t,u,d+ "&btn=unitRemarks",dt ,m);
        else
            alert("您未选择任何人员，无法操作");
        
    });

    //  添加待岗名单的备注
    $("input[name=material]").blur(function(){
        var t,u,d,dt,m;
        t = "post";
        u = "mSQL.php";
        d = $("form[name=talentsListForm]").serialize();
        dt = "json";
        m = function(json){
        	var i,n;
        	$.each(json,function(i,n){
            	switch(i)
            	{
            	case "error":
            	case "error2":
                	alert(n);break;
            	case "success":
					window.location.reload();
                	break;
            	}
            });
        };

        if(d)
            ajaxAction(t,u,d+ "&btn=material",dt ,m);
        else
            alert("您未选择任何人员，无法操作");
        
    });
    
	// 批量退回的情况
	$("input[name=backup]").click(function(){
		$("form[name=talentsListForm]").attr("action","reserve.php");
		
	});

	// 全选：所有状态
	$("#allstatus").click(function(){
		 if ($(this).attr('checked') == true) {
	            $(".status").attr('checked', true);
	        }
	        else {
	            $('.status').attr('checked', false);
	        }
	});

	$("input[name=remarksA]").blur(function(){
	     var t,u,d,dt,m;
	        t = "post";
	        u = "mSQL.php";
	        d = $("form[name=talentsListForm]").serialize();
	        dt = "json";
	        m = function(json){
	        	var i,n;
	        	$.each(json,function(i,n){
	            	switch(i)
	            	{
	            	case "error":
	            	case "error2":
	                	alert(n);break;
	            	case "success":
						window.location.reload();
	                	break;
	            	}
	            });
	        };

	        if(d)
	            ajaxAction(t,u,d+ "&btn=remarksA",dt ,m);
	        else
	            alert("您未选择任何人员，无法操作");
	});

	$("input[name=remarksB]").blur(function(){
	     var t,u,d,dt,m;
	        t = "post";
	        u = "mSQL.php";
	        d = $("form[name=talentsListForm]").serialize();
	        dt = "json";
	        m = function(json){
	        	var i,n;
	        	$.each(json,function(i,n){
	            	switch(i)
	            	{
	            	case "error":
	            	case "error2":
	                	alert(n);break;
	            	case "success":
						window.location.reload();
	                	break;
	            	}
	            });
	        };

	        if(d)
	            ajaxAction(t,u,d+ "&btn=remarksB",dt ,m);
	        else
	            alert("您未选择任何人员，无法操作");
	});


	$(".EditList").each(function(i){
		$(this). click(function(){
			var url = $(this).attr("dataSrc");
			tipsWindown('待岗名单编辑','iframe:'+url, '1200', '400', 'true', '', 'true', 'leotheme');
		
		});
	});


});


</script>

{/literal}
<div id="main">
<fieldset>

<form name="searchTalentsListForm" method="get" action="talentsList.php">
{foreach item=unitid from=$unit_arr}
<input type="hidden" name="unit[]" value="{$unitid}" />
{/foreach}
<select name="col"><option value="">查找方式</option>{html_options options=$col_opt selected=$col_s}</select>
查询内容：<input type="text" name="con" onFocus="this.value=''" value="{$con_s}" style="width:80px;"/>
<!--交资料情况：<select name="material" style="width:80px;"><option value="">请选择</option>{html_options options=$ismaterial_opt selected=$ismaterial_s}</select>&nbsp;-->
提交自：<select name="signBy"><option value="">请选择</option>{html_options options=$recruiter_opt selected=$recruiter_s}</select>
提交到：<select name="signTo"><option value="">请选择</option>{html_options options=$manager_opt selected=$manager_s}</select>
是否培训：<select name="train"><option value="">请选择</option>{html_options options=$istrain_opt selected=$istrain_s}</select>&nbsp;
是否见证明人：<select name="reference"><option value="">请选择</option>{html_options options=$isreference_opt selected=$isreference_s}</select>&nbsp;
是否资料递交单位：<select name="commit"><option value="">请选择</option>{html_options options=$iscommit_opt selected=$iscommit_s}</select>&nbsp;
按排序列：<select name="sort" style="width:100px;">{html_options options=$sort_opt selected=$sort_s}</select>&nbsp;
<select name="sort_ad">{html_options options=$sort_ad_opt selected=sort_ad_s}</select>
<input type="submit" value="查找" />

</form>

<form name="talentsListForm" method="post">

<table class="myTable" id="mainTable">
<thead>
<tr>
<th></th>
<th><input type="checkbox" disabled/></th>

<!--<th>电话</th>-->
<th>操作</th>
<th>单位</th>
<th>单位备注</th>
<th>应聘岗位</th>
<th>岗位备注</th>
<!--<th>合格状态</th>-->
<!--<th>上岗状态</th>-->
<!--<th>交资料</th>-->
<th>交资料</th>
<th>培训</th>
<th>证明人</th>
<th>料递交单位</th>



<!--<th>提交时间</th>-->
<!--<th>最后修改人</th>-->
<!--<th>最后修改时间</th>-->


<th>培训成绩</th>

<th>身份证号</th>
<th>性别</th>
<th>电话</th>
<th>备注1</th>
<th>备注2</th>


</tr>
</thead>
<tbody>
{foreach item=t from=$talents}

{assign var="color" value=$t.label}
{if $color eq 1}
<tr class="table_tr_blue">
{elseif $color eq 2}
<tr class="table_tr_grey">
{elseif $color eq 3}
<tr class="table_tr_red">
{elseif $color eq 4}
<tr class="table_tr_green">
{else}
<tr >
{/if}

<td><a href="tUpdate.php?tid={$t.talentID}" target="_blank">{$t.t_name}</a></td>
<td><input type="checkbox" name="talents[]" class="ckb" name="talentID" value="{$t.talentID}" /></td>



<!--<td>{$t.t_telephone}</td>-->
<td>
	<a href="{$httpPath}workerInfo/wMountGuard.php?id={$t.talentID}" target="_blank">入职</a>
	<a href="{$httpPath}recruitManage/reserve.php?id={$t.talentID}" target="_blank" >退回</a>
	<a dataSrc="talentListEdit.php?id={$t.talentID}" class="EditList" href="#" >编辑</a>
</td>
<td title="{$t.t_name}">{$t.unitName}</td>
<td title="{$t.unitRemarks}">{$t.unitRemarks}</td>
<td title="{$t.t_name}">{$t.p_name}</td>
<td title="{$t.t_name}">{$t.posRemarks}</td>

<!--<td>{$t.status|replace:"1":"不合格"|replace:"2":"储备"|replace:"3":"合格"}</td>-->
<!--<td>{$t.onDuty|replace:"1":"等待驾考"|replace:"2":"等待培训"|replace:"3":"资料收齐"|replace:"4":"已培训"|replace:"5":"已见证明人"|replace:"6":"已递交资料到市局"}</td>-->
<!--<td>{$t.onDuty|replace:"1":"等待驾考"|replace:"2":"等待培训"|replace:"3":"已上岗"}</td>-->
<!--<td title="{$t.t_name}">{$t.d_material|replace:1:"无"|replace:2:"户口本"|replace:3:"计生证"|replace:4:"体检表"|replace:5:"户口本,计生证"|replace:6:"户口本,体检表"|replace:7:"计生证,体检表"|replace:8:"户口本,计生证,体检表"}</td>-->
<td title="{$t.t_name}">{$t.material}</td>
<td title="{$t.t_name}">{$t.d_train|replace:1:"是"|replace:2:"否"}</td>
<td title="{$t.t_name}">{$t.d_reference|replace:1:"是"|replace:2:"否"}</td>
<td title="{$t.t_name}">{$t.d_commit|replace:1:"是"|replace:2:"否"}</td>



<!--<td>{$t.signTime}</td>-->
<!--<td>{$t.lastModifiedBy}</td>-->
<!--<td>{$t.lastModifyTime}</td>-->


<td title="{$t.t_name}">{$t.marks}</td>

<td title="{$t.t_name}">{$t.idCard}</td>
<td title="{$t.t_name}">{$t.sex|replace:"1":"男"|replace:"2":"女"}</td>
<td title="{$t.t_name}">{$t.t_telephone}</td>
<td title="{$t.t_name}">{$t.remarksA}</td>
<td title="{$t.t_name}">{$t.remarksB}</td>

</tr>
{/foreach}
</tbody>

</table>
<!--{literal}-->
<!--<script type="text/javascript">-->
<!--	if(typeof tableScroll == 'function'){tableScroll('mainTable');}-->
<!--</script>-->
<!--{/literal}-->
<div id="panel"></div>
<p>
<!--class=processOnDuty的这几个按钮的顺序不能变，js代码使用顺序来获得相应的操作类型-->
状态操作：
<!--<input type="checkbox" id="allstatus" />全选-->
<!--<input type="checkbox" name="material1" class="status" value="1" />户口本-->
<!--<input type="checkbox" name="material2" class="status" value="1" />计生证-->
<!--<input type="checkbox" name="material3" class="status" value="1" />体检表-->
<!--<input type="checkbox" name="train" class="status" value="1" />培训-->
<!--<input type="checkbox" name="reference" class="status" value="1" />证明人-->
<!--<input type="checkbox" name="commit" class="status" value="1" />交资料-->
<!--<input type="button" name="materialUpd" value="确定" /> <br />-->
修改交资料：<input type="text" name="material" />
添加单位备注：<input type="text" name="unitRemarks" />
添加岗位备注：<input type="text" name="posRemarks" />
添加备注1：<input type="text" name="remarksA" />
添加备注2：<input type="text" name="remarksB" /> <br />


<input type="submit" name="excelout" value="导出excel" />
<input type="submit" name="backup" value="批量退回" />

<!--<input type="button" id="dosign" value="签收" />-->

<!--颜色标记：-->
<!--<input type="button" class="addcolor" value="取消" />-->
<!--<input type="button" class="addcolor" value="蓝色" style="background:#93D7FB;" />-->
<!--<input type="button" class="addcolor" value="灰色" style="background:#a7a7a7;" />-->
<!--<input type="button" class="addcolor" value="红色" style="background:#ff7373" />-->
<!--<input type="button" class="addcolor" value="绿色" style="background:#ABE3A7" />-->
<a href="../excelaction/readExcel.php?a=marksInsert" target="_blank" >导入培训成绩</a>
</p>

</form>

</fieldset>
</div>
{include file="footer.tpl"}