<?php

function longCURL($url,$opt){
    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);

    curl_setopt($ch,CURLOPT_POST,1);

    curl_setopt($ch,CURLOPT_POSTFIELDS,$opt);

    $ret = curl_exec($ch);
//    if(curl_errno($ch)){
//        echo "Error".curl_error($ch);
//    }
    $repos = curl_getinfo($ch);
    echo '<pre>';
    print_r($repos);exit;
    curl_close($ch);

    return $ret;
}

$url = "http://www.ssunse.com/admin/action/login_do.php";

$opt = [
    'username' => '方鑫丽',
    'pwd' => 'sfjxhl0908',
    'code' => '0887'
];

echo longCURL($url,$opt);
