<?php

namespace Addons\BusinessAnalysis\Controller;

use Home\Controller\AddonsController;

class WapController extends AddonsController {
	var $dao;
	function _initialize() {
        $allowArr = array('552','759');
		if(!in_array($this->mid,$allowArr))
			exit();
		$this->dao = D ( 'BusinessAnalysis' );

	}

	// 首页
	function index() {

		$this->display ();
	}

//经营预警
    function warning(){
        $this->display ();

    }

    //入离职情况
    function workerStat(){
        $ret = $this->dao->workerStat();
        $data =$ret ['data'];
        foreach($data as $key=>$val){
            $total['mount'] +=$val['mount'];
            $total['dimission'] +=$val['dimission'];
        }
        $this->assign ( 'list_data', $data );
        $this->assign ( 'total', $total );
        $this->display ();
    }

    //费用审批
    function allowMoney(){
        $this->display();
    }


    //未收回欠款
    function requireMoney(){
        $ret = $this->dao->requireMoney();
        $data =$ret ['data'];
        foreach($data as $key=>$val){
            $total['managementCostMoney'] +=$val['managementCostMoney'];
            $total['soInsMoney'] +=$val['pSoInsMoney']+$val['uSoInsMoney'];
            $total['HFMoney'] +=$val['pHFMoney']+$val['uHFMoney'];
            if(($val['managementCostMoney']+$val['pSoInsMoney']+$val['uSoInsMoney']+$val['pHFMoney']+$val['uHFMoney'])<0){
                $list_data[$key] ['unitName'] = $val['unitName'];
                $list_data[$key]['soInsMoney']=$val['pSoInsMoney']+$val['uSoInsMoney'];
                $list_data[$key]['HFMoney']=$val['pHFMoney']+$val['uHFMoney'];
                $list_data[$key]['managementCostMoney']=$val['managementCostMoney'];
            }
        }
        $this->assign ( 'list_data', $list_data );
        $this->assign ( 'total', $total );
        $this->display();
    }


}
