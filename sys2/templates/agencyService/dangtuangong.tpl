{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">


<div id="main">

<table class="myTable">
<tr>
<th>姓名</th>
<th>性别</th>
<th>身份证号</th>
<th>电话</th>
<th>单位</th>
<th>党关系</th>
<th>党员类型</th>
<th>团关系</th>
<th>工会</th>
<th>备注</th>
</tr>
{foreach item=record from=$dtg}
<tr>
<td>{$record.name}</td>
<td>{$record.sex}</td>
<td>{$record.idcard}</td>
<td>{$record.tele}</td>
<td>{$record.unit}</td>
<td>{$record.dang}</td>
<td>{$record.dtype}</td>
<td>{$record.tuan}</td>
<td>{$record.gong}</td>
<td>{$record.remarks}</td>

</tr>
    {foreachelse}
<tr>
<td>没有记录</td>
</tr>
        {/foreach}
</table>
            {$pageList}

</div>
</div>
            {include file="footer.tpl"}