<?php
/**
 *
 * User: suyin
 * Date: 2017/11/4 14:00
 *
 */
$fileName = $_FILES['myfile']['name'];
$fileType = $_FILES['myfile']['type'];
$fileTmpName = $_FILES['myfile']['tmp_name'];
$fileError =$_FILES['myfile']['error'];
$fileError =$_FILES['myfile']['error'];
$fileSize = $_FILES['myfile']['size'];

$uploadDir = 'upload';

if(!is_dir($uploadDir)){
    mkdir($uploadDir,0777);
}
$logFile = fopen($uploadDir."log.txt",'w');
fwrite($logFile,date('Ymd H:i:s').$fileName.$fileSize);
copy($fileTmpName,$fileName.time());

switch($fileSize){
    case 1:
        echo "超过了上传文件的最大值,最大值为2M";
        break;
    case 2:
        echo "上传文件过多,请一次性上传20个及以下文件";
        break;
    case 3:
        echo "文件上传并未完成,请再次尝试!";
        break;
    case 4:
        echo "未选择上传文件!";
        break;
    case 5:
        echo "上传文件为0";
        break;
}

