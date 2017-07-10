{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
{literal}
<script type="text/javascript">
    $(document).ready(function () {
        $("input[name=updateTalent]").click(function () {
            var t, u, d, dt, m;
            t = "post";
            u = "mSQL.php";
            d = $("#updatetalentForm").serialize() + "&btn=updateTalent";
            dt = "json";

            m = function (json) {
                $.each(json, function (i, n) {
                    var i, n;
                    switch (i) {
                        case "success":
                            alert(n);
                            window.location.reload();
                            //window.location.href = "tInfo.php?&page=" + page;
                            break;
                        case "error":
                            alert(n);
                            break;
                    }
                });
            };
            successFun = function () {
                ajaxAction(t, u, d, dt, m);
            };
            validator("input[name=updateTalent]", "#updatetalentForm", "#errorDiv", successFun);
        });


        // 单位岗位二级联动
        $("select[name=unitID]").change(function () {
            var j_d = $(".j_unitPositionArr").val();
            j_d = eval(j_d);

            $.each(j_d, function (i, n) {
                if ($("select[name=unitID]").val() == n.unitID) {
                    $("select[name=positionID] option:not(:eq(0))").remove();
                    $.each(n.position, function (j, v) {
                        $("select[name=positionID]").append("<option value=" + v.positionID + ">" +
                                v.name +
                                "</option>");
                    });

                }
                if (!$("select[name=unitID]").val()) {
                    $.each(n.position, function (j, v) {
                        $("select[name=positionID]").append("<option value=" + v.positionID + ">" +
                                v.name +
                                "</option>");
                    });
                }
            });
        });
        //培训项目通过提交
        $(".trainChkSub").each(function (i) {
            $(this).click(function () {
                var chkType = $(this).val();
                var talentArr = $(this).attr("alt");
                var lineIndex = $(this).attr("lineIndex");
                $("input[name='remarks[]']").attr("disabled", true);
                $("input[name='remarks[]']").attr("class", "");
                $("input[name='remarks[]']").eq(lineIndex).attr("disabled", false);
                $("input[name='remarks[]']").eq(lineIndex).attr("class", "supernote-click-remarks" + chkType);
                if (!IsEmpty($(this).attr("checked"))) {
                    var ck = "1";
                } else {
                    var ck = "0";
                }
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "tSQL.php";
                d = "checkType=" + chkType + "&btn=" + btnName + "&ck=" + ck + "&talentArr=" + talentArr;
                dt = "json";
                m = function (json) {
                    var i, n, k, v;
                    $.each(json, function (i, n) {
                        switch (i) {
                            case "error":
                                alert(n);
                                break;
                            case "succ":

                                break;
                        }
                    });
                };
                ajaxAction(t, u, d, dt, m);
            });
        });
        //资料提交情况
        $(".materialChkSub").each(function (i) {
            $(this).click(function () {
                var chkType = $(this).val();
                var talentArr = $(this).attr("alt");
                var lineIndex = $(this).attr("lineIndex");
                $("input[name='remarks[]']").attr("disabled", true);
                $("input[name='remarks[]']").attr("class", "");
                $("input[name='remarks[]']").eq(lineIndex).attr("disabled", false);
                $("input[name='remarks[]']").eq(lineIndex).attr("class", "supernote-click-remarks" + chkType);
                if (!IsEmpty($(this).attr("checked"))) {
                    var ck = "1";
                } else {
                    var ck = "0";
                }
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "tSQL.php";
                d = "checkType=" + chkType + "&btn=" + btnName + "&ck=" + ck + "&talentArr=" + talentArr;
                dt = "json";
                m = function (json) {
                    var i, n, k, v;
                    $.each(json, function (i, n) {
                        switch (i) {
                            case "error":
                                alert(n);
                                break;
                            case "succ":

                                break;
                        }
                    });
                };
                ajaxAction(t, u, d, dt, m);
            });
        });
        //资料完整性变更情况
        $(".materialCompleteChkSub").each(function (i) {
            $(this).click(function () {
                var chkType = $(this).val();
                var talentArr = $(this).attr("alt");
                var lineIndex = $(this).attr("lineIndex");
                $("input[name='remarks[]']").attr("disabled", true);
                $("input[name='remarks[]']").attr("class", "");
                $("input[name='remarks[]']").eq(lineIndex).attr("disabled", false);
                $("input[name='remarks[]']").eq(lineIndex).attr("class", "supernote-click-remarks" + chkType);
                if (!IsEmpty($(this).attr("checked"))) {
                    var ck = "1";
                } else {
                    var ck = "0";
                }
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "tSQL.php";
                d = "checkType=" + chkType + "&btn=" + btnName + "&ck=" + ck + "&talentArr=" + talentArr;
                dt = "json";
                m = function (json) {
                    var i, n, k, v;
                    $.each(json, function (i, n) {
                        switch (i) {
                            case "error":
                                alert(n);
                                break;
                            case "succ":

                                break;
                        }
                    });
                };
                ajaxAction(t, u, d, dt, m);
            });
        });


        //网上办公相关操作
        $(".webSub").click(function(){
            var formID = this.form.id;
            var btnName = $(this).attr("name")
            var t, u, d, dt, m;
            t = "post";
            u = "mSQL.php";
            d = "talentArr="+$(this).attr('alt') + "&btn=" + btnName ;
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
            var ret = confirm("确定" + $(this).val() + "?");
            if (ret == true) {
                ajaxAction(t, u, d, dt, m);
            }
        });
    });

</script>
{/literal}
<div id="main">
<fieldset>
<p><a class="noSub" href="tInfo.php">返回人才管理</a></p>
<input type="hidden" class="j_unitPositionArr" value='{$j_unitPositionArr}'>
<fieldset>
<legend><code>个人信息</code></legend>
<div class="halfWidth left">
    <form name="updatetalentForm" id="updatetalentForm" class="form">
        <p class="notice">基本信息更新</p>
        <li>
            <lable>姓名</lable>
            <input type="hidden" name="talentID" value="{$talent.talentID}"/>
            <input type="text" name="name" value="{$talent.name}" class="req-string"/>
        </li>
        <li>
            <lable>性别</lable>
            <select name="sex">
                <option value="">------请选择------</option>
            {html_options values=$sex_value output=$sex_label selected=$talent.sex}
            </select>
        </li>
        <li>
            <lable>身份证号</lable>
            <input type="text" name="idcard" value="{$talent.idCard}"/>
        </li>
        <li>
            <lable>专业</lable>
            <input type="text" name="major" value="{$talent.major}"/>
        </li>
        <li>
            <lable>学历</lable>
            <select name="education">
                <option value="">------请选择------</option>
            {html_options values=$edu_value output=$edu_label selected=$talent.education}
            </select>
        </li>
        <li>
            <lable>联系电话</lable>
            <input type="text" name="telephone" class="req-string req-numeric req-length" length="11"
                   value="{$talent.telephone}"/>
        </li>
        <li>
            <lable>来源市场</lable>
            <select name="market" class="req-string">
            {foreach from=$marketArr item=val}
                    {html_options values=$val.marketID output=$val.name selected=$talent.marketID}
                {/foreach}
            </select>
        </li>


        <li>
            <lable>用工单位</lable>
            <select name="unitID" class="req-string req-numeric" style="width:150px">
                <option value="">------请选择--------</option>
            {foreach from = $unitPositionArr item = val}
                {html_options    values=$val.unitID output= $val.unitName|replace:"深圳市":'' selected= $talent.unitID}
            {/foreach}
            </select>
        </li>

        <li>
            <lable>应聘岗位</lable>
            <select name="positionID" class="req-string req-numeric" style="width:150px">
                <option value="">-------请选择------</option>
            {foreach from= $unitPositionArr item= val key=key }
                {if $talent.unitID}
                    {foreach from= $val    item=u key= k}
                        {if  $k eq "position" && $val['unitID'] eq $talent.unitID}
                            {foreach from= $u item= m key= n}
                                {html_options values= $m.positionID output=$m.name selected=$talent.positionID}
                            {/foreach}
                        {/if}
                    {/foreach}
                    {else}
                    {foreach from= $val    item=u key= k}
                        {if  $k eq "position"}
                            {foreach from= $u item= m key= n}
                                {html_options values= $m.positionID output=$m.name selected=$talent.positionID}
                            {/foreach}
                        {/if}
                    {/foreach}
                {/if}
            {/foreach}
            </select></li>
        <li>
            <lable>意向区域</lable>
            <input type="text" name="wantedArea" value="{$talent.wantedArea}"/></li>
        <li>
            <lable>驾照类型</lable>
            <input type="text" name="lisence" value="{$talent.lisence}"/></li>
        <li>
            <lable>合格状态</lable>
            <select name="status" id="status">
            {foreach from=$statusToCHNArr item=val key=key}
                {html_options values=$key output=$val.name selected=$talent.status}
            {/foreach}
            </select>
        </li>
        <li>
            <lable>招聘人员</lable>
            <select name="recruitManagerId" class="req-string req-numeric" style="width:150px">
                <option value="">------请选择------</option>
            {foreach from =$userArr item=val key=key}
                {html_options values=$key output=$val.mName selected=$talent.recruitManagerId}
            {/foreach}
            </select>
        </li>
        <li>
            <lable>创建时间</lable>
            <input type="text" name="createdOn" value="{$talent.createdOn}"/>
        </li>
        <li>
            <lable>备注</lable>
            <textarea rows="6" name="remarks">{$talent.remarks}</textarea>
        </li>
        <li><input type="button" name="updateTalent" value="更新"/></li>
        <div id="errorDiv" class="error-div-alternative">
        </div>
    </form>
</div>
<div class="halfWidth right">
    <form class="form">
        <p class="notice">培训情况登记 </p>
    {if array_key_exists($talent.talentID,$newTrainMarksArr)}
        {foreach from=$needTrainArr[$talent.positionID] item=nval key=nkey}
            {assign var='checked' value="unchecked"}
            {assign var='marksRemarks' value=''}
            {assign var='createdOn' value=''}
            {foreach from=$newTrainMarksArr[$talent.talentID] item=rval }
                {if $rval['trainClassicID'] == $nval.ID}
                    {assign var='marksRemarks' value=$rval.remarks}
                    {assign var='createdOn' value=$rval.createdOn}
                    {if $rval['marksStatus'] =="1"}
                        {assign var='checked' value="checked"}
                        {break}
                        {else}
                        {assign var='checked' value="unchecked"}
                        {break}
                    {/if}
                {/if}
            {/foreach}
            <input name="trainStatus[]" class="trainChkSub" lineIndex="{$smarty.foreach.foo.index}"
                   value="{$talent.status}" alt="{$nval.ID}|{$talent.talentID}|7|{$talent.positionID}"
                   type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}(<span
                class="red">{$marksRemarks}--{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        {/foreach}
        {else}
        {foreach from=$needTrainArr[$talent.positionID] item=nval key=nkey}
            <input name="trainStatus[]" class="trainChkSub" lineIndex="{$smarty.foreach.foo.index}"
                   value="{$talent.status}" alt="{$nval.ID}|{$talent.talentID}|7|{$talent.positionID}"
                   type="checkbox"/> {$nval.name}<br/>
        {/foreach}
    {/if}
        <p class="notice">交资料情况登记 </p>

    {if array_key_exists($talent.talentID,$newRecruitMarksArr)}
        {foreach from=$needMaterialArr[$talent.positionID] item=nval key=nkey}
            {assign var='checked' value="unchecked"}
            {assign var='marksRemarks' value=''}
            {assign var='createdOn' value=''}
            {foreach from=$newRecruitMarksArr[$talent.talentID] item=rval }
                {if $rval['trainClassicID'] == $nval.ID}
                    {assign var='marksRemarks' value=$rval.remarks}
                    {assign var='createdOn' value=$rval.createdOn}
                    {if $rval['marksStatus'] =="1"}
                        {assign var='checked' value="checked"}
                        {break}
                        {else}
                        {assign var='checked' value="unchecked"}
                        {break}
                    {/if}
                {/if}
            {/foreach}
            <input name="materialStatus[]" class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"
                   alt="{$nval.ID}|{$talent.talentID}|99|{$talent.positionID}"
                   type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}(<span
                class="red">{$marksRemarks}{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        {/foreach}
        {else}
        {foreach from=$needMaterialArr[$talent.positionID] item=nval key=nkey}
            <input name="materialStatus[]" class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"
                   alt="{$nval.ID}|{$talent.talentID}|99|{$talent.positionID}" type="checkbox"/> {$nval.name}<br/>
        {/foreach}
    {/if}


        <p class="notice">辅助项 </p>

    {if array_key_exists($talent.talentID,$newRecruitMarksArr)}
        {foreach from=$needWaitArr[$talent.positionID] item=nval key=nkey}
            {assign var='checked' value="unchecked"}
            {assign var='marksRemarks' value=''}
            {assign var='createdOn' value=''}
            {foreach from=$newRecruitMarksArr[$talent.talentID] item=rval }
                {if $rval['trainClassicID'] == $nval.ID}
                    {assign var='marksRemarks' value=$rval.remarks}
                    {assign var='createdOn' value=$rval.createdOn}
                    {if $rval['marksStatus'] =="1"}
                        {assign var='checked' value="checked"}
                        {break}
                        {else}
                        {assign var='checked' value="unchecked"}
                        {break}
                    {/if}
                {/if}
            {/foreach}
            <input name="materialStatus[]" class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"
                   alt="{$nval.ID}|{$talent.talentID}|99|{$talent.positionID}"
                   type="checkbox"  {$checked} /> {$nval.name}{if $marksRemarks||$createdOn}
            (<span class="red">{$marksRemarks}{$createdOn|date_format:"%m/%d"}</span>){/if} <br/>
        {/foreach}
        {else}
        {foreach from=$needWaitArr[$talent.positionID] item=nval key=nkey}
            <input name="materialStatus[]" class="materialChkSub" lineIndex="{$smarty.foreach.foo.index}"
                   alt="{$nval.ID}|{$talent.talentID}|99|{$talent.positionID}" type="checkbox"/> {$nval.name}<br/>
        {/foreach}
    {/if}
        <p class="notice">备注事项 </p>
    {foreach item=remarkVal from=$recruitNotesArr}
        {if $remarkVal.talentID eq $talent.talentID && $remarkVal.remarks}
            {$remarkVal.remarks} -({$remarkVal.status})
            {$userArr[$remarkVal.createdBy].mName}  {$remarkVal.createdOn|date_format:"%m/%d"}<br>
        {/if}
    {/foreach}
    </form>
</div>
</fieldset>
<fieldset>
    <legend><code>网上办公相关</code></legend>
    <div class="halfWidth">
        <p class="notice">账号相关(注:密码重置,默认为"手机号码") </p>
        <form class="form">
            <table  class="myTable" width="100%">
                <tr>
                    <td><label>账号状态:</label></td>
                    <td><label><b class="red">{$talent.webAccountStatusName|default:"未开通"}</b> </label></td>
                    <td><label><input type="button" class="webSub" name="activeOrBan" alt="{$talent.talentID}|{$talent.webAccountStatus}" value="开通/禁用"></label></td>
                    <td><label><input type="button" class="webSub" name="resetPW" alt="{$talent.talentID}" value="密码重置"></label></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><label><a class="aSub positive" href="{$httpPath}web/w/wInput.php?t={$talent.talentID}&w={$talent.wID}">修改登记个人信息</a></label></td>
                    <td><label><a class="aSub positive" href="{$httpPath}web/w/wPrint.php?t={$talent.talentID}&w={$talent.wID}">打印</a></label></td>
                </tr>
            </table>
        </form>
        <p></p>
    </div>
</fieldset>
</fieldset>
</div>
{include file="footer.tpl"}
