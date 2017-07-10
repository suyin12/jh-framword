{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
<script type="text/javascript">

$(document).ready(function(){

		
			$("input[name=createMarket]").click(function(){

				
					var t,u,d,dt,m;
					t = "post";
					u = "mSQL.php";
					d = $("#createMarketForm").serialize()+"&row=" + curRow;
					dt = "json";
					m = function(json){
							$.each(json,function(i,n){
									switch(i)
									{
									case "exist":
									case "error1":
									case "error2":
										alert(n);
										break;
									case "success":
										if(confirm(n+"，确定结束添加市场，取消则继续添加") == true)
											window.close();
										else
											window.location.reload();
										break;
									}
								});
						};
						successfunc = function(){
							ajaxAction(t,u,d + "&btn=createMarket",dt,m);
						};

					validator("input[name=createMarket]","#createMarketForm","#errorDiv",successfunc);
					
			});


			var curRow = 2;
			$("#insertElement").click(function(){
				
				$("#contactinfo").append("姓名<input type=\"text\" name=\"cName" + curRow + "\"  /> "+
											"职务<input type=\"text\" name=\"job" + curRow + "\" /> "+
											"负责事项<input type=\"text\" name=\"affair" + curRow + "\" /> "+
											"固定电话<input type=\"text\" name=\"telephone" + curRow + "\" /> "+
											"手机<input type=\"text\" name=\"mobile" + curRow + "\" /><br /> ");
				curRow = curRow + 1;
			});

});
</script>
{/literal}
<div id="main">

<fieldset>


<form id="createMarketForm" class="form">


市场名称<input type="text" name="name" class="req-string" />
所属区域<input type="text" name="district" />
地址<input type="text" name="address" />
交通路线<input type="text" name="line" /> <br />


联系人<br />
<div id="contactinfo" >
姓名<input type="text" name="cName1"  />
职务<input type="text" name="job1" />
负责事项<input type="text" name="affair1" />
固定电话<input type="text" name="telephone1" />
手机<input type="text" name="mobile1" />  <br />
</div>
<br />
<input type="button" id="insertElement" value="增加一个联系人" /> <br />
开发时间<input type="text" name="openDate"  />
开发人<select name="openBy" class="req-string req-numeric ">
	<option value="">------请选择------</option>
	{html_options options=$users}</select>

有效期：<input type="text" name="period_s" />至<input type="text" name="period_e" />  <br />

费用状况<input type="text" name="fee" />
合作状态<input type="text" name="status" />
展位区域<input type="text" name="area" />
距离里程<input type="text" name="distance" class="req-string req-numeric" />   <br />
其它信息<textarea rows="4" cols="60" name="other" ></textarea> <br />


市场特色<textarea rows="4" cols="60" name="special" ></textarea><br />
适合岗位<textarea rows="4" cols="60" name="properposition" ></textarea><br />
注意事项<textarea rows="4" cols="60" name="attention" ></textarea><br />

<input type="button" name="createMarket" value="确定" /><input type="reset" value="重置" />



<div id="errorDiv" class="error-div-alternative"></div>

</form>



</fieldset>
</div>
{include file="footer.tpl"}