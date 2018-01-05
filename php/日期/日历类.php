<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
    <style>
        table{border:1px solid #050;border-collapse:collapse;}
        .fontb{color:white;background:orangered;}
        th{border:1px solid #050;width:30px;}
        td,th{border:1px solid #050;height:30px;text-align:center}

        /*form{margin:0;padding:0}*/
    </style>
</head>
<body>
<?php
    require_once 'Calendar.class.php';
    echo new Calendar;
?>
</body>
</html>