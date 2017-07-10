{include file="header.tpl"}
<style>
.layui-layer-hui {
    min-width: 100px;
    background-color: #000;
    filter: alpha(opacity=60);
    background-color: rgba(0,0,0,0.6);
    color: #fff;
    border: none;
}
.layui-layer-msg {
    min-width: 180px;
    border: 1px solid #D3D4D3;
    box-shadow: none;
}
.layui-layer-dialog {
    min-width: 260px;
}
.layer-anim {
    -webkit-animation-name: bounceIn;
    animation-name: bounceIn;
}
.layui-layer {
    border-radius: 2px;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    -webkit-animation-duration: .3s;
    animation-duration: .3s;
}
.layui-layer-border {
    border: 1px solid #B2B2B2;
    border: 1px solid rgba(0,0,0,.3);
    box-shadow: 1px 1px 5px rgba(0,0,0,.2);
}
.layui-layer {
    top: 150px;
    left: 0;
    margin: 0;
    padding: 0;
    /*background-color: #fff;*/
    -webkit-background-clip: content;
    box-shadow: 1px 1px 50px rgba(0,0,0,.3);
}
.layui-layer-shade, .layui-layer {
    position: fixed;
    _position: absolute;
    pointer-events: auto;
}

.layui-layer-hui .layui-layer-content {
    padding: 12px 25px;
    text-align: center;
}
.layui-layer-dialog .layui-layer-content {
    position: relative;
    padding: 20px;
    line-height: 24px;
    word-break: break-all;
    overflow: hidden;
    font-size: 14px;
    margin-top: 18px;
    /*overflow: auto;*/
}
.layui-layer-content {
    position: relative;
}
/*body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, input, button, textarea, p, blockquote, th, td, form {
    margin: 0;
    padding: 0;
}
user agent stylesheet
div {
    display: block;
}*/
Inherited from div#layui-layer20.layui-layer.layer-anim.layui-layer-dialog.layui-layer-border.layui-layer-msg.layui-layer-hui
.layui-layer-hui {
    min-width: 100px;
    background-color: #000;
    filter: alpha(opacity=60);
    background-color: rgba(0,0,0,0.6);
    color: #fff;
    /* border: none; */
}
.layui-layer-setwin {
    position: absolute;
    right: 15px;
    top: 15px;
    font-size: 0;
    line-height: initial;
}
.layui-layer-btn {
    text-align: right;
    padding: 0 10px 12px;
    pointer-events: auto;
}
.layui-layer-btn {
    text-align: right;
    padding: 0 10px 12px;
    pointer-events: auto;
}
.layui-layer-btn a {
    height: 28px;
    line-height: 28px;
    margin: 0 6px;
    padding: 0 15px;
    border: 1px #dedede solid;
    background-color: #f1f1f1;
    color: #333;
    border-radius: 2px;
    font-weight: 400;
    cursor: pointer;
    /*text-decoration: none;*/
    text-decoration:none;
}
.layui-layer-btn .layui-layer-btn0 {
    border-color: #4898d5;
    background-color: #2e8ded;
    color: #fff;
    float: left;
    margin-bottom: 33px;
}
a.layui-layer-btn1{
    float:right;
}
.check_a{
    border: 1px solid #949494;
   /* padding-left: 6px;
    padding-right: 6px;}*/
    padding:1px 6px;
        background: #DFDFDF;

}
a:hover{
   text-decoration:none;
</style>
{literal}

    <script type="text/javascript">
        $(document).ready(function(){
            $("input[name=c]").one("click", function(){
                $(this).val("");
                $(":checkbox[name=s_status_stop]").attr("checked",false);
            });
            $("select[name=status]").change(function(){
                var t=$(this).val();
                if(t=="0"){
                    $(":checkbox[name=s_status_stop]").attr("checked",false);
                }else{
                    $(":checkbox[name=s_status_stop]").attr("checked",true);
                }
            });
        });
    </script>
{/literal}
<div id="main">
    <fieldset>
        <div class="left">
            <form name="searchArchives" method="get" action="{$actionURL}">
                <table height="70px">
                    <tr>
                        <td colspan="2">
                            <strong>请选择查询条件</strong>
                            <select name="m">{html_options options=$modelArr selected=$s_m}</select>
                            <input type="text" name="c" value="{$s_c}"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>状态</strong>
                            <select name="status">
                                <option value="">--请选择--</option>
                                {html_options options=$statusArr selected=$s_status}
                            </select>
                        </td>
                        <td>
                            　<input style="background: #dfdfdf;border:1px solid #949494;" type="submit" value="查询"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </fieldset>
    <div>
        <fieldset>
            <form name="expressNumber" method="get" action="proveCheck.php">
            <legend><code>结果</code></legend>
            <table class="myTable">
                <tr>
                    <th>姓名</th>
                    <th>状态</th>
                    <th>身份证号</th>
                    <th>申请证明类型</th>
                    <th>申请时间</th>
                    <th>操作</th>
                </tr>
                {foreach item=sa key=key from=$wUserArr}
                        <tr>
                            <td><a href="#">{$sa.name}</a></td>
                            <td>{if $sa.status=="0"}未审核{elseif $sa.status=="1"}已审核{elseif $sa.status=="99"}回退{elseif $sa.status=="2"}已邮寄{/if}</td>
                            <td>{$sa.pID}</td>
                            <td>{$sa.provetype}</td>
                            {*<td><a href="personalInfo.php?fID={$sa.fID}"></a></td>*}
                            {*<td>{if $sa.mCost=="0"}免{else}{$sa.mCost}{/if}</td>*}
                            <td>{$sa.createtime}</td>
                            <td>{if $sa.status=="0"}<a class="check_a" href="proveCheck.php?uID={$sa.uID}&ID={$sa.ID}">
                               审核</a>{elseif $sa.status=="1"}<a  href="#" class="check_a " id="ID"
                               onclick="check({$sa.ID})" >邮寄</a>{elseif $sa.status=="2"}已邮寄{/if}</td>
                        </tr>
                {/foreach}

                    <div class="layui-layer layer-anim layui-layer-dialog layui-layer-border layui-layer-msg layui-layer-hui" id="layui-layer14" type="dialog" times="14" showtime="20000" contype="string" style="z-index: 19891028; top: 202.5px; left: 670px;display: none;">
                        <div id="" class="layui-layer-content">
                            快递单号<input style="color: #000;" type="text" id="expressNumber" name="expressNumber" placeholder="请输入快递单号" value="" />
                            <input type="hidden" name="status" value="1" />
                            <input type="hidden" id="ID" name="ID" value="" />
                        </div>
                        <div class="layui-layer-btn">
                            <a class="layui-layer-btn0">取消</a>
                            <a class="layui-layer-btn1" href="#" style="padding-left: 0;padding-right: 0;"><input style="border:none;height: 26px;padding-left: 15px;padding-right: 15px;" type="submit"  value="确认"/></a>
                        </div>
                    </div>
                </table>
                <div class="tt">
                    <div class="left">{$pageList}</div>
                    {*<div class="right">*}
                    {*<input type="checkbox" name="codeVison" value="1" >编码格式版本*}
                    {*<input type="submit" name="intoExcel"  value="保存为EXCEL"/>*}
                    {*</div>*}
                </div>
            </form>
        </fieldset>
    </div>
</div>

<!-- 弹窗 -->

<script>

    function check(ID){
        $("#ID").val(ID)
        $('.layui-layer').css('display','block');
        $('.layui-layer-btn0').click(function(){
            $('.layui-layer').css('display','none');
        });


//        $("select[name=year]").change(function(){
//            window.location.href ="http://"+location.host+location.pathname+"?";
//        });
//        $(".check_a"){
//            $(this). click(function(){
//                var url = $(this).attr("dataSrc");
//                tipsWindown('新建','iframe:'+url, '1000', '580', 'true', '', 'true', 'leotheme');
//            });
//        });


}
</script>
{include file="footer.tpl"}