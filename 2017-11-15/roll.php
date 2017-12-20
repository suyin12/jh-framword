<?php
/**
 * Date: 2017/11/15 14:59
 */
class Roll{
    private static $arr = [
        '13245124851',
        '13258712154',
        '15487121211',
        '18451212452',
        '17851212121',
        '13412121211',
        '13145412121',
        '18421212215',
        '17541215486',
        '15684541211'
    ];

    public static function getPhone(){
        $phoneArr = array_rand(self::$arr,5);
        foreach($phoneArr as $value){
            $ret[] = substr_replace(self::$arr[$value],'****',3,4)."<br />";
        }

        return $ret;
    }
}
$ret = Roll::getPhone();

require dirname(__DIR__)."/2017-11-15/roll2.php";
