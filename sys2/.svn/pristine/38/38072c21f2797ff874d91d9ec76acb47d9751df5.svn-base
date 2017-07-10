{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<link rel="stylesheet" type="text/css" media="screen" href="{$httpPath}lib/js/jqGrid/css/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="{$httpPath}lib/js/jqGrid/css/ui.multiselect.css" />
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
<script src="{$httpPath}lib/js/jqGrid/js/i18n/grid.locale-cn.js" type="text/javascript"></script>
<script src="{$httpPath}lib/js/jqGrid/js/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>
<script src="{$httpPath}lib/js/jqGrid/plugins/ui.multiselect.js" type="text/javascript"></script>
{literal}
    <script>
$(document).ready(function(){
             $(".multiselect").multiselect();
			  checkReload(":checkbox[name=wantToMerge]");	
});
    </script>
    <style>
        .multiselect {
            height: 200px;
            width:425px;
        }
        #area{
            height:300px;
        }
        .clearBoth{
            text-align:center;
            height:30px;
            width: 100%;
        }
    </style>
{/literal}

<div id="mainBody">
    <fieldset>
        <form method="post">
            <div id="area">
            <div class="left halfWidth">
                <p class="success"><span class="error"> 费用表导出格式</span></p>
                <select id="feeExcelStyle" class="multiselect" multiple="multiple" name="feeExcelStyle[]" >
                    {foreach item=fVal key=fKey from=$feeExtraFieldStr}
                        {if in_array($fKey,$feeBasicFieldArr) || in_array($fKey,$firstFieldArr) || in_array($fKey,$payFieldArr) || in_array($fKey,$totalFeeFieldArr)}
                            <option value='{$fKey}' selected='selected'>{$fVal}</option>
                        {else}
                            <option value='{$fKey}' >{$fVal}</option>
                        {/if}   
                    {/foreach}
                </select>
            </div>
            <div class="right halfWidth">
                <p class="success"><span class="error"> 发放表导出格式</span></p>
                <select id="salaryExcelStyle" class="multiselect" multiple="multiple" name="salaryExcelStyle[]" >
                    {foreach item=fVal key=fKey from=$salaryExtraFieldStr}
                        {if in_array($fKey,$salaryBasicFieldArr) || in_array($fKey,$firstFieldArr) || in_array($fKey,$payFieldArr) || in_array($fKey,$acheiveFieldArr)}
                            <option value='{$fKey}' selected='selected'>{$fVal}</option>
                        {else}
                            <option value='{$fKey}' >{$fVal}</option>
                        {/if}   
                    {/foreach}
                </select>
            </div>
                </div>
            <div class="clearBoth">
                <input type = "checkbox" name="wantToMerge" value="1" {if $smarty.get.wantToMerge eq "true"}checked{/if} />合并下载
                <input type="submit" name="subStyle" value="确定并下载"/>
            </div>
        </form>
   </fieldset>
</div>
{include file="footer.tpl"}