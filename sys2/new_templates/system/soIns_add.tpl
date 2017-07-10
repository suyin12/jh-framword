{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.5.2.min.js></script>
<div id="mainBody">
     <fieldset>   
    <form method="post" action="soIns_edit.php?id={$smarty.get.id}">
                <input  name="edit" value="add" type="hidden">
                <table class="myTable" width="100%">
                    <tr>
                        <td>类型编号</td>
                        <td><input type="text" id="soInsType" name="soInsType" /></td>
                        <td>类型名称</td>
                        <td><input type="text" id="txttypename" name="txttypename" /></td>
                    </tr>
                    <tr>
                        <td>社平工资</td>
                        <td><input type="text" id="txtsocietyAvg" name="txtsocietyAvg" /></td>
                        <td>最低缴交</td>
                        <td><input type="text" id="txtminRadix" name="txtminRadix" /></td>
                    </tr>
                    <tr>
                        <td>单位养老</td>
                        <td><input type="text" id="txtuPension" name="txtuPension" /></td>
                        <td>个人养老</td>
                        <td><input type="text" id="txtpPension" name="txtpPension" /></td>
                    </tr>
                    <tr>
                        <td>单位医疗</td>
                        <td><input type="text" id="txtuHospitalization" name="txtuHospitalization" /></td>
                        <td>个人医疗</td>
                        <td><input type="text" id="txtpHospitalization" name="txtpHospitalization" /></td>
                    </tr>
                     <tr>
                        <td>单位合作医疗金额</td>
                        <td><input type="text" id="txtuCooperate" name="txtuCooperate" /></td>
                        <td>个人合作医疗金额</td>
                        <td><input type="text" id="txtpCooperate" name="txtpCooperate" /></td>
                    </tr>
                    <tr>
                        <td>单位工伤</td>
                        <td><input type="text" id="txtuEmploymentInjury" name="txtuEmploymentInjury" /></td>
                        <td>单位失业</td>
                        <td><input type="text" id="txtuUnemployment" name="txtuUnemployment" /></td>
                    </tr>
                    <tr>
                        <td>单位生育</td>
                        <td><input type="text" id="txtuBirth" name="txtuBirth" /></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" ><input type="submit" value="添加" /></td>
                    </tr>
                </table>
            </form>
</fieldset>
</div>  
{include file="footer.tpl"}