<?php
/*
*       2012-8-7
*       <<<   有关招聘的相关函数和统计相关数据 >>>
*       create by Great sToNe
*       have fun,.....
*/
class talent
{
    public $pdo;
    public $ret; //array 简历库基础信息
    public $categoryArr; //array  从结果中获取的分类信息
    public $marketOrderArr; //array 市场安排
    public $x; // object 链接各个类

    #简历的一些基础信息
    public function talentBasic($selStr = " * ", $conStr = " 1=1 ")
    {
        $pdo = $this->pdo;
        $sql = "select $selStr from a_talent where  $conStr ";
        $ret = SQL($pdo, $sql);
        $ret = keyArray($ret, "talentID");
        return $this->ret = $ret;
    }

    #获取简历结果中,包含的市场,招聘人员和岗位
    public function categoryBasic()
    {
        $ret = $this->ret;
        foreach ($ret as $val) {
            #获取各分类的基础信息
            // 1. 获取该时间段内的招聘人员
            $mIDArr [] = $val ['recruitManagerId'];
            //  2.获取该时间段内的招聘市场
            $marketIDArr [] = $val ['marketID'];
            //   3. 获取该段时间内招到的岗位名称.  以后这个会改变成项目责任包里面的岗位,因为有些是一个周期内都没有招到人的情况
            $positionIDArr [] = $val ['positionID'];
        }
        $mIDArr = array_unique($mIDArr);
        $marketIDArr = array_unique($marketIDArr);
        $positionIDArr = array_unique($positionIDArr);

        $arr = array(
            "mIDArr" => $mIDArr,
            "marketIDArr" => $marketIDArr,
            "positionIDArr" => $positionIDArr
        );

        return $this->categoryArr = $arr;
    }

    #加载连接各种设置类
    public function classLinkClass()
    {
        $x = new classLink ();
        $x->pdo = $this->pdo;
        return $this->x = $x;
    }

    #招聘人员的招聘场次统计 对应参数(市场的基本信息查询数组[$selStr,$conStr], 市场安排相关查询数组[$conStr])
    public function marketOrder()
    {
        $a = $this->x->a;
        $mID_marketNumArr = $a->mID_marketNum();
        $market_marketNumArr = $a->market_marketNum();
        $marketOrderArr = array(
            "mID_marketNumArr" => $mID_marketNumArr,
            "market_marketNumArr" => $market_marketNumArr
        );
        return $this->marketOrderArr = $marketOrderArr;
    }

    #人才信息编码转相应的名称
    public function talentInfoArr()
    {
        $ret = $this->ret;
        $talentIDArr = array_keys($ret);
        $talentIDStr = rtrim(implode(",", $talentIDArr), ",");
        $x = $this->x;
        //加载单位基本信息类
        $x->unitClass(array(
            "selStr" => " unitID,unitName "
        ));
        //加载市场基础信息类
        $x->marketClass(array(
            "selStr" => " marketID,name ",
            "conStr" => "1=1"
        ));
        //加载岗位基础信息类
        $x->positionClass(array(
            "selStr" => " positionID,name,unitId as unitID ",
            "conStr" => "1=1"
        ));
        //加载员工编码对照表类
        $x->wInfoSetClass();
        //加载系统用户基础信息类
        $x->userClass(array(
            "selStr" => " `mID`,`mName` ",
            "conStr" => " `roleID` REGEXP ',4_1,'"
        ));
        // 加载相关招聘设置信息类
        $x->recruitInfoSetClass();
        //加载应聘人员状态信息/通知及回访记录信息类
        $x->tInfoStatusClass();
        $x->f->ret = $ret;
        $x->f->recruitNotesArr();
        //
        //加载网上办公基础信息类
        $x->web_workerClass(array(
            "selStr" => " `wID`,`talentID`,`status` as webAccountStatus",
            "conStr" => " `talentID` in ($talentIDStr)"
        ));
        //加载网上办公信息配置类
        $x->web_wInfoSetClass();

        #
        $unitArr = $x->unitArr;
        $marketArr = $x->a->marketArr;
        $positionArr = $x->b->positionArr;
        $wInfoSetArr = $x->c->wInfoSet;
        $userArr = $x->d->userArr;
        $recruitInfoSetArr = $x->e->recruitInfoSetArr;
        $recruitNotesArr = $x->f->recruitNotesArr;
        $web_workerArr = keyArray($x->h->web_workerArr, "talentID");
        $web_wInfoSetBasicArr = $x->i->web_wInfoSetBasicArr;

        #
        foreach ($ret as $key => $val) {
            $ret [$key] ['unitName'] = $unitArr [$val ['unitID']] ['unitName'];
            $ret [$key] ['marketName'] = $marketArr [$val ['marketID']] ['name'];
            $ret [$key] ['positionName'] = $val ['positionID'] . "-" . $positionArr [$val ['positionID']] ['name'];
            $ret [$key] ['sexName'] = $wInfoSetArr ['sex'] [$val ['sex']];
            $ret [$key] ['educationName'] = $recruitInfoSetArr ['educationArr'] [$val ['education']];
            $ret [$key] ['mName'] = $userArr [$val ['recruitManagerId']] ['mName'];
            $ret [$key] ['statusName'] = $recruitInfoSetArr ['reexamineArr'] [$val ['status']] ['name'];
            $ret [$key] ['recruitNotes'] = $recruitNotesArr [$val ['talentID']];
            $ret [$key] ['createdByName'] = $userArr [$val ['createdBy']] ['mName'];
            $ret [$key] ['wID'] = $web_workerArr[$key]['wID'];
            $ret [$key] ['webAccountStatus'] = $web_workerArr[$key]['webAccountStatus'];
            $ret [$key] ['webAccountStatusName'] = $web_wInfoSetBasicArr['webAccountStatus'][$web_workerArr[$key]['webAccountStatus']];
        }
        return $this->ret = $ret;
    }

    #以招聘人员为分类依据,统计相关信息
    public function recruitManagerStatistics()
    {
        $ret = $this->ret;
        $mID_marketNumArr = $this->marketOrderArr ['mID_marketNumArr'];
        foreach ($ret as $val) {
            #获取各分类的基础信息
            // 1. 获取该时间段内的招聘人员
            $mIDArr [] = $val ['recruitManagerId'];
            $xxx [$val ['recruitManagerId']] ['name'] = $mID_marketNumArr [$val ['recruitManagerId']] ['mName'];
            $xxx [$val ['recruitManagerId']] ['cvNum'] += 1;
            $xxx [$val ['createdBy']] ['createdByNum'] += 1;
            $xxx [$val ['recruitManagerId']] ['mountGuardNum'] = "";
            $xxx [$val ['recruitManagerId']] ['rateSuccess'] = "";
            $xxx [$val ['recruitManagerId']] ['marketNum'] = $mID_marketNumArr [$val ['recruitManagerId']] ['marketNum'];
            $xxx [$val ['recruitManagerId']] ['phoneAccessNum'] = "";
            $xxx [$val ['recruitManagerId']] ['reexamineNum'] = "";
        }
        return $xxx;
    }

    #以招聘市场为分类依据,统计相关信息
    public function marketStatistics()
    {
        $ret = $this->ret;
        $a = $this->x->a;
        $betterPosition = $a->betterPosition($ret);
        $b = $this->x->b;
        $positionArr = $b->positionArr;
        $marketArr = $a->marketArr;
        $market_marketNumArr = $this->marketOrderArr ['market_marketNumArr'];
        $unitArr = $this->x->unitArr;
        foreach ($ret as $val) {
            //  2.获取该时间段内的招聘市场统计
            $xxx [$val ['marketID']] ['name'] = $marketArr [$val ['marketID']] ['name'];
            $xxx [$val ['marketID']] ['cvNum'] += 1;
            $xxx [$val ['marketID']] ['marketNum'] = $market_marketNumArr [$val ['marketID']] ['num'];
            $xxx [$val ['marketID']] ['mountGuardNum'] = "";
            $bestPosition = current($betterPosition [$val ['marketID']]);
            $bestPositionID = key($betterPosition [$val ['marketID']]);
            $xxx [$val ['marketID']] ['betterPosition'] = $bestPositionID . "-" . $positionArr [$bestPositionID] ['name'] . "[" . $unitArr [$positionArr [$bestPositionID] ['unitID']] ['unitName'] . "]" . "(" . $bestPosition . ")";
        }
        return $xxx;
    }

    #以岗位信息为分类依据,统计相关信息
    public function positionStatistics()
    {
        $ret = $this->ret;
        $a = $this->x->a;
        $marketArr = $a->marketArr;
        $b = $this->x->b;
        $positionArr = $b->positionArr;
        $betterMarket = $b->betterMarket($ret);
        $unitArr = $this->x->unitArr;
        foreach ($ret as $val) {
            // 3. 获取该段时间内的岗位统计
            $xxx [$val ['positionID']] ['name'] = $bestMarket . "-" . $positionArr [$val ['positionID']] ['name'] . "[" . $unitArr [$positionArr [$val ['positionID']] ['unitID']] ['unitName'] . "]";
            $xxx [$val ['positionID']] ['cvNum'] += 1;
            $xxx [$val ['positionID']] ['mountGuardNum'] = "";
            $bestMarket = current($betterMarket [$val ['positionID']]);
            $xxx [$val ['positionID']] ['betterMarket'] = $marketArr [key($betterMarket [$val ['positionID']])] ['name'];
        }
        return $xxx;
    }
}

?>