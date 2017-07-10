{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js></script>
{literal}
    <script type="text/javascript">
            $(document).ready(function(){
                
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
                       if(btnName=="addApprovalPro"){
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
        <fieldset class="left ">
            <legend><code>审批流程管理</code></legend>
            <p class="notice">流程格式提醒:标准格式为(附 mID:用户编号,roleID:角色编号)</p>
            <table name="approvalProEdit" class="myTable" width="100%" id="editTable">
                <thead>
                    <tr>
                        <th>审批编号</th>
                        <th>审批类型</th>
                        <th>审批名称</th>
                        <th>流程</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                 {foreach from=$ret item=v key=k}
                     <tr>
                       <td>{$v.appID}</td>
                       <td class="editTd" alt="type|{$v.appID}">{$v.type}</td>
                       <td class="editTd" alt="typeName|{$v.appID}">{$v.typeName}</td>
                       <td class="editTd" alt="process|{$v.appID}">{$v.process}</td>
                       <td>
                           <a class="aSub negative" name="delApprovalPro" alt='{$v.appID}'>删除</a>
                       </td>
                     </tr>
                 {/foreach}
                 <tr>
                     <form id="ApprovalPro">
                     <td></td>
                     <td><input type="text" name="type" size="5" /></td>
                     <td><input type="text" name="typeName" size="8" /></td>
                     <td><input type="text" name="process" size="30"/></td>
                     <td><a class="aSub positive" name="addApprovalPro">添加</a></td>
                     </form>
                 </tr>  
                </tbody>
            </table>
        </fieldset>
        
    </fieldset>
</div>
{include file="footer.tpl"}
