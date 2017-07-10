{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
{literal}
<script>
$(document).ready(function(){
          $("select").change(function(){
                $("#conditionForm").submit();
          });
         
             //提交
            $(".aSub").click(function(){
                var formID = $(this).parents("form").attr("id");
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "approvalSql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName+"&ID="+$(this).attr("alt");;
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
          //费用处理
                $(".editSub").each(function(i){
                        $(this).click(function(){
                                var thisUrl = $(this).attr("alt");
//				alert(thisUrl);
                                tipsWindown('调整费用','iframe:'+thisUrl, '1024', '580', 'true', '', 'true', 'leotheme');
                        });
                });
        });
</script>
{/literal}
<div id="main">
    <div>
        <fieldset>
            <legend><code>条件</code></legend>
        <form id="conditionForm" method="get">
			  费用月份:
            <select name="month">
				{html_options options=$monthArr selected=$s_month} 
            </select>
				选择客户经理:
            <select name=mID>
                <option value="">--所有客户经理 --</option>
					{foreach from = $unitManager item = val} 
					{html_options values= $val.mID	output= $val.mName selected= $s_mID}
					{/foreach}
            </select>
        </form>
         <form action="" method="post">
                <input name="downLoadDetail"  type="submit" value="下载本月明细">
        </form>
            </fieldset>
    </div>
    <div>
        <fieldset>
            <div class="left halfWidth">
         <fieldset>
            <legend><code>社保平账审批</code></legend>
        <form id="soInsForm">
            <input type="hidden" name="type" value="5">
            <input type="hidden" name = "month" value="{$month}">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>单位名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
			{foreach item=val key=key from=$soInsArr}
                    <tr>
                        <td>{$val.unitName}</td>
                        <td>{if $bDetailRet['soIns'][$key].status eq '0'}<a  class="aSub" alt="{$bDetailRet['soIns'][$key].ID}" name="receive"  >签收</a>   <a  class="aSub"  alt="{$bDetailRet['soIns'][$key].ID}" name="rollback">退回</a>
								{elseif $bDetailRet['soIns'][$key].status eq '1'} 
									{if $val.confirmStatus eq '1'}
			                            <a class="editSub positive" alt="{$httpPath}approval/soInsBalFeeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >已审批</a>
									{else} 
			                            <a class="editSub noSub" alt="{$httpPath}approval/soInsBalFeeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >查看/审批</a> 
									 <a  class="aSub"  alt="{$bDetailRet['soIns'][$key].ID}" name="rollback">退回</a>
								    {/if}
						{elseif $bDetailRet['soIns'][$key].status eq '99'}
                            <span class="red">已退回</span>
						{/if}
                        </td>
                    </tr>
			{foreachelse}
                    <tr><td colspan="2">  没有需要审批的数据</td></tr>
			{/foreach}
                </tbody>
            </table>
        </form>
                </fieldset>
                 <fieldset>
            <legend><code>商保平账审批</code></legend>
   <form id="comInsForm">
            <input type="hidden" name="type" value="7">
            <input type="hidden" name = "month" value="{$month}">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>单位名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
			{foreach item=val key=key from=$comInsArr}
                    <tr>
                        <td>{$val.unitName}</td>
                        <td>{if $bDetailRet['comIns'][$key].status eq '0'}<a  class="aSub" alt="{$bDetailRet['comIns'][$key].ID}" name="receive"  >签收</a>   <a  class="aSub"  alt="{$bDetailRet['comIns'][$key].ID}" name="rollback">退回</a>
								{elseif $bDetailRet['comIns'][$key].status eq '1'} 
						{if $val.confirmStatus eq '1'}
                            <a class="editSub positive" alt="{$httpPath}approval/comInsBalFeeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >已审批</a>
						{else} 
                            <a class="editSub noSub" alt="{$httpPath}approval/comInsBalFeeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >查看/审批</a> 
						 <a  class="aSub"  alt="{$bDetailRet['comIns'][$key].ID}" name="rollback">退回</a>
								    {/if}
						{elseif $bDetailRet['comIns'][$key].status eq '99'}
                            <span class="red">已退回</span>
						{/if}
                        </td>
                    </tr>
			{foreachelse}
                    <tr><td colspan="2">  没有需要审批的数据</td></tr>
			{/foreach}
                </tbody>
            </table>
        </form>
                </fieldset>
                </div>
                <div class="right halfWidth">
                <fieldset>
            <legend><code>公积金平账审批</code></legend>
   <form id="HFForm">
            <input type="hidden" name="type" value="6">
            <input type="hidden" name = "month" value="{$month}">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>单位名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
			{foreach item=val key=key from=$HFArr}
                    <tr>
                        <td>{$val.unitName}</td>
                        <td>{if $bDetailRet['HF'][$key].status eq '0'}<a  class="aSub" alt="{$bDetailRet['HF'][$key].ID}" name="receive"  >签收</a>   <a  class="aSub"  alt="{$bDetailRet['HF'][$key].ID}" name="rollback">退回</a>
								{elseif $bDetailRet['HF'][$key].status eq '1'} 
						{if $val.confirmStatus eq '1'}
                            <a class="editSub positive" alt="{$httpPath}approval/HFBalFeeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >已审批</a>
						{else} 
                            <a class="editSub noSub" alt="{$httpPath}approval/HFBalFeeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >查看/审批</a> 
						  <a  class="aSub"  alt="{$bDetailRet['HF'][$key].ID}" name="rollback">退回</a>
								    {/if}
						{elseif $bDetailRet['HF'][$key].status eq '99'}
                            <span class="red">已退回</span>
						{/if}
                        </td>
                    </tr>
			{foreachelse}
                    <tr><td colspan="2">  没有需要审批的数据</td></tr>
			{/foreach}
                </tbody>
            </table>
        </form>
                </fieldset>
                <fieldset>
            <legend><code>调账审批</code></legend>
        <form id="theirForm">
            <input type="hidden" name="type" value="2">
            <input type="hidden" name = "month" value="{$month}">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>单位名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
			{foreach item=val key=key from=$theirArr}
                    <tr>
                        <td>{$val.unitName}</td>
                        <td>{if $val.status eq '0'}<a  class="aSub" alt="{$key}" name="receive"  >签收</a>
						{elseif $val.status eq '1'} 
						{if $val.confirmStatus eq '1'}
                            <a class="editSub positive" alt="{$httpPath}approval/feeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >已审批</a>
						{else} 
                            <a class="editSub noSub" alt="{$httpPath}approval/feeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >查看/审批</a> 
						 <a  class="aSub" alt="{$key}" name="rollback">退回</a>
						{/if}
						{elseif $val.status eq '99'}
                            <span class="red">已退回</span>
						{/if}
                        </td>
                    </tr>
			{foreachelse}
                    <tr><td colspan="2">  没有需要审批的数据</td></tr>
			{/foreach}
                </tbody>
            </table>
        </form>
                </fieldset>
         <fieldset>
            <legend><code>公司挂账审批</code></legend>
        <form id="companyForm">
            <input type="hidden" name="type" value="3">
            <input type="hidden" name = "month" value="{$month}">
            <table class="myTable" width="100%">
                <thead>
                    <tr>
                        <th>单位名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
			{foreach item=val key=key from=$companyArr}
                    <tr>
                        <td>{$val.unitName}</td>
                        <td>{if $val.status eq '0'}<a  class="aSub" alt="{$key}" name="receive"  >签收</a>
						{elseif $val.status eq '1'}
						{if $val.confirmStatus eq '1'}
                            <a class="editSub positive" alt="{$httpPath}approval/feeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >已审批</a>
						{else} 
                            <a class="editSub noSub" alt="{$httpPath}approval/feeApproval.php?type={$val.type}&unitID={$key}&month={$month}" >查看/审批</a> 
						 <a  class="aSub" alt="{$key}" name="rollback">退回</a>
						{/if}
						{elseif $val.status eq '99'}
                            <span class="red">已退回</span>
						{/if}
                        </td>
                    </tr>
			{foreachelse}
                    <tr><td colspan="2">  没有需要审批的数据</td></tr>
			{/foreach}
                </tbody>
            </table>
                </fieldset>
                </div>
           </fieldset>
    </div>
</div>
{include file="footer.tpl"}