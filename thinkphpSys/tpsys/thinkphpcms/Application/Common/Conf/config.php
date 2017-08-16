<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'thinkphpsys',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'a_',    // 数据库表前缀

    //'配置项'=>'配置值'
    '__ROOT__'      =>  __ROOT__,       // 当前网站地址
    '__APP__'       =>  __APP__,        // 当前应用地址
    '__MODULE__'    =>  __MODULE__,
    '__ACTION__'    =>  __ACTION__,     // 当前操作地址
    '__SELF__'      =>  htmlentities(__SELF__),       // 当前页面地址
    '__CONTROLLER__'=>  __CONTROLLER__,
    '__URL__'       =>  __CONTROLLER__,
    '__PUBLIC__'    =>  __ROOT__.'/Public',// 站点公共目录

);

