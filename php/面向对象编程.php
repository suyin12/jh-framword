<?php
class Person{
    private $name;
    private $age;
    private $sex;

    function __construct(){
//        $this->name = $name;
//        $this->age = $age;
//        $this->sex = $sex;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function setSex($sex){
        if($sex == '男'||$sex == '女')
            $this->sex = $sex;
        else
            $this->sex = '未知';
    }
    public function setAge($age){
        if($age > 150 || $age < 0)
            return ;
        $this->age = $age;
    }
    public function getAge(){
        if($this->age>30)
            return $this->age - 10;
        else
            return $this->age ;
    }
    public function say(){
        echo '我叫'.$this->name.',性别'.$this->sex.',今年'.$this->age.'岁';
    }
    function __destruct(){
        echo $this->name.',我走了';echo '<br>';
    }

}
$person = new Person();
$person->setName('方先生');
$person->setSex('打');
$person->setAge(40);
echo $person->getAge();
$person->say();