{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.fixedheadertable.min.js></script>
{literal}
    <script>
    $(document).ready(function(){
                  //固定表头
             $('.myTable').fixedHeaderTable({ height: '500', altClass: 'odd',fixedColumns: 1, themeClass: 'myTable' });
                 //弹窗
                  $(".editSub").each(function(i){
                        $(this).click(function(){
                            var thisUrl = $(this).attr("alt");
                            tipsWindown('单位设置', 'iframe:' + thisUrl, 1000,500, 'true', '', 'true', 'leotheme','true');
                        });
                    });
                   //选择 
              selectReload("select[name=status]");
    });
    </script>
{/literal}
<div id="main">
    <fieldset>
        <legend><code>单位列表</code></legend>
        <table class="myTable" >
            <thead>
                <tr>
                    <th>单位名称</th>
                    <th>单位编号</th>
                    <th>
                        <select name="status">
                            <option>--状态--</option>
                            {html_options options=$statusArr selected=$s_status }
                        </select>
                    </th>
                    <th>合并编号</th>
                    <th>商保缴交方式</th>
                    <th>单位商保应收</th>
                    <th>个人商保应收</th>
                    <th>非全商保支付方式</th>
                    <th>社保支付方式</th>
                    <th>非全社保支付方式</th>
                    <th>公积金支付方式</th>
                    <th>非全公积金支付方式</th>
                    <th>社保垫付方式</th>
                    <th>公积金垫付方式</th>
                    <th>公积金欠款分摊方式</th>
                    <th>管理费限制</th>
                    <th>全日制管理费</th>
                    <th>非全日制管理费</th>
                    <th>社保登记账户</th>
                    <th>住房公积金登记账户</th>
                    <th>单位地址</th>
                    <th>客户经理</th>
                    <th>业务文员</th>
                    <th>社保专员</th>
                    <th>公积金专员</th>
                    <th>商保专员</th>
                    <th>就业登记专员</th>
                    <th>编辑&nbsp;&nbsp;<a class="editSub noSub positive" alt="unitInfo_edit.php" >添加单位</a></th>
                </tr>
            </thead>
            <tbody>
                {foreach item=value from=$retunitinfo}
                    <tr>
                        <td>{$value.unitName}</td>
                        <td>{$value.unitID}</td>
                        <td>{$statusArr[$value.status]}</td>
                        <td>{$value.wantToMerge|defaultNULL:''}</td>
                        <td>{$comInsTypeArr[$value.comInsType].typeName}{$comInsTypeArr[$value.comInsType].comInsMoney}</td>
                        <td>{$value.uComInsMoney|defaultNULL:''}</td>
                        <td>{$value.pComInsMoney|defaultNULL:''}</td>
                        <td>{$insuranceFromArr[$value.notFullComInsFrom]}</td>
                        <td>{$insuranceFromArr[$value.soInsFrom]}</td>
                        <td>{$insuranceFromArr[$value.notFullSoInsFrom]}</td>
                        <td>{$insuranceFromArr[$value.HFFrom]}</td>
                        <td>{$insuranceFromArr[$value.notFullHFFrom]}</td>
                        <td>{$insuranceModelArr[$value.soInsModel]}</td>
                        <td>{$insuranceModelArr[$value.HFModel]}</td>
                        <td>{$insuranceMoneyReciveArr[$value.HFMoneyRecive]}</td>
                        <td>{$value.mCostLimit}</td>
                        <td>{$value.fullManageCost|defaultNULL:''}</td>
                        <td>{$value.notFullManageCost|defaultNULL:''}</td>
                        <td>{$value.soInsID}</td>
                        <td>{$value.housingFundID}</td>
                        <td>{$value.unitAddr}</td>
                        <td>
                            {foreach from=$mgrUnit item=v}
                            {if array_key_exists($value.unitID,$v['unit'])}{$v['mName']}{/if}
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$mgrLUnit item=v}
                            {if array_key_exists($value.unitID,$v['unit'])}{$v['mName']}{/if}
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$soInsUnit item=v}
                            {if array_key_exists($value.unitID,$v['unit'])}{$v['mName']}{/if}
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$HFUnit item=v}
                            {if array_key_exists($value.unitID,$v['unit'])}{$v['mName']}{/if}
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$comInsUnit item=v}
                            {if array_key_exists($value.unitID,$v['unit'])}{$v['mName']}{/if}
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$jobRegUnit item=v}
                            {if array_key_exists($value.unitID,$v['unit'])}{$v['mName']}{/if}
                            {/foreach}
                        </td>
                            <td>
                                <a class="editSub noSub positive" alt="unitInfo_edit.php?id={$value.ID}" >更新</a>
                                <a class="noSub positive" href="user_Manager.php" target="_blank" >分配</a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </fieldset>
    </div>   
    {include file="footer.tpl"}