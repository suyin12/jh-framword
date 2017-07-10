{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.6.2.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.validationEngine-zh_CN.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.validationEngine.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
    <script>
            $(document).ready(function(){
               $('.myTable01').fixedHeaderTable({ height: '300', altClass: 'odd',fixedColumns: 3, themeClass: 'myTable' });
               $("#exc_upload").validationEngine();
            });
    </script>
{/literal}
<div id="main">
    <fieldset><legend><code>无公式EXCEL导入</code></legend>
        {$smarty.get.a|exit:"非法网址"}
        {if $smarty.post.step eq '0'}<p>选择一个Excel文档</p>
            <form name="exc_upload" id="exc_upload" method="post" action="" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>
                            Excel文档:
                        </td>
                        <td>
                            <input type="file" size="25" name="excel_file" class='validate[required]'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            有效数据从第 
                            <input type="text" name="startRow" class='validate[required]' value="{$smarty.get.startRow|default:'2'}" size="2">
                            行开始
                        </td>
                    </tr>
                    <tr>
                        {if $smarty.get.a eq "soInsFeeMulInsert" || $smarty.get.a eq "soInsFeeAgmInsert" || $smarty.get.a eq "soInsFeeMulAgmInsert"}
                            <td>
                                社保帐户:
                                <input type="text" name="soInsID" value="{$smarty.get.soInsID|default:$insuranceID.soIns.0}" size="10">
                            </td>
                        {elseif $smarty.get.a eq "HFFeeMulInsert" || $smarty.get.a eq "hfFeeAgmInsert"}
                            <td>
                                公积金帐户:
                                <input type="text" name="housingFundID" value="{$smarty.get.housingFundID|default:$insuranceID.HF.0}" size="20">
                            </td>
                        {/if}
						<td>{$extraFieldset}</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <input type="hidden" name="step" value="1">
                            <input type="submit" value="下一步" />
                        </td>
                    </tr>
                </table>
            </form>
        {/if}
        {if $errorMsg}
            <div class="error">
                {$errorMsg|exit:"noNull"}
            </div>
        {/if}
        {if $smarty.post.step eq '1'}
            <div> {$dataInfo} </div>
            <div>
                <p class="success">(只显示前50条数据,隐藏剩余数据)</p>
                <table class="myTable01 myTable">
                    <thead>
                        <tr>
                            {foreach item=fieldName from=$fieldHeader}
                                <th>
                                    {$fieldName}
                                </th>
                            {/foreach} 
                        </tr>
                    </thead>
                    <tbody>
                        {foreach item= val name=foo from=$cellArr}
                            {if $smarty.foreach.foo.index eq 50 }
                                {break}
                            {/if}
                            <tr>
                                {foreach item= v key=k from= $val}
                                    <td>
                                        {if is_float($v) }
                                            {$v|string_format:"%.2f"}
                                        {else}
                                            {$v}
                                        {/if}
                                    </td>
                                {/foreach}
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
              <div>
            <form action="" method="POST" name="db_export">
                <input type="submit" name="submit" value="添加">
                <input type="hidden" name="excel_file" value="{$excel_file}">
                <input type="hidden" name="startRow" value="{$smarty.post.startRow}">
                {if $smarty.get.a eq "soInsFeeMulInsert" || $smarty.get.a eq "soInsFeeAgmInsert" || $smarty.get.a eq "soInsFeeMulAgmInsert"}
                    <input type="hidden" name="soInsID" value="{$smarty.post.soInsID}">
                {elseif $smarty.get.a eq "HFFeeMulInsert" || $smarty.get.a eq "hfFeeAgmInsert"}
                    <input type="hidden" name="housingFundID" value="{$smarty.post.housingFundID}">
                {elseif $smarty.get.a eq "recruitMarksMulInsert"}
                <input type="hidden" name="trainClassicID" value="{$smarty.post.trainClassicID}">
                {/if}  
                <input type="hidden" name="step" value="2">
             </form>
             </div>
        {/if}
        {$insertInfo}
    </fieldset>
</div>
{include file="footer.tpl"}