{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("tr input[name=income]").focus(function(){
   		$(this).val("");
    });
	$("select[name=payment]").change(function(){
        $("#billDateForm").submit();
  	});
	$(".hideShow").click(function(){
		var id=$(this).closest("tr").attr("class");
    	$("."+id+" .hideArea").toggle();
    });
	$("input[name=bill]").click(function(){
		var id=$(this).closest("tr").attr("class");
        var income=Number($("."+id+" input[name=income]").val());
        var type=$("."+id+" select[name=type]").val();
        var remains=Number($("."+id+" .remains").text());
        var mess=$("."+id+" input[name=mess]").val();
        var Total=$("."+id+" .Total .hideArea:visible").text();
        var payment=$("select[name=payment]").val();
        Total=Number(Total.replace(/元|☆|★|[\s]/g,""));
  	   if(income>0){
    	 if(confirm("缴费金额"+income+",确认吗？")== true)
         {
   		 	$.ajax({
	             url:"aSQL.php",
	             data:"fid="+id+"&type="+type+"&income="+income+"&remains="+remains+"&mess="+mess+"&Total="+Total+"&payment="+payment+"&btn=bill",
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
			                    	 $("tr input[name=income]").val("");
			                         break;
			                     case "remains":
			                    	 $("."+id+" .remains").text(n);
			                         break;
			                     case "status":
			                    	 $("."+id+"").hide("slow");
			                    	 if(payment=='3'){
			                    	 	window.location.replace("agMPayList.php?id="+id+"&payment=1");
			                    	 }
			                         break;
			                 }
			            });
	   	  		}
	     	});
         }
  	   }else{
     	  alert("请输入正数");
  	   }
	});	
});
</script>
{/literal}
<div id="main">
	<fieldset>
		<div class="left">
		  <form name="searchArchives" method="get" action="{$actionURL}">
		  <table>
			  <tr>
			     <td>
			     	<strong>请选择查询条件</strong>
			     		<select name="m">{html_options options=$m selected=$s_m}</select>
					  	<input type="text" name="c" value="{$s_c}"/>
					  	<input type="hidden" name="payment" value="{$s_payment}"/>
					  	<input type="submit" value="查询"/>
				 </td>
			  </tr>
		     </table>
	   	</form>
	   </div>
	      <div class="right">
	      	 <a class="noSub positive" href="agencyManage.php" >列表</a>
	         <a class="noSub positive" href="aCreateManage.php" >登记</a>
	         <a class="noSub positive" href="agMPayList.php">缴费</a>
             <a class="noSub positive" href="aCreateList.php" >申报</a>
	         <a class="noSub positive" href="agMFeelist.php">平账\入账</a>
	         <a class="noSub positive" href="agMBillList.php?modifydate={$modifydate}">流水账记录</a>
	      </div>
    </fieldset>
    <div>
	    <fieldset>
		    <legend><code>结果</code></legend>
		    <table class="myTable">
				<tr>
					<th>序号</th>
					<th>状态</th>
					<th>余额</th>
					<th>姓名</th>
					<th>联系电话</th>
					{if $s_payment=='1'}
					<th>社保费</th>
					<th>月数</th>
					<th>公积金</th>
					<th>月数</th>
					{/if}
					{if $s_payment=='3'}
					<th>管理费</th>
					{/if}
					<th>应收</th>
					<th>缴费类型</th>
					<th>实收金额</th>
					<th>操作</th>
					<th>备注</th>
					<th>
					<form id="billDateForm" method="get">
						<input type="hidden" name="id" value="{$s_id}"/>
						<input type="hidden" name="m" value="{$s_m}"/>
						<input type="hidden" name="c" value="{$s_c}"/>
	           		   <select name="payment">
						  <option value="">选择明细</option>
	           			  <option value="1" {if $s_payment=='1'}selected=selected{/if}>社保+公积金+补缴</option>
	           			  <option value="3" {if $s_payment=='3'}selected=selected{/if}>管理费</option>
	           		   </select>
	           		</form>
	           		</th>
				</tr>
				{foreach item=ba key=key from=$billArr name=name}
				<tr class="{$ba.id}">
					<td>{$smarty.foreach.name.iteration}</td>
					<td>{$status[$ba.status]}</td>
					<td class="remains">{$ba.remains}</td>
					<td class="name"><a href="aManage.php?id={$ba.id}">{$ba.name}</a></td>
					<td>{$ba.mobilePhone}</td>
					{if $s_payment=='1'}
					<td>{$ba.uTotal+$ba.pTotal+$ba.uPDIns}</td>
					<td>{if $ba.cmonths}<span class="hideArea">{$ba.cmonths}</span><span class="hideArea" style="display:none">1</span>{/if}</td>
					<td>{$ba.HFtotal}</td>
					<td>{if $ba.hmonths}<span class="hideArea">{$ba.hmonths}</span><span class="hideArea" style="display:none">1</span>{/if}</td>
					{/if}
					{if $s_payment=='3'}
					<td>{if $ba.managementCost=="0"}免{else}{$ba.managementCost}{/if}</td>
					{/if}
					<td class="Total">
					{if $s_payment=='1'}
					<span class="hideArea">
					{($ba.uTotal+$ba.pTotal+$ba.uPDIns)*$ba.cmonths+$ba.HFtotal*$ba.hmonths+$ba.Tsoins+$ba.THF-$ba.remains}
					元<a class="hideShow">★</a>
					</span>
					<span class="hideArea" style="display:none">
					{($ba.uTotal+$ba.pTotal+$ba.uPDIns)+$ba.HFtotal+$ba.Tsoins+$ba.THF-$ba.remains}
					元<a class="hideShow">☆</a>
					</span>
					{else if $s_payment=='3'}
					{$ba.managementCost*$ba.months}
					元
					{/if}
					
					</td>
					<td><select name="type">
	           			  <option value="1">现金</option>
	           			  <option value="3">转账</option>
	           		  </select></td>
	           		<td><input type="text" value="" placeholder="输入金额" name="income" class='textWidth'/></td>
					<td><input type="submit" value="确定" name="bill" /></td>
					<td><input type="text" value="" name="mess"/></td>
				</tr>
				{/foreach}
			</table>
		</fieldset>
	</div>
</div>
{include file="footer.tpl"}