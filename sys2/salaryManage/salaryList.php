<?php
/**
 * Created by PhpStorm.
 * User: LOSKIN
 * Date: 14-8-27
 * Time: 下午3:00
 * Description : 按单位显示所有人员在某年月的工资账表
 */
//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
//配置文件 数据库和pdo smarty初始化等
require_once '../setting.php';
//查询与工资年月相关的费用明细
require_once sysPath . "dataFunction/Insurance.data.php";
// 分页
require_once '../class/pagenation.class.php';
//员工信息类
require_once '../dataFunction/wInfo.data.php';
//echo $t0 ="0 = ".microtime_format('Y年m月d日 H时i分s秒 x毫秒', microtime_float())."<br/>";
$title = "单位费用汇总明细表";
$unitID = $_POST ['unitID'];
$day_start = $_POST['day_start'];
$day_end  = $_POST['day_end'];
for($i=0;$i<24;$i++){
    $d_mon=date("Ym",strtotime("+{$i} months",strtotime("{$day_start}01")));
    if($d_mon<=$day_end){
        $month_arr[]= $d_mon;
    }
}
if(empty($_POST)){
    $checked_arr = array(
        "totalFee" => "1",
        "acheive" => "1",
        "uSoIns" => "1",
        "pSoIns" => "1",
        "uHF" => "1",
        "pHF" => "1",
        "uComIns" => "1",
        "pComIns" => "1"
    );
    foreach($checked_arr as $k=>$v){
        $smarty->assign ( array ("s_{$k}"=>$v));
    }
}else{
    #获取post数组,构造查询$SqlStr
    foreach($_POST as $k=>$v){
        $smarty->assign ( array ("s_{$k}"=>$v));
        switch($k){
            case "day_start":
            case "day_end":
            case "intoExcel":
            case "page":
                break;
            default:
                $SqlStr  .=",`{$k}`";
                //需要显示的列做数组
                if($k!=='unitID'){
                    $cols_arr[$k] = $k;
                }
                break;
        }
    }
}
$SqlStr ="`uID`,`name`,`month`{$SqlStr}";
#使用分页类
$mypage = new Pagination();
$mypage->page = $_POST ['page']; //设置当前页
$mypage->pagesize = 6; //每页多少条记录
$mypage->form_mothod = "post";
#实例化员工信息类,查询员工总数
$w = new wInfo();
$w -> pdo = $pdo;
#查找单位里所有在职人员或者离职人员在查找范围内
$winfo_where = "unitID='$unitID' and ((`status` IN('1','2') AND `mountGuardDay`<'{$day_end}01') OR (`status`='0' and dimissionDate>='{$day_start}01'))";
$winfo_sum = $w -> wInfoNum("sum(1) as sum",$winfo_where);
$mypage->count = $winfo_sum['sum'];
$limit .= $mypage->get_limit (); //分页条件查询
if (!$_POST ['intoExcel']) {
    $winfo_where .= $limit;
}
$winfo_arr = $w -> wInfoBasic("`uID`,`name`,`pID`",$winfo_where);
$pageList = $mypage->page_list($_SERVER ['REQUEST_URI']);
#查询表...创建一个类
#获取实收的单位费用
$s = new Insurance();
$s->pdo = $pdo;
$s->unitID = $unitID;
$s->day_start = $_POST['day_start'];
$s->day_end = $_POST['day_end'];
$s->Sqlstr = $SqlStr;
#查询相关的费用明细,返回处理数组
$Retfee = $s->basicRet("fee");
$Retmul = $s->basicRet("mul");
$Retrew = $s->basicRet("rew");
$Ret_fee_arr = $s->Retarr($Retfee);
$Ret_mul_arr = $s->Retarr($Retmul);
$Ret_rew_arr = $s->Retarr($Retrew);
//$total声明做为下载的合计数组

$i = 0;
foreach($winfo_arr as $k=>$v){
    $son_arr[$v['uID']]['uID'] = $v['uID'];
    $son_arr[$v['uID']]['name'] = $v['name'];
    $son_arr[$v['uID']]['pID'] = $v['pID'];
    $excel_arr[$i]['uID'] = $v['uID'];
    $excel_arr[$i]['name'] = $v['name'];
    $excel_arr[$i]['pID'] = $v['pID'];
    foreach($month_arr as $kk=>$vv){
        foreach($cols_arr as $ck=>$cv){
            $ckv = $Ret_fee_arr[$v['uID']][$vv][$cv] + $Ret_mul_arr[$v['uID']][$vv][$cv] + $Ret_rew_arr[$v['uID']][$vv][$cv];
            $total[$ck."$vv"] += round((double) $ckv, 2);
            if($ckv == 0)
                $ckv = null;
            $son_arr[$v['uID']][] = $ckv;
            $excel_arr[$i][$ck."$vv"] = $ckv;
        }
    }
    $i++;
}
#可查询一年内期间费用明细
$d_day = date("Ym");
for($i=0;$i<24;$i++){
    $d_mon=date("Ym",strtotime("-{$i} months",strtotime("{$d_day}01")));
    $d_date=date("Y年m月",strtotime("-{$i} months",strtotime("{$d_day}01")));
    $d_day_arr[$d_mon] = $d_date;
}
#显示列
$cols_name = array(
    "totalFee" => "总费用",
    "pay" => "应发工资",
    "acheive" => "实发工资",
    "uSoIns" => "单位社保",
    "pSoIns" => "个人社保",
    "uHF" => "单位公积金",
    "pHF" => "个人公积金",
    "uComIns" => "单位商保",
    "pComIns" => "个人商保"
);
$colspan = count($cols_arr);
foreach($month_arr as $vv){
    $header .= "<th colspan='{$colspan}'>{$d_day_arr[$vv]}</th>";
    foreach($cols_arr as $ck=>$cv){
        $second .= "<th>{$cols_name[$cv]}</th>";
    }
}
$smarty->assign ( array ("second" => $second,"header"=>$header,"son_arr"=>$son_arr,"total"=>$total,"pageList" => $pageList,"colspan" =>$colspan ));
#查询所有分管的单位的编号\名字
$Sql_info = "select `unitID`,`unitName` from a_unitinfo where unitID!='' and type='1'";
$u_info = SQL($pdo, $Sql_info, null);
for($i=0;$i<count($u_info);$i++){
    $unit_ID = $u_info[$i]['unitID'];
    $unitName = $u_info[$i]['unitName'];
    $u_info_arr[$unit_ID] = $unitName;
}

#下载成表格
if ($_POST ['intoExcel']) {
    $tableName = "单位费用汇总表";
    $headercell = "<Row>\n<Cell ss:MergeDown=\"1\" ss:StyleID=\"s23\"><Data ss:Type=\"String\">员工编号</Data></Cell>\n<Cell ss:MergeDown=\"1\" ss:StyleID=\"s23\"><Data ss:Type=\"String\">姓名</Data></Cell>\n<Cell ss:MergeDown=\"1\" ss:StyleID=\"s23\"><Data ss:Type=\"String\">姓名</Data></Cell>";
    $secondscell = "";
    foreach($month_arr as $kk=>$vv){
        $headercell .="<Cell ss:MergeAcross=\"".($colspan-1)."\" ss:StyleID=\"s23\"><Data ss:Type=\"String\">".$d_day_arr[$vv]."</Data></Cell>\n";
        foreach($cols_arr as $ck=>$cv){
            if($kk == '0' && $ck =="totalFee"){
                $secondcell = "<Cell ss:Index=\"4\" ss:StyleID=\"s23\"><Data ss:Type=\"String\">总费用</Data></Cell>\n";
            }else{
                $secondscell .= "<Cell><Data ss:Type=\"String\">".$cols_name[$cv]."</Data></Cell>\n";
            }
        }
    }
    $footcell ="<Cell ss:MergeAcross=\"1\" ss:StyleID=\"s23\"><Data ss:Type=\"String\">合计</Data></Cell>\n";
    foreach($total as $kk=>$vv){
        $footcell .="<Cell><Data ss:Type=\"String\">$vv</Data></Cell>\n";
    }
    $headercell .= "</Row>\n";
    $secondcell = "<Row>\n".$secondcell.$secondscell."</Row>";
    $footcell = "<Row>\n".$footcell."</Row>";
    $headerStr = $headercell.$secondcell;
    require_once 'class-excel-xml.inc.php';
    $doc = $excel_arr;
    $name = $tableName;
    $name = iconv('UTF-8', 'GBK', $name);
    $xls = new Excel_XML ();
    $xls->worksheet_title = $u_info_arr[$unitID];
    $xls->addArray($doc,$headerStr,$footcell);
    $xls->generateXML($name);
    exit();
}
#定义模板变量
$smarty->assign ( array ("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath ) );
$smarty->assign ( array ("u_info_arr"=>$u_info_arr,"d_day_arr"=>$d_day_arr,"month_arr"=>$month_arr));
#显示查询结果
$smarty->display("salaryManage/salaryList.tpl");