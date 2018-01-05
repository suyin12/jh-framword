<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>验证码使用</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_POST['submit'])){
            if(strtoupper($_POST['code']) == $_SESSION['code']){
                echo '验证码输入正确'.'<br/>';
            }else{
                echo '验证码错误!'.'<br/>';
            }
        }
    ?>
    <img src="imgcode.php" alt="换一张" onclick="newgdcode(this,this.src)">
    <form action="" method="post">
        <input type="text" name="code" placeholder="验证码" />
        <input type="submit" name="submit" value="提交" />
    </form>
    <script>
        function newgdcode(obj,url){
            obj.src = url+'?nowtime='+new Date().getTime();
        }
    </script>
</body>
</html>