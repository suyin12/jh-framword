{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js>
</script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/supernote.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>
{literal}
    <script type="text/javascript">


        /* jQuery plugins supernote START  */
        var supernote = new SuperNote('supernote', {});
        function animFade(ref, counter) {
            var f = ref.filters, done = (counter == 1);
            if (f) {
                if (!done && ref.style.filter.indexOf("alpha") == -1)
                    ref.style.filter += ' alpha(opacity=' + (counter * 100) + ')';
                else if (f.length && f.alpha)
                    with (f.alpha) {
                        if (done)
                            enabled = false;
                        else {
                            opacity = (counter * 100);
                            enabled = true
                        }
                    }
            }
            else
                ref.style.opacity = ref.style.MozOpacity = counter * 0.999;
        }
        ;
        supernote.animations[supernote.animations.length] = animFade;
        addEvent(document, 'click', function (evt) {
            var elm = evt.target || evt.srcElement, closeBtn, note;
            while (elm) {
                if ((/note-close/).test(elm.className))
                    closeBtn = elm;
                if ((/snb-pinned/).test(elm.className)) {
                    note = elm;
                    break
                }
                elm = elm.parentNode;
            }
            if (closeBtn && note) {
                var noteData = note.id.match(/([a-z_\-0-9]+)-note-([a-z_\-0-9]+)/i);
                for (var i = 0; i < SuperNote.instances.length; i++)
                    if (SuperNote.instances[i].myName == noteData[1]) {
                        setTimeout('SuperNote.instances[' + i + '].setVis("' + noteData[2] +
                                '", false, true)', 100);
                        cancelEvent(evt);
                    }
            }
        });
        addEvent(supernote, 'show', function (noteID) {
        });
        addEvent(supernote, 'hide', function (noteID) {
        });
        /* jQuery plugins supernote END  */

        $(document).ready(function () {

            // 全选/反选
            $('#CK').click(function () {
                if ($(this).attr('checked') == true) {
                    $(".ckb").attr('checked', true);
                }
                else {
                    $('.ckb').attr('checked', false);
                }
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
            // 人才信息查询
            $("input[name=c]").one("click", function () {
                $(this).val("");
            });
            // 将人才移入废纸篓
            $("#toggleTalents").click(function () {
                var t, u, d, dt, m;
                t = "post";
                u = "mSQL.php";
                d = $("form[name=talentinfoForm]").serialize();
                dt = "json";
                m = function (json) {
                    var i, n;
                    $.each(json, function (i, n) {
                        switch (i) {
                            case "error":
                            case "error2":
                                alert(n);
                                break;
                            case "success":
                                alert(n);
                                window.location.reload();
                                break;
                        }

                    });
                };
                if (d)
                    ajaxAction(t, u, d + "&btn=toggleTalents", dt, m);
                else
                    alert("您未选择任何记录，无法更新！");

            });


            // 保存备注
            $(".editTd").editable("mSQL.php", {
                type: "textarea",
                submit: "确定",
                rows: "5",
                cols: "40",
                data: function () {
                    var content = $(this).attr("title");
                    return content;
                },
                submitdata: function () {
                    var talentID = $(this).attr("alt");
                    return {
                        talentID: talentID,
                        btn: "saveremarks"
                    };
                },
                event: "click",
                onblur: "cancel",
                placeholder: "",
                ajaxoptions: {
                    dataType: "json"
                }
            });


            // 导出选中到excel
            $("input[name=excelout2]").click(function () {

                $("#talentinfoForm").attr("action", "tinfoexcelout.php");
                $("#talentinfoForm").submit();
            });

        });
    </script>
{/literal}
<div id="main">
    <a class="noSub positive" href="tInsert.php">添加人才</a>

    <fieldset>
        <legend><code>查询条件</code></legend>
        <input type="hidden" class="j_unitPositionArr" value='{$j_unitPositionArr}'>

        <form method="GET" class="form" id="wSForm" action={$actionURL}>
            <table height="70" border="0" width="70%">
                <tr>
                    <td>
                        <strong>条件</strong>
                        <select name="m" class="req-string">
                            {html_options options=$model selected=$s_m}
                        </select>
                        <input type="text" name="c" value="{$s_c}"/>
                    </td>
                    <td colspan="3"><input type="submit" name="wS" value="查询"/><input type="reset" name="reset"
                                                                                      value="重置"/></td>
                </tr>
                <tr>
                    <td><strong>单位</strong>
                        <select name="unitID">
                            <option value="">-----------------请选择-----------------</option>
                            {foreach from = $unitPositionArr item = val}
                                {html_options    values=$val.unitID output= $val.unitName|replace:"深圳市":'' selected= $s_unitID}
                            {/foreach}
                        </select>
                        <strong>岗位</strong>
                        <select name="positionID">
                            <option value="">-------请选择------</option>
                            {foreach from= $unitPositionArr item= val key=key }
                                {if $s_unitID}
                                    {foreach from= $val    item=u key= k}
                                        {if  $k eq "position" && $val['unitID'] eq $s_unitID}
                                            {foreach from= $u item= m key= n}
                                                {html_options values= $m.positionID output=$m.name selected=$s_positionID}
                                            {/foreach}
                                        {/if}
                                    {/foreach}
                                {else}
                                    {foreach from= $val    item=u key= k}
                                        {if  $k eq "position"}
                                            {foreach from= $u item= m key= n}
                                                {html_options values= $m.positionID output=$m.name selected=$s_positionID}
                                            {/foreach}
                                        {/if}
                                    {/foreach}
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>市场</strong>
                        <select name="marketID">
                            <option value="">-------请选择------</option>
                            {foreach from=$marketArr item=val}
                                {html_options values=$val.marketID output=$val.name selected=$s_marketID}
                            {/foreach}
                        </select>
                        <strong>排序</strong>
                        <select name="order">
                            {html_options options=$orderArr selected=$s_order}
                        </select>
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <hr/>
    <form name="talentinfoForm" id="talentinfoForm" method="post" class="form">
        {$pageList}
        <table class="myTable" id="editTable" width="100%">
            <tr>
                <th>全选
                    <input type="checkbox" id="CK"/>
                </th>
                <th>编号</th>
                <th>姓名</th>
                <th>电话</th>
                <th>驾照类型</th>
                <th>应聘岗位</th>
                <th>状态</th>
                <th>备注</th>
                <th>市场</th>
                <th>创建日期</th>
            </tr>
            {foreach key= k item=t from=$talents}
                {assign var="infoValid" value=$t.infoValid}
                {assign var="sign" value=$t.sign}
                {if $infoValid eq 2}
                    <tr class="table_tr_grey">
                {elseif $sign eq 1}
                    {assign var="onduty" value=$t.onDuty}
                    {if $onduty eq 3}
                        <tr class="table_tr_green2">
                            {else}
                        <tr class="table_tr_green">
                    {/if}
                {else}
                    <tr>
                {/if}
                <td>
                    <input type="checkbox" name="talents[]" class="ckb" value="{$t.talentID}"/>
                </td>
                <td>
                    {if $web_workerBasicArr[$t.talentID].infoConfirm == 1}
                    <span class="positive">
                                    {/if}
                        {if $web_workerBasicArr[$t.talentID].infoConfirm == 0}
                        {if $web_wInfo_extraArr[$web_workerBasicArr[$t.talentID].wID].wID }
                        <span class="negative">
                                   {/if}
                            {/if}
                            {$t.talentID}
                                </span>
                </td>
                <td>
                    <a href="tUpdate.php?tid={$t.talentID}&page={$page}"
                       class="supernote-hover-t{$t.talentID}">{$t.t_name}</a>
                </td>
                <td>
                    {$t.t_telephone}
                </td>
                <td>
                    {$t.lisence}
                </td>
                <td>
                    {$t.positionName}
                </td>
                <td>
                    {$statusToCHNArr[$t.status].name}
                </td>
                <td title="{$t.remarks}" alt="{$t.talentID}" class="editTd">
                    {foreach item=remarkVal from=$recruitNotesArr}
                        {if $remarkVal.talentID eq $t.talentID &&  $remarkVal.remarks}
                            {$remarkVal.remarks} -{$remarkVal.createdOn|date_format:"%m/%d"}
                            <br>
                        {/if}
                    {/foreach}
                    {$t.remarks|truncateGBK:20:"...."}
                </td>
                <td>{$t.marketName}</td>
                <td>
                    {$t.createdOn}
                </td>
                <!--<td>{$t.infoValid|replace:"1":"人才库"|replace:"2":"垃圾库"}</td>-->
                <!--<td title="{$t.t_name}">{$t.sign|replace:"1":"已提交"|replace:"2":"未提交"|replace:"3":"已退回"}</td>-->
                <!--<td title="{$t.t_name}">{$t.backReason}</td>-->
                </tr>
                {foreachelse}
                <td colspan="15">
                    无数据
                </td>
            {/foreach}
        </table>
        {foreach item=t from=$talents}
            <div id="supernote-note-t{$t.talentID}" class="snp-triggeroffset notedefault">
                <a name="demo4"></a>
                <h5>{$t.t_name}</h5>
                <ul>
                    <li>
                        身份证号：{$t.pID}
                    </li>
                    <li>
                        性别：{$t.sexName}
                    </li>
                    <li>
                        学历：{$t.education|replace:"1":"博士"|replace:"2":"硕士"|replace:"3":"本科"|replace:"4":"大专"|replace:"5":"高中"|replace:"6":"中专"|replace:"7":"初中"|replace:"8":"小学"}
                    </li>
                    <li>
                        专业：{$t.major}
                    </li>
                    <li>
                        单位：{$t.unitName}
                    </li>
                    <li>
                        招聘人员: {$t.mName}
                    </li>
                    <li>
                        市场:  {$t.marketName}
                    </li>
                </ul>
            </div>
        {/foreach}
        {$pageList}
        <br/>

        <div id="otherstatus" style="float:left;"></div>

        <input type="submit" name="excelout" value="导出全部"/>
        <input type="button" name="excelout2" value="导出选中"/>

        <div id="errorDiv" class="error-div-alternative"></div>
    </form>

</div>
{include file="footer.tpl"}