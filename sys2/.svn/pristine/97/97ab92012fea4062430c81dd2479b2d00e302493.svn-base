<script type="text/javascript" src="{$webHttpPath}/theme/lib/jquery/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>

<script type="text/javascript">
    //显示隐藏按钮
    $(document).ready(function () {
        $("button").hide();
        $("#btnNext").mouseenter(function () {
            $("button").show();
        });
        $("#btnNext").mouseleave(function () {
            $("button").hide();
        });
        //审核通过
        $("#btnPass").click(function () {
            var btnName = 'btnPass';
            var wID = $("input[name=wID]").val();
            var t, u, d, dt, m;
            t = "post";
            u = "web_wSql.php";
            d = "&btnPass=" + btnName + "&wID=" + wID;
            dt = "json";
            m = function (json) {
                var i, n;
                $.each(json, function (i, n) {
                    switch (i) {
                        case "error":
                            alert(n);
                            break;
                        case "succ":
                            alert(n);
                            break;
                    }

                });
            };
            var ret = confirm("确定审核通过?" + $(this).val() + "?");
            if (ret == true) {
                ajaxAction(t, u, d, dt, m);
            }
        });
        //转交下一步
        $("#btnDeliver").click(function () {
            var btnName = 'btnDeliver';
            var wID = $("input[name=wID]").val();
            var positionID = $("input[name=position]").val();
            var status = $("input[name=status]").val();
            var talentID = $("input[name=talentID]").val();
            var t, u, d, dt, m;
            t = "post";
            u = "web_wSql.php";
            d = "&btnDeliver=" + btnName + "&wID=" + wID +"&positionID=" + positionID + "&status=" + status +"&talentID=" + talentID ;
            dt = "json";
            m = function (json) {
                var i, n;
                $.each(json, function (i, n) {
                    switch (i) {
                        case "error":
                            alert(n);
                            break;
                        case "succ":
                            alert(n);
                            break;
                    }

                });
            };
            var ret = confirm("确定转交下一步?" + $(this).val() + "?");
            if (ret == true) {
                ajaxAction(t, u, d, dt, m);
            }
        });

    })
</script>


<div id="btnNext">
    <button type="button" class="ym-button" id="btnPass">通过</button>
    <button type="button" class="ym-button" id="btnDeliver">转交</button>
</div>
