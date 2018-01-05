<?php
function errorHandle($errorLevel,$errorMess,$file,$line){
    $EXIT = false;
    switch($errorLevel){
        //提醒,注意
        case E_USER_NOTICE:
        case E_NOTICE:
            $errorType = 'notice';break;
        //警告
        case E_WARNING:
        case E_USER_WARNING:
            $errorType = 'warning';
            $EXIT = true;break;
        //错误
        case E_ERROR:
        case E_USER_ERROR:
            $errorType = 'error';
            $EXIT = true;break;
        //其他未知
        default:
            $errorType = 'unknown';

    }
    //直接打印错误信息，也可以写文件，写数据库，反正错误信息都在这，任你发落
    printf("<font color='#FF0000' size='7'><b>%s</b></font>:%s in<b>%s</b> on line <b>%d</b><br><br>\n",$errorType, $errorMess, $file, $line);

    if($EXIT == true){
        echo "<scritp>location = 'err.html'</scritp>";
    }
}

set_error_handler('errorHandle');

echo $var;

echo 3/0;

trigger_error('a error',E_USER_NOTICE);