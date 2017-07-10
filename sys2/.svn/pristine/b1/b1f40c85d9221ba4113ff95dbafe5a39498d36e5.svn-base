{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script type="text/javascript">
	
    $(document).ready(function(){
        //显示/隐藏全部数据
        //刷新页面,用checkbox来控制
        checkReload(":checkbox[name=displayAll]");	
        checkReload(":checkbox[name=displayModify]");	
        //全选反选
        $(".chkAll").click(function(){
            var cC, aC;
            var formName = this.form.name;
            var chkName = formName.replace("Form", "");
            cC = this;
            aC = ':checkbox[name^=' + chkName + 'Check]';
            checkAll(cC, aC);
        });
      
	    
        //提交
        $(".sub").click(function(){
            var formID = this.form.id;
            var acName=formID.replace("Form","");
            var btnName = $(this).attr("name")
            var chkName = ":checkbox[name^="+acName+"Check]";
            var t, u, d, dt, m;
            t = "post";
            u = "salarySql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName ;
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
                var ret = confirm("确定" + $(this).val() + "?");
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            }
            else {
                alert("请勾选要操作的数据");
            }
        });
        //这些JS写得很烂,,但是又不得不这样写...哎,,程序在之前的设计就出问题了..越改越难受(又不能把问题表现给用户看,,只好牺牲程序了..哎)
            //填写应收款,改变
        blurChangeVal("uSoInsS");
        blurChangeVal("uHFS");
        blurChangeVal("uComInsS");
        blurChangeVal("managementCostS");
        blurChangeVal("uPDInsS");
            //点击checkbox改变
        clickChangeVal("uSoInsEditFee");
        clickChangeVal("uHFEditFee");
        clickChangeVal("uComInsEditFee");
        clickChangeVal("mCostEditFee");
        clickChangeVal("uPDInsEditFee");
	
    //鼠标离开应收费用时改变
        function blurChangeVal(name){
            $("input[name^="+name+"]").each(function(i){
                $(this).blur(function(){
                        changeVal(i,name);
                });
            });
        }
        //点击checkbox更新均衡值
        function clickChangeVal(name){
            $(":checkbox[name^="+name+"Check]").each(function(i){
                //莫名其妙其他的change事件怎么不能触发
                $(":checkbox[name^="+name+"Chk]").click(function(){
                    if($(":checkbox[name^="+name+"Check]").eq(i).attr("checked") == true) {
                        changeVal(i,name);
                    }
                });
                $(this).change(function(){
                    if($(this).attr("checked") == true) {
                        changeVal(i,name);
                    }
                });
            });
        }
       
		
	  
        //点击checkbox更新均衡值
        function changeVal(num,name){
            var  i =num;
            var name = name;
            switch(name){
                case "uSoInsEditFee":
                case "uSoInsS":        
                    var sS = Number($("input[name^=uSoInsS]").eq(i).val());
                    var sR = Number($(".uSoInsR").eq(i).text());
                    var sWD = Number($(".soInsWriteDownMoney").eq(i).text());
                    var sMS = Number($(".uSoInsMoneyS").eq(i).text());
                    var sM_name="uSoInsMoney";
                    var cSM_name="curUSoInsMoney";
                    var margin_name="soInsMargin";
                    break;
                case "uHFEditFee":
                case "uHFS":        
                    var sS = Number($("input[name^=uHFS]").eq(i).val());
                    var sR = Number($(".uHFR").eq(i).text());
                    var sWD = Number($(".HFWriteDownMoney").eq(i).text());
                    var sMS = Number($(".uHFMoneyS").eq(i).text());
                    var sM_name="uHFMoney";
                    var cSM_name="curUHFMoney";
                    var margin_name="HFMargin";
                    break;       
                case "uComInsEditFee":
                case "uComInsS":       
                    var sS = Number($("input[name^=uComInsS]").eq(i).val());
                    var sR = Number($(".uComInsR").eq(i).text());
                    var sMS = Number($(".uComInsMoneyS").eq(i).text());
                    var sWD = Number($(".comInsWriteDownMoney").eq(i).text());
                    var sM_name="uComInsMoney";
                    var cSM_name="curUComInsMoney";
                    var margin_name="comInsMargin";
                    break;
                case "mCostEditFee":
                case "managementCostS":       
                    var sS = Number($("input[name^=managementCostS]").eq(i).val());
                    var sR = Number($(".managementCostR").eq(i).text());
                    var sMS = Number($(".managementCostMoneyS").eq(i).text());
                    var sWD = Number($(".mCostWriteDownMoney").eq(i).text());
                    var sM_name="managementCostMoney";
                    var cSM_name="curManagementCostMoney";
                    var margin_name="managementCostMargin";
                    break;
                case "uPDInsEditFee":
                case "uPDInsS":    
                    var sS = Number($("input[name^=uPDInsS]").eq(i).val());
                    var sR = Number($(".uPDInsR").eq(i).text());
                    var sWD = Number($(".PDInsWriteDownMoney").eq(i).text());
                    var sMS = Number($(".uPDInsMoneyS").eq(i).text());
                    var sM_name="uPDInsMoney";
                    var cSM_name="curUPDInsMoney";
                    var margin_name="PDInsMargin";
                    break;
            }
			       
            var sM = 0;
            var cSMY = 0;
            var sMG = 0;
            var x = Number(sR + sWD - sS);
            if (x == 0) {
                sM = Number($("."+sM_name).eq(i).text());
                if (sM == sMS) {
                    sMG = 0;
                }
            }
            else {
                if (x < 0) {
                    sM = 0;
                    cSMY = x;
                }
                else 
                    if (sMS >= x && x >= 0) {
                        sM = x;
                        cSMY = 0;
                    }
                else 
                    if (x > sMS) {
                        sM = sMS;
                        cSMY = x - sM;
                    }
                sM = Number(sM.toFixed(2));
                var cSM = Number($("."+cSM_name).eq(i).text());
                var sMG = (sR + sWD - sS - sM).toFixed(2);
            }
            if (cSMY < 0) {
                var sMT = Number((-sMS + sM + cSMY).toFixed(2));
            }
            else {
                var sMT = Number((-sMS + sM).toFixed(2));
            }
            $("."+sM_name).eq(i).val(sM);
            $("."+margin_name).eq(i).val(sMG);
        }
        //关闭窗口,并且刷新父窗口
        $("input[name=closeRefresh]").click(function(){
            top.location.href = "makeFee.php" + location.search;
        });
        $("input[name=refresh]").click(function(){
            window.location.href = location.href;
        });
        $(".fixedTable").scroll(function(){
            var left = $(".fixedTable").scrollLeft();
            //		alert(left);
            $(".fixedCol").css({"left":left,"position": "relative","z-index": "666"});});
    });
</script>
{/literal}
<div id="mainBody">
    <div>
            <p class="success">
                <input type="checkbox" name="displayAll" value="all" {if $smarty.get.displayAll eq 'true'}checked{/if}> 显示全部
                <input type="checkbox" name="displayModify" value="all" {if $smarty.get.displayModify eq 'true'}checked{/if}> 只显示调整过的记录
                <input type="button" name="refresh" value="刷新">
                <input type="button" name="closeRefresh" value="关闭窗口">
            </p>
            </div>
                {if $uSoInsArr}
            <div>
                <fieldset>
             <legend><code>[  社保  ]  共{$uSoInsArr|@count}条记录</code></legend>     
                <form id="uSoInsEditFeeForm" name="uSoInsEditFeeForm">
                    <input type="hidden" name="salaryDate" value='{$salaryDate}'>
                    <input type="hidden" name="soInsDate" value='{$soInsDate}'>
                    <input type="hidden" name="month" value='{$smarty.get.month}'>
                    <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                    <input type="hidden" name="type" value='uSoIns'>
                    <table class="myTable">
                        <thead>
                            <tr >
                                <th rowspan="2">姓名</th>
                                <th rowspan="2">全选/反选
                                    <br/>
                                    <input name="uSoInsEditFeeChk" class=chkAll type="checkbox">
                                </th>
                                <th colspan="7">社保</th>
                                <th rowspan="2">最后一次社保<br/>修改日期<br>({$soInsDateDe}之后)</th>
                            </tr>
                            <tr>
                                <th>本月应收</th>
                                <th>本月实收</th>
                                <th>冲减挂账</th>
                                <th>应收欠款</th>
                                <th>收回欠款</th>
                                <th>本月欠/挂</th>
                                <th>均衡值</th>


                            </tr>
                        </thead>
                        <tbody>
                                            {foreach item=fVal name=foo from=$uSoInsArr}
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
                                                            {elseif $fk eq 'uID'}
                            <td>
                                <input type="checkbox"  name="uSoInsEditFeeCheck[{$fv}]" value="{$fv}" size=5>
                            </td>
                                                            {elseif $fk eq 'status' or $fk eq 'soInsModifyDate'}
                                                            {continue}
                                                            {elseif   $fk eq 'soInsMargin'}
                            <td class="highLight">
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif  $fk eq 'uSoInsMoney'  }
                            <td>
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif $fk eq 'uSoInsS'}
                            <td>
                                <input type="text" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" value="{$fv}" size=5>
                            </td>
                                                            {else}
                            <td>
                                <span class="{$fk}">{$fv}</span>
                            </td>
                                                            {/if}
                                                            {/foreach}
                            <td>{$fVal.soInsModifyDate}</td>
                        </tr>
							{/foreach}
                            <tr>
                                <!--
                                <td>
                                <input type="button" class="sub" name="editFeeBtn" value="调整">
								</td>
								-->
                                <td colspan="2">

                                </td>
                                <td colspan="2">
                                    <input type="button" name="setMoney" class="sub" value="将均衡值设置为欠/挂记录">
                                </td>
                                <td>
                                    <input type="button" name="refresh" value="刷新">
                                </td>
                                <td colspan="2">
                                    <input type="button" name="closeRefresh" value="关闭窗口">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                            </fieldset>
            </div>
                           {/if}
               {if $uHFArr}
            <div>
                <fieldset>
              <legend><code>[  公积金  ]  共{$uHFArr|@count}条记录</code></legend>   
                
                <form id="uHFEditFeeForm" name="uHFEditFeeForm">
                    <input type="hidden" name="salaryDate" value='{$salaryDate}'>
                    <input type="hidden" name="soInsDate" value='{$soInsDate}'>
                    <input type="hidden" name="month" value='{$smarty.get.month}'>
                    <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                    <input type="hidden" name="type" value='uHF'>
                    <table class="myTable">
                        <thead>
                            <tr >
                                <th rowspan="2">姓名</th>
                                <th rowspan="2">全选/反选
                                    <br/>
                                    <input name="uHFEditFeeChk" class=chkAll type="checkbox">
                                </th>
                                <th colspan="7">公积金</th>
                                <th rowspan="2">最后一次公积金<br/>修改日期<br>({$HFDateDe}之后)</th>
                            </tr>
                            <tr>
                                <th>本月应收</th>
                                <th>本月实收</th>
                                <th>冲减挂账</th>
                                <th>应收欠款</th>
                                <th>收回欠款</th>
                                <th>本月欠/挂</th>
                                <th>均衡值</th>


                            </tr>
                        </thead>
                        <tbody>
                                            {foreach item=fVal name=foo from=$uHFArr}
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
                                                            {elseif $fk eq 'uID'}
                            <td>
                                <input type="checkbox"  name="uHFEditFeeCheck[{$fv}]" value="{$fv}" size=5>
                            </td>
                                                            {elseif $fk eq 'status' or $fk eq 'HFModifyDate'}
                                                            {continue}
                                                            {elseif   $fk eq 'HFMargin'}
                            <td class="highLight">
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif  $fk eq 'uHFMoney'  }
                            <td>
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif $fk eq 'uHFS'}
                            <td>
                                <input type="text" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" value="{$fv}" size=5>
                            </td>
                                                            {else}
                            <td>
                                <span class="{$fk}">{$fv}</span>
                            </td>
                                                            {/if}
                                                            {/foreach}
                            <td>{$fVal.HFModifyDate}</td>
                        </tr>
							{/foreach}
                            <tr>
                                <!--
                                <td>
                                <input type="button" class="sub" name="editFeeBtn" value="调整">
								</td>
								-->
                                <td colspan="2">

                                </td>
                                <td colspan="2">
                                    <input type="button" name="setMoney" class="sub" value="将均衡值设置为欠/挂记录">
                                </td>
                                <td>
                                    <input type="button" name="refresh" value="刷新">
                                </td>
                                <td colspan="2">
                                    <input type="button" name="closeRefresh" value="关闭窗口">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
             </fieldset>
            </div>
                           {/if}
               {if $uComInsArr}
            <div>
                <fieldset>
              <legend><code> [  商保  ]  共{$uComInsArr|@count}条记录</code></legend>   
                           
            <form id="uComInsEditFeeForm" name="uComInsEditFeeForm">
                <input type="hidden" name="salaryDate" value='{$salaryDate}'>
                <input type="hidden" name="soInsDate" value='{$soInsDate}'>
                <input type="hidden" name="month" value='{$smarty.get.month}'>
                <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                <input type="hidden" name="type" value='uComIns'>
                <table class="myTable">
                    <thead>
                        <tr >
                            <th rowspan="2">姓名</th>
                            <th rowspan="2">全选/反选
                                <br/>
                                <input name="uComInsEditFeeChk" class=chkAll type="checkbox">
                            </th>
                            <th colspan="7">商保</th>
                        </tr>
                        <tr>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>均衡值</th>

                        </tr>
                    </thead>
                    <tbody>
                                            {foreach item=fVal name=foo from=$uComInsArr}

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
                                                            {elseif $fk eq 'uID'}
                            <td>
                                <input type="checkbox"  name="uComInsEditFeeCheck[{$fv}]" value="{$fv}" size=5>
                            </td>
                                                            {elseif $fk eq 'status'}
                                                            {continue}
                                                            {elseif   $fk eq 'comInsMargin'}
                            <td class="highLight">
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif  $fk eq 'uComInsMoney' or $fk eq 'uComInsMoneyTotal'  }
                            <td>
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif $fk eq 'uComInsS'}
                            <td>
                                <input type="text" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" value="{$fv}" size=5>
                            </td>
                                                            {else}
                            <td>
                                <span class="{$fk}">{$fv}</span>
                            </td>
                                                            {/if}

                                                            {/foreach}
                        </tr>
                                                    {/foreach}
                        <tr>
                            <!--
                            <td>
                            <input type="button" class="sub" name="editFeeBtn" value="调整">
                                                            </td>
                                                            -->
                            <td colspan="2">

                            </td>
                            <td colspan="2">
                                <input type="button" name="setMoney" class="sub" value="将均衡值设置为欠/挂记录">
                            </td>
                            <td>
                                <input type="button" name="refresh" value="刷新">
                            </td>
                            <td colspan="2">
                                <input type="button" name="closeRefresh" value="关闭窗口">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </fieldset>
            </div>
                           {/if}
               {if $mCostArr}
            <div>
                <fieldset>
              <legend><code>  [  管理费  ] 共{$mCostArr|@count}条记录</code></legend>   
                           
            <form id="mCostEditFeeForm" name="mCostEditFeeForm">
                <input type="hidden" name="salaryDate" value='{$salaryDate}'>
                <input type="hidden" name="soInsDate" value='{$soInsDate}'>
                <input type="hidden" name="month" value='{$smarty.get.month}'>
                <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                <input type="hidden" name="type" value='mCost'>
                <table class="myTable">
                    <thead>
                        <tr >
                            <th rowspan="2">姓名</th>
                            <th rowspan="2">全选/反选
                                <br/>
                                <input name="mCostEditFeeChk" class=chkAll type="checkbox">
                            </th>
                            <th colspan="7">管理费</th>
                            <th rowspan="2">社保购买日</th>
                            <th rowspan="2">当前是否参保</th>
                        </tr>
                        <tr>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>均衡值</th>

                        </tr>
                    </thead>
                    <tbody>
                                            {foreach item=fVal name=foo from=$mCostArr}

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
                                                            {elseif $fk eq 'uID'}
                            <td>
                                <input type="checkbox"  name="mCostEditFeeCheck[{$fv}]" value="{$fv}" size=5>
                            </td>
                                                            {elseif $fk eq 'status' or $fk eq 'soInsBuyDate' or $fk eq 'soInsurance'}
                                                            {continue}
                                                            {elseif   $fk eq 'managementCostMargin'}
                            <td class="highLight">
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif  $fk eq 'managementCostMoney'  }
                            <td>
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif $fk eq 'managementCostS'}
                            <td>
                                <input type="text" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" value="{$fv}" size=5>
                            </td>
                                                            {else}
                            <td>
                                <span class="{$fk}">{$fv}</span>
                            </td>
                                                            {/if}

                                                            {/foreach}
                            <td>{$fVal.soInsBuyDate}</td>
                            <td>{$fVal.soInsurance}</td>
                        </tr>
                                                    {/foreach}
                        <tr>
                            <!--
                            <td>
                            <input type="button" class="sub" name="editFeeBtn" value="调整">
                                                            </td>
                                                            -->
                            <td colspan="2">

                            </td>
                            <td colspan="2">
                                <input type="button" name="setMoney" class="sub" value="将均衡值设置为欠/挂记录">
                            </td>
                            <td>
                                <input type="button" name="refresh" value="刷新">
                            </td>
                            <td colspan="2">
                                <input type="button" name="closeRefresh" value="关闭窗口">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </fieldset>
            </div>
                           {/if}
               {if $uPDInsArr}
            <div>
                <fieldset>
              <legend><code>            [ 残障金 ]    共{$uPDInsArr|@count}条记录</code></legend>   
               
            <form id="uPDInsEditFeeForm" name="uPDInsEditFeeForm">
                <input type="hidden" name="salaryDate" value='{$salaryDate}'>
                <input type="hidden" name="soInsDate" value='{$soInsDate}'>
                <input type="hidden" name="month" value='{$smarty.get.month}'>
                <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                <input type="hidden" name="type" value='uPDIns'>
                <table class="myTable">
                    <thead>
                        <tr >
                            <th rowspan="2">姓名</th>
                            <th rowspan="2">全选/反选
                                <br/>
                                <input name="uPDInsEditFeeChk" class=chkAll type="checkbox">
                            </th>
                            <th colspan="8">残障金</th>
                        </tr>
                        <tr>
                            <th>本月应收</th>
                            <th>本月实收</th>
                            <th>冲减挂账</th>
                            <th>应收欠款</th>
                            <th>收回欠款</th>
                            <th>本月欠/挂</th>
                            <th>均衡值</th>
                        </tr>
                    </thead>
                    <tbody>
                                            {foreach item=fVal name=foo from=$uPDInsArr}

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
                                                            {elseif $fk eq 'uID'}
                            <td>
                                <input type="checkbox"  name="uPDInsEditFeeCheck[{$fv}]" value="{$fv}" size=5>
                            </td>
                                                            {elseif $fk eq 'status'}
                                                            {continue}
                                                            {elseif   $fk eq 'PDInsMargin'}
                            <td class="highLight">
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif  $fk eq 'uPDInsMoney'  }
                            <td>
                                <input type="text" class="{$fk}" value="{$fv}" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" readonly size=5>
                            </td>
                                                            {elseif $fk eq 'uPDInsS'}
                            <td>
                                <input type="text" name="{$fk|cat:'['|cat:$fVal.uID|cat:']'}" value="{$fv}" size=5>
                            </td>
                                                            {else}
                            <td>
                                <span class="{$fk}">{$fv}</span>
                            </td>
                                                            {/if}

                                                            {/foreach}
                        </tr>
                                                    {/foreach}
                        <tr>
                            <!--
                            <td>
                            <input type="button" class="sub" name="editFeeBtn" value="调整">
                                                            </td>
                                                            -->
                            <td colspan="2">

                            </td>
                            <td colspan="2">
                                <input type="button" name="setMoney" class="sub" value="将均衡值设置为欠/挂记录">
                            </td>
                            <td>
                                <input type="button" name="refresh" value="刷新">
                            </td>
                            <td colspan="2">
                                <input type="button" name="closeRefresh" value="关闭窗口">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
                       </fieldset>
        </div>
{/if}
{include file="footer.tpl"}				