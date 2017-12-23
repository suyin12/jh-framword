<?php
abstract class Person{
    protected $name;
    protected $country;

    function __construct($name = '',$country = ''){
        $this->name = $name;
        $this->country = $country;
    }

    abstract function say();
    abstract function eat();

    function run(){
        echo '走路';
    }
}
class ChineseMan extends Person{
    function say(){
        echo $this->name.'说'.$this->country.'话';
    }
    function eat(){
        echo '吃饭';
    }
}
$chineseMan = new ChineseMan('粟建晖','中国');
$chineseMan->say();

class AmericansMan extends Person{
    function say(){
        echo $this->name.$this->country.'人说英语';
    }
    function eat(){
        echo '吃饭';
    }
}
$americansMan = new AmericansMan('suyin','美国');
$americansMan->say();