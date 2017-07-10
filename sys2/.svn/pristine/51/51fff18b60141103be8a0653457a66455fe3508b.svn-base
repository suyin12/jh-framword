//salaryManage/createNewZFormat.tpl
$(document).ready(function(){
    $("input[name=addCol]").one("click", function(){
        alert("增加或删除列,都将清除您未保存的信息");
    });
     //提交
	    $(".aSub").click(function(){
	        var btnName = $(this).attr("name");
			var zID= $(this).attr("title");
	        var t, u, d, dt, m;
	        t = "post";
	        u = "salarySql.php";
	        d =  "btn=" + btnName + "&zID="+zID;
	        dt = "json";
	        m = function(json){
	            var i, n, k, v;
	            $.each(json, function(i, n){
	                switch (i) {
	                    case "error":
	                        alert(n);
	                        break;
	                    case "succ":
	                        alert(n);
	                        window.location.reload();
	                        break;
	                }
	            });
	        };
	        var ret = confirm("确定" + $(this).text() + "?");
	        if (ret == true) {
	            ajaxAction(t, u, d, dt, m);
	        }
	    });
    // 判断select选项是否重复
    $(".sub").click(function(){
        var formID = this.form.id;
        var btnName = $(this).attr("name")
        var t, u, d, dt, m;
        t = "post";
        u = "salarySql.php";
        d = $("#" + formID).serialize() + "&btn=" + btnName;
        dt = "json";
        m = function(json){
            var i, n, k, v;
            $.each(json, function(i, n){
                switch (i) {
                    case "error":
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
            var valid = validRepeat("select");
            if (valid == true) {
                ajaxAction(t, u, d, dt, m);
            }
        }
    });
    
});
