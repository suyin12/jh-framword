{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
<script>
	$(document).ready(function(){
		$("select[name=year]").change(function(){
			window.location.href ="http://"+location.host+location.pathname+"?year="+$(this).val();
		});
		
	$(".createFee").each(function(i){
		$(this). click(function(){
			var url = $(this).attr("dataSrc");
			tipsWindown('新建','iframe:'+url, '1000', '580', 'true', '', 'true', 'leotheme');
		});
	});
            //客户经理/单位二级联动
                linkage("select[name=mID]","select[name=unitID]",$('.js_unitManager').val());
           
	});
</script>
{/literal}
<div id="main">
     <fieldset>
 <legend><code>单位列表</code></legend>
  <form method="GET">
            <input type="hidden" class="js_unitManager" value='{$js_unitManager}'>
         <table>
                <tr>
                    <td>
                        <span>费用年份</span>
                        <select name="year">
                            <option>--请选择年份--</option>
                            {html_options options=$yearArr  selected=$s_year}
                        </select>
                    </td>
                    {include file="commonTPL/unitManagerLinkage.tpl"}
                    <td>
                        <input type="submit" name="wCS" value="提交" />
                    </td>
                </tr>
            </table>
      </form>
<table class="myTable">
            <thead>
                <tr>
                    <th>单位名称</th>
                    <th>费用年月</th>
                    <th>客户经理</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                {foreach item=manager from=$unitManager }
                    {foreach item=unit key=key   from=$manager}
                        {if $key eq 'unit'}

                            {foreach item=unitList from=$unit}
                                {if $s_unitID eq $unitList.unitID}
                                    <tr>
                                        <td>
                                            {$unitList.unitName}
                                        </td>
                                        <td>
                                            {foreach item=salaryList from=$ret}
                                                {if $salaryList.unitID eq $unitList.unitID}
                                                     <a href="{$httpPath|cat:'salaryManage/salaryManage.php?zID='|cat:'&month='|cat:$salaryList.month|cat:'&salaryDate='|cat:$salaryList.salaryDate|cat:'&unitID='|cat:$salaryList.unitID|cat:'&soInsDate='|cat:$salaryList.soInsDate|cat:'&comInsDate='|cat:$salaryList.comInsDate|cat:'&managementCostDate='|cat:$salaryList.managementCostDate}" target="_blank">{$salaryList.month|substr:4}	月</a> 	 |
                                                {/if}
                                            {/foreach}
                                        </td>
                                        <td>
                                            {$manager.mName}
                                        </td>
                                        <td>
                                            <input type="button" dataSrc="salaryZFChose.php?mID={$manager.mID}&unitID={$unitList.unitID}&process=salary" class="createFee"  value="新费用">
                                        </td>
                                    </tr>
                                {elseif !$s_unitID}
                                    <tr>
                                        <td>
                                            {$unitList.unitName}
                                        </td>
                                        <td>
                                            {foreach item=salaryList from=$ret}
                                                {if $salaryList.unitID eq $unitList.unitID}
                                               <a href="{$httpPath|cat:'salaryManage/salaryManage.php?zID='|cat:'&month='|cat:$salaryList.month|cat:'&salaryDate='|cat:$salaryList.salaryDate|cat:'&unitID='|cat:$salaryList.unitID|cat:'&soInsDate='|cat:$salaryList.soInsDate|cat:'&comInsDate='|cat:$salaryList.comInsDate|cat:'&managementCostDate='|cat:$salaryList.managementCostDate}" target="_blank">{$salaryList.month|substr:4}	月</a> 	 |
					 {/if}
                                            {/foreach}
                                        </td>
                                        <td>
                                            {$manager.mName}
                                        </td>
                                        <td>
                                            <input type="button" dataSrc="salaryZFChose.php?mID={$manager.mID}&unitID={$unitList.unitID}&process=salary" class="createFee"  value="新费用">
                                        </td>
                                    </tr>
                                {/if}
                            {/foreach}
                        {/if}
                    {/foreach}
                {/foreach}
            </tbody>
        </table>
</div>
{include file="footer.tpl"}