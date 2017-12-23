<?php
function __autoload($className){
    include($className.'.class.php');
}
$db = new DB();
