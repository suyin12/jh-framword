$(document).ready(function(){

//POST提交
$('.sub').click(function(){ 
	
	var type='post';
    var url='51jobSqlTable.php';
    var data=$(this).attr("name")+"=1&month="+$('.month').attr("value");
//    alert(data);
    subPost(type,url,data);
    var name=$(this).attr("name");
    
    if(name!='clear_small'){
//    $(this).css({visibility:'hidden'});
    $('.disSub').css({display:'inline-block'});
    }
    
   });
$('.delBtn').click(function(){
    if(confirm("确定要执行删除操作?"))
    {
	var type='post';
    var url='51jobSqlTable.php';
    var data=$('form[name=manageForm]').serialize();
//    alert(data);
    subPost(type,url,data);
    }
    else
    {
        return false;}
});
function subPost(t,u,d)
{
$.ajax({
	   type:t,
	   url: u,
	   data: d,
	   datatype:'html',
	   success:function(html){
         $('#output').html(html);
         
	   }
	    });
}
//全反选
$('.checkAll').click(function(){
 if($(this).attr('checked')==true){
	$(':checkbox[name="checkName[]"]').attr('checked', true);
 }
 else
 {
	 $(':checkbox[name="checkName[]"]').attr('checked', false);
	 }
});

//点击clear  text
$('input[name="delMonth"]').one("click",function(){

	$(this).attr("value","");
});

//显示按钮
$('.disSub').click(function(){

$('.sub').css({display:"block"});
	
}
);
$('#displayP').click(function(){

	$('#site_1').slideToggle('slow');
});
//数据POST提交
$('.month').change(function(){
   $('#site_1').slideUp('slow');

	if($(this).attr('value')!="")
	{
		$('.btnList2').css({display:"inline-block",margin:"0 0 0 0px"});
		}
	else
	{
		$('.btnList2').css({display:"none"});
		}
	if($('.month').val()!=0){
		var actionUrl="balError.php";
		$('#errorRet').load(actionUrl,{"month":$(".month").val(),"fromUrl":"51job"});
	}
		
});

});