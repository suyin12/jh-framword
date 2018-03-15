<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>文件的锁定机制</title>
</head>
<body>
<?php
    $dir = __DIR__;
    $filename = "message.txt";
    $contents = "";
    if(isset($_POST["sub"])){
        if(isset($_POST["title"]) && isset($_POST["username"]) && isset($_POST["contents"])){
            $contents = $_POST["username"]."||".$_POST["title"]."||".$_POST["contents"]."|||";
            putMess($dir."/".$filename,$contents);
        }
    }

    if(file_exists($dir."/".$filename)){
        getMess($dir."/".$filename);
    }

    function putMess($file,$contents){
        $fp = fopen($file,"a") or die("文件打开失败!");
        if(flock($fp,LOCK_EX)){
            fwrite($fp,$contents);
            flock($fp,LOCK_UN);
        }else{
            echo "文件锁定失败";
        }

        fclose($fp);
    }
    function getMess($file){
        $fp = fopen($file,"r") or die("文件打开失败!");
        flock($fp,LOCK_SH);
        $contents = "";
        while(!feof($fp)){
            $contents .= fgets($fp,1024);
        }
        flock($fp,LOCK_UN);
        fclose($fp);

        $data = explode("|||",$contents);
        $data = array_filter($data);
        foreach($data as $content){
            if($content !== ''){
                list($username,$title,$mess) = explode('||',$content);
                if($username != ""&&$title != ""&&$contents != ""){
                    echo $username."说:";
                    echo $title;
                    echo $mess."<br>";
                }
            }

        }

    }
?>
<form action="" method="post">
    用户名:<input type="text" name="username" /><br />
    标&nbsp;&nbsp;&nbsp;题:<input type="text" name="title" /><br />
    <textarea rows="5" cols="50" name="contents"></textarea><br />
    <input type="submit" name="sub" value="留言">
</form>
</body>
</html>