{include file="header.tpl"}
<script type="text/javascript" src={$httpPath}lib/js/general.js>
</script>
{literal}
<script>
    $(document).ready(function(){
        // 生成社保,商保,互助会数据(createList.php,wsql.php)
        $(".createList").click(function(){
                var t, u, d, dt, m;
                t = "post";
                u = "aSQL.php";
                d = "btn=" + $(this).attr("name");
                dt = "json";
                m = function(json){
//					alert(json);
                    $.each(json, function(i, n){
                        switch (i) {
                            case "error":
                                alert(n);
                                break;
                            case "succ":
                                alert(n);
                                break;
                            case "type":
							   
                                $("#displayIFM iframe").empty().attr("src", "aDisplayList.php?type=" + n);
                                break;
                        }
                    });
                };
                ajaxAction(t, u, d, dt, m);
        });
    });
</script>
{/literal}
<div id="main">
	<fieldset>
            <legend>
                <code>各类申报表</code>
            </legend>
    <div>

        <input type="button" class="createList" name="soList" value="生成社保申报表" />
        <input type="button" class="createList" name="HFList" value="生成公积金申报表" />

    </div>
    <div id="displayIFM">
        <iframe frameborder=0 scrolling=0 width="100%" height="500px">
        </iframe>
    </div>
       </fieldset>
</div>
{include file="footer.tpl"}