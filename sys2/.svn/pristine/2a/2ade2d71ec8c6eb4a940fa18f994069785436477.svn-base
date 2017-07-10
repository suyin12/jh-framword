<?php
require_once '../header/companyHeader.php';
if(!defined('ALLOW'))exit();
//print_r($_SESSION['changeArray']);
list($sql,$userID,$type)=$_SESSION['changeArray'];
require_once '../settings.inc';
require_once '../pagenation.class.php';
$mypage = new Pagination();//使用分页类
$mypage->page=$_GET['page'];//设置当前页
$mypage->pagesize=10;//每页多少条记录
$mypage->count=@mysql_num_rows(mysql_query($sql));//获取并设置数据库总记录数
$sql =$sql.$mypage->get_limit();//分页条件查询
$result = mysql_query($sql);
?>
<table id="displayTable" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#666666">
		<thead>
		<tr bgcolor="#CAE8EA">
		<th >√</th>
<!--		<th ><strong>档案编号</strong></th>-->
		<th ><strong>用工形式</strong></th>
		<th ><strong>在职状态</strong></th>
		<th ><strong>单位名称</strong></th>
		<th ><strong>部门名称</strong></th>
		<th ><strong>岗位</strong></th>
		<th ><strong>员工姓名</strong></th>
		<th ><strong>身份证编号</strong></th>
<!--		<th ><strong>发放工资开户银行</strong></th>-->
<!--		<th ><strong>发放工资银行账号</strong></th>-->
		<th ><strong>入职日期</strong></th>
		<th ><strong>离职日期</strong></th>			
		<th ><strong>备注</strong></th>
		<th>操作</th>		
		</tr>
		</thead>
		<tbody id="displaybody">
		<?php
		if($result){
		while(($rows=mysql_fetch_array($result))==true){
		   
		?>
		
		<tr bgcolor="#FFFFFF">
		<td align="center" ><input id="checkbox" name="checkbox[]" type="checkbox"  value="<? echo $rows['ID']; ?>"></td>
		
<!--		<td ><? echo $rows['field0']; ?></td>-->
		<td ><? echo $rows['field1']; ?></td>
		<td ><? echo $rows['field2']; ?></td>
		<td ><? echo $rows['field3']; ?></td>
		<td ><? echo $rows['field4']; ?></td>
		<td ><? echo $rows['field5']; ?></td>
		<td class="edit"><a href='workerInfo.php<? echo "?"; ?>sessionID=<?php echo $rows['sessionID'];?>&IDNumber=<?php echo $rows['field7'];?>' target='_blank'><? echo $rows['field6']; ?></a></td>
		<td ><? echo $rows['field7']; ?></td>
		<!--<td><? echo $rows['field27']; ?></td>
		<td ><? echo $rows['field28']; ?></td>
	    --><td ><? echo $rows['field29']; ?></td>
		<td ><? echo $rows['field30']; ?></td>
		<td><? echo $rows['field36']; ?></td>	
        <td class="edit"><a href='editWorker.php<? echo "?"; ?>editId=<?php echo $rows['ID'];?>&sessionID=<?php echo $rows['sessionID'];?>' target="_blank">编辑</a></td>
		
		</tr>
		<?php
		}
		}
		?>
		</tbody>
		</table>
		<div class="index">
<?php 
$mypage->page_list($_SERVER['PHP_SELF']);//输出分页按扭
?>
</div>
<!--		<div class="button">-->
<!--		<a href="#" onClick="$('input[@type=checkbox]').attr('checked', 'checked')">全选</a>-->
<!--		<a href="#" onClick="$('input[@type=checkbox]').removeAttr('checked')">全不选 </a>		-->
<!--		<input name="Delete" type="submit" Id="Delete" value="删除" onClick="javascript:return doOutput()" />	-->
<!--		</div>-->
