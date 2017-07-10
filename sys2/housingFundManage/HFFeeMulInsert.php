<?php

/*
 *     2010-5-21
 *          <<<  >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
require_once '../common.function.php';

class HFFeeMulInsert {

    public $p; //$pdo   对象
    public $cellArray; //欲操作数组
    private $field; //通过数据库查询,获得
    private $fieldName; //通过数据库查询,获得
    public $extraCellArray; //预插入数据库的数据

    #获取数据库中预定义的$field,$fieldName

    public function field() {
        $engToChsArr = engTochs();
        //引用该类的源文件要有引用common.function.php
        $field = array("HFID", "name", "pID", "HFRadix", "uHFPer", "pHFPer", "total");
        foreach ($field as $val) {
            if (array_key_exists($val, $engToChsArr)) {
                $fieldName [] = $engToChsArr [$val];
            }
        }
        $this->field = $field;
        $this->fieldName = $fieldName;
    }

    #获取数组,并加上KEY

    public function cellArray($cellVal) {
        $field = $this->field;
        $countCell = count($cellVal);
        for ($k = 0; $k < $countCell; $k++) {
            $cellArray [] = array_combine($field, $cellVal [$k]);
        }
        $cellArray = array_filter($cellArray);
        foreach ($cellArray as $key => $val) {
            $newCellArray[$val['pID']]['HFID'] = $val['HFID'];
            $newCellArray[$val['pID']]['name'] = $val['name'];
            $newCellArray[$val['pID']]['pID'] = $val['pID'];
            $newCellArray[$val['pID']]['HFRadix'] = $val['HFRadix'];
            $newCellArray[$val['pID']]['uHFPer'] = $val['uHFPer'];
            $newCellArray[$val['pID']]['pHFPer'] = $val['pHFPer'];
            $newCellArray[$val['pID']]['total'] += $val['total'];
        }
        unset($cellArray);
        $this->cellArray = $newCellArray;
    }

    #设置文档内容函数

    public function set() {
        $title = "导入公积金缴交明细";
        $table = "a_HFFee_retmp";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
    }

    public function validatorSql($getQuery) {
        $pdo = $this->p;
        $housingFundID = $getQuery ['housingFundID'];
        $HFDate = $getQuery ['HFDate'];
        $sql = "select housingFundID from a_HFFee_tmp where housingFundID like '$housingFundID' and HFDate= '$HFDate' ";
        $res = $pdo->query($sql);
        $row = $res->rowCount();
        if ($row) {
            $errMsg [] = "数据库已经存在该单位本月数据,请勿重复导入,您可以通过<a href='" . httpPath . "HFBalFeeIndex.php?HFDate=$HFDate'>社保缴交明细管理</a>,修改您的数据";
        }
        return $errMsg;
    }

    #生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery

    public function extraFieldValue($getQuery) {
        $sponsorTime = timeStyle("dateTime");
        $sponsorName = $_SESSION ['exp_user'] ['mName'];
        $housingFundID = $getQuery ['housingFundID'];
        $HFDate = $getQuery ['HFDate'];
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            $pID = pIDVildator($cellArray [$key] ['pID']);
            if ($pID)
                $cellArray [$key] ['pID'] = $pID;
            $cellArray [$key] ['housingFundID'] = $housingFundID;
            $cellArray [$key] ['HFDate'] = $HFDate;
            $cellArray[$key]['uTotal'] = round(( $val['total'] / 2), 2);
            $cellArray[$key]['pTotal'] = $cellArray[$key]['uTotal'];
            $cellArray [$key] ['sponsorName'] = $sponsorName;
            $cellArray [$key] ['sponsorTime'] = $sponsorTime;
        }
        //		echo "<pre>";
        //		print_r($cellArray);
        return $this->extraCellArray = $cellArray;
    }

    #数据库操作语句

    public function sql() {
        $cellArray = $this->extraCellArray;
        foreach ($cellArray as $cValue) {
            $s_V = null;
            $sqlK = $sqlV = null;
            foreach ($cValue as $cK => $cV) {
                $sqlK .= $cK . ',';
                $s_V .= "'" . $cV . "',";
            }
            $sqlK = rtrim($sqlK, ",");
            $s_V = rtrim($s_V, ",");
            $sqlV = "(" . $s_V . ")";
            $sql [] = "insert into a_HFFee_tmp ( " . $sqlK . ") values " . $sqlV;
        }
        return $sql;
    }

    #导入信息概况

    public function dataInfo() {
        $cellArray = $this->cellArray;
        $insertInfo = '共' . count($cellArray) . "条";
        return $insertInfo;
    }

}

?>