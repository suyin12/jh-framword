<?php
$fileName = 'test1.html';

header('Content-Type:text/html');
header('Content-Disposition:attachment;filename="fileupload.class.php"');
//header('Content-Length:3390');

@readfile($fileName);