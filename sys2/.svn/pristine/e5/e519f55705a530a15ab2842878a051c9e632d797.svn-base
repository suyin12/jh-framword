{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("select[name=soInsDate]").change(function(){
		$("#soInsDateForm").submit();
	});
	$("select[name=HFDate]").change(function(){
		$("#HFDateForm").submit();
	});
	//费用处理
    $(".editSub").each(function(i){
        $(this).click(function(){
            var thisUrl = $(this).attr("alt");
            tipsWindown('导入社保缴交明细','iframe:'+thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
        });
    });
    //提交
    $(".aSub").click(function(){
        var formID = $(this).parents("form").attr("id");
        var btnName = $(this).attr("name");
        var type = $(this).attr("title");
        var t, u, d, dt, m;
        t = "post";
        u = "aSQL.php";
        d = $("#" + formID).serialize() + "&type=" + type + "&btn=" + btnName+"&soInsID="+$(this).attr("alt");
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
                var ret = confirm("确定" + $(this).text()+ "?");
                if (ret == true) {
                   ajaxAction(t, u, d, dt, m);
                }
    });
    //提交
    $(".sub").click(function(){
        var formID = $(this).parents("form").attr("id");
        var id = $(this).attr("title");
        var btnName = $(this).attr("name");
        var paydate = $(this).attr("alt");
        var tt = $(this).val();
        var t, u, d, dt, m;
        t = "post";
        u = "aSQL.php";
        d = $("#" + formID).serialize() + "&id=" + id + "&paydate=" + paydate + "&tt=" + tt + "&btn=" + btnName;
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
                if($("#" + formID).serialize().length !==0 && tt!=='入账'){
                    fun1(0);
                }
            }
    });
    //删除fID
    $(".del").click(function(){
        var fIDsoIns = $(this).attr("title");
        var btnName = $(this).attr("name");
        var t, u, d, dt, m;
        t = "post";
        u = "aSQL.php";
        d = "fIDsoIns=" +fIDsoIns + "&btn=" + btnName;
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
    
});
function changeAll(){
	var checkedAll=$("#all").get(0).checked;
	$("[type='checkbox']").each(function(index){
		this.checked=checkedAll;
	});
}
</script>
{/literal}
<script>
function fun1(i){
    var ob=$(".sub").val("正在提交……请稍候"+i);
    i++;
    setTimeout("fun1("+i+")",1000);
}
</script>
<div id="main">
    <div>
        <fieldset><legend><code>平账年月</code></legend>
        <form id="soInsDateForm" method="get">
            <span>社保年月</span>
            <select name="soInsDate">
                <option value="">---请选择---</option>
               {html_options options=$soInsMonAll selected=$s_soInsDate} 
            </select>
        </form>
        <form id="HFDateForm" method="get">
            <span>公积金年月</span>
            <select name="HFDate">
                <option value="">---请选择---</option>
                {html_options options=$HFMonAll selected=$s_HFDate}
            </select>
        </form>
        {if $s_soInsDate}
        <input type="button" class="editSub" alt="{$httpPath}excelAction/readExcel.php?a=soInsFeeAgmInsert&soInsDate={$s_soInsDate}" value="①导入社保缴交明细 ">
        <input type="button" class="editSub" alt="{$httpPath}excelAction/readExcel.php?a=soInsFeeMulAgmInsert&soInsDate={$s_soInsDate}" value="①导入社保补交缴交明细 ">
        {else}
        <input type="button" class="editSub"  alt="{$httpPath}excelAction/readExcel.php?a=hfFeeAgmInsert&HFDate={$s_HFDate}" value="②导入公积金缴交明细 ">
        {/if}
        </fieldset>
   </div>
   {if $s_HFDate}
   <div>
   <fieldset><legend><code>公积金缴交明细</code></legend>
        <p class="notice">提示:如果删除公积金缴交明细的话,将会一并删除未入账的平账数据</p>
        <form id="HFFeeDetailForm">
            <input type="hidden" name="HFDate" value="{$s_HFDate}">
            <table class="myTable">
                <tr>
                    <th>公积金帐号</th>
                    <th>公积金年月</th>
                    <th>验证状态</th>
                    <th>操作</th>
                </tr>
                {foreach from=$HFIDArr item=existsRet}
                <tr>
                    <td>
                    	{$existsRet.housingFundID}
                    </td>
                    <td>
                   		{$existsRet.HFDate}
                    </td>
                    <td>
                    	{if !$existsRet.dID && $existsRet.HFDate}<a href='{$httpPath}agencyService/validHFAgm.php?HFDate={$existsRet.HFDate}' target="_blank">点击验证</a>{elseif $existsRet.HFDate}验证成功{/if}
                	</td>
	                <td>
	                    <a class="noSub" href="{$httpPath}agencyService/HFAgmDetail.php?HFDate={$existsRet.HFDate}&housingFundID={$existsRet.housingFundID}" target="_blank">查看</a>
						<a class="aSub" alt="{$existsRet.housingFundID}" name="deleteHFAgmDetail" >删除</a>
	                </td>
            	</tr>
            	{foreachelse}
				
                {/foreach}
            </table>
         </form>
      </fieldset>
   </div>
   <div>
         <fieldset><legend><code>公积金平账表</code></legend>
         <form id="HFAgmForm" name="HFAgmForm">
         <input type="button" class="sub" name="HFAgmFee" value="提交平账结果" alt="{$s_HFDate}">
            <table class="myTable">
            	<tr><th rowspan="2"><input type="checkbox" id="all" onclick="changeAll();" checked="checked"/>全选</th><th rowspan="2">序号</th><th rowspan="2">公积金号</th><th rowspan="2">姓名</th><th rowspan="2">投保基数</th><th rowspan="2">应收合计</th><th colspan="2">应收金额</th><th colspan="2">缴社保局费用</th><th rowspan="2">均衡值</th><th rowspan="2">操作和状态</th></tr>
            	<tr><th>个人合计</th><th>单位合计</th><th>应缴保险</th><th>实缴保险</th></tr>
            	{foreach from=$HFDateList item=HF name=name}
            	<tr>
            		<td><input type="checkbox" name="fID[{$HF.fID}]" value=""  checked="checked"/>
            			<input type="hidden" name="paydate" value="{$s_HFDate}"></td>
	            	<td>{$smarty.foreach.name.iteration}</td>
	            	<td>{$HF.HFID}</td>
	            	<td><a href="aManage.php?id={$HF.fID}">{$HF.name}</a>{$HF.HFDate}</td>
	            	<td>{$HF.HFradix}</td>
	            	<td>{$HF.total}</td>
	            	<td>{$HF.pTotal}</td>
	            	<td>{$HF.uTotal}</td>
	            	<td>{$HFprice[$HF.fID]}</td>
	            	<td>{$billArr[$HF.fID]["HF"]}</td>
	            	<td><font color='red'>
	            	{{$HFprice[$HF.fID]} - {$HF.HFprice}}
	            	{if {{$HFprice[$HF.fID]} - {$HF.HFprice}}==0}
	            	<input type="hidden" name="fID[{$HF.fID}][status]" value="1">
	            	{else}{/if}
	            	</font></td>
	            	<td>{$aInfoSet["billstatus"][$HF.status]}{if $HF.status=='2'}　<input type="button" value="入账" class="sub" name="HFAgmFee" title="{$HF.fID}" alt="{$s_HFDate}"/>{/if}</td>
            	</tr>
            	{/foreach}
            </table>
         </form>
         </fieldset>
     </div>
	{else}
   <div>
   <fieldset><legend><code>社保缴交明细</code></legend>
        <p class="notice">提示:如果删除社保缴交明细的话,将会一并删除未入账的平账数据</p>
        <form id="soInsFeeDetailForm">
            <input type="hidden" name="soInsDate" value="{$s_soInsDate}">
            <table class="myTable">
                <tr>
                    <th>社保帐号</th>
                    <th>社保年月</th>
                    <th>验证状态</th>
                    <th>操作</th>
                </tr>
                {foreach from=$soInsIDArr item=existsRet}
                <tr>
                    <td>
                    	{$existsRet.soInsID}
                    </td>
                    <td>
                   		{$existsRet.soInsDate}
                    </td>
                    <td>
                    	{if !$existsRet.dID && $existsRet.soInsDate}<a href='{$httpPath}agencyService/validSoInsAgm.php?soInsDate={$existsRet.soInsDate}&type={$existsRet.type}' target="_blank">点击验证</a>{elseif $existsRet.soInsDate}验证成功{/if}
                	</td>
	                <td>
	                    <a class="noSub" href="{$httpPath}agencyService/soInsAgmDetail.php?soInsDate={$existsRet.soInsDate}&soInsID={$existsRet.soInsID}&type={$existsRet.type}" target="_blank">查看</a>
						<a class="aSub" alt="{$existsRet.soInsID}" name="deleteSoInsAgmDetail" title="{$existsRet.type}">删除</a>
	                </td>
            	</tr>
            	{foreachelse}
				
                {/foreach}
            </table>
         </form>
      </fieldset>
     </div>
     <div>
         <fieldset><legend><code>社保平账表</code></legend>
         <form id="soInsAgmForm" name="soInsAgmForm">
         <input type="button" class="sub" name="soInsAgmFee" value="提交平账结果" alt="{$s_soInsDate}">
         	{if $Solate}
         	<table class="myTable">
         		<tr><th>电脑号</th><th>姓名</th><th>身份证</th><th>缴交基数</th><th>合计</th><th>应缴金额(包含滞纳金)</th><th>实缴金额</th><th>均衡值</th><th>操作和状态</th></tr>
            	{foreach from=$Solate item=Ss}
            	<tr>
            		<td>{$Ss.sID}<input type="hidden" name="paydate" value="{$s_soInsDate}"></td>
            		<td><a href="aManage.php?id={$Ss.fID}">{$Ss.name}</a></td>
            		<td>{$Ss.pID}</td>
            		<td>{$Ss.radix}</td>
            		<td>{$Ss.total}</td>
            		<td>{$latesoinsArr[$Ss.fID]['latesoIns']}</td>
            		<td>{$Ss.Soprice}</td>
            		<td><font color='red'>{{$latesoinsArr[$Ss.fID]['latesoIns']} - {$Ss.Soprice}}{if {$latesoinsArr[$Ss.fID]['latesoIns']} - {$Ss.Soprice}==0}
	            	<input type="hidden" name="fID[{$Ss.fID}][status]" value="1">
	            	{else}
	      			<input type="hidden" name="fID[{$Ss.fID}][status]" value="2">
	      			<input type="hidden" name="type" value="2">
	            	{/if}</font></td>
            		<td>{$aInfoSet["billstatus"][$Ss.status]}{if $Ss.status=='2'}　<input type="button" value="入账" class="sub" name="soInsAgmFee" title="{$Ss.fID}" alt="{$s_soInsDate}"/>{/if}</td>
            	</tr>
            	{/foreach}
            </table>
            {else}
            <table class="myTable">
            	<tr><th rowspan="2"><input type="checkbox" id="all" onclick="changeAll();" checked="checked"/>全选</th><th rowspan="2">序号</th><th rowspan="2">电脑号</th><th rowspan="2">姓名</th><th rowspan="2">投保基数</th><th rowspan="2">应收合计</th><th colspan="2">应收金额</th><th colspan="2">缴社保局费用</th><th rowspan="2">均衡值</th><th rowspan="2">操作和状态</th></tr>
            	<tr><th>个人合计</th><th>单位合计</th><th>应缴保险</th><th>实缴保险</th></tr>
            	{foreach from=$SoDateList item=So name=name}
            	<tr>
            		<td><input type="checkbox" name="fID[{$So.fID}]" value=""  checked="checked"/>
            			<input type="hidden" name="paydate" value="{$s_soInsDate}"></td>
	            	<td>{$smarty.foreach.name.iteration}</td>
	            	<td>{$So.sID}</td>
	            	<td><a href="aManage.php?id={$So.fID}">{$So.name}</a></td>
	            	<td>{$So.radix}</td>
	            	<td>{$So.total}</td>
	            	<td>{$So.pTotal}</td>
	            	<td>{$So.uTotal}</td>
	            	<td>{$Soprice[$So.fID]["uTotal"] + $Soprice[$So.fID]["pTotal"]}</td>
	            	<td>{$billArr[$So.fID]["soIns"]}</td>
	            	<td>
		            	<font color='red'>
		            	{{$Soprice[$So.fID]["uTotal"] + $Soprice[$So.fID]["pTotal"]} - {$So.Soprice}}
		            	{if {{$Soprice[$So.fID]["uTotal"] + $Soprice[$So.fID]["pTotal"]} - {$So.Soprice}}==0}
		            	<input type="hidden" name="fID[{$So.fID}][status]" value="1">
		            	{else}
		      
		            	{/if}
		            	</font>
	            	</td>
	            	<td>{$aInfoSet["billstatus"][$So.status]}{if $So.status=='2'}　<input type="button" value="入账" class="sub" name="soInsAgmFee" title="{$So.fID}" alt="{$s_soInsDate}"/>{/if}</td>
            	</tr>
            	{/foreach}
            </table>
            {/if}
         </form>
         </fieldset>
     </div>
   	{/if}
</div>
{include file="footer.tpl"}