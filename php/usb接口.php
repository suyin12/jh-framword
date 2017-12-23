<?php
interface USB{
    function run();
}

class Computer implements USB{
    function useUSB($use){
        $use->run();
    }
}

class Ukey implements USB{
    function run(){
        echo '键盘';
    }
}

class Umouse implements USB{
    function run(){
        echo '鼠标';
    }
}

class Ustore implements USB{
    function run(){

    }
}

$computer = new Computer();

$computer->useUSB(new Ukey);
$computer->useUSB(new Umouse);
$computer->useUSB(new Ustore);