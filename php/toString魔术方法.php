<?php
class Test{
    private $name;

    function __construct($name){
        $this->name = $name;
    }

    function __toString(){
        return '名称:'.$this->name;
    }

    function say(){
        echo $this->name;
    }
}

$test = new Test('粟建晖');
echo $test;
//$test->say();