<?php
/**
 *
 * User: suyin
 * Date: 2017/6/2913:44
 *
 */
class AttendModel{
    private $tel;
    private $name;
    private $age;
    private $class;
    private $address;
    private $time;
    private static $_instance;

    public function __construct($tel='',$name='',$age='',$class='',$address='',$time=0){
        $this->tel = $tel;
        $this->name = $name;
        $this->age = $age;
        $this->class = $class;
        $this->address = $address;
        $this->time = $time;
    }
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function comprehensive($type){

    }
    public function arrConfig($type){
       $arr = array(
           "time"=>array(

           ),
           "address"=>array(

           ),
       );
    }
}