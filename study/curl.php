<?php
/**
 *
 * User: suyin
 * Date: 2017/7/14 9:20
 *
 */
// 1. 初始化
$ch = curl_init();
// 2. 设置选项，包括URL
curl_setopt($ch,CURLOPT_URL,"http://baidu.com");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_HEADER,0);
// 3. 执行并获取HTML文档内容
$output = curl_exec($ch);
$info = curl_getinfo($ch);
echo "<pre>";
print_r($info);exit;
echo ' 获取 '.$info['url'].'耗时'.$info['total_time'].'秒';
if($output === FALSE ){
    echo "CURL Error:".curl_error($ch);
}
// 4. 释放curl句柄
curl_close($ch);
?>