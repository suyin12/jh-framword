<?php require_once "../companyHeader.php"; ?>

  <div id="right" name="right">
<?php 
require_once '../header/companyHeader.php';
if(!defined('ALLOW'))exit();
require_once '../settings.inc';
$todayY=date('Y',time());
$todayM=date('m',time());
?>
<body>
<div id="mainBody">
<script>
	$(document).ready(function(){
            $('select').change(function(){
            	if($(this).attr('name')=="manager"&& $(".month").val()==0)
    			{
    				alert("请选择月份");
    			}
    			if($(".month").val()!=0){
        			var actionUrl=$(":radio[checked]").attr("title");
//        			alert(actionUrl);
            	$('#errorRet').load(actionUrl,{"month":$(".month").val(),"manager":$(".manager").val(),"fromUrl":"bal"});
    			}
                });
			
             $(':radio').click(function(){
            	   $('select').attr("value","");
                   $('#errorRet').empty();
                     });
			 	});
 	
</script>
<div id="unit">
<br/>
<br/>
<br/>
<!--<input type="radio" name="radioName[]" title="balUnitDetail.php" checked="checked"/>查看各月单位欠款/挂账概况-->
<input type="radio" name="radioName[]" title="balError.php" checked="checked" />查看各月个人欠款/挂账概况
<br/>
<br/>
<br/>
月份:<select class="month" name="month">
<option value="" selected>--请选择--</option>
<?php for($i=1;$i<=12;$i++){
if($i<10){$k="0".$i;}else {$k=$i;}
    ?>
<option value="<?php echo $todayY.$k;?>" <?php if($_POST['month']==$todayY.$k) echo "SELECTED";?>><?php echo $todayY."年".$k."月" ?></option>
<?php }?>
</select>
客户经理:<select class="manager" name="manager">
	<option value="" <?php if($_POST['manager']=="") echo "SELECTED";?>>--所有客户经理--</option>
	<?php 
	$managerSql="select * from cwps_user where SubGroupIDs=',14,'";
    $managerRet=mysql_query($managerSql);
	while ($managerRow=@mysql_fetch_array($managerRet))
	{
	?>
	<option value="<?php echo $managerRow['UserID'];?>"<?php if($_POST['manager']==$managerRow['UserID']) echo "SELECTED";?>><?php echo $managerRow['UserName'];?></option>
	<?php 
	}
	?>
	</select>
<div id="errorRet">

</div>
</div>

</body>

</div>
</body>
</html>
