{include file="header.tpl"}
<link rel="stylesheet" type="text/css" media="screen" href="{$httpPath}lib/js/jqGrid/css/ui.jqgrid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="{$httpPath}lib/js/jqGrid/css/jquery-ui-1.8.2.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="{$httpPath}lib/js/jqGrid/css/ui.multiselect.css" />
<link rel="stylesheet" type="text/css" media="screen" href="{$httpPath}css/jquery.datepick.css" />
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
<script src="{$httpPath}lib/js/jqGrid/js/i18n/grid.locale-cn.js" type="text/javascript"></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script src="{$httpPath}lib/js/jqGrid/js/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>
<script src="{$httpPath}lib/js/jqGrid/js/ui.multiselect.js" type="text/javascript"></script>
<script src="{$httpPath}lib/js/jqGrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<script src="{$httpPath}lib/js/jqGrid/src/jsonXml.js" type="text/javascript"></script>
<script src="{$httpPath}lib/js/jqGrid/src/grid.import.js" type="text/javascript"></script>
{literal}
    <script>
           $(document).ready(function(){
                   //刷新页面,用checkbox来控制
                radioReload(":radio[name=zeroFee]");
                //日期格式输入调用jquery datepick
                $(".datePickModel").datepick();
    //调用数据
               var a = "createFee";
            $("#scroll").jqGrid({
                url:'data.php'+location.search+"&a="+a,
                datatype: "json",
                height:600,
                rowNum:50,
                rowList : [50,100,500],
                mtype: "GET",
               autowidth:true,
                rownumbers: true,
                rownumWidth: 40,
                multiselect: true,
                pager: '#pscroll',
                viewrecords: true,
                caption: "费用核算",
                grouping: true,
                groupingView : {
                        groupField : ['status'],
                         groupOrder: ['desc'],   
                        groupText : ['<b>{0}</b>'],
                        groupCollapse : false,
                       groupSummary : [true],
                        showSummaryOnHide: true,
                         groupColumnShow : [false]
        },
             footerrow: true,
             userDataOnFooter: true,
    {/literal}
                 editurl:'{$editUrl}',
                colNames:{$js_fieldName},
                colModel:{$js_fieldSet},
    {literal}
        });

          // 设置表格底栏
        $("#scroll").jqGrid('navGrid','#pscroll', {search:false} );
        $("#scroll").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
            //额外按钮配置    
        $("#scroll").jqGrid('navButtonAdd','#pscroll',{
        caption: "",
        title: "选择显示项目",
        onClickButton : function (){
         $("#scroll").jqGrid('columnChooser',{title:"选项"});
         }
         });
          //导出EXCEL
         $("#scroll").jqGrid('navButtonAdd','#pscroll',{
        caption: "",
        title: "导出EXCEL",
        onClickButton : function (){
             $("#scroll").excelExport({tag:'excel',url:'data.php'+location.search+"&a="+a})
           },
         buttonicon:'ui-icon-note'     
        });
        //自定义大小    
              $("#scroll").jqGrid('gridResize',{minWidth:800,minHeight:300});
     //提交
            $(".sub").click(function(){
                var formID = this.form.id;
                var btnName = $(this).attr("name")
                var t, u, d, dt, m;
                t = "post";
                u = "sql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName + "&x=createFee";
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
    });
    </script>
{/literal}    

<div id="mainBody">
    <fieldset>
        <legend><code>选择日期</code></legend>
        <p class="notice"><span class="red">最早离职日期</span>:指该月费用要包括的该日期之后离职的人员  <br>
            <span class="red">最迟入职日期</span>:指从该费用表中,排除该日期之后入职的人员        </p>
        <form method="POST" >
            最早离职日期: <input name="bT" type="text" class="datePickModel" value='{$bT|default:$lastMonthDate}'>  最迟入职日期: <input name="eT" type="text" class="datePickModel" value='{$eT|default:$today}'>
            <input type="submit" name= "setDate" value="确定">
            <input type="submit" name="del"  value="清空操作数据" >
        </form>
    </fieldset>
    <fieldset>
        <legend><code>公式设置</code></legend>
        <p class="notice">特别提醒:选择下表中项,设置公式,这里的公式只能整列计算</p>
        <div id="formulasChart">
            <table class="myTable">
                {$formulasChartStr}
            </table>
        </div>
        <form name=formulasSet id = formulasSet>
            <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
            <input type="hidden" name="month" value='{$smarty.get.month}'>
            <input type="hidden" name="ID" value='{$formulasID}'>
            <table>
                <tr>
                    <td>总费用=</td>
                    <td>
                        <input type="text" name="formulas[totalFee]" value='{$formulasStr.totalFee}' readonly=true size=200 />
                    </td>
                </tr>
            </table>
            <input type="button" name="subFormulas" class="sub" value="提交公式">
            {if !$formulasID}
                <input type="button" name="citeFormulas" class="sub" value="引用上月公式">
            {/if}
            <input type="button" name="deleteFormulas" class="sub" value="删除公式" />
        </form>
    </fieldset>
    <fieldset>
        <legend><code>固定项显示设置</code></legend>
        <p class="notice">提示:如果显示项目在EXCEL内显示,请在此勾选</p>
        <div id="styleChart">
            <form name='styleForm' id ='styleForm'>
                <input type="hidden" name="ID" value='{$assistID}'>
                <input type="hidden" name="unitID" value='{$smarty.get.unitID}'>
                <table class="myTable">
                    {$wInfoFieldStr}
                </table>
                <input type="button" name="styleBtn" class="sub" value="确定">
            </form>
        </div>
    </fieldset>
    <fieldset>
        <legend><code>费用显示设置</code></legend>
        <input  type="radio" name="zeroFee" value="0" {if !$smarty.get.zeroFee}checked{/if} />显示全部&nbsp;&nbsp;&nbsp;&nbsp;
        <input  type="radio" name="zeroFee" value="1"  {if $smarty.get.zeroFee eq '1'}checked{/if}  />不显示费用为0的人员(不包括离职人员)&nbsp;&nbsp;&nbsp;&nbsp;
        <input  type="radio" name="zeroFee" value="2" {if $smarty.get.zeroFee eq '2'}checked{/if}  />不显示费用为0的人员(包括离职人员)&nbsp;&nbsp;&nbsp;&nbsp;
        <input  type="radio" name="zeroFee" value="3" {if $smarty.get.zeroFee eq '3'}checked{/if}  />只显示费用为0的人员
    </fieldset>

    <div>
        <table id="scroll"></table>
        <div id="pscroll" ></div>
    </div>
</div>
{include file="footer.tpl"}