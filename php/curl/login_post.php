<?php
function loginPost($url,$cookie,$post){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($post));
    curl_exec($ch);
    curl_close($ch);
}

function getContent($url,$cookie){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_COOKIEJAR,$cookie);
    $rs = curl_exec($ch);
    curl_close($ch);
    return $rs;
}

$post = array(
    '_username'=>'http://www.ydma.cn/login',
    '_password'=>'TextBox2',
    '_submit'=>'登录',
);


$url = "http://www.ydma.cn/login";
$cookie = __DIR__."/cookie_ydma.txt";
$url2 = "http://www.ydma.cn/course/36";

$content = loginPost($url,$cookie,$post);
$content = getContent($url2,$cookie);

file_put_contents('save.txt',$content);