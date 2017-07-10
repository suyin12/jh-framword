<?php

/*
 * unitAll(PDO,查找的字段,查询条件)
 * unit_manager(pdo,职位名称); 返回数组形式
 * 
 */
#单位信息基本设置

function unitSet($pdo) {
    $comSql = "select * from `s_comIns_set`";
    $comRet = SQL($pdo, $comSql);
    $comRet = keyArray($comRet, "comInsType");
    $insuranceID = insuranceID();
    $arr = array("status" => array("1" => "服务中", "0" => "终止"),
        "type" => array("1" => "派遣单位", "0" => "未启用", "3" => "特殊招聘单位"),
        "insuranceFrom" => array("0" => "默认", "1" => "单位支付", "2" => "个人支付"),
        "insuranceModel" => array("0" => "默认", "2" => "循环垫付","3"=>"仅垫付单位","4"=>"仅垫付个人"),
        "insuranceMoneyRecive"=>array("0" => "默认", "1" => "单位和个人分摊"),
        "soInsID" => $insuranceID['soIns'],
        "HFID" => $insuranceID['HF'],
        "comInsType" => $comRet
    );

    return $arr;
}

#所有单位信息(PDO,查找的字段,查询条件)

function unitAll($p, $str, $con = null, $type="all") {
    $sql = "select " . $str . " from a_unitInfo where unitName not like '深圳市' ";
    $sql .= $con;
    $sql .= " order by unitName";
    $res = $p->prepare($sql);
    $res->execute();
    if ($type == "all") {
        $ret = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ret as $val) {
            $newArr [$val ['unitID']] = $val;
        }
    } elseif ($type == "one")
        $newArr = $res->fetch(PDO::FETCH_ASSOC);
    unset($ret);
    return $newArr;
}

#客户经理对应的单位信息(pdo,职位名称)

function unit_manager($p, $roleID, $conStr = null,$status=null) {

    //各角色管辖单位查询
    $sql = "select `mID`,`unitID`,`mName` from s_user where `roleID` REGEXP ? ";
    if($status=="1"){
        $sql .=" and `status`='1'";
    }
    $res = $p->prepare($sql);
    $res->execute(array(",".$roleID . ","));
    $ret = @$res->fetchAll(PDO::FETCH_ASSOC);
    if(!$conStr)
        $conStr = " unitID,unitName,unitAddr,preManagerId ";
    //单位信息查询
    if($ret) {

    foreach ($ret as $k => $v) {
        // 查询单位信息表和系统用户信息表
        $sql = "select $conStr from a_unitInfo  where unitID in (" . $ret [$k] ['unitID'] . ")   order by unitName";
        $res_s = $p->prepare($sql);
        $res_s->execute();
        $ret_s = $res_s->fetchAll(PDO::FETCH_ASSOC);
        $ret_s = keyArray($ret_s, "unitID");
        //		$manager = array ("mID" => $ret [$k] ['mID'], "mName" => $ret [$k] ['mName'] );
        $unit_manager [] = array("mID" => $ret [$k] ['mID'], "mName" => $ret [$k] ['mName'], "unit" => $ret_s);
    }
    }
    return $unit_manager;
}

//print_r($unitManager = unit_manager ( $pdo, "2_1" ));
#  参数: $p PDO对象  $uid 欲查询的员工的unitID值
#  返回: 如果找到，则返回客户经理ID，否则返回FALSE
#  假设: 每个单位只归一位客户经理管理
/*
 * 多加一个参数role，因为s_user的unitID字段有三种情况：
 * 			role = 2_1)对于客户经理，unitID是客户经理管理的单位
 * 			role = 3_1)对于社保专员，unitID是社保专员负责的单位
 * 			role = 对于工资专员，unitID是工资专员负责的单位  o(╯□╰)o

 */
function manager($p, $uid, $role = "") {
    switch ($role) {
        case "2_1" :
        case "3_1" :
            $sql = "select mID,mName,unitID from s_user where roleID REGEXP '," . $role . ",' ";
            break;
        default :
            $sql = "select mID,mName,unitID from s_user ";
            break;
    }
    $ret = $p->query($sql);
    if ($ret) {
        $users = $ret->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            if ($user ['unitID'])
                $users_arr [$user ['mID']] = $user ['unitID'];
        }
        foreach ($users_arr as $mID => $unitID) {
            $unit_arr = explode(",", $unitID);
            if (in_array($uid, $unit_arr))
                return $mID;
        }
        return FALSE;
    }
    return FALSE;
}

#用来统计所有的角色名及用户名  $conArr= array("mID"=>" mName as name,mID as ID ","roleID"=>" roleID as ID,roleName as roleName",....)

function getRoleLable($pdo, $conArr = null) {
    $mIDCon = $conArr ['mID'] ? $conArr ['mID'] : " mName as name,mID as ID ";
    $mIDSql = "select $mIDCon from s_user";
    $mIDRes = $pdo->query($mIDSql);
    $mIDRet = $mIDRes->fetchAll(PDO::FETCH_ASSOC);
    $mIDRet = keyArray($mIDRet, "ID");

    $roleIDCon = $conArr ['roleID'] ? $conArr ['roleID'] : " roleID as ID,roleName as name ";
    $roleIDSql = "select $roleIDCon  from s_role";
    $roleIDRes = $pdo->query($roleIDSql);
    $roleIDRet = $roleIDRes->fetchAll(PDO::FETCH_ASSOC);
    $roleIDRet = keyArray($roleIDRet, "ID");

    $labelArr = array("mID" => $mIDRet, "roleID" => $roleIDRet);
    return $labelArr;
}

/**
 * 声明：以下方法是蒋钦加的------------------------------------------------------------------
 */
//查询所有角色
function getALLRole($pdo) {
    $sql = "SELECT * FROM `s_role` order by roleID";
    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $ret = keyArray($ret, "roleID");
    return $ret;
}

//查询所有部门
function getALLGruop($pdo) {
    $sql = "SELECT * FROM `s_group` order by groupID";
    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $ret = keyArray($ret, "groupID");
    return $ret;
}

//查询所有用户
function getAllUser($pdo, $status="") {
    switch ($status) {
        case "0" ://离职
            $sql = "SELECT * FROM `s_user` where `status`='$status' order by uID";
            break;
        case "1" ://在职
            $sql = "SELECT * FROM `s_user` where `status`='$status'order by uID";
            break;
        default :
            break;
    }
    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    return $ret;
}

//按"是否在职"&&"所在部门"&&"角色"查询用户信息
function getAboutUser($pdo, $status="", $groupID="", $roleID="") {
    //"SELECT * FROM `s_user` where `status`=1 and `groupID` REGEXP '2' and `roleID` REGEXP '2_1'";
    $sql = "SELECT * FROM `s_user` where ";
    if ($groupID != "" && $roleID != "") {
        $sql.="`groupID` REGEXP '$groupID' and `roleID` REGEXP '$roleID' and `status`='$status'";
    }
    if ($groupID == "" && $roleID == "") {
        $sql.="`status`='$status'";
    }
    if ($groupID != "" && $roleID == "") {
        $sql.="`groupID` REGEXP '$groupID' and `status`='$status'";
    }
    if ($groupID == "" && $roleID != "") {
        $sql.="`roleID` REGEXP '$roleID' and `status`='$status'";
    }
    $sql .=" order by groupID";
    //echo $sql."<br/>";
    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    return $ret;
}

//查找出 type=1 的单位信息
function getAllUnitinfo($pdo) {
    $sql = "SELECT * FROM `a_unitinfo` where `type`=1";
    $res = $pdo->query($sql);
    $ret = $res->fetchAll(PDO::FETCH_ASSOC);
    $ret = keyArray($ret, "unitID");
    return $ret;
}

/*
 * 取出 同角色【"客户经理"，"业务文员"，"社保专员"】中 未分配的单位名称 
 * [思路:]
 * <1>在's_user'表中取出同类角色中所有单位名称 
 * <2>取出's_unitinfo'表中所有用人单位的名称
 * <3>两个结果相比较就得出未分配单位的名称
 */

function unitList($role, $pdo, $status) {
    switch ($role) {
        case '2_0'://业务部主管
        case '2_1'://客户经理
        case '2_2'://业务文员
        case '3_1'://社保专员
        case '3_4'://商保专员
        case '3_5': //公积金专员
        case '3_6': //就业登记专员   
            $sqlByRole = "SELECT `mName`,`unitID` FROM `s_user`where `roleID` regexp ',$role,' and `status`=$status";
            $retByRole = $pdo->query($sqlByRole);
            $rowByRole = $retByRole->fetchAll(PDO::FETCH_ASSOC);
            for ($roleid = 0; $roleid < count($rowByRole); $roleid++) {
                $unitIDSTR.=$rowByRole[$roleid]['unitID'] . ",";
            }
            $unitidlist = explode(",", $unitIDSTR);
            $unitidlist = array_filter($unitidlist);
            break;
    }
    //<2>取出's_unitinfo'表中所有用人单位的名称
    $sqlByunit = "SELECT `unitID`,`unitName` FROM `a_unitinfo` where type='1'and status='1'";
    $retByunit = $pdo->query($sqlByunit);
    $rowByunit = $retByunit->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($rowByunit); $i++) {
        $unitListstr.=$rowByunit[$i]['unitID'] . ",";
    }
    $unitList = array_filter(explode(",", $unitListstr));

    //<3>两个结果相比较就得出未分配单位的名称 arry_diff() 方法比较两个数组
    if (count(array_diff($unitList, $unitidlist)) != 0) {
        $unitother = implode(",", array_diff($unitList, $unitidlist));
        $sqlUnitOther = "SELECT `unitID` , `unitName` FROM `a_unitinfo` WHERE `unitID` IN ($unitother)";
        $retUnitOther = $pdo->query($sqlUnitOther);
        $rowUnitOther = $retUnitOther->fetchAll(PDO::FETCH_ASSOC);
        return $rowUnitOther;
    } else {
        return null;
    }
}

//清除同一个用户角色中重复的权限   (主要是避免多重角色权限重复)
function getOnlyFunction($roleList, $pdo) {
    if (count($roleList) > 0) {
        //循环读出权限ID
        foreach ($roleList as $value) {
            $sql = "SELECT `Function_ID_STR` FROM `s_role` WHERE `roleID` = '$value'";
            $res = $pdo->query($sql);
            $ret = $res->fetch(PDO::FETCH_ASSOC);
            $functionSTR .=$ret['Function_ID_STR'];
        }
        $functionList = explode(",", $functionSTR);
        //循环读取删除为空的值
        foreach ($functionList as $key => $fvl) {
            if ($fvl == "") {
                unset($functionList[$key]);
            }
        }
        $functionList = array_unique($functionList); //删除数组中重复的值
        //echo "方法：<pre>";
        //print_r($functionList);
        return $functionList;
    } else {
        return array();
    }
}

/*
 * 获取完整的用户权限（包括角色重复和特殊权限）
 * $roleList:用户多重角色数组
 * $function_STR:用户特殊方法
 */

function getAllFunction($roleList, $pdo, $functin_STR) {
    $function_List_ByRole = getOnlyFunction($roleList, $pdo);

    if ($functin_STR != "") {
        $userfunction = explode(",", $functin_STR);
        array_pop($userfunction);
        //echo "<pre>";
        //print_r ( $userfunction );
        foreach ($userfunction as $Ukey => $Uvalue) {
            $userfunction [$Ukey] = abs($Uvalue); //abs()取绝对值函数
        }
        //echo "取绝对值后的值：<pre>";
        //print_r ( $userfunction );
        $functionListPush = array_diff($function_List_ByRole, $userfunction);
        $functionListAdd = array_diff($userfunction, $function_List_ByRole);
        foreach ($functionListAdd as $addVal) {
            array_push($functionListPush, $addVal);
        }
        return $functionListPush;
    } else {
        return $function_List_ByRole;
    }
}

?>