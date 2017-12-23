<?php
interface One{
    const STATS = 1;
    function fun1();
    function fun2();
}
interface Two extends One{
    function fun3();
    function fun4();
}
abstract class Three implements One{
    function fun1(){

    }
}
class Four implements One{
    function fun1()
    {
        // TODO: Implement fun1() method.
    }
    function fun2()
    {
        // TODO: Implement fun2() method.
    }
}
class Five implements One,Two{

}
class Six extends Four implements Two{

}