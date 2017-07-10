{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(function(){
	var numId = $("tbody div");
	numId.click(function(){
		var tdIns = $(this);
		if ( tdIns.children("input").length>0 ){ return false; }		

		var inputIns = $("<input type='text'/>"); //需要插入的输入框代码
		var text = $(this).html();

		inputIns.width(tdIns.width());//设置input与td宽度一致
		inputIns.val(tdIns.html());//将本来单元格td内容copy到插入的文本框input中
		tdIns.html("");//删除原来单元格td内容

		//ajax 更新角色名称
		
		/*$.get("userAjax.php", {unit:unitstr,uid:uid}, function(data){
		    alert(data);
		});*/

		
		inputIns.appendTo(tdIns).focus().select();//将需要插入的输入框代码插入dom节点中
		
		inputIns.click(function(){ return false;});
		
		//处理Enter和Esc事件
		inputIns.keyup(function(event){
				var keycode = event.which;				
				if( keycode == 13 ){ 
				  var inputText = $(this).val(); 
				  tdIns.html(inputText);
				}
				if( keycode == 27 ){
				  tdIns.html(text);
				}
		});
	});
});
</script>
{/literal}
</head>
<body>
<table border="0" class="myTable">
<thead>
<tr>
<td>ID</td>
<td>角色名称</td>
<td>操作</td>
</tr>
</thead>
</tbody>
{foreach item=value from=$roleResult }
<tbody>
<tr>
  <td>{$value.roleID}</td>
  <td><div>{$value.roleName}</div></td>
  <td><a href="edit_role.php?id={$value.roleID}">设置权限</a></td>
</tr>
{/foreach}
</tbody>
</table>
{include file="footer.tpl"}