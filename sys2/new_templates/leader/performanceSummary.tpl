{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/fixedTable.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
<script type="text/javascript">

    $(document).ready(function(){
        $('.myTable').fixedHeaderTable({ height: '500', altClass: 'odd',fixedColumns: 1, themeClass: 'myTable' });
    });
</script>
    {/literal}

<div id="main">
        <!--
        <form>
                <select name="mon">
    {html_options options=$monArr selected=$s_mon}
                </select>
        </form>
        -->
        <table class="myTable" >
                <thead>
                        <tr>
    <th rowspan="2">用工单位名称</th>
    <th colspan="3">在册人数</th>
    <th colspan="5">劳动合同</th>
    <th colspan="3">工资</th>
    <th colspan="3">社会保险</th>
    <th colspan="2">商业保险</th>
    <th colspan="2">互助会</th>
    <th colspan="2">户籍类别</th>
    <th>居住证</th>
    <th>社保卡</th>
    <th colspan="3">招聘</th>
    <th colspan="4">工伤、意外</th>
        <th rowspan="2">客户经理</th>
  </tr>
  <tr>
    <th>本月新增</th>
    <th>本月减少</th>
    <th>正常在册</th>
    <th>本月新签</th>
    <th>本月续签</th>
    <th>新签实习生</th>
    <th>其它情况</th>
    <th>合同累计人数</th>
    <th>应发人数</th>
    <th>实发人数</th>
    <th>待发人数</th>
    <th>本月新增</th>
    <th>本月减少</th>
    <th>参保人数</th>
    <th>实收人数</th>
    <th>实缴人数</th>
    <th>本月新增</th>
    <th>会员总数</th>
    <th>深户</th>
    <th>非深户</th>
    <th>本月办理人数</th>
    <th>本月办理人数</th>
    <th>需求岗位数</th>
    <th>推荐人数</th>
    <th>上岗人数</th>
    <th>工伤发案数</th>
    <th>意外发案数</th>
    <th>本月结案数</th>
    <th>累计未结案数</th>
  </tr>
                </thead>
                <tbody>
    {foreach from=$unitManager item =num key=key}
        {foreach from=$num.unit key=k item=unit}
            {assign var="unitID" value=$unit.unitID}
                                <tr>
                                        <td>{$unit.unitName}</td>
                                        <td>{$wIncreaseCount.$unitID}</td>
                                        <td>{$wDecreaseCount.$unitID}</td>
                                        <td>{$wCount.$unitID}</td>
                                        <td>{$cIncreaseCount.$unitID}</td>
                                        <td>{$cRenewalCount.$unitID}</td>
                                        <td>{$cStIncreaseCount.$unitID}</td>
                                        <td>{$cOtIncreaseCount.$unitID}</td>
                                        <td>{$cTotalCount.$unitID}</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>{$sInsIncreaseCount.$unitID}</td>
                                        <td>{$sInsDecreaseCount.$unitID}</td>
                                        <td>{$sInsCount.$unitID}</td>
                                        <td>缺</td>
                                        <td>{$cInsCount.$unitID}</td>
                                        <td>{$heIncreaseCount.$unitID}</td>
                                        <td>{$heCount.$unitID}</td>
                                        <td>{$szCount.$unitID}</td>
                                        <td>{$nszCount.$unitID}</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>缺</td>
                                        <td>{$num.mName}</td>
                                </tr>
        {/foreach}
    {/foreach}
                        <tr></tr>
                </tbody>
        </table>
</div>
{include file="footer.tpl"}