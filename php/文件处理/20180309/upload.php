<?php
/**
 * Auth: sjh
 * Date: 2018/3/12 15:30
 */
if(isset($_FILES)){
    if(!is_uploaded_file($_FILES['myFile']['tmp_name'])){
        die('非http post上传!');
    }
}else{
    die('error');
}

$allowType = ['jpg','png','gif'];
$max = 1000000;
$status = $_FILES['myFile']['error'];
$name = explode('.',$_FILES['myFile']['name']);
$type = end($name);
//var_dump($uploadFile);exit;
if(!in_array($type,$allowType)){
    die('不允许的上传类型');
}
if(!in_array($type,$allowType)){
    die('上传文件大小超过了允许的大小!!');
}
if($status > 0){
    switch($status){
        case 1:
            echo '上传文件超过upload_max_size设置的值!';
            break;
        case 2:
            echo '上传文件超出了http表单中MAX_UPLOAD_SIZE指定的值!';
            break;
        case 3:
            echo '文件上传不完整,只有部分被上传!';
            break;
        case 4:
            echo '没有任何文件上传';
            break;
        default:
            echo 'unknown error!!';
            break;
    }
}

$dir = __DIR__.'/'.'Uploads';

if(!file_exists($dir)){
    mkdir($dir,0777,true);
}

$filename = $dir.'/'.date("YmdHis").rand(100,99).'.'.$type;

if(!move_uploaded_file($_FILES['myFile']['tmp_name'],$filename)){
    die('上传失败,不能将文件移动到指定目录!');
}


echo '文件'.$_FILES['myFile']['name'].'上传到'.$dir.'成功';
