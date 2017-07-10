{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/tipswindown.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.datepick.js ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
<div id="main">
    <fieldset class="theight-4">
    <form name="searchArchives" method="get" >
        <div class="left">
        类别：<select name="type" >{html_options options=$c_type_opt selected=$c_type_selected}</select>
        姓名：<input type="text" name="name" value="{$name_selected}"/>
        身份证号：<input type="text" name="idcard" value="{$idcard_selected}"/>
        <input type="submit" value="确定" />
         </div>
        <div class="right">
         <a class="noSub positive" href="archiveCreate.php?type={$type}" >新增档案</a>
        <a class="noSub positive" href="archiveStatus.php" >档案管理信息统计</a>
        </div>
    </form>
      </fieldset>
     <fieldset>
       
    <table class="myTable" >

        <tr>
            <th>姓名</th>
            <th>性别</th>
            <th>身份证号</th>
            <th>联系方式</th>

            <th>档案编号</th>
            <th>来档单位</th>
            <th>工作单位</th>
            <th>客户经理</th>

            <th>档案托管日期</th>


            <th>取档日期</th>

            <th>创建人</th>
            <th>创建日期</th>
            <th>缴费</th>

        </tr>

        {foreach item=a from=$archives}
            <tr>
                <td><a href="archiveInfo.php?id={$a.id}">{$a.name}</a></td>
                <td>{$a.sex}</td>
                <td>{$a.idcard}</td>
                <td>{$a.tel1}</td>

                <td>{$a.fileNumber}</td>
                <td>{$a.fromUnit}</td>
                <td>{$a.workUnit}</td>
                <td>{$a.manager}</td>

                <td>{$a.manageDate}</td>


                <td>{$a.giveDate}</td>

                <td>{$a.createdBy}</td>
                <td>{$a.createdOn}</td>
                <td><a href="agencydopayment.php?ptype=1&id={$a.id}" target="_blank" >个人缴费</a>&nbsp;&nbsp;</td>

            </tr>
        {/foreach}

    </table>

    {$pageList}
    </fieldset>
</div>
{include file="footer.tpl"}