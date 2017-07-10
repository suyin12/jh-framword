<?php
/**
 *   <<<     临时数据操作类        >>>
 *
 * Created by Great sToNe.
 *
 * Date: 13-5-15
 * Time: 下午4:06
 * EMAIL: shi35dong@gmail.com
 *
 */
class tempAction
{
    public $pdo;
    public $tempArr;

    #析构函数,
    public function  __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }

    #加载连接各种设置类
    public function classLinkClass()
    {
        $x = new classLink ();
        $x->pdo = $this->pdo;
        return $this->x = $x;
    }

    #基础信息函数
    public function tempBasic($selStr = " * ", $conStr = null)
    {
        $pdo = $this->pdo;
        is_null($conStr) ? $conStr = "createdBy='" . $_SESSION ['exp_user'] ['mID'] . "' order by ID DESC" : $conStr;
        $sql = "select $selStr from `s_temp` where $conStr";
        $ret = SQL($pdo, $sql);
        return $this->tempArr = $ret;
    }

    #配置临时信息函数
    public function  tempExtraArr()
    {
        $pdo = $this->pdo;
        $tempArr = $this->tempArr;
        $uIDStr = $wIDStr = $tIDStr = null;
        foreach ($tempArr as $key => $val) {
            switch ($val['whichID']) {
                case "uID":
                    $uIDArr[] = $val['value'];
                    $uIDStr .= "'" . $val['value'] . "',";
                    break;
                case "wID":
                    $wIDArr[] = $val['value'];
                    $wIDStr .= "'" . $val['value'] . "',";
                    break;
                case "talentID":
                    $talentArr[] = $val['value'];
                    $tIDStr .= "'" . $val['value'] . "',";
                    break;
            }
        }
        #获取员工信息相关项目
        if ($uIDArr):
            $wInfo = new wInfo();
            $wInfo->pdo = $pdo;
            $uIDStr = rtrim($uIDStr, ",");
            $ret['uID'] = $wInfo->wInfoBasic("uID as whichID,name as nameTxt,telephone,status,station as positionName", " uID in($uIDStr)");
            foreach ($ret['uID'] as $key => $val) {
                $ret['uID'][$key]['whichID'] = 'uID';
                $ret['uID'][$key]['value'] = $val['uID'];
                $ret['uID'][$key]['link'] = "workerInfo/wManage.php?uID=" . $val['uID'];
            }
        endif;
        #获取网上办公信息相关项目
        if ($wIDArr):
            $web_wInfo = new web_worker();
            $web_wInfo->pdo = $pdo;
            $wIDStr = rtrim($wIDStr, ",");
            $ret['wID'] = $web_wInfo->web_workerBasic("wID as whichID,name as nameTxt", " wID in ($wIDStr)");
        endif;
        #获取人才库信息相关项目
        if ($talentArr):
            $tInfo = new talent();
            $tInfo->pdo = $pdo;
            $tIDStr = rtrim($tIDStr, ",");
            $tInfo->talentBasic("talentID,name as nameTxt,telephone,status,positionID", "talentID in ($tIDStr)");
            $tInfo->classLinkClass();
            $ret['talentID'] = $tInfo->talentInfoArr();
            foreach ($ret['talentID'] as $key => $val) {
                $ret['talentID'][$key]['whichID'] = "talentID";
                $ret['talentID'][$key]['value'] = $val['talentID'];
                $ret['talentID'][$key]['link'] = "recruitManage/tUpdate.php?tid=" . $val['talentID'];
            }
        endif;
        foreach ($tempArr as $key => $val) {
            $tempExtraArr[$val['whichID']][$val['ID']]=$ret[$val['whichID']][$val['value']];
        }
        return $tempExtraArr;
    }
}
