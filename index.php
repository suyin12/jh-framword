<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="icon" href="../../favicon.ico">
	<title>just do it!!</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<!-- stylesheet css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/templatemo-blue.css">
</head>
<body data-spy="scroll" data-target=".navbar-collapse">

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">主页</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">成果</a></li>
				<li><a href="#about">关于</a></li>
				<li><a href="#contact">联系</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>
<!-- preloader section -->
<div class="preloader">
	<div class="sk-spinner sk-spinner-wordpress">
       <span class="sk-inner-circle"></span>
     </div>
</div>

<!-- header section -->
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<img src="images/tm-easy-profile.jpg" class="img-responsive img-circle tm-border" onclick="entry(this)" alt="点击进入后台">
				<hr>
				<h1 class="white bold shadow">你好,世界!</h1>
				<h1 class="white bold shadow">我是XXX</h1>
                <input type="hidden" id="sessionName" value="<?php session_start(); echo $_SESSION['name']?>">
                <p id="sessionName"></p>
                <p id="content"></p>
			</div>
		</div>
	</div>
</header>


<!-- javascript js -->	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>	
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/addLoadEvent.js"></script>
<script src="js/ajax.js"></script>
<script>
    //当点击头像触发点击事件
    function entry(){
        var sessionName = document.getElementById("sessionName").getAttribute("value");
        ajax(sessionName);
    }
    //回调函数
    function doResult(){
        if(xmlHttpReq.readyState == 4 && xmlHttpReq.status == 200){
            // document.getElementById("content").innerHTML = xmlHttpReq.responseText;
            if(xmlHttpReq.responseText === '1'){
                alert('您还没有登录哦!');
                setTimeout("window.location.href = './admin/login.html'",3000);
            }
        }
    }
</script>


</body>
</html>