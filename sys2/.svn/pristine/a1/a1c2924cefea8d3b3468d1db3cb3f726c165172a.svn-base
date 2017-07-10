<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php
/*
新增/调入 :  1
停交:  0
其他修改:  2
* */
require_once '../header/societyHeader.php';
if(!defined('ALLOW'))exit();
require_once '../settings.inc';
//$userID=$_SESSION['UserID'];
$userID="1";
?>
<body>
<div id="mainBody">
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jqModal.js"></script>
<script type="text/javascript" src="../js/jqModal.litejva8.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.litejava8.css" />
<script type="text/javascript">
$(document).ready(function(){
$('.sub').click(function(){ 
	var type='post';
    var url='sqlTable.php';
    var data=$(this).attr("name")+"=1";
    subPost(type,url,data);
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
});
</script>
<div>
<!--<a name="clear_convert" class='sub' href="#"><img src="../css/images/OA/so_ch_5.gif" /></a>-->
<div id="output"></div>

<a class="thickbox" title="导入未转换的申报表人员名单" href="../Parser/societyManage/xls2mysql/index.php/?table=soConvertSBB&width=100%&amp;height=80%">
导入未转换的申报表人员名单</a>


<div style="" id="modalWindow" class="jqmWindow jqmID1">
        <div id="jqmTitle">
            <button class="jqmClose">
                                    关闭 X
            </button>
            <span id="jqmTitleText"></span>
        </div>
        <iframe id="jqmContent" src=""></iframe>
    </div>
 </div>   
    
    <div>
    <form action="excelSBB.php" method="post">
    <input type="hidden" name="sql" value="select * from soconvertSBB where sessionID='<?php echo $userID;?>'">
    <input type="button" class='sub' name="intoSo2" value="转换申报表">
    <input type="submit" name="intoExcel" value="保存为Excel">
    </form>
    
    </div>
    </div>
</body>
</div>
</body>
</html>
