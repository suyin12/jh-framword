<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <title>文件上传</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    选择文件:<input type="file" name="myFile">
    <input type="submit" name="sub" value="提交">
</form>
</body>
</html>