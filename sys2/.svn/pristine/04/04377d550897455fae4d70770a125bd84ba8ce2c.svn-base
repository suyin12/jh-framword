{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
<div id="mainBody">
    <fieldset>
        <legend><code>分配</code></legend>
<div>
<form method="post">
<table border="0">
  <tr>
    <td>客户经理</td>
  </tr>
  <tr>
    <td>
     {foreach from=$rowManager item=val}
       <input type="radio" name="rdomanager" value="{$val.mID}" />{$val.mName}
     {/foreach}
    </td>
  </tr>
  <tr>
    <td>业务文员</td>
  </tr>
  <tr>
    <td>
    {foreach from=$rowClerk item=val}
     <input type="radio" name="rdoclerk" value="{$val.mID}" />{$val.mName}
    {/foreach}
    </td>
  </tr>
  <tr>
    <td>社保专员</td>
  </tr>
  <tr>
    <td>
    {foreach from=$rowSoin item=val}
     <input type="radio" name="rdosoins" value="{$val.mID}" />{$val.mName}
    {/foreach}
    </td>
  </tr>
  <tr>
    <td><input type="submit" name="send" value="完成" /></td>
  </tr>
</table>

</form>
    </div>
</fieldset>
</div>
{include file="footer.tpl"}