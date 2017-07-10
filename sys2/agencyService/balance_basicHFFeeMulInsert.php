<?php
/*
*      Date: 13-12-5
*   
*    <<<  [公积金]前程无忧资金往来备忘录导入  >>>
*       created by Great sToNe
*       email: shi35dong@gmail.com
*       have fun,.....
*/


require_once '../common.function.php';

class balance_basicHFFeeMulInsert
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
        $field = array( "unitName", "name", "pID", "HFTotal", "HFSecTotal","feeID","mCost","mCostSec");
        $trueField = array("unitName", "name", "pID","HFTotal","mCost","feeID");
        $extraEngToChsArr=array("HFTotal"=>"公积金合计","feeID"=>"账套名称");
        $engToChsArr = array_merge($engToChsArr,$extraEngToChsArr);
        foreach ($trueField as $val) {
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
        foreach ($cellArray as $val) {
            if ($val['pID']):
                $newCellArray[$val['pID']]['unitName'] = $val['unitName'];
                $newCellArray[$val['pID']]['name'] = $val['name'];
                $newCellArray[$val['pID']]['pID'] = $val['pID'];             
                $newCellArray[$val['pID']]['HFTotal'] += $val['HFTotal']+$val['HFSecTotal'];
                $newCellArray[$val['pID']]['mCost'] += $val['mCost']+$val['mCostSec'];
                $newCellArray[$val['pID']]['feeID'] = $val['feeID'];
            endif;
        }
        unset($cellArray);
        $this->cellArray = $newCellArray;
    }

    #设置文档内容函数

    public function set()
    {
        $title = "导入[公积金]备忘录";
        $table = "c_basic_fee_in";
        $field = $this->field;
        $fieldHeader = $this->fieldName;
        $setArray = array("title" => $title, "table" => $table, "field" => $field, "fieldHeader" => $fieldHeader);
        return $setArray;
    }

    public function validatorSql($getQuery)
    {
        $pdo = $this->p;
        $housingFundID = $getQuery ['housingFundID'];
        $month = $getQuery ['month'];
        $errMsg = NULL;
        return $errMsg;
    }

    #生成要导入到数据库的数组,包含两部分数组参数,一部分是EXCEL中的CELL,一部分是额外设置的$getQuery

    public function extraFieldValue($getQuery)
    {
        $lastModifyTime = timeStyle("dateTime");
        $mID = $_SESSION ['exp_user'] ['mID'];
        $month = $getQuery ['month'];
        $cellArray = $this->cellArray;
        foreach ($cellArray as $key => $val) {
            $pID = pIDVildator($cellArray [$key] ['pID']);
            if ($pID)
                $cellArray [$key] ['pID'] = $pID;
            $cellArray [$key] ['month'] = $month;
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
        $pdo = $this->p;
        $upSql = "update c_basic_fee_in set  ";
        $inSql = "insert into c_basic_fee_in set ";
        foreach ($cellArray as $cValue) {
            $pIDStr .= "'" . $cValue['pID'] . "',";
			$feeID = $cValue['feeID'];
			$month = $cValue['month'];
        }
        $pIDStr = rtrim($pIDStr, ",");
		//注:  这里没有限定月份,可以提高索引时间, 因为每月都清空数据, 但是也需注意
       // $existSql = "select `pID` from c_basic_fee_in where pID in ($pIDStr) and feeID like '$feeID' ";
 $existSql = "select `pID` from c_basic_fee_in where pID in ($pIDStr)  ";
        
$existRet = SQL($pdo, $existSql);
        $existRet = keyArray($existRet, "pID");
        foreach ($cellArray as $cVal) {
            $month = $cVal['month'];
            $pID = $cVal['pID'];
			$unitName =$cVal['unitName'];
			$HFTotal =$cVal['HFTotal']? round($cVal ['HFTotal'], 2) : 0;           
            $mCost = $cVal ['mCost']?round($cVal ['mCost'], 2) : 0;
			
            if (array_key_exists($pID, $existRet)) {
				if($HFTotal!=0 || $mCost!=0){
			//注:  这里没有限定月份,可以提高索引时间, 因为每月都清空数据, 但是也需注意				
                $sqlV = "`HFTotal`=`HFTotal`+$HFTotal,`mCost`=`mCost`+$mCost where `pID` like '$pID' ";
                $sql [] = $upSql . $sqlV;
				}
            } else {
                $sqlV = "`name`='".$cVal['name']."',`feeID`='".$cVal['feeID']."',`unitName`='$unitName',`HFTotal`='$HFTotal',`mCost`='$mCost',`pID`='$pID',`month` ='$month'";
                $sql [] = $inSql . $sqlV;
            }
        }
		
		
        // $cellArray = $this->extraCellArray;
        // foreach ($cellArray as $cValue) {
            // $s_V = null;
            // $sqlK = $sqlV = null;
            // foreach ($cValue as $cK => $cV) {
                // $sqlK .= $cK . ',';
                // $s_V .= "'" . $cV . "',";
            // }
            // $sqlK = rtrim($sqlK, ",");
            // $s_V = rtrim($s_V, ",");
            // $sqlV = "(" . $s_V . ")";
            // $sql [] = "insert into `c_basic_fee_in` ( " . $sqlK . ") values " . $sqlV;
        // }
//	 echo "<pre>";
//	 print_r($sql);
//	 exit();
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