<?php
/**
 * Auth: sjh
 * Date: 2018/3/14 10:06
 */

function more_args(){
    $params = func_get_args();
    for($i=0; $i<count($params); $i++){
        echo '第'.$i.'个参数为'.func_get_arg($i);echo '<br>';
    }
}
more_args('one','two','three','1','2','3');