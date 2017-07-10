{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.jeditable.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/supernote.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.freezetablecolumns.1.1.js></script>
<link rel="stylesheet" type="text/css" href='{$httpPath}css/base.css' />
<link rel="stylesheet" type="text/css" href='{$httpPath}css/jquery-ui-1.8.4.custom.css' />
{literal}
<script>
		/* jQuery plugins supernote START  */
	var supernote = new SuperNote('supernote', {});
	function animFade(ref, counter){
	    var f = ref.filters, done = (counter == 1);
	    if (f) {
	        if (!done && ref.style.filter.indexOf("alpha") == -1) 
	            ref.style.filter += ' alpha(opacity=' + (counter * 100) + ')';
	        else 
	            if (f.length && f.alpha) 
	                with (f.alpha) {
	                    if (done) 
	                        enabled = false;
	                    else {
	                        opacity = (counter * 100);
	                        enabled = true
	                    }
	                }
	    }
	    else 
	        ref.style.opacity = ref.style.MozOpacity = counter * 0.999;
	};
	supernote.animations[supernote.animations.length] = animFade;
	addEvent(document, 'click', function(evt){
	    var elm = evt.target || evt.srcElement, closeBtn, note;
	    while (elm) {
	        if ((/note-close/).test(elm.className)) 
	            closeBtn = elm;
	        if ((/snb-pinned/).test(elm.className)) {
	            note = elm;
	            break
	        }
	        elm = elm.parentNode;
	    }
	    if (closeBtn && note) {
	        var noteData = note.id.match(/([a-z_\-0-9]+)-note-([a-z_\-0-9]+)/i);
	        for (var i = 0; i < SuperNote.instances.length; i++) 
	            if (SuperNote.instances[i].myName == noteData[1]) {
	                setTimeout('SuperNote.instances[' + i + '].setVis("' + noteData[2] +
	                '", false, true)', 100);
	                cancelEvent(evt);
	            }
	    }
	});
	addEvent(supernote, 'show', function(noteID){
	});
	addEvent(supernote, 'hide', function(noteID){
	});
	$(document).ready(function(){
		//修改台账信息
	 $(".editTd").editable("leSql.php", {
	  	        type: "text",
				width:'12',
		        submit: "确定",	      	   
				data: function(){
					var content = $(this).attr("title");
					return content;
				},
		        submitdata: function(){
	               var ID = $(this).attr("alt");
				    return {
						ID:ID,	
	   	                btn: "leEditBtn"
	    	            };
	    	        },
	    	        event: "click",
	    	        onblur: "cancel",
	    	        placeholder: "",
	    	        ajaxoptions: {
dataType: "json"
                        }
                    });
	
                 //提交
            $(".aSub").click(function(){
                var btnName = $(this).attr("name");
                var t, u, d, dt, m;
                t = "post";
                u = "leSql.php";
                d = "ID="+$(this).attr("title") + "&btn=" + btnName ;
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
            // 客户经理/单位二级联动
            $("select[name=mID]").change(function(){
                var j_d = $(".j_unitManager").val();
                j_d = eval(j_d);
                $.each(j_d, function(i, n){
                    if ($("select[name=mID]").val() == n.mID) {
                        $("select[name=unitID] option:not(:eq(0))").remove();
                        $.each(n.unit, function(j, v){
                            $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                            v.unitName +
                            "</option>");
                        });
                    }
                    if (!$("select[name=mID]").val()) {
                        $.each(n.unit, function(j, v){
                            $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                            v.unitName +
                            "</option>");
                        });
                    }
                });
            });
            //提交
            $(".sub").click(function(){
                var formID = this.form.id;
                var btnName = $("#" + formID + " :button").attr("name")
                var t, u, d, dt, m;
                t = "post";
                u = "../salaryManage/salarySql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName+"&type=ledger" ;
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
			// freeze the columns
            $('.myTable02').fixheadertable({ 
				height     : 200,				
				width:10000,
				colratio : [50],
				zebra : true,
				resizeCol : true				
				});//freezeTableColumns

        });
</script>
{/literal}
<div id="mainBody">
    <p class="notice">特别提示: 
        <br>1. 下面涉及到的工资的挂账或欠款,目前在派遣系统中还没有体现...在之后有必要再加入吧
        <br>2. 下面的公式设置,必需是在费用表中有非常规费用,才能出现相应的设置模式(非常规费用指的是在制作费用表的过程中出现的如: 工会费,体检费等其他代收代支的费用)
        <br>3. 系统中的[ 单位挂账 ] \ [ 指定挂账 ]分别对应的是手工报表中出现的 [ 单位挂账 ] 和 [ 挂账 ]
    </p>
    <fieldset><legend><code>条件</code></legend>
    <div class='left'>
    <input type="hidden" class="j_unitManager" value='{$j_unitManager}'>
    <form method="get">
        <table>
            <tr>
                <td>
					客户经理
                    <select name="mID">
                    <option value="">--请选择--</option>
                                            {foreach from = $unitManager item = val} 
                                            {html_options	values=$val.mID output= $val.mName selected= $s_mID} 
                                            {/foreach}
                </select>
            </td>
            <td>
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
                <!--
                <input name="sel" type="radio" value="create" checked="true">生成台账
                <input name="sel" type="radio" value="history">查看历史数据
                                    -->
                <input type="submit" name="wS" value="查询" />
            </td>
        </tr>
    </table>
</form>
</div>
	<div class="right">
       <a class="noSub positive" href="ledgerList.php" target="__blank">查看各单位台账</a>
    </div>
                </fieldset>
    {if $fVal}
    {if $smarty.get.month}
        <fieldset><legend><code>验证信息</code></legend>
<table class="myTable">
    <tr>
        <th>验证类型</th>
        <th>状态</th>
    </tr>
    <tr>
        <td>
                            验证本月内相关的审批流程是否完成 
        </td>
        <td>
                            {if $validApproval neq 0}<a href='{$httpPath}leader/validApprovalFinished.php?month={$smarty.get.month}&unitID={$smarty.get.unitID}' target="_blank">未通过验证</a>{else}验证成功{/if}
        </td>
    </tr>
</table>
        </fieldset>
    {if $validApproval eq '0'}

<div>
    <fieldset><legend><code>公式设置</code></legend>
    <div id="formulasChart">
        <table class="myTable">
                            {$formulasChartStr}
        </table>
    </div>
    <form name=formulasSet id = formulasSet>
        <input type="hidden" name="zID" value='{$formulasStr.zID}'>
        <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
        <input type="hidden" name="month" value='{$smarty.get.month}'>
        <input type="hidden" name="ID" value='{$formulasID}'>
        <table>
            <tr>
                <td>
                                            收入 =应发工资 + 管理费 + 社保 + 商保 + 收回单位欠款 + 单位挂账(指定挂账)
                </td>
                                    {if $formulasChartStr}
                <td>
                    <input type="text" name="formulas[sIncome]" value='{$formulasStr.sIncome}' readonly=true size=100 />
                </td>
                                    {/if}
            </tr>
            <tr>
                <td>
                                            支出 =实发工资 + 社保 + 商保 + 个税 + 房屋水电返还 + 制卡费
                </td>
                                    {if $formulasChartStr}
                <td>
                    <input type="text" name="formulas[sExpenditure]" value='{$formulasStr.sExpenditure}' readonly=true size=100 />
                </td>
                                    {/if}
            </tr>
            <tr>
                <td>
                                            非常规费用 =
                </td>
                                    {if $formulasChartStr}
                <td>
                    <input type="text" name="formulas[sOtherFee]" value='{$formulasStr.sOtherFee}' readonly=true size=100 />
                </td>
                                    {/if}
            </tr>
        </table>
        <input type="button" name="subFormulas" class="sub" value="提交公式">
    </form>
            </fieldset>
</div> 

<div>
     <fieldset><legend><code>未完成的台账</code></legend>
    <form method="post">
        <table class="myTable01 myTable">
            <thead>
                <tr>
                    <th rowspan="4" >费用月份</th>	
                    <th rowspan="4" >工资月份</th>
                    <th rowspan="4" >社保月份</th>
                    <th rowspan="4" >公积金月份</th>
                    <th rowspan="4" >商保月份</th>
                    <th rowspan="4" >管理费月份</th>
                    <th rowspan="4" >摘要</th>
                    <th rowspan="4" >在职人数</th>
                    <th colspan="2" rowspan="2" >应到金额</th>
                    <th colspan="{math equation='x+y' x=$sIncomeStr.0|@count  y=17}" >收入</th>
                    <th colspan="{math equation='x+y' x=$sExpenditureStr.0|@count y=9}" >支出</th>
                    <th rowspan="4" >特定项</th>
                    <th rowspan="4" >社保</th>
                    <th rowspan="4" >公积金</th>
                    <th rowspan="4" >商保</th>
                    <th rowspan="4" >挂账</th>
                            {foreach from=$sOtherFeeStr.0 item=val }
                    <th rowspan="4" >{$newFieldArr.$val}</th>		   
                            {/foreach}
                    <th colspan="3" rowspan="3" >收回个人欠款</th>
                    <th colspan="19" >挂账</th>
                    <th colspan="16" >欠款</th>
                    <th rowspan="4" >备 注</th>
                </tr>
                <tr>
                    <th rowspan="3" >应发工资</th>
                    <th colspan="2" rowspan="2" >管理费</th>
                    <th colspan="7" >保险</th>
                    <th colspan="5" rowspan="2" >收回单位欠款</th>
                    <th rowspan="3" >挂账</th>
                            {foreach from=$sIncomeStr.0 item=val }
                    <th rowspan="3" >{$newFieldArr.$val}</th>
                            {/foreach}
                    <th rowspan="3" >收入<br />合计</th>
                    <th rowspan="3" >实发工资</th>
                    <th colspan="3" >保险</th>
                    <th rowspan="3" >个税</th>
                    <th rowspan="3" >房租水电等返回款</th>
                    <th rowspan="3" >制卡费</th>
                    <th rowspan="3" >其它</th>
                            {foreach from=$sExpenditureStr.0 item=val }
                    <th rowspan="3" >{$newFieldArr.$val}</th>
                            {/foreach}
                    <th rowspan="3" >支出<br />合计</th>
                    <th colspan="5" >内部挂账</th>
                    <th colspan="14" >单位挂账DW</th>
                    <th colspan="10" >本月欠款</th>
                    <th colspan="5" >收回欠款</th>
                    <th rowspan="3" >累计欠款</th>
                </tr>
                <tr>
                    <th rowspan="2" >实际到账<br />金额</th>
                    <th rowspan="2" >冲减挂账</th>
                    <th colspan="3" >社保</th>
                     <th colspan="2" >公积金</th>
                    <th colspan="2" >商保</th>
                    <th rowspan="2" >社保</th>
                    <th rowspan="2" >公积金</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >社保</th>
                     <th rowspan="2" >公积金</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >工资</th>
                    <th rowspan="2" >合计X</th>
                    <th rowspan="2" >社保<br />（单位）</th>
                    <th rowspan="2" >社保累计挂账<br />（单位）</th>
                    <th rowspan="2" >社保<br />（个人）</th>
                    <th rowspan="2" >公积金<br />（单位）</th>
                    <th rowspan="2" >公积金累计挂账<br />（单位）</th>
                    <th rowspan="2" >公积金<br />（个人）</th>
                    <th rowspan="2" >商保<br />（单位）</th>
                    <th rowspan="2" >商保累计挂账<br />（单位）</th>
                    <th rowspan="2" >商保<br />（个人）</th>
                    <th rowspan="2" >工资</th>
                    <th rowspan="2" >工资累计挂账</th>
                    <th rowspan="2" >挂账(指定)</th>
                    <th rowspan="2" >累计挂账(指定)</th>
                    <th rowspan="2" >累计挂账DW</th>
                    <th rowspan="2" >社保</th>
                    <th rowspan="2" >累计社保欠款</th>
                    <th rowspan="2" >公积金</th>
                    <th rowspan="2" >累计公积金欠款</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >累计商保欠款</th>
                    <th rowspan="2" >管理费</th>
                    <th rowspan="2" >管理费累计欠款</th>
                    <th rowspan="2" >工资</th>
                    <th rowspan="2" >累计工资欠款</th>
                    <th rowspan="2" >社保</th>
                     <th rowspan="2" >公积金</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >管理费</th>
                    <th rowspan="2" >工资</th>
                </tr>
                <tr>
                    <th >人数</th>
                    <th >金额</th>
                    <th >残障金</th>
                    <th >单位缴交</th>
                    <th >个人缴交</th>
                    <th >单位缴交</th>
                    <th >个人缴交</th>
                    <th >单位缴交</th>
                    <th >个人缴交</th>
                    <th >社保</th>
                    <th >公积金</th>
                    <th >商保</th>
                    <th>管理费</th>
                    <th >工资</th>
                    <th>社保</th>
                    <th >公积金</th>
                    <th >商保</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                            {foreach from=$fVal key=key item =val}
                            {if $key eq 'comments'}
                    <td> <input type="input" class="req-string" name="{$key}" value="{$val}"></td>
                            {elseif   $key eq 'remarks' } 
                    <td><textarea name="{$key}" col="5" row="5"></textarea></td>
                            {elseif is_float($val)}
                               <td>{round($val,2)}</td>
                            {else}
                    <td>{$val}</td>
                            {/if}
                            {/foreach}
                </tr>
                <tr>
                    <td colspan="3"><input type="submit"  name="save" value="生成台账"></td>
                </tr>
            </tbody>
        </table>
    </form>
</fieldset>
</div>
    {/if}
    {/if}
    {/if}
    {$msg}
<div>
     <fieldset><legend><code>台账历史数据</code></legend>
    <table class="myTable02" id="editTable">
        <thead>
            <tr>
                <th rowspan="4" >操作</th>
                 <th rowspan="4" >费用月份</th>	
                    <th rowspan="4" >工资月份</th>
                    <th rowspan="4" >社保月份</th>
                    <th rowspan="4" >公积金月份</th>
                    <th rowspan="4" >商保月份</th>
                    <th rowspan="4" >管理费月份</th>
                    <th rowspan="4" >摘要</th>
                    <th rowspan="4" >费用表人数</th>
                    <th colspan="2" rowspan="2" >应到金额</th>
                <th colspan="{math equation='x+y' x=$HsIncomeStr|@count  y=17}" >收入</th>
                <th colspan="{math equation='x+y' x=$HsExpenditureStr|@count y=9}" >支出</th>
                <th rowspan="4" >特定项</th>
                <th rowspan="4" >社保</th>
                <th rowspan="4" >公积金</th>
                <th rowspan="4" >商保</th>
                <th rowspan="4" >挂账</th>
                            {foreach from=$HsOtherFeeStr item=val }
                <th rowspan="4" >{$newFieldArr.$val}</th>
                            {/foreach}
              <th colspan="3" rowspan="3" >收回个人欠款</th>
                    <th colspan="19" >挂账</th>
                    <th colspan="16" >欠款</th>
                    <th rowspan="4" >备 注</th>
                </tr>
                <tr>
                    <th rowspan="3" >应发工资</th>
                    <th colspan="2" rowspan="2" >管理费</th>
                    <th colspan="7" >保险</th>
                    <th colspan="5" rowspan="2" >收回单位欠款</th>
                    <th rowspan="3" >挂账</th>
                            {foreach from=$HsIncomeStr item=val }
                <th rowspan="3" >{$newFieldArr.$val}</th>
                            {/foreach}
                  <th rowspan="3" >收入<br />合计</th>
                    <th rowspan="3" >实发工资</th>
                    <th colspan="3" >保险</th>
                    <th rowspan="3" >个税</th>
                    <th rowspan="3" >房租水电等返回款</th>
                    <th rowspan="3" >制卡费</th>
                    <th rowspan="3" >其它</th>
                            {foreach from=$HsExpenditureStr item=val }
                <th rowspan="3" >{$newFieldArr.$val}</th>
                            {/foreach}
                <th rowspan="3" >支出<br />合计</th>
                    <th colspan="5" >内部挂账</th>
                    <th colspan="14" >单位挂账DW</th>
                    <th colspan="10" >本月欠款</th>
                    <th colspan="5" >收回欠款</th>
                    <th rowspan="3" >累计欠款</th>
                </tr>
                <tr>
                    <th rowspan="2" >实际到账<br />金额</th>
                    <th rowspan="2" >冲减挂账</th>
                    <th colspan="3" >社保</th>
                     <th colspan="2" >公积金</th>
                    <th colspan="2" >商保</th>
                    <th rowspan="2" >社保</th>
                    <th rowspan="2" >公积金</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >社保</th>
                     <th rowspan="2" >公积金</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >工资</th>
                    <th rowspan="2" >合计X</th>
                    <th rowspan="2" >社保<br />（单位）</th>
                    <th rowspan="2" >社保累计挂账<br />（单位）</th>
                    <th rowspan="2" >社保<br />（个人）</th>
                    <th rowspan="2" >公积金<br />（单位）</th>
                    <th rowspan="2" >公积金累计挂账<br />（单位）</th>
                    <th rowspan="2" >公积金<br />（个人）</th>
                    <th rowspan="2" >商保<br />（单位）</th>
                    <th rowspan="2" >商保累计挂账<br />（单位）</th>
                    <th rowspan="2" >商保<br />（个人）</th>
                    <th rowspan="2" >工资</th>
                    <th rowspan="2" >工资累计挂账</th>
                    <th rowspan="2" >挂账(指定)</th>
                    <th rowspan="2" >累计挂账(指定)</th>
                    <th rowspan="2" >累计挂账DW</th>
                    <th rowspan="2" >社保</th>
                    <th rowspan="2" >累计社保欠款</th>
                    <th rowspan="2" >公积金</th>
                    <th rowspan="2" >累计公积金欠款</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >累计商保欠款</th>
                    <th rowspan="2" >管理费</th>
                    <th rowspan="2" >管理费累计欠款</th>
                    <th rowspan="2" >工资</th>
                    <th rowspan="2" >累计工资欠款</th>
                    <th rowspan="2" >社保</th>
                     <th rowspan="2" >公积金</th>
                    <th rowspan="2" >商保</th>
                    <th rowspan="2" >管理费</th>
                    <th rowspan="2" >工资</th>
                </tr>
                <tr>
                    <th >人数</th>
                    <th >金额</th>
                    <th >残障金</th>
                    <th >单位缴交</th>
                    <th >个人缴交</th>
                    <th >单位缴交</th>
                    <th >个人缴交</th>
                    <th >单位缴交</th>
                    <th >个人缴交</th>
                    <th >社保</th>
                    <th >公积金</th>
                    <th >商保</th>
                    <th>管理费</th>
                    <th >工资</th>
                    <th>社保</th>
                    <th >公积金</th>
                    <th >商保</th>
                </tr>
        </thead>
        <tbody>
            <!--下面台账这部分比较麻烦, 关键是多个不同月份的帐套,有相同的KEY,但是不同的显示名称,所以要重做他们的显示名称-->
                            {foreach from=$hisRet item=val name=foo}
            <tr>
                             {foreach from =$val item=v key=k}
                              {if $k eq 'ID' }
                <td>    {if $smarty.foreach.foo.last }<a title="{$v}" name="leDel" class="aSub">删除</a>{/if}</td>
                             {elseif $k eq 'comments' || $k eq 'remarks'}
                <td class="editTd" title="{$v}" alt="{$val.ID}|{$k}" >{$v}</td>	
                             {elseif $smarty.get.modify eq 'true'} 
                <td class="editTd" title="{$v}" alt="{$val.ID}|{$k}" >{$v}</td>	
                             {else}
                              {assign var="vStr" value=''}
                              {assign var="tStr" value=''}
                               {if $HrepeatField}				  
                                         {foreach from=$HrepeatField key=hReKey item=hReVal}
                                                 {foreach from=$hReVal item=hReV key=hReK}
                                                       {if $k eq $hReV}
                                                       {assign var="vStr" value=$hReKey}
                                                       {/if}
                                                     {/foreach}
                                             {/foreach}
                                    {/if}
                                    {if $newHallStr[$val.month]}
                                    {foreach from=$newHallStr[$val.month] item=haVal }
                                     {foreach from=$haVal item=haV}
                                      {if $k eq $haV }				
                                      {assign var="tStr" value=$k}
                                      {/if}
                                     {/foreach} 
                                    {/foreach}
                                    {/if}
                                    {if $vStr}
                <td class="supernote-hover-{$val.month}{$vStr}">{$v}</td>
                                    {/if}
                                    {if $tStr}
                <td class="supernote-hover-{$val.month}{$tStr}">{$v}</td>
                                    {/if}
                                    {if !$tStr and !$vStr}
                <td>{$v}</td>
                                    {/if}
                              {/if}	
                             {/foreach}
            </tr>
                            {foreachelse}
            <tr>
                <td colspan="20">该单位目前没有台账数据</td>
            </tr>
                            {/foreach}
        </tbody>
    </table>
        </fieldset>
                  {foreach from=$HallStr  item=HFVal key=HFKey }
                             {if $HFVal}
                         {foreach from=$HFVal item=HFV}
    <div id="supernote-note-{$HFKey}{$HFV}" class="snp-triggeroffset notedefault">
                                                                     {$HformulasStr[$HFKey].field[$HFV]}
    </div>
                            {/foreach}
                            {/if}
                    {/foreach}						
</div>
</div>
{include file="footer.tpl"}