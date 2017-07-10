<?php
/*
*       2012-8-14
*       <<< 招聘模块的配置信息设置   >>>
*       create by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/
class recruitInfoSet
{
    public $pdo;
    public $talentArr; // array  传入相关的人才库信息
    public $recruitInfoSetArr; // array  返回设置数组
    public $recruitProcedurerArr; // array 各个岗位复试/培训/资料/待岗流程
    public $recruitProcedurerDetailArr; // array 各个岗位需要的复试/培训/资料/待岗项目


    #这里设置初始的类型信息,如复试类型,培训类型(按员工从招聘到入职的流程,设置状态信息,每一步都是连贯的)
    public function recruitInfoSetBasic()
    {
        $pdo = $this->pdo;
        // 复试类型设置,按照先后顺序,完成从招聘到入职的流程,复试时间安排从数据库里面设置
        $reexamineArr = array(
            "0" => array(
                "ID" => "0",
                "name" => "信息库"
            ),
            "1" => array(
                "ID" => "1",
                "name" => "不合格"
            ),
            "2" => array(
                "ID" => "2",
                "name" => "储备"
            ),
            "3" => array(
                "ID" => "3",
                "name" => "合格"
            ),
            "4" => array(
                "ID" => "4",
                "name" => "本部初试"
            ),
            "5" => array(
                "ID" => "5",
                "name" => "用工单位复试"
            ),
            "6" => array(
                "ID" => "6",
                "name" => "等待驾考"
            ),
            "7" => array(
                "ID" => "7",
                "name" => "等待培训"
            ),
            "8" => array(
                "ID" => "8",
                "name" => "资料核实"
            ),
            "9" => array(
                "ID" => "9",
                "name" => "试岗"
            ),
            "97" => array(
                "ID" => "97",
                "name" => "待岗"
            ),
            "98" => array(
                "ID" => "98",
                "name" => "派遣核实"
            ),
            "99" => array(
                "ID" => "99",
                "name" => "合同签订"
            ),
            "100" => array(
                "ID" => "100",
                "name" => "上岗"
            )
        );
        //当前复试状态的通过情况
        $procedurerStatusArr = array(
            "0" => "NO",
            "1" => "YES",
            "2" => "等待"
        );
        //待岗类型设置   (这里面的ID不设置为 1,2而设置成98,99 的原因是,b_recruit_marks 表中的trainClassicID 要区别于下面的资料提交情况区别)
        $waitArr = array(
            "98" => array(
                "ID" => "98",
                "name" => "见证明人"
            ),
            "99" => array(
                "ID" => "99",
                "name" => "资料提交"
            )
        );
        //需提交的材料类型
        $materialArr = array(
            "16" => array(
                "ID" => "16",
                "name" => "情况表"
            ),
            "1" => array(
                "ID" => "1",
                "name" => "户口本"
            ),
            "2" => array(
                "ID" => "2",
                "name" => "身份证"
            ),
            "3" => array(
                "ID" => "3",
                "name" => "体检表或健康证"
            ),
            "4" => array(
                "ID" => "4",
                "name" => "毕业证"
            ),
            "5" => array(
                "ID" => "5",
                "name" => "学历证明"
            ),
            "6" => array(
                "ID" => "6",
                "name" => "婚育证明"
            ),

            "7" => array(
                "ID" => "7",
                "name" => "驾驶证"
            ),
            "8" => array(
                "ID" => "8",
                "name" => "相片"
            ),
            "9" => array(
                "ID" => "9",
                "name" => "离职声明"
            ),
            "10" => array(
                "ID" => "10",
                "name" => "指纹采集"
            ),
            "11" => array(
                "ID" => "11",
                "name" => "居住证"
            ),
            "12" => array(
                "ID" => "12",
                "name" => "行驶证"
            ),
            "13" => array(
                "ID" => "13",
                "name" => "保险单"
            ),
            "14" => array(
                "ID" => "14",
                "name" => "确认函"
            ),
            "15" => array(
                "ID" => "15",
                "name" => "从业资格证"
            ),
            "17" => array(
                "ID" => "17",
                "name" => "离职证明"
            )
        );
        // 培训类型设置,从数据库里面设置,包括培训时间安排
        $sql = "select * from `s_train_classic`";
        $ret = SQL($pdo, $sql);
        $trainArr = keyArray($ret, "ID");
        //意向区域设置
        $wantedAreaArr = array(
            "龙岗",
            "罗湖",
            "福田",
            "南山",
            "宝安"
        );
        // 备注类型
        $recruitRemarksArr = array(
            //不通过的情况备注,NO
            "0" => array(
                "放弃岗位",
                "已工作",
                "面试未通过"
            ),
            //通过的情况备注,YES
            "1" => array(
                "内荐",
                "通过",
                "已通过驾考",
                "已通过培训"
            ),
            //等待的情况备注, 等待
            "2" => array(
                "关机",
                "电话未接通",
                "要深户担保",
                "面试完等通知"
            )
        );
        //学历
        $educationArr = array(
            "1" => "博士",
            "2" => "硕士",
            "3" => "本科",
            "4" => "大专",
            "5" => "高中",
            "6" => "中专",
            "7" => "初中",
            "8" => "小学",
        );

        return $this->recruitInfoSetArr = array(
            "reexamineArr" => $reexamineArr,
            "procedurerStatusArr" => $procedurerStatusArr,
            "waitArr" => $waitArr,
            "materialArr" => $materialArr,
            "trainArr" => $trainArr,
            "recruitRemarksArr" => $recruitRemarksArr,
            "wantedAreaArr" => $wantedAreaArr,
            "educationArr" => $educationArr
        );
    }

    #所有的岗位流程设置
    public function recruitProcedurerArr($recruitProcedurerBasic = array("selStr" => "*", "conStr" => " `status`='1' "), $type = null)
    {
        $pdo = $this->pdo;
        $sql = "select " . $recruitProcedurerBasic ['selStr'] . "  from `b_recruit_procedurer` where  " . $recruitProcedurerBasic ['conStr'];
        if ($type) {
            $sql .= " and `type`='$type'";
            $ret = SQL($pdo, $sql);
            $arr = keyArray($ret, "ID");
        }
        else {
            $ret = SQL($pdo, $sql);
            foreach ($ret as $val) {
                $arr [$val ['type']] [$val ['ID']] = $val;
            }
        }
        return $this->recruitProcedurerArr = $arr;
    }

    #所有岗位流程包括的各个细节项目
    public function recruitProcedurerDetailArr($type = "2")
    {
        $recruitProcedurerArr = $this->recruitProcedurerArr;
        $recruitInfoSetArr = $this->recruitInfoSetArr;
        switch ($type) {
            //复试
            case "1" :
                $t = $recruitInfoSetArr ['reexamineArr'];
                break;
            //培训
            case "2" :
                $t = $recruitInfoSetArr ['trainArr'];
                break;
            //待岗
            case "3" :
                $t = $recruitInfoSetArr ['waitArr'];
                break;
            //交资料
            case "4" :
                $t = $recruitInfoSetArr ['materialArr'];
                break;
        }
        foreach ($recruitProcedurerArr as $key => $val) {
            $nTArr [$key] = array_filter(explode(",", $val ['procedurer']));
        }
        foreach ($nTArr as $nKey => $nVal) {
            foreach ($nVal as $nV) {
                $recruitProcedurerDetailArr [$nKey] [$nV] ['ID'] = $nV;
                $recruitProcedurerDetailArr [$nKey] [$nV] ['name'] = $t [$nV] ['name'];
            }
        }
        return $this->recruitProcedurerDetailArr = $recruitProcedurerDetailArr;
    }
}

?>