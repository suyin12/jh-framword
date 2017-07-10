{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">


{literal}
<script type="text/javascript">

$(document).ready(function(){
	
	
});
</script>
{/literal}
<div id="main">
   <fieldset>
    <legend>
    <code>招聘需求明细</code>
    </legend>
<p><a href="javascript:history.back();" class="noSub positive">返回</a></p>
<table class="myTable" width="100%">
<tr>

<th >岗位名称</th>
<th >用工单位</th>
<th>上岗日期</th>
<th>需求数</th>
<!--<th>推荐数</th>-->
<!--<th>上岗数</th>-->
<!--<th>签收状态</th>-->
<!--<th>退回原因</th>-->
<th>填写人</th>
<th>填写日期</th>
<th>工作地点</th>
<!--<th>年龄</th>-->
<!--<th>性别</th>-->
<!--<th>学历</th>-->
<!--<th>身高</th>-->
<!--<th>岗位要求</th>-->
<!--<th>岗位职责</th>-->
<th>转正后工资</th>


</tr>

{foreach item=r from=$rd}
<tr>

<td><a href="requireInfo.php?id={$r.demandID}" target="_blank">{$r.name}</a></td>
<td>{$r.unitName}</td>
<td>{$r.deadline}</td>
<td>{$r.required}</td>
<!--<td>{$r.recommend}</td>-->
<!--<td>{$r.entry}</td>-->
<!--<td>{$r.status|replace:"1":"未签收"|replace:"2":"已退回"|replace:"3":"已签收"}</td>-->
<!--<td>{$r.rbackReason}</td>-->
<td>{$r.mName}</td>
<td>{$r.rCreatedOn}</td>
<td>{$r.workPlace}</td>
<!--<td>{$r.posAge}</td>-->
<!--<td>{$r.posSex}</td>-->
<!--<td>{$r.posDegree}</td>-->
<!--<td>{$r.posHeight}</td>-->
<!--<td>{$r.posOther}</td>-->
<!--<td>{$r.duty}</td>-->
<td>{$r.officialTotalSalary}</td>


</tr>


{foreachelse}
<td colspan="12" >无数据</td>
{/foreach}

</table>
    </fieldset>


</div>
{include file="footer.tpl"}