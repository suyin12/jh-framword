<?php

/*
 * 2012-05-07   重置系统登记注册信息
 *      create by  Great sToNe
 *      shi35dong@gmail.com
 *       have fun, wa Ha Ha..
 */

#连接模板文件

$title = "重置系统登记注册信息";

$isOK = copy("../config_tmp.php", "../config.php");
if ($isOK):
    echo "<script>alert('系统登记注册信息重置成功!');location.href='initSetting.php';</script>";
else:
   exit("发生未知错误,请<a href='reset.php'>点击此处重置</a>,按规定重新填写");
endif;
?>
