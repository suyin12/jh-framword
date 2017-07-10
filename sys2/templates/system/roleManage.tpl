{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script language="javascript" src="{$httpPath}lib/js/tipswindown.js"></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js></script>
{literal}
    <script type="text/javascript">
            $(document).ready(function(){
                //费用处理
                    $(".editSub").each(function(i){
                        $(this).click(function(){
                            var thisUrl = $(this).attr("alt");
                            tipsWindown('调整费用', 'iframe:' + thisUrl, 680,400, 'true', '', 'true', 'leotheme','true');
                        });
                    });
                        function del(url,n)
                            {
                              if(confirm('确定删除该数据'))
                              {
                                location.href=url+'?edit=del&delid='+n;
                              }
                            }
                  //修改信息
                  $(".editTd").editable("sysSql.php", {
                    type: "text",
                    submit: "确定",
                    width: "10",
                    submitdata: function(){
                        var field = $(this).attr("alt");
                        var btnName=$(this).parents("table").attr('name');  
                        return {
                            field: field,
                            btn: btnName
                        };
                    },
                    event: "click",
                    onblur: "cancel",
                    placeholder: "",
                    ajaxoptions: {
                        dataType: "json"
                    }
                });
                   //删除,添加
                    $(".aSub").click(function(){
                        var btnName = $(this).attr("name");
                        var t, u, d, dt, m;
                        t = "post";
                        u = "sysSql.php";
                       if(btnName=="addRole"||btnName=="addGroup"){
                           formID = btnName.replace("add","");                            
                            d = $("#" + formID).serialize() + "&btn=" + btnName;
                            }else{
                            d ="ID="+$(this).attr("alt") + "&btn=" + btnName;
                             }
                        dt = "json";
                        m = function(json){
                            var i, n, k, v;
                            $.each(json, function(i, n){
                                switch (i) {
                                    case "error":
                                        alert(n);
                                        break;
                                    case "succ":
                                        alert(n);
                                            window.location.reload();
                                        break;
                                }
                            });
                        };
                        var ret = confirm("确定" + $(this).text() + "?");
                        if (ret == true) {
                            ajaxAction(t, u, d, dt, m);
                        }
                    });
            });
    </script>
{/literal}
<div id="main">
    <fieldset>
        <fieldset class="left  halfWidth">
            <legend><code>角色管理</code></legend>
            <table name="roleEdit"  class="myTable" width="100%" id="editTable">
                <thead>
                    <tr>
                        <th>角色编号</th>
                        <th>角色名称</th>
                        <th>隶属组别</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                 {foreach from=$roleArr item=v key=k}
                     <tr>
                       <td class="editTd" alt="roleID|{$v.roleID}" >{$v.roleID}</td>
                       <td class="editTd" alt="roleName|{$v.roleID}">{$v.roleName}</td>
                       <td class="editTd" alt="groupID|{$v.roleID}">{$v.groupID}</td>
                       <td><a class="noSub" href="{$httpPath}system/edit_role.php?id={$v.roleID}">设置访问权限</a> 
                           <a class="aSub negative" name="delRole" alt='{$v.roleID}'>删除</a>
                       </td>
                     </tr>
                 {/foreach}
                 <tr>
                     <form id="Role">
                     <td><input type="text" name="roleID"  size="3"/></td>
                     <td><input type="text" name="roleName" size="8" /></td>
                     <td><input type="text" name="groupID" size="3"/></td>
                     <td><a class="aSub positive" name="addRole">添加</a></td>
                     </form>
                 </tr>  
                </tbody>
            </table>
        </fieldset>
        <fieldset class="right  halfWidth">
            <legend><code>组管理</code></legend>
            <table name="groupEdit"  class="myTable" width="100%" id="editTable">
                <thead>
                    <tr>
                        <th>组编号</th>
                        <th>组名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                 {foreach from=$groupArr item=v key=k}
                     <tr>
                       <td class="editTd" alt="groupID|{$v.groupID}" >{$v.groupID}</td>
                       <td class="editTd" alt="groupName|{$v.groupID}">{$v.groupName}</td>
                       <td>
                           <a class="aSub negative" name="delGroup" alt='{$v.groupID}'>删除</a>
                       </td>
                     </tr>
                 {/foreach}
                 <tr>
                 <form id="Group">
                     <td><input name="groupID" size="3"/></td>
                     <td><input name="groupName" size="8" /></td>
                     <td><a class="aSub positive" name="addGroup">添加</a></td>
                 </form>    
                 </tr>  
                </tbody>
            </table>
        </fieldset>
    </fieldset>
</div>
{include file="footer.tpl"}
