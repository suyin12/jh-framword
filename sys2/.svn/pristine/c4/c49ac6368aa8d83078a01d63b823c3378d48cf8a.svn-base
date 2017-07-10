/**
 * Created by jacyxie on 2015/12/3.
 */

(function(){
	//初始化微信api
	function initWxApi(){
		wx.config({
			debug: false,
			appId: WX_APPID, // 必填，公众号的唯一标识
			timestamp: WXJS_TIMESTAMP, // 必填，生成签名的时间戳
			nonceStr: NONCESTR, // 必填，生成签名的随机串
			signature: SIGNATURE,// 必填，签名，见附录1
			jsApiList: [
				'checkJsApi',
				'onMenuShareTimeline',
				'onMenuShareAppMessage',
				'onMenuShareQQ',
				'onMenuShareWeibo',
				'hideMenuItems',
				'showMenuItems',
				'hideAllNonBaseMenuItem',
				'showAllNonBaseMenuItem',
				'translateVoice',
				'startRecord',
				'stopRecord',
				'onRecordEnd',
				'playVoice',
				'pauseVoice',
				'stopVoice',
				'uploadVoice',
				'downloadVoice',
				'chooseImage',
				'previewImage',
				'uploadImage',
				'downloadImage',
				'getNetworkType',
				'openLocation',
				'getLocation',
				'hideOptionMenu',
				'showOptionMenu',
				'closeWindow',
				'scanQRCode',
				'chooseWXPay',
				'openProductSpecificView',
				'addCard',
				'chooseCard',
				'openCard'
				]
			});
		wx.error(function(res){
			alert(JSON.stringify(res))
			alert('js授权出错,请检查域名授权设置和参数是否正确');
		})
	}
	//通用banner
	function banner(isAuto,delayTime){
		var screenWidth = $('.container').width();
		var count = $('.banner li').size();
		$('.banner ul').width(screenWidth*count);
		$('.banner ul').height(screenWidth/2);
		$('.banner').height(screenWidth/2);
		$('.banner li').width(screenWidth).height(screenWidth/2);
		$('.banner li img').width(screenWidth).height(screenWidth/2);
		$('.banner li .title').css({'width':'98%','padding-left':'2%'})
		// With options
		$('.banner li .title').each(function(index, element) {
            $(this).text($(this).text().length>15?$(this).text().substring(0,15)+" ...":$(this).text());
        });
		var flipsnap = Flipsnap('.banner ul');
		flipsnap.element.addEventListener('fstouchend', function(ev) {
			$('.identify em').eq(ev.newPoint).addClass('cur').siblings().removeClass('cur');
		}, false);
		$('.identify em').eq(0).addClass('cur')
		if(isAuto){
			var point = 1;
			setInterval(function(){
				//console.log(point);
				flipsnap.moveToPoint(point);
				$('.identify em').eq(point).addClass('cur').siblings().removeClass('cur');
				if(point+1==$('.banner li').size()){
					point=0;
				}else{
					point++;
					}
				
				},delayTime)
		}
	}
	//显示分享提示
	function showShareTips(callback){
		var tempHtml = $('<div class="shareTips"><div class="tipsPic"></div><a class="close" href="javascript:;"></a></div>');
		$('body').append(tempHtml);
		$('.shareTips').click(function(){
			closeShareTips(callback);	
		})
	}
	function showShareFriend(callback){
		var tempHtml = $('<div class="shareTips"><div class="tips_friend"></div><a class="close" href="javascript:;"></a></div>');
		$('body').append(tempHtml);
		$('.shareTips').click(function(){
			closeShareTips(callback);	
		})
	}
	function showSubscribeTips(opts){
		if(opts.qrcode.length>5){
			var tempHtml = $('<div class="shareTips"><div class="tips_concern"></div><div class="qrcode"><img src="'+opts.qrcode+'"/><p>也可以长按二维码关注公众号</p></div><a class="close" href="javascript:;"></a></div>');
		}else{
			var tempHtml = $('<div class="shareTips"><div class="tips_concern"></div><a class="close" href="javascript:;"></a></div>');
		}
		$('body').append(tempHtml);
		$('.shareTips').click(function(){
			$('.shareTips').remove();
			if(opts.caalback)closeShareTips(opts.callback);	
		})
	}
	function closeShareTips(callback){
		$('.shareTips').remove();
		if(callback){
			callback();	
		}
	}
	//初始化分享数据
	/*参数
	*desc
	*link
	*title
	*imgUrl
	*
	*/
	function initWxShare(shareData){
		wx.ready(function(res){
			//alert('res:'+res);
			//分享
			wx.onMenuShareTimeline({
				title: shareData.desc, // 分享标题
				link: shareData.link, // 分享链接
				imgUrl: shareData.imgUrl, // 分享图标
				success: function () { 
					// 用户确认分享后执行的回调函数
				},
				cancel: function () { 
					// 用户取消分享后执行的回调函数
				}
			});
			wx.onMenuShareAppMessage({
				title: shareData.title, // 分享标题
				desc: shareData.desc, // 分享描述
				link: shareData.link, // 分享链接
				imgUrl: shareData.imgUrl, // 分享图标
				type: shareData.type, // 分享类型,music、video或link，不填默认为link
				dataUrl: shareData.dataUrl, // 如果type是music或video，则要提供数据链接，默认为空
				success: function () { 
					// 用户确认分享后执行的回调函数
				},
				cancel: function () { 
					// 用户取消分享后执行的回调函数
				}
			});
			wx.onMenuShareQQ({
				title: shareData.title, // 分享标题
				desc: shareData.desc, // 分享描述
				link: shareData.link, // 分享链接
				imgUrl: shareData.imgurl, // 分享图标
				success: function () { 
				   // 用户确认分享后执行的回调函数
				},
				cancel: function () { 
				   // 用户取消分享后执行的回调函数
				}
			});
		})
	}
	function back(){
		var hisLen = window.history.length;
		if(hisLen == 1){
			wx.closeWindow();
		}else{
			window.history.back();
		}
	}
	function showQrcode(title,url){
		var qrHtml = $('<div class="qrcode_dialog"><a href="javascript:;" class="close"></a><div class="content"><img src=""/><p></p></div></div>');
		$('img',qrHtml).attr('src',url);
		$('p',qrHtml).html(title);
		$('body').append(qrHtml);
		$('.close',qrHtml).click(function(){
			qrHtml.remove();
		})
	}
	//利用微信接口上传图片
	function wxChooseImg(_this,num,name,callback){
		wx.chooseImage({
			count: num, // 默认9
			sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
			sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
			success: function (res0) {
				var localIds = res0.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
				//
				if(callback){
					callback(localIds);
				}else{
					wxUploadImg(localIds,name,_this,num);
				}
			}
		});
		
    }
	//利用微信接口上传图片到微信服务器
	function wxUploadImg(localIds,name,target,num){
		var localId = localIds.pop();
		loading();
		wx.uploadImage({
			localId: localId, // 需要上传的图片的本地ID，由chooseImage接口获得
			isShowProgressTips: 0, // 默认为1，显示进度提示
			success: function (res) {
				$('textarea').val();
				$.get(SITE_URL+"/index.php?s=/Home/Weixin/downloadPic/media_id/"+res.serverId+".html",function(data){
					hideLoading();
					if(data.result=="success"){
						if(num>1){
							var addImg = $('<div class="img_item"><em>X</em><input type="hidden" name="'+name+'" value="'+data.id+'"/><img src="'+data.picUrl+'"/></div>');
							addImg.insertBefore($(target));
							var uploadImgWidth = $('.muti_picture_row .img_item').width()-10;
							$('.muti_picture_row .img_item').height(uploadImgWidth).width(uploadImgWidth);
							$('em',addImg).click(function(){
								$(this).parent().remove();
							})
						}else if(num==1){
							var addImg = $('<a class="img_item" onClick="$.WeiPHP.wxChooseImg(this,1,\'logo_imgurl\')"><input type="hidden" name="'+name+'" value="'+data.id+'"/><img src="'+data.picUrl+'"/></a>');
							$(target).parent().html(addImg);
						}
						if(localIds.length>0){
							wxUploadImg(localIds,name,target);
						}
					}
				})
			}
		});
	}
	//打开弹出导航
	function showPopCate(){
		var $pop = $($('#pop_cate').html());
		$('body').append($pop);
		$pop.show();
		$pop.addClass('pop_bottom_in');
		$('.pop_cate_lists',$pop).addClass('slow_move');
		$('.close',$pop).click(function(){
			$pop.remove();
		});
	}
	var $actionSheetHtml;
	function showActionSheet(){
		if(!$actionSheetHtml){
			$actionSheetHtml = $($('#actionSheetHtml').html());
			$('body').append($actionSheetHtml);
		}	
		var mask = $('#mask');
		var weuiActionsheet = $('#weui_actionsheet');
		weuiActionsheet.addClass('weui_actionsheet_toggle');
		mask.show().addClass('weui_fade_toggle').click(function () {
			hideActionSheet(weuiActionsheet, mask);
		});
		$('#actionsheet_cancel').click(function () {
			hideActionSheet(weuiActionsheet, mask);
		});
		weuiActionsheet.unbind('transitionend').unbind('webkitTransitionEnd');
		
	}
	function hideActionSheet(weuiActionsheet, mask) {
		weuiActionsheet.removeClass('weui_actionsheet_toggle');
		mask.removeClass('weui_fade_toggle');
		weuiActionsheet.on('transitionend', function () {
			mask.hide();
		}).on('webkitTransitionEnd', function () {
			mask.hide();
		})
	}
	//msg:信息
	//type:成功1  失败/错误0
	//delay:延时自动关闭 、、
	//使用 $.WeiPHP.toast('xxxxx',0);
	function toast(msg,type,delay){
		var delay = delay?delay:2000;
		if(type==1){
			var msg = msg?msg:"操作成功!";
			var $html = $('<div id="toast">'+
				'<div class="weui_mask_transparent"></div>'+
				'<div class="weui_toast">'+
					'<i class="weui_icon_toast"></i>'+
					'<p class="weui_toast_content">'+msg+'</p>'+
				'</div>'+
			'</div>');
		}else{
			var msg = msg?msg:"操作失败!";
			var $html = $('<div id="toast">'+
				'<div class="weui_mask_transparent"></div>'+
				'<div class="weui_toast">'+
					'<i class="weui_icon_fail"></i>'+
					'<p class="weui_toast_content">'+msg+'</p>'+
				'</div>'+
			'</div>');
		}
		$('body').append($html);
		setTimeout(function(){
			$html.remove();
		},delay)
	}
	//msg 提示
	//$.WeiPHP.loading('加载中...')
	function loading(msg){
		var msg =msg?msg:'加载中...';
		var $html = $('<div id="loadingToast" class="weui_loading_toast">'+
            '<div class="weui_mask_transparent"></div>'+
            '<div class="weui_toast">'+
                '<div class="weui_loading">'+
                    '<div class="weui_loading_leaf weui_loading_leaf_0"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_1"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_2"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_3"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_4"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_5"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_6"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_7"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_8"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_9"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_10"></div>'+
                    '<div class="weui_loading_leaf weui_loading_leaf_11"></div>'+
                '</div>'+
                '<p class="weui_toast_content">'+msg+'</p>'+
            '</div>'+
        '</div>');
		$('body').append($html);
	}
	//$.WeiPHP.hideLoading();
	function hideLoading(){
		$('#loadingToast').remove();
	}
	//确认框
	//$.WeiPHP.confirm({title:'aaa',msg:'ssss',rightText:'xx',leftText:'xxxx',rightCallback,leftCallback});
	function confirm(opts){
		var opts = opts?opts:new Object();
		var title = opts.title?opts.title:'温馨提示';
		var msg = opts.msg?opts.msg:'内容';
		var rightText = opts.rightText?opts.rightText:'确定';
		var leftText = opts.leftText?opts.leftText:'取消';
		var $html = $('<div class="weui_dialog_confirm" id="dialog1">'+
            '<div class="weui_mask"></div>'+
            '<div class="weui_dialog">'+
                '<div class="weui_dialog_hd"><strong class="weui_dialog_title">'+title+'</strong></div>'+
                '<div class="weui_dialog_bd">'+msg+'</div>'+
                '<div class="weui_dialog_ft">'+
                    '<a href="javascript:;" class="weui_btn_dialog default">'+leftText+'</a>'+
                    '<a href="javascript:;" class="weui_btn_dialog primary">'+rightText+'</a>'+
                '</div>'+
            '</div>'+
        '</div>');
		$('body').append($html);
		$('.default',$html).click(function(){
			if(opts.leftCallback){
				opts.leftCallback();
			}else{
				$html.remove();
			}
			$html.remove();
		})
		$('.primary',$html).click(function(){
			if(opts.rightCallback){
				opts.rightCallback();
			}else{
				$html.remove();
			}
			$html.remove();
		})
	}
	//提示框
	//$.WeiPHP.alert({title:'aaa',msg:'ssss',callback});
	//function alert(opts){
	//	var opts = opts?opts:new Object();
	//	var title = opts.title?opts.title:'温馨提示';
	//	var msg = opts.msg?opts.msg:'内容';
	//	var $html = $('<div class="weui_dialog_alert">'+
     //       '<div class="weui_mask"></div>'+
     //       '<div class="weui_dialog">'+
     //           '<div class="weui_dialog_hd"><strong class="weui_dialog_title">'+title+'</strong></div>'+
     //          	'<div class="weui_dialog_bd">'+msg+'</div>'+
     //           '<div class="weui_dialog_ft">'+
     //              '<a href="javascript:;" class="weui_btn_dialog primary">确定</a>'+
     //           '</div>'+
     //       '</div>'+
     //   '</div>');
	//	$('body').append($html);
	//	$('.primary',$html).click(function(){
	//		if(opts.callback){
	//			opts.callback();
	//		}else{
	//			$html.remove();
	//		}
	//	})
	//}
	//关联
	//只支持两级
	function initJson2Select(json){
		$.each(json,function(i,data1){
			var optionHtml = '';
			$.each(data1.json,function(k,json2){
				var tempK = -1;
				if(data1.default[0] && data1.default[0]==json2.v){
					tempK = k; 
					optionHtml += '<option data-index="'+k+'" value="'+json2.v+'" selected>'+json2.t+'</option>';
				}else{
					optionHtml += '<option data-index="'+k+'" value="'+json2.v+'">'+json2.t+'</option>';
				}
				if(tempK==-1)tempK=0;
				if(k==tempK){
					var optionHtml2 = '';
					$.each(json2.d,function(y,json3){
						if(data1.default[1] && data1.default[1]==json3.v){
							optionHtml2 += '<option value="'+json3.v+'" selected>'+json3.t+'</option>';
						}else{
							optionHtml2 += '<option value="'+json3.v+'">'+json3.t+'</option>';
						}
					})
					$('#'+data1.selectIds[1]).html(optionHtml2);
				}
			})
			
			$('#'+data1.selectIds[0]).html(optionHtml);
			$('#'+data1.selectIds[0]).change(function(){
				var index = $(this).find('option').not(function() {return !this.selected}).data('index');
				var tempHtml = '';
				$.each(data1.json[index].d,function(y,tempJson){
					if(y==0){
						tempHtml += '<option value="'+tempJson.v+'" selected>'+tempJson.t+'</option>';
					}else{
						tempHtml += '<option value="'+tempJson.v+'">'+tempJson.t+'</option>';
					}
				})
				$('#'+data1.selectIds[1]).html(tempHtml);
			})
		});
	}
	//下拉刷新只需要在页面上配置
	//内容列表配置 id="pullContainer"
	//页码使用WeiPHP服务器返回的页码  在page中打开 
	//如：<div class="page" data-pullload="true"> {$_page|default=''} </div>
	function initLoadMorePage(){
		if($('.page').data('pullload')==true){
			$('.page').hide();
			var isLoading = false;
			var $loading = $('<div class="moreLoading"><em></em><br/>正在加载...</div>').hide();
			$loading.insertAfter('#pullContainer');
			$(window).scroll(function(){
				//console.log($('body').height());
				//console.log($(window).scrollTop());	
				var next = $('.page').find('.current').last().next('a.num');
				var nextUrl = next.attr('href');
				if(nextUrl && isLoading==false && $('body').height()<$(window).scrollTop()+$(window).height()+30){
					isLoading = true;
					$loading.show();
					$.get(nextUrl,function(data){
						var dataDom = $(data);
						var listDom = dataDom.find('#pullContainer');
						$('#pullContainer').append(listDom.html());
						isLoading = false;
						$loading.hide();
						$('.page').find('.current').next('a').addClass('current');
					});
				}else if(isLoading == false && isLoading==false && $('body').height()<$(window).scrollTop()+$(window).height()+30){
					$loading.html('没有更多了').show();
				}
				
			});
		}
	}
	//下拉刷新
	//每页拉去数
	var pageCount = 10;
	//是否正在加载
	var isLoading = false;
	//拉取时间戳参数 页码或lastId
	var lastId = 0;
	var minId =0;
	var maxId = 0;
	//类型 0按页码 1按lastId
	var loadType = 0;
	//请求地址
	var loadUrl;
	//是否还有更多
	var hasMore = true;
	//dom class
	var domClass;
	//容器
	var domContainer;
	//加载数据
	function loadMoreContent(){
		
		isLoading = true;
		$('.moreLoading').show();
		$('.noMore').hide();
		$.get(loadUrl,{"count":pageCount,"lastId":lastId,'minId':minId,'maxId':maxId},function(data){
				
			if($.trim(data)==""||data.indexOf('default_png')>0){
				hasMore = false;
				$('.noMore').show();
				$('.moreLoading').hide();
			}else{
				$('#'+domContainer).append(data);
				hasMore = true;
				$('.moreLoading').hide();
			}
			isLoading = false;
		});
	}
	
	var WeiPHP = {
		initBanner:banner,
		showShareTips:showShareTips,//弹出提示分享指引
		showShareFriend:showShareFriend,//分享给朋友
		showSubscribeTips:showSubscribeTips,//提示关注公众号
		initLoadMore:function(opts){
			pageCount = opts.pageCount || 10;
			lastId = opts.lastId || 0;
			minId = opts.minId || 0;
			maxId = opts.maxId || 0;
			loadType = opts.loadType || 0;
			loadUrl = opts.loadUrl;
			domClass = opts.domClass || "contentItem";
			domContainer = opts.domContainer || "container";
			$(window).scroll( function() { 
				if(!isLoading && hasMore){
					if(loadType==0){
						lastId++; 
					}else{
						minId = getListMinId(domClass);
						maxId = getListMaxId(domClass);
						lastId = $('.'+domClass).last().data('lastid');
					}
					totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());  
					if ($(document).height() <= totalheight+50){
						loadMoreContent();
					} 
				}else if(hasMore == false){
					$('.noMmore').show();
					$('.moreLoading').hide();
				} 
			})
		},
		initWxShare:initWxShare,
		initWxApi:initWxApi,
		back:back,
		showQrcode:showQrcode,
		wxChooseImg:wxChooseImg,
		wxUploadImg:wxUploadImg,
		initLoadMorePage:initLoadMorePage,
		showPopCate:showPopCate,
		showActionSheet:showActionSheet,
		hideActionSheet:hideActionSheet,
		toast:toast,
		loading:loading,
		hideLoading:hideLoading,
		confirm:confirm,
		alert:alert,
		initJson2Select:initJson2Select
	};
	$.extend($,{
		WeiPHP: WeiPHP
	});
	
})();

$(function (){
	 //ajax post submit请求
    $('.ajax-post').click(function(){
        var target,query,form;
        var target_form = $(this).attr('target-form');
        var that = this;
        var nead_confirm=false;
        if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){ 
            form = $('.'+target_form);

            if ($(this).attr('hide-data') === 'true'){//无数据时也可以使用的功能
            	form = $('.hide-data');
            	query = form.serialize();
            }else if (form.get(0)==undefined){
            	return false;
            }else if ( form.get(0).nodeName=='FORM' ){
                if ( $(this).hasClass('confirm') ) {
                    if(!confirm('确认要执行该操作吗?')){
                        return false;
                    }
                }

                if($(this).attr('url') !== undefined && $(this).attr('url') != null){
                	target = $(this).attr('url');
                }else{
                	target = form.get(0).action;
                }

                query = form.serialize();
            }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
                form.each(function(k,v){
                    if(v.type=='checkbox' && v.checked==true){
                        nead_confirm = true;
                    }
                })
                if ( nead_confirm && $(this).hasClass('confirm') ) {
                    if(!confirm('确认要执行该操作吗?')){
                        return false;
                    }
                }
                query = form.serialize();
            }else{
                if ( $(this).hasClass('confirm') ) {
                    if(!confirm('确认要执行该操作吗?')){
                        return false;
                    }
                }
                query = form.find('input,select,textarea').serialize();
            }
            $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);

            $.post(target,query,function(data){
				$(that).removeClass('disabled').prop('disabled',false);
                if (data.status==1) {
					if($(that).hasClass('dialog_submit')){
						//对话框中的提交动作
						if (data.url) {
							window.parent.location.href=data.url;
						}else{
							window.parent.location.reload();
						}
					}else{
						if (data.url) {
							$.WeiPHP.toast(data.info + ' 页面即将自动跳转~',1);
						}else{
							$.WeiPHP.toast(data.info ,1);
						}
						setTimeout(function(){
							if (data.url) {
								location.href=data.url;
							}else{
								location.reload();
							}
						},1500);
					}
                }else{
					if($(that).hasClass('dialog_submit')){
						$.WeiPHP.toast(data.info,0);
					}else{
						$.WeiPHP.toast(data.info,0);
					}
                }
            });
        }
        return false;
    });
	$.WeiPHP.initWxApi();
	$('.page').css({'min-height':$(window).height()-124});
	$('.with_fixed_bar .page').css({'min-height':$(window).height()-186});
});