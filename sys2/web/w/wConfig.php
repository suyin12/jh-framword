<?php

/*
*       2013-03-15
*       <<< 网站办公, 员工部分配置类   >>>
*       create by Great sToNe
*       have fun,.....
*
*       email:  shi35dong@gmail.com
*/

class wConfig
{
   public $s;
    #登陆 相关配置
    public function loginConfig()
    {
        return $arr = array(
            "table" => "web_worker_basic",
            "sessionName" => "web_worker",
            "index" => "../wIndex.php",
            "path_pre" => "w",
        );
    }


    #配置参数配置
    public function setting()
    {


    }

    #打印模板配置
    public function printStyleSet($unitIDArr)
    {

        //1.邮政系统相关的单位
        $u_POST = array("2202.002","2202.007","2202.010","2202.011","2202.012","2202.014","2202.016","2202.022","2202.027","2202.028","2202.029","2202.030","2202.044");
        //2.顺丰系统相关的单位
        $u_SF = array("2202.001", '2202.046',"2202.067","2202.048");
        foreach ($unitIDArr as $key => $val) {
            switch ($key) {
                case in_array($key, $u_POST):
                    $s = "wPrint_POST.tpl";
                    break;
                case in_array($key, $u_SF):
                    $s = "wPrint_SF.tpl";
                    break;
                default:
                    $s = "wPrint_XJC.tpl";
                    break;

            }
        }
        return $this->s= $s;
    }
}

?>