<?php
/**
 *
 * User: suyin
 * Date: 2017/6/2815:51
 *
 */
require "../setting.php";

class ExceModel{
    private static $_instance;
    private $pdo;
    function __construct(){
        $this->pdo = Conn::get_instance();
    }
    static function  getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function exceDownload($filename,$tablename="member_info",$field="*"){
        header('Content-Type: application/vnd.ms-excel;charset=utf-8');
        $filename = $filename.".xls";
        header('Content-Disposition: attachment;filename='.$filename.'');

        $sql = "select".$field."from ".$tablename."where 1=1";

        $arr = $this->pdo->query($sql);
        $res = $arr->fetch(PDO::FETCH_ASSOC);
        while(list($key,$value) = each($res)){
            echo $key."\t";
        }
        echo "\t\n";
        $arr2 = $this->pdo->query($sql);
        $ret = $arr2->fetchAll(PDO::FETCH_ASSOC);
//echo "<pre>";
//print_r($ret);
        for($j=0;$j<count($ret);$j++){
            if($j!=0) echo "\t\n";
            while(list($key,$value) = each($ret[$j])){
                if($value === NULL){
                    echo "NULL"."\t";
                }else{
                    echo $value."\t";
                }
            }
        }
    }
}