<?php 
/*
公司内部员工头文件
* */
@session_start();
//$subGroupID=14;
//$_SESSION['Cqyyh']=13;

	if($_SESSION['Cqyyh']!=13)
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>非本公司员工无权访问</p>";
	}
	else{
	    define('ALLOW',true);
	   	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>鑫锦程OA管理系统</title>




<script type="text/javascript" src="/publish/OA/js/jquery-1.3.2.min.js"></script>

<style type="text/css">


/* Moz */  
* { margin:0; padding:0; list-style:none;}
html { height:100%; overflow:hidden; background:#6cadfa;}
body { height:100%; overflow:hidden; background:#6cadfa; font-size:12px;}
div { background:#ffffff; line-height:1.6;display:inline;} /* www.codefans.net */
.top { position:absolute; left:0px; top:0px; right:0px; height:80px;}
.side { position:absolute; left:5px; top:85px; bottom:5px; width:230px; overflow:auto;}
.main { position:absolute; left:240px; top:85px; bottom:0px; right:0px; overflow:auto;}
/*.bottom { position:absolute; left:5px; bottom:5px; right:5px; height:30px;}*/
html { _padding:70px 10px;} /* www.codefans.net */
.top { _height:80px; _margin-top:-60px; _margin-bottom:10px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}
.side { _height:100%; _float:left; _width:220px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}
.main { _height:100%; _margin-left:227px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}
/*.bottom { _height:30px; _margin-top:10px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}*/
#right { width:112%;margin:10px;float:left;display:inline; }
#right2 { width:90%; margin: 10px 10px 10px 10px;display:inline;}
td { font-size:12px;}
.userSpan { float:left; margin:0 20px 0 0;height:50px;}
#weather { float:right; margin:5px 10px 0 0; height:50px; }
.tablesorter { width:100%;}
#footer{display:block;
	clear:both;
	width:100%;
	height:20px;
	line-height:30px;
	text-align:center;
}
p{color:bule;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
table{font-size:12px;}
.th{background: #CAE8EA;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
.td{background:#ffffff;text-align:center;}
.wokerBasicTable { width:100%;}
.hiddenRemarks {
	display: none;
	z-index: 9999;
	margin: 0 auto;
	width: 150px;
	float : left;
	padding: 10px;
	position: absolute;
	background: #8fbff0;
	padding: 10px;
	float: left;
    color:#aff005;
}
.filetree li { padding: 3px 0 2px 16px; }
.filetree span.folder, .filetree span.file { padding: 1px 0 1px 16px; display: block; }
.filetree span.folder { background: url(images/folder.gif) 0 0 no-repeat; }
.filetree li.expandable span.folder { background: url(images/folder-closed.gif) 0 0 no-repeat; }
.filetree span.file { background: url(images/file.gif) 0 0 no-repeat; }
#left{
width:200px;
}
#qy_bk1 { margin:0; 	
    border-color:#000;
	border-style:solid;
	border-width:1px;
	border-bottom-color:#000;
	border-bottom-style:hidden;
	border-bottom-width:1px;
	border-right-color:#000;
	border-right-style:hidden;
	border-right-width:1px;
	}
#qy_bk1 td {
	border-bottom-color:#000;
	border-bottom-style:solid;
	border-bottom-width:1px;
	border-right-color:#000;
	border-right-style:solid;
	border-right-width:1px;
	}
#qy_bk1 th { background:#CCC;  	
    border-bottom-color:#000;
	border-bottom-style:solid;
	border-bottom-width:1px; 
	border-right-color:#000;
	border-right-style:solid;
	border-right-width:1px;
	}
.logo { float:left; height:50px; width:242px; margin:10px 0 0 0;}
.userSpan { float:left; height:30px; margin:30px 0 0 10px;}
#headindex {background:#F7F7F7;   text-align:left; height:30px;}
#searchCondition {background:#ffffff;  text-align:left;height:30px;}
.bjt {}



 /* IE6 */
*html * { margin:0; padding:0; list-style:none;}
*html html { height:100%; overflow:hidden; background:#6cadfa;}
*html body { height:100%; overflow:hidden; background:#6cadfa; font-size:12px;}
*html div { background:#ffffff; line-height:1.6;display:block;} /* www.codefans.net */
*html .top { position:absolute; left:0px; top:0px; right:0px; height:60px;}
*html .side { position:absolute; left:5px; top:80px; bottom:0px; width:230px; overflow:auto;}
*html .main { position:absolute; left:200px; top:80px; bottom:0px; right:13px; overflow:auto;}
*html .main8 { position:absolute; left:200px; top:80px; bottom:0px; right:13px; overflow:auto;}
/**html .bottom { position:absolute; left:5px; bottom:5px; right:5px; height:30px;}
*/
*html html { _padding:70px 10px;} /* www.codefans.net */
*html .top {  width:101.6%; _height:70px; _margin-top:-0px; _margin-bottom:5px; _position:relative; _top:-70px; _right:0px; _bottom:0; _left:-10px;}
*html .side { _height:108%; _float:left; _width:200px; _position:relative; _top:-69px; _right:0; _bottom:0; _left:-5px;}
*html .main {float:left; width:84.4%; _height:108%; _margin-left:-85px; _position:relative; _top:-69px; _right:13px; _bottom:0; _left:85px;}
*html .main8 {float:left; _width:84.4%; _height:108%; _margin-left:-10px; _position:relative; _top:-69px; _right:13px; _bottom:0; _left:10px;}
/**html .bottom {width:100.7%; _height:30px; _margin-top:5px; _position:relative; _top:0; _right:10px; _bottom:5px; _left:-5px;}*/
*html #right { width:100%; margin: 10px 10px 10px 10px;}
*html #right2 { width:100%; margin: 10px 10px 10px 10px;}
*html td { font-size:12px;} 
*html .userSpan { float:left; margin:0 20px 0 0;height:50px;}
*html #weather { float:right; margin:5px 5px 0 0; height:50px;}
*html .tablesorter { width:100%;}
*html #footer{
	clear:both;
	width:100%;
	height:0px;
	line-height:30px;
	text-align:center;
}
*html p{color:bule;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; width:100%;}
*html table{font-size:12px;}
*html .th{background: #CAE8EA;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
*html .td{background:#ffffff;text-align:center;}
*html .wokerBasicTable { width:100%;}
*html .filetree li { padding: 3px 0 2px 16px; }
*html .filetree span.folder, .filetree span.file { padding: 1px 0 1px 16px; display: block; }
*html .filetree span.folder { background: url(images/folder.gif) 0 0 no-repeat; }
*html .filetree li.expandable span.folder { background: url(images/folder-closed.gif) 0 0 no-repeat; }
*html .filetree span.file { background: url(images/file.gif) 0 0 no-repeat; }
*html #left{
width:200px;
}
*html #qy_bk1 { margin:0; 	
    border-color:#000;
	border-style:solid;
	border-width:1px;
	border-bottom-color:#000;
	border-bottom-style:hidden;
	border-bottom-width:1px;
	border-right-color:#000;
	border-right-style:hidden;
	border-right-width:1px;
	}
*html #qy_bk1 td {
	border-bottom-color:#000;
	border-bottom-style:solid;
	border-bottom-width:1px;
	border-right-color:#000;
	border-right-style:solid;
	border-right-width:1px;
	}
*html #qy_bk1 th { background:#CCC;  	
    border-bottom-color:#000;
	border-bottom-style:solid;
	border-bottom-width:1px; 
	border-right-color:#000;
	border-right-style:solid;
	border-right-width:1px;
	}
*html .logo { float:left; height:50px; width:242px;}
*html .userSpan { float:left; height:30px; margin:30px 0 0 10px;}
*html #headindex {background:#F7F7F7; text-align:left; height:30px;}
*html #searchCondition {background:#ffffff; text-align:left;height:30px;}
*html .bjt { }


/* IE7 */
*+html * { margin:0; padding:0; list-style:none;}
*+html html { height:100%; overflow:hidden; background:#6cadfa;}
*+html body { height:100%; overflow:hidden; background:#6cadfa; font-size:12px;}
*+html div { background:#ffffff; line-height:1.6;} /* www.codefans.net */
*+html .top { position:absolute; left:0px; top:0px; right:0px; height:60px;}
*+html .side { position:absolute; left:5px; top:65px; bottom:5px; width:230px; overflow:auto;}
*+html .main { position:absolute; left:240px; top:65px; bottom:0px; right:0px; overflow:auto;}
/**+html .bottom { position:absolute; left:5px; bottom:5px; right:5px; height:30px;}*/
*+html html { _padding:70px 10px;} /* www.codefans.net */
*+html .top { _height:70px; _margin-top:-60px; _margin-bottom:10px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}
*+html .side { _height:100%; _float:left; _width:220px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}
*+html .main { _height:100%; _margin-left:227px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}
/**+html .bottom { _height:30px; _margin-top:10px; _position:relative; _top:0; _right:0; _bottom:0; _left:0;}*/
*+html #right { width:96%; margin: 10px 10px 10px 10px;}
*+html #right2 { width:50%; margin: 10px 10px 10px 10px;}
*+html td { font-size:12px;}
*+html .userSpan { float:left; margin:0 20px 0 0;height:50px;}
*+html #weather { float:right; margin:5px 10px 0 0; height:50px;}
*+html .tablesorter { width:100%;}
*+html #footer{display:block;
	clear:both;
	width:100%;
	height:20px;
	line-height:30px;
	text-align:center;
}
*+html p{color:bule;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
*+html table{font-size:12px;}
*+html .th{background: #CAE8EA;font: bold 12px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;}
*+html .td{background:#ffffff;text-align:center;}
*+html .wokerBasicTable { width:100%;}
*+html .filetree li { padding: 3px 0 2px 16px; }
*+html .filetree span.folder, .filetree span.file { padding: 1px 0 1px 16px; display: block; }
*+html .filetree span.folder { background: url(images/folder.gif) 0 0 no-repeat; }
*+html .filetree li.expandable span.folder { background: url(images/folder-closed.gif) 0 0 no-repeat; }
*+html .filetree span.file { background: url(images/file.gif) 0 0 no-repeat; }
*+html #left{
width:200px;
}
*+html #qy_bk1 { margin:0; 	
    border-color:#000;
	border-style:solid;
	border-width:1px;
	border-bottom-color:#000;
	border-bottom-style:hidden;
	border-bottom-width:1px;
	border-right-color:#000;
	border-right-style:hidden;
	border-right-width:1px;
	}
*+html #qy_bk1 td {
	border-bottom-color:#000;
	border-bottom-style:solid;
	border-bottom-width:1px;
	border-right-color:#000;
	border-right-style:solid;
	border-right-width:1px;
	}
*+hml #qy_bk1 th { background:#CCC;  	
    border-bottom-color:#000;
	border-bottom-style:solid;
	border-bottom-width:1px; 
	border-right-color:#000;
	border-right-style:solid;
	border-right-width:1px;
	}
*+html .logo { float:left; height:50px; width:242px;}
*+html .userSpan { font-size:12px; float:left; height:30px; margin:20px 0 0 10px;}
*+html #headindex {background:#F7F7F7;  text-align:left; height:30px;}
*+html #searchCondition {background:#ffffff;  text-align:left; height:30px;}
*+html .bjt {}
.tishi {font-size:30px;}

</style>



</head>
<body>
<?php 
/*
公司内部员工头文件
* */
@session_start();
//$subGroupID=14;
//echo "aaa=".$_SESSION['Cqyyh'];
//$_SESSION['Cqyyh']=13;
	if($_SESSION['Cqyyh']!=13)
	{
	echo "<p style='text-align:center;font-size:15px;margin-top:200px;color:#4f6b72'>非本公司员工无权访问</p>";
	}
	else{
	    define('ALLOW',true);
	   	}
	



if(!defined('ALLOW'))exit();
$userName=$_SESSION['UserID'];

$month = date("Y-m",time());
require_once 'settings.inc';
$messageSql="select * from message where receiver='$userName' and stauts=0";
$ret2=mysql_query($messageSql);
$rows2=mysql_fetch_array($ret2);
$num=mysql_num_rows($ret2);
//require_once 'societyManager/declareWorkerInfo.php';
?>

<div class="top">
<div class="bjt">
<div class="logo">

  <img src="/publish/OA/images/logo2.gif" width="242" height="50" /></div>
 <div class="userSpan"> <span><strong>您好，<?php echo $_SESSION['UserName']; ?></strong></span>
 
<br />
  <a href="http://mail.xjchr.com">进入我的企业邮箱 </a>&nbsp;|&nbsp;<a onMouseOver="MM_swapImage('Image2','','/images/xgmm_tc2.gif',1)" onMouseOut="MM_swapImgRestore()" onClick="if(!confirm('确认退出系统吗?')) { return false;}" href="http://www.cnhrmo.com/oas/logout.php?forward=http://www.cnhrmo.com/user/index.php?OASID=30">退出系统</a></div>
<div id="weather">

    <iframe src="http://m.weather.com.cn/m/pn11/weather.htm?id=101280601T " width="490" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" allowTransparency=true ></iframe>
  </div>  
 </div>    
  </div>

</div>
<div class="side">
  <!-----------左边菜单栏-------------->
  <div id="left">
    <div id="main_left_1">
      <table width="200" align="center">
        <tr>
          <td><img src="/publish/OA/css/images/message.gif"  /><a href="http://www.cnhrmo.com/publish/messageMain.php" class="link" t>短信箱
            <?php  if($num!=0){echo "(".$num.")";} ?>
            </a></td>
          <td><img src="/publish/OA/css/images/changePassword.gif"  /><a href="http://www.cnhrmo.com/user/index.php?do=changePass&OASID=30" class="link"  >修改密码</a></td>
        </tr>
        <tr>
          <td><img src="/publish/OA/css/images/logoff.gif"  /><a onMouseOver="MM_swapImage('Image2','','/images/xgmm_tc2.gif',1)" onMouseOut="MM_swapImgRestore()" onClick="if(!confirm('确认退出系统吗?')) { return false;}" href="http://www.cnhrmo.com/oas/logout.php?forward=http://www.cnhrmo.com/user/index.php?OASID=30">退出系统</a></td>
          <td><img src="/publish/OA/css/images/user.gif"  /><a href="/publish/OA/index.php" class="link" >回到首页</a></td>
        </tr>
      </table>
      <hr />

    </div>
    <ul id="browser" class="filetree">
      <li><img src="/publish/OA/css/images/folder.gif" />公用模块
        <ul>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/OA/grade/gradePage.php?month=<?php echo $month ?>" class="link" >群众评议表（员工）</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/OA/grade/gradeManagerPage.php?month=<?php echo $month ?>" class="link">群众评议表（管理层）</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/OA/grade/perDetail.php?month=<?php echo $month ?>" class="link" >个人评议结果查询</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="workerManager/waitWorkList.php?con=name&textVal=&search=查找&schedule=lastModifyTime&status[2]=0" target="_blank">待上岗名单管理</a></li>
			 
		</ul>
      </li>
<?php
/*		 $names = $_SESSION;
echo count($names);
		 echo "name=".$_SESSION['RoleID'];
		 echo "<br>";*/
		// echo "88=".$_SESSION['UserID'];
		// require_once './settings.inc';
	$userid=$_SESSION['UserID'];

require_once 'settings.inc';

$sql = "SELECT OpIDs FROM cwps_user where UserID =$userid and Status=1";
$result=mysql_query($sql);
while($row=@mysql_fetch_array($result)){
$OpIDs =$row[OpIDs];
	}
if ($OpIDs==",,") {} else {
?>
      
      <li><img src="/publish/OA/css/images/folder.gif" />网站更新
 <?php } ?>
        <ul>
         <?php

if(strpos("$OpIDs",'3')!='') {

	?>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=182" class="link" >首页公告</a></li>
          <?php } else {} 
		  
	if(strpos("$OpIDs",'2')!='') { 
		  ?>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=180" class="link" >名企热聘</a></li>
        <?php } else {} ?>
      <?php  if(strpos("$OpIDs",'4')!='')   {	?>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/gr_admin.php?TableID=119" class="link" >简历信息管理</a></li>
           <?php } else {} ?>
           <?php if(strpos("$OpIDs",'5')!='') {  ?>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/qy_main.php?TableID=119" class="link">企业招聘信息管理</a></li>
               <?php } else {} ?>
           <?php if(strpos("$OpIDs",'6')!='') {  ?>    
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/Company_Entsendung_xz.php?TableID=118" class="link">派遣员工招募</a></li>
                   <?php } else {} ?>
         
               <?php if(strpos("$OpIDs",'7')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=186" class="link">求职宝典</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'8')!='') {	?>        
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=288" class="link" >在线求职招聘广告右上</a></li>
                   <?php } else {} ?>
               <?php if(strpos("$OpIDs",'9')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=289" class="link" >在线求职招聘广告右侧下</a></li>
                              <?php } else {} ?>
               <?php if(strpos("$OpIDs",'10')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=292" class="link" >在线求职招聘广告中间</a></li>
            <?php } else {} ?>
           <?php if(strpos("$OpIDs",'11')!='') {  ?>         
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=23" class="link" >人力资源派遣动态</a></li>
                    <?php } else {} ?>
           <?php if(strpos("$OpIDs",'12')!='') {  ?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=44" class="link" >派遣业务介绍</a></li>
                    <?php } else {} ?>
           <?php if(strpos("$OpIDs",'13')!='') {  ?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=45" class="link">再就业服务</a></li>
                    <?php } else {} ?>
           <?php if(strpos("$OpIDs",'14')!='') {  ?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=324" class="link" >派遣机构</a></li>
                    <?php } else {} ?>
           <?php if(strpos("$OpIDs",'15')!='') {  ?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=103&nodeid=46" class="link" >派遣常见问题</a></li>
                    <?php } else {} ?>
           <?php if(strpos("$OpIDs",'16')!='') {  ?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=49" class="link">代发工资</a></li>
                    <?php } else {} ?>
               <?php if(strpos("$OpIDs",'17')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=265" class="link" >代缴社保</a></li>
<?php } else {} ?>
               <?php if(strpos("$OpIDs",'18')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=51" class="link">档案托管</a></li>
<?php } else {} ?>
               <?php if(strpos("$OpIDs",'19')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=266" class="link">毕业生接收</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'20')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=267" class="link" >市外招调入户</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'21')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=52" class="link">挂靠流动人员户口</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'22')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=293" class="link" >职称申报</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'23')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=101&nodeid=323" class="link">代理机构</a></li>
           <?php } else {} ?>
           <?php if(strpos("$OpIDs",'24')!='') {  ?>         
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=398" class="link">公司动态</a></li>
                    <?php } else {} ?>
           <?php if(strpos("$OpIDs",'25')!='') {  ?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=326" class="link">员工须知</a></li>
                    <?php } else {} ?>
               <?php if(strpos("$OpIDs",'26')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=345" class="link">薪酬发放</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'27')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=348" class="link">社会保险</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'28')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=351" class="link">商业保险</a></li>
 <?php } else {} ?>
               <?php if(strpos("$OpIDs",'29')!='') {	?>          
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=362" class="link">劳动人事档案</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'30')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=148&nodeid=401" class="link">劳动合同相关下载</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'31')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=358" class="link">劳动争议</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'32')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=361" class="link" >突发事件</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'33')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=351" class="link">商业保险</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'34')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=366" class="link">招调工</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'35')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=368" class="link" >招调干</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'36')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=370" class="link" >应届生接收</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'37')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=376" class="link" >健康管理</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'38')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=377" class="link">社康中心</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'39')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=402" class="link" >生活医疗小常识</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'40')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=381" class="link" >鑫锦程党支部</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'41')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=432" class="link">鑫锦程团委</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'42')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=433" class="link" >鑫锦程工会</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'43')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=382" class="link">爱心互助会</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'44')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=384" class="link">员工志愿者</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'45')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=385" class="link">员工风采</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'46')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=387" class="link">派遣员工之星</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'47')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=390" class="link" >员工俱乐部</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'48')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=677" class="link">招聘专版</a></li>
 <?php } else {} ?>
               <?php if(strpos("$OpIDs",'49')!='') {	?>          
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=79" class="link" >HR知识库</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'50')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=80" class="link" >HR解决方案</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'56')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=81" class="link">HR工具</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'51')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=85" class="link">培训机构</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'52')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=139" class="link">培训讲座</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'53')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=190" class="link" >培训顾问</a></li>
           <?php } else {} ?>
               <?php if(strpos("$OpIDs",'54')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/HomeBulletin.php?tableid=1&nodeid=96" class="link" >政策法规</a></li>
<?php } else {} ?>
               <?php if(strpos("$OpIDs",'55')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/shenhe_sh.php?TableID=119" class="link" >企业注册审核</a></li>
           <?php } else {} ?>
           
               <?php if(strpos("$OpIDs",'57')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/home/process.php" class="link">注册数量/员工发布数量</a></li>
           <?php } else {} ?>
                <?php if(strpos("$OpIDs",'58')!='') {	?>
           <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/adduser.php?TableID=147" class="link">添加新用户</a></li>
           <?php } else {} ?>
           
             
        </ul>
      </li>
      <?php if($_SESSION['SubGroupIDs']==',21,'){?>
      <li><img src="/publish/OA/css/images/folder.gif" />简历管理
        <ul>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/recruitmentManager/quickWork.php" class="link" >快速求职简历 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/recruitmentManager/insertQuickWork.php" class="link">添加求职简历 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/recruitmentManager/assiantQuickWorker.php" class="link">简历辅助管理 </a></li>
        </ul>
      </li>
      <?php
}
		if($_SESSION['SubGroupIDs']==',14,'){?>
      <li><img src="/publish/OA/css/images/folder.gif" />工资管理
        <ul>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/Parser/salaryManage/xls2mysql/index.php" class="link">导入工资表 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/salaryManager/singleInsert.php" class="link">单条添加 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/salaryManager/fixed.php" class="link" >工资查询及更新 </a></li>
        </ul>
      </li>
      <!--		<li class="closed">this is closed! <img src="/publish/OA/css/images/folder.gif" />-->
      <li><img src="/publish/OA/css/images/folder.gif" />员工信息管理
        <ul>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/Parser/salaryManage/xls2mysql/indexWorker.php" class="link">导入员工花名册 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/singleInsertWorker.php" class="link">单条添加</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/fixedWorker.php" class="link">员工信息查询 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/applyManage.php" class="link" >申请续签明细</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/userRegiste.php" class="link" >账号开通/激活</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/changeDetail.php" class="link">员工入/离职概况</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/manageQuickWork.php" class="link" >简历管理</a></li>
        </ul>
      </li>
      <?php 
               }
			if($_SESSION['SubGroupIDs']==',15,'){
			  
			?>
      <li><img src="/publish/OA/css/images/folder.gif" />社保管理
        <ul>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/societyManager/declareWorkerInfo.php" class="link">员工工伤申报 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/societyManager/declareManage.php" class="link" >已申报名单</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/societyManager/AllMain.php" class="link" >分批次社保核对</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/societyManager/generalMain.php" class="link">综合审批</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/societyManager/51jobMain.php" class="link" >前程无忧平帐审核</a></li>
        </ul>
      </li>
      <?php } ?>
      <?php
				if($_SESSION['SubGroupIDs']==',17,') {
				?>
      <li><img src="/publish/OA/css/images/folder.gif" />统计分析
        <ul>
          <!--		<li><img src="/publish/OA/css/images/file.gif" /><a href="#" class="link" title="recruitmentManager/quickWork.php">快速求职简历 </a></li>-->
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/salaryManager/fixed.php" class="link" >工资查询 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/fixedWorker.php" class="link">员工信息查询 </a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/applyManage.php" class="link">申请续签明细</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/userRegiste.php" class="link">账号开通/激活</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/workerManager/changeDetail.php" class="link">员工入/离职概况</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/societyManager/declareManage.php" class="link" >社保/商保已申报名单</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/home/process.php" class="link">注册数量/员工发布数量</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/grade/CEOAction.php?month=<?php echo $month ?>" class="link">群众评议表详情分析</a></li>
          <li><img src="/publish/OA/css/images/file.gif" /><a href="/publish/oa/grade/personManager.php" class="link" >更新评议人员信息</a></li>
        </ul>
      </li>
      <?php }?>
    </ul>
  </div>			
</div>
<div class="main">

 
 

  
   