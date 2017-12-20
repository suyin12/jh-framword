<?php
/**
 * Date: 2017/11/8 17:32
 */
ini_set('memory_limit','128M');
function select($sql,Memcache $memcache){
    $key = md5($sql);

    $data = $memcache->get($key);

    if(!$data){
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=ci","root","123456");
        }catch(PDOException $e){
            die("连接失败".$e->getMessage());
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $memcache->add($key,$data,MEMCACHE_COMPRESSED,0);

    }

    return $data;
}
function msectime() {
    list($msec, $sec) = explode(' ', microtime());
    return $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
}

$start = msectime();
echo $start;
$memcache = new Memcache;

$bool = $memcache->connect('localhost',11211);
//var_dump($bool);echo "连接成功!";
//echo memory_get_usage()/1024;
$sql = "select * from vote_record left join vote_record_memory on vote_record.id = vote_record_memory.id limit 20000";
$key = md5($sql);
//$data = select($sql,$memcache);

//echo "<pre>";
//var_dump($data);

//$get = $memcache->get();
echo "<pre>";
$data = $memcache->get($key);
var_dump($data);
//var_dump($memcache->flush());
echo msectime()-$start;
//echo memory_get_usage()/1024;

//$memcache->connect('localhost',11211);
//
//$add = $memcache->add('a','我是php');
////var_dump($add);echo "<br>";
//
//echo "<pre>";
//echo "<br>";
//var_dump($memcache->get('a'));
//
//$memcache->add('lamp',array('linux','apache','mysql','php'));
//echo "<pre>";
//echo "<br>";
//var_dump($memcache->get('lamp'));
//
////$memcache->set('b','我叫成功',MEMCACHE_COMPRESSED,30);
//
//echo "<pre>";
//echo "<br>";
//var_dump($memcache->get('b'));
//
//$memcache->set('a','修改a');
//
//echo "<pre>";
//echo "<br>";
//var_dump($memcache->get('a'));
//$memcache->add('1','memcache');
//
//$memcache->add('2',array('php','css','javascript'));
//
//$memcache->add('3',array('a','b','c'),MEMCACHE_COMPRESSED,0);
//
//$memcache->set('1','redis');
//
//$memcache->set('1','CIphp框架',MEMCACHE_COMPRESSED,7*24*69*69);
//
//$memcache->replace('2',array('A','B','C'),MEMCACHE_COMPRESSED,31*24*60*60);
//
//$value = $memcache->get('1');
//
//$value2 = $memcache->get(array('1','2'));

$memcache->close();





