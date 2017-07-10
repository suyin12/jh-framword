{include file="header.tpl"}
<div id="main">
    <fieldset>
        <legend><code>临时数据</code></legend>
        <form>
            <select name="model">
                {html_options options=$modelArr selected=$s_model}
            </select>
        </form>
        <table class="myTable">
            <thead>
            <tr>
                <th></th>
                <th>姓名</th>
                <th>电话</th>
                <th>岗位</th>
                <th>状态</th>
                <th>来源</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            {foreach from=$tempJsonArr item=val key=key}
                {switch $key}
                    {case "talentID"}
                        {foreach from=$val item=v}
                        <tr>
                            <td></td>
                            <td><a href="{$httpPath}{$v.link}" target="_blank">{$v.nameTxt}</a></td>
                            <td>{$v.telephone}</td>
                            <td>{$v.positionName}</td>
                            <td>{$v.statusName}</td>
                            <td>人才库</td>
                            <td> <a class="delete negative">&#10005;</a></td>
                        </tr>
                        {/foreach}
                    {/case}
                    {case "uID"}
                        {foreach from=$val item=v}
                        <tr>
                            <td></td>
                            <td><a href="{$httpPath}{$v.link}" target="_blank">{$v.nameTxt}</a></td>
                            <td>{$v.telephone}</td>
                            <td>{$v.positionName}</td>
                            <td>{$v.statusName}</td>
                            <td>员工信息库</td>
                            <td> <a class="delete negative">&#10005;</a></td>
                        </tr>
                        {/foreach}
                    {/case}
                {/switch}
            {/foreach}
            </tbody>
        </table>
    </fieldset>
</div>
{include file="footer.tpl"}