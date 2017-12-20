<?php
/**
 *
 * Date: 2017/7/29 11:02
 *
 */
function insertinfo(){
    $arr = [
        'info1'=>mt_rand(100,999),
        'info2'=>mt_rand(100,999)
        ];

    insertinfos($arr,'tutorial-list','tutoriallist');
}
function insertinfos($arr,$qukey,$listkey){
    //连接本地redis
    $redis = new Redis();
    $redis->connect("127.0.0.1","6379");
    //存储数据到列表中
    $redis->lpush($qukey,json_encode($arr));
    $redis->lpush($listkey,json_encode($arr));
}
insertinfo();

