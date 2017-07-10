{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/1.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<div id="main">
	<input	type="hidden" class="j_unitManager" value='{$j_unitManager}'>
		<div>
			<form method="GET" class="form" id="wCSForm" action="">
				<div id="condition">
					<table>
						<tr height="40px">
							
							<td>客户经理						
								<select name="mID">
									<option value="">--请选择--</option>
						
									{foreach from = $unitManager item = val} 
									{html_options	values=$val.mID output= $val.mName selected= $s_mID}
									 {/foreach}
								</select>
						
								<strong>单位</strong> 
								<select name="unitID">
								<option value="">---------------请选择------------</option>
					
								{foreach from= $unitManager item= val key=k } 
									{foreach from= $val	item=u key= k}
									 {if $k eq "unit"}
									 {foreach from= $u item= m key= n}
										{html_options values= $m.unitID output= $m.unitName|replace:"深圳市":""	selected=$s_unitID}
									 {/foreach}
									 {/if}
									 {/foreach} 
								   {/foreach}
					
							</select>
											
							</td>
						</tr>
						<tr height="40px">
							<td>
								{html_radios name = m options =$model checked= $s_model|default:date } 
							</td>
							
						</tr>
						<tr height="40px">
							<td>
								<div class="inputCon">
									<!--这个DIV 用来从JS 生成相应的查询条件输入框 -->
								</div>
							</td>
							<td>
								<input type="submit" name="wCS" value="提交" />
							</td>
						</tr>
					</table>
				</div>
				<hr/>
				<div id="errorDiv" class="error-div-alternative">
				</div>
			</form>
			<!-- 这个table  用来显示入离职人员,互助会,社保,商保 概况清单 -->{if $smarty.get.wCS}
			<div id="display">
				<fieldset>
                                                                                                            <legend><code>人员清单概览</code></legend>
				<table class="myTable" style="width:100%;height:100%">
					<thead>
					<th>&nbsp;</th>
					<th>社保</th>
                                                                                         <th>公积金</th>
					<th>商保</th>
					<th>互助会</th>
					<tbody>
						<tr>
							<td>
								入职{$mountArray|@count}人 | <a class='alertData' href="#" datasrc='{$js_mountArray}'>查看</a>
							</td>
							<td>
								{$so.mount.1|@count}人| <a class='alertData' href="#" datasrc='{$js_so}'>查看新增</a>
							</td>
                                                                                                                           <td>
								{$HF.mount.1|@count}人| <a class='alertData' href="#" datasrc='{$js_HF}'>查看新增</a>
							</td>
							<td>
								{$com.mount.1|@count}人| <a class='alertData' href="#" datasrc='{$js_com}'>查看</a>
							</td>
							<td>
								{$help.mount.1|@count}人| <a class='alertData' href="#" datasrc='{$js_help}'>查看</a>
							</td>
						</tr>
						<tr>
							<td>
								离职{$dimissionArray|@count}人| <a class='alertData' href="#" datasrc='{$js_dimissionArray}'>查看</a>
							</td>
							<td>
								{$stopSoInsArray|@count}人| <a class='alertData' href="#" datasrc='{$js_stopSoInsArray}'>查看停保</a>
							</td>
                                                                                                                            <td>
								{$stopHFArray|@count}人| <a class='alertData' href="#" datasrc='{$js_stopHFArray}'>查看封存</a>
							</td>
							<td>
								{$dimissionArray|@count}人| <a class='alertData' href="#" datasrc='{$js_dimissionArray}'>查看</a>
							</td>
							<td height="30">
								{$dimissionArray|@count}人| <a class='alertData' href="#" datasrc='{$js_dimissionArray}'>查看</a>
							</td>
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								{$modifyArray|@count}人| <a class='alertData' href="#" datasrc='{$js_modifyArray}'>查看修改</a>
							</td>
						</tr>
					</tbody>
				</table>
                                                                          </fieldset>
			</div>
			<div id="jsData" style="display:none">
				<table width="900px" class="myTable">
					<thead>
						<th>员工编号</th>
						<th>姓名</th>
						<th>单位</th>
						<th>社保更改日期</th>
						<th>社保</th>
                                                                                                          <th>公积金</th>
						<th>商保</th>
						<th>互助会</th>
						<th>入职日期</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			{if $so.mount.0|@count neq 0}<hr/>
                                                                                        <fieldset>
                                                                                      <legend><code>在职但未购买社保名单:</code></legend>
				<form name="soForm" id="soForm" method="post">
					<table width="1757" class="myTable">
						<thead>
							<tr>
								<th><p>全选/反选
										<input name="soChk" class=chkAll type="checkbox">
									</p>
								</th>
								<th>入职日期</th>
								<th>员工编号</th>
								<th>姓名</th>
								<th>单位</th>
								<th>社保</th>
								<th>基数</th>
								<th>养老</th>
								<th>医疗</th>
								<th>工伤</th>
								<th>失业</th>
								<th>住房</th>
								<th>残障金</th>
								<th colspan="2">利手</th>
							</tr>
						</thead>
						<tbody>
							{section name=s0 loop=$so.mount.0}
							<tr>
								<td>
									<input name="soCheck[{$smarty.section.s0.index}]" type="checkbox" value={$so.mount.0[s0].uID}>
								</td>
								<td>
									{$so.mount.0[s0].mountGuardDay}
								</td>
								<td>
									<a href=wPersonInfo.php?uID={$so.mount.0[s0].uID} target="_blank">{$so.mount.0[s0].uID}</a>
								</td>
								<td>
								{$so.mount.0[s0].name}
								</div>
							</td>
							<td>
							{$so.mount.0[s0].unitName}
							</div>
						</td>
						<td>
						{if !$so.mount.0[s0].soInsurance }否{/if}
						</div>
					</td>
					<td>
						<input type="text" class="req-numeric" name=radix[{$smarty.section.s0.index}]>
					</td>
					<td>
						<input type="checkbox" name="pension[{$smarty.section.s0.index}]" value="1">
					</td>
					<td>
					{html_radios options=$hospitalization name=hospitalization|cat:'['|cat:$smarty.section.s0.index|cat:']' selected="2"}
					</div>
				</td>
				<td>
					<input type="checkbox" name="employmentInjury[{$smarty.section.s0.index}]" value="1" checked>
				</td>
				<td>
					<input type="checkbox" name="unemployment[{$smarty.section.s0.index}]" value="1">
				</td>
				<td>
					<input type="checkbox" name="housing[{$smarty.section.s0.index}]" value="1">
				</td>
				<td>
					<input type="checkbox" name="PDIns[{$smarty.section.s0.index}]" value="1">
				</td>
				<td width="150">
					{html_radios name=hand|cat:'['|cat:$smarty.section.s0.index|cat:']' options=$hand checked=1}
				</td>
				</tr>
				{/section}
			</table>
			<input class="updateBtn" name="soBtn" type="button" value="参加社保">
			</form>
		<hr/></fieldset> {/if} 
		<div>
		  <fieldset>
                                                                      <legend><code>新增人员清单({$spSoArray|@count})</code></legend>
			<input class='req-string req-date' type='text' name="spBT" value={$spBT}> 到 <input class='req-string req-date' type='text' name="spET" value={$spET}>(例如:2010-01-02)
			<input class="spBtn" type="button" name="spBtn" value="查询">
                                                 </fieldset>
		{if $spSoArray|@count neq 0}
                                                    <fieldset>
			<form name="spSoForm" id="spSoForm" method="post">
				<input type="hidden" name="spTime" value="{$spTime}">
				<table class="myTable" style="width:1000px;height:100%">
					<thead>
						<tr>
							<th>全选/反选
								<input name="spSoChk" class=chkAll type="checkbox">
							</th>
							<th>入职日期</th>
							<th>户籍</th>
							<th>员工编号</th>
							<th>姓名</th>
							<th>单位</th>
							<th>再次购买日<br>
								<input class="reNewSoInsDateAll" type="text" size=10 value="{$spTime|cat:'-21'}">
							</th>
							<th>基数</th>
							<th>养老<br/>
								<input  class="rePensionAll" type="checkbox">
							</th>
							<th>医疗</th>
							<th>工伤<br/>
								<input  class="reEmploymentInjuryAll" type="checkbox"></th>
							<th>失业<br/>
								<input  class="reUnemploymentAll" type="checkbox"></th>
							<th>住房<br/>
								<input  class="reHousingAll" type="checkbox"></th>
							<th>残障金<br/>
								<input  class="rePDInsAll" type="checkbox"></th>
							<th>利手</th>
								</tr>
							</thead>
						<tbody>
							{section name=c0 loop=$spSoArray}
							<tr>
								<td>
									<input name="spSoCheck[{$smarty.section.c0.index}]" type="checkbox" value={$spSoArray[c0].uID}>
								</td>
								
								<td>
									{$spSoArray[c0].mountGuardDay}
								</td>
								<td>
									{if $spSoArray[c0].domicile eq '1'}
										深户
									{elseif $spSoArray[c0].domicile eq '2'}
										非深户
									{/if}
								</td>
								<td>
									{$spSoArray[c0].uID}
								</td>
								<td>
									<a href='wPersonInfo.php?uID={$spSoArray[c0].uID}' target="_blank">{$spSoArray[c0].name}</a>
								</td>
								<td>								
									<input type="hidden" name="unitIDArr[{$smarty.section.c0.index}]" value="{$spSoArray[c0].unitID}">
									{$spSoArray[c0].unitName}
								</td>
								<td>
									<input class="reNewSoInsDate" name="soInsModifyDate[{$smarty.section.c0.index}]" size=10 value="{$spTime|cat:'-21'}">
								</td>
								<td>
									<input type="text" class="req-numeric" size="8" name=radix[{$smarty.section.c0.index}] value="{$spSoArray[c0].radix}">
								</td>
								<td>
									<input type="checkbox" class="rePension" name="pension[{$smarty.section.c0.index}]" value="1" {if $spSoArray[c0].pension eq '1'}checked{/if}>
								</td>
								<td>
								{html_radios options=$hospitalization name=hospitalization|cat:'['|cat:$smarty.section.c0.index|cat:']' selected=$spSoArray[c0].hospitalization}
							</td>
							<td>
								<input type="checkbox" class="reEmploymentInjury" name="employmentInjury[{$smarty.section.c0.index}]" value="1" {if $spSoArray[c0].employmentInjury eq '1'}checked{/if}>
							</td>
							<td>
								<input type="checkbox" class="reUnemployment" name="unemployment[{$smarty.section.c0.index}]" value="1" {if $spSoArray[c0].unemployment eq '1'}checked{/if}>
							</td>
							<td>
								<input type="checkbox" class="reHousing" name="housing[{$smarty.section.c0.index}]" value="1"  {if $spSoArray[c0].housing eq '1'}checked{/if}>
							</td>
							<td>
								<input type="checkbox" class="rePDIns" name="PDIns[{$smarty.section.c0.index}]" value="1"  {if $spSoArray[c0].PDIns eq '1'}checked{/if}>
							</td>
							<td width="150">
								{html_radios name=hand|cat:'['|cat:$smarty.section.c0.index|cat:']' options=$hand checked=1}
							</td>
							</tr>
							{/section}
						</table>
						<p>
							<input class="updateBtn" name="spSoBtn" type="button" value="停保,并完成次月续保">
						</p>
						<p>&nbsp;</p>
						</form>
					</div>
					<br/></fieldset>{/if} 
                    			{if $com.mount.0|@count neq 0}
                                                                                                                            <fieldset>
                                                                                                        <legend><code>在职但未购买商保名单:</code></legend>
						<form name="comForm" id="comForm" method="post">
							<table width="1217" class="myTable" style="width:1000px;height:100%">
								<thead>
									<th width="21">全选/反选
										<input name="comChk" class=chkAll type="checkbox">
									</th>
									<th width="231">入职日期</th>
									<th width="154">员工编号</th>
									<th width="163">姓名</th>
									<th width="189">单位</th>
									<th width="431">商保</th>
									<tbody>
										{section name=c0 loop=$com.mount.0}
										<tr>
											<td>
												<input name="comCheck[]" type="checkbox" value={$com.mount.0[c0].uID}>
											</td>
											<td>
												{$com.mount.0[c0].mountGuardDay}
											</td>
											<td>
												{$com.mount.0[c0].uID}
											</td>
											<td>
												<a href=wPersonInfo.php?uID={$com.mount.0[c0].uID} target="_blank">{$com.mount.0[c0].name}</a>
											</td>
											<td>
												{$com.mount.0[c0].unitName}
											</td>
											<td>
												{if !$com.mount.0[c0].comInsurance }否{/if}
											</td>
										</tr>
										{/section}
										</table>
										<p>
											<input class="updateBtn" name="comBtn" type="button" value="参加商保">
										</p>
										<p>&nbsp;</p>
									</form>
									<hr/></fieldset>{/if} 
									{if $help.mount.0|@count neq 0}
										<fieldset>
                                                                                                                                                                                                                         <legend><code>在职但未参加互助会名单</code></legend>
										<form name="helpForm" id="helpForm" method="post">
											<table class="myTable" style="width:1000px;height:100%">
												<thead>
													<th width="50">全选/反选
														<input name="helpChk" class=chkAll type="checkbox">
													</th>
													<th width="100">入职日期</th>
													<th width="80">员工编号</th>
													<th width="100">姓名</th>
													<th width="200">单位</th>
													<th width="50">互助会</th>
													<tbody>
														{section name=h0 loop=$help.mount.0}
														<tr>
															<td>
																<input name="helpCheck[]" type="checkbox" value={$help.mount.0[h0].uID}>
															</td>
															<td>
																{$help.mount.0[h0].mountGuardDay}
															</td>
															<td>
																{$help.mount.0[h0].uID}
															</td>
															<td>
																<a href='wPersonInfo.php?uID={$help.mount.0[h0].uID}' target="_blank">{$help.mount.0[h0].name}</a>
															</td>
															<td>
																{$help.mount.0[h0].unitName}
															</td>
															<td>
																{if !$help.mount.0[h0].helpCost }否{/if}
															</td>
														</tr>
														{/section}
														</table>
														<input class="updateBtn" name="helpBtn" type="button" value="参加互助会">
													</form>
													<hr/>{/if} {else}
													<div id="meiyouchaxunjieguo">
														没有查询结果
													</div>
                                                                                                        </fieldset>
													{/if}
													<div class="querenshuju">
														<a id="confirm" name="createList" href="#"><img src="{$httpPath}css/images/shujuqueren.png" width="160" height="38" /></a>
													</div>
												</div>
												</div>
											</div>{include file="footer.tpl"} 