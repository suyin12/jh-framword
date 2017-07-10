<?php

/**
 * Description of makeHtml
 * 将数据库数据生成HTML文件
 * @author  sToNe
 */
class makeHtml {

    public $arr; //array 生成操作的数组,是一个二维数组
    public $htmlPath; //string   路径
    public $IDArr;
    public $tableAttribute; //表头,或表尾额外操作

    #构建HTML文档

    function html() {
        $arr = $this->arr;
        $path = $this->htmlPath;
        $tID = $this->IDArr['tID'];
        $tdID = $this->IDArr['tdID'];
        $tableAttribute = $this->tableAttribute;
        $fh = fopen($path, "w");
        $table = "<table class='jSheet ui-widget-content' id='" . $tID . "'>";
        if ($tableAttribute)
            $table .= $tableAttribute['thead'];
        $i = 0;
        foreach ($arr as $val) {
            $j = 0;
            $tbody.="<tr>";
            foreach ($val as $k => $v) {
                $tbody .="<td id='" . $tdID . "_cell_c" . $j . "_r" . $i . "'>" . $v . "</td>";
                $j++;
            }
            $tbody.="</tr>";
            $i++;
        }
        $tbody.="</tbody></table>";
        $table .= "<tbody>" . $tbody;
        fwrite($fh, $table);
        fclose($fh);
    }

}

?>
