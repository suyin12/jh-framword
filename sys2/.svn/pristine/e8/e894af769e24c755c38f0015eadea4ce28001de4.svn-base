<form method="post" action="comIns_edit.php?edit=modify">
  <table>
    {section name=line loop=$comIns}
    <tr>
	  <td>商保名称：</td>
	  <td><input type="text" id="txtconName" name="txtconName" value="{$comIns[line].typeName}"/></td>
	</tr>
	<tr>
	  <td>商保系数：</td>
	  <td><input type="text" id="txtconRatio" name="txtconRatio" value="{$comIns[line].comInsMoney}"/><input type="hidden" name="comInsType" value="{$comIns[line].comInsType}" /></td>
	</tr>
	{/section}
	<tr>
	  <td colspan="2" align="center"><input type="submit" name="sub" value="修改" />&nbsp;&nbsp;&nbsp;<input type="button" value="取消" onclick="javascript:history.go(-1);" /></td>
	</tr>
  </table>
</form>
