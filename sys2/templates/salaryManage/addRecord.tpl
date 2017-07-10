{include file="noLeftHeader.tpl"}
<script type="text/javascript" src={$httpPath}lib/jquery/jquery-1.6.2.min.js></script>
<script type="text/javascript" src={$httpPath}lib/js/general.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.validationEngine-zh_CN.js></script>
<script type="text/javascript" src={$httpPath}lib/js/jquery.validationEngine.js></script>
{literal}
    <script type="text/javascript">
    $(document).ready(function(){
    // binds form submission and fields to the validation engine
    $("#addOriginalFeeForm").validationEngine('attach', {promptPosition : "bottomLeft", autoPositionUpdate : true});
        
    //提交
        $(".sub").click(function(){
            var formID = this.form.id;
            var btnName = $(this).attr("name")
            var t, u, d, dt, m;
            t = "post";
            u = "salarySql.php";
            d = $("#" + formID).serialize() + "&btn=" + btnName ;
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
                            parent.window.location.href=document.referrer+"&m=name&c="+$("input[name=name]").val();
                            break;
                    }
                });
            };
            var ret = confirm("确定" + $(this).val() + "?");
            if (ret == true) {
                ajaxAction(t, u, d, dt, m);
            }
        });
             
   });
    </script>
{/literal}
<div id="mainBody">
    <fieldset>
        <legend><code>添加新人员</code></legend>
        <form id="addOriginalFeeForm">
            <input type="hidden" name="a" value="{$a}" />
            {foreach from=$ret item=v key=k}
                <input type="hidden" name="{$k}" value="{$v}" />
            {/foreach}    
            <table class="myTable">
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>员工编号</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="name" class="validate[required]" value="" /></td>
                        <td><input type="text" name="uID" class="validate[required]" /></td>
                        <td><input type="button" class="sub" name="addOriginalFee_tmpBtn" value="添加" /></td>
                    </tr>
                </tbody>
            </table>
        </form>   
    </fieldset>
</div>
<script>
       $('#loading').fadeOut("slow"); 
</script>
