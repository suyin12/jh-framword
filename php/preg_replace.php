<?php
$pattern = '/<[\/\!]*?[^<>]*?>/is';

$text = "这个文本有<b>粗体</b>和带有<u>下划线</u>以及<i>斜体</i>
        还有<font color='red' size='7'>带有颜色和字体大小</font>的标记";

echo preg_replace($pattern,'',$text);echo '<br><br><br>';
echo preg_replace($pattern,'',$text,2);echo '<br><br><br>';


