<?php
/**
 * Date: 2017/11/13 13:49
 */
$redis = new Redis;

$connect = $redis->connect('127.0.0.1','6379');

//echo $redis->ping();

$redis->set('server','apache');
$server = $redis->get('server');

$runoob = $redis->lrange('runoob',0,10);

echo "<br>";
var_dump($server);

echo "<br>";
echo "<pre>";
var_dump($runoob);