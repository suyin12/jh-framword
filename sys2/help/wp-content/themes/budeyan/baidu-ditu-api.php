<?php
/*
Template Name: baidu-ditu-api
*/
?>

<?php
	get_header();
?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div class="post" id="post-<?php the_ID(); ?>">
		<h2>
			<?php the_title(); ?>
		</h2>
		<div class="info">
			<span class="date"><?php the_modified_time(__('F jS, Y', 'budeyan')); ?></span>
			<?php if ($comments || comments_open()) : ?><span class="addcomment"><a href="#respond"><?php _e('Leave a comment', 'budeyan'); ?></a></span><span class="comments"><a href="#comments"><?php _e('Go to comments', 'budeyan'); ?></a></span>
			<?php endif; ?>
			<div class="fixed"></div>
		</div>
<style type="text/css">
	html,body{margin:0;padding:0;}
	div{margin: 0px;padding:0;text-indent:0px;}
	#dituContent{margin:10px 0px;}
    .iw_poi_title {color:#CC5522;font-size:14px;font-weight:bold;overflow:hidden;padding-right:13px;white-space:nowrap}
    .iw_poi_content {font:12px arial,sans-serif;overflow:visible;padding-top:4px;white-space:-moz-pre-wrap;word-wrap:break-word}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=67101c04114dca29743e2e6535d5ab89&v=1.1&services=true"></script>
  <!--百度地图容器-->
  <div style="width:580px;height:400px;border:#ccc solid 1px;" id="dituContent"></div>
</body>
<script type="text/javascript">
    //创建和初始化地图函数：
    function initMap(){
        createMap();//创建地图
        setMapEvent();//设置地图事件
        addMapControl();//向地图添加控件
        addMarker();//向地图中添加marker
        addPolyline();//向地图中添加线
        addRemark();//向地图中添加文字标注
    }
    
    //创建地图函数：
    function createMap(){
        var map = new BMap.Map("dituContent");//在百度地图容器中创建一个地图
        var point = new BMap.Point(113.693902,34.786627);//定义一个中心点坐标
        map.centerAndZoom(point,14);//设定地图的中心点和坐标并将地图显示在地图容器中
        window.map = map;//将map变量存储在全局
    }
    
    //地图事件设置函数：
    function setMapEvent(){
        map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
        map.enableScrollWheelZoom();//启用地图滚轮放大缩小
        map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
        map.enableKeyboard();//启用键盘上下左右键移动地图
    }
    
    //地图控件添加函数：
    function addMapControl(){
        //向地图中添加缩放控件
	var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_RIGHT,type:BMAP_NAVIGATION_CONTROL_LARGE});
	map.addControl(ctrl_nav);
        //向地图中添加缩略图控件
	var ctrl_ove = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT,isOpen:1});
	map.addControl(ctrl_ove);
        //向地图中添加比例尺控件
	var ctrl_sca = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT});
	map.addControl(ctrl_sca);
    }
    
    //标注点数组
    var markerArr = [{title:"不得言博客",content:"地址：<a href='http://www.budeyan.com/'>www.budeyan.com</a><br/><br/>简介：关注互联网安全，SEO搜索引擎优化，服务器维护，CMS网站应用。",point:"113.693273|34.786219",isOpen:1,icon:{w:23,h:25,l:46,t:21,x:9,lb:12}}
		 ,{title:"不得言徐砦住处",content:"不得言博客：<a href='http://www.budeyan.com/'>www.budeyan.com</a><br/><br/>这是不得言在郑州金水区徐砦某小区租住的房子。",point:"113.682336|34.810925",isOpen:0,icon:{w:21,h:21,l:23,t:46,x:1,lb:10}}
		 ,{title:"不得言中牟住处",content:"不得言博客：<a href='http://www.budeyan.com/'>www.budeyan.com</a><br/><br/>不得言中牟住处",point:"114.028287|34.742746",isOpen:0,icon:{w:21,h:21,l:92,t:46,x:1,lb:10}}
		 ,{title:"上下班路线",content:"不得言博客：<a href='http://www.budeyan.com/'>www.budeyan.com</a><br/><br/>不得言骑山地车上下班路线。全长四公里。",point:"113.694126|34.801522",isOpen:0,icon:{w:21,h:21,l:23,t:0,x:6,lb:5}}
		 ,{title:"骑行中牟路线",content:"不得言博客：<a href='http://www.budeyan.com/'>www.budeyan.com</a><br/><br/>不得言骑行中牟线路。全长35公里，大概用一个半小时。",point:"113.726034|34.785515",isOpen:0,icon:{w:21,h:21,l:92,t:0,x:6,lb:5}}
		 ];
    //创建marker
    function addMarker(){
        for(var i=0;i<markerArr.length;i++){
            var json = markerArr[i];
            var p0 = json.point.split("|")[0];
            var p1 = json.point.split("|")[1];
            var point = new BMap.Point(p0,p1);
			var iconImg = createIcon(json.icon);
            var marker = new BMap.Marker(point,{icon:iconImg});
			var iw = createInfoWindow(i);
			var label = new BMap.Label(json.title,{"offset":new BMap.Size(json.icon.lb-json.icon.x+10,-20)});
			marker.setLabel(label);
            map.addOverlay(marker);
            label.setStyle({
                        borderColor:"#808080",
                        color:"#333",
                        cursor:"pointer"
            });
			
			(function(){
				var index = i;
				var _iw = createInfoWindow(i);
				var _marker = marker;
				_marker.addEventListener("click",function(){
				    this.openInfoWindow(_iw);
			    });
			    _iw.addEventListener("open",function(){
				    _marker.getLabel().hide();
			    })
			    _iw.addEventListener("close",function(){
				    _marker.getLabel().show();
			    })
				label.addEventListener("click",function(){
				    _marker.openInfoWindow(_iw);
			    })
				if(!!json.isOpen){
					label.hide();
					_marker.openInfoWindow(_iw);
				}
			})()
        }
    }
    //创建InfoWindow
    function createInfoWindow(i){
        var json = markerArr[i];
        var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>"+json.content+"</div>");
        return iw;
    }
    //创建一个Icon
    function createIcon(json){
        var icon = new BMap.Icon("http://openapi.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w,json.h),{imageOffset: new BMap.Size(-json.l,-json.t),infoWindowOffset:new BMap.Size(json.lb+5,1),offset:new BMap.Size(json.x,json.h)})
        return icon;
    }
//标注线数组
    var plPoints = [{style:"solid",weight:4,color:"#f00",opacity:1,points:["113.693255|34.786234","113.693911|34.786249","113.693879|34.787256","113.693897|34.789458","113.693861|34.792229","113.694014|34.794208","113.694337|34.798247","113.694445|34.799981","113.694355|34.801708","113.691274|34.802345","113.688094|34.802834","113.688058|34.804775","113.683126|34.805627","113.683055|34.810599","113.682363|34.810644","113.682363|34.81094"]}
		 ,{style:"solid",weight:3,color:"#f0f",opacity:1,points:["113.693264|34.786249","113.693902|34.786241","113.693767|34.78255","113.698941|34.78255","113.698941|34.780356","113.714248|34.780297","113.715829|34.78255","113.727112|34.78593","113.730705|34.786582","113.734298|34.78593","113.742419|34.782965","113.748096|34.778103","113.750468|34.773833","113.751187|34.769267","113.781729|34.776887","113.803863|34.781394","113.82456|34.783054","113.848132|34.782817","113.865954|34.780682","113.896137|34.784951","113.949892|34.787264","113.958156|34.779852","113.973104|34.771194","113.982662|34.761824","113.989777|34.756664","114.006737|34.74124","114.017911|34.739312","114.018415|34.740588","114.020139|34.741329","114.027685|34.739906","114.028116|34.742768"]}
		 ];
    //向地图中添加线函数
    function addPolyline(){
		for(var i=0;i<plPoints.length;i++){
			var json = plPoints[i];
			var points = [];
			for(var j=0;j<json.points.length;j++){
				var p1 = json.points[j].split("|")[0];
				var p2 = json.points[j].split("|")[1];
				points.push(new BMap.Point(p1,p2));
			}
			var line = new BMap.Polyline(points,{strokeStyle:json.style,strokeWeight:json.weight,strokeColor:json.color,strokeOpacity:json.opacity});
			map.addOverlay(line);
		}
	}
//文字标注数组
    var lbPoints = [{point:"114.16085|34.691452",content:"我的标记"}
		 ];
    //向地图中添加文字标注函数
    function addRemark(){
        for(var i=0;i<lbPoints.length;i++){
            var json = lbPoints[i];
            var p1 = json.point.split("|")[0];
            var p2 = json.point.split("|")[1];
            var label = new BMap.Label("<div style='padding:2px;'>"+json.content+"</div>",{point:new BMap.Point(p1,p2),offset:new BMap.Size(3,-6)});
            map.addOverlay(label);
            label.setStyle({borderColor:"#999"});
        }
    }
    
    initMap();//创建和初始化地图
</script>
		<div class="content">
			<?php the_content(); ?>
            <div class="fixed"></div>
		</div>
		<div class="fixed"></div>
	</div>

	<?php include('templates/comments.php'); ?>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'budeyan'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
