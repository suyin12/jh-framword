{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.6.2.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.validationEngine-zh_CN.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.validationEngine.js></script>
{literal}
    <script type="text/javascript">
            $(document).ready(function(){
                 // binds form submission and fields to the validation engine
                     $("#initForm").validationEngine('attach', {promptPosition : "centerRight", autoPositionUpdate : true});
                                   
            });
    </script>
{/literal}
<div id="main">
    <fieldset class="center halfWidth">
        <legend><code>系统使用登记</code></legend>
        <form id="initForm" method="POST">
            <dl class="myTable">
                <dt>服务编号</dt><dd>NO.{$serverID}</dd>
                <dt>公司名称</dt><dd><input type="text" name="serverCompany" size="40" class="validate[required]" value="{$serverCompany}"><span class="red">*</span></dd>
                <dt>公司网址</dt><dd><input type="text" name="serverUrl" size="40" class="validate[custom[url]]" value="{$serverUrl}"></dd>
                <dt>联系人</dt><dd><input type="text" name="contact"  class="validate[required]" value="{$exRet.contact}"><span class="red">*</span></dd>
                <dt>联系电话</dt><dd><input type="text" name="phone"  class="validate[required]" value="{$exRet.phone}"><span class="red">*</span></dd>
                <dt>QQ</dt><dd><input type="text" name="QQ" class="validate[custom[onlyNumberSp]]" value="{$exRet.QQ}"></dd>
                <dt>社保截止申报日</dt><dd>每月<input type="text" name="soInsInTurn" class="validate[required,custom[integer],min[1],max[31]]]" size="3" value="{$insuranceInTurnArr.soIns}">号<span class="red">*</span>(深圳地区建议不修改)</dd>
                <dt>公积金截止申报日</dt><dd>每月<input type="text" name="HFInTurn" class="validate[required,custom[integer],min[1],max[31]]]" size="3" value="{$insuranceInTurnArr.HF}">号<span class="red">*</span>(深圳地区建议不修改)</dd>
                <dt>商保起始申报日</dt><dd>每月<input type="text" name="comInsInTurn" class="validate[required,custom[integer],min[1],max[31]]]" size="3" value="{$insuranceInTurnArr.comIns}">号<span class="red">*</span>(深圳地区建议不修改)</dd>
                <dt>业务报表结算日</dt><dd>每月<input type="text" name="performanceInTurn" class="validate[required,custom[integer],min[1],max[31]]]" size="3" value="{$insuranceInTurnArr.performance}">号<span class="red">*</span>(深圳地区建议不修改)</dd>
                <dt>社保账户</dt><dd><input type="text" name="soInsID" class="validate[required,custom[onlyNumberSp]]" size="40" value="{implode(",",$insuranceIDArr.soIns)}"><span class="red">*</span>(多个账户用逗号隔开)</dd>
                <dt>公积金账户</dt><dd><input type="text" name="HFID" class="validate[required,custom[onlyNumberSp]]" size="40" value="{implode(",",$insuranceIDArr.HF)}"><span class="red">*</span>(多个账户用逗号隔开)</dd>
                <dt>房屋编码</dt><dd><input type="text" name="houseNumberID" class="validate[custom[number]]" size="40" value="{$insuranceIDArr.houseNumber}">(办理就业登记及居住证)</dd>
            </dl>
                <p style="text-align: center;"><input type="submit" name="initSub" value="确定" /></p>
        </form>
        {$showWindow}
    </fieldset>
</div>
{include file="footer.tpl"}
