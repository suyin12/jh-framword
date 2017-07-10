{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript"	src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
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
                            var chkName = ":checkbox[name^=salarySetCheck]";
                    var t, u, d, dt, m;
                    t = "post";
                    u = "salarySql.php";
                    d = $("#" + formID).serialize() + "&btn=" + btnName;
                    if(getQuery("extraBatch"))
                        d = d+"&type=mulSalary";
                    else
                        d= d +"&type=salary";
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
                            }else{
                            alert("请勾选要操作的数据");
                            }
                });
            });
    </script>
{/literal}
<div id="mainBody">
    <div>
        <p>工资表明细(共<span class="red">{$salaryArr|@count}</span>条记录)</p>
        <form method="post" name="salarySetForm" id="salarySetForm">
            <input type="hidden" name="salaryDate" value="{$salaryDate}">
            <table class="myTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>待发状态</th>
                        <th>姓名</th>
                        <th>工资账号</th>
                        <th>应发工资</th>
                        <th>实发工资</th>
                        <th>发放日期</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach item=sVal from=$salaryArr}
                        {if $sVal.salaryStatus eq '0'}
                            <tr class="red">
                            {else}
                            <tr>
                            {/if}
                            {foreach item=sv key=sk from=$sVal}
                                {if $sk eq 'name'}
                                    <td>
                                        <a href="{$httpPath|cat:'workerInfo/wManage.php?uID='|cat:$sVal.uID}" target="_blank">{$sv}</a>
                                    </td>
                                {elseif $sk eq 'uID'}
                                    {continue}
                                {elseif  $sk eq 'ID' }
                                    <td><input type="checkbox" name="salarySetCheck[{$sv}]" value="{$sv}" size=5></td>
                                    {elseif  $sk eq 'salaryStatus' }
                                    <td>{if $sv eq '0'}待发{else}{/if}</td>
                                {elseif  $sk eq 'salaryProvideDate' }
                                    <td><input type="text"  name="salaryProvideDate[{$sVal.ID}]" value="{$sv}" size="10"></td>
                                    {else}
                                    <td>
                                        {$sv}
                                    </td>
                                {/if}
                            {/foreach}
                        </tr>
                    {/foreach}
                    <tr>
                        <td colspan=3><input type="button" class="sub" name="setWait" value="设置为待发工资"></td>
                        <td ><input type="button" class="sub" name="cancelWait" value="取消待发工资"></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <div id="errorDiv"></div>
    </div>
</div>
{include file="footer.tpl"}