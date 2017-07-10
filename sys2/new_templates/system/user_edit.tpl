{include file="header.tpl"}
<script language="javascript" src="{$httpPath}lib/js/tipswindown.js"></script>
{literal}

<script type="text/javascript">
<!--
$(document).ready(function(){
	//清空辅助角色
	$("#delRole").click(function(){
	   $("#treRole").attr("value","");
	});
	//清空附属部门
	$("#delGroup").click(function(){
	   $("#treGroup").attr("value","");
	});

	$("#selRole").each(function(i){
		$(this). click(function(){
			var url = $(this).attr("dataSrc");
			//alert(url);
			tipsWindown('辅助角色','iframe:'+url, '1000', '400', 'true', '', 'true', 'leotheme','true');
		});
	});
	
	$("#selGroupOther").each(function(i){
		$(this). click(function(){
			var url = $(this).attr("dataSrc");
			//alert(url);
			tipsWindown('附属部门','iframe:'+url, '300', '580', 'true', '', 'true', 'leotheme','true');
		});
	});
	
	
}); 
//-->
</script>
{/literal}
<div id="main">
<fieldset>
    <a class="noSub positive" href="{$httpPath}system/user_manager.php">返回</a>
 <fieldset>
    <legend><code>角色信息</code></legend>    
<form action="" method="post">
<table class="myTable halfWidth">
<tbody>
<tr><td>用户名：</td><td><input type="text"  name="userName" value="{$userByIDResult.mName}" /></td></tr>
{if !$smarty.get.id}
<tr><td>密码：</td><td><input type="text" name="mPW"  value="" /></td></tr>
{/if}
</tr>
<tr><td>部门：</td>
<td>
    {foreach from=$groupArr item=v}
        [ {$allGroup[$v].groupName} ]
    {/foreach}
</td></tr>
<tr><td>主角色：</td>
<td>
<select name="selRole">
        {if $userByIDResult.roleID}
        <option value="{$userByIDResult.roleID}" selected>{$allrole[$userByIDResult.roleID]['roleName']}</option>
        {/if}
    {foreach item=roleVal from=$allrole}
        {if !in_array($roleVal['roleID'],$roleArr) }
         <option value="{$roleVal.roleID}" >{$roleVal.roleName}</option>
        {/if}
        
    {/foreach}
</select>
</td></tr>
{if $smarty.get.id}
<tr><td>辅助角色：</td>
<td>
{if $userByIDResult.roleOtherID|@count gt 0}
 {foreach item=roleOtherVal from=$userByIDResult.roleOtherID}
   {foreach key=roleKey item=roleVal from=$allrole}
     {if $roleOtherVal eq $roleKey} 
      {$roleVal.roleName},
     {/if}
   {/foreach}
 {/foreach}
{else}
&nbsp;
{/if}
<a href="javascript:" datasrc="user_edit_otherRole.php?id={$userByIDResult.mID}" id="selRole">&nbsp;+&nbsp;选择</a>
</td>
</tr>
{/if}
</tbody>
</table>
 </fieldset>
 <fieldset>
    <legend><code>分管单位</code></legend> 
 <table >
 <tbody>
<tr>
 <td>&nbsp;</td>
 <td>
 <div id="divUnitInfo">
   {if $userByIDResult.unitID|@count gt 0}
     {foreach key=allunitKey item=allunitVal from=$allUnitInfo}
       {foreach item=unitVal from=$userByIDResult.unitID}
         {if $unitVal eq $allunitKey}
           <input name="ckbUnitInfo[]" checked="checked" value="{$allunitVal.unitID}" type="checkbox">{$allunitVal.unitName}</input><br/>            
         {/if}
       {/foreach}
     {/foreach}
    {else}
        {$userByIDResult.mName} 没有负责的派遣单位        
    {/if}   
     {if $unitList|@count gt 0 && $userByIDResult.status==1}
                  请选择以下单位<br/>
       {foreach item=unitListVal from=$unitList}
         <input name="ckbUnitInfo[]" value="{$unitListVal.unitID}" type="checkbox">{$unitListVal.unitName}</input><br/>
       {/foreach}
     {/if}
 </div>   
 </td>
</tr>
</tbody>
</table>
 </fieldset>
  <input type="hidden" name="userID" value="{$userByIDResult.mID}" />
   <input type="hidden" name="roleOtherID" value="{foreach item=Rval from=$userByIDResult.roleOtherID}{$Rval},{/foreach}" />
   <input type="hidden" name="groupOtherID" value="{foreach item=Gval from=$userByIDResult.group_otherID}{$Gval},{/foreach}" />
   <input type="submit" name="editUser" value="确定" />&nbsp;
</form>
</fieldset>
</div>
{include file="footer.tpl"}