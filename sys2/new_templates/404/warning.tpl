{include file="header.tpl"}
<div id="main">
<fieldset>
  <div class="center" style="width:1100px;height:400px;background-color:#ffffff">
    <div class="left">
      <img src="{$httpPath}css/images/404.png" />
    </div>
    <div class="left" style="font-size:20px;margin:100px 0 0 20px">
       <p>{$errorMsg}</p>   
       <a class="noSub negative" href="javascript:history.back();">点击返回</a>    
   </div>
  </div>
</fieldset>
</div>
 {include file="footer.tpl"}