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
                        <td>
                            <input name="s_status_stop" type="checkbox" value="1" {$s_status_stop|default:unchecked}/> 不包含停缴人员
                        </td>
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
                    <th>状态</th>
                    <th>参保人ID</th>
                    <th>姓名</th>
                    <th>身份证号</th>
                    <th>联系电话</th>
                    <th>管理费</th>
                    <th>管理费模式</th>
                    <th>参保类型</th>
                </tr>
                {foreach item=sa key=key from=$aUserArr}
                    {if $sa}
                        <tr>
                            <td>{$sa.statusTxt}</td>
                            <td>{$sa.fID}</td>
                            <td><a href="personalInfo.php?fID={$sa.fID}">{$sa.name}</a></td>
                            <td>{$sa.pID}</td>
                            <td>{$sa.mobilePhone}</td>
                            <td>{if $sa.mCost=="0"}免{else}{$sa.mCost}{/if}</td>
                            <td>{$sa.mCostLimitTxt}</td>
                            <td>{$sa.cityInsuranceTxt}</td>
                        </tr>
                    {else}
                        <tr><td colspan="12"><font color="red">无</font></td></tr>
                    {/if}
                {/foreach}
            </table>
            <form method="post">
                <div class="tt">
                    <div class="left">{$pageList}</div>
                    <div class="right">
                        <input type="checkbox" name="codeVison" value="1" >编码格式版本
                        <input type="submit"  name="intoExcel"  value="保存为EXCEL"/>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>
{include file="footer.tpl"}