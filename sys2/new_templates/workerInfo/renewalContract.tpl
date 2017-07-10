{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
    <script type="text/javascript">

            $(document).ready(function(){
                // 客户经理/单位二级联动
                $("select[name=mID]").change(function(){
                    var j_d = $(".j_unitManager").val();
                    j_d = eval(j_d);
	        
                    $.each(j_d, function(i, n){
                        if ($("select[name=mID]").val() == n.mID) {
                            $("select[name=unitID] option:not(:eq(0))").remove();
                            $.each(n.unit, function(j, v){
                                $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                                v.unitName +
                                "</option>");
                            });
                        }
                        if (!$("select[name=mID]").val()) {
                            $.each(n.unit, function(j, v){
                                $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                                v.unitName +
                                "</option>");
                            });
                        }
                    });
                });
	    
                //全选,反选checkbox
                $(".chkAll").click(function(){
                    var cC, aC;
                    var formName = this.form.name;
                    var chkName = formName.replace("Form", "");
                    cC = this;
                    aC = ':checkbox[name^=' + chkName + 'Check]';
                    checkAll(cC, aC);
                });
                //批量生成续签日期
                $("input[name=renewalTH]").one("click", function(){
                    $(this).val("");
                });
                $("input[name=renewalTH]").blur(function(){
                    var value = $(this).val();
                    if (!IsEmpty(value)) 
                        $(":text[name^=renewalDay]").val(value);
                });
		
                    //AJAX提交
                     // 判断select选项是否重复
        $(".chkSub").click(function(){
            var formID = this.form.id;
            var btnName = $("#" + formID + " :button").attr("name")
            var t, u, d, dt, m;
            t = "post";
            u = "wSql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName;
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
               if( !isChecked(":checkbox[name^=renewalCheck]")){
                             var ret = confirm("确定" + $(this).val() + "?");
                    if (ret == true) {
                            ajaxAction(t, u, d, dt, m);
                    }
                       }else{
                            alert("请选择需要续签的人员");
                       }
        });
            });
	 
    </script>
{/literal}
<div id="main">
    <fieldset>
        <!-- 更新的时候form  disabled=flase 查看时 disabled=true  --><!-- 还欠缺高级查询方式 日后补上-->
        <input type="hidden" class="j_unitManager" value='{$j_unitManager}'>
        <div>
            <form method="GET" class="form" id="wSForm" action="">
                <div>
                    <p>设置合同到期提醒日期
                        <input name="monthAgo" value="{$monthAgo}" size=12>
                        (日期格式)
                    </p>
                    <strong>客户经理</strong>
                    <select name="mID">
                        <option value="">--请选择--</option>
                        {foreach from = $unitManager item = val} 
                            {html_options	values=$val.mID output= $val.mName selected= $s_mID} 
                        {/foreach}
                    </select>
                    <strong>单位</strong>
                    <select name="unitID">
                        <option value="">---------------请选择------------</option>
                        {foreach from= $unitManager item= val key=k } 
                            {foreach from= $val	item=u key= k}
                                {if $k eq "unit"}
                                    {foreach from= $u item= m key= n}
                                        {html_options values= $m.unitID output= $m.unitName|replace:"深圳市":""	selected=$s_unitID}
                                    {/foreach} 
                                {/if} 
                            {/foreach} 
                        {/foreach}
                    </select>
                    <input name="wS" type="submit" value="查询">
                </div>
            </form>
        </div>
        <div>
            <form method="post" action="">
                <p>共{$ret|@count}条记录 <input type="submit" name="intoExcel" value="下载清单"></p>

            </form>

            <form name="renewalForm" id="renewalForm">
                <table class="myTable">
                    <thead>
                        <tr>
                            <th>全选/反选
                                <br/>
                                <input name="renewalChk" class=chkAll type="checkbox">
                            </th>
                            {foreach from=$ret.0 item=value key=key}
                                {if $key eq 'helpCost'}
                                    {continue}
                                {/if}
                                <th>{$engToChsArr.$key} </th>
                            {/foreach}
                            <th>续签合同终止日期
                                <br>
                                <input name="renewalTH" type="text" value="这里输入,如'2012-06-30'">
                            </th>
                            <th>
                                互助会
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach from=$ret item=val}
                            <tr>
                                <td>
                                    <input name="renewalCheck[]" type="checkbox" value='{$val.uID}'>
                                </td>
                                {foreach from=$val item=v key=k}
                                    {if $k eq 'name'}
                                        <td>
                                            <a href='wPersonInfoList.php?uID={$val.uID}' target="_blank">{$v}</a>
                                        </td>
                                    {elseif $k eq 'type'}
                                        <td>
                                            {$typeArr.$v}
                                        </td>
                                    {elseif $k eq 'helpCost'}
                                        {continue}
                                    {else}
                                        <td>
                                            {$v}
                                        </td>
                                    {/if}
                                {/foreach}
                                <td>
                                    <input type="hidden" name="cEndDay[{$val.uID}]" value='{$val.cEndDay}'>
                                    <input type="text" class="reqDate" name="renewalDay[{$val.uID}]">
                                </td>
                                <td><input type="checkbox" name="helpCost[{$val.uID}]" value='1'  {if $val.helpCost eq '1'}checked{/if}></td>
                            </tr>
                            {foreachelse}
                                <tr>
                                    <td colspan="7">
                                        没有查询结果
                                    </td>
                                </tr>
                                {/foreach}

                                    <tr>
                                        <td>
                                            <input type="button" name="renewalBtn" class="chkSub" value="续约">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                </fieldset>
            </div>
            {include file="footer.tpl"}