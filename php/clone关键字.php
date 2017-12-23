<?php
class MyClass{
    var $name = '粟建晖';
    function say(){
        echo 'my name is:'.$this->name;echo '<br>';
    }
    function __clone(){
        $this->name = '晖建粟';
    }
}
$obj = new MyClass;
$clone = clone $obj;

$obj->say();
$clone->say();