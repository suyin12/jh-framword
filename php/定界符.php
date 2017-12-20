<?php

//使用定界符定义大文本信息
//$var_str =<<<EOT
//  the first line."dfaf",sdfas往后在哪个\t
//  the second line.
//EOT;
//
//  echo $var_str;
//
//$str2 = "123.45abc";
//$str3 = true;
//
//var_dump(intval($str2));
//var_dump(floatval($str2));
//var_dump(strval(floatval($str2)));
//define("A",true);
//echo settype($str2,"integer");echo "<br />";
//var_dump($str2);echo "<br />";
//echo settype(A,"string");echo "<br />";
//var_dump($str3);echo "<br />";
//const PI = 3.14;

//echo PI;
//define("TE",1+1);
//const TE = 1+1;
//echo TE;
//for($j=1;$j<5;$j++){
//    echo "<br />";
//    for($i=1;$i<10;$i++){i
//        if($i%10===3)
//            continue 2;
//        echo $i."&nbsp;&nbsp;";
//    }
//}
//$i = 1;
//st:
//    echo "第{$i}次循环"."<br />";
//
//    if($i++ == 10)
//        goto end;
//
//    goto st;
//
//end:
//
//echo "语句结束";
switch($var){
    case 1:
        goto one;
        echo "one";
        break;
    case 2:
        goto two;
        echo "two";
        break;
    case 3:
        goto three;
        echo "three";
        break;
}
one:
    echo "goto跳到one";
two:
    echo "goto跳到two";
three:
    echo "goto跳到three";