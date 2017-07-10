{include file="header.tpl"}
{literal}
    <script type="text/javascript">
        $(document).ready(function(){
            $("input[name=c]").one("click", function(){
                $(this).val("");
                $(":checkbox[name=s_status_stop]").attr("checked",false);
            });
            $("select[name=status]").change(function(){
                var t=$(this).val();
                if(t=="0"){
                    $(":checkbox[name=s_status_stop]").attr("checked",false);
                }else{
                    $(":checkbox[name=s_status_stop]").attr("checked",true);
                }
            });
        });
    </script>
{/literal}
<div id="main">
    <fieldset>
        <div class="left">
            <form name="searchArchives" method="get" action="{$actionURL}">
                <table height="70px">
                    <tr>
                        <td colspan="2">
                            <strong>请选择查询条件</strong>
                            <select name="m">{html_options options=$modelArr selected=$s_m}</select>
                            <input type="text" name="c" value="{$s_c}"/>
                        </td>
                        {*<td>*}
                            {*<input name="s_status_stop" type="checkbox" value="1" {$s_status_stop|default:unchecked}/> 不包含停缴人员*}
                        {*</td>*}
                    </tr>
                    <tr>
                        <td>
                            <strong>状态</strong>
                            <select name="status">
                                <option value="">--请选择--</option>
                                {html_options options=$statusArr selected=$s_status}
                            </select>
                        </td>
                        <td>
                            　<input type="submit" value="查询"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </fieldset>
    <div>
        <fieldset>
            <legend><code>结果</code></legend>
            <table class="myTable">
                <tr>
                    <th>姓名</th>
                    <th>身份证号</th>
                    <th>申请证明类型</th>
                    <th>证明名字</th>
                    <th>证明受理单位</th>
                    <th>证明内容</th>
                    <th>收件地址</th>
                    <th>收件人</th>
                    <th>联系电话</th>
                    <th colspan="2" style="text-align: center">审核</th>
                </tr>
                    <tr>
                        <td>{$wUserArr[0]['name']}</td>
                        <td>{$wUserArr[0]['pID']}</td>
                        <td>{$wUserArr[0]['provetype']}</td>
                        <td>{$wUserArr[0]['proveName']}</td>
                        <td>{$wUserArr[0]['acceptUnit']}</td>
                        <td>{$wUserArr[0]['content']}</td>
                        <td>{$contactArr[0]['address']}</td>
                        <td>{$contactArr[0]['contactname']}</td>
                        <td>{$contactArr[0]['phone']}</td>
                        <td><a href="proveCheck.php?status=1&ID={$wUserArr[0]['ID']}">通过</a></td>
                        <td><a href="proveCheck.php?status=99&ID={$wUserArr[0]['ID']}">回退</a></td>
                    </tr>
            </table>
            <form method="post">
                <div class="tt">
                    <div class="left">{$pageList}</div>
                    {*<div class="right">*}
                        {*<input type="checkbox" name="codeVison" value="1" >编码格式版本*}
                        {*<input type="submit"  name="intoExcel"  value="保存为EXCEL"/>*}
                    {*</div>*}
                </div>
            </form>
        </fieldset>
    </div>
</div>
{include file="footer.tpl"}