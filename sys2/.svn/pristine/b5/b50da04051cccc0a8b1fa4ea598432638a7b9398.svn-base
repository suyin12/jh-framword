{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/3.js>
</script>
{literal}
<script type="text/javascript">
	
    $(document).ready(function(){
        //显示/隐藏全部数据
        //刷新页面,用checkbox来控制
        checkReload(":checkbox[name=displayAll]");
            });
    </script>
{/literal}   
<div id="main">
 <div>
 <p class="success"><span class="error"><img src="{$httpPath}css/images/external.png">  <a href="{$httpPath|cat:'salaryManage/createNewZFormat.php'}">   新建工资帐套</a></span></p>
 </div>
 <fieldset>
 <legend><code>帐套列表 </code>[ <input type="checkbox" name="displayAll" value="all" {if $smarty.get.displayAll eq 'true'}checked{/if}> 显示全部 ]</legend>
    <table class="myTable" width="100%">
        <thead>
            <tr>
                <th>
                    帐套名
                </th>
                <th>
                    帐套编号
                </th>
                <th>
                    操作人
                </th>
                <th>
                    上次修改时间
                </th>
                <th>
                    操作
                </th>
				<th>多单位模式切换</th>
            </tr>
        </thead>
        <tbody>
    {foreach item=zFInfo from=$ret }
                 <tr {if $zFInfo.status eq '0'}class="red"{/if}>
	                <td>
        {$zFInfo.zName}
	                </td>
	                <td>
        {$zFInfo.zID}
	                </td>
	                <td>
        {foreach item=manager from=$unitManager}
        {if $manager.mID eq $zFInfo.mID}{$manager.mName}{/if}
    {/foreach}
	                </td>
	                <td>
    {$zFInfo.modifyTime}
	                </td>
	                <td>
	                    <a href="createNewZFormat.php?zID={$zFInfo.zID}" class="noSub" target="_blank">编辑</a>
                             <a name="zFAction" class="aSub {if $zFInfo.status eq '0'}negative{/if}" title="{$zFInfo.zID}|status|0">失效</a>
                             <a name="zFAction" class="aSub {if $zFInfo.status eq '1'}positive{/if}" title="{$zFInfo.zID}|status|1">启用</a>
	                </td>
                        <td>
                            <a name="zFAction" class="aSub {if $zFInfo.model eq '1'}positive{/if}" title="{$zFInfo.zID}|model|1">是</a>
                            <a name="zFAction" class="aSub {if $zFInfo.model eq '0'}negative{/if}" title="{$zFInfo.zID}|model|0">否</a>
                        </td>
	          </tr>
{/foreach}
          
        </tbody>
    </table>
    </fieldset>
</div>
{include file="footer.tpl"}