{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/lefttree.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
    <script type="text/javascript">

    $(document).ready(function(){
        $("input[name=updateArchive]").click(function(){

                        var t,u,d,dt,m;
                        t = "post";
                        u = "aSQL.php";
                        d = $("#updateArchiveForm").serialize();
                        dt = "json";
                        m = function(json){
                        var i, n, k, v;
                        $.each(json, function(i, n){
                            switch (i) {
                                case "error":
                                    alert(n);
                                    break;
                                case "succ":
                                    alert(n);
                                    window.location.reload();
                                    break;
                            }
                              });
                          };
                                successfunc = function(){
                                        ajaxAction(t,u,d + "&btn=updateArchive",dt,m);
                                };

                        validator("input[name=updateArchive]","#updateArchiveForm","#errorDiv",successfunc);

        });
    });
    </script>

{/literal}
<div id="main">

    <fieldset>
        <form id="updateArchiveForm" class="form">
            <input type="hidden" name="id" value='{$smarty.get.id}' />
            <p>类别：<select name="type" disabled>{html_options options=$c_type_opt selected=$the_archive.type}</select></p><br />
            <p>姓名：<input type="text" name="name" value="{$the_archive.name}" />	
                性别：<select name="sex">{html_options options=$c_sex selected=$the_archive.sex}</select>	
                身份证号：<input type="text" name="idcard" value="{$the_archive.idcard}" /></p>
            <br />
            <p>联系方式：<input type="text" name="tel1" value="{$the_archive.tel1}" />
                <input type="text" name="tel2" value="{$the_archive.tel2}" />
                <input type="text" name="tel3" value="{$the_archive.tel3}" /></p>
            <br />

            {if $the_archive.type eq 1 || $the_archive.type eq 2 || $the_archive.type eq 3}
                <p>来档单位：
                {else}
                <p>托管地点：
                {/if}
                <input type="text" name="fromunit" value="{$the_archive.fromUnit}" />

                {if $the_archive.type eq 1}
                    用工单位：
                {elseif $the_archive.type eq 2}
                    代理单位：
                {else}
                    工作单位：
                {/if}
                <input type="text" name="workunit" value="{$the_archive.workUnit}" /></p>
            <br />
            {if $the_archive.type eq 1 || $the_archive.type eq 2 }
                <p>客户经理：<select name="manager" >{html_options options=$managers selected=$the_archive.manager}</select>
                    是否办理就业登记：<select name="manager">{html_options options=$yesno selected=$the_archive.jobRegister}</select></p>
                {elseif $the_archive.type eq 3 }
                <p>紧急联系人：<input type="text" name="urgentContactor" value="{$the_archive.urgentContactor}" />
                    紧急联系人电话：<input type="text" name="urgentContactorTel" value="{$the_archive.urgentContactorTel}" /> </p>
                {else}
                <p>
                    户政业务类别：<select name="huzhengType" >{html_options options=$huzheng_type selected=$the_archive.huzhengType}</select>
                    <br /><br />
                    用工单位联系人：<input type="text" name="unitContactor" value="{$the_archive.unitContactor}" />
                    用工单位联系人电话：<input type="text" name="unitContactorTel" value="{$the_archive.unitContactorTel}" /></p>
                {/if}
            <br />
            {if $the_archive.type eq 1 || $the_archive.type eq 2 || $the_archive.type eq 3}
                <p>档案编号：
                {else}
                <p>协议编号：
                {/if}
                <input type="text" name="fileNumber" value="{$the_archive.fileNumber}" /></p>
            <br />

            {if $the_archive.type eq 2 || $the_archive.type eq 3 || $the_archive.type eq 4}
                托管日期：<input type="text" name="manageDate" value="{$the_archive.manageDate}" />
                单价：<input type="text" name="feeprice" value="{$the_archive.feePrice}" />
                <br />
                缴费历史：
                <br />

            {/if}
            <input name="updateArchive" type="button" value="更新"/>

            <div id="errorDiv" class="error-div-alternative"></div>


        </form>




    </fieldset>

</div>
{include file="footer.tpl"}