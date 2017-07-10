{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
        $("#checkAll").click(function(){
            checkAll(this,":checkbox");
           });
    })
    </script>
{/literal}
</head>
<body>
    <div id="main">
        <a class="noSub positive" href="{$lastUrl}">返回</a>
        <fieldset>
            <legend><code>访问权限分配</code></legend>
    <form action="" method="post">
        <table  class="myTable" width="100%">
            {foreach from=$father item=val key=key}
                <tr>
                    <th>{$val.Fun_Name}</th>
                    <td>
                    {foreach from=$child item=cval key=ckey}
                        {if $val.Fun_ID eq $cval.fatherID}
                            <input type="checkbox" name="action_code[]" value="{$cval.Fun_ID}" {if in_array($cval.Fun_ID,$roleList)}checked{/if} /> {$cval.Fun_Name}  &nbsp;&nbsp;&nbsp;&nbsp;
                         {/if}   
                    {/foreach}
                    </td>
                </tr>       
            {/foreach}    
            <tr>
                <td align="center" colspan="2">
                    <input type="checkbox"  value="checkbox" id="checkAll" name="checkall" />全选      &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value=" 保存 " name="Submit" />&nbsp;&nbsp;&nbsp;
                    <input type="reset" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
      </fieldset>          
    </div>            
    {include file="footer.tpl"}