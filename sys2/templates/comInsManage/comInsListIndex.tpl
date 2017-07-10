{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
    <script type="text/javascript">
            //soSoInsList.tpl
    $(document).ready(function(){
            //select-> change get 提交
        formSubmit("", "select[name=batch]", "change", ".conditionForm");
        // 判断select选项是否重复
        $(".sub").click(function(){
            var formID = this.form.id;
            var btnName = $(this).attr("name");
            var t, u, d, dt, m;
            t = "post";
            u = "comSql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName;
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
                var valid = isChecked("input[name=chkList[]]") ;
                if (valid != true) {
                    ajaxAction(t, u, d, dt, m);
                }else{
                                    alert("请在要操作的数据行上打钩");
                            }
            }
        });
    });
    </script>
{/literal}
<div id="main">
    <fieldset><legend><code>请选择</code></legend>
    <form method="get" class="conditionForm">
        <span>批次号</span>
        <select name="batch">
            <option value="">---请选择---</option>
            {html_options values= $batch output= $batch selected=$s_batch}
        </select>
    </form>
    <form action="" method="post">
        <input type="submit" value="下载本月数据" name="intoExcel" />
    </form>
    </fieldset>
         <fieldset><legend><code>商保申报表</code></legend>
        <p class="notice">   (注: 需要签收,才可以查看商保申报表信息)</p>
   
    {foreach from=$ret key=rKey item=rVal}
    <fieldset><legend><code>起保日期: {$rKey}</code></legend>
     <form name="listForm{$rkey}" id="listForm{$rKey}" action="" method="post">
        <table class="myTable" width="100%">
            <thead>
                <tr >
                    <th>√</th>
                    <th>投保公司</th>
                    <th>单位名称</th>
                    <th>提交人</th>
                    <th>提交日期</th>
                    <th>签收人</th>
                    <th>签收日期</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
                {foreach item=val key=key  from=$rVal}
                    <tr>
                        <td>
                            {if $val.typeName}
                                <input type="checkbox" name="chkList[]" value='{$val.unitID}|{$rKey}'>
                            {/if}
                        </td>
                        <td>
                            {if !$val.typeName}
                                <span class="red">出错了, 该单位不购买商保,请联系相关客户经理查证</span>
                            {else}
                                {if $val.status eq '1'}
                                    <a href="comInsListDetail.php?batch={$s_batch}&comInsType={$val.comInsType}&comInsModifyDate={$rKey}" target="_blank">{$val.typeName}</a>
                                {else}
                                    {$val.typeName}
                                {/if}
                            {/if}
                        </td>
                        <td>
                            {if $val.status eq '1'}
                                <a href="comInsListDetail.php?batch={$s_batch}&unitID={$val.unitID}&comInsModifyDate={$rKey}" target="_blank">{$val.unitName|replace:"深圳市":""}</a>
                            {else}
                                {$val.unitName|replace:"深圳市":""}
                            {/if}
                        </td>
                        <td>
                            {$val.sponsorName}
                        </td>
                        <td>
                            {$val.sponsorTime}
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
							{elseif $val.status eq '99'}		
											<span class="red">已退回</span>		
                            {else}
											出错了
                            {/if}
                        </td>
                    </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="8">
										目前不存在本月商保申报数据
                            </td>
                        </tr>
                        {/foreach}
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="sub" name="receive" value="签收">
                                </td>
                                <td colspan="2">
                                    <input type="button" class="sub" name="rollback" value="退回">
                                </td>
                                <td colspan="2">
                                 <input type="hidden"  name="thisComInsModifyDate"  value="{$rKey}" />
                               	  <input type="submit"  name="intoExcel" value="下载">
                                </td>
                            </tr>
                        </tbody>
                    </table>	
                     </form>
                     </fieldset>
                    {/foreach}			
                     </fieldset>
            </div>
        </div>
        {include file="footer.tpl"}