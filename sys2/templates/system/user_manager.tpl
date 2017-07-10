{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
             formSubmit("", ".selPost", "change", ".conditionForm");   
            //全选
            $("#allbox").click(function(){
                       if(this.checked){
                             $("td").find("input:checkbox").attr("checked",true);
                             $(".ckbclass").each(function(){	 
                             })
                       }else{
                             $("td").find("input:checkbox").attr("checked",false);
                       }
            });
            //清空密码
            $(".tSub").click(function(){
                    var Ustr="";
                      var btnName=$(this).attr("id");  
                    $("input[type=checkbox]:checked").each(function(){
                            Ustr=Ustr+$(this).attr("value")+",";
                            return true; 
                    });
                    if(Ustr==""){
                            alert("请选择");
                    }
                    else{
                            location.href="user_Del_Pwd.php?type="+btnName+"&Str="+Ustr;			
                    }
		
            })
	
    })
    </script>
{/literal}
<div id="main">
    <fieldset> 
        <legend><code>系统用户管理</code></legend>
        <table class="myTable" width="100%">
            <thead>
                <tr>
            <form action="" method="get" class="conditionForm">
                <th>选择</th>
                <th>用户名<select id="selStruts" class="selPost" name="selStruts">
                        <option {if $vstatus== "1"} selected="selected" {/if} value="1">在职</option>
                        <option {if $vstatus== "0"} selected="selected" {/if} value="0">离职</option>
                    </select></th>
                <th>部门<select id="selGroup" class="selPost" name="selGroup">
                        <option value="">==选择部门==</option>
                        {foreach item=groupVal from=$allGroup}
                            <option {if $vgroupID==$groupVal.groupID}selected="selected"{/if} value="{$groupVal.groupID}">{$groupVal.groupName}</option>
                        {/foreach}
                    </select></th>
                <th>角色<select id="selRole" class="selPost" name="selRole">
                        <option value="">==选择角色==</option>
                        {foreach item=roleVal from=$allRole}
                            <option {if $vroleID==$roleVal.roleID}selected="selected"{/if} value="{$roleVal.roleID}">{$roleVal.roleName}</option>
                        {/foreach}
                    </select></th>
                <th>操作 <a class="noSub" href="user_edit.php" >添加人员</a></th>
            </form>
            </tr>
            </thead>
            <tbody>
                {foreach item=userInVal from=$allUserIn}
                    <tr>
                        <td class="ckbclass"><input type="checkbox" value="{$userInVal.mID}" name="ckbUID"></td>
                        <td>{$userInVal.mName}</td>
                        <td>{foreach from=$userInVal['groupID'] item=v}
                             [ {$allGroup[$v]['groupName']} ]
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$userInVal['roleID'] item=v}
                             [ {$allRole[$v]['roleName']} ]
                            {/foreach}
                        </td>
                        <td><a class="noSub positive" href="user_edit.php?id={$userInVal.mID}">编辑</a>
                            <a class="noSub positive" href="user_editFunction.php?id={$userInVal.mID}">访问权限</a></td>
                    </tr>
                    {/foreach}
                    </tbody>
                    <tfoot>
                        <tr align="center">
                            <td><input type="checkbox" onclick="" id="allbox" name="allbox" value="ckball"></td>
                            <td><label>全选</label></td>
                            <td><input type="button" title="重置密码" id="delPwd" class="tSub" value="重置密码"></td>
                            <td colspan="2"><input type="button" title="禁止登录" class="tSub" id="noLogin" value="禁止登录"></td>
                        </tr>
                    </tfoot>
                </table>
            </fieldset> 
            {include file="footer.tpl"}
