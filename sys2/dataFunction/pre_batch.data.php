<?php
/**
 * Created by JetBrains PhpStorm.
 * User: admin
 * Date: 13-6-7
 * Time: 上午10:27
 * To change this template use File | Settings | File Templates.
 */
class batch{
    public $pdo;
    public $x; //object 各个连接类
    public $batchBasicArr;
    public $web_batch_defineArr;
    public $web_a_unitInfo_extraArr;

    #加载连接各种设置类
    public function classLinkClass()
    {
        $x = new classLink ();
        $x->pdo = $this->pdo;
        return $this->x = $x;
    }

    #基础信息
    public function batchBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = "select $selStr from b_pre_batch_detail where  $conStr ";
        $ret = SQL($pdo, $sql);
        return $this->batchBasicArr = $ret;
    }

     #获取各种岗前批次
   public function web_batch_define($selStr = "*")
    {
        $pdo = $this->pdo;
        $batchBasicArr = $this->batchBasicArr;
        foreach($batchBasicArr as $key=>$val){
            $batchIDArr[] =$val['batchID'];
        }
        $batchIDArr = array_unique($batchIDArr);
        $batchIDStr =rtrim(implode(",",$batchIDArr),",");
        $sql = " select $selStr from `b_pre_batch_define` where `ID` in ($batchIDStr)  ";
        $ret= SQL($pdo, $sql);
        $ret = keyArray($ret,"ID");
        return $this->web_batch_defineArr = $ret;
    }
   #获取用工单位联系信息
    public function web_a_unitInfo_extra($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_batch_defineArr = $this->web_batch_defineArr;
        foreach ($web_batch_defineArr as $key => $val) {
            $noticeIDArr[] = $val['noticeID'];
        }
        $noticeIDArr = array_unique($noticeIDArr);
        $noticeIDStr = rtrim(implode(",", $noticeIDArr), ",");
        $sql = " select $selStr from `a_unitInfo_extra` where `noticeID` in ($noticeIDStr) ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "noticeID");
        return $this->web_a_unitInfo_extraArr = $ret;
    }

    public function  web_batchInfoArr()
    {
        $batchBasicArr = $this->batchBasicArr;
        $web_batch_defineArr = array_values($this->web_batch_defineArr);
        $web_a_unitInfo_extraArr = array_values($this->web_a_unitInfo_extraArr);

      $x = $this->x;
        //加载信息配置类
       $x->recruitInfoSetClass();
      $recruitInfoSetArr = $x->e->recruitInfoSetArr;
        foreach ($batchBasicArr as $key => $val) {
            $web_batch_defineArr = $web_batch_defineArr[$key];
            $web_a_unitInfo_extraArr = $web_a_unitInfo_extraArr[$key];
        }
        foreach ($web_batch_defineArr as $defineK => $defineV) {
            $batchBasicArr[$key][$defineK] = $defineV;
        }
        foreach ($web_a_unitInfo_extraArr as $a_unitInfoK => $a_unitInfoV) {
            $batchBasicArr[$key][$a_unitInfoK] = $a_unitInfoV;
            $batchBasicArr[$key]['conditionName']=$recruitInfoSetArr['reexamineArr'][$web_a_unitInfo_extraArr['condition']];
        }
        return $this->batchBasicArr = $batchBasicArr;
    }
}