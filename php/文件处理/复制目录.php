<?php
function copyDir($dirFrom,$dirTo){
    if(!is_dir($dirTo)&&!is_dir($dirFrom)){
        return false;
    }
    if(!file_exists($dirTo)){
        mkdir($dirTo,0755,true);
    }
    $d = dir($dirFrom);
    while($file = $d->read()){
        if($file != '.' && $file != '..'){
            $from = $dirFrom.'/'.$file;
            $to = $dirTo.'/'.$file;
            if(is_dir($from)){
                copyDir($from,$to);
            }
            if(is_file($from)){
                copy($from,$to);
            }
        }
    }
    $d->close();
}

$from = __DIR__;
$to = "D:\\A";
echo $from;
copyDir($from,$to);