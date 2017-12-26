<?php
$arr = array('1');
list($one,$two) = $arr;
$arrNew = each($arr);
print_r($arrNew);