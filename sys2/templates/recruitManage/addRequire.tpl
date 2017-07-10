{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
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
										if(confirm(n+"，确定将结束添加需求，取消则继续添加需求") == true)
										{
											window.location.href = "requireManage.php";
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
							ajaxAction(t,u,d + "&btn=createRequire",dt,m);
						};

		
					validator("input[name=createRequire]","#createRequireForm","#errorDiv",successfunc);
					
			});


			$("input[name=deadline]").datepick();

			$("#units").change(function(){

				var unit = $("#units option:selected").val();

				if(unit != 0)
				{
//					alert(unit);
					$.get("ajax.php",{id:unit,btn:"tinsertunit",from:"addrequire"},function(data,textStatus){$("#position").html(data);});
				}
				else
				{
					$("#position").empty();
				}
			});

			
			$("#position").change(function(){

					var option = $("#position option:selected").val();
					var unit = $("#units option:selected").val();
					
					var id;
					if( option == "add")
						window.location.href = "positionCreate.php?u=" + unit;
					else if( option > 0)
					{
						$.get("ajax.php",{id:option,btn:"addrequire"},function(data,textStatus){$("#resText").html(data);});
					}
					
			});


			
	

});
</script>

{/literal}
<div id="main">

<fieldset>
    <legend>
    <code>添加需求</code>
    </legend>
<form id=createRequireForm class="form">
{if $has_id == 1}
<br />
<br />

现在你正在为 <span class="red">{$the_position.unitName}</span> 的 <span class="red">{$the_position.name}</span> 增加需求：

<br />
<br />

<input type="hidden" value="{$positionID}" name="positionID"/>
{/if}





{if $has_no_id == 1}
<!--岗位<select name="position" class="req-string req-numeric xx" id="position"> -->
<!--<option value="">----请选择----</option>-->
<!--{html_options options=$positions}-->
<!--<option value="add">我要新增一个岗位...</option>-->
<!--</select><br />-->



应聘单位<select name="units" id="units" class="req-string req-numeric">
<option value="" >------请选择------</option>
{html_options options=$units selected=$unit_s}</select>  <br />

应聘岗位<select name="positionID" id="position" class="req-string req-numeric">
<option value="" >------请选择------</option>
{html_options options=$positions selected=$position_s}
</select>





<div id="resText"></div>
{/if}
需求人数<input type="text" name="reqTotal" class="req-string req-numeric" /><br />
上岗时间<input type="text" name="deadline" class="req-string req-date" /><br />


<input type="button" name="createRequire" value="确定" />
<input type="reset" value="重置" />

<div id="errorDiv" class="error-div-alternative"></div>

</form>
</fieldset>
</div>
{include file="footer.tpl"}