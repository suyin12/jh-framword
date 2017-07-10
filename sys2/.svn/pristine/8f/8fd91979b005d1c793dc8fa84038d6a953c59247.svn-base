{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
{literal}
<script>
    $(document).ready(function () {
        $(".editTd").editable("sql.php", {
            type: "text",
            submit: "确定",
            width: "10",
            submitdata: function () {
                var field = $(this).attr("title");
                return {
                    field: field,
                    btn: "prsReBtn"
                };
            },
            event: "click",
            onblur: "cancel",
            placeholder: "",
            ajaxoptions: {
                dataType: "json"
            }
        });
        $(".editSelect").editable("sql.php", {
            type: "select",
            {/literal}
            data: '{$js_unit}',
            {literal}
            style: 'inherit',
            submit: "确定",
            submitdata: function () {
                var field = $(this).attr("title");
                return {
                    field: field,
                    btn: "prsReBtn"
                };
            },
            event: "click",
            onblur: "cancel",
            placeholder: "",
            ajaxoptions: {
                dataType: "json"
            },
            callback: function (value, settings) {
                console.log(this);
                console.log(value);
                console.log(settings);
            }
        });

        //修改状态及删除按钮事件
        $(".aSub").click(function () {
            var formID = $(this).parents("form").attr("id");
            var btnName = $(this).attr("name");
            var t, u, d, dt, m;
            t = "post";
            u = "sql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=prsMoney";
            if (btnName == "delPrsReBtn" || btnName == 'changePrsReBtn') {
                d = "ID=" + $(this).attr("alt") + "&btn=" + btnName;
            }
            dt = "json";
            m = function (json) {
                var i, n, k, v;
                $.each(json, function (i, n) {
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
            var ret = confirm("确定" + $(this).text() + "?");
            if (ret == true) {
                ajaxAction(t, u, d, dt, m);
            }
        });
        //增加记录事件
        $("input[name=addPrsMoney]").click(function () {
            successFun = function(){
            var formID ="prsReForm";
            var btnName = "addPrsMoney";
            var t, u, d, dt, m;
            t = "post";
            u = "sql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName;
            dt = "json";
            m = function (json) {
                var i, n, k, v;
                $.each(json, function (i, n) {
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
            var ret = confirm("确定新增吗?");
            if (ret == true) {
                ajaxAction(t, u, d, dt, m);
            }
            }
          validator("input[name=addPrsMoney]", "#prsReForm", "#errorDiv", successFun);

        });


        //费用处理
        $(".editSub").each(function (i) {
            $(this).click(function () {
                var thisUrl = $(this).attr("alt");
                tipsWindown('调整费用', 'iframe:' + thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
            });
        });

    });
</script>
{/literal}
<div id="main">
    <fieldset>
        <legend><code>个人欠/挂/冲减明细</code></legend>
        <p class="notice">特别提示:因为涉及到单位整体冲减的问题,此挂账金额,不能做为挂账凭证!!</p>
        <form class="form" id="prsReForm">
        <table class="myTable" id="editTable" width="100%">
            <input type="hidden" name="selPost" value="1"/>
            <thead>
            <tr>
                <th rowspan=2>费用月份</th>
                <th rowspan=2>批次</th>
                <th rowspan=2>姓名</th>
                <th rowspan=2>单位名称</th>
                <th rowspan=2>残障金</th>
                <th colspan=2>社保</th>
                <th colspan=2>公积金</th>
                <th colspan=2>商保</th>
                <th rowspan=2>管理费</th>
                <th rowspan=2> 单位挂账</th>
                <th colspan=2>其他</th>
                <th rowspan=2> 类型</th>
                <th rowspan=2> 备注</th>
                <th rowspan=2> 状态</th>
                <th rowspan=2>操作</th>
            </tr>
            <tr>
                <th>单位</th>
                <th>个人</th>
                <th>
                    单位
                </th>
                <th>
                    个人
                </th>
                <th>
                    单位
                </th>
                <th>
                    个人
                </th>
                <th>单位</th>
                <th>个人</th>
            </tr>
            </thead>

                <tbody>
                {foreach from=$ret item=list}
                    <tr>
                        {foreach from=$list key=k item=v}
                            {if $k eq 'uID' || $k eq 'ID'}
                                {continue}
                            {elseif $k eq 'type'}
                                <td>
                                    {$type.$v}
                                </td>
                            {elseif $k eq 'name'}
                                <td>
                                    <a href="{$httpPath}workerInfo/wManage.php?uID={$list.uID}" target="_blank">{$v}</a>
                                </td>
                            {elseif $k eq 'status'}
                                <td><span class="red">{$status.$v} </span></td>
                            {elseif $k eq 'unitName'}
                                <td class="editSelect " alt="{$k}" title="unitID|{$list.ID}">{$v}</td>
                            {elseif $k eq 'unitID'}
                            {else}
                                <td class="editTd" title="{$k|cat:'|'|cat:$list.ID|cat:'|'|cat:$list.type}">
                                    {if is_numeric($v) and $v==0}
                                    {else}
                                        {$v}
                                    {/if}
                                </td>
                            {/if}
                        {/foreach}
                        <td>
                            <input type=button class="aSub" name="delPrsReBtn" alt="{$list.ID}" value="删除">
                            <input type=button class="aSub" name="changePrsReBtn" alt="{$list.ID}|1" value="已入账">
                            <input type=button class="aSub" name="changePrsReBtn" alt="{$list.ID}|0" value="未入账">
                        </td>
                    </tr>
                    {foreachelse}
                    <tr>
                        <td colspan="15">此人无欠/挂记录</td>
                    </tr>
                {/foreach}
                <tr>

                    <td><input class="req-string" type="text" name="month" size="7"></td>
                    <td><input name="uID" type="hidden" value="{$wRet.uID}"></td>
                    <td><a href="{$httpPath}workerInfo/wManage.php?uID={$wRet.uID}" target="_blank">{$wRet.name}</a>
                    </td>
                    <td><select class="req-string" name="unitID" style="width:100px">
                            {foreach from=$unit key=key item=val}
                                <option value="{$key}"
                                        {if $wRet.unitID eq $key}selected=selected{/if}>{$val.unitName}</option>
                            {/foreach}
                        </select></td>
                    <td><input type="text" name="uPDInsMoney" size="5"></td>
                    <td><input type="text" name="uSoInsMoney" size="5"></td>
                    <td><input type="text" name="pSoInsMoney" size="5"></td>
                    <td><input type="text" name="uHFMoney" size="5"></td>
                    <td><input type="text" name="pHFMoney" size="5"></td>
                    <td><input type="text" name="uComInsMoney" size="5"></td>
                    <td><input type="text" name="pComInsMoney" size="5"></td>
                    <td><input type="text" name="managementCostMoney" size="5"></td>
                    <td><input type="text" name="uAccount" size="5"></td>
                    <td><input type="text" name="uOtherMoney" size="5"></td>
                    <td><input type="text" name="pOtherMoney" size="5"></td>
                    <td><select class="req-string" name="type">
                            <option value="">请选择</option>
                            {foreach from=$type item=val key=key}
                                <option value="{$key}">{$val}</option>
                            {/foreach}
                        </select></td>
                    <td><input class="req-string" type="text" name="remarks" size="15"></td>
                    <td></td>
                    <td><input type=button class="noSub" name="addPrsMoney" value="添加"></td>
                </tr>
        </table>
            <div id="errorDiv" class="error-div-alternative">
            </div>
        </form>
</div>
</fieldset>
{include file="footer.tpl"}