{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){		
			$("input[name=createPositionAndRequire]").click(function(){				
					var t,u,d,dt,m,lastid;
					t = "post";
					u = "mSQL.php";
					d = $("#createPositionForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
								if(i == "lastid")
									lastid = n;
									switch(i)
									{
									case "error":
										alert(n);
										break;
									case "exist_error":
										alert(n);
										window.location.href= "positionManage.php";
									case "success":
										alert(n);			
										break;
									}
								});
							window.location.href = "addRequire.php?id=" + lastid ;
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=createPosition",dt,m);
						};
					validator("input[name=createPositionAndRequire]","#createPositionForm","#errorDiv",successfunc);			
			});
			
			$("input[name=createPositionNormal]").click(function(){
				var t,u,d,dt,m;
				t = "post";
				u = "mSQL.php";
				d = $("#createPositionForm").serialize();
				dt = "json";
				m = function(json){
						$.each(json,function(i,n){
								switch(i)
								{
								case "error":
									alert(n);
									break;
								case "exist_error":
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
						ajaxAction(t,u,d + "&btn=createPosition",dt,m);
					};
				validator("input[name=createPositionNormal]","#createPositionForm","#errorDiv",successfunc);	
		});		

});
</script>

{/literal}
<div id="main">
    <fieldset>    
<a class="noSub positive" href="positionCreate.php" target="_blank" >添加岗位</a>
<a class="noSub positive" href="pricesetting.php" target="_blank" >设置绩效岗位价格</a>
<div class="fForm">
<form name="searchpositionForm" id="searchpositionForm" method="get" action="positionManage.php">
岗位名称：<input type="text" name="pos" value="{$pos_s}" onFocus="this.value=''" />
用工单位：<select name="unit">
<option value="0">----请选择----</option>
{html_options options=$units_opt selected=$units_s}
</select>

<input type="submit" id="search" value="查询" />


</form>


</div>


<table class="myTable" width="100%">
<tr>
<th>序号</th>
<th>岗位名称</th>
<th>用工单位</th>
<th>工作地点</th>
<th>年龄</th>
<th>性别</th>
<th>学历</th>
<th>身高</th>

<th>试用期工资</th>
<th>转正后工资</th>
<!--<th>岗位价格</th>-->
<th>活动状态</th>
</tr>



{foreach item=pos key=k  from=$positions_info}
<tr>
<td>{$k+1}</td>
<td><a href="positionInfo.php?id={$pos.positionID}" target="_blank">{$pos.name}</a></td>
<td>{$pos.unitName}</td>
<td>{$pos.workPlace}</td>
<td>{$pos.posAge}</td>
<td>{$pos.posSex}</td>
<td>{$pos.posDegree}</td>
<td>{$pos.posHeight}</td>

<td>{$pos.trialTotalSalary}</td>
<td>{$pos.officialTotalSalary}</td>
<!--<td>{$pos.price}</td>-->
<td>{$pos.active|replace:"1":"活动"|replace:"0":"禁用"}</td>
</tr>
{foreachelse}
<td colspan="10" >无数据</td>
{/foreach}

</table>

{$pageList}



</div>
</div>
{include file="footer.tpl"}