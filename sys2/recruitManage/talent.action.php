<?php
/*
*       2013-2-22
*       <<<  关于人才的操作集合: 
*       例如: 
*       1. 开通/禁用账号
*       2. 信息审核
*       3. 
*         >>>
*       create by Great sToNe
*       have fun,.....
*       
*       EMAIL: shi35dong@gmail.com
*/

class talentAction
{
    public $pdo;
    public $talentIDArr; //array  人才数组

    #开通网上办公账号
    public function createWebUser()
    {
        $mID = $_SESSION ['exp_user'] ['mID'];
        $now = timeStyle("dateTime", "-");
        $pdo = $this->pdo;
        $talentIDArr = $this->talentIDArr;
        $talentIDStr = rtrim(implode(",", $talentIDArr), ",");
        $talentArr = $this->talentInfo("`talentID`,`idCard` as `pID`,`name`,`telephone`");
        $str = null;
        foreach ($talentArr as $key => $val) {
            $mCryptP = $this->pwMcrypt($val['telephone']);
            //对应的数据库列分别是(`talentID`,`mName`,`name`,`mPW`)
            $str .= "('" . $val['talentID'] . "','" . $val['pID'] . "','" . $val['name'] . "','" . $mCryptP . "','1','$mID','$now'),";
        }
        $str = rtrim($str, ",");
        //插入网上办公用户数据库 `web_worker_basic`
        $sql[] = "insert into `web_worker_basic`(`talentID`,`mName`,`name`,`mPW`,`status`,`lastModifyManager`,`lastModifyManagerTime`) values" . $str;
        $ret = extraTransaction($pdo, $sql);
        return true;
    }

    #更新网上办公账号相关($type表示要更新的类型)
    public function updateWebUser($type)
    {
        $mID = $_SESSION ['exp_user'] ['mID'];
        $now = timeStyle("dateTime", "-");
        $pdo = $this->pdo;
        $web_workerArr = $this->web_wokerInfo("`talentID`,`wID`");
        switch ($type) {
            case "active":
                //开通账号
                if ($web_workerArr) {
                    foreach ($web_workerArr as $key => $val) {
                        $sql[] = "update `web_worker_basic` set `status`='1',`lastModifyManager`='$mID',`lastModifyManagerTime`='$now' where `wID`='" . $key . "'";
                    }
                }
                else {
                    $this->createWebUser();
                }
                break;
            case "ban":
                //禁用账号
                if ($web_workerArr) {
                    foreach ($web_workerArr as $key => $val) {
                        $sql[] = "update `web_worker_basic` set `status`='0',`lastModifyManager`='$mID',`lastModifyManagerTime`='$now' where `wID`='" . $key . "'";
                    }
                }
                break;
            case "resetPW":
                //重置密码(默认重置为手机号码)
                if ($web_workerArr) {
                    $talentArr = $this->talentInfo("`talentID`,`telephone`");
                    foreach ($web_workerArr as $key => $val) {
                        $sql[] = "update `web_worker_basic` set `mPW`='" . pwMcrypt($talentArr[$val['talentID']]['telephone']) . "',`lastModifyManager`='$mID',`lastModifyManagerTime`='$now' where `wID`='" . $key . "'";
                    }
                }
                break;
            case "updateBasic":
                //更新员工信息的同时,更新身份证号码及姓名
                if ($web_workerArr) {
                    $talentArr = $this->talentInfo("`talentID`,`idCard` as `pID`,`name`");
                    foreach ($web_workerArr as $key => $val) {
                        $sql[] = "update `web_worker_basic` set `mName`='" . $talentArr[$val['talentID']]['pID'] . "',`name`='" . $talentArr[$val['talentID']]['name'] . "',`lastModifyManager`='$mID',`lastModifyManagerTime`='$now' where `wID`='" . $key . "'";
                    }
                }
                break;
        }
        if ($sql)
            $ret = extraTransaction($pdo, $sql);
        return $ret;
    }

    #人才库信息
    private function talentInfo($selStr = " * ")
    {
        require_once(sysPath . "dataFunction/talent.data.php");
        $talentIDArr = $this->talentIDArr;
        $talentIDStr = rtrim(implode(",", $talentIDArr), ",");
        $t = new talent();
        $t->pdo = $this->pdo;
        $t->talentBasic($selStr, " `talentID` in ($talentIDStr)");
        $talentInfoArr = $t->ret;
        return $talentInfoArr;
    }

    #网上办公信息库相关
    private function web_wokerInfo($selStr = "`wID`")
    {
        require_once sysPath . 'dataFunction/web_worker.data.php';
        $pdo = $this->pdo;
        $talentIDArr = $this->talentIDArr;
        $talentIDStr = rtrim(implode(",", $talentIDArr), ",");
        $web_worker = new web_worker();
        $web_worker->pdo = $pdo;
        $web_worker->web_workerBasic($selStr, " `talentID` in ($talentIDStr)");
        $web_workerArr = $web_worker->web_workerArr;
        return $web_workerArr;
    }

    #密码处理函数
    private function pwMcrypt($v)
    {
        require_once sysPath . 'class/mCrypt.class.php';
        $m = new mCrypt();
        $mCryptVal = $m->encrypt($v);
        return $mCryptVal;
    }


}

?>