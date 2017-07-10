<?php

namespace Addons\Paiqian\Controller;

use Home\Controller\AddonsController;

class SlideshowController extends AddonsController {
	var $model;
	function _initialize() {
		$this->model = $this->getModel ( 'paiqian_slideshow' );
		$this->assign ( 'nav', array () );
	}
	// 通用插件的列表模型
	public function lists() {
		$map ['token'] = get_token ();
		session ( 'common_condition', $map );
		
		$list_data = $this->_get_model_list ( $this->model );
		foreach ( $list_data ['list_data'] as &$vo ) {
			$vo ['img'] = '<img src="' . get_cover_url ( $vo ['img'] ) . '" width="50px" >';
		}
		$this->assign ( $list_data );
		// dump ( $list_data );
		
		$this->display ();
	}
	// 通用插件的编辑模型
	public function edit() {
		parent::common_edit ( $this->model );
	}
	
	// 通用插件的增加模型
	public function add() {
		parent::common_add ( $this->model );
	}
	
	// 通用插件的删除模型
	public function del() {
		parent::common_del ( $this->model );
	}
	// 首页
	function index() {
		$this->display ();
	}
	// 分类列表
	function category() {
		$this->display ();
	}
	// 相册模式
	function picList() {
		$this->display ();
	}
	// 详情
	function detail() {
		$this->display ();
	}
}
