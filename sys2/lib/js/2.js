$(document).ready(function(){

 // 生成社保,商保,互助会数据(createList.php,wsql.php)
    $(".createList").click(function(){
//        alert("111");
        ret = confirm("确定要生成该月数据吗?");
        if (ret == true) {
            var t, u, d, dt, m;
            t = "post";
            u = "wsql.php";
            d = "insert=cL&btn=" + $(this).attr("name");
            dt = "json";
            m = function(json){
                $.each(json, function(i, n){
                    if (i == "error") {
                        $.each(n, function(k, v){
                            alert(v);
                        });
                    }
                    if (i == "succ") {
                        $.each(n, function(k, v){
                            switch (k) {
                                case "num":
                                    alert(v);
                                    window.location.reload()
                                    break;
                            }
                        });
                    }
                });
            };
            ajaxAction(t, u, d, dt, m);
        }
        else {
            return false;
        }
    });
    
});
