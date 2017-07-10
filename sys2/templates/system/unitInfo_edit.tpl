{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
<div id="mainBody">
     <fieldset>   
     {if $smarty.get.id}
     <form method="post" action="unitInfo_edit.php?id={$smarty.get.id}" >
     <input  name="edit" value="modify" type="hidden">
     {else}
         <form method="post" action="unitInfo_edit.php" >
     <input  name="edit" value="add" type="hidden">
     {/if}    
<table class="myTable" width="100%">
  <tr>
    <td>单位编号</td>
    <td><input type="text"  name="unitID" value="{$unitID}" {if $unitID}readonly{/if} /></td>
    <td>单位名称</td>
    <td><input type="text"  name="unitName"  value="{$unitName}" /></td>
    <td>合并方式 <input type="text"  name="wantToMerge" value="{$wantToMerge}" size="3" /></td>
     <td>服务状态 <select  name="status">
       {html_options options=$statusArr selected=$s_status } 
     </select>
     </td>     
  </tr>
  <tr>
    <td>商保缴交方式</td>
    <td>
     <select style="width:150px;"  name="comInsType">
          <option value="">--请选择--</option>    
      {foreach from=$comInsTypeArr key=k item=v}
          <option value='{$k}' {if $s_comInsType==$k}selected{/if}>{$v.typeName}({$v.comInsMoney})</option>
      {/foreach}   
     </select>
    </td>
    <td>单位商保<input type="text"  name="uComInsMoney" value="{$uComInsMoney}"  size="10"/></td>
    <td>个人商保<input type="text"  name="pComInsMoney" value="{$pComInsMoney}" size="10"/></td>
    <td>非全商保支付方式</td>
    <td>
     <select style="width:150px;"  name="notFullComInsFrom">
       {html_options options=$insuranceFromArr selected=$s_notFullComInsFrom }
     </select>
    </td>
  </tr>
  <tr>
     <td colspan="2">管理费限制<input type="text"  name="mCostLimit" value="{$mCostLimit}" /><br>(格式: 'type'=>'dailyLimit','act'=>array('5'=>'0','15'=>'0.5'))</td>       
    <td>全日制管理费</td>
    <td><input type="text"  name="fullManageCost" value="{$fullManageCost}" /></td>
    <td>非全日制管理费</td>
    <td><input type="text"  name="notFullManageCost" value="{$notFullManageCost}" /></td>
  </tr>
  <tr>
    <td>单位地址</td>
    <td><input type="text"  name="unitAddr" value="{$unitAddr}" /></td>
    <td>社保登记账户</td>
    <td>
     <select style="width:150px;"  name="soInsID">
     <option value="">--请选择--</option>
      {html_options output=$soInsIDArr values=$soInsIDArr selected=$s_soInsID }
     </select>
    </td>
    <td>公积金登记账户</td>
    <td>
     <select style="width:150px;"  name="housingFundID">
      <option value="">--请选择--</option>
      {html_options output=$HFIDArr values=$HFIDArr selected=$s_housingFundID }
     </select>
    </td>
  </tr>
  <tr>
    <td>社保支付方式</td>
    <td>
     <select style="width:150px;"  name="soInsFrom">
       {html_options options=$insuranceFromArr selected=$s_soInsFrom }
     </select>
    </td>
    <td>非全社保支付方式</td>
    <td>
     <select style="width:150px;"  name="notFullSoInsFrom">
       {html_options options=$insuranceFromArr selected=$s_notFullSoInsFrom }
     </select>
    </td>
    <td>社保垫付方式</td>
    <td>
     <select style="width:150px;"  name="soInsModel">
       {html_options options=$insuranceModelArr selected=$s_soInsModel }
     </select>
    </td>
    </tr>
    <tr>
    <td>公积金支付方式</td>
    <td>
     <select style="width:150px;"  name="HFFrom">
             {html_options options=$insuranceFromArr selected=$s_HFFrom }
     </select>
    </td>
    <td>非全公积金支付方式</td>
    <td>
     <select style="width:150px;"  name="notFullHFFrom">
             {html_options options=$insuranceFromArr selected=$s_notFullHFFrom }
     </select>
    </td>
     <td>公积金欠款分摊方式</td>
    <td>
     <select style="width:150px;"  name="HFMoneyRecive">
             {html_options options=$insuranceMoneyReciveArr selected=$s_HFMoneyRecive}
     </select>
    </td> 
  </tr>
   <tr>
    <td>公积金垫付方式</td>
    <td>
     <select style="width:150px;"  name="HFModel">
             {html_options options=$insuranceModelArr selected=$s_HFModel }
     </select>
    </td>
    <td>单位类型</td>
    <td>
     <select style="width:150px;"  name="type">
             {html_options options=$typeArr selected=$s_type }
     </select>
    </td>
  </tr>
  <tr>
    <td colspan="4"><input type="submit" value="提交" /></td>
  </tr>
</table>
</from>
</fieldset>
</div>  
{include file="footer.tpl"}