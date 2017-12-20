<!DOCTYPE html>
<html>
<head>
    <title>phpInfo</title>
</head>
<body>
<?php
    $sysos = $_SERVER['SERVER_SOFTWARE'];//获取服务器标识的字符串
    $phpVersion = PHP_VERSION;           //获取php服务器版本

    //连接mysql数据库和获取mysql服务器信息
    $con = mysqli_connect("127.0.0.1","root","123456");
    $mysqlInfo = mysqli_get_server_info($con);

    //从服务器获取GD库信息
    if(function_exists('gd_info')){
        $gd = gd_info();
        $gdInfo = $gd['GD Version'];
    }else{
        $gdInfo = '未知';
    }

    //查看是否支持FreeType字体
    $freeType = $gd['FreeType Support']?'支持':'不支持';

    //从php配置中查看是否可以远程获取文件
    $allowurl = ini_get('allow_url_fopen')?'支持':'不支持';

    //查看上传最大限制
    $max_upload = ini_get('file_uploads')?ini_get('upload_max_filesize'):'Disable';

    //获得脚本最大执行时间
    $max_ex_time = ini_get('max_execution_time').'秒';

    //获取服务器时间
    $datetime = date('Y-m-d H:i:s',time());

    echo 'Web服务器-----'.$sysos."<br />";
    echo 'PHP版本-----'.$phpVersion."<br />";
    echo 'MySQL版本-----'.$mysqlInfo."<br />";
    echo 'GD库版本-----'.$gdInfo."<br />";
    echo 'FreeType-----'.$freeType."<br />";
    echo '远程文件获取-----'.$allowurl."<br />";
    echo '最大上传限制-----'.$max_upload."<br />";
    echo '脚本最大执行时间-----'.$max_ex_time."<br />";
    echo '服务器时间-----'.$datetime."<br />";
?>
</body>
</html>