<?php
/* 特定的配置文件 , 不能格式化代码,前面的行数不准变动, 用于修改里面特定行的配置内容 */
#派遣系统版本号
function versionInfo() {
    $arr = array('NO' => '1.5');
    return $arr;
}
#人力资源公司注册信息
define("_serverID", "");
define("_UUID", "");
$serverCompany = "深圳市鑫锦程人力资源管理有限公司";
$serverUrl = "http://www.cnhrmo.com";
#设置社保,公积金,商保的截止申报日期
function insuranceInTurn($type) {
    switch ($type) {
case "soIns":$day = "20";break;case "HF":$day = "24";break;case "comIns":$day = "23";break;case "performance":$day = "20";case"recruit":$day="01";break;
    }
    return $day;
}
#社保及公积金等缴交账号设置
function insuranceID($type=null) {
$arr = array("soIns" => array("163870", "188908","
680606"), "HF" => array("1002057166", "1000564707", "1004430688","1008317864","1008821686","1010794668","1013009383"),'houseNumber'=>'4403030040030300013000103');
    if ($type)
        $newArr = $arr[$type];
    else
        $newArr = $arr;
    return $newArr;
}
#wantToMerge的 unit信息的配置
function wantToMergeInfo() {
    $arr = array("1" => "中国邮政集团公司深圳市分公司", "2" => "速递物流", "3" => "顺丰速递","4"=>"邮政承揽");
    return $arr;
}
?>
