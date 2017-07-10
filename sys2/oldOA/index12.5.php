<?php
require_once 'companyHeader.php';
if(!defined('ALLOW'))exit();
$userName=$_SESSION['UserID'];
require_once './settings.inc';
$messageSql="select * from message where receiver='$userName' and stauts=0";
$ret2=mysql_query($messageSql);
$rows2=mysql_fetch_array($ret2);
$num=mysql_num_rows($ret2);
//require_once 'societyManager/declareWorkerInfo.php';
?>
<body>
<link src="css/main.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.treeview.min.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(document).ready(
               function(){
                   $("#browser").treeview();
                   
                   $(".link").click(
                           function(){
                            var toLink= $(this).attr('title');
                            $('.mainFrame').attr('src',toLink);
                               });

                   }
				);
	</script>
<div id="wapper">
<div id="header">
<div class="userSpan">
<span>您好,<?php echo $_SESSION['UserName']; ?></span>
</div>
<div class="weather">
<iframe src="http://www.7stk.com/1/6/sina.htm" frameborder="0" width="141" height="20" marginheight="0" marginwidth="0" scrolling="no"></iframe></div>
</div>
<!-----------左边菜单栏-------------->
<div id="left">
<div id="main_left_1">
<table width="100%">
<tr>
<td><img src="css/images/message.gif"  /><a href="#" class="link" title="http://www.cnhrmo.com/publish/messageMain.php">短信箱<?php  if($num!=0){echo "(".$num.")";} ?></a></td>
<td><img src="css/images/changePassword.gif"  /><a href="#" class="link" title="http://www.cnhrmo.com/user/index.php?do=changePass&OASID=30">修改密码</a></td>
</tr>
<tr>
<td><img src="css/images/logoff.gif"  /><a onmouseover="MM_swapImage('Image2','','/images/xgmm_tc2.gif',1)" onmouseout="MM_swapImgRestore()" onclick="if(!confirm('确认退出系统吗?')) { return false;}" href="http://www.cnhrmo.com/oas/logout.php?forward=http://www.cnhrmo.com/user/index.php?OASID=30">退出系统</a></td>

<td><img src="css/images/user.gif"  /><a href="#" class="link" title="KHJLmain.php">回到首页</a></td>
</tr>
</table>
</div>

<ul id="browser" class="filetree">
<?php if($_SESSION['SubGroupIDs']==',21,'){?>
      <li><img src="css/images/folder.gif" />简历管理
			<ul>
				<li><img src="css/images/file.gif" /><a href="#" class="link" title="recruitmentManager/quickWork.php">快速求职简历 </a></li>
				<li><img src="css/images/file.gif" /><a href="#" class="link" title="recruitmentManager/insertQuickWork.php">添加求职简历 </a></li>
			    <li><img src="css/images/file.gif" /><a href="#" class="link" title="recruitmentManager/assiantQuickWorker.php">简历辅助管理 </a></li>
			</ul>
		</li>
		<?php
}
		if($_SESSION['SubGroupIDs']==',14,'){?>
		<li><img src="css/images/folder.gif" />工资管理
			<ul>
				 <li><img src="css/images/file.gif" /><a href="#" class="link" title="Parser/salaryManage/xls2mysql/index.php">导入工资表 </a></li>
				 <li><img src="css/images/file.gif" /><a href="#" class="link" title="salaryManager/singleInsert.php">单条添加 </a></li>
				 <li><img src="css/images/file.gif" /><a href="#" class="link" title="salaryManager/fixed.php">工资查询及更新 </a></li>
				 
			</ul>
		</li>
<!--		<li class="closed">this is closed! <img src="css/images/folder.gif" />-->

        <li><img src="css/images/folder.gif" />员工信息管理
			<ul>
				 <li><img src="css/images/file.gif" /><a href="#" class="link" title="Parser/salaryManage/xls2mysql/indexWorker.php">导入员工花名册 </a></li>
				 <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/singleInsertWorker.php">单条添加</a></li>
				 <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/fixedWorker.php">员工信息查询 </a></li>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/applyManage.php">申请续签明细</a></li>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/userRegiste.php">账号开通/激活</a></li>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/changeDetail.php">员工入/离职概况</a></li>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/manageQuickWork.php">简历管理</a></li>
			</ul>
		</li> 
			<?php 
               }
			if($_SESSION['SubGroupIDs']==',15,'){?>
		<li><img src="css/images/folder.gif" />社保管理
			<ul>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="societyManager/declareWorkerInfo.php">员工工伤申报 </a></li>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="societyManager/declareManage.php">已申报名单</a></li>
			     <li><img src="css/images/file.gif" /><a href="#" class="link" title="societyManager/AllMain.php">分批次社保核对</a></li>
			      <li><img src="css/images/file.gif" /><a href="#" class="link" title="societyManager/generalMain.php">综合审批</a></li>
			      <li><img src="css/images/file.gif" /><a href="#" class="link" title="societyManager/51jobMain.php">前程无忧平帐审核</a></li>
			</ul>
				</li>
				<?php }
				if($_SESSION['SubGroupIDs']==',17,'){
				?>
				
		<li><img src="css/images/folder.gif" />统计分析
		<ul>
<!--		<li><img src="css/images/file.gif" /><a href="#" class="link" title="recruitmentManager/quickWork.php">快速求职简历 </a></li>-->
		<li><img src="css/images/file.gif" /><a href="#" class="link" title="salaryManager/fixed.php">工资查询 </a></li>
		<li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/fixedWorker.php">员工信息查询 </a></li>
	     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/applyManage.php">申请续签明细</a></li>
	     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/userRegiste.php">账号开通/激活</a></li>
	     <li><img src="css/images/file.gif" /><a href="#" class="link" title="workerManager/changeDetail.php">员工入/离职概况</a></li>
	      <li><img src="css/images/file.gif" /><a href="#" class="link" title="societyManager/declareManage.php">社保/商保已申报名单</a></li>
		</ul>
		</li>
		<?php }?>
	</ul>
	</div>
	
	<div id="right" name="right">
	<iframe class="mainFrame" src="KHJLmain.php" frameborder="0" width="100%" height="100%"></iframe>
	</div>
	<div id="footer"><span>Copyright @2006-<?php echo date('Y',time());?> 深圳市鑫锦程人力资源管理有限公司  & 中国人力资源在线  & 深圳人力资源在线</span></div>
	</div>
	</body>