{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
    <script>

	
            $(document).ready(function(){
                //审批流程加载,注意一下下列规则
                $("div[id$=AppPro]").each(function(i){
                    var appProID = $(this).attr('id') + "ID";
                    $(this).load("../approval/approvalProcessDetail.php", {
                        "appProID": $("input[name=" + appProID + "]").val()
                    });
                });
		
                $(".tab").click(function(){
                        var queryString = location.href;
                        var viewType=$(this).attr('alt');
                        var newUrl=RegularUrl(queryString ,"viewType",viewType);
                        window.location.href = newUrl;
                        });
                            
                $(".tab").each(function(i){
			var viewType=getQuery('viewType');
                           var proSel = $(this).attr('alt');
			if(proSel==viewType){
			   $(this).parent().css({'background':'#eddece'});
			}
		});
                       //提交
                $(".sub").click(function(){
                    var formID = $(this).parents("form").attr("id");
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "approvalSql.php";
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
                            var ret = confirm("确定" + $(this).text()+ "?");
                                     if (ret == true) {
                                ajaxAction(t, u, d, dt, m);
                            }
                });
                    $("iframe").load(function() { 
                        $(this).height($(this).contents().height()); 
                        })
            });
    </script>
{/literal}
<div id="main">
    <fieldset>
        <fieldset>
            <legend><code>工资费用表/发放表审批</code></legend>
            <table class="myTable" width="100%">
                <tr>
                    <th>名称</th>
                    <th>审批进程</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        {$listRet.month}月< {$unit[$listRet.unitID].unitName} > 的<{$listRet.typeName}>审批
                    </td>
                    <td>
                        <input type="hidden" name="feeAppProID" value="{$listRet.appProID}" />
                        <div id="feeAppPro">
                        </div>
                    </td>
                    <td>
                        [ <a href="{$detailUrl}" target="_blank">查看本月详细数据</a>]
                    </td>
                </tr>
            </table>
        </fieldset>
        <div class="tabLayout center halfWidth" >
            <div class="block left halfWidth" >
                <a class="tab"  alt="salary" >查看发放表</a>
            </div>
            <div class="block right halfWidth" >
                <a class="tab"  alt="fee" >查看费用表</a>
            </div>
        </div>
        <fieldset>
            <legend><code>公式及原始费用表项目</code></legend>
            <div id="formulasChart">
                <table class="myTable">
                    {$formulasChartStr}
                </table>
            </div>
            <div class="block">
                <br>
                <p>应发工资 ={$formulasStr.pay} </p><br>
                <p>应缴纳税额 = 应发工资 - 个人社保 -个税起征额{$formulasStr.ratal}</p><br>
                <p>实发工资 = 应发工资 - 个税 - 个人社保  - 个人商保 - 收回社保欠款 - 收回商保欠款 -收回其他欠款- 房屋水电 - 互助会 {$formulasStr.acheive}</p><br>
                <p>单位挂账 = {$formulasStr.uAccount}</p><br>
                <p>总费用=应发工资+残障金+单位社保+单位商保+管理费+单位挂账 {$formulasStr.totalFee}</p><br>
            </div>
        </fieldset>
        <iframe src="{$iframeUrl}" width="100%"  frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes"  ></iframe>
        {if $nRet.proID}
            <form id="approvalForm">
                <input type="hidden" name="proID" value='{$nRet.proID}'>
                <input type="button" class="sub" name="approvalSucc" value="审批通过"> 
                <input type="button" class="sub" name="approvalRollback" value="退回">
                备注: <textarea name="approvalRemarks"></textarea>
            </form>
        {/if}
    </fieldset>
</div>
{include file="footer.tpl"}