<?php

/*
 *     2010-8-17
 *          <<<  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */

#页面访问权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
$a = $_GET ['a'];
if (!$a) {
    exit("非法网址");
} else {
    foreach ($_GET as $getKey => $getVal) {
        switch ($getKey) {
            case "zID" :
            case "unitID" :
            case "extraBatch":
                if (is_numeric($getVal))
                    $getQuery [$getKey] = $getVal;
                else
                    exit("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                break;
            case "month":
            case "rewardDate" :
                if (isMonth($getVal))
                    $getQuery [$getKey] = $getVal;
                else
                    exit("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                break;
        }
    }
    //获取中英文对照数组
    $engToChsArr = engTochs();
    //获取GET参数
    $zID = $getQuery ['zID'];
    $unitID = $getQuery ['unitID'];
    $month = $getQuery ['month'];
    $extraBatch = $getQuery['extraBatch'];
    #获取该帐套对应的列,包括列的中文名
    $zfSql = "select zIndex,field,payFormulas,ratalFormulas,acheiveFormulas,uAccountFormulas from a_zformatInfo where zID like :zID";
    $zfRes = $pdo->prepare($zfSql);
    $zfRes->execute(array(":zID" => $zID));
    $zfRet = $zfRes->fetch(PDO::FETCH_ASSOC);
    $fieldArr = makeArray($zfRet ['field']);
    $zIndex = makeArray($zfRet ['zIndex']);
    $zIndex = array_flip($zIndex);
    $newFieldArr ['name'] = "姓名";
    $newFieldArr ['uID'] = "员工编号";
    foreach ($fieldArr as $key => $val) {
        if (array_key_exists($key, $zIndex)) {
            $key = $zIndex [$key];
            $val = $engToChsArr [$key];
        }
        if ($key == "uID") {
            $val = $engToChsArr [$key];
        }
        switch ($key) {
            case "unitID":
                break;
            case "name":
                break;
            default :
                $newFieldArr [$key] = $val . "(" . $key . ")";
                break;
        }
    }
    //这里增加几个字段,可以自定义控制查询所需的字段名
//	$newFieldArr ['month'] = $engToChsArr ['month'];
    $newField = implode(",", array_keys($newFieldArr));

    switch ($a) {
        case "reward" :
            //查找所需的字段,生成预览 ,限制10条
            $sql = "select $newField,ID  from `a_rewardFee_tmp` where unitID like  :unitID and month = :month and extraBatch = :extraBatch ";
            if ($_POST['search']) {
                $sql .=" and name like '" . trim($_POST['name']) . "%'";
                unset($_GET['m'], $_GET['c']);
            }
            $model = $_GET['m'];
            if ($model) {
                $sql .=" and `" . $model . "` like '" . $_GET['c'] . "'";
            }
            $res = $pdo->prepare($sql);
            $res->execute(array(":unitID" => $unitID, ":month" => $month, ":extraBatch" => $extraBatch));
            $ret = $res->fetchAll(PDO::FETCH_ASSOC);
            foreach ($ret as $val) {
                foreach ($val as $k => $v) {
                    switch ($k) {
                        case "name":
                            $total[$k] = "合计";
                            break;
                        case "bID":
                            $total[$k] = null;
                            break;
                        case "ID":
                            break;
                        default:
                            if (is_numeric($v)) {
                                $total[$k]+=round((double) $v, 2);
                            } else {
                                $total[$k] = null;
                            }
                            break;
                    }
                }
            }
            break;
    }
    #变量配置
    $smarty->assign("newFieldArr", $newFieldArr);
    $smarty->assign("ret", $ret);
    $smarty->assign("total", $total);
    #模板配置
    $smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
    $smarty->display("rewardManage/detail.tpl");
}
?>