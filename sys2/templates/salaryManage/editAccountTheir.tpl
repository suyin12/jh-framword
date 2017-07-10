{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script type="text/javascript">

	$(document).ready(function(){
		//刷新页面,用checkbox来控制
		checkReload(":checkbox[name=thisMonth]");	
	    //提交
	    $(".sub").click(function(){
	        var formID = this.form.id;
	        var btnName = $(this).attr("name")
	        var chkName = ":checkbox[name^=editAccountCheck]";
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d = $("#" + formID).serialize() + "&" + $("#editAccount").serialize() + "&btn=" + btnName + "&type=fee";
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
	        if (isChecked(chkName) == false) {
	            if(IsEmpty($(".margin").text())||$(".margin").text()=="isNaN"){
					alert("均衡值失效,请重新选择冲减的人员");
				}else{
					var margin = Number($(".margin").text());
					if (margin < 0) {
						alert("提交失败,均衡值小于0");
					}else{
						var ret = confirm("确定" + $(this).val() + "?");
						if (ret == true) {
							ajaxAction(t, u, d, dt, m);
						}
					}
				}  
	        }
	        else {
	            alert("请勾选要操作的数据");
	        }
	    });
	    //筛选条件的POST提交.. 
	    $(".selPost").change(function(){
	        $(".selForm").submit();
	    });
		//全选/反选
		 $(".chkAll").click(function(){
            var cC, aC;
            var formName = this.name;
            var chkName = formName.replace("Chk", "");
            cC = this;
            aC = ':checkbox[name^=' + chkName + 'Check]';
            checkAll(cC, aC);
            $("input[name^=editAccountCheck]").each(function(){
              var  aTotal = mTotal =  margin = 0;
                $(".uATChk").each(function(){
                        if($(this).attr("checked")==true){
                                        aTotal+=Number($(this).attr("alt"));
                        }
                });
                if (!$(this).attr("checked")) {
                        var index = $("input[name^=editAccountCheck]").index($(this));
                        $(".accountTotal").eq(index).text("0")
                }
                else {
                        var i = $("input[name^=editAccountCheck]").index($(this));               
                        $("input[name *='Money']").each(function(t){
                         if(parseInt(t / 9)==i)
                                mTotal +=Number($(this).val());
                        });
                        $(".accountTotal").eq(i).text(mTotal);
                }
                var aT = 0;
                $("input[name^=editAccountCheck]").each(function(x){
                var cked = $(this).attr("checked");
                if (cked == true) {
                        var accountTotal = Number($(".accountTotal").eq(x).text());
                        aT = aT + accountTotal;
                }
                });
                margin = Number((aTotal - aT).toFixed(2));
				aT = Number(aT.toFixed(2));
                $(".aT").text(aT);
                $(".margin").text(margin);
        });
			
        });
		 //设置用于冲减的挂账总额
        $(".uATChk").change(function(){
            var  aTotal = 0;            
			$(".uATChk").each(function(){
			    if($(this).attr("checked")==true){
					aTotal+=Number($(this).attr("alt"));
				}
			});	
			aTotal=aTotal.toFixed(2)
            $(".aTotal").text( aTotal );
            $("input[name=aTotal]").val(aTotal);
			$(".margin").text('isNaN');
        });
	    //当取消选中时,同时清空accountTotal的值
        $("input[name^=editAccountCheck]").click(function(){
            var  aTotal = mTotal =  margin = 0;
			$(".uATChk").each(function(){
				if($(this).attr("checked")==true){
						aTotal+=Number($(this).attr("alt"));
				}
			});
			if (!$(this).attr("checked")) {
				var index = $("input[name^=editAccountCheck]").index($(this));
				$(".accountTotal").eq(index).text("0")
			}
			else {
				var i = $("input[name^=editAccountCheck]").index($(this));               
				$("input[name *='Money']").each(function(t){
				 if(parseInt(t / 9)==i)
					mTotal +=Number($(this).val());
				});
				$(".accountTotal").eq(i).text(mTotal);
			}
			var aT = 0;
			$("input[name^=editAccountCheck]").each(function(x){
			var cked = $(this).attr("checked");
			if (cked == true) {
				var accountTotal = Number($(".accountTotal").eq(x).text());
				aT = aT + accountTotal;
			}
			});
			aT = Number(aT.toFixed(2));
			margin = Number((aTotal - aT).toFixed(2));
			$(".aT").text(aT);
			$(".margin").text(margin);
        });    
        //手动调整
        $("input[name *='Money']").each(function(j){
            $(this).blur(function(){
                var i = parseInt(j / 9);
                var thisVal = Number($(this).val());
                if (isNaN($(this).val()) || thisVal < 0) {
                    $(this).val("0");
                    $(".margin").eq(i).text("");
                    alert("请输入一个正数");
                    return false;
                }
                $(".margin").removeClass("red");
                var  aTotal = mTotal = margin = 0;
                $(".uATChk").each(function(){
					if($(this).attr("checked")==true){
						aTotal+=Number($(this).attr("alt"));
					}
				});
                    
			 $("input[name *='Money']").each(function(t){
				if(parseInt(t/9)==i)
					mTotal +=Number($(this).val());
				});
                $(".accountTotal").eq(i).text(mTotal);
                //遍历选中的行,获取调整的额度
                var aT = 0;
                $("input[name^=editAccountCheck]").each(function(x){
                    var cked = $(this).attr("checked");
                    if (cked == true) {
                        var accountTotal = Number($(".accountTotal").eq(x).text());
                        aT = aT + accountTotal;
                    }
                });
                margin = Number((aTotal - aT).toFixed(2));
                $(".aT").text(aT);
                $(".margin").text(margin);
                if (margin < 0) {
                    $("input[name *='Money']").eq(j).val("0");
                    $(".accountTotal").eq(i).text("0");
                    $(".margin").text("");
                    alert("输入的需调整值大于挂账,请重新输入");
                    return false;
                }
            });
        });
	    
            //提交
            $(".aSub").click(function(){
                var formID = $(this).parents("form").attr("id");
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "salarySql.php";
                d = "ID=" + $(this).attr("alt") + "&btn=" + btnName + "&type=fee";
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
                var ret = confirm("确定" + $(this).text() + "?");
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            });
        });
</script>
{/literal}
<div id="mainBody">
    <fieldset>
    <p class="notice">注意:
        <br/>
		1.下面的欠款均为累计欠款,但挂账为本月挂账,也就是说,这里的调整挂账,实质上是一种用本月其他项目的挂账来收回欠款的功能,同时也包括了本月欠款收回功能
        <br/>
		2. 自动调整的优先顺序为:挂账部分: 单位挂账>社保挂账>商保挂账>管理费挂账 
    </p>
<form id="editAccount" name="editAccount">
    <input type="hidden" name="month" value='{$smarty.get.month}'>
    <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
    <input type="hidden" name="roleB" value='{$smarty.get.roleB}'>
    <table class="myTable halfWidth">
        <thead>
            <tr>
                <th rowspan="2">姓名</th>
                <th colspan="5">单位挂账</th>
                <th rowspan="2">调账总额</th>
                <th rowspan="2">均衡值</th>
            </tr>
            <tr>
                <th>社保</th>
                 <th>公积金</th>
                <th>商保</th>
                <th>管理费</th>
                <th>单位挂账</th>
            </tr>
        </thead>
        <tbody>
                            {foreach from=$ret item=val}
            <tr>
                <td>
                                            {$val.name}
                </td>
                <td>
                    <span class="uSoInsAccount">{$val.uSoInsMoney}</span>
                                            {if $val.uSoInsMoney gt 0}
                    <input type="checkbox"  name="sA[{$val.uID}]" class="uATChk" alt="{$val.uSoInsMoney}" value="uSoInsMoney" >
                                            {/if}
                </td>
                <td>
                    <span class="uHFAccount">{$val.uHFMoney}</span>
                                            {if $val.uHFMoney gt 0}
                    <input type="checkbox" name="hA[{$val.uID}]" class="uATChk" alt="{$val.uHFMoney}" value="uHFMoney" >
                                            {/if}
                </td>
                <td>
                    <span class="uComInsAccount">{$val.uComInsMoney}</span>
                                            {if $val.uComInsMoney gt 0 }
                    <input type="checkbox" name="cA[{$val.uID}]" class="uATChk" alt="{$val.uComInsMoney}" value="uComInsMoney" >
                                            {/if}
                </td>
                <td>
                    <span class="managementCostAccount">{$val.managementCostMoney}</span>
                                            {if $val.managementCostMoney gt 0}
                    <input type="checkbox" name="mA[{$val.uID}]" class="uATChk" alt="{$val.managementCostMoney}" value="managementCostMoney" >
                                            {/if}
                </td>
                <td>
                    <span class="uAccount">{$val.uAccount}</span>
                                            {if $val.uAccount gt 0}
                    <input type="checkbox" name="uA[{$val.uID}]" class="uATChk" alt="{$val.uAccount}" value="uAccount" >
                                            {/if}
                </td>
                <td>
                    <span class="aT"></span>
                </td>
                <td>
                    <span class="margin"></span>
                </td>
            </tr>
                            {foreachelse}
            <tr>
                <td colspan="12">
                                            没有需要调整的数据
                </td>
            </tr>
                            {/foreach}
        </tbody>
    </table>
</form>
<input type="checkbox" name="thisMonth" value="1" {if $smarty.get.thisMonth eq 'true'} checked='true' {/if} />包括本月欠款
	<table class="myTable">
		<thead>
			<tr>
				<th rowspan="2">操作</th>
				<th rowspan="2">全选/反选 <br/>
                                   <input name="editAccountChk" class=chkAll type="checkbox"></th>				
				<th rowspan="2">姓名</th>
				<th colspan="9">欠款</th>
				<th rowspan="2">调整总额</th>
			</tr>
			<tr>
				<form class="selForm" method="post">
					<input type="hidden" name="selPost" value="1" />
					
					<th>
						<select class="selPost" name=uPDInsMoneySel>
							<option value="">残障金</option>
							{html_options values= $uPDInsMoneyArr	output=$uPDInsMoneyArr	selected=$s_uPDInsMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=uSoInsMoneySel>
							<option value="">单位社保</option>
							{html_options values= $uSoInsMoneyArr	output=$uSoInsMoneyArr	selected=$s_uSoInsMoneySel}
						</select>
					</th>
                                        <th>
						<select class="selPost" name=pSoInsMoneySel>
							<option value="">个人社保</option>
							{html_options values= $pSoInsMoneyArr	output=$pSoInsMoneyArr	selected=$s_pSoInsMoneySel}
						</select>
					</th>
                                                                                                               <th>
						<select class="selPost" name=uHFMoneySel>
							<option value="">单位公积金</option>
							{html_options values= $uHFMoneyArr	output=$uHFMoneyArr	selected=$s_uHFMoneySel}
						</select>
					</th>
                                                                                                                <th>
						<select class="selPost" name=pHFMoneySel>
							<option value="">个人公积金</option>
							{html_options values= $pHFMoneyArr	output=$pHFMoneyArr	selected=$s_pHFMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=uComInsMoneySel>
							<option value="">单位商保</option>
							{html_options values= $uComInsMoneyArr	output=$uComInsMoneyArr	 selected=$s_uComInsMoneySel}
						</select>
					</th>
                                                                                                               <th>
						<select class="selPost" name=pComInsMoneySel>
							<option value="">个人商保</option>
							{html_options values= $pComInsMoneyArr	output=$pComInsMoneyArr	 selected=$s_pComInsMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=managementCostMoneySel>
							<option value="">管理费用</option>
							{html_options values= $managementCostMoneyArr  output=$managementCostMoneyArr 	selected=$s_managementCostMoneySel}
						</select>
					</th>
					<th>
						<select class="selPost" name=uOtherMoneySel>
							<option value="">其他</option>
							{html_options values= $uOtherMoneyArr  output=$uOtherMoneyArr 	selected=$s_uOtherMoneySel}
						</select>
					</th>
				</form>
			</tr>
		</thead>
		<tbody>
			<form id="editAccountForm" name="editAccountForm">
				<input type="hidden" name="appProIDDE" value='{$appProIDDE}'>
				{foreach from=$retM item=val}
				<tr>					
					<td>
						{if $retMB[$val.uID].ID && $retMB[$val.uID].status eq '0'} 
						 <a class="aSub" name="deleteAccount" alt="{$retMB[$val.uID].ID}">删除</a>
						{elseif $retMB[$val.uID].status eq '1'}
						  已签收
						{elseif $retMB[$val.uID].status eq '99'}
						  <span class="red">已退回</span> |
						<a class="aSub" name="deleteAccount" alt="{$retMB[$val.uID].ID}">删除</a>
						{/if}
					</td>
					<td>
						{if  $retMB[$val.uID].status neq '1'} 
							<input type="checkbox" name="editAccountCheck[{$val.uID}]" value="{$val.uID}" checked>
						{else}
						{assign var='status' value='1' }
						{/if}
					</td>
					<td>
						<a href="{$httpPath}feeAdvancedManage/prsMoney.php?uID={$val.uID}" target='_blank'>{$val.name}</a>
					</td>
					<td>
						<span class="uPDInsMoney">{$retM[$val.uID].uPDInsMoney} </span>
						<input type="text" name='uPDInsMoney[{$val.uID}]' value="{$retMB[$val.uID].uPDInsMoney|default:-$retM[$val.uID].uPDInsMoney}" size="5" {if $retM[$val.uID].uPDInsMoney==0}readOnly{/if}>
					</td>
					<td>
						<span class="uSoInsMoney">{$retM[$val.uID].uSoInsMoney} </span>
						<input type="text" name='uSoInsMoney[{$val.uID}]' value="{$retMB[$val.uID].uSoInsMoney|default:-$retM[$val.uID].uSoInsMoney}" size="5" {if $retM[$val.uID].uSoInsMoney==0}readOnly{/if}>
					</td>
                                                                                                              <td>
						<span class="pSoInsMoney">{$retM[$val.uID].pSoInsMoney} </span>
						<input type="text" name='pSoInsMoney[{$val.uID}]' value="{$retMB[$val.uID].pSoInsMoney|default:-$retM[$val.uID].pSoInsMoney}" size="5" {if $retM[$val.uID].pSoInsMoney==0}readOnly{/if}>
					</td>
                                                                                                                <td>
						<span class="uHFMoney">{$retM[$val.uID].uHFMoney} </span>
						<input type="text" name='uHFMoney[{$val.uID}]' value="{$retMB[$val.uID].uHFMoney|default:-$retM[$val.uID].uHFMoney}" size="5" {if $retM[$val.uID].uHFMoney==0}readOnly{/if}>
					</td>
                                                                                                            <td>
						<span class="pHFMoney">{$retM[$val.uID].pHFMoney} </span>
						<input type="text" name='pHFMoney[{$val.uID}]' value="{$retMB[$val.uID].pHFMoney|default:-$retM[$val.uID].pHFMoney}" size="5" {if $retM[$val.uID].pHFMoney==0}readOnly{/if}>
					</td>
					<td>
						<span class="uComInsMoney">{$retM[$val.uID].uComInsMoney}</span>
						<input type="text" name='uComInsMoney[{$val.uID}]' value="{$retMB[$val.uID].uComInsMoney|default:-$retM[$val.uID].uComInsMoney}" size="5" {if $retM[$val.uID].uComInsMoney==0}readOnly{/if}>
					</td>
 					<td>
						<span class="pComInsMoney">{$retM[$val.uID].pComInsMoney}</span>
						<input type="text" name='pComInsMoney[{$val.uID}]' value="{$retMB[$val.uID].pComInsMoney|default:-$retM[$val.uID].pComInsMoney}" size="5" {if $retM[$val.uID].pComInsMoney==0}readOnly{/if}>
					</td>                                       
					<td>
						<span class="managementCostMoney">{$retM[$val.uID].managementCostMoney}</span>
						<input type="text" name='managementCostMoney[{$val.uID}]' value="{$retMB[$val.uID].managementCostMoney|default:-$retM[$val.uID].managementCostMoney}" size="5" {if $retM[$val.uID].managementCostMoney==0}readOnly{/if}>
					</td>
					<td>
						<span class="uOtherMoney">{$retM[$val.uID].uOtherMoney}</span>
						<input type="text" name='uOtherMoney[{$val.uID}]' value="{$retMB[$val.uID].uOtherMoney|default:-$retM[$val.uID].uOtherMoney}" size="5" {if $retM[$val.uID].uOtherMoney==0}readOnly{/if}>
					</td>
					<td>
						<span class="accountTotal">
							{if $retMB[$val.uID].ID}
							{math r=$retMB[$val.uID].pSoInsMoney s=$retMB[$val.uID].pHFMoney t=$retMB[$val.uID].pComInsMoney u=$retMB[$val.uID].uHFMoney   v=$retMB[$val.uID].uComInsMoney w=$retMB[$val.uID].uPDInsMoney x=$retMB[$val.uID].uSoInsMoney y=$retMB[$val.uID].managementCostMoney z=$retMB[$val.uID].uOtherMoney equation="r+s+t+u+v+w+x+y+z" }
							{/if}
						</span>
					</td>
				</tr>
                            {foreachelse}
        <tr>
            <td colspan="12">
                                            没有需要调整的数据
            </td>
        </tr>
                            {/foreach}
        <tr>
            <td>
                                            {if  $retMB[$val.uID].status neq '1'} 
                <input type="button" class="sub" name="editAccountTheirBtn" value="提交">
                                            {/if}
            </td>
        </tr>
        <form>
            </tbody>
            </table>
            </fieldset>
            </div>
                    {include file="footer.tpl"}