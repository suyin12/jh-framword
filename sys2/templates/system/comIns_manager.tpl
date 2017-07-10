{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script language="javascript" src="{$httpPath}lib/js/tipswindown.js"></script>
{literal}
<script type="text/javascript">
        $(document).ready(function(){
            //费用处理
                $(".editSub").each(function(i){
                    $(this).click(function(){
                        var thisUrl = $(this).attr("alt");
                        tipsWindown('调整费用', 'iframe:' + thisUrl, 680,400, 'true', '', 'true', 'leotheme','true');
                    });
                });
                    function del(url,n)
                        {
                          if(confirm('确定删除该数据'))
                          {
                            location.href=url+'?edit=del&delid='+n;
                          }
                        }
               //删除
                $(".aSub").click(function(){
                    var btnName = $(this).attr("name");
                    var t, u, d, dt, m;
                    t = "post";
                    u = "sysSql.php";
                    d ="ID="+$(this).attr("alt") + "&btn=" + btnName;
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
<div id="main">
    <fieldset>
<table class="myTable halfWidth" >
 <tr><th>类型编号</th><th>商保名称</th><th>投保金额</th><th>操作&nbsp;&nbsp;<a class="editSub noSub positive" alt='comIns_add.htm' >新建</a></th></tr>
{section name=line loop=$comIns}
 <tr>
  <td>{$comIns[line].comInsType}</td>
  <td>{$comIns[line].typeName}</td>  
  <td>{$comIns[line].comInsMoney}</td> 
  <td>
   <a class="editSub noSub positive" alt="comIns_edit.php?id={$comIns[line].comInsType}" >编辑</a>&nbsp;&nbsp;
   <a class="aSub negative" name="delComInsType" alt='{$comIns[line].comInsType}'>删除</a>
  </td>     
 </tr>
{/section}
</table>
</fieldset>
</div>
{include file="footer.tpl"}