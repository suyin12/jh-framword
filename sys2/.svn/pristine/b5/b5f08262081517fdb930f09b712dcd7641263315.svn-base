<?php
/**
 *   <<<     网上办公员工相关信息类        >>>
 *
 * Created by Great sToNe.
 *
 * Date: 13-2-28
 * Time: 下午3:16
 * EMAIL: shi35dong@gmail.com
 *
 */
class web_worker
{
    public $pdo;
    public $x; //object 各个连接类
    public $web_workerArr; //网上办公基本信息数组
    public $web_wInfo_extraArr; //详细信息
    public $web_wInfo_relativeArr;//家庭信息
    public $web_wInfo_workInfoArr;//个人工作经验
    public $web_wInfo_studyInfoArr;//个人学习经历
    public $web_wInfo_interiorInfoArr;//内部推荐信息
    public $web_wInfo_trainInfoArr;//培训信息
    public $web_wInfo_diplomaInfoArr;//证书信息
    public $web_wInfo_languageInfoArr;//语种信息

    #加载连接各种设置类
    public function classLinkClass()
    {
        $x = new classLink ();
        $x->pdo = $this->pdo;
        return $this->x = $x;
    }

    #网上办公账号相关的基本信息
    public function web_workerBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = " select $selStr from `web_worker_basic` where $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "wID");
        return $this->web_workerArr = $ret;
    }

    #获取详细信息(web_wInfo_extra)
    public function web_wInfo_extraArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        $wIDStr = rtrim(implode(",", array_keys($web_workerArr)), ",");
        $sql = " select $selStr from `web_wInfo_extra` where `wID` in ($wIDStr) ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "wID");
        return $this->web_wInfo_extraArr = $ret;
    }

    #获取家庭信息(web_wInfo_extra_relative)
    public function web_wInfo_relativeArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        foreach ($web_workerArr as $key => $val) {
            $sql = " select $selStr from `web_wInfo_extra_relative` where `wID`='" . $key . "'";
            $ret[$key] = SQL($pdo, $sql);
            $ret[$key] = keyArray($ret[$key],"ID");
        }
        return $this->web_wInfo_relativeArr = $ret;
    }

    #获取个人经历信息(web_winfo_extra_wordInfo)
    public function web_wInfo_workInfoArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        foreach ($web_workerArr as $key => $val) {
            $sql = " select $selStr from `web_winfo_extra_workinfo` where `wID`='" . $key . "' ";
            $ret[$key] = SQL($pdo, $sql);
            $ret[$key] = keyArray($ret[$key],"ID");
        }
        return $this->web_wInfo_workInfoArr = $ret;
    }

    #获取学习经历信息(web_winfo_extra_study)
    public function web_wInfo_studyInfoArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        foreach ($web_workerArr as $key => $val) {
            $sql = " select $selStr from `web_winfo_extra_study` where `wID`='" . $key . "' ";
            $ret[$key] = SQL($pdo, $sql);
            $ret[$key] = keyArray($ret[$key],"ID");
        }
        return $this->web_wInfo_studyInfoArr = $ret;
    }

    #获取入职方式--内部推荐的信息(web_winfo_extra_interior)
    public function web_wInfo_interiorInfoArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        $wIDStr = rtrim(implode(",", array_keys($web_workerArr)), ",");
        $sql = " select $selStr from `web_winfo_extra_interior` where `wID` in ($wIDStr) ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "wID");
        return $this->web_wInfo_interiorInfoArr = $ret;

    }

    #获取职业培训经历信息(web_winfo_extra_train)
    public function web_wInfo_trainInfoArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        foreach ($web_workerArr as $key => $val) {
            $sql = " select $selStr from `web_winfo_extra_train` where `wID`='" . $key . "' ";
            $ret[$key] = SQL($pdo, $sql);
            $ret[$key] = keyArray($ret[$key],"ID");
        }
        return $this->web_wInfo_trainInfoArr = $ret;
    }

    #获取证书情况信息(web_winfo_extra_diploma)
    public function web_wInfo_diplomaInfoArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        foreach ($web_workerArr as $key => $val) {
            $sql = " select $selStr from `web_winfo_extra_diploma` where `wID`='" . $key . "' ";
            $ret[$key] = SQL($pdo, $sql);
            $ret[$key] = keyArray($ret[$key],"ID");
        }
        return $this->web_wInfo_diplomaInfoArr = $ret;
    }

    #获取语种信息(web_winfo_extra_language)
    public function web_wInfo_languageInfoArr($selStr = "*")
    {
        $pdo = $this->pdo;
        $web_workerArr = $this->web_workerArr;
        foreach ($web_workerArr as $key => $val) {
            $sql = " select $selStr from `web_winfo_extra_language` where `wID`='" . $key . "' ";
            $ret[$key] = SQL($pdo, $sql);
            $ret[$key] = keyArray($ret[$key],"ID");
        }
        return $this->web_wInfo_languageInfoArr = $ret;
    }

    #详细信息,未包含额外信息的数组(简化版)
    public function  web_workerInfoArr()
    {
        $web_workerArr = $this->web_workerArr;
        $x = $this->x;
        //加载信息配置类
        $x->web_wInfoSetClass();
        $web_wInfoSetBasicArr = $x->i->web_wInfoSetBasicArr;
        //重置数组
        foreach ($web_workerArr as $key => $val) {
            $web_workerArr[$key]['webAccountStatus'] = $web_wInfoSetBasicArr['webAccountStatus'][$val['status']];
        }
        return $this->web_workerArr = $web_workerArr;
    }

    #基本信息,包含额外信息的数组(完全版)
    public function  web_wInfo_extraInfoArr()
    {
        $web_workerArr = $this->web_workerArr;
        $web_wInfo_extraArr = $this->web_wInfo_extraArr;
        $web_wInfo_relativeArr = $this->web_wInfo_relativeArr;
        $web_wInfo_workInfoArr = $this->web_wInfo_workInfoArr;
        $web_wInfo_studyInfoArr = $this->web_wInfo_studyInfoArr;
        $web_wInfo_interiorInfoArr = $this->web_wInfo_interiorInfoArr;
        $web_wInfo_trainInfoArr = $this->web_wInfo_trainInfoArr;
        $web_wInfo_diplomaInfoArr = $this->web_wInfo_diplomaInfoArr;
        $web_wInfo_languageInfoArr = $this->web_wInfo_languageInfoArr;

        $x = $this->x;
        //加载信息配置类
        $x->web_wInfoSetClass();
        $web_wInfoSetBasicArr = $x->i->web_wInfoSetBasicArr;
        //加载员工信息配置类
        $x->wInfoSetClass();
        $wInfoSetArr = $x->c->wInfoSet;

        //重置数组
        foreach ($web_workerArr as $key => $val) {
            $web_workerArr[$key]['webAccountStatus'] = $web_wInfoSetBasicArr['webAccountStatus'][$val['status']];
            $web_wInfo_extra_this = $web_wInfo_extraArr[$key];
            $web_wInfo_relative_this = $web_wInfo_relativeArr[$key];
            $web_wInfo_workInfo_this = $web_wInfo_workInfoArr[$key];
            $web_wInfo_studyInfo_this = $web_wInfo_studyInfoArr[$key];
            $web_wInfo_interiorInfo_this = $web_wInfo_interiorInfoArr[$key];
            $web_wInfo_trainInfoArr_this = $web_wInfo_trainInfoArr[$key];
            $web_wInfo_diplomaInfoArr_this = $web_wInfo_diplomaInfoArr[$key];
            $web_wInfo_languageInfoArr_this = $web_wInfo_languageInfoArr[$key];

            foreach ($web_wInfo_extra_this as $extraK => $extraV) {
                $web_workerArr[$key][$extraK] = $extraV;
                $web_workerArr[$key]["sexName"] = $wInfoSetArr["sex"][$web_wInfo_extra_this["sex"]];
                $web_workerArr[$key]["marriageName"] = $wInfoSetArr["marriage"][$web_wInfo_extra_this["marriage"]];
                $web_workerArr[$key]["roleName"] = $wInfoSetArr["role"][$web_wInfo_extra_this["role"]];
                $web_workerArr[$key]["educationName"] = $wInfoSetArr["education"][$web_wInfo_extra_this["education"]];
                $web_workerArr[$key]["nationName"] = $wInfoSetArr["nation"][$web_wInfo_extra_this["nation"]];
                $web_workerArr[$key]["healthName"] = $wInfoSetArr["health"][$web_wInfo_extra_this["health"]];
                $web_workerArr[$key]["bloodName"] = $wInfoSetArr["blood"][$web_wInfo_extra_this["blood"]];
               $web_workerArr[$key]["proLevelName"] = $wInfoSetArr["proLevel"][$web_wInfo_extra_this["proLevel"]];
                $web_workerArr[$key]["nativeTypeName"] = $wInfoSetArr["nativeType"][$web_wInfo_extra_this["nativeType"]];
            }
            foreach ($web_wInfo_relative_this as $relativeK => $relativeV) {
                $web_workerArr[$key]["relative"][$relativeK] = $relativeV;
                $web_workerArr[$key]["relative"][$relativeK]["rsex"] = $wInfoSetArr["sex"][$web_wInfo_relative_this[$relativeK]["sex"]];
            }
            foreach ($web_wInfo_workInfo_this as $workInfoK => $workInfoV) {
                $web_workerArr[$key]["workInfo"][$workInfoK] = $workInfoV;
                $web_workerArr[$key]["workInfo"][$workInfoK]["oversSeasName"] = $wInfoSetArr["oversSeas"][$web_wInfo_workInfo_this[$workInfoK]["overSeas"]];

            }
            foreach ($web_wInfo_studyInfo_this as $studyInfoK => $studyInfoV) {
                $web_workerArr[$key]["studyInfo"][$studyInfoK] = $studyInfoV;
                $web_workerArr[$key]["studyInfo"][$studyInfoK]["oversSeasName"] = $wInfoSetArr["oversSeas"][$web_wInfo_studyInfo_this[$studyInfoK]["overSeas"]];
            }
            foreach ($web_wInfo_interiorInfo_this as $interiorInfoK => $interiorInfoV) {
                $web_workerArr[$key][$interiorInfoK] = $interiorInfoV;
                $web_workerArr[$key]["SexName"] = $wInfoSetArr["sex"][$web_wInfo_interiorInfo_this["iSex"]];
            }
            foreach ($web_wInfo_trainInfoArr_this as $trainInfoK => $trainInfoV) {
                $web_workerArr[$key]["trainInfo"][$trainInfoK] = $trainInfoV;
            }
            foreach ($web_wInfo_diplomaInfoArr_this as $diplomaInfoK => $diplomaInfoV) {
                $web_workerArr[$key]["diploma"][$diplomaInfoK] = $diplomaInfoV;
            }
            foreach ($web_wInfo_languageInfoArr_this as $languageInfoK => $languageInfoV) {
                $web_workerArr[$key]["language"][$languageInfoK] = $languageInfoV;
               $web_workerArr[$key]["language"][$languageInfoK]["NspeakLevel"] = $wInfoSetArr["level"][$web_wInfo_languageInfoArr_this[$languageInfoK]["speakLevel"]];
                $web_workerArr[$key]["language"][$languageInfoK]["NreadLevel"] = $wInfoSetArr["level"][$web_wInfo_languageInfoArr_this[$languageInfoK]["readLevel"]];
                $web_workerArr[$key]["language"][$languageInfoK]["NwriteLevel"] = $wInfoSetArr["level"][$web_wInfo_languageInfoArr_this[$languageInfoK]["writeLevel"]];
            }
        }
        return $this->web_workerArr = $web_workerArr;
    }

}