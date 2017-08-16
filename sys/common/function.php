<?php
/**
 *
 * User: suyin
 * Date: 2017/6/30 14:39
 *
 */
if(!function_exists("compile_conf")){
    function compileConf($conf){
        foreach($conf as $k => $v){
            if(is_array($v)){
                compileConf($v);
            }else{
                define($k,$v);
            }
        }
    }
}
