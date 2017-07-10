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
                        tipsWindown('社保类型设置', 'iframe:' + thisUrl, 680,400, 'true', '', 'true', 'leotheme','true');
               		});
                });
                //删除
                //提交
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
<table width="100%" class="myTable">
 <tr>
  <th>编号</th> 
  <th>变更日期</th>
  <th>名称</th>
  <th>社平工资</th>
  <th>单位养老</th>
  <th>个人养老</th>
  <th>单位医疗</th>
  <th>个人医疗</th>
  <th>单位工伤</th>
  <th>单位失业</th>
  <th>个人失业</th>
  <th>单位生育</th>
  <th>最低缴交</th>
  <th>社会最低工资</th>
  <th>操作<a class="editSub noSub positive" alt="soIns_edit.php">新建</a></th>
 </tr>
 {section name=line loop=$soIns}
 <tr>
  <td>{$soIns[line].type}</td> 
  <td>{$soIns[line].month}</td>
  <td>{$soIns[line].typeName}</td>  
  <td>{$soIns[line].societyAvg}</td> 
  <td>{$soIns[line].uPension}</td> 
  <td>{$soIns[line].pPension}</td> 
  <td>{$soIns[line].uHospitalization}</td> 
  <td>{$soIns[line].pHospitalization}</td> 
  <td>{$soIns[line].uEmploymentInjury}</td> 
  <td>{$soIns[line].uUnemployment}</td>
  <td>{$soIns[line].pUnemployment}</td>  
  <td>
   {if $soIns[line].uBirth==0}
  	空
   {else}
    {$soIns[line].uBirth}
   {/if}
  </td>
  <td>
  {$soIns[line].minRadix}
  </td>
  <td>
  {$soIns[line].minSalaryAvg}
  </td>
  <td><a class="editSub noSub positive" alt="soIns_edit.php?id={$soIns[line].ID}">编辑</a>
   <a class="aSub negative" name="delSoInsType" alt='{$soIns[line].ID}'>删除</a>
  </td>
 </tr>
 {/section}
</table>
</fieldset>
</div>
{include file="footer.tpl"}