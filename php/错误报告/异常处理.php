<?php
try{
    $error = 'throw a new exception';
    throw new Exception($error);
    echo 'never';
}catch(Exception $e){
    echo '异常信息'.$e->getMessage().'<br>';
}

echo 'hello world!';