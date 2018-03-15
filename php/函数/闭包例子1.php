<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 11:06
 */
class Di
{
    private $factory;

    public function set($id, $value)
    {
        $this->factory[$id] = $value;
    }

    public function get($id)
    {
        $val = $this->factory[$id];
        return $val();//如果不加括号,仅仅返回的是闭包类,并不是User实例
    }
}

class User
{
    private $username;

    public function __construct($username = '')
    {
        $this->username = $username;
    }

    public function getUserName()
    {
        return $this->username;
    }
}

$di = new Di();

// 在此使用了闭包,所以实际上并不会实例化User类,只有在后面get的时候才会实例化
$di->set('a', function(){
    return new User('张三');
});

var_dump($di->get('a')->getUserName());