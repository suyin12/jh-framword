<?php

/*
 * 思路,
 * 1.写一个员工信息函数,保存跟员工有关的信息
 * 2.$con 表示的是 condition(where条件)
 * 3.$num 表示的是 需要那几条sql语句.(array类型)
 * 4.生成的员工信息为数组格式 $key=>$value
 * 5.函数的返回类型是一个数组 
 * 
 */

function workerData($con, $num) {
    $sql = "select a.* from a_workerInfo";
}

#离职员工信息,返回离职记录 参数分别为 workerDimission($pdo,查询项,查询条件,一个人返回的条数='最后一条离职记录',返回数组的类别)

function workerDimission($pdo, $selStr=" * ", $conStr=" 1 ", $listType='one', $type='all') {
    $sql = "select " . $selStr . " from a_dimission where  ";
    $sql .= $conStr;
    if ($listType == "one")
        $sql .="group by uID having max(ID)";
    $res = $pdo->prepare($sql);
    $res->execute();
    if ($type == "all") {
        $ret = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($ret as $val) {
            $newArr [$val ['uID']] = $val;
        }
    } elseif ($type == "one")
        $newArr = $res->fetch(PDO::FETCH_ASSOC);
    unset($ret);
    return $newArr;
}

?>