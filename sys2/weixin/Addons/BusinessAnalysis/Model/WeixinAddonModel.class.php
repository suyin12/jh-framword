<?php
        	
namespace Addons\BusinessAnalysis\Model;
use Home\Model\WeixinModel;
        	
/**
 * BusinessAnalysis的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'BusinessAnalysis' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	