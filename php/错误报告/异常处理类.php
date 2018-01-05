<?php
class MyException extends Exception{
    function __construct($message,$code=0){
//        $this->message = $message;
//        $this->code = $code;
        parent::__construct($message,$code);
    }

    function __toString()
    {
        return  __CLASS__.":{$this->code}".":{$this->message}".'<br>';
    }

    function customFunction(){
        echo '自定义方法处理该异常'.'<br>';
    }
}

//try{
//    $error = '允许抛出的异常';
//    throw new MyException($error);
//}catch(MyException $e){
//    echo $e;
//    $e->customFunction();
//}
//echo 'hello';
class TestException{
    public $var;
    function __construct($var=0)
    {
        switch($var){
            case 1:
                throw new MyException('参数为1',6);
            case 2:
                throw new Exception('参数为2',2);
            default:
                $this->var = $var; break;
        }
    }
}
//try{
//    $obj = new TestException();
//    echo '*****************<br>';
//}catch(MyException $e){
//    echo $e;
//    $e->customFunction();
//}catch(Exception $e){
//    echo '异常信息'.$e->getMessage().'<br>';
//}
//var_dump($obj);echo '<br>';

try{
    $obj = new TestException(1);
    echo '*****************<br>';
}catch(MyException $e){
    echo $e;
    $e->customFunction();
}catch(Exception $e){
    echo '异常信息'.$e->getMessage().'<br>';
}
var_dump($obj);

try{
    $obj = new TestException(2);
    echo '*****************<br>';
}catch(MyException $e){
    echo $e;
    $e->customFunction();
}catch(Exception $e){
    echo '异常信息'.$e->getMessage().'<br>';
}
var_dump($obj);