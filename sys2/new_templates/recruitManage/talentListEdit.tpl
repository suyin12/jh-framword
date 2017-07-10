{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/fixedTable.js>
</script>
<link rel="stylesheet" type="text/css" href='{$css}' />
{literal}
<script type="text/javascript">

$(document).ready(function(){
	

	var editfunc = function(){

		var t,u,d,dt,m;
		t = "post";
		u = "mSQL.php";
		d = $("form[name=tlEditForm]").serialize();
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
		            	alert(n);
	                	break;
            		}
            	});
			};
		ajaxAction(t,u,d+ "&btn=tlEdit",dt ,m);
	};

	

	$("#unitId").change(function(){
			var unit = $("#unitId option:selected").val();
			if(unit != 0)
			{
				$.get("ajax.php",{id:unit,btn:"tinsertunit"},function(data,textStatus){$("#posId").html(data);});
			}
			else
			{
				$("#posId").empty();
			}
	});

	$("input[name=tlEdit]").click(editfunc);

    
});


</script>
{/literal}
<div id="main">
<fieldset>


<form name="tlEditForm" method="post">
<input type="hidden" name="talent" value="{$talent.talentID}" />
<table class="myTable" width="100%">
<thead>
<tr>
		<th>姓名</th>	
		<th>性别</th>
		<th>电话</th>		
		<th>身份证号</th>

</tr>

<tr>
<td>{$talent.t_name}</td>
<td title="{$talent.t_name}">{$talent.sex|replace:"1":"男"|replace:"2":"女"}</td>
<td title="{$talent.t_name}">{$talent.t_telephone}</td>
<td title="{$talent.t_name}">{$talent.idCard}</td>
</tr>

<tr>
		<th>单位</th>
		<th>应聘岗位</th>
		<th>单位备注</th>
		<th>岗位备注</th>
<!--		<th>交资料</th>-->
</tr>
<tr>
<td title="{$talent.t_name}"><select name="unitId" id="unitId" disabled>{html_options options=$units selected=$talent.unitId }</select></td>
<td title="{$talent.t_name}"><select name="posId" id="posId" disabled>{html_options options=$positions selected=$talent.positionID}</select></td>
<td title="{$talent.t_name}"><input type="text" name="unitRemarks" value="{$talent.unitRemarks}" class="" /></td>
<td title="{$talent.t_name}"><input type="text" name="posRemarks" value="{$talent.posRemarks}"  class="bluredit"/></td>
<!--<td title="{$talent.t_name}">{$talent.d_material|replace:1:"无"|replace:2:"户口本"|replace:3:"计生证"|replace:4:"体检表"|replace:5:"户口本,计生证"|replace:6:"户口本,体检表"|replace:7:"计生证,体检表"|replace:8:"户口本,计生证,体检表"}</td>-->
</tr>
<tr>
		<th>交资料2</th>
		<th>培训</th>
		<th>证明人</th>
		<th>料递交单位</th>		
</tr>
<tr>
<td title="{$talent.t_name}"><input type="text" name="material" value="{$talent.material}"  class="bluredit"/></td>
<td title="{$talent.t_name}"><select name="train" class="trc">{html_options options=$TRCyesno selected=$talent.d_train}</select></td>
<td title="{$talent.t_name}"><select name="reference" class="trc">{html_options options=$TRCyesno selected=$talent.d_reference}</select></td>
<td title="{$talent.t_name}"><select name="commit" class="trc">{html_options options=$TRCyesno selected=$talent.d_commit}</select></td>
</tr>


<tr>
		<th>培训成绩</th>
		<th>备注1</th>
		<th>备注2</th>
</tr>


</thead>
<tbody>


<tr>
<td title="{$talent.t_name}">{$talent.marks}</td>
<td title="{$talent.t_name}"><input type="text" name="remarksA" value="{$talent.remarksA}"  class="bluredit"/></td>
<td title="{$talent.t_name}"><input type="text" name="remarksB" value="{$talent.remarksB}"  class="bluredit"/></td>
</tr>

</tbody>

</table>
<input type="button" name="tlEdit" value="确定" />


</form>

</fieldset>
</div>
{include file="footer.tpl"}