<?php
/**
 * Auth: sjh
 * Date: 2018/3/13 13:47
 */
session_start();
if(isset($_COOKIE[session_name()])){
    var_dump($_COOKIE[session_name()]);
}
var_dump($_SESSION);