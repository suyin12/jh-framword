{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/lefttree.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/4.js>
</script>
<div id="main">
	<div id="lefttree" class="left">
		{include file="leftTree.tpl"} 
	</div>
	<div id="centertree" class="lrnone">
		<a href="javascript:prqq()">
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			&nbsp;&nbsp;&nbsp;
		</a>
	</div>
	<div id="mainBody" class="right">
		<div id="mainBody" class="right">
			<form method="get" class="conditionForm">
			==============本页面供<span style="color:red;">行政专员</span>使用==============<br />
				<span>批次号</span>
				<select name="batch">
					{html_options values= $batch output= $batch selected=$s_batch}
				</select>
			</form>
			<form action="" method="post">
				<input type="submit" value="下载本月数据" name="intoExcel" />
			</form>
			<div id="shebaoqingdan">
				社保清单:(注: 需要签收,才可以查看社保清单信息)
			</div>
			<form name="listForm" id="listForm">
				<table class="myTable">
					<thead>
						<tr style="text-align:center;">
							<thead>
								<tr>
									<div style="">
										<table class="myTable">
											<thead>
												<tr style="text-align:center;">
													<th>√</th>
													<th>申报日期</th>
													<th>提交人</th>
													<th>提交日期</th>
													<th>部长签字</th>
													<th>签收人</th>
													<th>签收日期</th>
													<th>状态</th>
												</tr>
											</thead>
											<tbody>
												{foreach item=val  from=$ret}
												<tr>
													<td>
														{if $val.status neq '1' }
														<input type="checkbox" name="chkList[]" value='{$val.soInsModifyDate|cat:"|"|cat:$val.sponsorName|cat:"|"|cat:$val.extraBatch}'>
														{/if}
													</td>
													<td>
														{if $val.status eq '1'}<a href="jobregDetail.php?n={$val.sponsorName|escape:'url'}&d={$val.soInsModifyDate}&e={$val.extraBatch}" target="_blank">
															<font color="#FF0000">
																{$val.soInsModifyDate|substr:5}
															</font>
														</a>
														{else}
														{$val.soInsModifyDate|substr:5}
														{/if}
													</td>
													<td>
														{$val.sponsorName}
													</td>
													<td>
														{$val.sponsorTime}
													</td>
													<td>
													</td>
													<td>
														{if $val.status neq '0'}
														{$val.receiverName}
														{else}
														{/if}
													</td>
													<td>
														{if $val.status neq '0'}
														{$val.receiveTime}
														{else}
														{/if}
													</td>
													<td>
														{if $val.status eq '1' }
														已签收
														{elseif $val.status eq '0'||$val.status eq '2'}
														未签收
														{else}
														出错了
														{/if}
													</td>
												</tr>
												{foreachelse}
												<tr>
													<td colspan="8">
														目前不存在本月社保申报数据
													</td>
												</tr>
												{/foreach}
												<tr>
													<td colspan="8">
														<input type="button" class="sub" name="receive" value="签收">
													</td>
												</tr>
											</tbody>
										</table>
										</form>
									</div>
									</div>
									{include file="footer.tpl"}