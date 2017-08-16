<?php
/**
 *
 * User: suyin
 * Date: 2017/8/1 15:04
 *
 */
function getinfos(){
    $redis = new Redis();
    $redis->connect("127.0.0.1","6379");

    $res = $redis->lrange("tutoriallist",0,-1);
    echo "<pre>";
    var_dump($res);
}

getinfos();