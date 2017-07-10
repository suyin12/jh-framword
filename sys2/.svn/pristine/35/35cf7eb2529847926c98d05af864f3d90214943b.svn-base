<?php

/**
 *  用来控制显示的列数或者导出的选项
 * 该类 会配合  wInfoSet.data.php   common.function.php 使用
 *
 * @author sToNe
 * email :  shi35dong@gmail.com
 */
class fieldDisplay
{

    public $formulas ;// array  公式的数组类型
    public $model = NULL; //string 引用的项目模式分为  all(全部), NULL 默认的简单模式
    public $style = "checkbox"; //string 显示的模式, 分为checkbox ,select 等 暂时默认为checkbox
    public $actionArr; // array  可以自定义传入数组字段,或者引用下面的函数输出
    public $assistArr; // array 辅助数组,如:checkbox的check属性
    
    #员工信息列

    function wInfoField()
    {
        $model = $this->model;
        switch ($model) {
            //全字段模式
            case "all":
                $wInfoField = array('status', 'uID', 'name', 'pID', 'dID', 'HFID', 'sID', 'bID', 'spID', 'sex', 'nation', 'homeAddress', 'workAddress', 'education', 'role', 'marriage', 'mobilePhone', 'telephone', 'contact', 'contactPhone', 'school', 'blank', 'type', 'unitID', 'filiale', 'department', 'station', 'mountGuardDay', 'cBeginDay', 'cEndDay', 'soInsurance', 'domicile', 'soInsBuyDate', 'sID', 'radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'PDIns', 'hand', 'housingFund', 'HFBuyDate', 'HFID', 'pHFPer', 'uHFPer', 'HFRadix', 'spouseName', 'spousePID', 'comInsurance', 'helpCost', 'managementCost', 'photoID', 'birthID', 'proTitle', 'proLevel', 'remarks', 'dimissionDate', 'dimissionReason', 'dimissionRemarks');
                break;
            //批量入职模式
            case "mulInsert":
                $wInfoField = array('uID', 'name', 'pID', 'dID', 'bID', 'spID', 'sex', 'nation', 'homeAddress', 'workAddress', 'education', 'dateOfGraduation', 'role', 'marriage', 'mobilePhone', 'telephone', 'contact', 'contactPhone', 'school', 'blank', 'type', 'unitID', 'filiale', 'department', 'station', 'mountGuardDay', 'cType', 'cBeginDay', 'cEndDay', 'domicile', 'soInsBuyDate', 'sID', 'radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'PDIns', 'hand', 'HFBuyDate', 'HFID', 'pHFPer', 'uHFPer', 'HFRadix', 'spouseName', 'spousePID', 'comInsurance', 'helpCost', 'managementCost', 'jobRegModifyDate', 'photoID', 'birthID', 'proTitle', 'proLevel', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I','J','K','L','M','remarks');
                break;
            //批量更新模式
            case "mulModify":
                $wInfoField = array('status', 'uID', 'name', 'pID', 'dID', 'bID', 'spID', 'sex', 'nation', 'homeAddress', 'workAddress', 'education', 'dateOfGraduation', 'role', 'marriage', 'mobilePhone', 'telephone', 'contact', 'contactPhone', 'school', 'blank', 'type', 'unitID', 'filiale', 'department', 'station', 'mountGuardDay', 'cType', 'cBeginDay', 'cEndDay', 'soInsurance', 'domicile', 'soInsBuyDate', 'sID', 'radix', 'pension', 'hospitalization', 'employmentInjury', 'unemployment', 'PDIns', 'hand', 'housingFund', 'HFBuyDate', 'HFID', 'pHFPer', 'uHFPer', 'HFRadix', 'spouseName', 'spousePID', 'comInsurance', 'helpCost', 'managementCost', 'jobRegmodifyDate', 'photoID', 'birthID', 'proTitle', 'proLevel', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I','J','K','L','M', 'remarks', 'dimissionDate', 'dimissionReason', 'dimissionRemarks');
                break;
            //默认的简单的模式
            default :
                $wInfoField = array('status', 'uID', 'name', 'pID', 'HFID', 'sID', 'bID', 'spID', 'dimissionDate', 'soInsModifyDate', 'HFModifyDate', 'sex', 'mobilePhone', 'telephone', 'contact', 'contactPhone', 'school', 'blank', 'type', 'unitID', 'filiale', 'department', 'station', 'mountGuardDay', 'cBeginDay', 'cEndDay', 'domicile', 'soInsBuyDate', 'radix', 'housingFund', 'HFBuyDate', 'HFRadix');
                break;
        }
        return $this->actionArr = $wInfoField;
    }

    #工资表字段 
    // $type表示的是 fee每月正常的费用表,发放表,reward 每月奖金发放表  
    // $array = array("month"=> ,"unitID"=> , "zID"=>)

    function formulasField($pdo, $type, $array)
    {
        switch ($type) {
            case "fee":
                $sql = "select `payFormulas`,`acheiveFormulas`,`ratalFormulas`,`uAccountFormulas`,`totalFeeFormulas` from `a_zFormulas` where  `month` like '" . $array['month'] . "' and `unitID` in ('" . $array['unitID'] . "')";
                break;
            case "mulFee":
                $sql = "select `payFormulas`,`acheiveFormulas`,`ratalFormulas`,`uAccountFormulas`,`totalFeeFormulas` from `a_otherFormulas` where  `month` like '" . $array['month'] . "' and `unitID` in ('" . $array['unitID'] . "') and `extraBatch` like '" . $array['extraBatch'] . "' and `type`='4' ";
                break;
            case "reward":
                $sql = "select `payFormulas`,`acheiveFormulas`,`ratalFormulas`,`uAccountFormulas`,`totalFeeFormulas` from `a_otherFormulas` where  `month` like '" . $array['month'] . "' and `unitID` in ('" . $array['unitID'] . "') and `extraBatch` like '" . $array['extraBatch'] . "' and `type`='1' ";
                break;
        }
        $ret = SQL($pdo, $sql, null, 'one');
        preg_match_all("/[a-zA-Z]+/", $ret ['payFormulas'], $payStr);
        if ($ret ['acheiveFormulas'])
            preg_match_all("/[a-zA-Z]+/", $ret ['acheiveFormulas'], $acheiveStr);
        if ($ret ['totalFeeFormulas'])
            preg_match_all("/[a-zA-Z]+/", $ret ['totalFeeFormulas'], $totalFeeStr);
        if($ret['uAccountFormulas'])
             preg_match_all("/[a-zA-Z]+/", $ret ['uAccountFormulas'], $uAccountStr);
        if($ret['ratalFormulas'])
            preg_match_all("/[a-zA-Z]+/", $ret ['ratalFormulas'], $ratalStr);

        $formulasFieldArr = array('payFormulas' => $payStr['0'], 'acheiveFormulas' => $acheiveStr['0'], 'totalFeeFormulas' => $totalFeeStr['0']);
        $this->formulas = $ret;
        return $this->actionArr = $formulasFieldArr;
    }

    #费用表字段

    function feeField()
    {
        $feeField = array('pSoIns', 'uSoIns', 'pHF', 'uHF', 'uPDIns', 'pComIns', 'uComIns', 'managementCostFee', 'helpCostFee', "pSoInsMoney", 'uSoInsMoney', 'pHFMoney', 'uHFMoney', 'pComInsMoney', 'uComInsMoney', 'uPDInsMoney', 'managementCostMoney', 'salaryMoney', 'cardMoney', 'totalFee');
        return $this->actionArr = $feeField;
    }

    #工资表默认导出项

    function salaryExportStyle()
    {
        $sql = "";
    }

    #费用表默认导出项

    function feeExportStyle()
    {

    }

    #对应字段的显示风格

    function fieldStyle($limit = 9, $engToCHN = null, $trORth = "tr")
    {
        $style = $this->style;
        $actionArr = $this->actionArr;
        $assistArr = $this->assistArr;
        $basicEngToCHS = array_merge(engTochs(), wInfoExtraFieldSet());
        //array 支持重新定义某字段的中文显示
        $eToCN = $engToCHN;
        if ($eToCN)
            $eToCN = array_merge($basicEngToCHS, $eToCN);
        else
            $eToCN = $basicEngToCHS;
        switch ($style) {
            // 中英文对照数组, 返回 Array
            case "none":
                foreach ($actionArr as $val) {
                    $fieldArr[$val] = $eToCN[$val];
                }
                break;
            //加载checkbox的数组, 返回  string
            case "checkbox":
                $i = 0;
                $fieldStr = "<$trORth>";
                foreach ($actionArr as $val) {
                    if ($limit && $i % $limit == 0 && $i != 0)
                        $fieldStr .= "</$trORth><$trORth>";
                    $i++;
                    $fieldStr .= "<td><input type='checkbox' name='" . $val . "'";
                    if ($assistArr && in_array($val, $assistArr))
                        $fieldStr .= " checked ";
                    $fieldStr .= ">" . $eToCN[$val] . "</td>";
                }
                $fieldStr .= "</$trORth>";
                $fieldArr = $fieldStr;
                break;
            //计算的选项   返回string    
            case "math":
                #设置公式所需要的代号
                $actionArr = array_merge(array("+", "-", "/", "*", "(", ")"), $actionArr);
                $i = 0;
                $formulasChartStr .= "<$trORth>";
                foreach ($actionArr as $val) {

                    if ($i % $limit == 0 && $i != 0)
                        $formulasChartStr .= "</$trORth><$trORth>";
                    $i++;
                    $formulasChartStr .= "<td>";
                    $formulasChartStr .= "<a id='$val' class='chart'>$eToCN[$val]($val)</a>";
                    $formulasChartStr .= "</td>";
                }
                $formulasChartStr .= "</$trORth>";
                $fieldArr = $formulasChartStr;
                break;
        }
        return $fieldArr;
    }

}

?>
