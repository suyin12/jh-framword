<?php

namespace Addons\WorkerService;
use Common\Controller\Addon;

/**
 * 员工服务插件
 * @author 无名
 */

    class WorkerServiceAddon extends Addon{

        public $info = array(
            'name'=>'WorkerService',
            'title'=>'员工服务',
            'description'=>'员工服务',
            'status'=>1,
            'author'=>'无名',
            'version'=>'0.1',
            'has_adminlist'=>0
        );

	public function install() {
		$install_sql = './Addons/WorkerService/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/WorkerService/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }