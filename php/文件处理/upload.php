<?php
require 'fileupload.class.php';

$up = new FileUpload();

//$up->set('path','./newFile/')
//    ->set('maxsize',1000000)
//    ->set('allowType',array('jpg','png','gif'))
//    ->set('isRandName',true);

if($up->upload('myfile')){
    print_r($up->getFileName());
}else{
    print_r($up->getErrorMsg());
}