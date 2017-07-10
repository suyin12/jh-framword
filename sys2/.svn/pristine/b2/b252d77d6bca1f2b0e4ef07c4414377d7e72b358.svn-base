<?php
/*
*     2010-9-29
*          <<< 前程无忧平账部分,社保劳务工医疗导入 >>>
*      create by  Great sToNe
*     
*       have fun, wa Ha Ha..
*/
class balance_soInsFeeCooMulInsert
{
    public $p; //$pdo   对象
    public $cellArray; //欲操作数组
    public $extraCellArray; //通过数据库查询,获得
    private $field; //通过数据库查询,获得
    private $fieldName; //预插入数据库的数据
    #获取数据库中预定义的$field,$fieldName

    public function field()
    {
        $engToChsArr = engTochs();
        //引用该类的源文件要有引用common.function.php
        $field = array("soInsID", "sID","pID" ,"name", "total", "mCost");
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
            $newCellArray[$val['sID']]['soInsID'] = $val['soInsID'];
            $newCellArray[$val['sID']][ 'sID'] = $val['sID'];
            $newCellArray[$val['sID']]['pID'] = $val['pID'];
            $newCellArray[$val['sID']]['name'] = $val['name'];
            //补缴的数据累计的和
            $newCellArray[$val['sID']]['total'] += $val['total'];
            $newCellArray[$val['sID']]['mCost'] += $val['mCost'];
        }
        unset($cellArray);
        $this->cellArray = $newCellArray;
    }

    #设置文档内容函数

    public function set()
    {
        $title = "导入社保补缴明细";
        $table = "c_soIns_fee_out";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
    }

    public function validatorSql($getQuery)
    {
        $pdo = $this->p;
        $soInsDate = $getQuery ['soInsDate'];
        $errMsg = NULL;
        return $errMsg;
    }

    #生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery

    public function extraFieldValue($getQuery)
    {
        $lastModifyTime = timeStyle("dateTime");
        $mID = $_SESSION ['exp_user'] ['mID'];
        $soInsDate = $getQuery ['soInsDate'];
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            $pID = pIDVildator($cellArray [$key] ['pID']);
            if ($pID)
                $cellArray [$key] ['pID'] = $pID;
            $cellArray [$key] ['soInsDate'] = $soInsDate;
            $cellArray [$key] ['mID'] = $mID;
            $cellArray [$key] ['lastModifyTime'] = $lastModifyTime;
        }
        //		echo "<pre>";
        //		print_r ( $cellArray );
        return $this->extraCellArray = $cellArray;

    }

    #数据库操作语句

    public function sql()
    {
        $cellArray = $this->extraCellArray;
        $pdo = $this->p;
        $upSql = "update c_soIns_fee_out set  ";
        $inSql = "insert into c_soIns_fee_out set ";
        foreach ($cellArray as $cValue) {
            $sIDStr .= "'" . $cValue['sID'] . "',";
        }
        $sIDStr = rtrim($sIDStr, ",");
        $existSql = "select `sID` from c_soIns_fee_out where sID in ($sIDStr)";
        $existRet = SQL($pdo, $existSql);
        $existRet = keyArray($existRet, "sID");
        foreach ($cellArray as $cVal) {
            $soInsDate = $cVal['soInsDate'];
            $sID = $cVal['sID'];
            $pID = $cVal['pID'];
            if (!$cVal ['total'])
                $total = 0;
            else
                $total = round($cVal ['total'], 2);
            if (!$cVal ['mCost'])
                $mCost = 0;
            else
                $mCost = round($cVal ['mCost'], 2);
            if (array_key_exists($sID, $existRet)) {
                $sqlV = "`total`=`total`+$total,`mCost`=`mCost`+$mCost where `sID` like '$sID' and `soInsDate` like '$soInsDate'";
                $sql [] = $upSql . $sqlV;
            } else {
                $sqlV = "`name`='".$cVal['name']."',`soInsID`='".$cVal['soInsID']."',`total`='$total',`mCost`='$mCost',`pID`='$pID',`sID` ='$sID' , `soInsDate` ='$soInsDate'";
                $sql [] = $inSql . $sqlV;
            }
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