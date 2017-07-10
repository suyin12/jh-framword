{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
<script type="text/javascript">

        $(document).ready(function(){
                //刷新页面,用checkbox来控制
                checkReload(":checkbox");	
            //提交
            $(".sub").click(function(){
                var formID = this.form.id;
                var btnName = $(this).attr("name")
                var t, u, d, dt, m;
                t = "post";
                u = "salarySql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=mulFee";
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
                var ret = confirm("确定" + $(this).val() + "?");
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            });
            //选择欲编辑的公式
            $("input[name^=formulas]").each(function(i){
                $(this).click(function(){
                    ret = confirm("确定编辑公式吗?");
                    if (ret) {
                        $("input[name^=formulas]").attr("readonly", true);
                        $(this).removeAttr("readonly");
                        this.focus();
                    }
                });
            });
	    
            //设置点击列表设置参数
            $(".chart").each(function(i){
                $(this).click(function(){
                    var chartVal = $(this).attr("id");
                    $("input[name^=formulas]").each(function(k){
                        if (!$(this).attr("readonly")) {
                            var val = $(this).val();
                            val = val + chartVal;
                            this.focus();
                            $(this).val(val);
                        }
                    });
                });
            });
            if(getQuery("fixTable")!="flase"){ 
            $('.myTable01').fixedHeaderTable({ height: '160', altClass: 'odd',fixedColumns: 1, themeClass: 'myTable' });
            $('.myTable02').fixedHeaderTable({ height: '600', altClass: 'odd',fixedColumns: 1, themeClass: 'myTable' });
            }    
        });
</script>
<style>
    .tableBoxOuter {
        width:100%;
        height:40em; 
    }
</style>
{/literal}
<div id="mainBody">
     <fieldset>
 <legend><code>验证信息</code></legend>
    <table class="myTable">
        <tr>
            <th>验证类型</th>
            <th>状态</th>
        </tr>
        <tr>
            <td>
                验证原始费用表人员信息
            </td>
            <td>
                        {if $validFee>0}<a href='{$originalFeeValidUrl}' target="_blank">未通过验证</a>{else}验证成功{/if}
            </td>
        </tr>
    </table>
           </fieldset> 
            
	{if $validFee==0}
            <fieldset>
 <legend><code>原始费用表预览</code></legend>
    <table class="myTable01 myTable" >
        <thead>
        <form name="cSequenceForm">
            <tr>
                {foreach key=key item = fieldName from=$newFieldArr}
                <th>{$fieldName}({$key})</th>
                {/foreach}
            </tr>
        </form>
        </thead>
        <tbody>
                {foreach item = val from =$ret}
            <tr>
                        {foreach item=v from=$val }
                <td>
                        {$v}
                </td>
                        {/foreach}
            </tr>
                {/foreach}
        </tbody>
    </table>
        </fieldset>
    <div>
        <fieldset>
 <legend><code>公式设置</code></legend>
        <p class="notice">特别提醒:选择下表中项,设置公式,这里的公式只能整列计算</p>
        <div id="formulasChart">
            <table class="myTable">
				{$formulasChartStr}
            </table>
        </div>
        <form name=formulasSet id = formulasSet>
            <input type="hidden" name="zID" value='{$zID}'>
            <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
            <input type="hidden" name="month" value='{$smarty.get.month}'>
            <input type="hidden" name="extraBatch" value='{$smarty.get.extraBatch}'>
            <input type="hidden" name="ID" value='{$formulasID}'>
            <table>
                <tr>
                    <td>
                        应发工资 =
                    </td>
                    <td>
                        <input type="text" name="formulas[pay]" value='{$formulasStr.pay}' readonly=true size=100 />
                    </td>
                </tr>
                <tr>
                    <td>
                        单位挂账 = 
                    </td>
                    <td>
                        <input type="text" name="formulas[uAccount]" value='{$formulasStr.uAccount}' readonly=true size=100 />
                    </td>
                </tr>
                <tr>
                    <td>总费用=应发工资+残障金+单位社保+单位公积金+单位商保+管理费+收回垫付款+单位挂账</td>
                    <td>
                        <input type="text" name="formulas[totalFee]" value='{$formulasStr.totalFee}' readonly=true size=100 />
                    </td>
                </tr>
            </table>
            <input type="button" name="subFormulas" class="sub" value="提交公式">
            <input type="button" name="deleteFormulas" class="sub" value="删除公式" />
        </form>
                    </fieldset>
    </div>
		{if $payStr.0}
    <div>
        <fieldset>
            <legend><code>费用表明细</code></legend>
        <p class="success">共{$feeArr|@count}条记录
		 [ <input type="checkbox" name="displaySp" value="1" {if $smarty.get.displaySp eq 'true'} checked='true' {/if} />  显示前50条 
            <input type="checkbox" name="fixTable" value="1" {if $smarty.get.fixTable eq 'true'} checked='true' {/if} />  固定表头
            <input type="checkbox" name="hideHeader" value="1" {if $smarty.get.hideHeader eq 'true'} checked='true' {/if} />  隐藏应发工资项
		    <input type="checkbox" name="hideFeeHeader" value="1" {if $smarty.get.hideFeeHeader eq 'true'} checked='true' {/if} />  隐藏费用项
		   	 <input type="checkbox" name="re" value="1" {if $smarty.get.re eq 'true'} checked='true' {/if} />  收回欠款模式
		  ]
        </p>
        <form method="post" action="">
                     按姓名查找: <input name="name" type="text"/> <input name="search" type=submit value="查找" />
         </form>
        <div>
            <form method="post" action="">
                <table class="myTable02 myTable"  id="mainTable">
                    <thead>
                        <tr>
                            <th rowspan="2">姓名</th>
                            <th rowspan="2">员工编号</th>
                            <th rowspan="2">单位</th>
                            <th rowspan="2">部门</th>
                            {if $smarty.get.hideHeader neq 'true'}
                            {foreach item=pVal from=$payStr.0}
                            <th rowspan="2">{$newFieldArr.$pVal}</th>
                            {/foreach}
                            {/if}
                            <th rowspan="2">应发工资</th>
                            {if $smarty.get.hideFeeHeader neq 'true'}
                            <th colspan="8">社保</th>
                            <th colspan="8">公积金</th>
                            <th colspan="8">商保</th>
                            <th colspan="8">管理费</th>
                            <th colspan="8">残障金</th>
                            {/if}
                            <th rowspan="2">收回垫付款</th>
                            <th rowspan="2">单位挂账</th>
                            {foreach item=oVal from=$otherCostsStr.0}
                            <th rowspan="2">{$newFieldArr.$oVal}</th>
                            {/foreach}
                            <th rowspan="2">总费用</th>
                        </tr>
                        {if $smarty.get.hideFeeHeader neq 'true'}
                        <tr>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>累计欠款</th>
                            <th>均衡值</th>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>累计欠款</th>
                            <th>均衡值</th>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>累计欠款</th>
                            <th>均衡值</th>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>累计欠款</th>
                            <th>均衡值</th>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>累计欠款</th>
                            <th>均衡值</th>
                        </tr>
                        {/if}
                    </thead>
                    <tbody>
                            {foreach item=fVal name=foo  from=$feeArr}
                                    {if $smarty.foreach.foo.index eq 50 && $smarty.get.displaySp eq 'true'}
                                       {break}
                                    {/if}
                                {if $fVal.status eq '0'}
                        <tr class="red">
                                {else}
                        <tr>
                                {/if}
                                        {foreach item=fv key=fk from=$fVal}
                                        {if $fk eq 'name'}
                            <td>
                                <a href="{$httpPath|cat:'workerInfo/wManage.php?uID='|cat:$fVal.uID}" target="_blank">{$fv}</a>
                            </td>
                                        {elseif $fk eq 'status'}
                                                {continue}
                                        {elseif $fk eq 'PDInsMargin'|| $fk eq 'soInsMargin' || $fk eq 'HFMargin' || $fk eq 'comInsMargin' || $fk eq 'managementCostMargin'}
                            <td class="highLight">{$fv}</td>
                                    {else}
                            <td>
                                            {if is_numeric($fv)}
                                            {$fv|string_format:"%.2f"|defaultNULL:''}
                                    {else}
                                            {$fv}
                                    {/if}
                            </td>
                                    {/if}
                                    {/foreach}
                        </tr>
                            {/foreach}
                        <tr>
                                {foreach item=totalCell from=$feeTotalArr}
                            <td>
                                {if  is_numeric($totalCell)}
                                        {$totalCell|string_format:"%.2f"|defaultNULL:''}
                                {else}
                                        {$totalCell}
                                {/if}

                            </td>
                                {/foreach}
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tr >
                       <td ><input type="submit" name="edit" value="调整"  ></td>
                        <td ><input type="submit" name="save" value="保存并制作工资表"  ></td>
                        <td>       
                            <input type="button"  value="公积金申报" onclick="javascript:window.open('{$httpPath}workerInfo/editHousingFund.php?month={$smarty.get.month}&mID={$smarty.session.exp_user.mID}&unitID={$smarty.get.unitID}')">
                        </td>        
                        <td ><input type="submit" name="subApproval" value="提交审批"  ></td>
                        <td><input type="submit" name="download" value="下载" ></td>
                    </tr>
                </table>
                        </fieldset>
                    {literal}
                <script type="text/javascript">
                        if(typeof tableScroll == 'function'){tableScroll('mainTable');}
                </script>
                    {/literal}
            </form>
        </div>
            {/if}
    </div>
    {$showWindow}
    {/if}
</div>
{include file="footer.tpl"}