<?php
$fileName = 'data.txt';
echo 'fopen(),fwrite(),fclose()';echo '<br>';
$handle = fopen(__DIR__.'/data.txt','w') or die('打开'.$fileName.'失败!');
$i = 0;
gt:
    fwrite($handle,'第'.$i."次写入\r\n");
    $i++;
    if($i == 10)
        goto end;

    goto gt;

end:
fwrite($handle,"写入最后一行\r\n");
fclose($handle);


echo 'file_put_contents()与fopen(),fwrite(),fclose()一样可以快速写入!';echo '<br>';
$j = 0;
$str = '';
gt2:
$str .= '第'.$j."次写入文件\r\n";
$j++;
if($j == 10)
    goto end2;

goto gt2;

end2:
$str .= '写入文件结束';
$fileName2 = 'data2.txt';
//一次将所有的数据写入文件
file_put_contents(__DIR__.'/'.$fileName2,$str);