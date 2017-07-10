{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.4.2.min.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.ufvalidator.1.0.1.min.js>
</script>
{literal}
<script>
        $(document).ready(function(){
                 $("select[name=zID]").change(function(){
                        var val=$(this).val();
                        if(val=="newZF"){
                                window.open('manageZF.php');
                        }
                        });
                  $("input[name=create]").click(function(){
                    successFun = function(){
                        $("#choseForm").submit();
                    }
                    validator("input[name=create]", "#choseForm", "#errorDiv", successFun);
                });   
        //选择是奖金,或者是工资费用
                $(".tab").each(function(i){
                        var process=getQuery('process');
                    var proSel = $(this).attr('alt');
                        if(process==proSel){
                           $(this).parent().css({'background':'#eddece'});
                        }
                });
        });
</script>
{/literal}
<div id="mainBody">
    <div style="padding-left:30px;margin:20px 0 50px 30px;" class="tabLayout">
        <div style="float:left; width:20%;" class="block" >
            <a class="tab" alt='salary'   href="{$httpPath}salaryManage/salaryZFChose.php?process=salary&mID={$smarty.get.mID}&unitID={$smarty.get.unitID}">工资费用</a>
        </div>
        <div style="float:left;width:20%;margin-left:30px " class="block" >
            <a  class="tab"  alt='reward'   href="{$httpPath}salaryManage/salaryZFChose.php?process=reward&mID={$smarty.get.mID}&unitID={$smarty.get.unitID}">奖&nbsp;&nbsp;&nbsp;&nbsp;金</a>
        </div>
        <div style="float:left;width:20%;margin-left:30px " class="block" >
            <a  class="tab"  alt='createFee'   href="{$httpPath}salaryManage/salaryZFChose.php?process=createFee&mID={$smarty.get.mID}&unitID={$smarty.get.unitID}">核算劳务费用</a>
        </div>
    </div>
    <div>
        <form action="{$url}" id="choseForm" class="form" method="get" {if $smarty.get.process eq 'createFee'}target='_blank'{/if}>
            {if $smarty.get.process neq 'createFee'} 
                  {if $smarty.get.process eq 'salary'}     
                <input type="checkbox" name="mulFee" value="mul" />非首次工资 
                {/if}
            <select class="req-string" name="zID">
                <option value="">请选择帐套</option>
                <option value="newZF">新建/修改帐套</option>
	   {html_options options=$ZFArr selected=$s_zID}
            </select>
            {/if}
            <select class="req-string" name="month">
                <option value="">费用产生年月</option>
		{html_options options=$DateArr selected=$s_monthDate}
            </select>
	  {if $smarty.get.process eq 'salary' or $smarty.get.process eq 'createFee'}
            <select class="req-string" name="salaryDate">
                <option value="">工资年月</option>
		{html_options options=$DateArr selected=$s_salaryDate}
            </select>
            <select class="req-string" name="soInsDate">
                <option value="">社保年月</option>
		{html_options options=$DateArr selected=$s_soInsDate}
            </select>
            <select class="req-string" name="HFDate">
                <option value="">公积金年月</option>
		{html_options options=$DateArr selected=$s_HFDate}
            </select>
            <select class="req-string" name="comInsDate">
                <option value="">商保年月</option>
		{html_options options=$DateArr selected=$s_comInsDate}
            </select>
            <select class="req-string" name="managementCostDate">
                <option value="">管理费年月</option>
		{html_options options=$DateArr selected=$s_managementCostDate}
            </select>
            <input type="hidden" name="a" value="salaryMulInsert">
	  {elseif $smarty.get.process eq 'reward'}
            <select class="req-string" name="rewardDate">
                <option value="">奖金年月</option>
		{html_options options=$DateArr selected=$s_rewardDate}
            </select>
            <input type="hidden" name="a" value="rewardMulInsert">
	  {/if}
            <input type="hidden" name="unitID" value="{$smarty.get.unitID}">
            <input type="button" name="create" value="确定">
            <div id="errorDiv" class="error-div-alternative">
            </div>
        </form>
    </div>
</div>
</div>
{include file="footer.tpl"}