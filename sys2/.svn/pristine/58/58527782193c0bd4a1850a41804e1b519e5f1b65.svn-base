//包含页面 wChangeSurvey.php
$(document).ready(function(){
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
    //查询特殊新增的员工信息
    $(".spBtn").click(function(){
        var queryString = window.location.href;
        var newUrl=RegularUrl(queryString ,"spBT", $("input[name=spBT]").val() );
         newUrl=RegularUrl(newUrl,"spET", $("input[name=spET]").val() );
        window.location.href = newUrl;
    });
    //构造生成条件框函数
    function condition(model){
        var year, month, date, lastMonth, lmd, ly, lm, ld;
        var today = new Date();
        year = today.getFullYear();
        month = today.getMonth();
        date = today.getDate();
        time = today.getTime();
        if((today.getMonth() - 1)>=0)
      		  today.setMonth(today.getMonth() - 1);
		else
		     today.setMonth(today.getMonth());
        ly = today.getFullYear();
        lm = today.getMonth() + 1;
        ld = today.getDate();
        if (ld > 19&(today.getMonth()-1)>=0) 
            lm = today.getMonth() + 2;
        
        var m = model;
        var condition, sel;
        switch (m) {
            case "date":
                var bT, eT;
                bT = getQuery("bT");
                eT = getQuery("eT");
                
                if (bT && eT) {
                    condition = "<input class='req-string req-date' type='text' name=bT value= '" + bT + "'> 到 <input class='req-string req-date' type='text' name=eT value='" + eT + "'>(例如:2010-01-02)";
                }
                else {
                    condition = "<input class='req-string req-date' type='text' name=bT value= '" + ly + "-" + lm + "-20'> 到 <input class='req-string req-date' type='text' name=eT value='" + year + "-" + (month + 1) + "-" + date + "'>(例如:2010-01-02)";
                }
                break;
            case "month":
                var selMon, getMon, monVal;
                getMon = getQuery("mon");
                
                if (getMon) {
                    selMon = getMon;
                }
                else {
                    if (date < 19) 
                        selMon = year + '-' + (month + 1) + "-19";
                    else 
                        selMon = year + '-' + (month + 2) + "-19";
                }
                condition = "<select name=mon class='req-string'><option value=''>--月份--</option>";
                for (i = 1; i <= 12; i++) {
                    sel = "";
                    monVal = year + '-' + i + "-19";
                    if (monVal == selMon) {
                        sel = "selected";
                    }
                    condition += "<option value= '" + monVal + "' " + sel + ">" + year + "年" + i + "月</option>";
                }
                condition += "</select>(提示:上月20号到该月19号 为一个月)";
                break;
        }
        $(".inputCon").empty();
        $(".inputCon").append(condition);
    }
    
    
    
    //构造生成的条件框
    $(":radio[name=m]").ready(function(){
        var model = $(":radio[name=m]:checked").val();
        condition(model);
    });
    //改变radio相应的生成条件框
    $(":radio[name=m]").click(function(){
        var model = $(this).val();
        //不知为何函数调用失效,哎悲剧,只能写一大堆..日
        condition(model);
    });
    
    //验证条件
    $("input[name=wCS]").ready(function(){
        validator("input[name=wCS]", "#wCSForm", "#errorDiv");
    });
    
    //查看
    $(".alertData").click(function(){
        var js_data, appendStr;
        js_data = $(this).attr("datasrc")
        js_data = eval(js_data);
        appendStr = "";
        $.each(js_data, function(i, n){
            appendStr += "<tr>";
            $.each(n, function(x, y){
                switch (x) {
                    case "name":
                        appendStr += "<td> <a href=wPersonInfoList.php?uID=" + n.uID + " target='_blank'>" + y + "</a></td>";
                        break;
                    case "uID":
                    case "unitName":
                    case "mountGuardDay":
                    case "soInsModifyDate":
                        appendStr += "<td>" + y + "</td>";
                        break;
                    case "housingFund":    
                    case "soInsurance":
                    case "comInsurance":
                    case "helpCost":
                        if (!y || y == "0") {
                            y = "否";
                        }
                        else 
                            if (y == "1") {
                                y = "参加";
                            }
                            else 
                                if (y == "2") {
                                    y = "修改";
                                }
                        appendStr += "<td>" + y + "</td>";
                        break;
                }
            });
            appendStr += "</tr>";
        });
        
        $("#jsData tbody").empty().html(appendStr);
        tipsWindown("查看详情", "id:jsData", "900", "580", "true", "", "true", "leotheme");
    });
    
    
    //全选反选
    $(".chkAll").click(function(){
        var cC, aC;
        var formName = this.form.name;
        var chkName = formName.replace("Form", "");
        cC = this;
        aC = ':checkbox[name^=' + chkName + 'Check]';
        checkAll(cC, aC);
    })
    //社保选项全选、反选
	$(".rePensionAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("class");
        var chkName = thisName.replace("All", "");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
    });
	$(".reEmploymentInjuryAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("class");
        var chkName = thisName.replace("All", "");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
    });
	$(".reUnemploymentAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("class");
        var chkName = thisName.replace("All", "");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
    });
	$(".reHousingAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("class");
        var chkName = thisName.replace("All", "");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
    });
	$(".rePDInsAll").click(function(){
        var cC, aC;
        var thisName = $(this).attr("class");
        var chkName = thisName.replace("All", "");
        cC = this;
        aC = '.' + chkName ;
        checkAll(cC, aC);
    });
	
    //AJAX 更新提交
    $(".updateBtn").click(function(){
        var formName = this.form.name;
        var chkName = formName.replace("Form", "");
        chkName = ':checkbox[name^=' + chkName + 'Check]';
        var t, u, d, dt, m;
        t = "post";
        u = "wSql.php";
        d = $("#" + formName).serialize() + "&update=wCS&btn=" + $("#" + formName + " :button").attr("name");
        dt = "json";
        m = function(json){
            var i, n, k, v;
            
            $.each(json, function(i, n){
                switch (i) {
                    case "error":
                        alert(n);
                        break;
                    case "succ":
                        $.each(n, function(k, v){
                            switch (k) {
                                case "num":
                                    alert(v);
                                    window.location.reload();
                                    break;
                            }
                        });
                        break;
                }
            });
            
        };
        if (isChecked(chkName) == false) {
            if (formName == "soForm" || formName == "spSoForm") {
                successFun = function(){
                    ajaxAction(t, u, d, dt, m);
                }
                validator("input[name=soBtn]", "#soForm", "#errorDiv", successFun);
            }
            else {
                ajaxAction(t, u, d, dt, m);
            }
        }
        else {
            alert("请勾选要操作的数据");
        }
        
    });
    
    //处理返回的JSON数组,生成Alert信息
    
    
    //数据最后确认后提示
    $("#confirm").click(function(){
        ret = confirm("确认数据无误,生成相应清单吗?");
        if (ret == true) {
            location.href = "createList.php";
        }
        else {
            return false;
        }
    });
    
	//批量生成再次购买日期
	    $(".reNewSoInsDate").one("click", function(){
	        $(this).val("");
	    });
	    $(".reNewSoInsDateAll").blur(function(){
	        var value = $(this).val();
	        if (!IsEmpty(value)) 
	            $(".reNewSoInsDate").val(value);
	    });
    //end
});
