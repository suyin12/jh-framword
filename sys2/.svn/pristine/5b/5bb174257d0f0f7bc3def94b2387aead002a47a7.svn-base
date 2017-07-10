{include file="header.tpl"}
<script type="text/javascript" src='{$httpPath}lib/js/jquery.datepick.js' ></script>
<link href="{$httpPath}css/jquery.datepick.css" rel="stylesheet" type="text/css">
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
        $("#lateList input[name=radix],#lateList input[name=latemanagementCost]").focus(function(){
        	$(this).val("");
        });
		//添加新的社保补缴记录
        $("#latesoins input[name=addsoins]").click(function(){
           var radix=$("#latesoins input[name=radix]").val();
     	   if(radix>0){
      		  $("#latesoins").submit();
     	   }else{
        	  alert("请输入正数");
     	   }
       	});
        //添加新的公积金补缴记录
        $("#lateHF input[name=addHF]").click(function(){
           var radix=$("#lateHF input[name=radix]").val();
     	   if(radix>0){
      		  $("#lateHF").submit();
     	   }else{
        	  alert("请输入正数");
     	   }
       	});
        //查询补缴台账年月的信息
        $("#soinsForm select[name=paydate]").change(function(){
			$("#soinsForm").submit();
      	});
        $("#HFForm select[name=paydate]").change(function(){
			$("#HFForm").submit();
      	});
        $("input[name=bill]").click(function(){
    		var fID = $("input[name=fID]").val();
            var income = Number($("input[name=income]").val());
            var type=$("select[name=type]").val();
            var remains=Number($("input[name=remains").val());
      	   if(income>0){
       		 	$.ajax({
    	             url:"aSQL.php",
    	             data:"fID="+fID+"&income="+income+"&type="+type+"&remains="+remains+"&payment=6&btn=bill",
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
    			                    	 alert(n+",转到缴费页面");
    			                    	 window.location.replace("agMPayList.php?id="+fID+"&payment=1");
    			                         break;
    			                 }
    			            });
    	   	  		}
    	     	});
      	   }else{
         	  alert("请输入正数");
      	   }
    	});	
        $(".date").datepick();
    });
    </script>
{/literal}
<div id="main">
    <fieldset>
	           <div id="lateList">
	           <form id="latesoins">
	           <input type="hidden" name="fID" value="{$fID}"/>
	           <input type="hidden" name="paydate" value="{$paydate}"/>
           			补缴社保：
	           		  <select name="latepaymonth">
	           		  {html_options options=$soInsMonAll selected=$smarty.get.latepaymonth}
	           		  </select>
	           		  截止日期：<input type="text" name="closedate"  class="req-string date" value="{if $lateListArr.0.closedate}{$lateListArr.0.closedate}{else}{$today}{/if}"/>
		           	  补缴基数：<input type="text" name="radix" value="{if $smarty.get.radix}{$smarty.get.radix}{else}请输入{/if}"/>
		           	  管理费：<input type="text" name="latemanagementCost" value="{$latemanagementCost}"/>
		           	  养老<span class="red">*</span>
                	  <input type="checkbox" name="pension" value="1" checked="checked"/>
		           	  <input type="button" name="addsoins" value="添加"/>
		       </form>	  
	           <table class="myTable">
	           		<tr id="lateson">
	           			<th>补缴</th>
	           			<th>缴费基数</th>
	           			<th>滞纳金</th>
	           			<th>滞纳金累计天数</th>
	           			<th>补缴养老本金</th>
	           			<th>合计</th>
	           			<th>补缴管理费</th>
	           			<th>操作</th>
	           			<th>
	           			<form id="soinsForm">
	           			台账月份
	           			<input type="hidden" name="fID" value="{$fID}"/>
	           				<select name="paydate">
							  <option value="">请选择</option>
		           			  {html_options options=$latesoInsMonAll selected=$smarty.get.paydate}
		           		  	</select>
		           		</form>
	           			</th>
	           		</tr>
	           		{foreach from=$lateListArr item=l}
	           		<tr class="listson">
	           			<td>{$l.latepaymonth}</td>
	           			<td>{$l.radix}</td>
	           			<td>{$l.latepay}</td>
	           			<td>{$l.latepaydays}</td>
	           			<td>{$l.basicPension}</td>
	           			<td>{$l.latepay + $l.basicPension}</td>
	           			<td>{$l.latemanagementCost}</td>
	           			<td><a href="agMLateList.php?fID={$fID}&paydate={$l.paydate}&id={$l.id}&type=delsoins">删除</a></td>
	           		</tr>
	           		{/foreach}
	           		{if $Tsoins}
	           		<tr class="listson">
	           			<td>合计</td>
	           			<td colspan="4"></td>
	           			<td>{$Tsoins}</td>
	           		</tr>
	           		{/if}
	           </table>
	           <form id="lateHF">
	           <input type="hidden" name="fID" value="{$fID}"/>
	           <input type="hidden" name="paydate" value="{$paydate}"/>
           			补缴公积金：
	           		  <select name="latepaymonth">
	           		  {html_options options=$HFMonAll selected=$smarty.get.latepaymonth}
	           		  </select>
		           	  补缴基数：<input type="text" name="radix" value="{if $smarty.get.radix}{$smarty.get.radix}{else}请输入{/if}"/>
		           	  管理费：<input type="text" name="latemanagementCost" value="{$latemanagementCost}"/>
		           	  <input type="button" name="addHF" value="添加"/>
		       </form>
	           <table class="myTable">
	           		<tr id="lateson">
	           			<th>补缴</th>
	           			<th>缴费基数</th>
	           			<th>单位补缴比例</th>
	           			<th>个人补缴比例</th>
	           			<th>合计</th>
	           			<th>补缴管理费</th>
	           			<th>操作</th>
	           			<th>
	           			<form id="HFForm">
	           			台账月份
	           			<input type="hidden" name="fID" value="{$fID}"/>
	           				<select name="paydate">
							  <option value="">请选择</option>
		           			  {html_options options=$lateHFMonAll selected=$smarty.get.paydate}
		           		  	</select>
		           		</form>
	           			</th>
	           		</tr>
	           		{foreach from=$lateHFListArr item=l}
	           		<tr class="listson">
	           			<td>{$l.latepaymonth}</td>
	           			<td>{$l.HFRadix}</td>
	           			<td>{$l.uHFPer}</td>
	           			<td>{$l.pHFPer}</td>
	           			<td>{$l.total}</td>
	           			<td>{$l.latemanagementCost}</td>
	           			<td><a href="agMLateList.php?fID={$fID}&paydate={$l.paydate}&id={$l.id}&type=delHF">删除</a></td>
	           		</tr>
	           		{/foreach}
	           		{if $THF}
	           		<tr class="listson">
	           			<td>合计</td>
	           			<td colspan="3"></td>
	           			<td>{$THF}</td>
	           		</tr>
	           		{/if}
	           </table>共收补缴管理费&nbsp;<input type="text" name="income" value="{$Cost}" style="width:30px;"/>&nbsp;元&nbsp;&nbsp;
	          {if $status}
	          <input type="hidden" name="remains" value="{$remains}"/>
	          <select name="type">
           		  <option value="1">现金</option>
           		  <option value="3">转账</option>
           	  </select>
	           <input type="button" name="bill" value="提交"/>
	           {/if}
	           </div>
</fieldset>  
</div>
{include file="footer.tpl"}