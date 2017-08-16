<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>项目</title>
    <link rel="stylesheet" href=""/>
    <link rel="stylesheet" href=""/>
    <link rel="stylesheet" href=""/>

    <script type="text/javascript">

    </script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src=""></script>
</head>
<script>
    $(function(){
//        getSelectVal();
        $("#province").change(function(){
            getSelectVal();
        });
    });
        function getSelectVal(){
//        $.getJSON("<?php echo U('userPowers');?>",{provinceid:$("#province").val()},function(JSON){
//            var samllName = $("#samllName");
//            $("option",samllName).remove();//清空
            var JSON = [["name","1","age","18"],["name","1","age","18"]];
//            alert(JSON);
            $.each(JSON,function(index,array){
                var option = "<option value= '"+index+"'>"+array['']+"</option>";
                samllName.append(option);
            });

//        });
    }

</script>

<style>
</style>

<body>
<label>省份</label>
<select name="province" id="province">
    <?php if(is_array($provinces)): foreach($provinces as $key=>$vo): ?><option value="<?php echo ($vo['provinceid']); ?>"><?php echo ($vo['province']); ?></option><?php endforeach; endif; ?>
</select>
<lable>直辖市(县,区)</lable>
<select name="smallName" id="smallName">
</select>