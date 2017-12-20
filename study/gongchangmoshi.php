<?php
/**
 * Date: 2017/11/14 11:03
 */
interface people{
    public function marry();
}

class man implements people{
    public function marry(){
        echo "song jiezhi,song meigui";
    }
}

class women implements people{
    public function marry(){
        echo "chuan hunsha";
    }
}

class SimpleFactoty{
    public static function createMan(){
        return new man;
    }
    public static function createWomen(){
        return new women;
    }
}

$createMan = SimpleFactoty::createMan();
$createMan ->marry();
$createWomen = SimpleFactoty::createWomen();
$createWomen->marry();