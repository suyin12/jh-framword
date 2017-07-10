{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
    <script type="text/javascript">

        $(document).ready(function(){
                //刷新页面,用checkbox来控制
                checkReload(".reloadCheck");	
            //提交
            $(".sub").click(function(){
                var formID = this.form.id;
                var btnName = $(this).attr("name")
                var t, u, d, dt, m;
                t = "post";
                u = "sql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName+"&type=reward";
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
{/literal}
<div id="main">
    {if $validFee==0}
        <fieldset>
            <legend><code>原始奖金费用表预览</code></legend>
            <table class="myTable01 myTable">
                <thead>
                <form name="cSequenceForm">
                    <tr>
                        {foreach key=key item = fieldName from=$newFieldArr}
                            <th> {$fieldName}</th>
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
        {if $exSalaryRet || $rewardData}
            <div>
                <fieldset>
                    <legend><code>合并扣税设置</code></legend>
                    <p class="notice">特别提醒:勾选需要合并扣税的奖金批次及工资</p> 
                    <form id="mergeTaxForm">
                        <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                        <input type="hidden" name="month" value='{$smarty.get.month}'>
                        <input type="hidden" name="extraBatch" value='{$smarty.get.extraBatch}'>
                        {if $exSalaryRet}
                            <input type="checkbox" name="mergeTax[]" value="salary|{$rewardDate}"  {$rewardCheck.salary.0} >    <a href="{$httpPath}salaryManage/makeSalaryFee.php?month={$salaryMonth}&unitID={$unitID}&displaySp=true&fixTable=true" target="_blank">{$rewardDate}工资发放表</a>
                        {/if}
                        {foreach item=rVal key=rKey from=$rewardData }
                            <input type="checkbox" name="mergeTax[]" value="reward|{$rewardDate}|{$rKey}" {$rewardCheck.reward.$rKey} >    <a href="{$httpPath}rewardManage/makeReward.php?month={$month}&unitID={$unitID}&extraBatch={$rKey}&displaySp=true&fixTable=true" target="_blank">{$rewardDate}奖金发放表[{$rKey}]</a>
                        {/foreach}
                        <input type="checkbox" name="taxType" value="1" {$taxTypeCheck}>年终奖
                        <input type="button" class="sub" name="mergeTaxBtn" value="确定" />
                    </form>
                </fieldset>
            </div>
        {/if}
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
                                应发奖金 = 
                            </td>
                            <td>
                                {$formulasStr.pay}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                应缴纳税额 = 应发奖金
                            </td>
                            <td>
                                <input type="text" name="formulas[ratal]" value='{$formulasStr.ratal}' readonly=true size=100 />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                实发奖金 = 应发工资 - 个税
                            </td>
                            <td>
                                <input type="text" name="formulas[acheive]" value='{$formulasStr.acheive}' readonly=true size=100 />
                            </td>
                        </tr>

                    </table>
                    <input type="button" name="subFormulas" class="sub" value="提交公式">
                </form>
            </fieldset>
        </div>
        <div>
            <fieldset>
                <legend><code>发放表明细</code></legend>
                <p class="success">共{$salaryArr|@count}条记录
                    [ <input type="checkbox" class="reloadCheck" name="displaySp" value="1" {if $smarty.get.displaySp eq 'true'} checked='true' {/if} />  显示前50条 
                    <input type="checkbox"  class="reloadCheck" name="fixTable" value="1" {if $smarty.get.fixTable eq 'true'} checked='true' {/if} />  固定表头
                    <input type="checkbox"  class="reloadCheck" name="hideHeader" value="1" {if $smarty.get.hideHeader eq 'true'} checked='true' {/if} />  隐藏应发工资项
                    ]
                </p>
                <form method="post" action="">
                        按姓名查找: <input name="name" type="text"/> <input name="search" type=submit value="查找" />
                    </form>
                <table class="myTable02 myTable"  >
                    <thead>
                        <tr>
                            <th>姓名</th>
                            <th>单位</th>
                            <th>员工编号</th>
                            <th>工资账号</th>
                            {if $smarty.get.hideHeader neq 'true'}
                                {foreach item=pVal from=$payStr.0}
                                    <th>{$newFieldArr.$pVal}</th>
                                {/foreach}
                            {/if}
                            <th>应发奖金</th>
                            <th>应缴纳税额</th>
                            {if $rewardCheck}
                                {foreach from=$rewardCheck item=rCV key=rCK}
                                    {switch var=$rCK}
                                    {case 'salary'}
                                    <th>工资应税额</th>
                                    {if $taxTypeCheck neq 'checked'}
                                        <th>已扣工资税</th>
                                    {/if}
                                    {break}
                                    {case 'reward'}
                                    {foreach from=$rCV item=rV key=rK}
                                        <th>奖金应税额[{$rK}]</th>
                                        {if $taxTypeCheck neq 'checked'}
                                            <th>已扣奖金税[{$rK}]</th>
                                        {/if}
                                    {/foreach}
                                    {break}
                                    {/switch}
                                {/foreach}
                                {if $taxTypeCheck neq 'checked'}
                                    <th>应纳税额合计</th>
                                    <th>应扣个税合计</th>
                                    {else}
                                     <th>应税年终奖</th>
                                     <th>月均奖金</th>
                                     <th>税率</th>
                                {/if}
                            {/if}
                            <th>奖金税</th>
                            {foreach item=oVal from=$otherCostsStr.0}
                                <th>{$newFieldArr.$oVal}</th>
                            {/foreach}
                            <th>实发工资</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach item=sVal name=foo from=$salaryArr}
                            {if $smarty.foreach.foo.index eq 50 && $smarty.get.displaySp eq 'true'}
                                {break}
                            {/if}
                            {if $sVal.status eq '0'}
                                <tr class="red">
                                {else}
                                <tr>
                                {/if}
                                {foreach item=sv key=sk from=$sVal}
                                    {if $sk eq 'name'}
                                        <td>
                                            <a href="{$httpPath|cat:'workerInfo/wManage.php?uID='|cat:$sVal.uID}" target="_blank">{$sv}</a>
                                        </td>
                                    {elseif $sk eq 'status'  }
                                        {continue}
                                    {else}
                                        <td>
                                            {if is_numeric($sv) && $sk neq 'bID'}
                                                {$sv|string_format:"%.2f"|defaultNULL:''}
                                            {else}
                                                {$sv}
                                            {/if}
                                        </td>
                                    {/if}
                                {/foreach}
                            </tr>
                        {/foreach}
                        <tr>
                            {foreach item=totalCell from=$salaryTotalArr}
                                <td>
                                    {$totalCell}
                                </td>
                            {/foreach}
                        </tr>
                    </tbody>
                </table>
                <form method="post">
                    <table>
                        <tr>
                            <!--
                            <td ><input type="submit" name="edit" value="调整"></td>
                            -->
                            <td ><input type="submit" name="next" value="保存并返回费用表设计"></td>
                            <td ><input type="submit" name="salarySet" value="待发工资设置"></td>
                            <td><input type="submit" name="download" value="下载" ></td>
                        </tr>		    
                    </table>
                </form>
            </fieldset>
            {$showWindow}
        </div>
    {/if}
</div>
{include file="footer.tpl"}
