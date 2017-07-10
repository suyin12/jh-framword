{include file="w/noNavHeader.tpl"}
<script type="text/javascript" src={$httpPath}theme/lib/js/validation/jquery.validationEngine.js></script>
<script type="text/javascript" src={$httpPath}theme/lib/js/validation/jquery.validationEngine-zh_CN.js></script>
<script type="text/javascript" src={$httpPath}theme/lib/js/general.js></script>
{literal}
<script>
    $(document).ready(function(){
        //表格输入验证
        $("#up_personInfoForm").validationEngine();
        $(":button").click(function(){
            var status = $("#up_personInfoForm").validationEngine('validate');
            if(status){
                var formID = this.form.id;
                var btnName = $(this).attr("name")
                var t, u, d, dt, m;
                t = "post";
                u = "web_wSql.php";
                d = $("#" + formID).serialize() + "&btn=" + btnName +"&tID="+getQuery("t") ;
                dt = "json";
                m = function (json) {
                    var i, n, k, v;
                    $.each(json, function (i, n) {
                        switch (i) {
                            case "error":
                                $("#msg").removeClass();
                                    $("#msg").addClass("box").addClass("error");
                                    $(".ym-message").text(n);
                                break;
                            case "succ":
                                $("#msg").removeClass();
                                $("#msg").addClass("box").addClass("success");
                                n= n+ ",点击<a href='login/login.php' target='_blank'>这里登录</a>";
                                $(".ym-message").html(n);
                                break;
                        }
                    });
                };
                ajaxAction(t, u, d, dt, m);
            }
        });
    });
</script>
{/literal}
<div id="main">
    <div class="ym-wrapper">
        <div class="ym-wbox">
            <section style="min-height:50px;">
                <div id="msg">
                    <p class="ym-message"></p>
                </div>
            </section>
            <section>
            <form id="up_personInfoForm" class="pre-form">
                <label for="idCard">身份证</label>
                <input type="text" name="idCard" class="validate[required,maxSize[18],minSize[18]]" placeholder="18位身份证号码" id="idCard" />
                <label for="telephone"  >手机</label>
                <input type="text" name="telephone" id="telephone" class="validate[required,custom[integer],maxSize[11],minSize[11]]" />
                <button class="ym-button ym-save" type="button" name="up_personInfoBtn">确定</button>
            </form>
            </section>
        </div>
    </div>
</div>

{include file="footer.tpl"}