
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/17
 * Time: 10:16
 */
<?php
class DBconnect {
    function dbConnect($db_host,$db_name,$db_port,$db_user,$db_pass){
        $dsn = "mysql:host=$db_host;port=$db_port;name=$db_name";
        try{
            $pdo = new PDO($dsn,$db_user,$db_pass);
        }catch(PDOException $e){
            header("Content-type: text/html; charset=utf-8");
            exit("数据库链接失败!");
        }
        return $pdo;
    }
}
?>