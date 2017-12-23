<?php
trait DemoTrait{
    public $pro1 = true;
    static $pro2 = 1;

    function method1(){
        echo '方法1';
    }
    abstract function method2();
}
trait Demo1_trait{
    function fun(){
        echo 'fun';
    }
}
trait Demo2_trait{
    function fun(){

    }
}
trait Demo3_trait{
    function fun3(){
        echo 'fun3';
    }
}
trait Demo4_trait{
    use Demo3_trait;
    function fun4(){
        echo 'fun4';
    }
}
class Demo1_class{
    use DemoTrait;
    function method2()
    {
        // TODO: Implement method2() method.
        echo '方法2';
    }
}
//$demo1 = new Demo_class1;
//$demo1->method1();
//$demo1->method2();
class Demo2_class
{
    use Demo1_trait, Demo2_trait{
        Demo1_trait::fun insteadof Demo2_trait;
    }
}
//$Demo2_class = new Demo2_class;
//$Demo2_class->fun();
class Demo3_class{
    use Demo4_trait;
}

$Demo3_class = new Demo3_class;
$Demo3_class->fun3();
$Demo3_class->fun4();