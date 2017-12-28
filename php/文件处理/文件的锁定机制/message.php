<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>留言板</title>
</head>
<body>
<?php
    $fileName = __DIR__.'/'.'data.txt';

    if(isset($_POST['sub'])){
        $message = $_POST['username'].'||'.$_POST['title'].'||'.$_POST['mess'].'<|>';
        writeMessage($fileName,$message);
    }

    if(file_exists($fileName)){
        readMessage($fileName);
    }

    function writeMessage($fileName,$message){
        $fp = fopen($fileName,'a') or die('文件打开失败!');
        if(flock($fp,LOCK_EX)){
            fwrite($fp,$message);
            flock($fp,LOCK_UN);
        }else{
            echo '不能锁定文件!';
        }
        fclose($fp);
    }
    //读取文件内容
    function readMessage($fileName){
        $fp = fopen($fileName,'r') or die('文件打开失败!');
        //建立文件共享锁定
        flock($fp,LOCK_SH);
        $str = '';
        while(!feof($fp)){
            $str .= fread($fp,1024);
        }

        $arr = explode('<|>',$str);

        foreach($arr as $value){
            if(!empty($value)){
                list($username,$title,$contents) = explode('||',$value);
                echo $username.'说,';
                echo '&nbsp;'.'<font color=red size=3>,'.$title.'</font>';
                echo ','.$contents.'<hr/>';
            }

        }
        //释放锁定
        flock($fp,LOCK_UN);
        //关闭文件资源
        fclose($fp);
    }
?>
<form action="" method="post">
    用户名:<input type="text" size="10" name="username" autofocus><br>
    标题:<input type="text" size="10" name="title"><br>
    <textarea name="mess" rows="4" cols="40" placeholder="请输入留言信息!"></textarea>
    <input type="submit" name="sub" value="留言">
</form>
</body>
</html>