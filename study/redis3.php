<?php
/**
 *
 * Date: 2017/8/2 15:08
 *
 */
$redis = new Redis();
$redis->connect("127.0.0.1","6379");

$redis->set("name","粟建晖");
$redis->setnx("name","suyin");
echo $redis->get("name");


$redis->delete("name");
$redis->setnx("name","suyin");
//var_dump($redis->get("name"));
var_dump($redis->exists("name"));

$redis->set("num","132");
echo "<br />";
var_dump($redis->incr("num"));
var_dump($redis->incr("num"));

echo "<br />";
var_dump($redis->decr("num"));
var_dump($redis->decr("num"));
var_dump($redis->getMultiple(array("name","num")));

echo "<br />";
var_dump($redis->lpush("list","111"));
var_dump($redis->lpush("list","222"));

echo "<br />";
var_dump($redis->rpush("list","333"));
var_dump($redis->rpush("list","333"));

$res = $redis->lrange("list",0,-1);

echo "<br />";
echo "<pre>";
var_dump($res);

echo "<br />";
//var_dump($redis->lpop("list"));

echo "<br />";
var_dump($redis->lsize("list"));

echo "<br />";
var_dump($redis->llen("list"));

echo "<br />";
var_dump($redis->lget("list","2"));

echo "<br />";
var_dump($redis->lset("list",2,"新值"));

echo "<br />";
var_dump($redis->lgetrange("list",0,-1));

echo "<br />";
var_dump($redis->lgetrange("list",0,-1));
echo "<br />";
var_dump($redis->lRemove("list","333",0));



echo "<br />";
//$redis->delete("list3");
var_dump($redis->sAdd("list3","333"));
var_dump($redis->sAdd("list3","444"));


var_dump($redis->sAdd("list2","111"));
var_dump($redis->sAdd("list2","222"));
//$redis->sRemove("list3","333");
//print_r($redis->sort('list3'));
print_r($redis->sort('list2'));
print_r($redis->sort('list3'));
$redis->smove("list2","list3","111");
print_r($redis->sort('list2'));
print_r($redis->sort('list3'));

var_dump($redis->sContains("list3","111"));

echo $redis->ssize("list3");
print_r($redis->sort('list3'));
//var_dump($redis->spop("list3"));
echo "<br />";
var_dump($redis->sinter("list2","list3"));

echo "<br />";
var_dump($redis->sinterStore("new","list2","list3"));//成功返回，交集的个数，失败false
var_dump($redis->sMembers("new"));
echo "<br />";
var_dump($redis->sunion("list2","list3"));
echo "<br />";
var_dump($redis->sunionStore("new2","list2","list3"));//成功返回，交集的个数，失败false
var_dump($redis->sMembers("new2"));

echo "<br />";
var_dump($redis->sdiff("list2","list3"));

echo "<br />";
var_dump($redis->sdiffStore("new3","list2","list3"));//成功返回，交集的个数，失败false
var_dump($redis->sMembers("new3"));
echo "<br />";
var_dump($redis->sMembers("list3"));

