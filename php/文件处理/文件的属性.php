<?php
function getFilePro($fileName){
    if(!file_exists($fileName)){
        echo '目标文件不存在';
        return;
    }
    if(is_file($fileName)) echo $fileName.'是一个文件<br>';
    if(is_dir($fileName)) echo $fileName.'是一个目录<br>';

    echo '文件形态:'.getFileType($fileName).'<br>';
    echo '文件大小:'.getFileSize(filesize($fileName)).'<br>';

    if(is_readable($fileName)) echo '文件可读<br>';
    if(is_writeable($fileName)) echo '文件可写<br>';
    if(is_executable($fileName)) echo '文件可执行<br>';

    echo '文件新建时间:'.date('Y-m-d H:i:s',filectime($fileName)).'<br>';
    echo '文件最后更改时间:'.date('Y-m-d H:i:s',filemtime($fileName)).'<br>';
    echo '文件最后打开时间:'.date('Y-m-d H:i:s',fileatime($fileName)).'<br>';

}

function getFileType($fileName){
    switch(filetype($fileName)){
        case 'file':
            $type = '普通文件';break;
        case 'dir':
            $type = '目录文件';break;
        case 'block':
            $type = '块设备文件';break;
        case 'char':
            $type = '字符设备文件';break;
        case 'fifo':
            $type = '命名管道文件';break;
        case 'link':
            $type = '符号链接';break;
        case 'unknown':
            $type = '未知类型';break;
        default:
            $type = '没有检测到类型';break;
    }

    return $type;
}

function getFileSize($bytes){
    if($bytes >= pow(2,40)){
        $return = round($bytes/pow(1024,4),2);
        $suffix = 'TB';
    }elseif($bytes >= pow(2,30)){
        $return = round($bytes/pow(1024,3),2);
        $suffix = 'GB';
    }elseif($bytes >= pow(2,20)){
        $return = round($bytes/pow(1024,2),2);
        $suffix = 'MB';
    }elseif($bytes >= pow(2,10)){
        $return = round($bytes/pow(1024,1),2);
        $suffix = 'KB';
    }else{
        $return = $bytes;
        $suffix = 'byte';
    }

    return  $return.' '.$suffix;

}

$phpPath = '../php';
$fileName = '图形计算器';
$fileName = '文件的属性.php';
getFilePro($fileName);

$arrFile = stat($fileName);
echo '<pre>';
echo '获取文件大部分属性stat()';echo '<br>';
print_r(array_slice($arrFile,0));