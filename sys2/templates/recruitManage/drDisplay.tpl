{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/supernote.js></script>
{literal}
<script type="text/javascript">
/* jQuery plugins supernote START  */
var supernote = new SuperNote('supernote', {});
function animFade(ref, counter)
{
	var f = ref.filters, done = (counter == 1);
	if (f)
	{
		if (!done && ref.style.filter.indexOf("alpha") == -1)
			ref.style.filter += ' alpha(opacity=' + (counter * 100) + ')';
		else if (f.length && f.alpha) with (f.alpha)
		{
			if (done) enabled = false;
			else { opacity = (counter * 100); enabled=true }
		}
	}
	else ref.style.opacity = ref.style.MozOpacity = counter*0.999;
};
supernote.animations[supernote.animations.length] = animFade;
addEvent(document, 'click', function(evt)
{
	var elm = evt.target || evt.srcElement, closeBtn, note;
	while (elm)
	{
		if ((/note-close/).test(elm.className)) closeBtn = elm;
		if ((/snb-pinned/).test(elm.className)) { note = elm; break }
		elm = elm.parentNode;
	}
	if (closeBtn && note)
	{
		var noteData = note.id.match(/([a-z_\-0-9]+)-note-([a-z_\-0-9]+)/i);
		for (var i = 0; i < SuperNote.instances.length; i++)
		if (SuperNote.instances[i].myName == noteData[1])
	{
		setTimeout('SuperNote.instances[' + i + '].setVis("' + noteData[2] +
					'", false, true)', 100);
		cancelEvent(evt);
	}
	}
});
addEvent(supernote, 'show', function(noteID)
{
});
addEvent(supernote, 'hide', function(noteID)
{
});
/* jQuery plugins supernote END  */


$(document).ready(function(){
			// cell表示的是点击的第几个cell
			var arid,marketid,amorpm,date,cell,cell_content,planid; 
			
			// 遍历单元格  给num赋值 记住单元格的位置
			$('.supernote-click-showusers').each(function(i){
				$('.supernote-click-showusers').eq(i).click(function(){
					cell = i;
					cell_content = $(this).val();
					arid = $(this).siblings(".arid").attr("value");
					marketid = $(this).siblings(".marketID").attr("value");
					amorpm = $(this).siblings(".amorpm").attr("value");
					date = $(this).siblings(".date").attr("value");
					planid = $(this).siblings(".planid").attr("value");

				});	
		    }); 

      		// 使用cell的值，向相应位置的单元格填充选中的内容
			$(".users").each(function(k){
   				$(this).click(function(){
       			        var uid = $(this).attr("id");
       			        var content = $(this).text();
//       			        alert(content);
       			        if(uid != 0)
       			        {
           			        if(cell_content == "")
       			    			$('.supernote-click-showusers').eq(cell).val(content);
           			        else
           			        {
               			        var dd = $('.supernote-click-showusers').eq(cell).val();
               			        $('.supernote-click-showusers').eq(cell).val(dd + "," + content);
           			        }
       			        }
       			        else
           			        $('.supernote-click-showusers').eq(cell).val("");

       			    	// Ajax提交到服务器
       			    	var t,u,d,dt,m;
       			    	// x:横坐标 表示日期
       			    	// y:纵坐标 表示市场 用来计算上午场还是下午场用

       			    	t = "post";
       			    	u = "mSQL.php";

       			    	d = "uid=" + uid + "&marketid=" + marketid + "&arid=" + 
       			    		arid + "&amorpm=" + amorpm + "&date=" + date + "&planid=" + planid + "&btn=arrangement";		    	
  
       			    	dt = "json";
       			    	
       			    	m = function(json){
       			    		var i,n;
       						$.each(json,function(i,n){
       							switch(i)
       							{
       							case "error":
       							case "error2":
       								alert(n);
      								window.location.reload();
       								break;
//       							case "success":
//       								window.location.reload();
       								break;
       							}
       						});
       		
           			    };
       			    	
       			    	if(uid != 0 && arid == 0)
       			    		ajaxAction(t,u,d + "&type=insert",dt,m);
       			    	else if(uid != 0 && arid != 0)
           			    	ajaxAction(t,u,d + "&type=update",dt,m);
       			    	else
           			    	ajaxAction(t,u,d + "&type=delete",dt,m);
       			    	
       			});
		  	});
		  	
			$("input[name=dirAr]").click(function(){
				alert("hah");
				var t,u,d,dt,m;
				t = "post" ;
				u = "mSQL.php";
				d = $("#dirArForm").serialize();
				dt = "json";
				m = function(json){
		    			var i,n;
						$.each(json,function(i,n){
							switch(i)
							{
							case "error":
							case "error2":
								alert(n);
								break;
							case "success":
							case "success2":
//								window.location.reload();
								break;
							}
						});
   			    };

      			 ajaxAction(t,u,d + "&btn=dirAr",dt,m);
			});

			
});
</script>
<style>
<!--
.table_left {
	width:200px;
/*	position:absolute;*/
	float:left;
                      left:300px;
	 border: solid 1px #000;
}

.table_left tr th {
                    height:30px;
	text-align:center;
}
.table_left tr td {
	height:30px;
                     height:30px\9;
	text-align:center;
        border: solid 1px #000;
}
.table_right {
/*	position:absolute; */ 
	left:500px;
        border: solid 1px #000;
		width:1200px;
		
}
.table_right tr {
	height:31px;
}
.table_right tr th {
	text-align:center;
}
.table_right tr td {
	width:100px;
                     border: solid 1px #777;

}
.table_right tr td input {
	width:100px;
	height:100%;
	border:0px;
        
text-align:center;
}
.table_bottom {
text-align:center;
}
.color_blue {
	background:#aaccdd;
}
.color_red {
	background:#CFEBFB;
}
.color_blue input {
		background:#aaccdd;
}
.color_red input {
	background:#CFEBFB;
}
.whole_table {
	height:100%;
}
-->
</style>
{/literal}
<div id="main">
<fieldset>
<a class="noSub positive" href="drManage.php" >返回选择</a>
<a class="noSub positive" href="{$curURL}"  >刷新</a>
<div>

<input type="hidden" name="date_from" value="{$date_from}" />
<input type="hidden" name="date_to" value="{$date_to}" />
<table border="1">
		<tr>
				<td>
				
						<table class="table_left" border="1">
						<tr>
						<th colspan="2" height="30px">市场</th>
						</tr>
						{foreach item=market key=marketID from=$markets}
						<tr><td rowspan="2">{$market}</td><td>上午场</td></tr>
						<tr><td>下午场</td></tr>
						{/foreach}
						</table>
				
				</td>
				<td>
						<form>
						<table class="table_right" border="1">
								<tr>
								{foreach item=date key=k from=$dates_head}
								{if $date eq $current_date_without_y}
								<th style="background:#aaccdd;color:blue">{$date|replace:"Mon":"一"|replace:"Tue":"二"|replace:"Wed":"三"|replace:"Thu":"四"|replace:"Fri":"五"|replace:"Sat":"六"|replace:"Sun":"日"}</th>
								{else}
								<th >{$date|replace:"Mon":"一"|replace:"Tue":"二"|replace:"Wed":"三"|replace:"Thu":"四"|replace:"Fri":"五"|replace:"Sat":"六"|replace:"Sun":"日"}</th>
								{/if}
								{/foreach}
								</tr>
								
								{foreach key=marketID item =dailyRecruit from=$ar}
						  	 	{foreach item =m from=$apm}
						 	  	<tr >
							   	{foreach item=date from=$dates}
							   	

						
							    {foreach item=name_id key=arid from=$dailyRecruit.$m.$date}
							    
							    
							    {foreach item=stored_planid key=name from=$name_id}
							    
						  		{if $date lt  $current_date }
								{assign var="disabled" value="disabled"}
							<!--	{assign var="disabled" value=""}-->

						  		{else}
						 		{assign var="disabled" value=""}
						 		{/if}
						
								{if $date == $current_date}
								
								{if  $stored_planid == $id}
							 	<td  class="color_red">
							  	{else}
							  	<td  class="color_blue">
							  
							  	{/if}
							  	
							  	{else}
							   	
							   	
								{if  $stored_planid == $id}
							 	<td   class="color_red">
							  	{else}
							  	<td   >
							  	{/if}
							  	
							  	
							  	{/if}
							  	
							
								{if $date < $current_date }
						 		<input type="text" size="7" value="{$name}" {$disabled} readonly />
							<!--	<input type="text" size="7" class="supernote-click-showusers" style="width:170px" value="{$name}" {$disabled} readonly/>-->
						  		{else}
						  		<input type="text" size="7" class="supernote-click-showusers" style="width:170px" value="{$name}" {$disabled} readonly/>
						  		{/if}
						
						  		<input type="hidden"  class="arid" value="{$arid}" />
						  		<input type="hidden"  class="marketID" value="{$marketID}" />
						  		<input type="hidden"  class="amorpm" value="{$m}" />
						  		<input type="hidden"  class="date" value="{$date}" />
							    <input type="hidden"  class="planid" value="{$id}" />
							    <input type="hidden"  class="stored_planid" value="{$stored_planid}" /> 
							    
							    {/foreach}
						       
						  		{/foreach}
						  		</td>
								{/foreach}
						   		</tr>
						   		{/foreach}
						
								{/foreach}
						
						</table>
						</form>
				</td>
				
				
	
				
				
				
		
		</tr>

</table>



</div>

<div>
<br />
<div>
<form id="dirArForm" class="form">
日期<select name="dir_d">{html_options options=$dir_dates}</select>
场次<select name="dir_a">{html_options options=$dir_apm}</select>
市场<select name="dir_m">{html_options options=$allmarkets}</select>
人员<select name="dir_u">{html_options options=$allusers}</select>
<input type="button" name="dirAr" value="添加" />

</form>
</div>

<br />
<span style="color: red"></span>
<table class="table_bottom" border="2">
<tr>
<td width="150">姓名</td><td width="150">场次</td><td width="150">里程</td>
</tr>

{foreach key=user item=static from=$statics}
<tr>
<td>{$user}</td><td>{$static.num}</td><td>{$static.dis}</td>
</tr>
{/foreach}
</table>
</div>



<div id="supernote-note-showusers" class="snp-mouseoffset snb-pinned notedefault"><a name="showusers"></a>

	<h5><a href="#" class="note-close">X</a> 请选择招聘人员</h5>
	{foreach item=user key=k from=$users}
	<li><a href="#" class="users" id={$k}>{$user}</a></li>
	{/foreach}
	<li><a href="#" class="users" id="0"><span style="color:red;">删除人员</span></a></li>
	
</div>



</fieldset>
</div>
{include file="footer.tpl"}
