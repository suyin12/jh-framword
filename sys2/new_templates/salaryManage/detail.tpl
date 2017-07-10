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
            $(".editTd").editable("salarySql.php",{
                            type:"text",
                            submit:"确定",
                            width:"10",
                            submitdata:function(){
                                    var field=$(this).attr("title");
                                    var extraBatch=getQuery("extraBatch")?getQuery("extraBatch"):0;
                                    return {field:field,extraBatch:extraBatch,btn:"editOriginalFee_tmpBtn"};
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
                    //添加人员
                    $(".addEditSub").each(function(i){
                    $(this).click(function(){
                        var thisUrl = $(this).attr("alt");
                        tipsWindown('添加人员', 'iframe:' + thisUrl, '400', '150', 'true', '', 'true', 'leotheme');
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
                 {if $smarty.get.output=="true"}<a class="noSub" href= "{$editUrl}" target="_blank">进入制作模式</a><a class="editSub noSub" alt= "{$exportUrl}">下载</a>
                 {else}<a class="addEditSub noSub" alt= "{$addUrl}">添加人员</a>
                {/if}
                    按姓名查找: <input name="name" type="text"/> <input name="search" type=submit value="查找" />
            </p>
             {if $smarty.get.output=="true"}
         <fieldset>
            <legend><code>公式及原始费用表项目</code></legend>
            <div>
                <table   width="1100px">
                    {$formulasChartStr}
                </table>
            </div>
            <div class="block">
                <br>
                <p>应发工资 ={$formulasStr.payFormulas} </p><br>
                <p>应缴纳税额 = 应发工资 - 个人社保 -个税起征额{$formulasStr.ratal}</p><br>
                <p>实发工资 = 应发工资 - 个税 - 个人社保  - 个人商保 - 收回社保欠款 - 收回商保欠款 -收回其他欠款- 房屋水电 - 互助会 {$formulasStr.acheiveFormulas}</p><br>
                <p>单位挂账 = {$formulasStr.uAccount}</p><br>
                <p>总费用=应发工资+残障金+单位社保+单位商保+管理费+单位挂账 {$formulasStr.totalFeeFormulas}</p><br>
            </div>
        </fieldset>
            {/if}
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