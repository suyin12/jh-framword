<?php

/*
 * 
 * 简单的数据库备份及恢复
 * 
 *      create by  Great sToNe
 *     @email: shi35dong@gmail.com
 *       have fun, wa Ha Ha..
 */


#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#数据库备份类
require_once sysPath . 'class/mysqlBackup.class.php';
#配置属性
ini_set("memory_limit","1024M");
ini_set('max_execution_time', 200);
/**
 * Database connexion parameters
 */
define('DBNAME', db_name);

/**
 * Set the directory in which backups will be stored
 * Defaults to ./Backup/
 */
define("BACKUP_DIRECTORY", sysPath . "SQL/backup/");

/**
 * SQL Query size limit (i.e. size above which the query is spiltted into several queries)
 * Lower this value in case you get "Mysql Error 1153: Got a packet bigger than 'max_allowed_packet' bytes" when importing back the backup
 */
define("MAX_QUERY_SIZE", 1000000);

/**
 * IGNORE_FOREIGN_KEYS
 * If this set to True, Foreign keys will be ignored during the export and constraints will be exported after the create table queries to alter the tables accordingly
 * SET FOREIGN_KEY_CHECKS will bet set again to 1 at the end of the export.
 */
define("IGNORE_FOREIGN_KEYS", TRUE);

/**
 * DROP_TABLE
 * If this set to True,  the existing tables in the database will be dropped first at time of backup restore
 */
define("DROP_TABLE", TRUE);

/**
 * NO_AUTO_VALUE_ON_ZERO
 * If this set to True,  the following will be applied SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO"
 */
define("NO_AUTO_VALUE", TRUE);

/**
 * NUM_BACKUP_FILES_KEPT
 * This defines how many backup will be kept in the backup directory. If the number of backups exceeds this value, the backup file with the
 * lowest index will be erased (that is, the oldest one erase unless you've renmamed them) and the new backup file added in replacement.
 * To set no limit in the number of backup kept, set value to 0.
 */
define("NUM_BACKUP_FILES_KEPT", 5);

/**
 * STRICT_NUM_BACKUP_FILES
 * Defines whether the NUM_BACKUP_FILES_KEPT is an exact number of maximun backup files kept (option: TRUE) or an limit
 * under which it won't go. Say NUM_BACKUP_FILES_KEPT is set 5 but you end up with 7 files in the backup directory (because manually tweaked for instance)
 * option TRUE will erased lowest indexed backup up untill the total count of 5, whereas option FALSE will keep the count to 7
 */
define("STRICT_NUM_BACKUP_FILES", TRUE);

#标题
$title = "数据库备份及恢复";
#获取文件夹列表
$fileArr = getFileArr(BACKUP_DIRECTORY);

#备份SQL
if (isset($_POST['backup'])) {
    $pb4m = new phpBackup4MySQL();
    $pb4m->pdo = $pdo;
    $sql_dump = $pb4m->backupSQL();
    if (!$pb4m->saveFile($sql_dump))
        echo '<script>alert("备份失败,请联系管理员查证!");location.reload();</script>';
    else
        echo "<script>alert('备份成功！');location.reload();</script>";
}
#恢复SQL
#配置变量
$smarty->assign("fileArr", $fileArr);
#模板配置
$smarty->assign(array("title" => $title, "css" => httpPath . "css/main.css", "httpPath" => httpPath));
$smarty->display("SQL/SQLManage.tpl");
?>
