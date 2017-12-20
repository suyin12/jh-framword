<?php
class Person {
    protected $name;
    protected $age;
    protected $sex;

    public function __construct($name,$age = 18,$sex){
        $this->name = $name;
        $this->age = $age;
        $this->sex = $sex;
    }

    protected function say(){
        echo '我叫---'.$this->name.',年龄---'.$this->age.'性别---'.$this->sex;
    }
}

class Student{
    static $name;
    static $age;
    static $sex;
    static $class;
    public function __construct(){
//        parent::__construct($name,$age = 18,$sex);

    }
    public static function say(){
//        parent::say();
        echo '我叫---'.self::$name.',年龄---'.self::$age.'性别---'.self::$sex;
        echo ',在'.self::$class.'上学';
        echo $var;
    }

}
trigger_error('没有找到文件',E_USER_ERROR);
ini_set('display_errors','on');
ini_set('error_reporting',E_ALL&~(E_WARNING|E_NOTICE));
$student = new Student();
Student::$name = '粟建晖';
Student::$age = '18';
Student::$sex = '男';
Student::$class = '平南县中学';
Student::say();
