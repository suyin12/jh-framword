<?php

/**
 * Description of jqGridSearchSet
 * jqGrid查询 字符串解析类
 * @author sToNe    
 * email :  shi35dong@gmail.com
 */
class jqGridSearchSet {

//put your code here
    public $searchArr;  //把field处理过后的 group

    function constructWhere($s) {
        $qwery = "";
//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
        $qopers = array(
            'eq' => " = ",
            'ne' => " <> ",
            'lt' => " < ",
            'le' => " <= ",
            'gt' => " > ",
            'ge' => " >= ",
            'bw' => " LIKE ",
            'bn' => " NOT LIKE ",
            'in' => " IN ",
            'ni' => " NOT IN ",
            'ew' => " LIKE ",
            'en' => " NOT LIKE ",
            'cn' => " LIKE ",
            'nc' => " NOT LIKE ");
        if ($s) {
            $jsona = json_decode($s, true);
            if (is_array($jsona)) {
                $gopr = $jsona['groupOp'];
                $rules = $jsona['rules'];
                $i = 0;
                foreach ($rules as $key => $val) {
                    $field = $val['field'];
                    $op = $val['op'];
                    $v = $val['data'];
                    if ($v && $op) {
                        $i++;
// ToSql in this case is absolutley needed
                        $v = ToSql($field, $op, $v);
                        if ($i == 1)
                            $qwery = " AND ";
                        else
                            $qwery .= " " . $gopr . " ";
                        switch ($op) {
// in need other thing
                            case 'in' :
                            case 'ni' :
                                $qwery .= $field . $qopers[$op] . " (" . $v . ")";
                                break;
                            default:
                                $qwery .= $field . $qopers[$op] . $v;
                        }
                    }
                }
            }
        }
        return $qwery;
    }

    #多重选择时,返回的字段设置

    function getStringForGroup() {
        $group = $this->searchArr;
        $i_ = '';
        $sopt = array('eq' => "=", 'ne' => "<>", 'lt' => "<", 'le' => "<=", 'gt' => ">", 'ge' => ">=", 'bw' => " {$i_}LIKE ", 'bn' => " NOT {$i_}LIKE ", 'in' => ' IN ', 'ni' => ' NOT IN', 'ew' => " {$i_}LIKE ", 'en' => " NOT {$i_}LIKE ", 'cn' => " {$i_}LIKE ", 'nc' => " NOT {$i_}LIKE ", 'nu' => 'IS NULL', 'nn' => 'IS NOT NULL');
        $s = "(";
        if (isset($group['groups']) && is_array($group['groups']) && count($group['groups']) > 0) {
            for ($j = 0; $j < count($group['groups']); $j++) {
                if (strlen($s) > 1) {
                    $s .= " " . $group['groupOp'] . " ";
                }
                try {
                    $dat = getStringForGroup($group['groups'][$j]);
                    $s .= $dat;
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
        }
        if (isset($group['rules']) && count($group['rules']) > 0) {
            try {
                foreach ($group['rules'] as $key => $val) {
                    if (strlen($s) > 1) {
                        $s .= " " . $group['groupOp'] . " ";
                    }
                    $field = $val['field'];
                    $op = $val['op'];
                    $v = $val['data'];
                    if ($op) {
                        switch ($op) {
                            case 'bw':
                            case 'bn':
                                $s .= $field . ' ' . $sopt[$op] . "'$v%'";
                                break;
                            case 'ew':
                            case 'en':
                                $s .= $field . ' ' . $sopt[$op] . "'%$v'";
                                break;
                            case 'cn':
                            case 'nc':
                                $s .= $field . ' ' . $sopt[$op] . "'%$v%'";
                                break;
                            case 'in':
                            case 'ni':
                                $s .= $field . ' ' . $sopt[$op] . "( '$v' )";
                                break;
                            case 'nu':
                            case 'nn':
                                $s .= $field . ' ' . $sopt[$op] . " ";
                                break;
                            default :
                                $s .= $field . ' ' . $sopt[$op] . " '$v' ";
                                break;
                        }
                    }
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        $s .= ")";
        if ($s == "()") {
//return array("",$prm); // ignore groups that don't have rules
            return " ";
        } else {
            return " and ".$s;
            ;
        }
    }

}

?>
