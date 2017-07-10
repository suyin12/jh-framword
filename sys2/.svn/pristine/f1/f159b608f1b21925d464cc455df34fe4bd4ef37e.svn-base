{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script type="text/javascript">

        $(document).ready(function(){
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
                var btnName = $(this).attr("name")
                var chkName = ":checkbox[name^=editSalaryCheck]";
                var t, u, d, dt, m;
                t = "post";
                u = "salarySql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName + "&type=salary";
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
            //关闭窗口,并且刷新父窗口
            $("input[name=closeRefresh]").click(function(){
                if(getQuery("extraBatch"))
                     top.location.href = "makeSalaryFee_mul.php" + location.search;    
                 else
                     top.location.href = "makeSalaryFee.php" + location.search;
            });
            $("input[name=refresh]").click(function(){
                window.location.href = location.href;
            });
            //显示调整过的数据
            checkReload(":checkbox[name=displayModify]");
        });
</script>
{/literal}
<div id="mainBody">
    <div>
        <form method="post" action="">  
        <p class="success">
            共<span class="red">{$salaryArr|@count}</span>条记录
             按姓名查找: <input name="name" type="text"/> <input name="search" type=submit value="查找" />
                <input type="checkbox" name="displayModify" value="all" {if $smarty.get.displayModify eq 'true'}checked{/if}> 只显示调整过的记录
                <input type="button" name="refresh" value="刷新">
                <input type="button" name="closeRefresh" value="关闭窗口">
            </p>
            </form>
            <form id="editSalaryForm" name="editSalaryForm">
            <input type="hidden" name="month" value='{$month}'>
            <table class="myTable">
                <thead>
                    <tr>
                        <th>全选/反选
                            <br/>
                            <input name="editSalaryChk" class=chkAll type="checkbox">
                        </th>
                        <th>姓名</th>
                        <th>应发工资</th>
                        <th>个人社保</th>
                        <th>单位社保</th>
                         <th>个人公积金</th>
                        <th>单位公积金</th>
                        <th>个人商保</th>
                        <th>单位商保</th>
                        <th>收回社保欠款</th>
                        <th>收回公积金欠款</th>
                        <th>互助会</th>
                        <th>制卡费</th>
                        <th>房屋水电</th>
                        <th>在职状态</th>
                    </tr>
                </thead>
            <tbody>
                            {foreach item=sVal from=$salaryArr}
                            {if $sVal.status eq '0'}
                <tr class="red">
                                    {else}
                <tr>
                        {/if}
                        {foreach item=sv key=sk from=$sVal}
                        {if $sk eq 'status' }
                    <td>{if $sv eq '0'}离职{/if}</td>
                         {elseif $sk eq 'uID'}
                             {continue}
                                    {elseif $sk eq 'ID' }
                    <td>
                        <input type="checkbox" name="editSalaryCheck[{$sv}]" value="{$sv}" size='5'>
                    </td>
                                            {elseif $sk eq 'pay' or $sk eq 'uSoIns' or  $sk eq 'uHF' or $sk eq 'uComIns' }
                    <td>{$sv|defaultNULL:""}</td>
                                            {else}
                    <td>
                        <input type="text" size="8" name="{$sk|cat:'['|cat:$sVal.ID|cat:']'}" value='{$sv|defaultNULL:''}'>
                    </td>
                                            {/if}
                                            {/foreach}
                </tr>
                                    {/foreach} 
                    <tr>
                        <td colspan=2>
                            <input type="button" class="sub" name="editSalaryBtn" value="调整费用">
                        </td>
                        <td colspan=2>
                            <input type="button" name="refresh" value="刷新">
                        </td>
                        <td colspan=2>
                            <input type="button" name="closeRefresh" value="关闭窗口">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
			{include file="footer.tpl"}