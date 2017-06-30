<?php
/**
 *
 * User: suyin
 * Date: 2017/6/30 14:51
 *
 */
namespace jh;

class BaseJh{
   /**
    * 创建URL
    */
    public static function createUrl($info = ''){
        $url_info = explode("/",strtolower($info));
        $controller = isset($url_info[1])?$url_info[0]:strtolower(CONTROLLER);
        $action = isset($url_info[1])?$url_info[1]:$url_info[0];

        switch(URL_MODE){
            case URL_COMMON:
                return "/index.php?r=".$controller."/".$action;
            case URL_REWRITE:
                return "/".$controller."/".$action;
        }
    }
}
