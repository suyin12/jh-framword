<!---

  作者:  sToNe

  Email: shi35dong@gmail.com

  QQ: 1018732357
  --->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        {config_load file="htmlSet.conf"}
        <meta http-equiv="Content-Type" content=text/html; charset='{#charset#}' />
              <link rel="stylesheet" type="text/css" href='{$css}' />
        <link rel="shortcut icon" href="{$httpPath}favicon.ico" mce_href="{$httpPath}favicon.ico" type="image/x-icon">
        <title>{$title|default:"派遣系统"}</title>
        <script type="text/javascript" src='{$httpPath}lib/jquery/jquery-1.5.2.min.js'></script>
        <script type="text/javascript" src='{$httpPath}lib/js/menu.js'></script>

    </head>
    <body>
<div id="header">
<div id='loading'>正在加载....</div>
<div id="menu">
    <ul class="menu">
        <li><a href="{$httpPath}user/login/index.php" class="parent"><span><img src="{$httpPath}css/images/home.png" width="50px" height="30px"/></span></a>
        {foreach from=$headerConfig['father'] item=val}
            <li><a href="{if $val.Fun_Code}{$httpPath}{$val.Fun_Code}{else}#{/if}" class="parent"><span>{$val.Fun_Name}</span></a>
                <ul>
                {foreach from=$headerConfig['child'] item=cval key=ckey}
                        {if $val.Fun_ID == $cval.fatherID}
	                        {if $cval.hasChild eq '1'}
	                        	<li><a href="{$httpPath}{$cval.Fun_Code}"  class="parent"><span>{$cval.Fun_Name}{if $cval.helpLink}<a href="{$cval.helpLink}" target="_blank">(帮助)</a>{/if}</span></a>
								<ul>
								{foreach from=$headerConfig['child'] item=cv key=ck}
								{if $cval.Fun_ID == $cv.fatherID}
								     <li><a href="{$httpPath}{$cv.Fun_Code}"><span>{$cv.Fun_Name}{if $cv.helpLink}<a href="{$cv.helpLink}" target="_blank">(帮助)</a>{/if}</span></a>
								{/if}
								{/foreach}
								</ul>
								 </li>
	                        {else}
	                        	<li><a href="{$httpPath}{$cval.Fun_Code}"><span>{$cval.Fun_Name}{if $cval.helpLink}<a href="{$cval.helpLink}" target="_blank">(帮助)</a>{/if}</span></a>
	                        {/if}
                         {/if}
                  {/foreach}
                </ul>
        {/foreach}
    </ul>
</div>
</div>
<div id="visual">
<!--虚拟DIV,用于控制层-->
    <div id="logoInfo">
        <p >
     当前页面:  [ <span class="red"> {$title|default:"派遣系统"}</span>   ]
    {$current_userName}
        <a href="{$httpPath}user/manage/changeUserInfo.php">修改密码</a>
        <a href="{$httpPath}user/login/index.php?logoff=1">退出系统</a>
       </p>
   </div>
</div>