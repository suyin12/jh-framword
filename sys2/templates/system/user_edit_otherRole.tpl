{include file="noLeftHeader.tpl"}
<script type="text/javascript" src='{$httpPath}lib/jquery/jquery-1.5.2.min.js'></script>
<div id='mainBody'>
<fieldset> 
<legend><code>角色列表</code></legend>
<div>
<form method="post">
<div id="divroleOtherID">
    <table class="myTable " width="100%" >
        <thead>
        <tr>
        <th>部门</th>
        <th>角色</th>
        </tr>
        </thead>
    <tbody>
{foreach from=$allGroup item=val key=key}
        <tr>
            <td>{$val.groupName}</td>
         <td>
             {foreach from=$allRole item=v key=k}
                 {if $v.groupID eq ","|cat:$key|cat:"," && $userByIDResult['roleID'] neq $k}
                 <input type="checkbox" value='{$v.roleID}' name="ckbRole[]" {if in_array( $k,$userByIDResult['roleOtherID'])} checked="checked" {/if} >{$v.roleName}
                 {/if}       
             {/foreach}    
         </td>
        </tr>
{/foreach}
    </tbody>    
    </table>
</div>
<div class="clear">
<input type="submit" name="sub" value="提交" />
</div>
</form>
</div>
</fieldset>
</div>
{include file="footer.tpl"}