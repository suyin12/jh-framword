{include file="web/w/noNavHeader.tpl"}
<script type="text/javascript" src={$webHttpPath}theme/lib/js/general.js></script>
<script type="text/javascript" src={$webHttpPath}theme/lib/js/validation/jquery.validationEngine.js></script>
<script type="text/javascript" src={$webHttpPath}theme/lib/js/validation/jquery.validationEngine-zh_CN.js></script>
<script type="text/javascript" src={$webHttpPath}theme/lib/js/select.js></script>

{literal}
    <script type="text/javascript">
        $(document).ready(function () {

            //切换不同的页面
            $(".ideal-tabs-tab").each(function (i) {
                $(this).click(function () {
                    if ($(this).attr("alt") == "s6") {
                        $("#btnNext").css({"display": "none"});
                    } else {
                        $("#btnNext").css({"display": "block"});
                    }
                    $(".ideal-tabs-tab").removeClass("ideal-tabs-tab-active");
                    $(this).addClass("ideal-tabs-tab-active");
                    var activeSection = $(this).attr("alt");
                    $("section").css({"display": "none"});
                    $("#" + activeSection).css({"display": "block"});
                });
            });
            //内部推荐选择
            $(':radio[name^=entryWay]').each(function () {
                if ($(":radio[name^=entryWay]:checked").val() == "0") {
                    $("#i2").find("input[type='text']").removeAttr("disabled").css("display", "block");
                    return false;
                } else {
                    $("#i2").find("input[type='text']").attr("disabled", true).css("display", "none");
                }
            });

            $(':radio[name^=entryWay]').each(function () {
                $(this).click(function () {
                    if ($(this).is(':checked') && $(this).val() == "0") {
                        $("#i2").find("input[type='text']").removeAttr("disabled").css("display", "block");
                    } else {
                        $("#i2").find("input[type='text']").attr("disabled", true).css("display", "none");
                    }
                });
            });

            //按钮
            $("#btnNext").click(function () {
                var a = $("li.ideal-tabs-tab-active");
                var f = a.attr("alt") + "_form";
                var status = $("#" + f).validationEngine('validate');
                if (status) {
                    a.removeClass("ideal-tabs-tab-active");
                    a.next().addClass("ideal-tabs-tab-active");
                    var nextSID = a.next().attr("alt");
                    var currentSection = a.attr("alt");
                    $("section").css({"display": "none"});
                    $("#" + nextSID).css({"display": "block"});
                    if (a.attr("alt") == "s5") {
                        $("#btnNext").css({"display": "none"});
                    }
                }
            });
            //错误提示框显示位置
            $.validationEngine.defaults.promptPosition="centerRight";
            //判断是否已婚
            var ms= $("#marriage").val();
            if(ms=="2")
            {
                $("#spousePID").addClass("validate[required]");
                $("#spouseName").addClass("validate[required]");
            } else
            {
                $("#spousePID").removeClass("validate[required]");
                $("#spouseName").removeClass("validate[required]");
            }
            $("#marriage").change(function(){
                var ms= $("#marriage").val();
                if(ms=="2")
                {
                    $("#spousePID").addClass("validate[required]");
                    $("#spouseName").addClass("validate[required]");
                }
                else
                {
                    $("#spousePID").removeClass("validate[required]");
                    $("#spouseName").removeClass("validate[required]");
                }
            })

            //调用
            $('select').idealSelect();
            idealBlur("input[type=text]", "blur");
            idealBlur("select", "change");
            idealBlur(":checkbox", "click");
            idealBlur(":radio","click");
            idealBlur("textarea", "blur");
            //自动提交数据
            function idealBlur(action, actionType) {
                //表格输入验证
                $("form").validationEngine();
                $(action).bind(actionType, function () {
                    var btnName = 'wInput';
                    var wID = $("input[name=wID]").val();
                    var talentID = $("input[name=talent]").val();
                    var thisAction = $(this);
                    var wDataName = $(this).attr("name");
                    var wDataVal = $(this).attr("alt");
                    var wDataValue = $(this).val();
                    var t, u, d, dt, m;
                    t = "post";
                    u = "web_wSql.php";
                    d = "&btn=" + btnName + "&dataName=" + wDataName + "&dataValue=" + wDataValue + "&wID=" + wID + "&talentID=" + talentID + "&kID=" + wDataVal;
                    dt = "json";
                    m = function (json) {
                        var i, n, k, v;
                        $.each(json, function (i, n) {
                            switch (i) {
                                case "error":
                                    alert(n);
                                    break;
                                case "succ":
                                    thisAction.css({background:"#edf7fc",color:"#1a719d",border:"1px solid #3ea9df"});
                                    break;
                            }
                        });
                    };
                    ajaxAction(t, u, d, dt, m);
                });

            }

        });
    </script>
{/literal}
<div id="main">
<div class="ym-wrapper">
<div class="ym-wbox">
<fieldset class="ideal-form">
    <input type="hidden" name="wID" value="{$wID}"/>
    <input type="hidden" name="talent" value="{$talent.talentID}"/>

    <div class="ideal-wrap ideal-tabs ideal-full-width">
        <ul class="ideal-tabs-wrap">
            <li class="ideal-tabs-color ideal-tabs-tab ideal-tabs-tab-active" alt="s1"><span>基本信息(必填)</span></li>
            <li class="ideal-tabs-tab ideal-tabs-color " alt="s2"><span>家庭情况(必填)</span></li>
            <li class="ideal-tabs-tab ideal-tabs-color " alt="s3"><span>个人简历(必填)</span></li>
            <li class="ideal-tabs-tab ideal-tabs-color" alt="s4"><span>入职方式(必填)</span></li>
            <li class="ideal-tabs-tab" alt="s5"><span>详细信息</span></li>
            <li class="ideal-tabs-tab" alt="s6"><span>职业培训经历</span></li>
        </ul>
    </div>
</fieldset>
<form class="ideal-form" id="s1_form">
    <section name="基本信息" id="s1">
        <h2>基本信息</h2>
        <table id="basicInfo" class="myTable">
            <tr>
                <td>
                    姓 名:
                </td>
                <td>
                    <input type="text" class="validate[required]" name="name" value="{$talent.name}"/>
                </td>
                <td>
                    性 别:
                </td>
                <td>
                    <select name="sex">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.sex  selected={$wInfo.sex} }
                    </select>
                </td>
            </tr>
            <tr>
                <td>身份证号码:</td>
                <td>
                {$talent.pID}
                </td>
                <td> 出生日期:</td>
                <td><input type="text" class="validate[required,custom[date]]" name="birthday" value="{$wInfo.birthday}"
                           placeholder="1986-10-01"/></td>
            </tr>
            <tr>
                <td>文化程度:</td>
                <td><select name="education">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.education selected={$wInfo.education}}
                    </select></td>
                <td>婚 否:</td>
                <td><select name="marriage">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.marriage selected={$wInfo.marriage}}
                    </select></td>
            </tr>
            <tr>
                <td>配偶姓名:</td>
                <td><input type="text" name="spouseName" value="{$wInfo.spouseName}"/></td>
                <td>配偶身份证号码:</td>
                <td><input type="text" name="spousePID" value="{$wInfo.spousePID}"/></td>

            </tr>
            <tr>
                <td>籍 贯:</td>
                <td><input class="validate[required] " type="text" name="nativePlace"
                           value="{$wInfo.nativePlace}" placeholder="xx省xx市(县)"/></td>
                <td>出生地:</td>
                <td><input type="text" name="birthPlace" value="{$wInfo.birthPlace}"/></td>

            </tr>
            <tr>
                <td>户口所在地:</td>
                <td><input class="validate[required] " type="text" name="domicilePlace"
                           value="{$wInfo.domicilePlace}"/> </td>
                <td>户口类型:</td>
                <td>
                    <select name="nativeType">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.nativeType selected="{$wInfo.nativeType}"}
                    </select>
                </td>
            </tr>
            <tr>
                <td>民 族:</td>
                <td><select name="nation">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.nation selected="{$wInfo.nation}" }
                    </select></td>
                <td>政治面貌:</td>
                <td><select name="role">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.role selected={$wInfo.role}}
                    </select></td>

            </tr>
            <tr>
                <td>家庭固定电话:</td>
                <td><input type="text" name="homePhone" value="{$wInfo.homePhone}" placeholder="0755-12345678"/></td>
                <td>联系电话(本人):</td>
                <td><input type="text" class="validate[required,custom[integer],maxSize[11],minSize[11]]"
                           name="telephone" value="{$talent.telephone}"/></td>

            </tr>
            <tr>
                <td>详细家庭地址:</td>
                <td>
                    <input class="validate[required] " type="text" name="homeAddress"
                           value="{$wInfo.homeAddress}"/>
                </td>
                <td>原工作单位:</td>
                <td><input type="text" name="lastUnit" value="{$wInfo.lastUnit}"/></td>

            </tr>
            <tr>
                <td>联络人(亲属):</td>
                <td>
                    <input type="text" class="validate[required]" name="contact" value="{$wInfo.contact}"/>
                </td>
                <td>联络人通信地址:</td>
                <td>
                    <input type="text" name="contactAddress" value="{$wInfo.contactAddress}"/></td>

            </tr>
            <tr>
                <td>联络人固定电话:</td>
                <td>
                    <input type="text" name="cHomePhone" value="{$wInfo.cHomePhone}" placeholder="0755-12345678"/></td>
                <td>联络人手机:</td>
                <td>
                    <input type="text" class="validate[required]" name="contactPhone"
                           value="{$wInfo.contactPhone}"/></td>


            </tr>
            <tr>
                <td>与联络人关系</td>
                <td><input type="text" name="cRelation"
                           value="{$wInfo.cRelation}"/></td>
                <td>紧急联系电话:</td>
                <td>
                    <input class="validate[required] " type="text" name="emergency"
                           value="{$wInfo.emergency}"/>
                </td>

            </tr>
        </table>
    </section>
</form>
<form class="ideal-form" id="s2_form">
    <section name="家庭情况" id="s2" style="display: none">
        <h2>家庭情况:</h2>
        <table class='myTable'>
            <thead class="tabletd">
            <tr>
                <th>姓 名</th>
                <th>性 别</th>
                <th>出生日期</th>
                <th>工作单位</th>
                <th>职 务</th>
                <th>联系电话:</th>
                <th>联系地址:</th>
                <th>户口所在地:</th>
                <th>与本人关系:</th>
            </tr>

            </thead>
            <tbody class="tabletd">
            {if $wInfo.relative}
                {foreach from=$wInfo.relative item=val key=key name=f_foo}
                    <tr>
                        <td><input type="text" name="f_name[]" class="validate[required] " alt="{$key}"
                                   value="{$val.name}"/></td>
                        <td><select name="f_sex[]" alt="{$key}">
                                {html_options options=$wInfoSet.othersex selected="{$val.sex}"}
                            </select></td>
                        <td><input type="text" name="f_birthday[]" class="validate[required,custom[date]]" alt="{$key}" value="{$val.birthday}"
                                   placeholder="1984-01-01"/></td>
                        <td><input type="text" name="f_workUnit[]" alt="{$key}" value="{$val.workUnit}"/></td>
                        <td><input type="text" name="f_job[]" alt="{$key}" value="{$val.job}"/></td>
                        <td><input type="text" name="f_phone[]" class="validate[required,custom[integer],maxSize[11],minSize[11]]" alt="{$key}"
                                   value="{$val.phone}"/></td>
                        <td><input type="text" name="f_address[]" alt="{$key}" value="{$val.address}"/></td>
                        <td><input type="text" name="f_domicilePlace[]" alt="{$key}" value="{$val.domicilePlace}"/></td>
                        <td><input type="text" name="f_relation[]" class="validate[required]" alt="{$key}"
                                   value="{$val.relation}"/></td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td><input type="text" class="validate[required]" name="f_name[]" alt="f_sp1" value=""/>
                    </td>
                    <td><select name="f_sex[]" alt="f_sp1">
                            <option value="">--请选择--</option>
                            {html_options options=$wInfoSet.othersex selected=""}
                        </select></td>
                    <td><input type="text" name="f_birthday[]" class="validate[required,custom[date]]" alt="f_sp1" value="" placeholder="1984-01-01"/></td>
                    <td><input type="text" name="f_workUnit[]" alt="f_sp1" value=""/></td>
                    <td><input type="text" name="f_job[]" alt="f_sp1" value=""/></td>
                    <td><input type="text" name="f_phone[]" class="validate[required,custom[integer],maxSize[11],minSize[11]]" alt="f_sp1" value=""/>
                    </td>
                    <td><input type="text" name="f_address[]" alt="f_sp1" value=""/></td>
                    <td><input type="text" name="f_domicilePlace[]" alt="f_sp1" value=""/></td>
                    <td><input type="text" name="f_relation[]" class="validate[required] " alt="f_sp1"
                               value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" class="validate[required]" name="f_name[]" alt="f_sp2" value=""/>
                    </td>
                    <td><select name="f_sex[]" alt="f_sp2">
                            <option value="">--请选择--</option>
                            {html_options options=$wInfoSet.othersex selected=""}
                        </select></td>
                    <td><input type="text" name="f_birthday[]" class="validate[required,custom[date]]" alt="f_sp2" value="" placeholder="1984-01-01"/></td>
                    <td><input type="text" name="f_workUnit[]" alt="f_sp2" value=""/></td>
                    <td><input type="text" name="f_job[]" alt="f_sp2" value=""/></td>
                    <td><input type="text" name="f_phone[]" class="validate[required,custom[integer],maxSize[11],minSize[11]]" alt="f_sp2" value=""/>
                    </td>
                    <td><input type="text" name="f_address[]" alt="f_sp2" value=""/></td>
                    <td><input type="text" name="f_domicilePlace[]" alt="f_sp2" value=""/></td>
                    <td><input type="text" name="f_relation[]" class="validate[required] " alt="f_sp2"
                               value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" class="validate[required] " name="f_name[]" alt="f_sp3" value=""/>
                    </td>
                    <td><select name="f_sex[]" alt="f_sp3">
                            <option value="">--请选择--</option>
                            {html_options options=$wInfoSet.othersex selected=""}
                        </select></td>
                    <td><input type="text" name="f_birthday[]" class="validate[required,custom[date]]" alt="f_sp3" value="" placeholder="1984-01-01"/></td>
                    <td><input type="text" name="f_workUnit[]" alt="f_sp3" value=""/></td>
                    <td><input type="text" name="f_job[]" alt="f_sp3" value=""/></td>
                    <td><input type="text" name="f_phone[]" class="validate[required,custom[integer],maxSize[11],minSize[11]]" alt="f_sp3" value=""/>
                    </td>
                    <td><input type="text" name="f_address[]" alt="f_sp3" value=""/></td>
                    <td><input type="text" name="f_domicilePlace[]" alt="f_sp3" value=""/></td>
                    <td><input type="text" name="f_relation[]" class="validate[required] " alt="f_sp3"
                               value=""/></td>
                </tr>
            {/if}
            <tr>
                <td><input type="text" name="f_name[]" alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/></td>
                <td><select name="f_sex[]" alt="f_sp{$smarty.foreach.f_foo.index+4}">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.othersex selected=""}
                    </select></td>
                <td><input type="text" name="f_birthday[]"  alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""
                           placeholder="1984-01-01"/></td>
                <td><input type="text" name="f_workUnit[]" alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/></td>
                <td><input type="text" name="f_job[]" alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/></td>
                <td><input type="text" name="f_phone[]"  alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/></td>
                <td><input type="text" name="f_address[]" alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/></td>
                <td><input type="text" name="f_domicilePlace[]" alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/>
                </td>
                <td><input type="text" name="f_relation[]" alt="f_sp{$smarty.foreach.f_foo.index+4}" value=""/></td>
            </tr>
            </tbody>
        </table>
    </section>
</form>
<form class="ideal-form" id="s3_form">
    <section name="个人简历" id="s3" style="display: none">
        <h2>个人工作简历</h2>
        <table class="myTable">
            <thead class="tabletd">
            <tr>
                <th>起止时间</th>
                <th>行业类型</th>
                <th>工作单位</th>
                <th>担任职位</th>
                <th>离职原因:</th>
                <th>证明人:</th>
                <th>证明人电话:</th>
                <th>是否海外:</th>

            </tr>
            </thead>
            <tbody class="tabletd">
            {if $wInfo.workInfo}
                {foreach from=$wInfo.workInfo item=val key=key name=o_foo}
                    <tr>
                        <td class="tdtext"><input type="text" name="o_BETime[]" alt="{$key}" value="{$val.BETime}"
                                                  placeholder="1990/01/01-2000/01/01"/></td>
                        <td><input type="text" name="o_jobType[]" alt="{$key}" value="{$val.jobType}"/></td>
                        <td><input type="text" name="o_workUnit[]" class="validate[required] " alt="{$key}"
                                   value="{$val.workUnit}"/></td>
                        <td><input type="text" name="o_job[]" class="validate[required] " alt="{$key}"
                                   value="{$val.job}"/></td>
                        <td><textarea name="o_leaveReason[]" alt="{$key}">{$val.leaveReason}</textarea></td>
                        <td><input type="text" name="o_reterence[]" alt="{$key}" value="{$val.reterence}"/></td>
                        <td><input type="text" name="o_phone[]" alt="{$key}" value="{$val.phone}"/></td>
                        <td>
                            {html_checkboxes  name="o_overSeas" alt="{$key}" options=$wInfoSet.oversSeas selected="{$val.overSeas}" }
                        </td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td class="tdtext"><input class="dateleft" type="text" alt="o_sp1" name="o_BETime[]"
                                              placeholder="1990/01/01-2000/01/01" value=""/></td>
                    <td><input type="text" name="o_jobType[]" alt="o_sp1" value=""/></td>
                    <td><input type="text" name="o_workUnit[]" class="validate[required]" alt="o_sp1"
                               value=""/></td>
                    <td><input type="text" name="o_job[]" class="validate[required] " alt="o_sp1" value=""/>
                    </td>
                    <td><textarea name="o_leaveReason[]" alt="o_sp1"></textarea></td>
                    <td><input type="text" name="o_reterence[]" class="validate[required]" alt="o_sp1"
                               value=""/></td>
                    <td><input type="text" name="o_phone[]" alt="o_sp1" value=""/></td>
                    <td>
                        {html_checkboxes  name="o_oversSeas" alt="o_sp1" options=$wInfoSet.oversSeas selected="0" }
                    </td>

                </tr>
                <tr>
                    <td class="tdtext"><input class="dateleft" type="text" name="o_BETime[]" alt="o_sp2"
                                              placeholder="1990/01/01-2000/01/01" value=""/></td>
                    <td><input type="text" name="o_jobType[]" alt="o_sp2" value=""/></td>
                    <td><input type="text" name="o_workUnit[]"  alt="o_sp2"
                               value=""/></td>
                    <td><input type="text" name="o_job[]"  alt="o_sp2" value=""/>
                    </td>
                    <td><textarea name="o_leaveReason[]" alt="o_sp2"></textarea></td>
                    <td><input type="text" name="o_reterence[]"  alt="o_sp2"
                               value=""/></td>
                    <td><input type="text" name="o_phone[]" alt="o_sp2" value=""/></td>
                    <td>
                        {html_checkboxes  name="o_oversSeas" alt="o_sp2" options=$wInfoSet.oversSeas selected="0" }
                    </td>

                </tr>
                <tr>
                    <td class="tdtext"><input class="dateleft" type="text" name="o_BETime[]" alt="o_sp3"
                                              placeholder="1990/01/01-2000/01/01" value=""/></td>
                    <td><input type="text" name="o_jobType[]" alt="o_sp3" value=""/></td>
                    <td><input type="text" name="o_workUnit[]"  alt="o_sp3"
                               value=""/></td>
                    <td><input type="text" name="o_job[]"  alt="o_sp3" value=""/>
                    </td>
                    <td><textarea name="o_leaveReason[]" alt="o_sp3"></textarea></td>
                    <td><input type="text" name="o_reterence[]" alt="o_sp3" value=""/></td>
                    <td><input type="text" name="o_phone[]" alt="o_sp3" value=""/></td>
                    <td>
                        {html_checkboxes  name="o_oversSeas" alt="o_sp3" options=$wInfoSet.oversSeas selected="0" }
                    </td>

                </tr>
            {/if}
            <tr>
                <td class="tdtext"><input class="dateleft" type="text" name="o_BETime[]"
                                          placeholder="1990/01/01-2000/01/01" alt="o_sp{$smarty.foreach.o_foo.index+4}"
                                          value=""/></td>
                <td><input type="text" name="o_jobType[]" alt="o_sp{$smarty.foreach.o_foo.index+4}" value=""/></td>
                <td><input type="text" name="o_workUnit[]" alt="o_sp{$smarty.foreach.o_foo.index+4}" value=""/></td>
                <td><input type="text" name="o_job[]" alt="o_sp{$smarty.foreach.o_foo.index+4}" value=""/></td>
                <td><textarea name="o_leaveReason[]" alt="o_sp{$smarty.foreach.o_foo.index+4}"></textarea></td>
                <td><input type="text" name="o_reterence[]" alt="o_sp{$smarty.foreach.o_foo.index+4}" value=""/></td>
                <td><input type="text" name="o_phone[]" alt="o_sp{$smarty.foreach.o_foo.index+4}" value=""/></td>
                <td>
                    {html_checkboxes  name="o_oversSeas" alt="o_sp{$smarty.foreach.o_foo.index+4}" options=$wInfoSet.oversSeas selected="0" }
                </td>

            </tr>
            </tbody>
        </table>
        <h2>学习经历</h2>(按学历高低由高至低填写)
        <table class="myTable">
            <thead class="tabletd">
            <tr>
                <th>起止时间</th>
                <th>毕业院校:</th>
                <th>专 业:</th>
                <th>学 历:</th>
                <th>学 位:</th>
                <th>证书编号:</th>
                <th>学习方式:</th>
                <th>是否海外:</th>
            </tr>
            </thead>
            <tbody class="tabletd">
            {if $wInfo.studyInfo}
                {foreach from=$wInfo.studyInfo item=val key=key name="s_foo"}
                    <tr>
                        <td class="tdtext"><input type="text" name="s_BETime[]" placeholder="1990/01/01-2000/01/01"
                                                  alt="{$key}" value="{$val.BETime}"/></td>
                        <td><input type="text" name="s_graduate[]" alt="{$key}" value="{$val.graduate}"/></td>
                        <td><input type="text" name="s_major[]" alt="{$key}" value="{$val.major}"/></td>
                        <td><input type="text" name="s_education[]" alt="{$key}" value="{$val.education}"/></td>
                        <td><input type="text" name="s_degree[]" alt="{$key}" value="{$val.degree}"/></td>
                        <td><input type="text" name="s_diplomaNumber[]" alt="{$key}" value="{$val.diplomaNumber}"/></td>
                        <td><input type="text" name="s_studyWay[]" alt="{$key}" value="{$val.studyWay}"/></td>
                        <td> {html_checkboxes  name="s_overSeas" alt="{$key}" options=$wInfoSet.oversSeas selected="{$val.overSeas}" }</td>

                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td class="tdtext"><input type="text" name="s_BETime[]" placeholder="1990/01/01-2000/01/01"
                                              alt="s_sp1" value=""/></td>
                    <td><input type="text" name="s_graduate[]" alt="s_sp1" value=""/></td>
                    <td><input type="text" name="s_major[]" alt="s_sp1" value=""/></td>
                    <td><input type="text" name="s_education[]" alt="s_sp1" value=""/></td>
                    <td><input type="text" name="s_degree[]" alt="s_sp1" value=""/></td>
                    <td><input type="text" name="s_diplomaNumber[]" alt="s_sp1" value=""/></td>
                    <td><input type="text" name="s_studyWay[]" alt="s_sp1" value=""/></td>
                    <td>{html_checkboxes  name="s_oversSeas" alt="s_sp1" options=$wInfoSet.oversSeas selected=0}</td>
                </tr>
                <tr>
                    <td class="tdtext"><input type="text" name="s_BETime[]" placeholder="1990/01/01-2000/01/01"
                                              alt="s_sp2" value=""/></td>
                    <td><input type="text" name="s_graduate[]" alt="s_sp2" value=""/></td>
                    <td><input type="text" name="s_major[]" alt="s_sp2" value=""/></td>
                    <td><input type="text" name="s_education[]" alt="s_sp2" value=""/></td>
                    <td><input type="text" name="s_degree[]" alt="s_sp2" value=""/></td>
                    <td><input type="text" name="s_diplomaNumber[]" alt="s_sp2" value=""/></td>
                    <td><input type="text" name="s_studyWay[]" alt="s_sp2" value=""/></td>
                    <td>{html_checkboxes  name="s_oversSeas" alt="s_sp2" options=$wInfoSet.oversSeas selected=0}</td>
                </tr>
                <tr>
                    <td class="tdtext"><input type="text" name="s_BETime[]" placeholder="1990/01/01-2000/01/01"
                                              alt="s_sp3" value=""/></td>
                    <td><input type="text" name="s_graduate[]" alt="s_sp3" value=""/></td>
                    <td><input type="text" name="s_major[]" alt="s_sp3" value=""/></td>
                    <td><input type="text" name="s_education[]" alt="s_sp3" value=""/></td>
                    <td><input type="text" name="s_degree[]" alt="s_sp3" value=""/></td>
                    <td><input type="text" name="s_diplomaNumber[]" alt="s_sp3" value=""/></td>
                    <td><input type="text" name="s_studyWay[]" alt="s_sp3" value=""/></td>
                    <td>{html_checkboxes  name="s_oversSeas" alt="s_sp3" options=$wInfoSet.oversSeas selected=0}</td>
                </tr>
            {/if}
            <tr>
                <td class="tdtext"><input type="text" name="s_BETime[]" placeholder="1990/01/01-2000/01/01"
                                          alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/></td>
                <td><input type="text" name="s_graduate[]" alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/></td>
                <td><input type="text" name="s_major[]" alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/></td>
                <td><input type="text" name="s_education[]" alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/></td>
                <td><input type="text" name="s_degree[]" alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/></td>
                <td><input type="text" name="s_diplomaNumber[]" alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/>
                </td>
                <td><input type="text" name="s_studyWay[]" alt="s_sp{$smarty.foreach.s_foo.index+4}" value=""/></td>
                <td>{html_checkboxes  name="s_oversSeas" alt="s_sp{$smarty.foreach.s_foo.index+4}" options=$wInfoSet.oversSeas selected=0}</td>

            </tr>
            </tbody>
        </table>
    </section>
</form>
<form class="ideal-form" id="s4_form">
    <section name="入职方式" id="s4" style="display: none">
        <h2>入职方式</h2>
        <table class="myTable" id="i1">
            <tr>
                <td colspan="2">
               <span class="ideal-field ideal-radiocheck">
                 {html_radios name="entryWay" class="validate[required]" options=$wInfoSet.entryWay  checked="{$wInfo.entryWay}"}
               </span>
                </td>
            </tr>
        </table>
        <table class="myTable" id="i2">
            <tr>
                <td colspan="2"><h4>若为内部推荐,请按如下要求进行填写:</h4></td>
            </tr>
            <tr>
                <td>介绍人姓名:</td>
                <td>
                    <div>
                        <input class="validate[required] " type="text" name="iName" value="{$wInfo.iName}"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td>介绍人工号:</td>
                <td><input type="text" name="iNumber" value="{$wInfo.iNumber}"/></td>
            </tr>
            <tr>
                <td>介绍人所属地区:</td>
                <td><input type="text" name="iLocal" value="{$wInfo.iLocal}"/></td>
            </tr>
            <tr>
                <td>所在部门:</td>
                <td><input type="text" name="iDepartment" value="{$wInfo.iDepartment}"/></td>
            </tr>
            <tr>
                <td>介绍人职位:</td>
                <td><input type="text" name="iJob" value="{$wInfo.iJob}"/></td>
            </tr>
            <tr>
                <td>介绍人性别:</td>
                <td><input type="text" name="iSex" value="{$wInfo.iSex}"/> </td>
            </tr>
            <tr>
                <td>介绍人电话:</td>
                <td><input class="validate[required,custom[integer],maxSize[11],minSize[11]]" type="text" name="iPhone"
                           value="{$wInfo.iPhone}"/></td>
            </tr>
            <tr>
                <td>与介绍人关系:</td>
                <td>
                    <div>
                        <input class="validate[required] " type="text" name="iRelation"
                               value="{$wInfo.iRelation}"/>
                    </div>
                </td>
            </tr>
        </table>
    </section>
</form>
<form class="ideal-form" id="s5_form">
    <section name="详细信息" id="s5" style="display: none">
        <h2>详细信息</h2>
        <table class="myTable">
            <tr>
                <td>曾用名:</td>
                <td><input type="text" name="everName" value="{$wInfo.everName}"/></td>
                <td>英文名:</td>
                <td><input type="text" name="englishName" value="{$wInfo.englishName}"/></td>
            </tr>
<tr>
    <td>QQ</td>
    <td><input type="text" name="QQ" value="{$wInfo.QQ}"/></td>
    <td>邮箱:</td>
    <td><input type="text" class="validate[custom[email]]" name="Email" value="{$wInfo.Email}"/></td>
</tr>
            <tr>
                <td>微博网址:</td>
                <td><input type="text" name="Twitter" placeholder="http://" value="{$wInfo.Twitter}"/></td>
                <td>职称/职业资格证</td>
                <td><input type="text" name="wCertificate" value="{$wInfo.wCertificate}"/></td>
            </tr>

            <tr>
                 <td>技术等级:</td>
                <td><select name="proLevel">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.proLevel selected={$wInfo.proLevel}}
                    </select></td>
                <td>身 高:</td>
                <td><input type="text" name="height" placeholder="xxxcm" value="{$wInfo.height}"/></td>
            </tr>
            <tr>
                <td>健康状况:</td>
                <td><select name="health">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.health selected={$wInfo.health}}
                    </select></td>
                <td>体 重:</td>
                <td><input type="text" name="weight" placeholder="xxkg" value="{$wInfo.weight}"/></td>
            </tr>
            <tr>

                <td>血 型:</td>
                <td><select name="blood">
                        <option value="">--请选择--</option>
                        {html_options options=$wInfoSet.blood selected={$wInfo.blood}}
                    </select></td>
                <td>现居住地址</td>
                <td><input type="text" name="workAddress" value="{$wInfo.workAddress}"/></td>
            </tr>
            <tr>
                <td>其他证件号:</td>
                <td>
               <span class=".ideal-select-title:before">
                   <select name="otherStatus">
                       <option value="default">--请选择--</option>
                       {html_options options=$wInfoSet.otherStatus selected="{$wInfo.otherStatus}"}
                   </select></span>
                </td>
                <td>证件号码:</td>
                <td><input type="text" name="oID" value="{$wInfo.oID}"/></td>
            </tr>


            <tr>
                <td>社保卡号:</td>
                <td>
                    <div>
                        <label name="sID"></label>
                    </div>
                </td>
                <td>开户银行:</td>
                <td>

                    <label name="bank"></label>

                </td>
            </tr>

            <tr>
                <td>银行账号:</td>
                <td>

                    <label name="bID"></label>

                </td>
                <td>驾照类型:</td>
                <td><input type="text" name="driveType" value="{$wInfo.driveType}"/></td>

            </tr>
            <tr>
                <td>驾照有效周期:</td>
                <td><input type="text" name="driveValid" value="{$wInfo.driveValid}"/></td>

                <td>第一次参加工作时间:</td>
                <td><input type="text" name="workTime" value="{$wInfo.workTime}"/></td>
            </tr>
            <tr>
                <td>特长:</td>
                <td><input type="text" name="strongPoint" value="{$wInfo.strongPoint}"/></td>

                <td>爱好:</td>
                <td><input type="text" name="hobby" value="{$wInfo.hobby}"/></td>
            </tr>

        </table>
    </section>
</form>
<form class="ideal-form" id="s6_form">
    <section name="职业培训经历" id="s6" style="display: none">
        <h2>职业培训经历</h2>
        <table class="myTable">
            <thead class="tabletd">
            <tr>
                <th>起止时间</th>
                <th>参加培训课程</th>
                <th>培训课时</th>
                <th>培训主办机构</th>
                <th>获得证书</th>
            </tr>
            </thead>
            <tbody>
            {if $wInfo.trainInfo}
                {foreach from=$wInfo.trainInfo item=val key=key name="t_foo"}
                    <tr>
                        <td><input type="text" name="t_BETime[]" alt="{$key}" placeholder="1990/01/01-2000/01/01"
                                   value="{$val.BETime}"/></td>
                        <td><input type="text" name="t_course[]" alt="{$key}" value="{$val.course}"/></td>
                        <td><input type="text" name="t_trainTime[]" alt="{$key}" value="{$val.trainTime}"/></td>
                        <td><input type="text" name="t_organization[]" alt="{$key}" value="{$val.organization}"/></td>
                        <td><input type="text" name="t_diploma[]" alt="{$key}" value="{$val.diploma}"/></td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td><input type="text" name="t_BETime[]" alt="t_sp1" placeholder="1990/01/01-2000/01/01" value=""/>
                    </td>
                    <td><input type="text" name="t_course[]" alt="t_sp1" value=""/></td>
                    <td><input type="text" name="t_trainTime[]" alt="t_sp1" value=""/></td>
                    <td><input type="text" name="t_organization[]" alt="t_sp1" value=""/></td>
                    <td><input type="text" name="t_diploma[]" alt="t_sp1" value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" name="t_BETime[]" placeholder="1990/01/01-2000/01/01" alt="t_sp2" value=""/>
                    </td>
                    <td><input type="text" name="t_course[]" alt="t_sp2" value=""/></td>
                    <td><input type="text" name="t_trainTime[]" alt="t_sp2" value=""/></td>
                    <td><input type="text" name="t_organization[]" alt="t_sp2" value=""/></td>
                    <td><input type="text" name="t_diploma[]" alt="t_sp2" value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" name="t_BETime[]" placeholder="1990/01/01-2000/01/01" alt="t_sp3" value=""/>
                    </td>
                    <td><input type="text" name="t_course[]" alt="t_sp3" value=""/></td>
                    <td><input type="text" name="t_trainTime[]" alt="t_sp3" value=""/></td>
                    <td><input type="text" name="t_organization[]" alt="t_sp3" value=""/></td>
                    <td><input type="text" name="t_diploma[]" alt="t_sp3" value=""/></td>
                </tr>
            {/if}
            <tr>
                <td><input type="text" name="t_BETime[]" placeholder="1990/01/01-2000/01/01"
                           alt="t_sp{$smarty.foreach.t_foo.index+4}" value=""/></td>
                <td><input type="text" name="t_course[]" alt="t_sp{$smarty.foreach.t_foo.index+4}" value=""/></td>
                <td><input type="text" name="t_trainTime[]" alt="t_sp{$smarty.foreach.t_foo.index+4}" value=""/></td>
                <td><input type="text" name="t_organization[]" alt="t_sp{$smarty.foreach.t_foo.index+4}" value=""/></td>
                <td><input type="text" name="t_diploma[]" alt="t_sp{$smarty.foreach.t_foo.index+4}" value=""/></td>
            </tr>
            </tbody>
        </table>
        <h2>取得证书:</h2>
        <table class="myTable">
            <thead class="tabletd">
            <tr>
                <th>有效日期范围</th>
                <th>证书名称</th>
                <th>级 别</th>
                <th>取得证书途径</th>
                <th>证书评定单位
                <th>
            </tr>
            </thead>
            <tbody>
            {if $wInfo.diploma}
                {foreach from=$wInfo.diploma item=val key=key name="d_foo"}
                    <tr>
                        <td><input type="text" name="d_BETime[]" placeholder="1990/01/01-2000/01/01" alt="{$key}"
                                   value="{$val.BETime}"/></td>
                        <td><input type="text" name="d_diploma[]" alt="{$key}" value="{$val.diploma}"/></td>
                        <td><input type="text" name="d_grade[]" alt="{$key}" value="{$val.grade}"/></td>
                        <td><input type="text" name="d_getWay[]" alt="{$key}" value="{$val.getWay}"/></td>
                        <td><input type="text" name="d_judgeUnit[]" alt="{$key}" value="{$val.judgeUnit}"/></td>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td><input type="text" name="d_BETime[]" placeholder="1990/01/01-2000/01/01" alt="d_sp1" value=""/>
                    </td>
                    <td><input type="text" name="d_diploma[]" alt="d_sp1" value=""/></td>
                    <td><input type="text" name="d_grade[]" alt="d_sp1" value=""/></td>
                    <td><input type="text" name="d_getWay[]" alt="d_sp1" value=""/></td>
                    <td><input type="text" name="d_judgeUnit[]" alt="d_sp1" value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" name="d_BETime[]" placeholder="1990/01/01-2000/01/01" alt="d_sp2" value=""/>
                    </td>
                    <td><input type="text" name="d_diploma[]" alt="d_sp2" value=""/></td>
                    <td><input type="text" name="d_grade[]" alt="d_sp2" value=""/></td>
                    <td><input type="text" name="d_getWay[]" alt="d_sp2" value=""/></td>
                    <td><input type="text" name="d_judgeUnit[]" alt="d_sp2" value=""/></td>
                </tr>
                <tr>
                    <td><input type="text" name="d_BETime[]" placeholder="1990/01/01-2000/01/01" alt="d_sp3" value=""/>
                    </td>
                    <td><input type="text" name="d_diploma[]" alt="d_sp3" value=""/></td>
                    <td><input type="text" name="d_grade[]" alt="d_sp3" value=""/></td>
                    <td><input type="text" name="d_getWay[]" alt="d_sp3" value=""/></td>
                    <td><input type="text" name="d_judgeUnit[]" alt="d_sp3" value=""/></td>
                </tr>
            {/if}
            <tr>
                <td><input type="text" name="d_BETime[]" placeholder="1990/01/01-2000/01/01"
                           alt="d_sp{$smarty.foreach.d_foo.index+4}" value=""/></td>
                <td><input type="text" name="d_diploma[]" alt="d_sp{$smarty.foreach.d_foo.index+4}" value=""/></td>
                <td><input type="text" name="d_grade[]" alt="d_sp{$smarty.foreach.d_foo.index+4}" value=""/></td>
                <td><input type="text" name="d_getWay[]" alt="d_sp{$smarty.foreach.d_foo.index+4}" value=""/></td>
                <td><input type="text" name="d_judgeUnit[]" alt="d_sp{$smarty.foreach.d_foo.index+4}" value=""/></td>
            </tr>
            </tbody>
        </table>
        <h2> 掌握外语:</h2>
        <table class="myTable">
            <thead class="tabletd">
            <th>掌握语种</th>
            <th>口语水平</th>
            <th>阅读水平</th>
            <th>写作水平</th>
            </thead>
            <tbody class="tabletd">
            {if $wInfo.language}
                {foreach from=$wInfo.language item=val key=key name="l_foo"}
                    <tr>
                        <td><input type="text" name="language[]" alt="{$key}" value="{$val.language}"/></td>
                        <td> <span class="ideal-field ideal-radiocheck">
                   {html_radios name="speakLevel[]" alt="{$key}" options=$wInfoSet.level checked="{$val.speakLevel}" }
               </span>
                        <td><span class="ideal-field ideal-radiocheck">
                   {html_radios  name="readLevel[]" alt="{$key}" options=$wInfoSet.level checked="{$val.readLevel}" }
               </span>

                        <td><span class="ideal-field ideal-radiocheck">
                   {html_radios  name="writeLevel[]" alt="{$key}" options=$wInfoSet.level checked="{$val.writeLevel}" }
               </span>
                    </tr>
                {/foreach}
            {else}
                <tr>
                    <td><input type="text" name="language[]" alt="l_sp1" value=""/></td>
                    <td> <span class="ideal-field ideal-radiocheck">
                   {html_radios alt="l_sp1" name="speakLevel[]" options=$wInfoSet.level checked="" }
               </span>
                    <td><span class="ideal-field ideal-radiocheck">
                   {html_radios alt="l_sp1" name="readLevel[]" options=$wInfoSet.level checked="" }
               </span>

                    <td><span class="ideal-field ideal-radiocheck">
                   {html_radios alt="l_sp1" name="writeLevel[]" options=$wInfoSet.level checked="" }
               </span>
                </tr>
            {/if}
            <tr>
                <td><input type="text" name="language[]" alt="l_sp{$smarty.foreach.l_foo.index+2}" value=""/></td>
                <td> <span class="ideal-field ideal-radiocheck">
                   {html_radios alt="l_sp{$smarty.foreach.l_foo.index+2}" name="speakLevel[]" options=$wInfoSet.level checked="" }
               </span>
                <td><span class="ideal-field ideal-radiocheck">
                   {html_radios alt="l_sp{$smarty.foreach.l_foo.index+2}" name="readLevel[]" options=$wInfoSet.level checked="" }
               </span>

                <td><span class="ideal-field ideal-radiocheck">
                   {html_radios alt="l_sp{$smarty.foreach.l_foo.index+2}" name="writeLevel[]" options=$wInfoSet.level checked="" }
               </span>
            </tr>
            </tbody>
        </table>
    </section>
</form>
<div>
    <button id="btnNext" class="ym-button ym-next">下一步</button>
</div>
</div>
</div>
</div>
{include file="footer.tpl"}