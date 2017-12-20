<?php ini_set('display_errors','off')?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="str" value="<?php echo html2Text($_POST['str']);?>"/>
    <input type="submit" name="submit" value="提交" />
</form>
<?php
    if(isset($_POST['submit'])){
        echo "原型输出".$_POST['str'];echo "<br>\n";
        echo "转换实体".htmlspecialchars($_POST['str'],3);echo "<br>\n";
        echo "删除反斜线和实体".html2Text($_POST['str']);echo '<br>\n';
    }
    function html2Text($input){
        return htmlspecialchars(stripslashes($input));
    }
?>
</body>
</html>