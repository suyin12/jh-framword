{include file="header.tpl"}
<div id="divgroupOther">
<form method="post">
{foreach key=groupKey item=groupVal from=$allGroup}
   <input type="checkbox" value="{$groupVal.groupID}" name="ckbGroupother[]" {foreach item=userGroupVal from=$userByIDResult.group_otherID} {if $userGroupVal eq $groupKey} checked="checked" {/if} {/foreach} value="{$groupVal.groupID}" />{$groupVal.groupName}<br/>
{/foreach}
<input type="hidden" name="UID" value={$userByIDResult.mID} />
<input type="submit" name="tijiao" value="提交" />
</div>
</from>
{include file="footer.tpl"}