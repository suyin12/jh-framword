<?php
/**
 *
 * User: suyin
 * Date: 2017/7/4 14:58
 *
 */


if ($_FILES["file"]["error"] > 0)
{
    echo "Error".$_FILES["file"]["error"];
}
else
{
    echo "fileName".$_FILES["file"]["name"]."<br/>";
    echo "fileSize".$_FILES["file"]["size"]."<br/>";
    echo "fileType".$_FILES["file"]["type"]."<br/>";
    echo "fileSize".$_FILES["file"]["tmp_name"]."<br/>";
    $file = "Uploads/".date("Y-m-d",time());
    if(!file_exists($file)){
        mkdir($file,0777,true);
    }
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$file."/".$_FILES["file"]["name"])){
        echo "文件上传成功啦".$_FILES["file"]["name"];
    }else{
        echo "噢,上传失败啦";
    }
}
?>