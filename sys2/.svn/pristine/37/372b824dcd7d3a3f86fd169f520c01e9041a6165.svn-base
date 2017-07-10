<?php

/*
 *   引入了 jqgrid,以后类似于 data.php的 ,都是用来处理table 的
 *    ajax 地址  data.php?a=createFee  后面的参数表示作用的PHP首页 也即是对应  createFee.php的操作
 *    author  sToNe   2011-07-25
 */
#页面访问权限
require_once '../auth.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接 标题显示类
require_once sysPath . 'dataFunction/fieldDisplay.data.php';
#连接员工信息设置
require_once sysPath . 'dataFunction/wInfoSet.data.php';
#连接jqGrid查询的解析类
require_once sysPath . 'class/jqGridSearchSet.class.php';
$time = time();
$mID = $_SESSION ['exp_user'] ['mID'];
$mName = $_SESSION ['exp_user'] ['mName'];
$now = timeStyle("dateTime", "-");
#配置基本jqGrid参数
$page = $_REQUEST['page']; //  第几页 
$limit = $_REQUEST['rows']; //  显示行数
$sidx = $_REQUEST['sidx']; //  排序索引
$sord = $_REQUEST['sord']; // 排序方式
$searchstr = Strip($_REQUEST['filters']);
$searchArr = json_decode($searchstr, true);
switch ($_GET['a']) {
    case "createFee":
        #相关的数据查询
        $unitID = $_GET ['unitID'];
        $month = $_GET ['month'];
        $zeroFee = $_GET['zeroFee']; //控制费用的显示属性
        #获取相关的显示格式
        $fieldDisplay = new fieldDisplay();
        $firstFieldArr = array('status', 'uID', 'name');
        $fieldDisplay->style = "none";
        $fieldArr = $fieldDisplay->feeField();
        $wInfoFieldArr = $fieldDisplay->wInfoField();
        $extraFieldArr = array_unique(mergeArray($firstFieldArr, $fieldArr, $wInfoFieldArr));
        foreach ($extraFieldArr as $eV) {
            if ($eV == "totalFee")
                continue;
            elseif (in_array($eV, $fieldArr))
                $selStr .="a.`" . $eV . "`,";
            else
                $selStr .="b.`" . $eV . "`,";
        }
        $selStr = rtrim($selStr, ",");
        if (!$sidx)
            $sidx = 1;
        elseif (in_array($sidx, $wInfoFieldArr))
            $sidx = "b.`" . $sidx . "`";
        else
            $sidx = "a.`" . $sidx . "`";
        //替换 rules 里面的field, 作为SQL  field使用
        if ($searchArr) {
            foreach ($searchArr as $sKey => $sVal) {
                if ($sKey == "rules") {
                    foreach ($sVal as $sk => $sv) {
                        if (in_array($sv['field'], $fieldArr))
                            $searchArr[$sKey][$sk]['field'] = "a.`" . $sv['field'] . "`";
                        else
                            $searchArr[$sKey][$sk]['field'] = "b.`" . $sv['field'] . "`";
                    }
                }
            }
            $searchAction = new jqGridSearchSet();
            $searchAction->searchArr = $searchArr;
            $searchActionStr = $searchAction->getStringForGroup();
        }
        #如果$_POST['oper'],就进行更新/删除操作
        if ($_POST['oper']) {
            switch ($_POST['oper']) {
                case "del":
                    $IDArr = explode(",", $_POST['id']);
                    foreach ($IDArr as $IDVal) {
                        if ($IDVal)
                            $IDStr .="'" . $IDVal . "',";
                    }
                    $IDStr = rtrim($IDStr, ",");
                    $actionSql = "delete from `a_createFee_tmp` where ID in (" . $IDStr . ")";
                    break;
                case "edit":
                    foreach ($_POST as $pK => $pV) {
                        if ($pK != 'uID' && in_array($pK, $fieldArr)) {
                            $str .="`" . $pK . "`='" . $pV . "',";
                        }
                    }
                    $str = rtrim($str, ",");
                    $actionSql = "update  `a_createFee_tmp` set `sponsorName`='$mName',`sponsorTime`='$now'," . $str . " where `ID`='" . $_POST['id'] . "'";
                    break;
                case "add":
                    foreach ($_REQUEST as $pK => $pV) {
                        switch ($pK) {
                            case "oper":
                            case "id":
                            case "a":
                                break;
                            default :
                                if ($pV)
                                    $str .="`" . $pK . "`='" . $pV . "',";
                                break;
                        }
                    }
                    $str = rtrim($str, ",");
                    $actionSql = "insert into `a_createFee_tmp` set `sponsorName`='$mName',`sponsorTime`='$now'," . $str;
                    break;
            }
            $pdo->query($actionSql);
            exit();
        }
        #这里重新修改过,设置公式,可以每月的公式都不一样,
        $formulasSql = " select `ID`,`totalFeeFormulas` from `a_otherFormulas` where `month`='$month' and `unitID`='$unitID' and `type`='3'";
        $formulasRet = SQL($pdo, $formulasSql, null, 'one');
        if ($formulasRet ['ID']) {
            preg_match_all("/[a-zA-Z]+/", $formulasRet ['totalFeeFormulas'], $feeFieldArr);
            $totalFeeFormulas = strToPHP($formulasRet ['totalFeeFormulas']);
        }
        //后面我强制性的以在职状态进行排序
        $sql = "select a.ID,$selStr  from `a_createFee_tmp` a left join `a_workerInfo` b on a.uID=b.uID where a.`unitID` like '$unitID' and a.`month` like '$month'  $searchActionStr order by b.`status` asc,$sidx $sord ";
        $ret = SQL($pdo, $sql);
        $count = count($ret);
        #jqGrid数据
        $totalrows = isset($_REQUEST['totalrows']) ? $_REQUEST['totalrows'] : false;
        if ($totalrows) {
            $limit = $totalrows;
        }
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        if ($start < 0)
            $start = 0;
        $wSet = new wInfoSet ( );
        $wSet->p = $pdo;
        $wSet->wInfoSetArr();
        $wInfoSet = $wSet->wInfoSet;
        $ret = reCreateArray($ret, $wInfoSet);
#构造数组
        $data['page'] = $page;
        $data['total'] = $total_pages;
        $data['records'] = $count;
        $i = $j = 0;
        if ($ret) {
            foreach ($ret as $key => $fVal) {
                //计算总费用
                $totalFee = 0;
                eval('$totalFee =' . $totalFeeFormulas . ";");
                switch ($zeroFee) {
                    case "1": //不显示费用为0的人员(不包括离职人员)
                        if ($fVal['status'] != '离职' && $totalFee == 0) {

                            unset($ret[$key]);
                            continue 2;
                        }
                        break;
                    case "2"://不显示费用为0的人员(包括离职人员)
                        if ($totalFee == 0) {
                            unset($ret[$key]);
                            continue 2;
                        }
                        break;
                    case "3"://显示费用为0的人员
                        if ($totalFee != 0) {
                            unset($ret[$key]);
                            continue 2;
                        }
                        break;
                }
                if ($key >= $start && $key <= ($start + $limit)) {
                    $data['rows'][$i]['id'] = $fVal['ID'];
                    foreach ($extraFieldArr as $ev) {
                        switch ($ev) {
                            case "totalFee":
                                $data['rows'][$i]['cell'][] = $totalFee;
                                break;
                            case "name":
                                $data['rows'][$i]['cell'][] = "<a href='prsMoney.php?uID=$fVal[uID]' target='_blank'>" . $fVal[$ev] . "</a>";
                                break;
                            case "uID":
                                $data['rows'][$i]['cell'][] = "<a href='" . httpPath . "workerInfo/wManage.php?uID=$fVal[uID]' target='_blank'>" . $fVal[$ev] . "</a>";
                                break;
                            default :
                                $data['rows'][$i]['cell'][] = $fVal[$ev];
                                break;
                        }
                    }
                    $i++;
                }
                foreach ($fieldArr as $fk => $fv) {
                    $data['userdata'][$fv] +=$fVal[$fv];
                }
                $data['userdata']['totalFee']+=$totalFee;
                $j++;
            }

            if ($zeroFee) {
                unset($data);
                $count = count($ret);
                $totalrows = isset($_REQUEST['totalrows']) ? $_REQUEST['totalrows'] : false;
                if ($totalrows) {
                    $limit = $totalrows;
                }
                if ($count > 0) {
                    $total_pages = ceil($count / $limit);
                } else {
                    $total_pages = 0;
                }
                if ($page > $total_pages)
                    $page = $total_pages;
                if ($limit < 0)
                    $limit = 0;
                $start = $limit * $page - $limit; // do not put $limit*($page - 1)
                if ($start < 0)
                    $start = 0;
                $data['page'] = $page;
                $data['total'] = $total_pages;
                $data['records'] = $count;
                $i = $j = 0;
                ksort($ret);
                foreach ($ret as $k => $fVal) {
                    //计算总费用
                    $totalFee = 0;
                    eval('$totalFee =' . $totalFeeFormulas . ";");
                    if ($j >= $start && $j <= ($start + $limit)) {
                        $data['rows'][$i]['id'] = $fVal['ID'];
                        foreach ($extraFieldArr as $ev) {
                            switch ($ev) {
                                case "totalFee":
                                    $data['rows'][$i]['cell'][] = $totalFee;
                                    break;
                                case "name":
                                    $data['rows'][$i]['cell'][] = "<a href='prsMoney.php?uID=$fVal[uID]' target='_blank'>" . $fVal[$ev] . "</a>";
                                    break;
                                case "uID":
                                    $data['rows'][$i]['cell'][] = "<a href='" . httpPath . "workerInfo/wManage.php?uID=$fVal[uID]' target='_blank'>" . $fVal[$ev] . "</a>";
                                    break;
                                default :
                                    $data['rows'][$i]['cell'][] = $fVal[$ev];
                                    break;
                            }
                        }
                        $i++;
                    }
                    foreach ($fieldArr as $fk => $fv) {
                        $data['userdata'][$fv] +=$fVal[$fv];
                    }
                    $data['userdata']['totalFee']+=$totalFee;
                    $j++;
                }
            }
            if ($j > 0)
                $data['userdata']['name'] = "总计(" . ( $j ) . ")人";
            else
                $data['userdata']['name'] = "总计(" . (0) . ")人";
        }
        if ($_GET['oper'] == "excel") {
            #链接PHPEXCEL CLASS
            require_once '../class/phpExcel/Classes/PHPExcel.php';
            require_once '../class/phpExcel/Classes/PHPExcel/Writer/Excel5.php';
            require_once '../class/excel.class.php';
            #EXCEL的显示项目
            $assistFieldSql = "select `ID`,`createFeeStyle` from `a_export_style` where `unitID` like :unitID";
            $assistFieldRet = SQL($pdo, $assistFieldSql, array(":unitID" => $unitID), "one");
            if ($assistFieldRet['createFeeStyle']) {
                $assistArr = explode(",", $assistFieldRet['createFeeStyle']);
                $firstFieldArr = mergeArray($firstFieldArr, $assistArr);
            }
            $tableHeadArr = mergeArray($firstFieldArr, $feeFieldArr[0]);
            //导出的项目= 固定项+额外显示项+费用项
            #获取中英文对照数组
            $engToChsArr = array(
                'status' => "在职状态",
                'pSoInsMoney' => "个人社保欠款",
                'uSoInsMoney' => "单位社保欠款",
                'pHFMoney' => "个人公积金欠款",
                'uHFMoney' => "单位公积金欠款",
                'pComInsMoney' => "个人商保欠款",
                'uComInsMoney' => "单位商保欠款",
                'uPDInsMoney' => "单位残障金欠款",
                "managementCostMoney" => "管理费欠款",
                'salaryMoney' => "工资垫付");

            $fieldDisplay->actionArr = $tableHeadArr;
            $tableHead = $fieldDisplay->fieldStyle(NULL, $engToChsArr);
            $thArr [] = $tableHead;
            if ($ret)
                $excelRet = array_merge($thArr, $ret);
            if (!$excelRet)
                exit("<script> alert('无数据导出') </script>");
            #EXCEL类相关
            $oExcel = new PHPExcel ();
            #设置文档基本属性
            $oPro = $oExcel->getProperties();
            $oPro->setCreator($authorCompany); //公司名
            #构造输出函数
            $excelTitle = $month;
            $op = new excelOutput ();
            $op->oExcel = $oExcel;
            $op->selFieldArray = $tableHead;
            $op->eRes = $excelRet;
            $op->title = $excelTitle;
            $op->fillData();
            $op->eFileName = $excelTitle . ".xls";
            $op->output();
            exit;
        }
        unset($ret);
        break;
    default :
        exit;
}
echo json_encode($data);
?>
