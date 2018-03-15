<?php
class Mac{
    public function say(){
        echo 'hello';
    }
    public function __call($method,$param){
        var_dump($method);echo '---';
        var_dump($param);
        return '';
    }
    public static function __callStatic($method,$param){
        var_dump($method);echo '---';
        var_dump($param);
        return '';
    }
}

$mac = new Mac;

//$mac->says('func',['a','b',3]);

Mac::sayss('content','app\controllers\BlogController@content');