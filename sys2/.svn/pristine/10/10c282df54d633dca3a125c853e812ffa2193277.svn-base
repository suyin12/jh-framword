{include file="w/header.tpl"}
<script type="text/javascript" src={$httpPath}theme/lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}theme/lib/js/validation/jquery.validationEngine.js></script>
<script type="text/javascript" src={$httpPath}theme/lib/js/validation/jquery.validationEngine-zh_CN.js></script>
{literal}
<script>
    $(document).ready(function () {
        $("#passForm").validationEngine();
    });
</script>
{/literal}
<div id="main">
    <div class="ym-wrapper">
        <div class="ym-wbox">
            <form method="post" class="pre-form" id="passForm">
                <table class="bordertable">
                    <tr>
                        <td>用户名：</td>
                        <td><input type="hidden" name="wID" value="{$user.wID}"/>
                        {$user.mName}
                        </td>
                    </tr>

                    <tr>
                        <td>原密码：</td>
                        <td><input type="password" name="oldpass" class="validate[required]"/></td>
                    </tr>

                    <tr>
                        <td>新密码：<span>(5-20位)</span></td>
                        <td><input type="password" name="newpass" id="newpass" class="validate[required,minSize[5]]"/></td>
                    </tr>
                    <tr>
                        <td>请确认新密码：<span>(5-20位)</span></td>
                        <td><input type="password" name="newpass2" id="newpass2" class="validate[required,equals[newpass],minSize[5]]"/></td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="changepass" value="确定"/></td>
                        <td></td>
                    </tr>
                </table>
            </form>

        </div>
    </div>
</div>
{include file="footer.tpl"}