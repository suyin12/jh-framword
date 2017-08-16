<?php
/**
 *
 * User: suyin
 * Date: 2017/7/17 15:34
 *
 */
$redis = new Redis();

$redis->connect("127.0.0.1",6379,3);

var_dump($redis->ping());