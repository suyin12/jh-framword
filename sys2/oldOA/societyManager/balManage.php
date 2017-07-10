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
<script type="text/javascript" src="../js/jqModal.js"></script>
<script type="text/javascript" src="../js/jqModal.litejva8.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.litejava8.css" />
<div >
<p>导入工资/社保费用明细表:</p>

<div>
<ul>
<li>
<a class="thickbox" title="导入工资/保险费用明细表" href="../Parser/societyManage/xls2mysql/indexBalance.php/?table=so_bal_1&width=100%&amp;height=80%">
①:导入工资/保险费用明细表</a>
</li>
<li>
<a class="thickbox" title="导入社保费用明细表" href="../Parser/societyManage/xls2mysql/indexBalance.php/?table=so_bal_2&width=100%&amp;height=80%">
②:导入社保费用明细表</a>
</li>
<li>

</li>
</ul>


<p>已导入的表格概况:</p>
<table  width="95%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
<tr  style="text-align:left;">
<td width="20%" bgcolor="#CAE8EA">
工资费用明细表:
</td>
<td width="80%" bgcolor="#ffffff">
<?php 
$tabListSql="select a.month,(select b.userName from cwps_user b where b.UserID=a.sessionID) as userName from `so_bal_2` a group by a.sessionID";
$tabListRet=mysql_query($tabListSql);
while ($row=mysql_fetch_array($tabListRet))
{
  $listMonth=$row['month'];
} 
echo "<span>". $listMonth."</span>";
?>
</td>
</tr>
<tr  style="text-align:left;">
<td width="20%" bgcolor="#CAE8EA">
社保明细表:
</td> 
<td width="80%" bgcolor="#ffffff">
</td>
</tr>
</table>
</div>
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
<?php 
require_once 'balDataTable.php';
?>



</div>
</body>
</div>
</body>
</html>