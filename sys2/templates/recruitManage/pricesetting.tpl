{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">


{literal}
<script type="text/javascript">

$(document).ready(function(){
//	var on = 0;
//	$(".editprice").click(function(){
////		alert("");
//		if(on != 1)
//		{
//			var a = $(this).parent().find('td').eq(1).html();
//			$(this).parent().find('td').eq(1).html("<input type=\"text\" class=\"price\" value=\"" + a + "\" />");
//			on = 1;
//		}
//		else
//		{
//			b = $(this).parent().find('input').val();
//			//alert(b);
//			$(this).parent().find('td').eq(1).html(b);
//			on = 0;
//		}
//		
//	});



	$("#setPrice").click(function(){
		   var t,u,d,dt,m;
	        t = "post";
	        u = "mSQL.php";
	        d = $("form[name=priceForm]").serialize();
	        dt = "json";
	        m = function(json){
	            	var i,n;
	            	$.each(json,function(i,n){
	                		switch(i)
	                		{
	                		case "error":
	                    		alert(n);break;
	                		case "success":
	                    		alert(n);window.location.reload();break;
	                		}
	                	});
	            };

	            ajaxAction(t,u,d+"&btn=setallprices",dt,m);
	    		
	});

	$("#units").change(function(){
		$("form[name=settingpriceForm]").submit();
	});

	
});
</script>
{/literal}
<div id="main">
    <fieldset>    
<form name="settingpriceForm" method="get">
<select name="units" id="units">
<option value="0">全部单位</option>
{html_options options=$units selected=$unit_s}
</select>
</form>

<div id="setprice">
<form name="priceForm">
<table class="myTable halfWidth" >
<tr>
<th>单位</th>
<th>岗位名</th><th>价格</th>
</tr>
{foreach item=p from=$allpositions}
<tr >
<td width="150px">{$p.unitName}</td>
<td width="100px">{$p.name}</td>
<td width="100px">
<input type="text" name="prices[{$p.positionID}]" value="{$p.price}" /></td>
</tr>
{/foreach}
</table>
<input type="button" id="setPrice" value="全部确定" />
</form>


</div>


    </fieldset>
</div>
{include file="footer.tpl"}