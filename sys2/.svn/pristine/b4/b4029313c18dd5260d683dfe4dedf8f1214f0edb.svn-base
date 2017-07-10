{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script type="text/javascript">

$(document).ready(function(){
	
		$("input[name=createTalent]").click(function(){		
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createTalentForm").serialize();
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
								var i,n;
								switch(i)
								{
								case "exist":
									//alert("人才库存在姓名和电话或者身份证号相同的记录，无需重复录入");
								//	window.location.href = "tInsert.php";									
									if(confirm("人才库存在姓名和电话或者身份证号相同的记录，是否更新？") == true)
									{	
										//ajaxAction(t,u,d + "&btn=createTalent&label=1" ,dt,m);
										 window.open ("tUpdate.php?tid="+n);
										break;
									}
									else
									{
										break;
									}
									
									break;
								case "error":
									alert(n);
									break;
								case "success":
									if(confirm(n+"，确定将结束添加人才，取消则继续添加") == true)
									{
										window.location.href = "tInfo.php";
									}
									else
									{
										$("#createTalentForm").submit();
									}
									break;
								}
							});
						};
					successFun = function(){
							ajaxAction(t,u,d + "&btn=createTalent" ,dt,m);
						};
						
					validator("input[name=createTalent]","#createTalentForm","#errorDiv",successFun);
			
		});		
	    // 单位岗位二级联动
	    $("select[name=unitID]").change(function(){
	        var j_d = $(".j_unitPositionArr").val();
	                j_d = eval(j_d);
	    
	        $.each(j_d, function(i, n){
	            if ($("select[name=unitID]").val() == n.unitID) {
	                $("select[name=positionID] option:not(:eq(0))").remove();
	                $.each(n.position, function(j, v){
	                    $("select[name=positionID]").append("<option value=" + v.positionID + ">" +
	                    v.name +
	                    "</option>");
	                });
	            
	            }
	            if (!$("select[name=unitID]").val()) {
	                $.each(n.position, function(j, v){
	                    $("select[name=positionID]").append("<option value=" + v.positionID + ">" +
	                    v.name +
	                    "</option>");
	                });
	            }
	        });	    
	    });
	    
});



</script>
{/literal}
<div id="main">

<p><a class="noSub positive" href="tInfo.php">返回人才管理</a></p>
<fieldset>
    <legend><code>添加人才信息</code></legend>    
    <input	type="hidden" class="j_unitPositionArr" value='{$j_unitPositionArr}'>
<form id="createTalentForm" class="form" >
<table class="myTable halfWidth center">
<tr><td>姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名</td><td><input type="text" name="name" class="req-string" /></td></tr>
<tr><td>性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别</td><td><select name="sex" class="req-numeric" style="width:150px"  >
<option value=""  >------请选择------</option>
{html_options values=$sex_value output=$sex_label}
</select></td></tr>
<tr><td>身份证号</td><td><input type="text" name="idcard" /></td></tr>
<tr><td>学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;历</td><td><select name="education" class="req-numeric" style="width:150px" >
<option value="" >------请选择------</option>
{html_options values=$edu_value output=$edu_label}
</select></td></tr>
<tr><td>专&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;业</td><td><input type="text" name="major" /></td></tr>

<tr><td>联系电话</td><td><input type="text" name="telephone" class="req-string req-numeric req-length"  length="11"  /></td></tr>


<tr><td>来源市场</td><td><select name="marketID" class="req-string req-numeric" style="width:150px">
<option value="" >------请选择------</option>
 {foreach from=$marketArr item=val}
                             {html_options values=$val.marketID output=$val.name selected=$market_s}
                           {/foreach}
</select></td></tr>

<tr><td>合格状态</td><td><select name="status" id="status" class="req-string req-numeric" style="width:150px">
{foreach from=$statusToCHNArr item=val key=key}
{html_options values=$key output=$val.name selected=$status_s}
{/foreach}
</select></td></tr>
<tr>
<td>单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位</td><td>
                    <select name="unitID" class="req-string req-numeric" style="width:150px" >
                            <option value="">------请选择--------</option>
                            {foreach from = $unitPositionArr item = val} 
                           		 {html_options	values=$val.unitID output= $val.unitName|replace:"深圳市":'' selected= $unit_s} 
                            {/foreach}
                        </select>
                        </td></tr>
                        <tr><td>
                   岗&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;位</td><td>
                   <select name="positionID" class="req-string req-numeric"  style="width:150px">
                            <option value="">-------请选择------</option>
                            {foreach from= $unitPositionArr item= val key=key } 
                                {foreach from= $val	item=u key= k}
                                 {if  $k eq "position"}
                                        {foreach from= $u item= m key= n}
                                            {html_options values= $m.positionID output=$m.name selected=$position_s}
		                                {/foreach} 
		                            {/if}
                             {/foreach}
                         {/foreach}
                  </select> 
                  </td>
                  </tr>
<tr><td>意向区域</td><td><input type="text" name="wantedArea" /></td></tr>
<tr><td>驾照类型</td><td><input type="text" name="lisence" /></td></tr>

<tr>
<td>招聘人员</td><td><select name="recruitManagerId" class="req-string req-numeric" style="width:150px">
<option value="">------请选择------</option>
{foreach from =$userArr item=val key=key}
{html_options values=$key output=$val.mName selected=$recruitManager_selected}
{/foreach}
</select>
</td></tr>
<tr><td>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注</td><td><textarea rows="4" cols="30"  name="remarks"></textarea></td></tr>
<tr><td colspan="2"><input type="button" name="createTalent" value="确定" />
</table>

<div id="errorDiv" class="error-div-alternative">
</div>
</form>
</fieldset>

</div>
{include file="footer.tpl"}
