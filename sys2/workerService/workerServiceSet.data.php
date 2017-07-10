<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/25
 * Time: 9:29
 */


class workerServiceSet 
{
    public $p; //$pdo   对象
    public $workerServiceSetArr; //这个数组是配合common.function.php中的reCreatArray两个结合使用

    function __construct()
    {
        $this->p = $GLOBALS['pdo'];
    }

    function workerServiceSetArr($field = "all")
    {

        $workerServiceSetArr = array(
            "wx_encrypt_key" => $GLOBALS['wx_encrypt_key'],
            "wx_templateID" => array(
                "orderCreate" => array("txt" => "订单生成通知", "ID" => "1dDOEWdLvKbxmVRBKhLr7Iq1kfxpuOn-M3R6OUDfaR8"),
                "paid" => array("txt" => "支付成功通知", "ID" => "nWd2wt8tg_vRz8Zzl7Qh21EimDPUY35usT8SEa_uQCQ"),
                "noPay" => array("txt" => "下单成功未支付通知", "ID" => "UZEGkSmyDfBpVThF_22z4cIZP2UiV7ZLIOaNb0wZXNA"),
                "proveMsg"=>array("txt" => "证明办理结果通知", "ID" => "L5RZ0Kaika_Qmhu-VerDpLmTbXi8V68R1_fHU81kL6c")
            ),
        );
        switch ($field) {
            case "all":
                break;
            case "basic":
                $workerServiceSetArr = $workerServiceSetArr;
                break;
            default:
                $workerServiceSetArr = $workerServiceSetArr[$field];
                break;
        }
        return $workerServiceSetArr;

    }
}