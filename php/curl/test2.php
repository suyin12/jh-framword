<?php
$res = file_get_contents("https://www.taobao.com/");
file_put_contents('test.txt',$res);