<?php
class MyClass{
    static $count;
    const STATS = 1;
    function __construct(){
        self::$count++;
    }

    static function getCount(){
        return self::$count;
    }
    function getStats(){
        echo self::STATS;
    }
}

$obj3 = new MyClass;
$obj3 = null;
$obj2 = new MyClass;

//echo $obj2->getCount();
//echo $obj3::getCount();
//$obj2->getStats();
if($obj2 instanceof MyClass){
    echo '1';
}

