<?php
namespace cn\ydma;

const PATH = 'cn/ydma';

class User{

}


//namespace broshop;
//class User{
//
//}
//class MyUser{
//
//}
//use cn\ydma\User;
//
//$user = new User();

//use cn\ydma\User as MyUser ;//与当前命名空间元素冲突,将导致失败.
//$user = new MyUser();
echo namespace\PATH;echo '<br>';

$user = new namespace\User();

echo __NAMESPACE__;echo '<br>';
$user_class_name = __NAMESPACE__.'\User';
$user = new $user_class_name;

