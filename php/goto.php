<?php

$i = 0;
gt:

echo '第'.$i.'次循环<br>';
if($i == 5){
    goto end;
}

$i++;
goto gt;

end:
echo '循环语句结束';