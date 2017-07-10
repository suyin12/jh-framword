{literal}
<script type="text/javascript">
    $(document).ready(function () {
        $("#addToTemp").click(function () {
            //获取操作数据的json
            var tempJsonTxt = $("input[name=tempJson]").val();
            var tempJson = eval(tempJsonTxt);
            tempJson.reverse();
            // Ajax提交到服务器
            var t, u, d, dt, m;
            t = "post";
            u = "http://" + window.location.host + "/tempManage/tempSQL.php";
            d = "tempJsonTxt=" + tempJsonTxt + "&btn=addToTemp";
            dt = "json";
            m = function (json) {
                var i, n;
                $.each(json, function (i, n) {
                    switch (i) {
                        case "error":
                            break;
                        case "succ":
                            //获取操作数据的json
                            addToTemp($(".basket"), n);
                            break;
                    }
                });
            };
            ajaxAction(t, u, d, dt, m);

        });


        // This function runs onc ean item is added to the basket
        function addToTemp(basket, json) {
            basket.css("display", 'block');
            $.each(json, function (i, n) {
                switch (n.whichID) {
                    case "talentID":
                        var link = "http://" + window.location.host + "/recruitManage/tUpdate.php?tid=" + n.value;
                        break;
                    case "uID":
                        var link = "http://" + window.location.host + "/workerInfo/wManage.php?uID=" + n.value;
                        break;
                }
                basket.find("ul").prepend('<li data-whichID="' + n.whichID + '" data-value="' + n.value + '">'
                        + '<span class="name"><a href="' + link + '" target="_blank">' + n.nameTxt + '</a></span>'
                        + '<a class="delete negative">&#10005;</a></li>');
            });
        }


        // The function that is triggered once delete button is pressed
        $(".basket ul li a.delete").live("click", function () {
            var tempJsonTxt=$(this).closest("li").attr("data-whichID")+"|"+$(this).closest("li").attr("data-value");
            // Ajax提交到服务器
            var t, u, d, dt, m;
            t = "post";
            u = "http://" + window.location.host + "/tempManage/tempSQL.php";
            d = "tempJsonTxt=" + tempJsonTxt + "&btn=deleteFromTemp";
            dt = "json";
            m = function (json) {
                var i, n;
                $.each(json, function (i, n) {
                    switch (i) {
                        case "error":
                            break;
                        case "succ":
                            //获取操作数据的json
                            $("li[data-value="+n+"]").remove();
                            break;
                    }
                });
            };
            ajaxAction(t, u, d, dt, m);
        });

    });
</script>
<style>
    #tempSidebar {
        width: 100px;
        position: fixed;
        right: 0px;
        top: 100px;
    }

    #tempSidebar .basket {
    }

    #tempSidebar .basket ul li {
        margin: 0 0 0 5px;
        line-height: 20px;
    }

    #tempSidebar .basket  .delete {
        margin: 0 0 0 30px;
    }

</style>
{/literal}

<aside id="tempSidebar">
    <fieldset>
    <div>
        <a id="addToTemp" class="aSub positive">添</a>
        <a href="{$httpPath}tempManage/tempAction.php" class="aSub positive">动</a>
    </div>
    <div class="basket">
        <div class="basket_list">
            <ul>
            {foreach from=$tempJsonArr key=key item=val}
                {switch $key}
                {case "talentID"}
                  {foreach from=$val item=v}
                      <li data-whichID="{$v.whichID}" data-value="{$v.value}">
                          <span class="name"><a href="{$httpPath}{$v.link}" target="_blank">{$v.nameTxt}</a></span>
                          <a class="delete negative">&#10005;</a>
                      </li>
                  {/foreach}
                {/case}
                {/switch}
            {/foreach}
            </ul>
        </div>
    </div>
    </fieldset>
</aside>