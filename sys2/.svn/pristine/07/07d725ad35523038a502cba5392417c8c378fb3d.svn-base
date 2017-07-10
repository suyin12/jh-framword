{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
{/literal}
    {if $smarty.post.selPost neq '1'}
{literal}    
        if(getQuery("selPost")!="1"){ 
         $('.myTable').fixedHeaderTable({ height: '500', altClass: 'odd',fixedColumns: 2, themeClass: 'myTable' });
         }
{/literal}
    {/if}
{literal}    
             //筛选条件的POST提交.. wInfo.php
        $(".selPost").change(function(){
            $(".selForm").submit();
        });
                // 员工信息查询
        $("input[name=c]").one("click", function(){
            $(this).val("");
            $(":checkbox[name=status]").attr("checked",false);
        });
        $("input[name=wS]").click(function(){
            successFun = function(){
                $("#wSForm").submit();
            }
            validator("input[name=wS]", "#wSForm", "#errorDiv", successFun);
        });
        // 全选/反选
        $('#CK').click(function(){
            if ($(this).attr('checked') == true) {
                $(".ckb").attr('checked', true);
            }
            else {
                $('.ckb').attr('checked', false);
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
    
    });
    </script>
{/literal}
<div id="main">
    <input	type="hidden" class="j_unitManager" value='{$j_unitManager}'>
    <form method="GET" class="form" id="wSForm" action={$actionURL}>
        <div>
            <table height="70" border="0">
                <tr>
                    <td width="10%"><strong>请选择查询条件</strong></td>
                    <td width="11%"><select name="m" class="req-string">

                            {html_options options=$m selected=$s_m}

                        </select></td>
                    <td ><input type="text" name="c" value="{$c}" />
                        <input 	name="status" type="checkbox" value="1" {$status|default:checked} />
                        不包含离职员工</td>
                </tr>
                <tr>
                    <td><strong>客户经理</strong></td>
                    <td><select name="mID">
                            <option value="">--请选择--</option>

                            {foreach from = $unitManager item = val} 
                            {html_options	values=$val.mID output= $val.mName selected= $s_mID} {/foreach}

                        </select></td>
                    <td><strong>单位</strong> <select name="unitID">
                            <option value="">---------------请选择------------</option>

                            {foreach from= $unitManager item= val key=k } 
                                {foreach from= $val	item=u key= k} {if $k eq "unit"}
                                        {foreach from= $u item= m key= n}
                                            {html_options values= $m.unitID output= $m.unitName|replace:"深圳市":""	selected=$s_unitID}
                            {/foreach} {/if} {/foreach} {/foreach}
                            </select> 
                     {if $wantToMergeInfo}
                        <strong>合并类别
                             <select name="wantToMerge">
                                 <option value="">---请选择---</option>
                                 {html_options options=$wantToMergeInfo  selected= $s_wantToMerge} 
                             </select>
                         </strong>
                      {/if}
                       <input type="button" name="wS" value="查询" /></td>
                </tr>
            </table>
            <div id="errorDiv" class="error-div-alternative"></div>
        </div>
    </form>
    <div>
        <fieldset>
            <legend>
                <code>
                    结果
                </code>
            </legend>
            <form class="selForm" method="post">
                <input type="hidden" name="selPost" value="1" />
                <table class="myTable">
                    <thead>
                        <tr>
                            <th>操作</th>
                            <th>姓名</th>
                            <th><select class="selPost" name=statusSel>
                                    <option value="">状态</option>
                                    {html_options values= $statusArr	output=$wInfoSet['status']	 selected=$s_statusSel}
                                </select></th>
                            <th>员工编号</th>
                            <th><select class="selPost" name=unitSel>
                                    <option value="">单位</option>
                                    {html_options values= $unitNameArr	output=$unitNameArr|replace:"深圳市":"" selected=$s_unitSel}
                                </select></th>
                            <th>身份证号码</th>
                            <th>工资账号</th>
                            <th>移动电话</th>
                            <th><select class="selPost" name=typeSel>
                                    <option value="">员工类型</option>
                                    {html_options values= $typeArr 	output=$wInfoSet['type']	selected=$s_typeSel}
                                </select></th>
                                <!--
                            <th><select class="selPost" name=managementCostSel>
                                    <option value="">管理费</option>
                                    {html_options values= $managementCostArr output=$managementCostArr		selected=$s_managementCostSel}
                                </select></th>
                                -->
                            <th>社保号</th>
                            <th><select class="selPost" name=filialeSel>
                                    <option value="">分公司</option>
                                    <option value="notNull" {if $smarty.post.filialeSel eq "notNull"}selected{/if}>非空白</option>
                                    {html_options values= $filialeArr|default:"Null" output=$filialeArr|default:"空白"  selected=$s_filialeSel}
                                </select></th>
                            <th><select class="selPost" name=departmentSel>
                                    <option value="">部门</option>
                                    <option value="notNull" {if $smarty.post.departmentSel eq "notNull"}selected{/if}>非空白</option>
                                    {html_options values= $departmentArr|default:"Null" output=$departmentArr|default:"空白"  selected=$s_departmentSel}
                                </select></th>
                            <th><select class="selPost" name=domicileSel>
                                    <option value="">户籍类型</option>
                                    {html_options values= $domicileArr	output=$wInfoSet['domicile']  selected=$s_domicileSel}
                                </select></th>
                            <th><select class="selPost" name=soInsuranceSel>
                                    <option value="">社保</option>
                                    {html_options values= $soInsArr	output=$soInsArr|replace:"1,2":"参加"|replace:"0":"否"	selected=$s_soInsuranceSel}
                                </select></th>
                            <th><select class="selPost" name=comInsuranceSel>
                                    <option value="">商保</option>
                                    {html_options values= $comInsArr output=$comInsArr|replace:"1":"参加"|replace:"0":"否"	selected=$s_comInsuranceSel}
                                </select></th>
                            <th><select class="selPost" name=helpCostSel>
                                    <option value="">互助会</option>
                                    {html_options values= $helpCostArr output=$helpCostArr|replace:"1":"参加"|replace:"":"否"|replace:"0":"否"		selected=$s_helpCostSel}
                                </select></th>
                        </tr>
                    </thead>
                    <tbody>

                        {section name=row loop=$ret} 
                            {if $smarty.session.mID eq $ret[row].mID}
                                {assign var=update value="&update=true"} 
                            {/if}
                            {if $ret[row].status != 0}
                            <tr>
                                <td>
                                <a class="positive" href={$httpPath|cat:"/workerInfo/wPersonInfo.php?uID="|cat:$ret[row].uID|cat:$update}  target="_blank">编辑</a>
                            </td>
                            {else}
                                <tr class="red">
                                <td></td>
                            {/if}    
                            <td ><!--这里预留查看及其打印工资条,或离职等处理 --><a href={$httpPath|cat:"workerInfo/wManage.php?uID="|cat:$ret[row].uID|cat:$update}  target="_blank">{$ret[row].name}</a></td>
                            <td >{$wInfoSet['status'][$ret[row].status]}</td>
                            <td>{$ret[row].uID}</td>
                            <td >{$ret[row].unitName|replace:"深圳市":""}</td>
                            <td >{$ret[row].pID}</td>
                            <td >{$ret[row].bID}</td>
                            <td >{$ret[row].mobilePhone}</td>
                            <td >{$wInfoSet['type'][$ret[row].type]}</td>
<!--                            <td >{$ret[row].managementCost}</td>-->
                            <td >{$ret[row].sID}</td>
                            <td >{$ret[row].filiale}</td>
                            <td >{$ret[row].department}</td>
                            <td >{$wInfoSet['domicile'][$ret[row].domicile]}</td>
                            <td >{if $ret[row].soInsurance eq '1' ||	$ret[row].soInsurance eq '2'}參加{elseif $ret[row].soInsurance eq 0}否{/if}</td>
                            <td >{if $ret[row].comInsurance eq '1'}參加{elseif	$ret[row].comInsurance eq 0}否{/if}</td>
                            <td >{if $ret[row].helpCost eq 1}參加{elseif $ret[row].helpCost eq 0}否{/if}</td>
                        </tr>

                    {sectionelse}
                        <tr>
                            <td ></td>
                             <td ></td>
                            <td colspan="8" ><span class="negative">没有查询结果</span></td>
                        </tr>
                    {/section}
                </tbody>

            </table>

            <div class="tt">
                <div class="left">{$pageList}</div>
                <div class="right">
                		<input type="checkbox" name="codeVison" value="1" >编码格式版本
                        <input type="submit"  name="intoExcel"  value="保存为EXCEL"  />
                </div>
                </div>
    </fieldset>
    </form>
</div>
</div>
{include file="footer.tpl"}