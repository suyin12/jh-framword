<?php

//页面访问权限
require_once '../auth.php';
//连接模板文件
require_once '../templateConfig.php';
// 常量参数
require_once 'constantConfig.php';
require_once '../common.function.php';


$title = "居住证信息";

/*
 * 查询证件办理里面所有提交人，作为select选项输出
 */
$sql = "select a.createdBy,b.mName from a_papers a left join s_user b on a.createdBy = b.mID group by a.createdBy";
$ret = $pdo->query($sql);
if ($ret) {
    $res = $ret->fetchAll(PDO::FETCH_ASSOC);
    $people_opt [0] = "全部";
    foreach ($res as $v) {
        $people_opt [$v['createdBy']] = $v['mName'];
    }
}

    $status = $_GET['status'];
    $name = $_GET['name'];
    $idcard = $_GET['idcard'];
    $people = $_GET['people'];


    $sql = "select a.*,b.mName from a_papers a left join s_user b on a.createdBy = b.mID where 1=1 ";
    if ($status)
        $sql .= "and a.status = '" . $status . "' ";
    if ($name)
        $sql .= "and a.name = '" . $name . "' ";
    if ($idcard)
        $sql .= "and a.idcard = '" . $idcard . "' ";
    if ($people)
        $sql .= "and a.createdBy = " . $people;
    $ret = $pdo->query($sql);
    if ($ret) {
        $papers = $ret->fetchAll(PDO::FETCH_ASSOC);

        $papers_dis = $papers;


        foreach ($papers as $key => $paper) {
            foreach ($paper as $k => $v) {
                switch ($k) {
                    case "sex": $papers_dis[$key][$k] = $c_sex[$v];
                        break;
                    case "nation": $papers_dis[$key][$k] = $c_nation[$v];
                        break;
                    case "marriage": $papers_dis[$key][$k] = $c_marriage[$v];
                        break;
                    case "hukouAddressType": $papers_dis[$key][$k] = $c_hukouAddressType[$v];
                        break;
                    case "education": $papers_dis[$key][$k] = $c_education[$v];
                        break;
                    case "title": $papers_dis[$key][$k] = $c_title[$v];
                        break;
                    case "skillLevel": $papers_dis[$key][$k] = $c_skillLevel[$v];
                        break;
                    case "planBirthReport": $papers_dis[$key][$k] = $c_planBirthReport[$v];
                        break;
                    case "politics": $papers_dis[$key][$k] = $c_politics[$v];
                        break;
                    case "employmentType": $papers_dis[$key][$k] = $c_employmentType[$v];
                        break;
                }
            }
        }
    }

    if ($_POST['excelout']) {

        // 导出数组的键值
        $selFieldArray = array('idcard', 'name', 'oldname', 'education', 'nation', 'politics', 'marriage',
            'solNumber', 'hukouAddressType', 'beginWork', 'title', 'contractStart',
            'contractEnd', 'employmentType', 'salary', 'skillLevel', 'currentUnitStart',
            'picNumber', 'houseNumber', 'hukouAddress', 'comeDate', 'houseType', 'residentialDate',
            'residentialType', 'telephone', 'mobile', 'urgentContacter', 'ucMobile', 'ucTelephone',
            'planBirthReport', 'planBirthReportNumber');

        require 'papers.excelout.php';
    }

$smarty->assign("papers", $papers_dis);
$smarty->assign("name_s", $name);
$smarty->assign("idcard_s", $idcard);
$smarty->assign("c_status", $c_status);
$smarty->assign("status_s", $status);
$smarty->assign("c_firstApp", $c_firstApp);
$smarty->assign("people_opt", $people_opt);
$smarty->assign("people_s", $people);


$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("agencyService/residentialCards.tpl");
?>