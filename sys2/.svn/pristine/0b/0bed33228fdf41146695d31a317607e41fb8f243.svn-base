{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>
    $(document).ready(function(){
        //提交
       $("#backup").submit(function(){
           var msg ="数据库备份及恢复需要较长的时间,请尽量选择无人使用的时段进行操作";
           if(confirm(msg)){
               return true;
            }
        });
     });       
</script>
{/literal}
<div id="main">
    <fieldset>
        <form action="" method="post" id="backup">
            <input type="submit" name="backup" value="生成备份文件" />
        </form>
        <p class="notice">1.暂时不开通数据库恢复功能,以免造成错误操作,造成无法挽回的后果<br>2.超过5个备份,将自动删除之前备份</p>
        <fieldset>
            <legend><code>备份数据列表</code></legend>
            <table class="myTable" width="100%">
                <tr>
                    <th>名称</th>
                    <th>大小</th>
                    <th>创建日期</th>
                </tr>
                {foreach from=$fileArr item=val}
                    <tr>
                        <td>{$val.name}</td>
                        <td>{$val.size}(kb)</td>
                        <td>{$val.createTime}</td>
                    </tr>
                {/foreach}    
            </table>
        </fieldset>

    </fieldset>
</div>
{include file="footer.tpl"}