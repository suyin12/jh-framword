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
form_mothod form的提交方式
示例：
require_once("config.php");
require_once("inc_Pagination.php");
$mypage = new Pagination ( ); //使用分页类
	$mypage->page = $_GET ['page']; //设置当前页
	$mypage->pagesize = 2; //每页多少条记录
	$mypage->form_mothod = "get";
	$mypage->count = $pdo->query ( $sql )->rowCount (); //获取并设置数据库总记录数
	$sql .= $mypage->get_limit (); //分页条件查询
	$res = $pdo->query ( $sql );
echo "共有".$mypage->GetPages()."页记录<br/>";//输出有多少页
$sql = "select * from dt_content order by id asc".$mypage->get_limit();//分页条件查询
$rs = mysql_query($sql,$conn);
while($row=mysql_fetch_object($rs)){
	echo $row->id."<br/>";
}
$mypage->page_list($_SERVER['PHP_SELF']);//输出分页按扭 post 方式
$pageList = $mypage->page_list ( $_SERVER ['PHP_SELF'] . "?type=" . $t . "&condition=" . $v );//输出分页按扭get 方式
##################################################################*/
class Pagination {
	public $page = 0; //当前页码 - set
	public $count = 0; //总记录数 - set
	public $pagesize = 0; //分页的每页记录数 - set
	public $form_mothod = "get";
	public function Pagination() {
		$this->page = intval ( $page );
		$this->count = $count;
		$this->pagesize = $pagesize;
	}
	private function Page() {
		$this->pagecount = ceil ( $this->count / $this->pagesize );
		if ($this->page <= 0)
			$this->page = 1;
		if ($this->page > $this->pagecount)
			$this->page = $this->pagecount;
		return ($this->page);
	}
	//获得总页数 - get
	public function GetPages() {
		return (ceil ( $this->count / $this->pagesize ));
	}
	//计算查询条件 - get
	public function get_limit() {
		$page_num = $this->Page ();
		$limit_start = ($page_num - 1) * $this->pagesize;
		return " limit " . $limit_start . "," . $this->pagesize . " ";
	}
	public function form_mothod() {
		if ($this->form_mothod == "get") {
			$mark = "&";
		}
		if ($this->form_mothod == "post") {
			$mark = "?";
		}
		return $mark;
	}
	//输出分页按扭 - get
	public function page_list($link = "") {
		$page_num = $this->Page ();
		$temppage = $index_page = $prev_page = $next_page = $end_page = "";
		Switch ($page_num) {
			Case 1 :
				$next_page = "<a href=" . $link . $this->form_mothod () . "page=" . ($page_num + 1) . ">下一页&nbsp;</a>";
				$end_page = "<a href=" . $link . $this->form_mothod () . "page=" . $this->pagecount . ">未页</a>";
				if ($this->pagecount == 1)
					$next_page = $end_page = "";
				Break;
			Case $this->pagecount :
				$index_page = "<a href=" . $link . $this->form_mothod () . "page=1>首页&nbsp;</a>";
				$prev_page = "<a href=" . $link . $this->form_mothod () . "page=" . ($page_num - 1) . ">上一页&nbsp;</a>";
				Break;
			Default :
				$index_page = "<a href=" . $link . $this->form_mothod () . "page=1>首页&nbsp;</a>";
				$prev_page = "<a href=" . $link . $this->form_mothod () . "page=" . ($page_num - 1) . ">上一页&nbsp;</a>";
				$next_page = "<a href=" . $link . $this->form_mothod () . "page=" . ($page_num + 1) . ">下一页&nbsp;</a>";
				$end_page = "<a href=" . $link . $this->form_mothod () . "page=" . $this->pagecount . ">未页</a>";
				Break;
		}
		$pageList = "<span>共" . $this->count . "条记录&nbsp;" . $page_num . "/" . $this->pagecount . "页&nbsp;" . $index_page . $prev_page . $temppage . $next_page . $end_page . "</span>";
	return $pageList;
	}
}
?>