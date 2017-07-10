<?php

/*
 * 思路,
 * 1.写一个员工信息函数,保存跟员工有关的信息
 * 2.$con 表示的是 condition(where条件)
 * 3.$num 表示的是 需要那几条sql语句.(array类型)
 * 4.生成的员工信息为数组格式 $key=>$value
 * 5.函数的返回类型是一个数组 
 * 
 */
class wInfoSet
{
    public $p; //$pdo   对象
    public $type;
    public $wInfoSet; //这个数组是配合common.function.php中的reCreatArray两个结合使用
    public $wInfoSetExtra; //住房公积金,等其他不同编码的问题

    public function wInfoSetArr()
    {
        $type = $this->type;
        $pdo = $this->p;
        if ($pdo) {
            $sql = "select ID,nationName from s_nation";
            $nationRet = $pdo->query($sql);
            foreach ($nationRet as $naval) {
                $naRet [$naval ['ID']] = $naval ['nationName'];
            }
            $unitRet = SQL($pdo, "select unitID,unitName from a_unitInfo");
            foreach ($unitRet as $uval) {
                $uRet [$uval ['unitID']] = $uval ['unitName'];
            }
            unset ($nationRet, $unitRet);
        }
        $wInoSet = array(
            'status' => array(
                "0" => "离职",
                '1' => "在职",
                "2" => "在职"
            ),
            'nation' => $naRet,
            'unitID' => $uRet,
            'sex' => array(
                "1" => "男",
                "2" => "女"
            ),
            'education' => array(
                "11" => "博士",
                "12" => "硕士",
                "21" => "大学",
                "31" => "大专",
                "40" => "中专中技",
                "50" => "技校",
                "61" => "高中",
                "62" => "职高",
                "63" => "职专",
                "70" => "初中",
                "80" => "小学",
                "90" => "文盲或半文盲"
            ),
            'role' => array(
                "1" => "党员",
                "2" => "团员",
                "3" => "民主人士",
                "4" => "群众",
                "9" => "其他"
            ),
            'marriage' => array(
                "1" => "未婚",
                "2" => "已婚",
                "3" => "丧偶",
                "4" => "离婚",
                "9" => "其它"
            ),
            'type' => array(
                "1" => "全日制",
                "2" => "非全日制",
                "3" => "实习生",
                "4" => "退休返聘",
				"5" => "全日制（外包）"
            ),
            'domicile' => array(
                "1" => "本市",
                "2" => "非本市"
            ),
            'proTitle' => array(
                "1" => "初级",
                "2" => "中级",
                "3" => "高级",
                "9" => "其他"
            ),
            'proLevel' => array(
                "1" => "高级技师",
                "2" => "技师",
                "3" => "高级技术等级",
                "4" => "中级技术等级",
                "5" => "初级技术等级",
                "9" => "无"
            ),
            'cType' => array(
                "1" => "固定期劳动合同",
                "2" => "无固定期劳动合同",
                "3" => "以完成一定工作任务",
            ),
            "housingFund" => array(
                "1" => "参加",
                '2' => "参加",
                '3' => "参加",
                '0' => "否"
            ),
            "housingFundStatus" => array(
                "1" => "设立",
                '2' => "修改",
                "3" => "市内转移",
                "9" => "补缴",
                '0' => "封存"
            ),
            "jobReg" => array(
                "1" => "已登记",
                "2" => "已登记",
                "0" => "终止"
            ),
            "jobRegStatus" => array(
                "1" => "新增",
                "2" => "新增",
                "0" => "终止"
            ),
            //其他身份证件
            "otherStatus" => array(
                "1" => "护照",
                "2" => "军官证",
                "3" => "回乡证",
                "4" => "港澳通行证"
            ),
            //户口类型
            "nativeType" => array(
                "1" => "农业",
                "2" => "非农业"
            ),
            //血型
            "blood" => array(
                "1" => "O型",
                "2" => "A型",
                "3" => "B型",
                "4" => "AB型",
                "5" => "其他"
            ),
            "health" => array(
                "1" => "健康",
                "2" => "良好",
                "3" => "一般"
            ),
            //外语水平
            "level" => array(
                "1" => "低",
                "2" => "中",
                "3" => "高"
            ),
            //是否海外
            "oversSeas" => array(
                "1" => "是"
            ),
            //证明人来源
            "reterenceFrom" => array(
                "1" => "邮政",
                "2" => "外单位"
            ),
            'othersex' => array(
                "1" => "男",
                "2" => "女",
                "3" => "其他"
            ),
            //是否重要
            "ifMain" => array(
                "1" => "是"),
            //入职方式
            "entryWay" => array(
                "0" => "内部推荐",
                "1" => "职业中介",
                "2" => "劳务市场",
                "3" => "校园招聘",
                "4" => "部队转业",
                "5" => "网络招聘",
                "6" => "报纸广告",
                "7" => "猎头公司",
                "8" => "人才市场",
                "9" => "户外广告",
                "10" => "其他"
            ),
            //判断是否审核
            "infoConfirm" => array(
                "0" => "未审核",
                "1" => "确认",
                "2" => "等待修改",
                "99" => "不通过"
            )

        );
        switch ($type) {
            //本系统内,根据居住证系统来设置的
            case "housingFund" :
                $wInoSetExtra = array(
                    'education' => array(
                        "11" => "01",
                        "12" => "02",
                        "21" => "03",
                        "31" => "04",
                        "40" => "04",
                        "50" => "04",
                        "61" => "04",
                        "62" => "04",
                        "63" => "04",
                        "70" => "04",
                        "80" => "04",
                        "90" => "04"
                    ),
                    'marriage' => array(
                        "1" => "02",
                        "2" => "01",
                        "3" => "02",
                        "4" => "02"
                    ),
                    'domicile' => array(
                        "1" => "01",
                        "2" => "02"
                    ),
                    'proTitle' => array(
                        "1" => "040",
                        "2" => "030",
                        "3" => "010",
                        "9" => "050"
                    ),
                    "housingFundStatus" => array(
                        '1' => "设立",
                        '2' => "修改",
                        '3' => "市内转移",
                        '9' => "补缴",
                        '0' => "封存"
                    ),
                    "HFType" => array(
                        "2" => "补缴"
                    )
                );
                break;
            case "jobReg" :
                $wInoSetExtra = array(
                    'domicile' => array(
                        "1" => "10",
                        "2" => "23"
                    )
                );
                break;
        }
        $this->wInfoSet = $wInoSet;
        $this->wInfoSetExtra = $wInoSetExtra;
    }
}

?>