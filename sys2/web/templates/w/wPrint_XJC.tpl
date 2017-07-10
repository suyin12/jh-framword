<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    {literal}
    <style>
        body {
            width: 794px;
            _width: 649px;
            padding: 0;
            font-size: 11px;
            margin: 0 auto;
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
        #main {
            height: 1100px;
            _height: 970px;
        }

        #first {
            text-align: center;
            border-collapse: collapse;
            border: none;

        }
        #first tr{
            height: 38px;
            _height:33px;
        }

        table{
            text-align: center;
        }
    </style>

    {/literal}
</head>

<body>
<div id="main">
    <div style="padding-bottom: 25px;">
        <span  style="float: left;"><img src="{$httpPath}theme/css/images/xjc.gif"/>深圳市鑫锦程人力资源管理有限公司</span> <br/>
    </div>
    <div style="width: 100%;text-align: center;">
        <h1>员 工 信 息 登 记 表</h1>
    </div>
    [<b>人才编号:{$talent.talentID}</b>]&nbsp;&nbsp;
    用工单位:{$talent.unitName}
    <table width="100%" border="1"  id="first">

        <tr>
            <td width="12%"><b>姓名</b></td>
            <td width="12%">{$talent.name}</td>
            <td width="6%"><b>性别</b></td>
            <td width="7%">{$talent.sexName}</td>
            <td width="12%"><b>出生年月</b></td>
            <td width="12%">{$wInfo.birthday}</td>
            <td width="10%"><b>民族</b></td>
            <td width="10%">{$wInfo.nationName}</td>
            <td colspan="2" rowspan="5"></td>
        </tr>
        <tr>
            <td><b>身份证号码</b></td>
            <td colspan="5">{$talent.pID}</td>
            <td><b>政治面貌</b></td>
            <td>{$wInfo.roleName}</td>
        </tr>
        <tr>
            <td><b>学历</b></td>
            <td>{$wInfo.educationName}</td>
            <td colspan="2"><b>毕业院校</b></td>
            <td colspan="4">{$wInfo.studyInfo[0].graduate}</td>
        </tr>
        <tr>
            <td><b>毕业时间</b></td>
            <td></td>
            <td colspan="2"><b>专业/工种</b></td>
            <td colspan="2" >{$wInfo.studyInfo[0].major}</td>
            <td><b>身高</b></td>
            <td>{$wInfo.height}</td>
        </tr>
        <tr>
            <td colspan="2"><b>职称/职业资格证</b></td>
            <td colspan="2">{$wInfo.wCertificate}</td>
            <td><b>技术等级</b></td>
            <td>{$wInfo.proLevelName}</td>
            <td><b>特长</b></td>
            <td>{$wInfo.strongPoint}</td>
        </tr>
        <tr>
            <td><b>婚否</b></td>
            <td colspan="3">{$wInfo.marriageName}</td>
            <td><b>配偶姓名</b></td>
            <td>{$wInfo.spouseName}</td>
            <td><b>配偶身份证号码</b></td>
            <td colspan="3">{$wInfo.spousePID}</td>
        </tr>
        <tr>
            <td><b>籍贯</b></td>
            <td>{$wInfo.nativePlace}</td>
            <td colspan="2"><b>户籍类型</b></td>
            <td colspan="2">{$wInfo.nativeTypeName}</td>
            <td colspan="2"><b>户口所在地</b></td>
            <td colspan="2">{$wInfo.domicilePlace}</td>
        </tr>
        <tr>
            <td><b>社保电脑号</b></td>
            <td colspan="2"></td>
            <td colspan="2"><b>公积金账号</b></td>
            <td colspan="2"></td>
            <td colspan="2"><b>驾驶执照类型</b></td>
            <td width="11%">{$wInfo.driveType}</td>
        </tr>
        <tr>
            <td><b>开户银行</b></td>
            <td colspan="2"></td>
            <td colspan="2"><b>开户账号/卡号</b></td>
            <td colspan="3"></td>
            <td width="8%"><b>开户地</b></td>
            <td></td>
        </tr>
        <tr>
            <td><b>E-mail</b></td>
            <td colspan="4">{$wInfo.Email}</td>
            <td><b>QQ</b></td>
            <td colspan="2">{$wInfo.QQ}</td>
            <td><b>其他</b></td>
            <td>{$wInfo.Twitter}</td>
        </tr>
        <tr>
            <td colspan="2"><b>家庭固定电话</b></td>
            <td colspan="3">{$wInfo.homePhone}</td>
            <td colspan="2"><b>移动电话</b></td>
            <td colspan="3">{$talent.telephone}</td>
        </tr>
        <tr>
            <td><b>紧急联系人</b></td>
            <td colspan="2">{$wInfo.contact}</td>
            <td colspan="2"><b>联系人电话</b></td>
            <td colspan="2">{$wInfo.contactPhone}</td>
            <td colspan="2"><b>与联系人关系</b></td>
            <td>{$wInfo.cRelation}</td>
        </tr>
        <tr>
            <td><b>身份证地址</b></td>
            <td colspan="9">{$wInfo.domicilePlace}</td>
        </tr>
        <tr>
            <td><b>现住址</b></td>
            <td colspan="9">{$wInfo.homeAddress}</td>
        </tr>
        <tr>
            <td rowspan="4"><p><b>本<br/>人<br/>学<br/>习<br/>工<br/>作<br/>简<br/>历</b></p>
            </td>
            <td colspan="3"><b>起止年月</b></td>
            <td colspan="5"><b>在何地何校学习何单位任职</b></td>
            <td><b>证明人</b></td>
        </tr>
        <tr>
            <td  colspan="3">{$wInfo.studyInfo[0].BETime}</td>
            <td colspan="5">{$wInfo.studyInfo[0].graduate}</td>
            <td>{$wInfo.studyInfo[0].reterence}</td>

        </tr>
        {for $foo=0 to 1}
            {if $wInfo.workInfo}
                <tr>
                    <td colspan="3">{$wInfo.workInfo.$foo.BETime}</td>
                    <td  colspan="5">{$wInfo.workInfo.$foo.workUnit}{$wInfo.workInfo.$foo.job}</td>
                    <td>{$wInfo.workInfo.$foo.reterence}</td>
                </tr>
            {else}
                <tr>
                    <td colspan="3"></td>
                    <td colspan="5"></td>
                    <td></td>
                </tr>
            {/if}
        {/for}
        <tr>
            <td rowspan="5"><b>直系或旁系亲属(不少于三人)</b></td>
            <td><b>姓名</b></td>
            <td><b>性别</b></td>
            <td><b>年龄</b></td>
            <td><b>与本人关系</b></td>
            <td colspan="2"><b>联系电话</b></td>
            <td><b>职务</b></td>
            <td colspan="2"><b>户口所在地</b></td>
        </tr>
        {for $foo=0 to 3}
            {if $wInfo.relative}
                <tr>
                    <td>{$wInfo.relative.$foo.name}</td>
                    <td>{$wInfo.relative.$foo.rsex}</td>
                    <td>{countAge year ="{$wInfo.relative.$foo.birthday}"}</td>
                    <td>{$wInfo.relative.$foo.relation}</td>
                    <td colspan="2">{$wInfo.relative.$foo.phone}</td>

                    <td>{$wInfo.relative.$foo.job}</td>
                    <td colspan="2">{$wInfo.relative.$foo.domicilePlace}</td>
                </tr>
            {else}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td colspan="2"></td>
                    <td></td>
                    <td colspan="2"></td>
                </tr>
            {/if}
        {/for}
        <tr>
            <td colspan="10" align="left">声明:本人保证上述所填内容及所提供资料均真实无误.如有虚假,愿承担相关一切责任<br/>
                      <pre>                                                                                  本人签名:         日期:      </pre>
            </td>
        </tr>
        <tr>
            <td>入职时间</td>
            <td></td>
            <td>岗位</td>
            <td colspan="2">{$talent.positionName}</td>
            <td colspan="2">鑫锦程项目审核人</td>
            <td></td>
            <td>日期</td>
            <td></td>
        </tr>
    </table>
备注:上述表格中的每项内容必须如实详细填写,不得空缺.项目审核人必须认真核查并签名;

</div>

</body>
</html>
