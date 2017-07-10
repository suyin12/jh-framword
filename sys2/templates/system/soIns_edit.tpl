{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
<div id="mainBody">
     <fieldset>   
     {if $smarty.get.id}
     <form method="post" action="soIns_edit.php?id={$smarty.get.id}" >
     <input  name="edit" value="modify" type="hidden">
     {else}
     <form method="post" action="soIns_edit.php" >
     <input  name="edit" value="add" type="hidden">
     {/if}    
     <table class="myTable" width="100%">
        <tr>
            <td>类型编号</td>
            <td><input type="text" name="type" value="{$type}" {if $type}readonly{/if} /></td>
	  <td>类型名称</td>
	  <td><input type="text"  name="typename" value="{$typeName}"/></td>
        </tr>
	<tr>            
           <td>社平工资</td>
	  <td><input type="text"  name="societyAvg" value="{$societyAvg}"/></td>  
           <td>最低缴交</td>
           <td><input type="text" name="minRadix" value="{$minRadix}"/></td>
	</tr>
	<tr>            
           <td>社会最低工资标准</td>
           <td><input type="text" name="minSalaryAvg" value="{$minSalaryAvg}"/></td>
	</tr>
	<tr>
	  <td>单位养老</td>
	  <td><input type="text" name="uPension" value="{$uPension}"/></td>
            <td>个人养老</td>
	  <td><input type="text"  name="pPension" value="{$pPension}"/></td>      
	</tr>
	<tr>
	  <td>单位医疗</td>
	  <td><input type="text"  name="uHospitalization" value="{$uHospitalization}"/></td>
           <td>个人医疗</td>
	  <td><input type="text"  name="pHospitalization" value="{$pHospitalization}"/></td>       
	</tr>
    <tr>
	  <td>单位地方补充医疗</td>
	  <td><input type="text"  name="uLocalHospitalization" value="{$uLocalHospitalization}"/></td>
	  <td>个人地方补充医疗</td>
	  <td><input type="text"  name="pLocalHospitalization" value="{$pLocalHospitalization}"/></td>
	</tr>
	<tr>
      <td>单位失业</td>
	  <td><input type="text"  name="uUnemployment" value="{$uUnemployment}"/></td> 
	  <td>个人失业</td>
	  <td><input type="text"  name="pUnemployment" value="{$pUnemployment}"/></td>       
	</tr>
	<tr>
	  <td>单位工伤</td>
	  <td><input type="text"  name="uEmploymentInjury" value="{$uEmploymentInjury}"/></td>
	  <td>单位生育</td>
	  <td><input type="text"  name="uBirth" value="{$uBirth}"/></td>
           <td></td>
           <td></td>
	</tr>
	<tr>
	  <td colspan="4"><input type="submit" value="提交" /></td>
	</tr>
  </table>
</form>
</fieldset>
</div>  
{include file="footer.tpl"}