//包含页面 wMountGuard.php ,wInfo.php,wPersonInfo.php,createList.php
$(document).ready(function(){
    //动态生成员工编号(根据选择单位)
    $("select[name=unitID]").change(function(){
        if (!$(this).val()) {
            $("input[name=uID]").val("请选择单位")
        }
        else {
            var t = "post";
            var u = "wSql.php";
            var d = "unitID=" + $(this).val() + "&oldUnitID=" +
            $("input[name=oldUnitID]").val() +
            "&oldUID=" +
            $("input[name=oldUID]").val();
            var dt = "html";
            m = function(msg){
                $("input[name=uID]").val(msg)
                $('#loading').fadeOut("slow");
            }
            ajaxAction(t, u, d, dt, m);
        }
    });
    
    // 员工信息更新
    $("input[name=wUP]").click(function(){
        successFun = function(){
            var t = "post";
            var u = "wSql.php";
            var d = $("#wUPForm").serialize() + "&wUP=1";
            var dt = "html";
            m = function(data){
                $('#loading').fadeOut("slow");
                alert(data);
            }
          //验证社保购买项
            var vSoIns = validSoIns();
            if (IsEmpty(vSoIns)) {
                if (vSoIns != false) 
                    ajaxAction(t, u, d, dt, m);
            }
            else {
                var ret = confirm(vSoIns);
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            }
        }
        validator("input[name=wUP]", "#wUPForm", "#errorDiv", successFun);
    });
    // 员工入职登记
    $("input[name=wMG]").click(function(){

        successFun = function(){
            var t = "post";
            var u = "wSql.php";
            var d = $("#wMGForm").serialize() + "&wMG=1";
            var dt = "html";
            
            var m = function(data){
                $('#loading').fadeOut("slow");
                alert(data);
            };
            //验证社保购买项
            var vSoIns = validSoIns();
            if (IsEmpty(vSoIns)) {
                if (vSoIns != false) 
                    ajaxAction(t, u, d, dt, m);
            }
            else {
                var ret = confirm(vSoIns);
                if (ret == true) {
                    ajaxAction(t, u, d, dt, m);
                }
            }
        }
        validator("input[name=wMG]", "#wMGForm", "#errorDiv", successFun);
    });
    
    
    
    

    
    
    
    
    // 员工信息查询
    $("input[name=c]").one("click", function(){
        $(this).val("");
    });
    $("input[name=wS]").click(function(){
        successFun = function(){
            $("#wSForm").submit();
        }
        validator("input[name=wS]", "#wSForm", "#errorDiv", successFun);
    });
    // 全选/反选
    $('#CK').click(function(){
        if ($(this).attr('checked') == true) {
            $(".ckb").attr('checked', true);
        }
        else {
            $('.ckb').attr('checked', false);
        }
    });
    
    // 客户经理/单位二级联动
    $("select[name=mID]").change(function(){
        var j_d = $(".j_unitManager").val();
	        j_d = eval(j_d);
        
        $.each(j_d, function(i, n){
            if ($("select[name=mID]").val() == n.mID) {
                $("select[name=unitID] option:not(:eq(0))").remove();
                $.each(n.unit, function(j, v){
                    $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                    v.unitName +
                    "</option>");
                });
                
            }
            if (!$("select[name=mID]").val()) {
                $.each(n.unit, function(j, v){
                    $("select[name=unitID]").append("<option value=" + v.unitID + ">" +
                    v.unitName +
                    "</option>");
                });
            }
        });
        
    });
    
    //筛选条件的POST提交.. wInfo.php
    $(".selPost").change(function(){
        $(".selForm").submit();
    });
    
    //更改员工户籍类型,社保状态随之更改.. wMountGuard.php
    $("select[name=domicile]").change(function(){
        var domicileVal = $(this).val();
        var typeVal = $("select[name=type]").val();
        if (IsEmpty(typeVal)) {
            alert(" 请选择员工类型 ");
        }
        else {
            switch (domicileVal) {
                //深户,如果是全日制员工默认四险(综合),非全日制则为工伤
                case "1":
                    if (typeVal == "1") {
                        $(".soInsField").each(function(i){
                            switch (i) {
                                case 0:
                                case 2:
                                case 5:
                                case 6:
                                    $(this).attr("checked", true);
                                    break;
                                default:
                                    $(this).attr("checked", false);
                                    break;
                            }
                            
                        });
                    }
                    if (typeVal == "2") {
                        $(".soInsField").each(function(i){
                            switch (i) {
                                case 5:
                                    $(this).attr("checked", true);
                                    break;
                                default:
                                    $(this).attr("checked", false);
                                    break;
                            }
                        });
                    }
                    break;
                //非深户,如果是全日制员工默认四险(住院),非全日制则为工伤
                case "2":
                    if (typeVal == "1") {
                        $(".soInsField").each(function(i){
                            switch (i) {
                                case 0:
                                case 3:
                                case 5:
                                case 6:
                                    $(this).attr("checked", true);
                                    break;
                                default:
                                    $(this).attr("checked", false);
                                    break;
                            }
                        });
                    }
                    if (typeVal == "2") {
                        $(".soInsField").each(function(i){
                            switch (i) {
                                case 5:
                                    $(this).attr("checked", true);
                                    break;
                                default:
                                    $(this).attr("checked", false);
                                    break;
                            }
                        });
                    }
                    break;
            }
        }
    });
    
    //更改医疗模式,错误:深户购买非综合医疗报错,提示性警告:非深户可购买综合,或合作医疗时
    function validSoIns(){
        var hospitalizationVal = $(":radio[name=hospitalization]:checked").val();
        var domicileVal = $("select[name=domicile]").val();
        //        var typeVal = $("select[name=type]").val();
		var emptyHosp = IsEmpty(hospitalizationVal);
        var errMsg;
		if(emptyHosp !=true){
        if (domicileVal == "1" && hospitalizationVal != "1") {
            errMsg = "该员工为深户只能购买综合医疗!!";
            alert(errMsg);
            return false;
        }
        if (domicileVal == "2" && hospitalizationVal != "2") 
            errMsg = "该员工为非深户,确定不购买住院医疗?";
		}
        return errMsg;
		
    }
    
});
