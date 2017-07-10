<?php
/*##################################################################
php+mysql分页类，程式设计：kamon,QQ：350665550，欢迎交流！
本分页类有3个属性3个方法
page - 当前页码
count - 总记录数
pagesize - 设置每页显示几条记录
通过设置上面的属性用GetPages()可以获得总页数
get_limit()获得sql查询条件
page_list()输出分页按扭
示例：
require_once("config.php");
require_once("inc_Pagination.php");
$mypage = new Pagination();//使用分页类
$mypage->page=$_GET['page'];//设置当前页
$mypage->pagesize=10;//每页多少条记录
$conn = connetSql();
$mypage->count=mysql_num_rows(mysql_query("select id from dt_content",$conn));//获取并设置数据库总记录数
echo "共有".$mypage->GetPages()."页记录<br/>";//输出有多少页
$sql = "select * from dt_content order by id asc".$mypage->get_limit();//分页条件查询
$rs = mysql_query($sql,$conn);
while($row=mysql_fetch_object($rs)){
	echo $row->id."<br/>";
}
$mypage->page_list($_SERVER['PHP_SELF']);//输出分页按扭
##################################################################*/
class Pagination {
	public $page=0;//当前页码 - set
	public $count=0;//总记录数 - set
	public $pagesize=0;//分页的每页记录数 - set
	public function Pagination(){
		$this->page=intval($page);
		$this->count=$count;
		$this->pagesize=$pagesize;
	}
	private function Page(){
		$this->pagecount=ceil($this->count/$this->pagesize);
	if ($this->page<=0) $this->page=1;
	if ($this->page>$this->pagecount) $this->page=$this->pagecount;
	return ($this->page);
	}
	//获得总页数 - get
	public function GetPages(){
		return (ceil($this->count/$this->pagesize));
	}
	//计算查询条件 - get
	public function get_limit(){
		$page_num=$this->Page();
		$limit_start = ($page_num-1)*$this->pagesize;
		return " limit ".$limit_start.",".$this->pagesize." ";
	}
	//输出分页按扭 - get
	public function page_list($link=""){
		$page_num=$this->Page();
		$temppage=$index_page=$prev_page=$next_page=$end_page="";
		Switch ($page_num) {
			Case 1 :
				$next_page="<a href=".$link."?page=".($page_num+1).">下一页&nbsp;</a>";
			    $end_page="<a href=".$link."?page=".$this->pagecount.">未页</a>";
				if($this->pagecount==1)$next_page=$end_page="";
			Break; 
			Case $this->pagecount :
				$index_page="<a href=".$link."?page=1>首页&nbsp;</a>";
			    $prev_page="<a href=".$link."?page=".($page_num-1).">上一页&nbsp;</a>";
			Break;
			Default:
				$index_page="<a href=".$link."?page=1>首页&nbsp;</a>";
			    $prev_page="<a href=".$link."?page=".($page_num-1).">上一页&nbsp;</a>";
			    $next_page="<a href=".$link."?page=".($page_num+1).">下一页&nbsp;</a>";
			    $end_page="<a href=".$link."?page=".$this->pagecount.">未页</a>";
			Break;   
			}
//		for($i=1;$i<=$this->pagecount;$i++){
//			if ($i!=$page_num){
//				$temppage.="<a href=".$link."?page=".$i.">[".$i."]</a>"."&nbsp;";
//			}else{
//				$temppage.=$i."&nbsp;";
//			}
//		}
		echo "共".$this->count."条记录&nbsp;".$page_num."/".$this->pagecount."页&nbsp;".$index_page.$prev_page.$temppage.$next_page.$end_page;
	}
}
?>