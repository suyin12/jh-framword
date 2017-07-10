安装步骤：

1、把当前目录下所有文件上传到服务器上

2、把Data,Runtime,Uploads目录权限设置为程序可读写权限，如果使用后台自动创建插件功能，还需要把Addons目录也设置为可读写

3、把当前目录下的install.sql文件导入数据库

4、把Application\Common\Conf\config.php文件里的数据库连接参数修改为自己的参数

此至网站安装完毕