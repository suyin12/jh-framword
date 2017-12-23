<?php
namespace MyProject1;

//const STATS = 'this is a const';

//function demo(){
//    echo 'this is a function';echo '<br>';
//}

//class User{
//    static function name(){
//        echo __NAMESPACE__;echo '<br>';
//    }
//}
//echo STATS;echo '<br>';
//User::name();
//demo();




namespace MyProject2;


\MyProject1\demo();


class User{
    static function name(){
        echo __NAMESPACE__;echo '<br>';
    }
}

$user = new \MyProject1\User();
$user::name();
