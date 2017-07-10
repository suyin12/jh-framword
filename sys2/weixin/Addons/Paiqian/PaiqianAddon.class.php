<?php

namespace Addons\Paiqian;
use Common\Controller\Addon;

/**
 * 派遣功能插件
 * @author 凡星
 */

    class PaiqianAddon extends Addon{

        public $info = array(
            'name'=>'Paiqian',
            'title'=>'派遣功能',
            'description'=>'派遣项目的主要功能实现',
            'status'=>1,
            'author'=>'凡星',
            'version'=>'0.1',
            'has_adminlist'=>1
        );

	public function install() {
		$install_sql = './Addons/Paiqian/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Paiqian/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }