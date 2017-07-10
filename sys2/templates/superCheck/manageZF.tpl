{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
    <script>
        //salaryManage/createNewZFormat.tpl
$(document).ready(function(){
      //提交
            $(".aSub").click(function(){
                var btnName = $(this).attr("name");
                        var zID= $(this).attr("title");
                var t, u, d, dt, m;
                t = "post";
                u = "sql.php";
                d =  "btn=" + btnName + "&zID="+zID;
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
    <div>
        <p class="success"><span class="error"><img src="{$httpPath}css/images/external.png">  <a href="{$httpPath|cat:'superCheck/createNewZFormat.php'}">   新建方案</a></span></p>
    </div>
    <fieldset>
        <legend><code>方案列表</code></legend>
        <table class="myTable">
            <thead>
                <tr>
                    <th>
                       方案名
                    </th>
                    <th>
                       方案编号
                    </th>
                    <th>
                        操作人
                    </th>
                    <th>
                        操作
                    </th>
                    <th>公开性</th>
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
                        <a href="createNewZFormat.php?zID={$zFInfo.zID}" target="_blank">编辑</a>
                        | <a name="zFAction" class="aSub" title="{$zFInfo.zID}|status|0">失效</a>
                        | <a name="zFAction" class="aSub" title="{$zFInfo.zID}|status|1">启用</a>
                    </td>
                    <td>
                        <a name="zFAction" class="aSub" title="{$zFInfo.zID}|model|1"><span {if $zFInfo.model eq '1'} class="red"{/if}>是</span></a>
                        | <a name="zFAction" class="aSub" title="{$zFInfo.zID}|model|0"><span {if $zFInfo.model eq '0'} class="red"{/if}>否</span></a>
                    </td>
                </tr>
            {/foreach}

        </tbody>
    </table>
</fieldset>
</div>
{include file="footer.tpl"}