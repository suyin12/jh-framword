<?php
class Person{
    private $name;
    private $sex;
    private $age;

    function __construct($name = '',$sex = '男',$age = 0){
        $this->name = $name;
        $this->sex = $sex;
        $this->age = $age;
    }

    function say(){
        echo '我叫'.$this->name.'性别'.$this->sex.'年龄'.$this->age;
    }

    function __sleep(){
        $arr = array('name','age');
        return $arr;
    }

    function __wakeup(){
        $this->age = 40;
    }
}