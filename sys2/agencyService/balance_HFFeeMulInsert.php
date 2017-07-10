<?php

/*
 *     2010-5-21
 *          <<< 前程无忧平账部分,公积金缴交明细导入 >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
require_once '../common.function.php';

class balance_HFFeeMulInsert
{

    public $p; //$pdo   对象
    public $cellArray; //预操作数组
    public $extraCellArray; //通过数据库查询,获得
    private $field; //通过数据库查询,获得
    private $fieldName; //预插入数据库的数据

    #获取数据库中预定义的$field,$fieldName

    public function field()
    {
        $engToChsArr = engTochs();
        //引用该类的源文件要有引用common.function.php
        $field = array("housingFundID", "HFID", "name", "pID", "total", "mCost");
        foreach ($field as $val) {
            if (array_key_exists($val, $engToChsArr)) {
                $fieldName [] = $engToChsArr [$val];
            }
        }
        $this->field = $field;
        $this->fieldName = $fieldName;
    }

    #获取数组,并加上KEY

    public function cellArray($cellVal)
    {
        $field = $this->field;
        $countCell = count($cellVal);
        for ($k = 0; $k < $countCell; $k++) {
            $cellArray [] = array_combine($field, $cellVal [$k]);
        }
        $cellArray = array_filter($cellArray);
        foreach ($cellArray as $key => $val) {
            $newCellArray[$val['pID']]['housingFundID'] = $val['housingFundID'];
            $newCellArray[$val['pID']]['HFID'] = $val['HFID'];
            $newCellArray[$val['pID']]['name'] = $val['name'];
            $newCellArray[$val['pID']]['pID'] = $val['pID'];
            //补缴的数据累计的和
            $newCellArray[$val['pID']]['total'] += $val['total'];
            $newCellArray[$val['pID']]['mCost'] += $val['mCost'];
        }
        unset($cellArray);
        $this->cellArray = $newCellArray;
    }

    #设置文档内容函数

    public function set()
    {
        $title = "导入公积金缴交明细";
        $table = "c_hf_fee_out";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
    }

    public function validatorSql($getQuery)
    {
        $pdo = $this->p;
        $housingFundID = $getQuery ['housingFundID'];
        $HFDate = $getQuery ['HFDate'];
        $errMsg = NULL;
        return $errMsg;
    }

    #生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery

    public function extraFieldValue($getQuery)
    {
        $lastModifyTime = timeStyle("dateTime");
        $mID = $_SESSION ['exp_user'] ['mID'];
        $HFDate = $getQuery ['HFDate'];
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            $pID = pIDVildator($cellArray [$key] ['pID']);
            if ($pID)
                $cellArray [$key] ['pID'] = $pID;
            $cellArray [$key] ['HFDate'] = $HFDate;
            $cellArray [$key] ['mID'] = $mID;
            $cellArray [$key] ['lastModifyTime'] = $lastModifyTime;
        }
        //		echo "<pre>";
        //		print_r($cellArray);
        return $this->extraCellArray = $cellArray;
    }

    #数据库操作语句

    public function sql()
    {
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
            $sql [] = "insert into c_hf_fee_out ( " . $sqlK . ") values " . $sqlV;
        }
        return $sql;
    }

    #导入信息概况

    public function dataInfo()
    {
        $cellArray = $this->cellArray;
        $insertInfo = '共' . count($cellArray) . "条";
        return $insertInfo;
    }

}

?>