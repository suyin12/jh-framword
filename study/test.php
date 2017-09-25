<?php
/**
 *
 * User: suyin
 * Date: 2017/9/25 9:36
 *
 */
function getExten($str){
    return substr(strchr($str,'.'),1);
}
function getExten2($str){
    return substr($str,strrpos($str,'.')+1);
}
function getExten3($str){
    $arr = end(explode('.',$str));
    return $arr;
}
function getExten4($str){
    return pathinfo($str)['extension'];
}
function getExten5($str){
    return $exten = pathinfo($str,PATHINFO_EXTENSION);
}
$file = 'D:\wnmp\nginx\htdocs\111.doc';
//print_r(getExten5($file));

echo dirname($file);
$file2 = 'D:\wnmp\nginx\htdocs';echo "<br>";
echo dirname($file2);
$file2 = 'D:\wnmp\nginx';echo "<br>";
echo dirname($file2);
$file3 = 'D:\wnmp';echo "<br>";
echo dirname($file3);
$file4 = 'D:';echo "<br>";
echo dirname($file4);
