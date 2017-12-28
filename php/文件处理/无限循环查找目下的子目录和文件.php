<?php
function getDir($dir){
    if(is_dir($dir)){
        $dp = opendir($dir);//打开目录句柄
    }
    $ret = [];
    while(($file = readdir($dp)) !== false){
        if($file != '.'&& $file != '..'){
            if(is_dir($dir.'/'.$file)){
                $ret[$file] = getDir($dir.'/'.$file);
            }else{
                $ret[] = $file;
            }

        }

    }
    rewinddir($dp);//将目录指针重置目录到开始处,返回目录的开头.
    closedir($dp);
    return $ret;
}

//var_dump(is_dir($dir));exit;
//$ret = getDir($dir);
//echo '<pre>';
//print_r($ret);

//echo 'getcwd()返回的是当前工作目录';echo '<br>';
//echo getcwd();


function getDir2($dir){
    if(is_dir($dir)){
        $d = dir($dir);
    }
    while(($file = $d->read()) != false){
        if($file != '.'&& $file != '..'){
            if(is_dir($dir.'/'.$file)){
                $ret[$file] = getDir2($dir.'/'.$file);
            }else{
                $ret[] = $file;
            }

        }
    }
    return $ret;
}
$dir = __DIR__;
//$dir2 = getcwd();
$res = getDir2($dir);
echo '<pre>';
print_r($res);

//$res = glob('*.*');
//echo '<pre>';
//print_r($res);