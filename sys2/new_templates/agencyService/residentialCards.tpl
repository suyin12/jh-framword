{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){
			$("input[name=cDate]").datepick();
			$("input[name=rDate]").datepick();
			$("input[name=conStart]").datepick();
			$("input[name=conEnd]").datepick();
			$("input[name=curUnitStart]").datepick();
			$("input[name=start]").datepick();
			$("input[name=end]").datepick();
			
			$("#planBirth").change(function(){
				var v = $("#planBirth option:selected").val();
				if( v == 0)
					$("input[name=reportNum]").attr("disabled","disabled").attr("value","无");
				else
					$("input[name=reportNum]").attr("disabled","").attr("value","");
			});

			
			$("#CK").click(function(){
				 if ($(this).attr('checked') == true) {
			            $(".papers").attr('checked', true);
			        }
			        else {
			            $('.papers').attr('checked', false);
			        }
			});

			// 更改状态
		    $(".chgStatus").each(function(i){	 
			     $(this).click(function(){
				        var t,u,d,dt,m;
				        t = "post";
				        u = "aSQL.php";
				        d = $("form[name=papersForm]").serialize() ;
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
				            ajaxAction(t,u,d + "&btn=chgStatus&num=" + i ,dt,m);
				        else
				            alert("您未选择任何记录，无法更新！");    
			    });

		    });
					

});
</script>
{/literal}
<div id="main">
    <fieldset>
<form name="paperSearch" method="get">
状态<select name="status">{html_options options=$c_status selected=$status_s}</select>
姓名<input type="text" name="name" value="{$name_s}"/>
身份证号<input type="text" name="idcard" value="{$idcard_s}"/>
起始日期<input type="text" name="start" value="{$start_s}"/>
终止日期<input type="text" name="end" value="{$end_s}"/>(均包含当日)
<input type="submit" id="paper" value="确定" />
</form>

<form name="papersForm" method="post">
<input type="hidden" name="excelout" value="1" />
<table class="myTable">
<tr>
<th><input type="checkbox" id="CK" />全选</th>
<th>状态</th>
<th>身份证号</th>
<th>姓名</th>
<th>曾用名</th>
<th>文化程度</th>
<th>民族</th>
<th>政治面貌</th>
<th>婚姻状况</th>
<th>社保号</th>
<th>户口类型</th>

<th>就业登记备注</th>

</tr>

{foreach item=p from=$papers}
<tr>
<td><input type="checkbox" name="papers[]" value="{$p.id}" class="papers"/></td>
<td>{$p.status|replace:"1":"办理中"|replace:"2":"已办好"|replace:"3":"已发卡"}</td>
<td>{$p.idcard}</td>
<td>{$p.name}</td>
<td>{$p.oldname}</td>
<td>{$p.education}</td>
<td>{$p.nation}</td>
<td>{$p.politics}</td>
<td>{$p.marriage}</td>
<td>{$p.solNumber}</td>
<td>{$p.hukouAddressType}</td>
<td>{if $p.firstApp eq '1'}首次办卡{/if}</td>
</tr>
{/foreach}
</table>


<p>
<input type="button" class="chgStatus" value="办理中" />
<input type="button" class="chgStatus" value="已办好" />
<input type="button" class="chgStatus" value="已发卡" />
<input type="submit" id="excelout" value="生成名单" />
</p>
</form>
</fieldset>
</div>
{include file="footer.tpl"}