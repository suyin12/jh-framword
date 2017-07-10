<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>

    {literal}
        <style>
            body {
                width: 794px;
                padding: 0;
                margin: 0 auto;
                font-size: 11px;

            }

            @page tableInfo {
                size:8.27in 11.69in;
                margin:.5in .5in .5in .5in;
                mso-header-margin:.5in;
                mso-footer-margin:.5in;
                mso-paper-source:0;
            }
            p{
                _font-size: 11px;
            }

            h3 {
                font-size: 11px;
                _font-size: 12px;

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
                height: 37px;
                _height:30px;
            }

            table{
                text-align: center;
            }
            #btnNext{
                height: 24px;
            }
        </style>

    {/literal}
</head>

<body>
<div id="main">
    {include file="web/w/conmitCommon.tpl"}
    <input type="hidden" name="wID" value="{$wInfo.wID}"/>
    <input type="hidden" name="position" value="{$talent.positionID}"/>
    <input type="hidden" name="status" value="{$talent.status}"/>
    <input type="hidden" name="talentID" value="{$talent.talentID}"/>
   [<b>人才编号:{$talent.talentID}</b>]
    <table width="100%" border="1" cellpadding="2" cellspacing="0" id="first">
        <caption><h2>拟派往深圳市邮政局人员情况表</h2></caption>
        <tr>
            <td  colspan="2" ><b>姓 名</b></td>
            <td width="10%">{$talent.name}</td>
            <td width="6%"><b>性别</b></td>
            <td width="7%">{$wInfo.sexName}</td>
            <td width="14%"><b>出生年月</b></td>
            <td width="12%">{$wInfo.birthday}</td>
            <td width="14%"><b>婚否</b></td>
            <td width="6%">{$wInfo.marriageName}</td>
            <td width="16%" rowspan="7"> 相<br/>片</td>
        </tr>
        <tr>
            <td colspan="2" ><b>文化程度</b></td>
            <td>{$wInfo.educationName}</td>
            <td colspan="2"><b>毕业学校</b></td>
            <td colspan="2">{$wInfo.studyInfo[0].graduate}</td>
            <td><b>所学专业</b></td>
            <td>{$wInfo.studyInfo[0].major}</td>
        </tr>
        <tr>
            <td  colspan="2" ><b>籍贯</b></td>
            <td colspan="3">{$wInfo.nativePlace}</td>
            <td><b>户口所在地</b></td>
            <td colspan="3">{$wInfo.domicilePlace}</td>
        </tr>
        <tr>
            <td colspan="2"><b>出生地</b></td>
            <td colspan="3">{$wInfo.birthPlace}</td>
            <td><b>民族</b></td>
            <td>{$wInfo.nationName}</td>
            <td><b>政治面貌</b></td>
            <td>{$wInfo.roleName}</td>
        </tr>
        <tr>
            <td colspan="2" ><b>身份证号码</b></td>
            <td colspan="3">{$talent.pID}</td>
            <td><b>原工作单位</b></td>
            <td colspan="3">{$wInfo.lastUnit}</td>
        </tr>
        <tr>
            <td colspan="2" ><b>家庭固定电话</b></td>
            <td colspan="3">{$wInfo.homePhone}</td>
            <td><b>联系电话</b></td>
            <td colspan="3">{$talent.telephone}</td>
        </tr>
        <tr>
            <td colspan="2" ><br />
                <b>详细家庭地址</b></td>
            <td colspan="7">{$wInfo.homeAddress}</td>
        </tr>
        <tr>
            <td rowspan="5" ><h4><b>本<br/>人<br/>简<br/>历</h4></b></td>
            <td colspan="3" height="30"><b>起止年月</b></td>
            <td colspan="5"><b>在何地任何职</b></td>
            <td><b>证明人</b></td>
        </tr>
        <tr>
            <td  colspan="3">{$wInfo.studyInfo[0].BETime}</td>
            <td colspan="5">{$wInfo.studyInfo[0].graduate}</td>
            <td>{$wInfo.studyInfo[0].reterence}</td>
        </tr>
        {for $foo=0 to 2}
            {if $wInfo.workInfo}
                <tr>
                    <td colspan="3">{$wInfo.workInfo.$foo.BETime}</td>
                    <td  colspan="5">{$wInfo.workInfo.$foo.workUnit}&nbsp;{$wInfo.workInfo.$foo.job}</td>
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
            <td rowspan="5"><p><b>直系或旁系亲属（不少于三人）情况</b></p></td>
            <td width="10%" ><b>姓名</b></td>
            <td><b>性别</b></td>
            <td><b>年龄</b></td>
            <td><b>与本人关系</b></td>
            <td><b>家庭固定电话</b></td>
            <td colspan="2"><b>工作单位</b></td>
            <td><b>职务</b></td>
            <td><b>户口所在地</b></td>
        </tr>
        {for $foo=0 to 3}
            {if $wInfo.relative}
                <tr>
                    <td>{$wInfo.relative.$foo.name}</td>
                    <td>{$wInfo.relative.$foo.rsex}</td>
                    <td>{countAge year ="{$wInfo.relative.$foo.birthday}"}</td>
                    <td>{$wInfo.relative.$foo.relation}</td>
                    <td >{$wInfo.relative.$foo.phone}</td>
                    <td colspan="2">{$wInfo.relative.$foo.workUnit}</td>
                    <td>{$wInfo.relative.$foo.job}</td>
                    <td>{$wInfo.relative.$foo.domicilePlace}</td>
                </tr>
            {else}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td ></td>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                </tr>
            {/if}
        {/for}
        <tr>
            <td colspan="2"><b>联系人</b></td>
            <td>{$wInfo.contact}</td>
            <td colspan="2"><b>通信地址</b></td>
            <td>{$wInfo.contactAddress}</td>
            <td><b>家庭固定电话(必填)</b></td>
            <td>{$wInfo.cHomePhone}</td>
            <td><b>手机</b></td>
            <td>{$wInfo.contactPhone}</td>
        </tr>
        <tr>
            <td colspan="2">资料真实性证明人(邮政)</td>
            <td></td>
            <td colspan="2">所在部门及岗位</td>
            <td></td>
            <td>家庭固定电话(必填)</td>
            <td></td>
            <td>手机</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">资料真实性证明人(外单位)</td>
            <td></td>
            <td colspan="2">联系人单位</td>
            <td></td>
            <td>家庭固定电话(必填)</td>
            <td></td>
            <td>手机</td>
            <td></td>
        </tr>
        <tr>
            <td colspan="10"><div align="center"><h3>以上内容由求职人如实、详细填写，不得由他人代填</h3></div></td>
        </tr>
        <tr>
            <td colspan="10"><div align="center"><pre><h3>以上项目审核人签名：                       年      月      日</h3></pre></div></td>
        </tr>
        <tr>
            <td colspan="10"><div align="center"><pre><h3>以上项目复核人签名：                        年     月     日</h3></pre></div></td>
        </tr>
        <tr>
            <td rowspan="4">市局人力部意见</td>
            <td colspan="3">拟安排支局</td>
            <td colspan="3"></td>
            <td>拟安排工种</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td height="21" colspan="3">拟安排住宿详细地址</td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td colspan="3">参照薪酬等级</td>
            <td colspan="6"></td>
        </tr>
        <tr>
            <td height="45" colspan="9"><pre>


                                      签名:       年    月    日 (章)</pre>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                注：1、上述表格中每项内容必须如实详细填写，不得空缺。项目审核人、复核人必须认真核查并签名</br>
                2、如资料真实性证明人属外单位人员，要增加对资料证明人的家访记录。证明人签名禁止代签。</br>
                附：本人身份证复印件2份、户口簿复印件2张、相片2张、本人学历证书复印件。
            </td>
        </tr>
    </table>
 </div>

</body>
</html>
