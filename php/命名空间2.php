<?php
namespace cn;
class User{

}
$user = new User(); //非限定名称,表示当前空间被解析为cn\User();
$user = new ydma\User();//限定名称,表示当前空间被解析为cn\ydma\User();
$user = new \ydma\User();//完全限定名称,表示当前空间被解析为ydma\User();
$user = new \cn\ydma\User;//完全限定名称,表示当前空间被解析为cn\ydma\User;


//namespace cn\ydma;
//
//class User{
//
//}