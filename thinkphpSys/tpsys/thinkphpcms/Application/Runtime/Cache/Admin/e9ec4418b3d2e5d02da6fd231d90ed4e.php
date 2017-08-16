<?php if (!defined('THINK_PATH')) exit();?>
<style>
</style>

<body>
<form action="<?php echo U('Wap/loginDo');?>" method="post">
    <div>
        <div>用户名:</div><input name="userName" type="text" /><br>
        <div>密码:</div><input type="password" /><br>
        <div><input type="submit" value="登录" /></div>
    </div>
</form>