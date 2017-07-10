<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>个人信息打印</title>
    {literal}
        <style>
            body {
                width: 794px;
                _width: 649px;
                padding: 0;
                font-size: 11px;
                margin: 0 auto;
            }
            .fontStyle{
            font: normal bold 10pt arial;
            }
            p{
                _font-size: 11px;
            }
            h1,h2{
                font-size: 15px;
                _font-size: 16px;
                padding: 0;
                margin: 3px;
            }
            h3 {
                font-size: 11px;
                _font-size: 12px;
                padding: 0;
                margin: 10px;
                _margin: 5px;

            }
            .pageEver{
                height:1100px;
                _height:970px;

            }
            #text{
                width: 100%;
                height: 30%;
                overflow: hidden;
            }
            #first {
                text-align: center;
                border-collapse: collapse;
                border: none;
                height: 63%;
            }
            #first tr{
                height: 5%;
            }
            .second{
                text-align: center;
                border-collapse: collapse;
                border: none;

            }
            .second tr {
                height: 29px;
                _height:25px;
            }
            #main{
                width: 794px;
                _width: 649px;
                margin: 0 auto;
            }
            .clearfix{
                clear: both;
            }
        </style>
        <!--media=print 这个属性可以在打印时有效-->
        <style media=print>
            .Noprint{display:none;}
            .PageNext{page-break-after: always;}
        </style>
    {/literal}
</head>
<body>
<div id="main">
<div class="pageEver">
<div>
<span  style="float: left;"><img src="{$httpPath}theme/css/images/xjc.gif"/>鑫锦程人力</span>

<span style="float: right;">SF-HRZP-002-应聘入职信息登记表</span>
</div>
<div class="clearfix"></div>
<br/>
<div id="text">
<div style="width: 100%;text-align: center;">
<h1>应 聘 入 职 信 息 登 记 表</h1>
<h3>(基层员工专用)</h3>
</div>
  [  <b>人才编号:{$talent.talentID}</b>  ]
<h3>一、应聘意向职位:首选________;次选__________;</h3>
<h3>&nbsp;&nbsp;应聘意向工作地点: <input type="checkbox" disabled=true/> A:中国各城市; <input type="checkbox" disabled=true/>  B:仅限中国某些城市________;<input type="checkbox" disabled=true/>  C:仅限当地_________;</h3>
<h3> &nbsp;&nbsp;如果公司不能满足你的第一求职岗位，安排其他岗位是否接受？（是  <input type="checkbox" disabled=true/>    否  <input type="checkbox" disabled=true/> ）</h3>
<h3>二、本人承诺:在本表内所填资料属实,谨此授权顺丰速运(集团)有限公司或其委托的合法机构对以上所有信息查询确认。如 </h3>
<h3>任何一项情况失实,贵公司有权与本人解除劳动合同或采取其他处理方式。并承诺到贵公司报到前，已与原工作单位解除劳</h3>
<h3>动合同等关系，并不将原工作单位的任何商业秘密带到贵公司。如与原工作单位因原劳动合同或商业机密问题出现法律纠 </h3>
<h3>纷，本人愿意自己担一切责任。</h3>
<h3>本人已对上述内容进行了认真填写和阅读，明白其意义，完全出于自愿并能负责，谨此声明。</h3>
<h3 align="right" style="margin-right: 120px;"><b>本人签名/日期：</b></h3>
</div>
<b>表头由公司填写：工作地点：</b>________省________市/县
<b>工号：</b><b>________</b>
<b>所属组织：</b><b>____________</b><b>职位</b><b>___________</b>

<table width="100%" border="1" cellpadding="2" cellspacing="0" id="first">
<tr>
    <td width="10%" rowspan="2"><b>姓名</b></td>
    <td width="11%" rowspan="2">{$talent.name}</td>
    <td width="10%"><b>曾用名</b></td>
    <td width="11%" >{$wInfo.everName}</td>
    <td width="10%" rowspan="2"><b>性别</b></td>
    <td width="11%" rowspan="2">{html_checkboxes  name="sex"  options=$wInfoSet.sex  selected="{$talent.sex}" disabled=true separator="<br>"}</td>
    <td width="10%" rowspan="2"><b>籍贯</b></td>
    <td width="12%" rowspan="2">{$wInfo.nativePlace}</td>
    <td width="15%" rowspan="7"><p align="center"><strong>照　片 </strong></p>
        （粘贴）</td>
</tr>
<tr>
    <td><b>英文名</b></td>
    <td>{$wInfo.englishName}</td>
</tr>
<tr>
    <td><b>身份证号码</b></td>
    <td colspan="3">{$talent.pID}</td>
    <td><b>出生日期</b></td>
    <td>{$wInfo.birthday}</td>
    <td><b>健康状况</b></td>
    <td>{$wInfo.healthName}</td>
</tr>
<tr>
    <td><b>其他身份证件</b></td>
    <td colspan="4">{html_checkboxes  name="otherStatus"  options=$wInfoSet.otherStatus  selected="{$wInfo.otherStatus}" disabled=true }</td>
    <td><b>证件号码</b></td>
    <td colspan="2">{$wInfo.oID}</td>
</tr>
<tr>
    <td><b>身高</b></td>
    <td>{$wInfo.height}</td>
    <td><b>体重</b></td>
    <td>{$wInfo.weight}</td>
    <td><b>血型</b></td>
    <td>{$wInfo.bloodName}</td>
    <td><b>民族</b></td>
    <td>{$wInfo.nationName}</td>
</tr>
<tr>
    <td><b>婚姻状况</b></td>
    <td colspan="3">{$wInfo.marriageName}</td>
    <td><b>政治面貌</b></td>
    <td colspan="3">{$wInfo.roleName}</td>
</tr>
<tr>
    <td><b>户口类别</b></td>
    <td colspan="2">{html_checkboxes  name="nativeType"  options=$wInfoSet.nativeType  selected="{$wInfo.nativeType}" disabled=true }</td>
    <td><b>户口所在地</b></td>
    <td>{$wInfo.domicilePlace}</td>
    <td><b>参加工作时间</b></td>
    <td colspan="2">{$wInfo.workTime}</td>
</tr>
<tr>
    <td><b>社保卡号</b></td>
    <td colspan="2"></td>
    <td><b>驾驶执照类型</b></td>
    <td colspan="2">{$wInfo.driveType}</td>
    <td colspan="2"><b>驾驶证有效期</b></td>
    <td>{$wInfo.driveValid}</td>
</tr>
<tr>
    <td colspan="2">是否具备 ________银行账号</td>
    <td colspan="3"><input type="checkbox" disabled=true/> 是,开户银行:___________<input type="checkbox" disabled=true/> 否</td>
    <td colspan="2">____________银行账号</td>
    <td colspan="2"></td>
</tr>
<tr>
    <td rowspan="2"><b>语种</b></td>
    <td>{$wInfo.language[0].language}</td>
    <td rowspan="2"><b>口语水平</b></td>
    <td>{$wInfo.language[0].NspeakLevel}</td>
    <td rowspan="2"><b>阅读水平</b></td>
    <td>{$wInfo.language[0].NreadLevel}</td>
    <td colspan="2" rowspan="2"><b>写作水平</b></td>
    <td>{$wInfo.language[0].NwriteLevel}</td>
</tr>
<tr>
    <td>{$wInfo.language[1].language}</td>
    <td>{$wInfo.language[1].NspeakLevel}</td>
    <td>{$wInfo.language[1].NreadLevel}</td>
    <td>{$wInfo.language[1].NwriteLevel}</td>
</tr>
<tr>
    <td><b>住宅电话</b></td>
    <td colspan="2">{$wInfo.homePhone}</td>
    <td><b>移动电话</b></td>
    <td colspan="2">{$talent.telephone}</td>
    <td><b>紧急联系电话</b></td>
    <td colspan="2">{$wInfo.emergency}</td>
</tr>
<tr>
    <td colspan="9"><b>地址信息</b></td>
</tr>
<tr>
    <td><b>家庭地址</b></td>
    <td colspan="6">{$wInfo.homeAddress}</td>
    <td><b>邮编</b></td>
    <td></td>
</tr>
<tr>
    <td><b>现住地址</b></td>
    <td colspan="6">{$wInfo.workAddress}</td>
    <td><b>邮编</b></td>
    <td></td>
</tr>
<tr>
    <td><b>户口地址</b></td>
    <td colspan="6"></td>
    <td><b>邮编</b></td>
    <td></td>
</tr>
    <tr>
        <td><b>通信地址</b></td>
        <td colspan="6"></td>
        <td><b>邮编</b></td>
        <td></td>
    </tr>
    <tr>
         <td colspan="2"><b>主要联系地址</b></td>
        <td colspan="7">
            <input type="checkbox" disabled=true/> 家庭地址  <input type="checkbox" disabled=true/>现住地址
                    <input type="checkbox" disabled=true/>户口地址  <input type="checkbox" disabled=true/>通信地址（请选择一个为主要联系地址）
        </td>
    </tr>
</table>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="pageNext pageEver">
<table width="100%" border="1" cellpadding="2" cellspacing="0" class="second">
    <tr>
        <td colspan="9" ><b>家庭情况及主要社会关系（在一个主要联系人记录后打勾）</b></td>
    </tr>
    <tr>
        <td width="8%"><b>关系</b></td>
        <td width="10%"><b>姓名</b></td>
        <td width="6%"><b>性别</b></td>
        <td width="12%"><b>出生日期</b> </td>
        <td width="15%"><b>工作单位</b></td>
        <td width="10%"><b>职 务</b></td>
        <td width="14%"><b>联系电话</b></td>
        <td width="19%"><b>联 系 地 址</b></td>
        <td width="6%"><b>是否<br/>
            主要 </b></td>
    </tr>
    {for $foo=0 to 2}
        {if $wInfo.relative}
            <tr>
                <td>{$wInfo.relative.$foo.relation}</td>
                <td>{$wInfo.relative.$foo.name}</td>
                <td>{$wInfo.relative.$foo.rsex}</td>
                <td>{$wInfo.relative.$foo.birthday}</td>
                <td>{$wInfo.relative.$foo.workUnit}</td>
                <td>{$wInfo.relative.$foo.job}</td>
                <td>{$wInfo.relative.$foo.phone}</td>
                <td>{$wInfo.relative.$foo.address}</td>
                <td><input type="checkbox" disabled=true/> </td>
            </tr>
        {else}
            <tr>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td></td>
                <td><input type="checkbox" disabled=true/> </td>
            </tr>
        {/if}
    {/for}
</table>
<table width="100%" border="1" cellpadding="2" cellspacing="0" class="second">

<tr>
    <td colspan="9" ><b>入 司 前 工 作 简 历 （由按时间由最近工作单位填写）</b></td>
</tr>
<tr>
    <td width="17%"><b>起　止　时　间</b> </td>
    <td width="10%"><b>行业类型</b></td>
    <td width="11%"><b>工作单位</b></td>
    <td width="8%"><b>部门</b></td>
    <td width="11%"><b>担任职务</b> </td>
    <td width="10%"><b>证明人</b></td>
    <td width="13%"><b>联系电话</b> </td>
    <td width="14%"><b>离职原因</b> </td>
    <td width="6%"><b>是否<br/>
        海外</b></td>
</tr>
{for $foo=0 to 2}
    {if $wInfo.workInfo}
        <tr>
            <td >{$wInfo.workInfo.$foo.BETime}</td>
            <td>{$wInfo.workInfo.$foo.jobType}</td>
            <td>{$wInfo.workInfo.$foo.workUnit}</td>
            <td>{$wInfo.workInfo.$foo.job}</td>
            <td>{$wInfo.workInfo.$foo.jobType}</td>
            <td>{$wInfo.workInfo.$foo.jobType}</td>
            <td>{$wInfo.workInfo.$foo.jobType}</td>
            <td>{$wInfo.workInfo.$foo.leaveReason}</td>
            <td>{$wInfo.workInfo.$foo.oversSeasName}</td>
        </tr>
    {else}
        <tr>
            <td  ></td>
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    {/if}
{/for}
<tr>
    <td colspan="9" ><b>学  习  经  历(按学历高低由高至低填写)</b></td>
</tr>
<tr>
    <td ><p align="center"><b>起　止　时　间</b> </td>
    <td colspan="2"><p align="center"><b>毕 业 院 校 </b></td>
    <td><p align="center"><b>专业 </b></td>
    <td><p align="center"><b>学 历</b> </td>
    <td><p align="center"><b>学 位</b> </td>
    <td><p align="center"><b>证书编号</b> </td>
    <td><p align="center"><b>学习方式</b> </td>
    <td width="6%"><b>是否<br/>海外</b></td>
</tr>
{for $foo=0 to 1}
    {if $wInfo.studyInfo}
        <tr>
            <td ><p align="right">{$wInfo.studyInfo.$foo.BETime}</p></td>
            <td colspan="2">{$wInfo.studyInfo.$foo.graduate}</td>
            <td>{$wInfo.studyInfo.$foo.major}</td>
            <td>{$wInfo.studyInfo.$foo.education}</td>
            <td>{$wInfo.studyInfo.$foo.degree}</td>
            <td>{$wInfo.studyInfo.$foo.diplomaNumber}</td>
            <td>{$wInfo.studyInfo.$foo.studyWay}</td>
            <td>{$wInfo.studyInfo.$foo.oversSeasName}</td>
        </tr>
    {else}
        <tr>
            <td ></td>
            <td colspan="2"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    {/if}
{/for}
<tr>
    <td colspan="9" ><b>职  业  培  训  经  历 </b></td>
</tr>
<tr>
    <td ><p align="center"><b>起　止　时　间 </b></td>
    <td colspan="2" ><p align="center"><b>参加培训课程 </b></td>
    <td colspan="2"><p align="center"><b>培训课时 </b></td>
    <td colspan="2"><p align="center"><b>培训主办机构</b> </td>
    <td colspan="2"><p align="center"><b>获得证书</b> </td>
</tr>
{for $foo=0 to 1}
    {if $wInfo.trainInfo}

        <tr>
            <td ><p align="right">{$wInfo.trainInfo.$foo.BETime}</td>
            <td colspan="2">{$wInfo.trainInfo.$foo.course}</td>
            <td colspan="2">{$wInfo.trainInfo.$foo.trainTime}</td>
            <td colspan="2">{$wInfo.trainInfo.$foo.organization}</td>
            <td colspan="2">{$wInfo.trainInfo.$foo.diploma}</td>
        </tr>
    {else}
        <tr>
            <td ><p align="right"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>
    {/if}
{/for}
<tr>
    <td colspan="9" ><b>取  得  证  书 </b></td>
</tr>
<tr>
    <td ><p align="center"><b>有效日期范围</b> </td>
    <td  colspan="2"><p align="center"><b>证书名称 </b></td>
    <td  colspan="2"><p align="center"><b>级别 </b></td>
    <td colspan="2"><p align="center"><b>取得证书途径</b> </td>
    <td colspan="2"><p align="center"><b>证书评定单位</b> </td>
</tr>
{for $foo=0 to 1}
    {if $wInfo.diploma}
        <tr>
            <td ><p align="right">{$wInfo.diploma.$foo.BETime}</td>
            <td colspan="2">{$wInfo.diploma.$foo.diploma}</td>
            <td colspan="2">{$wInfo.diploma.$foo.grade}</td>
            <td colspan="2">{$wInfo.diploma.$foo.getWay}</td>
            <td colspan="2">{$wInfo.diploma.$foo.judgeUnit}</td>
        </tr>
    {else}
        <tr>
            <td ><p align="right"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>
    {/if}
{/for}
<tr >
    <td height="80px">入职方式</td>
    <td colspan="8" align="left"> {for $foo=1 to 4}
            {html_checkboxes  name="entryWay"  output=$wInfoSet.entryWay.$foo  values=$foo selected="{$wInfo.entryWay}" disabled=true }
        {/for}
        <br/>
        <br/>
        若未以下四项之一,请在横线处填写具体渠道名称:<br/>
        <br/>
        {for $foo=5 to 8}
            {html_checkboxes  name="entryWay"  output=$wInfoSet.entryWay.$foo  values=$foo selected="{$wInfo.entryWay}" disabled=true }________
        {/for}
        <br/>
        <br/>
        若未内部推荐,请按如下要求进行填写: <br/>
        <br/>

        {html_checkboxes  name="entryWay"  output=$wInfoSet.entryWay[0] values=$foo selected="{$wInfo.entryWay}" disabled=true }<br/>
        <br/>
        (<b> 介绍人:</b>____{$wInfo.iName}_____<b>介绍人工号:</b> ____{$wInfo.iNumber}____ <b>介绍人所属地区:</b> ___{$wInfo.iLocal}_____
                    <b>所在部门:</b>____{$wInfo.iDepartment}_____<br/>
        <br/>
                        <b>介绍人职位:</b>____{$wInfo.iJob}___<b>介绍人性别:</b> ___{$wInfo.SexName}_____ <b>与被介绍人的关系:</b>  ___{$wInfo.iRelation}___)</td>
</tr>
<tr>
    <td> <b>兴趣爱好</b></td>
    <td colspan="4">{$wInfo.hobby}</td>
    <td> <b>特长 </b></td>
    <td colspan="3">{$wInfo.strongPoint}</td>
</tr>

</table>

<strong><h2>以下内容为公司填写</h2></strong>
<table width="100%" border="1" cellpadding="2" cellspacing="0" class="second">
    <tr>
        <td >入职日期 </td>
        <td></td>
        <td colspan="2">经办人 </td>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td width="20%" ><p align="center">工资单</td>
        <td width="30%"><p align="center"></p></td>
        <td width="11%">纳税城市</td>
        <td width="11%"></td>
        <td width="14%">社保/公积金摊缴地</td>
        <td width="14%"></td>
    </tr>
</table >

</div>

</body>
</html>