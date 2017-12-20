<?php
/**
 * Date: 2017/11/14 11:17
 */
interface people{
    public function marry();
}

class man implements people{
    public function marry(){
        echo "song jiezhi<br/>";
    }
}

class women implements people{
    public function marry(){
        echo "chuan hunsha";
    }
}

interface createMan{
    public function create();
}

class FactotyMan implements createMan{
    public function create(){
        return new man;
    }
}

class FactotyWomen implements createMan{
    public function create(){
        return new women;
    }
}

class Client{
    public static function test(){
        $factoty = new FactotyMan;
        $man = $factoty->create();
        $man->marry();

        $factoty = new FactotyWomen();
        $women = $factoty->create();
        $women->marry();
    }
}

$client = Client::test();
