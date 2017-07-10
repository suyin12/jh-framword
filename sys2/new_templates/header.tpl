
<!--
  作者:  sToNe

  Email: shi35dong@gmail.com

  QQ: 1018732357
  -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        {config_load file="htmlSet.conf"}
        <meta http-equiv="Content-Type" content=text/html; charset='{#charset#}' />
              <link rel="stylesheet" type="text/css" href='{$httpPath}css/2016/css/bootstrap.min.css' />
              <!-- <link rel="stylesheet" type="text/css" href='{$httpPath}css/2016/kingadmin.css' /> -->
              <link rel="stylesheet" type="text/css" href='{$httpPath}css/2016/css/main.css' />
              <link rel="stylesheet" type="text/css" href='{$httpPath}css/2016/css/table.css' />

              <link rel="stylesheet" type="text/css" href='{$httpPath}Font-Awesome-master/css/font-awesome.css' />

              <!-- <link rel="stylesheet" type="text/css" href='{$css}' /> -->
        <link rel="shortcut icon" href="{$httpPath}favicon.ico" mce_href="{$httpPath}favicon.ico" type="image/x-icon">
        <title>{$title|default:"派遣系统"}</title>
        <!-- <script type="text/javascript" src='{$httpPath}lib/jquery/jquery-1.5.2.min.js'></script> -->
        <!-- <script type="text/javascript" src='{$httpPath}lib/js/menu.js'></script> -->






    </head>
    <body>
    <!-- 原本导航代码 -->
<!-- <div id="header">
<div id='loading'>正在加载....</div>
<div id="menu">
    <ul class="menu">
        <li><a href="{$httpPath}user/login/index.php" class="parent"><span><img src="{$httpPath}css/images/home.png" width="30px" height="30px"/></span></a>
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
</div> -->
    <!-- 原本导航代码  end-->


<nav class="navbar navbar-inverse" role="navigation">

</nav>
<!--虚拟DIV,用于控制层 -->
<!-- <div id="visual">

    <div id="logoInfo">
        <p >
     当前页面:  [ <span class="red"> {$title|default:"派遣系统"}</span>   ]
    {$current_userName}
        <a href="{$httpPath}user/manage/changeUserInfo.php">修改密码</a>
        <a href="{$httpPath}user/login/index.php?logoff=1">退出系统</a>
       </p>
   </div>
</div> -->
<!--虚拟DIV,用于控制层 end-->

<div class="container-fluid">
<div class="row">
 <div class="col-md-2 col-lg-2 left-sidebar left-bg">
            <!-- main-nav -->
            <nav class="main-nav">
              <ul class="main-menu">
                <li class="active"><a href="#" class="js-sub-menu-toggle"><i class="fa fa-dashboard fa-fw"></i><span class="text">招聘管理</span>
                  <i class="toggle-icon fa fa-angle-left"></i></a>
                  <ul class="sub-menu open">
                    <li class="active"><a href="index.html"><span class="text">招聘需求(帮助)</span></a></li>
                    <li><a href="index-transparent.html"><span class="text">招聘计划<span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="index-dashboard-v2.html"><span class="text">市场评估(帮助)</span></a></li>
                    <li><a href="index-dashboard-v2-transparent.html"><span class="text">人才管理(帮助)<span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="index-dashboard-v3.html"><span class="text">统计信息<span class="badge element-bg-color-blue"></span></span></a></li>
                  </ul>
                </li>
                <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-clipboard fa-fw"></i><span class="text">员工信息管理</span>
                  <i class="toggle-icon fa fa-angle-left"></i></a>
                  <ul class="sub-menu ">
                    <li><a href="page-profile.html"><span class="text">Profile</span></a></li>
                    <li><a href="page-invoice.html"><span class="text">Invoice</span></a></li>
                    <li><a href="page-knowledgebase.html"><span class="text">Knowledge Base</span></a></li>
                    <li><a href="page-inbox.html"><span class="text">Inbox</span></a></li>
                    <li><a href="page-new-message.html"><span class="text"> Message</span></a></li>
                    <li><a href="page-view-message.html"><span class="text">View Message</span></a></li>
                    <li><a href="page-search-result.html"><span class="text">Search Result</span></a></li>
                    <li><a href="page-submit-ticket.html"><span class="text">Submit Ticket</span></a></li>
                    <li><a href="page-file-manager.html"><span class="text">File Manager</span></a></li>
                    <li><a href="page-file-manager-transparent.html"><span class="text">File Manager Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="page-projects.html"><span class="text">Projects</span></a></li>
                    <li><a href="page-project-detail.html"><span class="text">Project Detail</span></a></li>
                    <li><a href="page-faq.html"><span class="text">FAQ</span></a></li>
                    <li><a href="page-register.html"><span class="text">Register</span></a></li>
                    <li><a href="page-register-transparent.html"><span class="text">Register Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="page-login.html"><span class="text">Login</span></a></li>
                    <li><a href="page-login-transparent.html"><span class="text">Login Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="page-404.html"><span class="text">404</span></a></li>
                    <li><a href="page-404-transparent.html"><span class="text">404 Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="page-blank.html"><span class="text">Blank Page</span></a></li>
                  </ul>
                </li>
                <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-bar-chart-o fw"></i><span class="text">保险管理</span>
                  <i class="toggle-icon fa fa-angle-left"></i></a>
                  <ul class="sub-menu ">
                    <li><a href="charts-statistics.html"><span class="text">Charts</span></a></li>
                    <li><a href="charts-statistics-transparent.html"><span class="text">Charts Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="charts-statistics-interactive.html"><span class="text">Interactive Charts</span></a></li>
                    <li><a href="charts-statistics-interactive-transparent.html"><span class="text">Interactive Charts Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="charts-statistics-real-time.html"><span class="text">Realtime Charts</span></a></li>
                    <li><a href="charts-statistics-real-time-transparent.html"><span class="text">Realtime Charts Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="charts-d3charts.html"><span class="text">D3 Charts</span></a></li>
                  </ul>
                </li>
                <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-edit fw"></i><span class="text">工资管理</span>
                  <i class="toggle-icon fa fa-angle-left"></i></a>
                  <ul class="sub-menu ">
                    <li><a href="form-inplace-editing.html"><span class="text">In-place Editing</span></a></li>
                    <li><a href="form-elements.html"><span class="text">Form Elements</span></a></li>
                    <li><a href="form-layouts.html"><span class="text">Form Layouts</span></a></li>
                    <li><a href="form-bootstrap-elements.html"><span class="text">Bootstrap Elements</span></a></li>
                    <li><a href="form-validations.html"><span class="text">Validation</span></a></li>
                    <li><a href="form-file-upload.html"><span class="text">File Upload</span></a></li>
                    <li><a href="form-text-editor.html"><span class="text">Text Editor</span></a></li>
                  </ul>
                </li>
                <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-list-alt fw"></i><span class="text">代理事务管理</span>
                  <i class="toggle-icon fa fa-angle-left"></i></a>
                  <ul class="sub-menu ">
                    <li><a href="ui-elements-general.html"><span class="text">General Elements</span></a></li>
                    <li><a href="ui-elements-tabs.html"><span class="text">Tabs</span></a></li>
                    <li><a href="ui-elements-buttons.html"><span class="text">Buttons</span></a></li>
                    <li><a href="ui-elements-icons.html"><span class="text">Icons <span class="badge element-bg-color-blue">Updated</span></span></a></li>
                    <li><a href="ui-elements-flash-message.html"><span class="text">Flash Message</span></a></li>
                  </ul>
                </li>

                <li><a href="#" class="js-sub-menu-toggle"><i class="fa fa-table fw"></i><span class="text">统计分析</span>
                  <i class="toggle-icon fa fa-angle-left"></i></a>
                  <ul class="sub-menu ">
                    <li><a href="components-wizard.html"><span class="text">Wizard (with validation)</span></a></li>
                    <li><a href="components-calendar.html"><span class="text">Calendar</span></a></li>
                    <li><a href="components-maps.html"><span class="text">Maps</span></a></li>
                    <li><a href="components-maps-transparent.html"><span class="text">Maps Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                    <li><a href="components-gallery.html"><span class="text">Gallery</span></a></li>
                    <li><a href="components-tree-view.html"><span class="text">Tree View </span></a></li>
                    <li><a href="components-tree-view-transparent.html"><span class="text">Tree View Transparent <span class="badge element-bg-color-blue"></span></span></a></li>
                  </ul>
                </li>

                <li>
                  <a href="#" class="js-sub-menu-toggle"><i class="fa fa-bars"></i>
                    <span class="text">系统管理</span>
                    <i class="toggle-icon fa fa-angle-left"></i>
                  </a>
                  <ul class="sub-menu">
                    <li class="">
                      <a href="#" class="js-sub-menu-toggle">
                        <span class="text">Menu Lvl 2</span>
                        <i class="toggle-icon fa fa-angle-left"></i>
                      </a>
                      <ul class="sub-menu">
                        <li><a href="#">Menu Lvl 3</a></li>
                        <li><a href="#">Menu Lvl 3</a></li>
                        <li><a href="#">Menu Lvl 3</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#">
                        <span class="text">Menu Lvl 2</span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
            <!-- /main-nav -->
            <div class="sidebar-minified js-toggle-minified">
              <i class="fa fa-angle-left"></i>
            </div>
            <!-- sidebar content -->

            <!-- end sidebar content -->
          </div>
