<?php
if (! empty ( $_GET )) {
	$totalfee = $_GET ['totalfee'];
	$returnUrl = $_GET ['returnurl'];
	$jsApiParameters = $_GET ['jsApiParameters'];
	$paymentId = $_GET ['paymentId'];
}
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport"
	content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<title>微信支付</title>
<style type="text/css">
* {
	padding: 0;
	margin: 0;
}

.payHead {
	background: #096;
	padding: 60px;
	text-align: center;
	color: #fff
}

.payHead .span1 {
	font-size: 16px;
}

.payHead .price {
	font-size: 30px;
	line-height: 40px;
	font-weight: bold;
}

.button {
	color: #fff;
	font-size: 16px;
	background: #0C3;
	border-radius: 5px;
	padding: 12px 0;
	text-align: center;
	display: block;
	margin: 20px;
	-webkit-appearance: none;
	border: none;
	text-decoration: none;
}

.failMsg {
	padding: 15px;
	margin: 20px;
	background: #FFC;
	text-align: left;
	color: red;
}
</style>
<script type="text/javascript"
	src="http://project.weiphp.cn/paiqian/Public/static/jquery-2.0.3.min.js"></script>
<script type="text/javascript">
		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					
					//$.post(url,{res:res.err_msg});
						
					WeixinJSBridge.log(res.err_msg);
					if(res.err_msg=='get_brand_wcpay_request:ok'){
	 					//document.getElementById('successDom').style.display='block';
	 					window.location.href = '<?php echo $returnUrl; ?>';	
	 				}else{
	 					document.getElementById('payDom').style.display='none';
	 					document.getElementById('failDom').style.display='block';
	 					document.getElementById('failRt').innerHTML='错误提示：'+res.err_msg;
	 				}
				}
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}
		callpay(); //直接支付，不需要用户再次点击

		//var pa = 	'<?php echo $returnUrl; ?>';
		//$.post(url,{pa:pa});
	</script>
</head>
<body>

	<div id="failDom" style="display: none">
		<div class="failMsg">
			支付结果:支付失败
			<div id="failRt"></div>
		</div>
		<div id="footReturn">
			<a href="javascript:void(0);" class="button" onClick="callpay()">重新进行支付</a>
		</div>
	</div>
	<div id="successDom" style="display: none">
		<span>支付成功</span> <span>您已支付成功，页面正在跳转...</span>
	</div>
</body>
</html>