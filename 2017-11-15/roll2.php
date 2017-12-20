<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>roll</title>
    <style>
        .table-a {
            margin:100px auto;border:1px solid #000;width:200px;height:320px
        }
        table {
            margin:20px auto;width:200px;height:300px
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="table-a">
    <h1 style="text-align: center"></h1>
    <table>
        <?php
            foreach($ret as $value){
                echo "<tr><td>".$value."</td></tr>";
            }
        ?>
        <tr><td><button id="roll" onclick="location.reload();">动</button></td></tr>
    </table>
</div>
<script>

</script>
</body>
</html>