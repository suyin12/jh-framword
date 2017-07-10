{include file="header.tpl"}
<div id="main">
    <fieldset>
        <fieldset>
            <legend><code>状态信息</code></legend>
            <table width="100%">
                <tr height="40px">
                    <td>状态</td>
                    <td>{$statusTxt}</td>
                    <td>最后修改人</td>
                    <td>{$sysUserArr[$lastModifyBy]['mName']}</td>
                    <td>修改时间</td>
                    <td>{$lastModifyTime}</td>
                    <td>修改备注</td>
                    <td>{$modifyRemarks}</td>
                </tr>
                <tr height="40px">
                    <td>所属人删除</td>
                    <td>{if $isUserDelete eq '1'}是{else}否{/if}</td>
                    <td>所属人</td>
                    <td>{$wxUserArr[$userID]['truename']}</td>
                    <td>所属人电话</td>
                    <td>{$wxUserArr[$userID]['mobile']}</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend><code>个人基本信息</code></legend>
            <table width="100%">
                <tr height="40px">
                    <td class="PerInfoWidth">姓名<span class="red">*</span></td>
                    <td>{$name}</td>
                    <td>性别<span class="red">*</span></td>
                    <td>{$sexTxt}</td>
                    <td>身份证<span class="red">*</span></td>
                    <td>{$pID}</td>
                    <td>联系电话<span class="red">*</span></td>
                    <td>{$mobilePhone}</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>
                <code>参加保险信息</code>
            </legend>
            <table width="100%">
                <tr height="40px">
                    <td class="PerInfoWidth">购买日期<span class="red">*</span></td>
                    <td>{if $soInsBeginDay=="0000-00-00"}{else}{$soInsBeginDay}{/if}</td>
                    <td>社保修改日期</td>
                    <td>{if $soInsModifyDate=="0000-00-00"}{else}{$soInsModifyDate}{/if}</td>
                    <td>社保缴交月份<span class="red">*</span></td>
                    <td>{$soInsNeedMonthNum}个月</td>
                    <td>社保电脑号</td>
                    <td>{$sID}</td>
                </tr>
                <tr height="40px">
                    <td>服务费<span class="red">*</span></td>
                    <td>{$mCost|default:"免"}</td>
                    <td>服务费模式<span class="red">*</span></td>
                    <td>{$mCostLimitTxt}</td>
                    <td>缴交基数<span class="red">*</span></td>
                    <td>{$radix}</td>
                    <td>参保类型<span class="red">*</span></td>
                    <td>{$cityInsuranceTxt}</td>
                </tr>
                <tr height="40px">
                    <td>养老<span class="red">*</span>
                        <input type="checkbox" name="pension" {if $pension eq 1}  checked{/if}/></td>
                    <td>工伤<span class="red">*</span>
                        <input type="checkbox" name="employmentInjury" {if $employmentInjury eq 1}  checked{/if}/></td>
                    <td>失业<span class="red">*</span>
                        <input type="checkbox" name="unemployment" {if $unemployment eq 1}  checked{/if}/></td>
                    <td>残障险<input type="checkbox" name="PDIns" {if $PDIns eq 1}  checked{/if}/></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend><code>公积金信息</code></legend>
            <table width="100%">
                <tr height="40px">
                    <td>公积金启用日期</td>
                    <td>{if $HFBeginDay=="0000-00-00"}{else}{$HFBeginDay}{/if}</td>
                    <td>公积金修改日期</td>
                    <td>{if $HFModifyDate=="0000-00-00"}{else}{$HFModifyDate}{/if}</td>
                    <td>公积金缴交月数</td>
                    <td>{$HFNeedMonthNum}个月</td>
                    <td>个人公积金号 </td>
                    <td>{$HFID}</td>
                    <td>基数</td>
                    <td>{$HFRadix}</td>
                    <td>单位比例　　　</td>
                    <td>{$uHFPer}</td>
                    <td>个人比例　　　</td>
                    <td>{$pHFPer}</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <table width="100%">
                <tr height="40px">
                    <td><strong>备　　注</strong></td>
                    <td><textarea name= "remarks" class="halfWidth" rows="5">{$remarks}</textarea></td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend><code>历史修改信息</code></legend>
            {if $hisRet}
                <table class="myTable">
                    <tr>
                        <th>操作人</th>
                        <th>操作时间</th>
                        <th>修改备注</th>
                        <th>查看详情</th>
                    </tr>
                    {foreach from=$hisRet item=val}
                        <tr>
                            <td>
                                {$sysUserArr[$val.lastModifyBy]['mName']}
                            </td>
                            <td>
                                {$val.lastModifyTime}
                            </td>
                            <td> {$val.modifyRemarks|truncate:70:"......等":true}</td>
                            <td><a href="personalHistoryInfo.php?fID={$val.fID}&lastModifyTime={$val.lastModifyTime}">查看详情</a></td>
                        </tr>
                    {/foreach}
                </table>
            {/if}
        </fieldset>
    </fieldset>
</div>
{include file="footer.tpl"}