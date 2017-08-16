<?php
/**
 *
 * User: suyin
 * Date: 2017/8/9 15:32
 *
 */
//依赖注入的理解的最经典例子,没有之一.
class Session{

    public function __construct($cookieName = "PHP_SESSION_ID"){
        session_name($cookieName);
        session_start();
    }

    public function set($name,$value){
        $_SESSION[$name] = $value;
    }

    public function get($name){
        return $_SESSION[$name];
    }

}

/*方式一
 * class User{

    protected $storage;
    public function __construct(){
        $this->storage = new Session('SESSION_ID');
    }

    public function setLanguage($name,$language){
        $this->storage->set($name,$language);
    }

    public function getLanguage($name){
        $this->storage->get($name);
    }
}
*/

/*方式二
 * class User{

    protected $storage;
    public function __construct(){
        $this->storage = new Session(STORAGE_SESSION_NAME);
    }

    public function setLanguage($name,$language){
        $this->storage->set($name,$language);
    }

    public function getLanguage($name){
        $this->storage->get($name);
    }
}
define("STORAGE_SESSION_NAME","SESSION_ID");
*/

/*
 *方式三
 *class User{

    protected $storage;
    public function __construct($cookieName){
        $this->storage = new Session($cookieName);
    }

    public function setLanguage($name,$language){
        $this->storage->set($name,$language);
    }

    public function getLanguage($name){
        $this->storage->get($name);
    }
}
$user = new User('SESSION_ID');
*/

/*
 *方式四
 class User{

    protected $storage;
    public function __construct($storageOptions){
        $this->storage = new Session($storageOptions['name']);
    }

    public function setLanguage($name,$language){
        $this->storage->set($name,$language);
    }

    public function getLanguage($name){
        $this->storage->get($name);
    }
}
$user = new User(['name'=>'SESSION_ID']);
*/

//这就是注入,构造函数注入,还有setter方法注入,和属性注入
class User{

    protected $storage;
    public function __construct($storage){
        $this->storage = new Session($storage);
    }

    public function setLanguage($name,$language){
        $this->storage->set($name,$language);
    }

    public function getLanguage($name){
        $this->storage->get($name);
    }
}

$session = new Session("SESSION_ID");
$user = new User($session);

