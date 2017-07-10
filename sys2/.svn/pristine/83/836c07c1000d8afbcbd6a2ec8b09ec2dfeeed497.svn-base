{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
{literal}
    <script type="text/javascript">

        $(document).ready(function(){
         //全选反选
        $(".chkAll").click(function(){
            var cC, aC;
            var formName = this.form.name;
            var chkName = formName.replace("Form", "");
            cC = this;
            aC = ':checkbox[name^=' + chkName + 'Check]';
            checkAll(cC, aC);
        })
             //客户经理/单位二级联动
                linkage("select[name=mID]","select[name=unitID]",$('.js_unitManager').val());
           //提交
        $(".sub").click(function(){
            var formID = this.form.id;
            var acName=formID.replace("Form","");
            var btnName = $(this).attr("name")
            var chkName = ":checkbox[name^="+acName+"Check]";
            var t, u, d, dt, m;
            t = "post";
            u = "wSql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName ;
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
            if (isChecked(chkName) == false) {
                var ret = confirm("确定" + $(this).val() + "?");
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            }
            else {
                alert("请勾选要操作的数据");
            }
        });
           //批量修改
             function mulChangeVal(name){
                $("input[name=mul"+name+"]").bind("change",function(){
                var mulVal=$(this).val();
                 $("input[name^="+name+"]").each(function(i){
                 $(this).val(mulVal);
                });
            });}
                mulChangeVal("HFBuyDate");
             
           //点击radio改变比例
               $("input[name=percent]").click(function(){
                   var queryString = location.href;
                    var val = $(this).val();
                    var chkName = $(this).attr("name");
                    var newUrl=RegularUrl(queryString ,chkName,val);
                    window.location.href = newUrl;
        });
            
            //自定义比例
                $("input[name=customPer]").change(function(){
                    var queryString = location.href;
                    var val = $(this).val();
                    var chkName ="percent";
                    var newUrl=RegularUrl(queryString ,chkName,val);
                    window.location.href = newUrl;
        });
            
               
    });
    </script>
{/literal}
<div id="main">
    <fieldset>
        <legend><code>[  未购买公积金 ]  共{$ret|count}个人</code></legend>  
        <p class="success">默认购买的公积金比例为:<br>
            <input type="radio" name="percent" value="0.05" /> 5%   &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="percent" value="0.06" /> 6%   &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="percent" value="0.10" />10%  &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="percent"  value="0.13"/>13%  &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text"   name="customPer" value="例: 0.07"size=5 /><br>
            <input type="hidden" class="js_unitManager" value='{$js_unitManager}'>
            <form method="GET">
                <input type="hidden" name="month" value="{$smarty.get.month}" >
            <select name="mID">
                <option value="">--客户经理--</option>
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
                 <input type="submit" name="wCS" value="提交" />
                 </form>
        </p>
        <form name=HFForm id=HFForm>
            <table class="myTable">
                <tr>
                    <th>全选/反选<br/><input name="HFChk" class=chkAll type="checkbox"></th>
                    <th>员工编号</th>
                    <th>单位名称</th>
                    <th>姓名</th>
                    <th>本月单位实收</th>
                    <th>缴交基数</th>
                    <th>个人比例</th>
                    <th>单位比例</th>
                    <th>启用日期<br><input type="text" name="mulHFBuyDate" value='例如:2011-10-01'></th>
                </tr>
                {foreach from=$ret item=val}
                    <tr>
                        <td>
                            <input name="HFCheck[]" type="checkbox" value='{$val.uID}'>
                        </td>
                        <td>{$val.uID}</td>
                        <td>{$val.unitName}</td>
                        <td><a href="{$httpPath|cat:'workerInfo/wManage.php?uID='|cat:$val.uID}" target="_blank">{$val.name}</a></td>
                        <td>{$val.uHF}</td>
                        <td><input type="text" name="HFRadix[{$val.uID}]" value="{if $smarty.get.percent}{round(($val.uHF/$smarty.get.percent),2)}{/if}" size="5"/></td>
                        <td><input type="text" name="pHFPer[{$val.uID}]" value="{$smarty.get.percent}" size="5" /></td>
                        <td><input type="text" name="uHFPer[{$val.uID}]" value="{$smarty.get.percent}" size="5" /></td>
                        <td><input type="text" name="HFBuyDate[{$val.uID}]"  /></td>
                    </tr>
                {/foreach}
                <tr>
                    <td colspan="9"> <input type="button" name="HFBtn" class="sub" value="购买公积金" /></td>
                </tr>
            </table>
        </form>
    </fieldset>
</div>
{include file="footer.tpl"} 