<?php
/**
 * Created by  Great sToNe.
 * Email: shi35dong@gmail.com
 * DateTime: 2016/1/21 - 16:43
 *
 * 参保人信息列表
 */

#链接代理通用类
require_once "agentClassLink.class.php";
#验证类
require_once sysPath . "auth.php";


$title = "参保人列表";
$sel = array("" => "--请选择--");
$modelArr = array("name" => "姓名", "fID" => "参保人ID", "pID" => "身份证", "sID" => "社保号", "HFID" => "公积金账号", "mobilePhone" => "手机号码", "userID" => "所属人ID");
#加载基础配置
$aSet = new agencySet();
$statusArr = $aSet->agencySetArr("statusTxt");
#获取参保人数据
if (filterParam('m',0)) {
    $model = filterParam('m',0);
    $c = filterParam('c',0);
    if (!empty($_GET['status'])) {
        $s_status = filterParam('status',0);
        $s_status_stop = "0";
    } elseif ($_GET['s_status_stop'] == 1) {
        $s_status = "0";
        $s_status_stop = "1";
    } else {
        $s_status = "0,1,2,5";
        $s_status_stop = "0";

    }
    $conStr = "`" . $model . "` like '%" . $c . "%'";
    $conArr['selStr'] = "`fID`,`name`,`unitID`,`userID`,`mobilePhone`,`pID`,`sID`,`HFID`,`city`,`cityInsurance`,`soInsurance`,`housingFund`,`hospitalization`,`mCost`,`mCostLimit`,`status`";
    $conArr['conStr'] = $conStr . " and  `status` in ($s_status) order by fID desc";
    #参保人数组
    $aU = new agentUser();
    $myPage = new Pagination (); //使用分页类
    $myPage->page = filterParam('page',0); //设置当前页
    $myPage->form_mothod = "get";
    $myPage->count = $pdo->query("select 1 from  d_agent_personalinfo where " . $conArr['conStr'])->rowCount();
    $myPage->pagesize = "5";
    $pagesizeLimit = $myPage->get_limit();
    $aU->agentUserBasic($conArr['selStr'], $conArr['conStr'] . $pagesizeLimit);
    $aUserArr = $aU->agentUserRecreate();

    foreach ($_GET as $key => $val) {
        if ($key != "page" and $key != "intoExcel") {
            $queryStr .= $key . "=" . $val . "&";
        }
    }
    $queryStr = substr($queryStr, 0, -1);
    $pageList = $myPage->page_list($_SERVER ['PHP_SELF'] . "?" . $queryStr);

//    echo "<pre>";
//    print_r($aUserArr);
}
//调用保存EXCEL文件
if ($_POST ['intoExcel']) {
    $selFieldArray = array('status', 'fID', 'name', 'pID', 'sex', 'mobilePhone', 'unitName', 'city', 'cityInsurance', 'soInsurance', 'soInsNeedMonthNum', 'soInsBeginDay', 'sID', 'radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'PDIns', 'housingFund', 'HFNeedMonthNum', 'HFBeginDay', 'HFID', 'HFRadix', 'pHFPer', 'uHFPer', 'spouseName', 'spousePID', 'mCost', 'mCostLimit', 'photoID', 'remarks', 'userTrueName', 'userMobile');

    foreach ($selFieldArray as $selFieldVal) {
        switch ($selFieldVal) {
            case "unitName":
                $selField .= "b." . $selFieldVal . ",";
                break;
            case "userTrueName":
                $selField .= "c.truename as userTrueName,";
                break;
            case "userMobile":
                $selField .= "c.mobile as userMobile,";
                break;
            default:
                $selField .= "a." . $selFieldVal . ",";
                break;
        }
    }
    $selField = rtrim($selField, ",");

    $excelSql = "select " . $selField . " from d_agent_PersonalInfo a left join a_unitInfo b on a.unitID=b.unitID left join wx_user c on a.userID=c.uid where ";
    $excelSql .= " a." . $model . " like '%$c%'";
    $excelSql .= " and a.`status` in ($s_status)";

    $ePre = $pdo->prepare($excelSql);
    $ePre->execute(array("%$c%"));
    $eRes = $ePre->fetchAll(PDO::FETCH_ASSOC);
    if ($_POST ['codeVison'] == "1")
        $newArr = $eRes;
    else {
        $aU->agentUserArr = $eRes;

        $aURecreateArr = $aU->agentUserRecreate();
        foreach ($aURecreateArr as $key => $val) {
            foreach ($selFieldArray as $sval) {
                switch ($sval) {
                    case "statusTxt":
                    case "mCostLimitTxt":
                    case "cityInsuranceTxt":
                    case "soInsuranceTxt":
                    case "housingFundTxt":
                    case "sexTxt":
                    case "cityTxt":
                        break;
                    case "status":
                    case "mCostLimit":
                    case "cityInsurance":
                    case "soInsurance":
                    case "housingFund":
                    case "sex":
                    case "city":
                        $newArr[$key][$sval] = $val[$sval . "Txt"];
                        break;
                    default:
                        $newArr[$key][$sval] = $val[$sval];
                        break;
                }
            }
        }//end  foreach $aURecreateArr

//        echo "<pre>";
//        print_r($newArr);

    }
    #定义总共需要多少列,及其设置相应的列宽,及其增加表头标题
    $fieldName = array("状态", '参保人ID', "姓名", "身份证号码", "性别", "移动电话", "单位编号", "参保城市", "参保类型", "是否购买社保", "社保缴交月数", "投保日期", "社保号", "缴交基数", "养老", "医疗", "工伤", "失业", "残障金", '是否买公积金', "公积金缴交月数", "公积金启用日期", "个人公积金账号", "基数(公积金)", "个人比例(公积金)", "单位比例(公积金)", "配偶姓名", "配偶身份证", "管理费", "管理费类型", "数码图像号", "备注", "所属人", "所属人电话");
    //获取字段名,并设置字段名对应的中文显示名
    $eResColKey = array_keys($newArr [0]);
    $fERes [] = array_combine($eResColKey, $fieldName);
    //添加到数组的第一行作为标题行
    $newArr = array_merge($fERes, $newArr);
    $tableName = "参保人列表";
    require_once sysPath . 'class/phpToExcelXML/class-excel-xml.inc.php';
    $doc = $newArr;
    $name = $tableName . date('ymd', time());
    $name = iconv('UTF-8', 'GBK', $name);
    $xls = new Excel_XML ();
    $xls->addArray($doc);
    $xls->generateXML($name);
    exit();
}


#配置变量
$smarty->assign(array("statusArr" => $statusArr, "modelArr" => $modelArr));
$smarty->assign(array("s_m" => $model, "s_c" => $c, "s_status" => $s_status, "s_status_stop" => $s_status_stop, "pageList" => $pageList));
$smarty->assign("aUserArr", $aUserArr);
#模板配置信息
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agent/agentPersonList.tpl");
echo "<pre>";
print_r($queryStr);
?>
