{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>
       $(document).ready(function(){
             // 判断select选项是否重复
        $(".sub").click(function(){
            var formID = this.form.id;
            var btnName = $(this).attr("name")
            var t, u, d, dt, m;
            t = "post";
            u = "sql.php";
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
            var ret = confirm("确定" + $(this).val() + "?");
            if (ret == true) {                    
                    ajaxAction(t, u, d, dt, m);                    
            }
        });

});
</script>
{/literal}   
<div id="main">
    <div>

        <form action="" method="post">
            <input type="hidden" name="column" value="{$column}">  
            <table  class="myTable">
                <tr>
                    <td>基表(1)列数<br><input type="text" name="col[B1]" size="10" value="{$smarty.post.col.B1}"></td>
                    <td>基表(2)列数<br><input type="text" name="col[B2]"  size="10" value="{$smarty.post.col.B2}"></td>
                    <td>基表(3)列数<br><input type="text" name="col[B3]"  size="10" value="{$smarty.post.col.B3}"></td>
                    <td>辅助表(1)列数<br><input type="text" name="col[S1]"  size="10" value="{$smarty.post.col.S1}"></td>
                    <td>辅助表(2)列数<br><input type="text" name="col[S2]"  size="10" value="{$smarty.post.col.S2}"></td>
                </tr>
                <tr>                    
                    <td>
                        <input type="submit" value="确定" />
                    </td>
                </tr>  
            </table>
        </form>
    </div>
    <div>
        <form name="zFForm" id="zFForm">
            <input type="hidden" name="zID" value="{$zID}">
            {foreach from=$col  item=v key=k }
                <fieldset>      
                    <legend><code>{$tabName.$k}</code></legend>               
                    <table class="myTable">
                        {section name=loop loop=$row[$k] }
                            <tr>
                                <th>
                                    列号
                                </th>
                                {section name=colNO loop=$colName[$k]}
                                    {if ($smarty.section.colNO.iteration>($smarty.section.loop.index*$delmit)) &&( $smarty.section.colNO.iteration<=($smarty.section.loop.iteration*$delmit))}
                                        <th>
                                            {$colName[$k][colNO]}
                                        </th>
                                    {/if}
                                {/section}
                            </tr>
                            <tr>
                                <td>
                                    显示名称
                                </td>
                                {foreach item = colNo name=col from =$colName[$k] }
                                    {if ($smarty.foreach.col.iteration>($smarty.section.loop.index*$delmit)) &&( $smarty.foreach.col.iteration<=($smarty.section.loop.iteration*$delmit))}

                                        <td>
                                            <input type="text" name=fieldName[{$k}][{$colNo}] size=8 value="{$field[{$k}].$colNo}" />
                                        </td>
                                    {/if}
                                {/foreach}
                            </tr>
                        {/section}
                    </table>
                    <div><span class="notice">特殊项设置</span></div>
                    <table class="myTable">
                        <tr>                         
                            <td>
                                姓名                        
                                <select name=index[{$k}][name]>
                                    <option value="">请选择列号</option>
                                    {html_options values= $colName[$k] output= $colName[$k] selected=$zIndex[{$k}].name}
                                </select>
                            </td>
                            <td>
                                身份证                     
                                <select name=index[{$k}][pID]>
                                    <option value="">请选择列号</option>
                                    {html_options values= $colName[$k] output= $colName[$k] selected=$zIndex[{$k}].pID}
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            {/foreach}                 
            <table>
                <tr>
                    <td>
                        帐套名称:
                    </td>
                    <td>
                        <input type="text" name="zName" value="{$zName}" />
                    </td>
                </tr>
            </table>
            {if !$exRet}
                <input type="button" name='{$btnName}' class="sub" value="保存 "/>
            {else}
                <span class="red">该账套已被使用,不允许修改 </span>
            {/if}
        </form>
    </div>
</div>
{include file='footer.tpl'}