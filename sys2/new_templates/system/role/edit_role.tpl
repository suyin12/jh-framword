{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("#checkall").click(function(){
	   if(this.checked){
		 $("div").find("input:checkbox").attr("checked",true);
	   }else{
		 $("div").find("input:checkbox").attr("checked",false);
	   }
	});
})
</script>
{/literal}
</head>
<body>
<form action="edit_role.php" method="post">
<table border="0" class="myTable">
 {foreach item=menu_val from=$menu_result}
  <tr>
    <td width="10%" valign="top"><label style="float: left"><input type="checkbox" onclick="" value="checkbox" name="chkGroup">{$menu_val.Menu_Name}</label></td>
    <td>
    {foreach item=fun_val key=menu_Key from=$menulist}
      {if $menu_Key==$menu_val.Menu_ID}
        {foreach item=val_fun from=$fun_val}        
          <div style="width:200px;float:left;">
            <label>
              <input type="checkbox" value={$val_fun.Fun_ID}
                {if $roleList|@count neq 0}
                  {foreach item=funstr from=$roleList}
                    {if $funstr==$val_fun.Fun_ID}
                      checked="true"
                    {/if}
                  {/foreach}                   
                 {/if}
                   name="action_code[]">
              {$val_fun.Fun_Name}
            </label>
          </div>
        {/foreach}
      {/if}
    {/foreach}
    </td>
  </tr>
 {/foreach}
 <tr>
    <td align="center" colspan="2">
      <input type="checkbox" onclick="checkAll(this.form, this);" value="checkbox" id="checkall" name="checkall" />全选      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" value=" 保存 " name="Submit" />&nbsp;&nbsp;&nbsp;
      <input type="reset" value=" 重置 " />
      <input type="hidden" value="{$roleID}" name="id" />
    </td>
  </tr>
</table>
</form>
{include file="footer.tpl"}