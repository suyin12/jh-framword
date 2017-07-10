{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	//全选
	$("#checkall").click(function(){
	   if(this.checked){
		 $("div").find("input:checkbox").attr("checked",true);
	   }else{
		 $("div").find("input:checkbox").attr("checked",false);
	   }
	});

	//按“模块”选择
	
})
</script>
{/literal}
</head>
<body>
<form action="user_editFunction.php" method="post">
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
                {if $functionList|@count gt 0}
                  {foreach item=funstr from=$functionList}
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
      <input type="checkbox" value="checkbox" id="checkall" name="checkall" />全选      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" value=" 保存 " name="Submit" />&nbsp;&nbsp;&nbsp;
      <input type="reset" value=" 重置 " />
      <input type="hidden" value="{$userID}" name="id" />
      <input type="hidden" value="{foreach item=fv from=$functionListByRole}{$fv},{/foreach}" name="functionIDSTR" />
    </td>
  </tr>
</table>
</form>
{include file="footer.tpl"}