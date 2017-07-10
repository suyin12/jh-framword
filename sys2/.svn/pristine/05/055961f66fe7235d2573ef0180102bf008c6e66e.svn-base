{include file="header.tpl"}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$("#aGM1 input,#aGM1 textarea").change(function(){
		var mess=$(this).val();
		var name=$(this).attr('name');
		$.ajax({
			url:"aSQL.php",
			data:"btn=aGM&formID=1&"+name+"="+mess,
			type:'POST',
			dataType:'text',
			success:function(re){
				alert(re);
			}
		});
	});
	$("#aGM2 input,#aGM2 textarea").change(function(){
		var mess=$(this).val();
		var name=$(this).attr('name');
		$.ajax({
			url:"aSQL.php",
			data:"btn=aGM&formID=2&"+name+"="+mess,
			type:'POST',
			dataType:'text',
			success:function(re){
				alert(re);
			}
		});
	});
});


</script>
<style type="text/css">
#main{
	font-size:14px;
}
textarea{
	margin-top:10px;
	padding:5px 0;
	text-align:justify;
	width:100%;
}
table{
	width:100%;
	text-align:center;
}
table th{
	width:20%;
	text-align:center;
	border:1px dotted;
	height:30px;
}
table tr{
	height:30px;
}
table td{
	border:1px dotted;
}
table .text td{
	border:0px;
	text-align:left;
}
table .title td{
	border:0px;
	font-size:20px;
	font-weight:bold;
}
</style>
{/literal}
<div id="main">
	<!-- 上边协议开始 -->
	<div class="agreeWidth center">
		<fieldset>
			<form class="form" id="aGM1">
				<table>
					<tr class="title">
						<td colspan="5">{if $smarty.get.A}委托代缴社会保险标准确认表{else}委托代缴公积金标准确认表{/if}</td>
					</tr>
					<tr class="text">
						<td colspan="2">委 托 人：<b>{$name}</b></td><td colspan="3">身份证号码：<b>{$pID}</b></td>
					</tr>
					<tr class="text">
						<td colspan="2">投保基数：<b>{if $smarty.get.A}{$radix}{else}{$HFRadix}{/if}　元/月</b></td><td colspan="3">{if $smarty.get.A}电脑号：<b>{$sID}</b>{else}个人公积金：<b>{$HFID}</b>{/if}</td>
					</tr>
					<tr>
						<th>项目</th><th>单位承担</th><th>个人承担</th><th>合计</th><th>备注</th>
					</tr>
					{if $smarty.get.A}
					{if $pension==1}
					<tr>
						<td>养老保险</td><td>{$soIns.uPension}</td><td>{$soIns.pPension}</td><td>{$soIns.uPension+$soIns.pPension}</td><td></td>
					</tr>
					{/if}
					{if $hospitalization==0}{else}
					<tr>
						<td>医疗保险</td><td>{$soIns.uHospitalization}</td><td>{$soIns.pHospitalization}</td><td>{$soIns.uHospitalization+{$soIns.pHospitalization}}</td><td></td>
					</tr>
					{/if}
					{if $employmentInjury==1}
					<tr>
						<td>工伤保险</td><td>{$soIns.uEmploymentInjury}</td><td></td><td>{$soIns.uEmploymentInjury}</td><td></td>
					</tr>
					{/if}
					{if $unemployment==1}
					<tr>
						<td>失业保险</td><td>{$soIns.uUnemployment}</td><td>{$soIns.pUnemployment}</td><td>{$soIns.uUnemployment+$soIns.pUnemployment}</td><td></td>
					</tr>
					{/if}
                        <tr>
                            <td>残障金</td><td>{$soIns.uPDIns}</td><td>{$soIns.pPDIns}</td><td>{$soIns.uPDIns+$soIns.pPDIns}</td><td></td>
                        </tr>
                        <tr>
						<td>合计</td><td></td><td></td><td>{if $soIns.uPDIns==0}{$soIns.uTotal+$soIns.pTotal}{else}{$soIns.uTotal+$soIns.pTotal+$soIns.uPDIns}{/if}</td><td></td>
					</tr>
					{else}
					<tr>
						<td>公积金</td><td>{$HF.uTotal}</td><td>{$HF.pTotal}</td><td>{$HF.uTotal+$HF.pTotal}</td><td></td>
					</tr>
					{/if}
					<tr class="text"><td colspan="5">
<textarea name= "content" rows="11">
{if $smarty.get.A}
    委托人确认上表所列项目及金额(费用)均由委托人承担，委托深圳市鑫锦程人力资源管理有
    限公司办理劳动事务代理（代缴保险）。
    每年7月社保缴费基数统一调整时自动上调投保基数。扣款情况可上网查询，登陆“深圳社会
    保险基金管理局”，网址：http://www.szsi.gov.cn/，点击左上角的“社会保险服务个人
    网页”，注册后登陆便可查询明细。
   
    您可以通过转账的方式支付所有费用，以下是我司账号，请您在转账后及时来电告知。
        名  称：深圳市鑫锦程人力资源管理有限公司
        账  号：814684790110001
        开户行：招行八卦岭支行
{else}
    委托人确认上表所列项目及金额(费用)均由委托人承担，委托深圳市鑫锦程人力资源管理有限公司办理劳动事务代理（代缴公积金）。
    每年7月公积金缴费基数统一调整时自动上调最低缴交基数。扣款情况可上网查询，登陆“深圳市住房公积金管理中心”，网址：https://nbp.szzfgjj.com/newui/login.jsp?transcode=cert，点击菜单栏下面的“个人登录网页”，公积金帐号为个人公积金号、密码为身份证号后六位登陆便可查询明细。
    
    您可以通过转账的方式支付所有费用，以下是我司账号，请您在转账后及时来电告知。
        名  称：深圳市鑫锦程人力资源管理有限公司
        账  号：814684790110001
        开户行：招行八卦岭支行
{/if}</textarea>
</td></tr>
	<tr class="text"><td colspan="5">
{if $smarty.get.A}
<pre>
备注：2015.7月开始社平工资调至6054元；2015年3月开始最低基数调至2030元；养老保险、
失业保险从2015年1月1日开始执行新政策，敬请留意社保局网上公布的信息。
</pre>
{else}
备注：2015年3月开始最低基数调至2030元；
{/if}
</td></tr>
<tr class="text"><td colspan="5">
<pre>

					委托人签字：___________
			
					日     期：___________</pre></td></tr>
				</table>
				{if $smarty.get.A}
				<a href="agreement.php?print=A&id={$id}&A=true" target="_blank">打印</a>
				{else}
				<a href="agreement.php?print=A&id={$id}&B=true" target="_blank">打印</a>
				{/if}
			</form>
		</fieldset>
	</div>
	<!-- 上边协议结束 -->
	<!-- 下边协议开始 -->
	<div class="agreeWidth center">
		<fieldset>
<form class="form" id="aGM2">
				<table>
					<tr class="title">
						<td colspan="5">劳动事务代理协议书</td>
					</tr>
					<tr class="text">
						<td colspan="5">甲方：深圳市鑫锦程人力资源管理有限公司</td>
					</tr>
					<tr class="text">
						<td colspan="2">乙方： <b>{$name}</b></td><td colspan="3">身份证号码：<b>{$pID}</b></td>
					</tr>
					<tr class="text"><td colspan="5">
{if $smarty.get.A}
<pre>
　　甲、乙双方经友好协商达成如下协议：
　　一、甲方同意为乙方提供劳动事务代理服务。
　　二、本协议有效期限为  {$cmonths}  个月，自  {$cBeginDay.0}年  {$cBeginDay.1}  月  {$cBeginDay.2} 日至 {$cEndDay.0}   年  {$cEndDay.1}  月
  {$cEndDay.2}  日止，本协议期满，乙方应提前一个月与甲方续订协议事宜。
　　三、乙方每月应向甲方交缴管理服务费   {$managementCost}   元，   {$cmonths}   个月共计   {$managementCost*$cmonths}   元，于
签订协议时一次性付清，协议期内如乙方要求终止服务，其管理服务费不予退还。
　　四、双方协议期间，甲方按国家有关规定为乙方提供代交社会保险及相关服务，范围包
括：①代交养老保险、医疗保险、工伤、失业、生育保险（含残障金）；②乙方离开本市需
要办理社会保险关系转出本市时由甲方开具相关的证明；③乙方到达退休年龄需办理退休手
续时，甲方为乙方提供相应的证明。
　　五、甲方仅为乙方提供第四项所列的服务，甲方与乙方不存在任何劳动关系，乙方的行
政关系、就业、工资、福利、医疗费报销、转（退）保险金、退休手续等均为自理。
　　六、乙方在协议期间，应自觉遵守国家的有关法律、法规，不得以甲方之名义从事任何
违法活动，否则，一经发现，立即终止协议，管理费不予退还。
　　七、本协议期间， 乙方如需要提前停止缴交保险应在当月10号以前向甲方提出申请，否
则视为正常缴交。
　　八、协议期满乙方应提前一个月申请办理续签协议并预交社会保险金，若不办理续签协
议手续甲方有权停止对乙方的服务，由此造成的后果由乙方自行负责。
　　九、本协议期内，甲方按照国家规定及乙方提供的工资基数代乙方缴交社会保险，乙方
预付的保险金按一个协议期为结算单位，以深圳市社会保险基金管理中心提供的《深圳市社
会保险单位缴交明细表》为准，实行“多退少补”；如乙方在协议期间提前终止协议，可在
当月的20号以后与甲方结算保险预付金的余额。
　　十、协议未尽事宜，甲、乙双方应友好协商解决。
　　十一、本协议一式二份，甲、乙双方各执一份，具有同等效力，自签字盖章之日起生效。

</pre>
{else}
<pre>
　　甲、乙双方经友好协商达成如下协议：
　　一、甲方同意为乙方提供劳动事务代理服务。
　　二、本协议有效期限为  {$hmonths}  个月，自  {$hBeginDay.0}年  {$hBeginDay.1}  月  {$hBeginDay.2} 日至 {$hEndDay.0}   年  {$hEndDay.1}  月
  {$hEndDay.2}  日止，本协议期满，乙方应提前一个月与甲方续订协议事宜。
　　三、乙方每月应向甲方交缴管理服务费   {$managementCost}   元，   {$hmonths}   个月共计   {$managementCost*$hmonths}   元，于
签订协议时一次性付清，协议期内如乙方要求终止服务，其管理服务费不予退还。
　　四、双方协议期间，甲方按国家有关规定为乙方提供代交公积金及相关服务。
　　五、甲方仅为乙方提供代缴公积金的服务，甲方与乙方不存在任何劳动关系，乙方的公
积金提取、公积金贷款业务等均为自理。
　　六、乙方在协议期间，应自觉遵守国家的有关法律、法规，不得以甲方之名义从事任何
违法活动，否则，一经发现，立即终止协议，管理费不予退还。
　　七、本协议期间， 乙方如需要提前停止缴交公积金应在当月10号以前向甲方提出申请，
否则视为正常缴交
　　八、协议期满乙方应提前一个月申请办理续签协议并预交公积金费用，若不办理续签协
议手续甲方有权停止对乙方的服务，由此造成的后果由乙方自行负责。
　　九、本协议期内，甲方按照深圳市公积金政策规定及乙方提供的公积金缴交基数代乙方
缴交公积金，乙方预付的公积金费用按一个协议期为结算单位，以深圳市公积金管理中心提
供的《深圳市公积金缴交明细表》为准，实行“多退少补”；如乙方在协议期间提前终止协
议，可在当月的25号以后与甲方结算保险预付金的余额。
　　十、协议未尽事宜，甲、乙双方应友好协商解决。
　　十一、本协议一式二份，甲、乙双方各执一份，具有同等效力，自签字盖章之日起生效。

</pre>
{/if}
</td></tr>
<tr class="text"><td colspan="5">
<pre>
甲方：深圳市鑫锦程人力资源管理有限公司　　　　　　　　　乙方：
代表（签名）：　　　　　　　　　　　　　　　　　　　　　代表（签名）：

联系电话：0755-82385383-6452　　　　　　　　　　　　　　联系电话：
地址：深圳市罗湖区湖贝路华佳广场2012室　　　　　　　　　地    址：
日    期：　　　　　　　　　　　　　　　　　　　　　　　日    期：
</pre></td></tr>
				</table>
				{if $smarty.get.A}
				<a href="agreement.php?print=B&id={$id}&A=true" target="_blank">打印</a>
				{else}
				<a href="agreement.php?print=B&id={$id}&B=true" target="_blank">打印</a>
				{/if}
			</form>
		</fieldset>
	</div>
	<!--下边协议结束 -->
	<hr class="clear"/><br/>
</div>
{include file="footer.tpl"}