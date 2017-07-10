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
                    //新建/查看方案
                     $("select[name=zID]").change(function(){
                        var val=$(this).val();
                        if(val=="newZF"){
                                window.open('manageZF.php');
                        }else{
                            window.location.href ="http://"+location.host+location.pathname+"?zID="+$(this).val();
                        }
                      });            
                //日期格式输入调用jquery datepick
                $(".datePickModel").datepick();
    //调用数据
               var a = "basic";
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
                caption: "表属性",
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
                colModel:{$js_fieldSet}
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
      
    });
    </script>
{/literal}    
<div id="main">
    <div>
        <fieldset>
            <legend><code>基表操作</code></legend>
            <p class="notice">基表:[ 提示: 1. 该表可保存/删除临时操作数据 ]</p>
            <p>选择方案</p>
            <select class="req-string" name="zID">
                <option value="">请选择方案</option>
                <option value="newZF">新建/修改方案</option>
                {html_options options=$ZFArr selected=$s_zID}
            </select>
            <table class="myTable">
                <tr>
                    <th>全选/不选</th>
                    <th>表名</th>
                    <th>导入数</th>
                    <th>关系属性</th>
                    <th>处理数</th>
                    <th>操作</th>
                </tr>
                {foreach from=$tabName item=val}
                    <tr>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>
                            {$val}
                        </td>
                    </tr>
                {/foreach}
            </table>
        </fieldset>
    </div>
    <div>
        <table id="scroll"></table>
        <div id="pscroll" ></div>
    </div>
</div>
{include file="footer.tpl"}