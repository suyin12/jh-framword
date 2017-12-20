<?php
$arr = array("name"=>"粟建晖","sex"=>"男","age"=>"18","address"=>"广东深圳","student"=>"海南");

echo "当前元素:".key($arr)."=>".current($arr)."<br />";
echo next($arr)."<br />";
next($arr);
echo "第三个元素:".key($arr)."=>".current($arr)."<br />";
end($arr);
echo "最后一个元素:".key($arr)."=>".current($arr)."<br />";
echo reset($arr)."<br />";
echo "移动到首元素".key($arr)."=>".current($arr)."<br />";