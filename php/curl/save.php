<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]>     <html>  <![endif]-->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>手把手教会你UI图形创意手绘 - 陈磊视频教程 -猿代码</title>
    <meta name="keywords" content="设计,UI,陈磊视频教程" />
    <meta name="description" content="手把手教会你UI图形创意手绘" />
    <meta name="csrf-token" content="InxZdAWWqFVkUDLgzvO9lVR45XvTfP30qqWnEAnD">
    <link rel="shortcut icon" href="http://www.ydma.cn/favicon.ico" type="image/x-icon" media="screen"/>
    <meta name="baidu-site-verification" content="krSAFGUDoW" />



    <link href="http://www.ydma.cn/assets/v2/bootstrap/css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" media="screen" href="http://www.ydma.cn/assets/css/common.css" />
    <link rel="stylesheet" media="screen" href="http://www.ydma.cn/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" media="screen" href="http://www.ydma.cn/assets/v2/css/main.css" />
    <link rel="stylesheet" media="screen" href="http://www.ydma.cn/assets/v2/css/es-icon.css" />
    <link rel="stylesheet" media="screen" href="http://www.ydma.cn/assets/v2/css/theme-blue.css" />




    <!--[if lt IE 9]>
    <script src="http://www.ydma.cn/assets/libs/html5shiv.js"></script>
    <script src="http://www.ydma.cn/assets/libs/respond.min.js"></script>
    <![endif]-->


    <script>
        var app = {};
        app.debug = true;
        app.version = '1.0';
        app.httpHost = 'http://www.ydma.cn';
        app.basePath = '';
        app.theme = '';
        app.themeGlobalScript='';
        app.jsPaths = '';

        var CKEDITOR_BASEPATH = app.basePath + '/assets/libs/ckeditor/4.6.7/';

        app.config = {"api":{"weibo":{"key":""},"qq":{"key":""},"douban":{"key":""},"renren":{"key":""}},"loading_img_path":"http:\/\/www.ydma.cn\/assets\/img\/default\/loading.gif"};

        app.arguments = {};
        app.controller = 'course/show';
        app.arguments = {"course_uri":"http:\/\/www.ydma.cn\/admin\/task\/course\/36"};

        app.scripts = null;

        app.uploadUrl = 'upload';
        app.imgCropUrl = 'img/crop';
        app.mainScript = 'http://www.ydma.cn/bundles/topxiaweb/js/app.js';
        app.lang = 'zh_CN';
    </script>
    <script src="http://www.ydma.cn/bundles/bazingajstranslation/js/translator.min.js"></script>
    <script src="http://www.ydma.cn/assets/libs/seajs/seajs/2.2.1/sea.js"></script>
    <script src="http://www.ydma.cn/assets/libs/seajs/seajs-style/1.0.2/seajs-style.js"></script>
    <script src="http://www.ydma.cn/assets/libs/seajs/seajs-text/1.1.1/seajs-text.min.js"></script>
    <script src="http://www.ydma.cn/assets/libs/seajs-global-config.js"></script>
    <script>
        seajs.use(app.mainScript);
    </script>
</head>
<body class="course-dashboard-page">

<div class="es-wrap">


    <header class="rt-header hidden-xs" style="padding:6px 0px">
        <div class="container">
            <a class="head-logo fl" href="/">
                <img src="http://7xvenj.com1.z0.glb.clouddn.com/image/1466057702.png" style="height: 40px;margin-top:10px">
            </a>
            <ul class="nav navbar-nav clearfix" id="nav">
                <li class="">
                    <a href="http://www.ydma.cn">首页 </a>
                </li>
                <li class="">
                    <a href="http://www.ydma.cn/course/explore">全部课程 </a>
                </li>
                <li class="">
                    <a href="http://www.ydma.cn/course/explore?filter%5Bprice%5D=free&orderBy=latest
">免费课程 </a>
                </li>
                <li class="">
                    <a href="http://www.ydma.cn/course/explore?orderBy=studentNum">热门课程</a>
                </li>
                <li class="">
                    <a href="http://www.ydma.cn/course/explore?orderBy=recommendedSeq">推荐课程</a>
                </li>
            </ul>
            <!--添加jquerycdn库,导航添加点击事件-->
            <script src="http://code.jquery.com/jquery-2.2.4.js"
                    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
            <script>

                $(document).ready(function () {
                    $('#nav li a').each(function () {
                        if ($($(this))[0].href == String(window.location))
                            $(this).addClass('show');
                        $(this).siblings().removeClass("show");

                    });

                })
            </script>
            <div class="fr">
                <form action="http://www.ydma.cn/course/explore" method="get" class="components-search-div">
                    <input type="text" placeholder="请输入需要查询的内容" class="components-search-inp" name="title"
                           value="">
                    <svg class="components-search-btn">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-btn">
                            <svg viewBox="0 0 20 20" id="search-btn" width="100%" height="100%">
                                <path d="M17.58,16.27l-4.9-4.61A6,6,0,1,0,11.16,13l5,4.74a1,1,0,1,0,1.37-1.46ZM4.11,7.94A3.94,3.94,0,1,1,8,11.88,3.94,3.94,0,0,1,4.11,7.94Z"
                                      fill="#e0e0e0"></path>
                            </svg>
                        </use>
                    </svg>
                </form>

                <div class="navbar-user" style="float:left;margin-top: 0px;position:relative;right: auto;top: auto">
                    <ul class="nav user-nav">
                        <li class="hidden-xs"><a href="http://www.ydma.cn/login">登录</a></li>
                        <li class="hidden-xs"><a href="javaScript:" style="padding: 20px 0px">|</a></li>
                        <li class="hidden-xs"><a href="http://www.ydma.cn/register">注册</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <header class="es-header navbar visible-xs">
        <div class="navbar-header">
            <div class="visible-xs  navbar-mobile">
                <a href="javascript:;" class="navbar-more js-navbar-more">
                    <i class="es-icon es-icon-menu"></i>
                </a>
                <div class="html-mask"></div>
                <div class="nav-mobile" style="height: 359px;">
                    <ul class="nav navbar-nav">
                        <li class="">
                            <a href="http://www.ydma.cn">首页 </a>
                        </li>
                        <li class="">
                            <a href="http://www.ydma.cn/course/explore">全部课程 </a>
                        </li>
                        <li class="">
                            <a href="http://www.ydma.cn/course/explore?filter%5Bprice%5D=free&orderBy=latest
">免费课程 </a>
                        </li>
                        <li class="">
                            <a href="http://www.ydma.cn/course/explore?orderBy=studentNum">热门课程</a>
                        </li>
                        <li class="">
                            <a href="http://www.ydma.cn/course/explore?orderBy=recommendedSeq">推荐课程</a>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="/" class="navbar-brand">
            </a>
        </div>
        <nav class="collapse navbar-collapse">
            <div class="navbar-user ">
                <ul class="nav user-nav">
                    <li class="user-avatar-li nav-hover visible-xs">
                        <a href="javascript:;" class="dropdown-toggle">
                            <img class="avatar-xs" src="http://www.ydma.cn/assets/img/default/avatar.png">
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="user-nav-li-login"><a href="http://www.ydma.cn/login">
                                    <i class="es-icon es-icon-denglu"></i>
                                    登录</a></li>
                            <li class="user-nav-li-register"><a href="http://www.ydma.cn/register">
                                    <i class="es-icon es-icon-zhuce"></i>
                                    注册</a></li>

                        </ul>
                    </li>

                </ul>

            </div>
        </nav>
    </header>



    <section class="course-detail-header before">
        <div class="container">

            <ol class="breadcrumb breadcrumb-o">
                <li><a href="http://www.ydma.cn">首页</a></li>
                <li><a href="http://www.ydma.cn/course/explore/front_end?orderBy=latest">前端开发</a></li>
                <li><a href="http://www.ydma.cn/course/explore/front_end?subCategory=_html&orderBy=latest">HTML/CSS</a></li>
                <li class="active">手把手教会你UI图形创意手绘</li>
            </ol>

            <div class="es-section clearfix ">

                <div class="course-img">
                    <img class="img-responsive" src="http://7xvenj.com1.z0.glb.clouddn.com/image/1479785978.png" alt="手把手教会你UI图形创意手绘">
                    <div class="tags">



                    </div>
                </div>


                <div class="course-info">
                    <h2 class="title">
                        手把手教会你UI图形创意手绘



                    </h2>

                    <div class="metas">
                        <div class="score">



                            <i class="es-icon es-icon-star"></i>
                            <i class="es-icon es-icon-star"></i>
                            <i class="es-icon es-icon-star"></i>
                            <i class="es-icon es-icon-star"></i>
                            <i class="es-icon es-icon-star"></i>

                            <span>(0 评论)</span>
                        </div>

                        <p class="discount-price">
                            <label>价格</label>


                            <span class="course-price-widget">

  	<span class="text-success">0元</span>
  	      	  	<span class="discount">
                  限免
              </span>
 	 	</span>        </p>


                    </div>


                </div>

                <div class="course-operation clearfix">

                    <div class="student-num hidden-xs">
                        <i class="es-icon es-icon-people"></i>193人
                    </div>

                    <ul class="course-data clearfix ">

                        <li id="unfavorite-btn" data-url="http://www.ydma.cn/course/36/unfavorite" style="display:none;">
                            <a href="javascript:;" class="color-primary">

                                <p><i class="es-icon es-icon-bookmark"></i></p>

                                <p>已收藏</p>
                            </a>
                        </li>



                        <li id="favorite-btn" data-url="http://www.ydma.cn/course/36/favorite" >
                            <a href="javascript:;">

                                <p><i class="es-icon es-icon-bookmarkoutline"></i></p>
                                <p>收藏</p>

                            </a>
                        </li>

                        <li>
    <span class="es-share top">
      <a class="dropdown-toggle" href="" data-toggle="dropdown">
        <p><i class="es-icon es-icon-share"></i></p>
        <p>分享</p>
      </a>

<div class="dropdown-menu  js-social-share-params" data-title="手把手教会你UI图形创意手绘" data-summary="手把手教会你UI图形创意手绘" data-message="我正在学习《手把手教会你UI图形创意手绘》，收获巨大哦，一起来学习吧！" data-url="http://www.ydma.cn/course/36" data-picture="http://7xvenj.com1.z0.glb.clouddn.com/image/1479785978.png">

    <input type="hidden" class="point-share-url" value="http://www.ydma.cn/share/36/%E6%89%8B%E6%8A%8A%E6%89%8B%E6%95%99%E4%BC%9A%E4%BD%A0UI%E5%9B%BE%E5%BD%A2%E5%88%9B%E6%84%8F%E6%89%8B%E7%BB%98/course/point">
  <a href="javascript:;" class="js-social-share" data-cmd="weixin" title="分享到微信" data-share="weixin" data-qrcode-url="http://www.ydma.cn/common/qrcode?text=http%3A%2F%2Fwww.ydma.cn%2Fcourse%2F36"><i class="es-icon es-icon-weixin"></i></a>
  <a href="javascript:;" class="js-social-share" data-cmd="tsina" title="分享到新浪微博" data-share="weibo"><i class="es-icon es-icon-weibo"></i></a>
  <a href="javascript:;" class="js-social-share" data-cmd="qq" title="分享到QQ好友" data-share="qq"><i class="es-icon es-icon-qq"></i></a>
  <a href="javascript:;" class="js-social-share" data-cmd="qzone" title="分享到QQ空间" data-share="qzone"><i class="es-icon es-icon-qzone"></i></a>

</div>
    </span>
                        </li>

                    </ul>
                    <div class="buy">
                        <a class="btn btn-primary btn-lg"
                           data-toggle="modal" data-url="http://www.ydma.cn/ajax/login" data-target="#login-modal"
                        >


                            加入学习
                        </a>

                    </div>
                </div>


            </div>
        </div>
    </section>















    <div id="content-container" class="container">


        <div class="course-detail row">
            <div class="col-lg-9 col-md-8  course-detail-main">











                <section class="es-section">


                    <div class="nav-btn-tab">

                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="active"><a href="http://www.ydma.cn/course/36/overview">课程概览</a></li>
                            <li role="presentation" ><a href="http://www.ydma.cn/course/36/lessons/list">课时列表

                                </a></li>
                            <li role="presentation" ><a href="http://www.ydma.cn/course/36/review/list">评价</a>
                            </li>
                            <li role="presentation" ><a href="http://www.ydma.cn/course/36/note"> 笔记</a></li>
                        </ul>


                    </div>     		<section id="course_main">

                        <div class="course-detail-content">

                            <div class="es-piece">
                                <div class="piece-header">
                                    课程介绍
                                </div>
                                <div class="piece-body p-lg clearfix">
                                    手把手教会你UI图形创意手绘
                                </div>
                            </div>



                        </div>


                    </section>

                </section>


            </div>

            <div class="col-lg-3 col-md-4  course-sidebar">


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <i class="es-icon es-icon-assignmentind"></i>
                            授课教师
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="media media-default">
                            <div class="media-left">
                                <a class=" js-user-card" href="http://www.ydma.cn/user/10" data-card-url="http://www.ydma.cn/user/10/card/show" data-user-id="10">
                                    <img class="avatar-md" src="http://www.ydma.cn/assets/img/default/avatar.png">

                                </a>

                            </div>
                            <div class="media-body">
                                <div class="title">
                                    <a class="link-dark link-light" href="http://www.ydma.cn/user/10">陈磊</a>

                                </div>
                                <div class="content"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>






    </div>




    <footer class="es-footer footer" style="display:none">
        <div class="copyright">
            <div class="container">
                Copyright © 2017 <br>
                <strong>
                    All Rights Reserved. 京ICP备17044912号 <br>
                    Powered by <a href="http://www.ydma.cn" target="_blank">猿代码</a>
                </strong>
            </div>
        </div>
    </footer>

</div>




<div id="float-consult" class="float-consult hidden-xs">
    <div class="btn-group-vertical">





    </div>

    <div class="consult-contents">
        <div id="consult-qq-content">
        </div>

        <div id="consult-qqgroup-content">
        </div>
        <div id="consult-phone-content">
            <p>
                <strong>服务时间：</strong>
            </p>

        </div>


        <div id="consult-weixin-content">
            <img src="http://www.ydma.cn/" class="qrcode center-block">
        </div>

        <div id="consult-email-content">
            <a href="mailto:"></a>
        </div>

    </div>
</div>


<div id="login-modal" class="modal" data-url="" data-backdrop="static" data-keyboard="false"></div>
<div id="modal" class="modal" data-backdrop="static" data-keyboard="false"></div>
<div id="attachment-modal" class="modal" data-backdrop="static" data-keyboard="false"></div>




</body>

</html>