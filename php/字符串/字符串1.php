<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 15:45
 */
$str = 'abcdefg';
echo substr($str,2,4);echo '<br>';
echo $str{strlen($str)-1};echo '<br>';
$str{strlen($str)-1} = 'e';
echo $str;echo '<br>';