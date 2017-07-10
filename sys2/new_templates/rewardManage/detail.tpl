{if $smarty.get.iframe eq 'true'}
    {include file="noLeftHeader.tpl"}
    <script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
{else}   
    {include file="header.tpl"}
{/if}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js></script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
    <script>
            $(document).ready(function(){
            $(".editTd").editable("sql.php",{
                            type:"text",
                            submit:"确定",
                            width:"10",
                            submitdata:function(){
                                    var field=$(this).attr("title");
                                    return {field:field,btn:"editRewardFee_tmpBtn"};
                            },
                            event:"click",
                            onblur: "cancel",
                            placeholder:"",
                            ajaxoptions:{dataType:"json"}
                    });
                         //费用处理
                $(".editSub").each(function(i){
                    $(this).click(function(){
                        var thisUrl = $(this).attr("alt");
                        tipsWindown('下载报表', 'iframe:' + thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
                    });
                }); 
                    //表头固定
            if(getQuery("output"))
                var fCol=3;
             else
                var fCol=1;
            if(IsEmpty(getQuery("m"))){                
                  $('.myTable').fixedHeaderTable({ height: '500',width:"1180", altClass: 'odd',fixedColumns: fCol, themeClass: 'myTable' });
               }
            });
    </script>
{/literal}
<div id="main">
    <fieldset><legend><code>明细[共<span class="red">{$ret|@count}</span>条记录--只显示前50条]</code></legend>   
        <form method="post" action="">  
            <p class="success">
                {if $smarty.get.output=="true"}<a class="noSub" href= "{$editUrl}" target="_blank">进入制作模式</a><a class="editSub noSub" alt= "{$exportUrl}">下载</a>{/if} 
                     按姓名查找: <input name="name" type="text"/> <input name="search" type=submit value="查找" />
            </p>
        </form>
        <table class="myTable">
            <thead>
                <tr>
                    {foreach key=key item = fieldName from=$newFieldArr}
                        <th>{$fieldName}</th>
                    {/foreach}
                </tr>
            </thead>
            <tbody>
                {foreach item = val name=foo from =$ret}
                    {if $smarty.foreach.foo.index eq 50 }
                        {break}
                    {/if}
                    <tr>
                        {foreach item=v key=k  from=$val }

                            {if $k eq "ID"}
                                {continue}
                            {elseif $k eq "name" || $k eq "bID"}
                                <td class="editTd" title="{$k|cat:'|'|cat:$val.ID}">
                                    {$v}
                                </td>
                            {elseif $smarty.get.m}
                                <td class="editTd" title="{$k|cat:'|'|cat:$val.ID}">
                                    {$v}
                                </td>    
                            {else}
                                <td>
                                    {if  is_numeric($v) && $k!='num'}
                                        {$v|string_format:"%.2f"|defaultNULL:''}
                                    {else}
                                        {$v}
                                    {/if}
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
{if $smarty.get.iframe eq 'true'}
    <script>
        $('#loading').fadeOut("slow"); 
    </script>
{else}   
    {include file="footer.tpl"}
{/if}