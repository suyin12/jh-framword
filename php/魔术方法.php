<?php
class Person{
    private $name;
    private $age;
    private $sex;

    function __construct($name = '',$sex = '男',$age = 1){
        $this->name = $name;
        $this->sex = $sex;
        $this->age = $age;
    }
    function __set($propertyName,$propertyValue){
        if($propertyName == 'sex'){
            if(!($propertyValue == '男' || $propertyValue == '女')){
                return ;
            }
        }
        if($propertyName == 'age'){
            if($propertyValue > 150 || $propertyValue < 0){
                return ;
            }
        }
        $this->$propertyName = $propertyValue;
    }
//    function __get($propertyName){
//        if($propertyName == 'sex')
//            return '保密';
//        if($propertyName == 'age'){
//            if($this->$propertyName>30){
//                return $this->$propertyName - 10;
//            }else{
//                return $this->$propertyName;
//            }
//        }
//        return $this->$propertyName;
//    }
    function say(){
        echo '我叫'.$this->name.',性别'.$this->sex.',今年'.$this->age.'岁';
    }
    function __isset($propertyName){
        if($propertyName == 'name'){
            return false;
        }
        return isset($this->$propertyName);
    }
    function __unset($propertyName){
        if($propertyName == 'name'){
            return ;
        }else{
            unset($this->$propertyName);
        }
    }
    function __toString()
    {

    }

//    function __destruct(){
//        echo '我是'.$this->name.',我走了,再见!';
//    }

}
$person = new Person('粟建晖','男',20);
//$person->name = '超人';
//$person->age = '30';
//$person->sex = '女';
//
//$person->sex = '保密';
//$person->age = 800;

//var_dump(isset($person->name));echo '<br>';
//var_dump(isset($person->age));echo '<br>';
//var_dump(isset($person->sex));echo '<br>';
unset($person->sex);echo '<br>';
unset($person->name);echo '<br>';
unset($person->age);echo '<br>';


$person->say();

