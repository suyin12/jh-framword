<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        {config_load file="htmlSet.conf"}
        <meta http-equiv="Content-Type" content=text/html; charset={#charset#}>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <link rel="stylesheet" type="text/css" href='{$css}' />
        <title>{$title|default:"派遣系统"}</title>
    </head>
    <body>
        <div id="main">
            <div>
			<!--批次号-->
                <table class="myTable">
                    <thead>
                        {foreach item=thead from= $tableHead}
                        <th>
                            {$thead}
                        </th>
                        {/foreach}
                    </thead>
                    <tbody>
                        {foreach item= tcell from = $tableCell}
                        <tr>
                            {foreach item=thead key=theadKey from= $tableHead}
                            <td>
                                {$tcell.$theadKey}
                            </td>
                            {/foreach}
                            {foreachelse}
                            <td>
                                没有出查询结果
                            </td>
                        </tr>
                        {/foreach}
                    </tbody>
                </table>
                {$pageList}
                <div>
                    <form method="post">
                        <input type="submit" name="intoExcel" value="保存为EXCEL">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>