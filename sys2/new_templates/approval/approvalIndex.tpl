{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>

	
	$(document).ready(function(){
	    //审批流程加载,注意一下下列规则
	    $(".appProcess").each(function(i){
		         $(this).load("../approval/approvalProcessDetail.php", {"appProID": $(this).attr("dataSrc") });
	    });
		
		$(".tab").each(function(i){
			var process=getQuery('process');
		    var proSel = $(this).attr('alt');
			if(process==proSel){
			   $(this).parent().css({'background':'#eddece'});
			}
		});
	});
</script>
{/literal}
<div id="main">
	<fieldset>
        <fieldset>
		<div class="tabLayout center halfWidth" >
		<div class="block left halfWidth" >
			<a class="tab" alt='process'   href="{$httpPath}approval/approvalIndex.php?process=process">待审批数据</a>
		</div>
		<div class="block right halfWidth" >
			<a  class="tab"  alt='history'   href="{$httpPath}approval/approvalIndex.php?process=history">最近50条审批通过数据</a>
		</div>
		</div>
            </fieldset>
                        <fieldset>
                            <legend><code>审批流程</code></legend>
                            <table class="myTable" width="100%">
				<tr>
					<th>名称</th>
					<th>审批进程</th>
					<th>操作</th>
				</tr>
				{foreach from=$listNRet key=key item=val }
				{if $val.type eq 'fee'}
				<tr>
					<td>
						{$val.month}月< <span class="red"> {$unit[$val.unitID].unitName} </span> > 的<{$val.typeName}[{$val.extraBatch+1}]>
					</td>
					<td>
						<div class="appProcess" dataSrc="{$val.appProID}">
						</div>
					</td>
					<td>
						<a class="noSub" href="{$httpPath}approval/fee.php?appProID={$val.appProID}{if $val.extraBatch>0}&extraBatch={$val.extraBatch}{/if}">审批</a>
					</td>
				</tr>
                                    {elseif $val.type eq 'reward'}
				<tr>
					<td>
						{$val.month}月< <span class="red"> {$unit[$val.unitID].unitName} </span> > 的<{$val.typeName}[{$val.extraBatch}]>
					</td>
					<td>
						<div class="appProcess" dataSrc="{$val.appProID}">
						</div>
					</td>
					<td>
						<a class="noSub" href="{$httpPath}approval/fee.php?appProID={$val.appProID}&extraBatch={$val.extraBatch}">审批</a>
					</td>
				</tr>
                                      {elseif $val.type eq 'WDWhole'}
				<tr>
					<td>
						{$val.month}月< <span class="red"> {$unit[$val.unitID].unitName} </span> > 的<{$val.typeName}>
					</td>
					<td>
						<div class="appProcess" dataSrc="{$val.appProID}">
						</div>
					</td>
					<td>
						<a  class="noSub" href="{$httpPath}approval/wholeWDApproval.php?type=wholeWD&month={$val.month}&unitID={$val.unitID}&appProID={$val.appProID}">审批</a>
				 	</td>
				</tr>
                                     {elseif $val.type eq 'WDDetail'}
				<tr>
					<td>
						{$val.month}月< <span class="red"> {$unit[$val.unitID].unitName} </span> > 的<{$val.typeName}>
					</td>
					<td>
						<div class="appProcess" dataSrc="{$val.appProID}">
						</div>
					</td>
					<td>
						<a class="noSub" href="{$httpPath}approval/feeApproval.php?type=4&month={$val.month}&unitID={$val.unitID}&appProID={$val.appProID}">审批</a>
					</td>
				</tr>
				{/if}
				{/foreach}
			</table>
			</fieldset>
                       
		</div>
		
	</fieldset>
</div>
{include file="footer.tpl"}