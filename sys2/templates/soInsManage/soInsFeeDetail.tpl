{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
    <script>
            $(document).ready(function(){
            $(".editTd").editable("soSql.php",{
                            type:"text",
                            submit:"确定",
                            width:"10",
                            submitdata:function(){
                                    var field=$(this).attr("title");
                                    return {field:field,btn:"editSoInsFee_tmpBtn"};
                            },
                            event:"click",
                            onblur: "cancel",
                            placeholder:"",
                            ajaxoptions:{dataType:"json"}
                    });
               $('.myTable').fixedHeaderTable({ height: '500', altClass: 'odd',fixedColumns: 1, themeClass: 'myTable' });
            });
    </script>
{/literal}
<div id="main">
    <fieldset><legend><code>明细[共<span class="red">{$ret|@count}</span>条记录--只显示前50条]</code></legend> 
    <form method="post" action="">  
        <p class="success">
            按姓名查找: <input name="name" type="text"/> <input name="search" type=submit value="查找" />
        </p>
    </form>

    <table class="myTable">
        <thead>
        <form name="cSequenceForm">
            <tr>
                {foreach key=key item = fieldName from=$newFieldArr}
                    <th>{$fieldName}</th>
                {/foreach}
            </tr>
        </form>
        </thead>
        <tbody>
            {foreach item = val name=foo from =$ret}
                {if $smarty.foreach.foo.index eq 50 }
                    {break}
                {/if}
                <tr>
                    {foreach item=v key=k from=$val }
                        {if $k eq "ID"}
                                {continue}
                        {elseif $k eq "name" || $k eq "pID" || $k eq "unitID"}
                            <td class="editTd" title="{$k|cat:'|'|cat:$val.ID}">
                                {$v}
                            </td>
                        {else}
                            <td>
                                {$v}
                            </td>
                        {/if}
                    {/foreach}
                </tr>
            {/foreach}
            <tr>
                {foreach from=$total item=totalCell}
                    <td>
                        {if  is_numeric($totalCell)}
                            {$totalCell|string_format:"%.2f"|defaultNULL:''}
                        {else}
                            {$totalCell}
                        {/if}
                    </td>
                {/foreach}
            </tr>
        </tbody>
    </table>
    </fieldset>        
</div>                        
{include file="footer.tpl"}	