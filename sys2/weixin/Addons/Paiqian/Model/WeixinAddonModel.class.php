<?php
        	
namespace Addons\Paiqian\Model;
use Home\Model\WeixinModel;
        	
/**
 * Paiqian的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'Paiqian' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	