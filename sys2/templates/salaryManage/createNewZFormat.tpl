{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/3.js>
</script>
<div id="main">
    <fieldset>
    <legend><code>帐套设置</code></legend>
    <fieldset>
        <form action="" method="post">
            <table>
                <tr>
                    <input type="hidden" name="column" value="{$column}">
                    <td>
                       <code> 增加/减少(负数)列数</code>
                    </td>
                    <td>
                        <input type="text" name="addCol" value="{$smarty.post.addCol}">
                    </td>
                    <td>
                        <input type="submit" value="确定" />
                    </td>
                </tr>
            </table>
        </form>
        <form name="zFForm" id="zFForm">
            <input type="hidden" name="zID" value="{$zID}">
            <table class="myTable">
                    {section name=loop loop=$row }
                <tr>
                    <th>
                        列号
                    </th>
                    {section name=colNO loop=$colName}
                        {if ($smarty.section.colNO.iteration>($smarty.section.loop.index*$delmit)) &&( $smarty.section.colNO.iteration<=($smarty.section.loop.iteration*$delmit))}
                    <th>
                        {$colName[colNO]}
                    </th>
                    {/if}
                    {/section}
                </tr>
                <tr>
                    <td>
                        显示名称
                    </td>
                    {foreach item = colNo name=col from =$colName }
                                {if ($smarty.foreach.col.iteration>($smarty.section.loop.index*$delmit)) &&( $smarty.foreach.col.iteration<=($smarty.section.loop.iteration*$delmit))}
                 
                    <td>
                        <input type="text" name=fieldName[{$colNo}] size=8 value="{$field.$colNo}" />
                    </td>
                    {/if}
                  {/foreach}
                </tr>
                    {/section}
            </table>
            </fieldset>
            <fieldset>
                <table class="myTable">
                    <tr>
                            <td>
                         单位编号                        
                            <select name=index[unitID]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.unitID}
                            </select>
                        </td>
                        <td>
                            姓名
                        
                            <select name=index[name]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.name}
                            </select>
                        </td>
                        <td>
                            银行账号
                        
                            <select name=index[bID]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.bID}
                            </select>
                        </td>
                        <td>
                            单位公积金
                            <select name=index[uHF]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uHF}
                            </select>
                        </td>
                        <td>
                            个人公积金
                            <select name=index[pHF]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.pHF}
                            </select>
                        </td>
                        <td>
                            单位商保
                        
                            <select name=index[uComIns]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uComIns}
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>
                            管理费
                        
                            <select name=index[managementCost]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.managementCost}
                            </select>
                        </td>
                        <td>
                            房屋水电
                        
                            <select name=index[utilities]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.utilities}
                            </select>
                        </td>
                        </td>
                         <td>
                            制卡费
                        
                            <select name=index[cardMoney]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.cardMoney}
                            </select>
                        </td>
                         <td>
                           收回垫付款
                        
                            <select name=index[advanceMoney]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.advanceMoney}
                            </select>
                        </td>
                        <td>
                           特定编号
                        
                            <select name=index[spID]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.spID}
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<!--
                        <td>
                            社保基数
                        </td>
                        <td>
                            <select name=index[radix]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.radix}
                            </select>
                        </td>
						-->
                        <td>
                            单位养老
                        
                            <select name=index[uPension]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uPension}
                            </select>
                        </td>
                        <td>
                            单位医疗
                        
                            <select name=index[uHospitalization]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uHospitalization}
                            </select>
                        </td>
                        <td>
                           单位工伤
                        
                            <select name=index[uEmploymentInjury]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uEmploymentInjury}
                            </select>
                        </td>
                        <td>
                            单位失业
                        
                            <select name=index[uUnemployment]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uUnemployment}
                            </select>
                        </td>
                        <td>
                            单位生育
                        
                            <select name=index[uBirth]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uBirth}
                            </select>
                        </td>
						 <td>
                            残障金
                        
                            <select name=index[uPDIns]>
                                <option value="">请选择列号</option>
                                {html_options values= $colName output= $colName selected=$zIndex.uPDIns}
                            </select>
                        </td>
                    </tr>
                </table>
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
        </fieldset>
        </fieldset>
        </div>
{include file='footer.tpl'}