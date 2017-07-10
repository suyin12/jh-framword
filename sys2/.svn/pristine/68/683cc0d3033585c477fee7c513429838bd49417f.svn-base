{include file="w/header.tpl"}
<script type="text/javascript" src="{$httpPath}theme/lib/js/modal/XY_Base.js"></script>
{literal}
<script>
    $(document).ready(function () {
           //弹出窗登记身份证信息
        Util.loadJS("XY_Dialog.js",function(){
        $(".up_PersonInfo").each(function(){
            $(this).click(function(){
                var thisUrl=$(this).attr("alt");
                Util.Dialog({
                    title : "信息登记",
                    showbg:true,
                    width:"800px",
                    content : "iframe:"+thisUrl
                });
                return false;
              });
             });
        });
    //end  Jquery
    });
</script>
{/literal}
<div id="main">
    <div class="ym-wrapper">
        <div class="ym-wbox">
            <div class="ym-grid linearize-level-1">
                <div class="ym-g60 ym-gl">
                    <div class="ym-gbox-left ym-clearfix">
                        <section class="box">
                            <form method="get">
                                <input type="text" name="content" placeholder="输入姓名或者手机号码" value="">
                                <button class="ym-button ym-next" type="submit" name="match">查询</button>
                            </form>
                            <pre> 注:未登记身份证号码者，无法登录，需先完成登记</pre>
                            <table class="bordertable">
                                <thead>
                                <th>姓名</th>
                                <th>电话</th>
                                <th>岗位</th>
                                <th></th>
                                </thead>
                                <tbody>
                                {foreach from=$talentArr item=val}
                                <tr>
                                    <td>{$val.name}</td>
                                    <td>{$val.telephone|truncate:10:"xxxxx"}</td>
                                    <td>{$val.positionName}</td>
                                    <td>{if !$val.pID}<a class="up_PersonInfo"  alt="{$httpPath}w/up_personInfo.php?t={$val.talentID}">登记信息</a>
                                        {else}
                                        <a  href="{$httpPath}w/login/login.php">登录</a>
                                        {/if}
                                    </td>
                                </tr>
                                {/foreach}
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
                <aside class="ym-g33 ym-gr">
                    <div class="ym-gbox-right ym-clearfix">
                      <h4> 联系方式</h4>
                            <dl>
                            <dd>深圳市罗湖区湖贝路华佳广场2012</dd>
                            <dd>电话: 0755-82385383</dd>
                            </dl>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}