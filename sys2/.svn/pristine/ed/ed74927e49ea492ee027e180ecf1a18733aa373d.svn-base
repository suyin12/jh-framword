{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("input[name=clearing]").click(function(){
		var id=$(this).closest("tr").attr("class");
		var mess=$("."+id+" input[name=mess]").val();
		var ret = confirm("确定" + $(this).val()+ "?");
        if (ret == true) {
        	$.ajax({
                url:"aSQL.php",
                data:"fID="+id+"&mess="+mess+"&btn=clearing",
                type:'POST',
                dataType:'json',
                success:function(json){
    	                var i,n;
    	                $.each(json, function (i, n) {
    		                 switch (i) {
    		                     case "error":
    		                         alert(n);
    		                         break;
    		                     case "succ":
    		                    	 alert(n);
    		                    	 window.location.reload();
    		                         break;
    		                 }
    		            });
      	  		}
    		});
        }
	});
});
</script>
{/literal}
<!--
可以查看缴费信息费用等
-->
<div id="main">
	<fieldset class="theight-4">
	   <form id="billDateForm" method="get">
		  <div class="left"><strong>请选择查询条件：</strong><select name="m">{html_options options=$m selected=$smarty.get.m}</select>
		     <input type="text" name="c" value="{$smarty.get.c}"/><input type="submit" value=查询>
		  </div>
	      <div class="right">
	     	 <a class="noSub positive" href="agencyManage.php" >列表</a>
	         <a class="noSub positive" href="aCreateManage.php" >登记</a>
	         <a class="noSub positive" href="agMPayList.php">缴费</a>
	         <a class="noSub positive" href="agMFeelist.php">平账\入账</a>
	         <a class="noSub positive" href="agMBillList.php?modifydate={$date}">流水账记录</a>
	      	 <a class="noSub positive" href="aClearing.php" >结算</a>
	      </div>
    </fieldset>
    <div>
	    <fieldset>
		    <legend><code>结果</code></legend>
		    <table class="myTable">
				<tr>
					<th>序号</th>
					<th>姓名</th>
					<th>身份证号</th>
					<th>余额</th>
					<th>
						操作
	           		</th>
	           		<th>
						备注
	           		</th>
				</tr>
				{if $bill}
				{foreach item=ba key=key from=$bill name=name}
				<tr class="{$ba.fID}">
					<td>{$smarty.foreach.name.iteration}</td>
					<td><a href="aManage.php?id={$ba.fID}">{$ba.name}</a></td>
					<td>{$ba.pID}</td>
					<td>{$ba.remains}{$ba.clearing}</td>
					<td><input type="button" name="clearing" value="结算"/></td>
					<td><input type="text" name="mess" value=""/></td>
				</tr>
				{/foreach}
				{else}
				<tr><td colspan="6"><font color="red">无此类信息</font></td></tr>
				{/if}
			</table>
		</fieldset>
		</form>
	</div>
</div>
{include file="footer.tpl"}