<?php if (!defined('THINK_PATH')) exit();?>
<style>
</style>

<body>
<form action="<?php echo U('registerDo');?>">
    <div>
        <div>用户名:</div><input type="text" /><br>
        <div>密码:</div><input type="password" /><br>
        <div>qq邮箱:</div><input type="text" /><br><p>用于找回密码</p><br>
        <div><input type="submit" value="注册" /></div>
    </div>
</form>