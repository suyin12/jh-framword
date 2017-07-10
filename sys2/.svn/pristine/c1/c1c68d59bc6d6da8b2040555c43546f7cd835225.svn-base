//soSoInsList.tpl
$(document).ready(function(){
	//select-> change get 提交
    formSubmit("", "select[name=batch]", "change", ".conditionForm");
    
    formSubmit("","select[name=zhuanyuan]","change",".conditionForm");
    
    // 判断select选项是否重复
    $(".sub").click(function(){
        var formID = this.form.id;
        var btnName = $("#" + formID + " :button").attr("name")
        var t, u, d, dt, m;
        t = "post";
        u = "soSql.php";
        d = $("#" + formID).serialize() + "&btn=" + btnName;
        dt = "json";
        m = function(json){
            var i, n, k, v;
            $.each(json, function(i, n){
                switch (i) {
                    case "error":
                    case "error2":
                        alert(n);
                        break;
                    case "succ":
                        alert(n);
                        window.location.reload();
                        break;
                }
            });
        };
        var ret = confirm("确定" + $(this).val() + "?");
        if (ret == true) {
            var valid = isChecked("input[name=chkList[]]") ;
            if (valid != true) {
                ajaxAction(t, u, d, dt, m);
            }else{
				alert("请在要操作的数据行上打钩");
			}
        }
    });
});
