{include file="header.tpl"}
<script type="text/javascript" src="{$httpPath}lib/js/tablejq.min.js"></script>
<script type="text/javascript" src="{$httpPath}lib/js/general.js"></script>
{literal}
<script type="text/javascript">
    $(document).ready(function(){
        FixTable('MyTable',1,1187,330);

        {/literal}
        //利用a链接被单击时是post提交页面
        $("#fenye a,#tijiao").click(function(){
            $("#selectForm input[name=intoExcel]").remove();
            var id = $(this).attr('id');
            if(id !== 'tijiao'){
                var str = this.href;
                var index1 = str.indexOf('?') + 1;
                var attr = str.substring(index1);
                var page = GetQueryString(attr,'page');
                $("#selectForm").append("<input type='hidden' name='page' value=" + page + ">");
            }
            $("#selectForm").submit();
            this.href="#";
        });

        {literal}
    });
    //匹配到数值返回他的值数
    function GetQueryString(attr,name)
    {
        var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
        var r = attr.match(reg);
        if(r!=null)return  unescape(r[2]); return null;
    }
    function intoExcel(){
        $("#selectForm").append("<input type='hidden'  name='intoExcel' value='on'/>");
        $("#selectForm").submit();

    }

</script>
{/literal}
<div id="main">
    <fieldset>
        <legend><code>筛选条件</code></legend>
        <form method="post" id="selectForm">
            <table height="70px">
                <tr>
                    <th>
                        <strong>单位：</strong>
                        <select name="unitID">
                        {html_options options=$u_info_arr selected=$s_unitID}
                        </select>
                    </th>

                    <th>
                        <strong>起止年月：</strong>
                        <select name="day_start">
                        {html_options options=$d_day_arr selected=$s_day_start}
                        </select> -
                        <select name="day_end">
                        {html_options options=$d_day_arr selected=$s_day_end}
                        </select>
                    </th>
                    <th>
                        <input type="button" value="查询" id="tijiao"/>
                    </th>
                </tr>
                <tr>
                    <th colspan="2"><strong>显示项：</strong>
                        <input type="checkbox" name="totalFee" {if $s_totalFee}checked="checked"{else}{/if}/>总费用
                        <input type="checkbox" name="pay" {if $s_acheive}checked="checked"{else}{/if}/>应发工资
                        <input type="checkbox" name="acheive" {if $s_acheive}checked="checked"{else}{/if}/>实发工资
                        <input type="checkbox" name="uSoIns" {if $s_uSoIns}checked="checked"{else}{/if}/>单位社保
                        <input type="checkbox" name="pSoIns" {if $s_pSoIns}checked="checked"{else}{/if}/>个人社保
                        <input type="checkbox" name="uHF" {if $s_uHF}checked="checked"{else}{/if}/>单位公积金
                        <input type="checkbox" name="pHF" {if $s_pHF}checked="checked"{else}{/if}/>个人公积金
                        <input type="checkbox" name="uComIns" {if $s_uComIns}checked="checked"{else}{/if}/>单位商保
                        <input type="checkbox" name="pComIns" {if $s_pComIns}checked="checked"{else}{/if}/>个人商保
                    </th>
                </tr>
            </table>
        </form>
        </fieldset>
    <fieldset>
        <table id="MyTable" class="myTable">
            <thead>
            <tr><th rowspan="2">档案编号</th><th rowspan="2">姓名</th><th rowspan="2">身份证</th>{$header}</tr>
            <tr>{$second}</tr>
            </thead>
            <tbody>
            {foreach from=$son_arr key=key item =val}
                <tr>
                    {foreach from=$val key=kk item =vv}
                    <td>{$vv}</td>
                    {/foreach}
                </tr>
            {/foreach}
                <tr><td colspan="{$colspan + 3}" id="fenye">{$pageList}</td></tr>
            </tbody>
        </table>
            <div class="tt">
                <div class="right">
                    <input type="submit"  name="intoExcel" onclick="intoExcel();" value="保存为EXCEL"/>
                </div>
            </div>
    </fieldset>
</div>
{include file="footer.tpl"}