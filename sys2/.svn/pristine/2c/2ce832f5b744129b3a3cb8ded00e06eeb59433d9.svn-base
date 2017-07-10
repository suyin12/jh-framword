<?php

/*
  如此有成就感的代码...哇哈哈..
  每次的get参数都能完整把握其相应的数组..而且可扩展性还不错..
  要是在对  unitManager数组处理得好些,,就完全不用考虑该数组是否会增加列的因素了....
  总之,还是可以的..^_^
 * */
#验证权限
require_once '../auth.php';
#连接模板文件
require_once '../templateConfig.php';
#分页类
require_once '../class/pagenation.class.php';
#单位,客户经理联动菜单
require_once '../dataFunction/unit.data.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
$wSet = new wInfoSet ( );
$wSet->p = $pdo;
$wSet->wInfoSetArr();
$wInfoSet = $wSet->wInfoSet;
$title = "员工信息查询";
//$smarty->debugging=true;
#初始化页面信息
$sel = array("" => "--请选择--");
$model = array("name" => "姓名", "uID" => "员工编号", "pID" => "身份证", "sID" => "社保号", "bID" => "工资账号", "dID" => "档案编号","spID"=>"特定编号");
$wantToMergeInfo = wantToMergeInfo();
#配置二级联动json,客户经理roleID = '2_1'
$unitManager = unit_manager($pdo, "2_1","","1");
$j_unitManager = json_encode($unitManager);

#get提交
if (isset($_GET ['m'])) {

    $m = $_GET ['m'];
    $c = $_GET ['c'];
    $mID = $_GET ['mID'];
    $unitID = $_GET ['unitID'];
    //构造查询语句,为以后的高级搜索做伏笔
    $sql = "select a.uID,a.name,b.unitName,a.filiale,a.department,a.pID,a.type,a.bID,a.domicile,a.status,a.mobilePhone,a.managementCost,a.sID,a.soInsurance,a.comInsurance,a.helpCost
            from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID where ";
    $sql .= " a." . $m . " like ?";
    //预留一个选择是否查询离职员工的SQL 选项
    if ($_GET ['status'] == '1') {
        $status = "checked";
        $statusSql .= " and a.status in ('1','2')";
    } else {
        $status = "unchecked";
    }

    if ($_REQUEST ['selPost'] == "1") {
        foreach ($_POST as $pKey => $pVal) {
            if ($pKey != "selPost" && $pKey != "intoExcel" && $pKey != "codeVison") {
                //配置Smarty 模板的筛选变量..POST后选中的值
                $smartyName = "s_" . $pKey;
                $smarty->assign($smartyName, $pVal);
                $fieldSel = substr($pKey, 0, - 3);
                switch ($pKey) {
                    case "soInsuranceSel" :
                        if ($pVal != "") {
                            $selSql .= " and a.$fieldSel in ($pVal) ";
                        }
                        break;
                    case "unitSel" :
                        if ($pVal != "") {
                            foreach ($unitManager as $uKey => $uVal) {
                                foreach ($uVal ['unit'] as $uK => $uV) {
                                    if ($uV ['unitName'] == $pVal)
                                        $pVal = $uV ['unitID'];
                                }
                            }
                            $selSql .= " and a.unitID like '$pVal'";
                        }
                        break;
                    default :

                        if ($pVal != "") {
                            if ($pVal == "notNull")
                                $selSql .= " and a.$fieldSel not like ''";
                            elseif ($pVal == "Null")
                                $selSql .= " and a.$fieldSel like ''";
                            else
                                $selSql .= " and a.$fieldSel like '$pVal'";
                        }
                        break;
                }
            }
        }
    }
    $sql = $sql . $statusSql;
    //遍历客户经理,单位数组
    foreach ($unitManager as $um_v) {
        foreach ($um_v as $um_v_k => $um_v_v) {
            if ($um_v ['mID'] == $mID) {
                //构造get后,单位数组
                $um [0] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName'], "unit" => $um_v ['unit']);

                if (is_array($um_v_v)) {
                    foreach ($um_v_v as $um_v_v_k => $um_v_v_v) {
                        $sql1 .= "'" . $um_v_v_v ['unitID'] . "',";
                    }
                }
            } else {
                //构造get后,单位数组,除get外其余的客户经理
                $um_m[$um_v['mID']] = array("mID" => $um_v ['mID'], "mName" => $um_v ['mName']);
            }
        }
    }

    //GET參數
    foreach ($_GET as $key => $val) {
        if ($key != "page" and $key != "intoExcel") {
            $queryStr .= $key . "=" . $val . "&";
        }
        if ($val) {
            switch ($key) {
                case "mID" :
                    unset($_GET['wantToMerge']);
                    //构造高级查询
                    $sql1 = substr($sql1, 0, - 1);
                    $sql2 = " and a.unitID in (" . $sql1 . ")";
                    //构造get后,单位数组
                    
                    $um = array_merge($um, $um_m);
                    $smarty->assign("unitManager", $um);
                    break;
                case "unitID" :
                    unset($_GET['wantToMerge']);
                    $sql2 = " and a." . $key . " like '" . $val . "'";
                    break;
                case "wantToMerge":
                    $unitAll = unitAll($pdo, " `unitID` ", " and wantToMerge='$val' ");
                    foreach ($unitAll as $u_val) {
                        $unitIDStr .= "'" . $u_val['unitID'] . "',";
                    }
                    $unitIDStr = rtrim($unitIDStr, ",");
                    $sql2 = " and a.unitID in (" . $unitIDStr . ")";
                    break;
            }
        } elseif (!$_GET ['mID']) {
            $smarty->assign("unitManager", $unitManager);
        }
    }
    $sql .= $sql2;
    $mypage = new Pagination ( ); //使用分页类
    $mypage->page = $_GET ['page']; //设置当前页
    $mypage->form_mothod = "get";
    $pre = $pdo->prepare($sql);
    $pre->execute(array("%$c%"));
    #获取初级未处理的数组,用来当筛选的条件..
    $preRet = $pre->fetchAll(PDO::FETCH_ASSOC);
    foreach ($preRet as $preR) {
        $statusArr [] = $preR ['status'];
        $unitNameArr [] = $preR ['unitName'];
        $filialeArr [] = $preR ['filiale'];
        $departmentArr [] = $preR ['department'];
        $typeArr [] = $preR ['type'];
        $managementCostArr [] = $preR ['managementCost'];
        $domicileArr [] = $preR ['domicile'];
        $soInsArr [] = $preR ['soInsurance'];
        $comInsArr [] = $preR ['comInsurance'];
        $helpCostArr [] = $preR ['helpCost'];
    }
    $statusArr = array_unique($statusArr);
    $unitNameArr = array_unique($unitNameArr);
    $filialeArr = array_unique($filialeArr);
    $departmentArr = array_unique($departmentArr);
    $typeArr = array_unique($typeArr);
    $managementCostArr = array_unique($managementCostArr);
    $domicileArr = array_unique($domicileArr);
    $soInsArr = array_unique($soInsArr);
    foreach ($soInsArr as $soInsKey => $soInsVal) {
        switch ($soInsVal) {
            case "1" :
                $soInsArr [$soInsKey] = "1,2";
                break;
            case "2" :
                unset($soInsArr [$soInsKey]);
                break;
        }
    }
    $comInsArr = array_unique($comInsArr);
    $helpCostArr = array_unique($helpCostArr);
    if ($m == "dID") {
        $sql .= $selSql . " order by a.dID desc";
    } else {
        $sql .= $selSql . " order by a.uID asc";
    } //这里加入筛选条件的SQL语句
    $pre = $pdo->prepare($sql);
    $pre->execute(array("%$c%"));
    $mypage->count = $pre->rowCount(); //获取并设置数据库总记录数
    if ($_POST ['selPost'] == "1") {
        $mypage->pagesize = $pre->rowCount();
    } else {
        $mypage->pagesize = 20; //每页多少条记录
    }
    $sql .= $mypage->get_limit(); //分页条件查询
    $res = $pdo->prepare($sql);
    $res->execute(array("%$c%"));
    if ($res) {
        $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    }

    $queryStr = substr($queryStr, 0, - 1);
    if ($_REQUEST ['selPost'] == "1")
        $queryStr .= "&selPost=1";
    $pageList = $mypage->page_list($_SERVER ['PHP_SELF'] . "?" . $queryStr);

    //调用保存EXCEL文件
    if ($_POST ['intoExcel']) {
        $selFieldArray = array('status', 'uID', 'name', 'pID', 'dID', 'bID', 'spID', 'sex', 'nation', 'homeAddress', 'workAddress', 'education', 'dateOfGraduation','role', 'marriage', 'mobilePhone', 'telephone', 'contact', 'contactPhone', 'school', 'blank', 'type', 'unitID', 'filiale', 'department', 'station', 'mountGuardDay', 'cType','cBeginDay', 'cEndDay', 'soInsurance', 'domicile', 'soInsBuyDate', 'sID', 'radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'PDIns', 'hand', 'housingFund', 'HFBuyDate', 'HFID', 'pHFPer', 'uHFPer', 'HFRadix', 'spouseName', 'spousePID', 'comInsurance', 'helpCost', 'managementCost', 'jobRegModifyDate','photoID', 'birthID', 'proTitle', 'proLevel','A','B','C','D','E', "F","G","H","I","J","K","L","M", 'remarks', 'dimissionDate', 'dimissionReason', 'dimissionRemarks');

        foreach ($selFieldArray as $selFieldVal) {

            if ($selFieldVal == "unitName") {
                $selField .= "b." . $selFieldVal . ",";
            } elseif ($selFieldVal == "dimissionDate" || $selFieldVal == "dimissionReason" || $selFieldVal == "dimissionRemarks") {
                $selField .= "c." . $selFieldVal . ",";
            } else {
                $selField .= "a." . $selFieldVal . ",";
            }
        }
        $selField = rtrim($selField, ",");

        $excelSql = "select " . $selField . " from a_workerInfo a left join a_unitInfo b on a.unitID=b.unitID left join v_dimission c on a.uID=c.uID where ";
        $excelSql .= " a." . $m . " like '%$c%'";
        $excelSql .= $sql2 . $statusSql . $selSql;

        $ePre = $pdo->prepare($excelSql);
        $ePre->execute(array("%$c%"));
        $eRes = $ePre->fetchAll(PDO::FETCH_ASSOC);
        if ($_POST ['codeVison'] == "1")
            $newArr = $eRes;
        else
            $newArr = reCreateArray($eRes, $wInfoSet);
        #定义总共需要多少列,及其设置相应的列宽,及其增加表头标题
        $fieldName = array("在职状态", '员工编号', "姓名", "身份证号码", "档案编号", "工资账号", "特定编号", "性别", "民族", "家庭地址", "工作地址", "学历", "毕业年月","政治面貌", "婚否", "移动电话", "固定电话", "联系人", "联系电话", "学校", "开户银行", "员工类型", "单位编号", "分公司", "部门", "岗位", "入职日期","合同类型", "合同开始日期", "合同终止日期", "是否购买社保", "户籍类型", "投保日期", "社保号", "缴交基数", "养老", "医疗", "工伤", "失业", "残障金", "利手", '是否买公积金', "公积金启用日期", "个人公积金账号", "个人比例(公积金)", "单位比例(公积金)", "基数(公积金)", "配偶姓名", "配偶身份证", "购买商保", "参加互助会", "管理费", "就业登记启用日期","数码图像号", "避孕节育报告单号", "职称", "技能等级", "姓名(证)","家庭住址(证)","工作单位(证)","手机(证)","固话(证)",  "会员证号",  "行政职务",  "子女数量","健康状况","工资收入","家庭收入","住房情况","配偶单位","备注", "离职日期", "离职原因", "离职备注");
        //获取字段名,并设置字段名对应的中文显示名
        $eResColKey = array_keys($newArr [0]);
        $fERes [] = array_combine($eResColKey, $fieldName);
        //添加到数组的第一行作为标题行
        $newArr = array_merge($fERes, $newArr);
        $tableName = "员工信息";
        require_once sysPath . 'class/phpToExcelXML/class-excel-xml.inc.php';
        $doc = $newArr;
        $name = $tableName . date('ymd', time());
        $name = iconv('UTF-8', 'GBK', $name);
        $xls = new Excel_XML ();
        $xls->addArray($doc);
        $xls->generateXML($name);
        exit();
    }
} else {
    $smarty->assign("unitManager", $unitManager);
}
#定义模板变量
$smarty->assign("j_unitManager", $j_unitManager);
$smarty->assign("actionURL", httpPath . "workerInfo/wInfo.php");
$smarty->assign("status", $status);
$smarty->assign("m", $model);
$smarty->assign("s_m", $m);
$smarty->assign("c", $c);
$smarty->assign("s_mID", $mID);
$smarty->assign("s_unitID", $unitID);
$smarty->assign("s_wantToMerge",$_GET['wantToMerge']);
$smarty->assign("wantToMergeInfo", $wantToMergeInfo);
#获取筛选条件
$smarty->assign("statusArr", $statusArr);
$smarty->assign("wInfoSet",$wInfoSet);
$smarty->assign("unitNameArr", $unitNameArr);
$smarty->assign("filialeArr", $filialeArr);
$smarty->assign("departmentArr", $departmentArr);
$smarty->assign("typeArr", $typeArr);
$smarty->assign("managementCostArr", $managementCostArr);
$smarty->assign("domicileArr", $domicileArr);
$smarty->assign("soInsArr", $soInsArr);
$smarty->assign("comInsArr", $comInsArr);
$smarty->assign("helpCostArr", $helpCostArr);
#显示查询结果
$smarty->assign("ret", $ret);
$smarty->assign("pageList", $pageList);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("workerInfo/wInfo.tpl");
?>