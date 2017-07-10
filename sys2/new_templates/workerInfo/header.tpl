<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<title>员工系统</title>
	<link rel="stylesheet" href="lib/js/2016/main.css" />
</head>
<body>
<div id="header">
    <div id="loading" style="display: none;">
        正在加载....
    </div>
    <div id="menu">
        <ul class="menu">
            <li class="current">
                <a href="http://192.168.0.8/user/login/index.php" class="parent">
                    <span>
                        <img src="http://192.168.0.8/css/images/home.png" width="30px" height="30px">
                    </span>
                </a>
            </li>
            <li>
                <a href="http://192.168.0.8/recruitManage/tInfo.php" class="parent">
                    <span>
                        招聘管理
                    </span>
                </a>
                <ul style="display: none; left: -2px; width: 178px; height: 216px; overflow: hidden;">
                    <li>
                        <a href="http://192.168.0.8/recruitManage/requireManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                招聘需求
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E6%8B%9B%E8%81%98%E9%9C%80%E6%B1%82%E6%B7%BB%E5%8A%A0%E5%8F%8A%E7%AD%BE%E6%94%B6"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/planManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                招聘计划
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/marketAssess.php">
                            <span style="color: rgb(169, 169, 169);">
                                市场评估
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%B8%82%E5%9C%BA%E8%AF%84%E4%BC%B0"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/tInfo.php">
                            <span style="color: rgb(169, 169, 169);">
                                人才管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E4%BA%BA%E6%89%8D%E4%BF%A1%E6%81%AF%E7%AE%A1%E7%90%86%E6%96%B0%E5%A2%9E%E5%A4%8D%E8%AF%95%E9%80%9A%E7%9F%A5"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/jxconfirm.php">
                            <span style="color: rgb(169, 169, 169);">
                                统计信息
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/tInfoStatus.php">
                            <span style="color: rgb(169, 169, 169);">
                                待岗名单
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/drManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                工作管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%B7%A5%E4%BD%9C%E7%AE%A1%E7%90%86"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/marketManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                渠道管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E6%B8%A0%E9%81%93%E7%AE%A1%E7%90%86"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/recruitManage/positionManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                岗位管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%B2%97%E4%BD%8D%E7%AE%A1%E7%90%86"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="http://192.168.0.8/workerInfo/wInfo.php" class="parent">
                    <span>
                        员工信息管理
                    </span>
                </a>
                <ul style="display: none; left: -2px;">
                    <li>
                        <a href="http://192.168.0.8/workerInfo/wMountGuard.php">
                            <span style="color: rgb(169, 169, 169);">
                                员工入职登记
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E6%96%B0%E5%A2%9E%E5%85%A5%E8%81%8C%E5%91%98%E5%B7%A5"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/excelAction/readExcelParse.php?a=wMulInsert">
                            <span style="color: rgb(169, 169, 169);">
                                员工批量入职
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E6%96%B0%E5%A2%9E%E5%85%A5%E8%81%8C%E5%91%98%E5%B7%A5#批量员工入职操作方法"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/excelAction/readExcelParse.php?a=wMulModify">
                            <span style="color: rgb(169, 169, 169);">
                                员工信息批量更新
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%91%98%E5%B7%A5%E4%BF%A1%E6%81%AF%E4%BF%AE%E6%94%B9%E5%8F%8A%E6%9B%B4%E6%96%B0#批量修改员工信息"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/excelAction/readExcelParse.php?a=wMulModifySp">
                            <span style="color: rgb(169, 169, 169);">
                                无报表信息更新
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%91%98%E5%B7%A5%E4%BF%A1%E6%81%AF%E4%BF%AE%E6%94%B9%E5%8F%8A%E6%9B%B4%E6%96%B0#无申报表信息更新"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/workerInfo/wInfo.php">
                            <span style="color: rgb(169, 169, 169);">
                                员工信息查询
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%91%98%E5%B7%A5%E4%BF%A1%E6%81%AF%E4%BF%AE%E6%94%B9%E5%8F%8A%E6%9B%B4%E6%96%B0"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/workerInfo/wChangeSurvey.php">
                            <span style="color: rgb(169, 169, 169);">
                                员工变动概况分析
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%91%98%E5%B7%A5%E5%8F%98%E5%8A%A8%E6%A6%82%E5%86%B5%E5%88%86%E6%9E%90%E5%8F%8A%E4%BF%9D%E9%99%A9%E6%8A%A5%E8%A1%A8%E7%94%9F%E6%88%90"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/workerInfo/renewalContract.php">
                            <span style="color: rgb(169, 169, 169);">
                                员工合同续签
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%91%98%E5%B7%A5%E5%90%88%E5%90%8C%E5%88%B0%E6%9C%9F%E6%8F%90%E9%86%92%E5%8F%8A%E7%BB%AD%E7%AD%BE"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="parent">
                    <span>
                        保险管理
                    </span>
                </a>
                <ul style="display: none; left: -2px;">
                    <li>
                        <a href="http://192.168.0.8/soInsManage/soInsList.php">
                            <span style="color: rgb(169, 169, 169);">
                                社保管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E7%A4%BE%E4%BF%9D%E7%94%B3%E6%8A%A5%E8%A1%A8%E7%AD%BE%E6%94%B6%E5%8F%8A%E7%94%B3%E6%8A%A5"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/housingFundManage/HFListIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                公积金管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%85%AC%E7%A7%AF%E9%87%91%E7%94%B3%E6%8A%A5%E8%A1%A8%E7%AD%BE%E6%94%B6%E5%8F%8A%E7%94%B3%E6%8A%A5"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/comInsManage/comInsListIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                商业保险管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%95%86%E4%B8%9A%E4%BF%9D%E9%99%A9%E7%94%B3%E6%8A%A5%E8%A1%A8%E7%AD%BE%E6%94%B6%E5%8F%8A%E7%94%B3%E6%8A%A5"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/soInsManage/soInsBalFeeIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                社保平账
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/housingFundManage/HFBalFeeIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                公积金平账
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/comInsManage/comInsBalFeeIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                商保平账
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="http://192.168.0.8/salaryManage/salaryIndex.php" class="parent">
                    <span>
                        工资管理
                    </span>
                </a>
                <ul style="display: none; left: -2px;">
                    <li>
                        <a href="http://192.168.0.8/salaryManage/manageZF.php">
                            <span style="color: rgb(169, 169, 169);">
                                账套管理
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/salaryManage/salaryIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                工资导入与计算
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/rewardManage/rewardIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                奖金导入与计算
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/approval/feeApprovalIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                费用审批
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/salaryManage/salaryList.php">
                            <span style="color: rgb(169, 169, 169);">
                                单位费用汇总明细表
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="parent">
                    <span>
                        代理事务管理
                    </span>
                </a>
                <ul style="display: none; left: -2px;">
                    <li>
                        <a href="http://192.168.0.8/agencyService/archives.php">
                            <span style="color: rgb(169, 169, 169);">
                                档案管理
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/agencyService/residentialCards.php">
                            <span style="color: rgb(169, 169, 169);">
                                证件办理
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/agencyService/jobRegListIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                就业登记
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/agencyService/agencyManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                个人社保代理
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/oldOA/societyManager/51jobMain.php">
                            <span style="color: rgb(169, 169, 169);">
                                代理平账
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/agencyService/balanceMain.php">
                            <span style="color: rgb(169, 169, 169);">
                                代理平账(新版)
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/oldOA/societyManager/generalMain.php">
                            <span style="color: rgb(169, 169, 169);">
                                综合审批
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="parent">
                    <span>
                        统计分析
                    </span>
                </a>
                <ul style="display: none; left: -2px; width: 178px; height: 120px; overflow: hidden;">
                    <li>
                        <a href="http://192.168.0.8/leader/ledger.php">
                            <span style="color: rgb(169, 169, 169);">
                                台账
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/approval/feeApprovalIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                调账核实
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/approval/approvalIndex.php">
                            <span style="color: rgb(169, 169, 169);">
                                审批管理
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/leader/workerInfoSummary.php">
                            <span style="color: rgb(169, 169, 169);">
                                客户经理管理单位明细
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/leader/performanceSummary.php">
                            <span style="color: rgb(169, 169, 169);">
                                业务综合报表(实时)
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#" class="parent">
                    <span>
                        系统管理
                    </span>
                </a>
                <ul style="display: none; left: -2px; width: 178px; height: 192px; overflow: hidden;">
                    <li>
                        <a href="http://192.168.0.8/system/soIns_manager.php">
                            <span style="color: rgb(169, 169, 169);">
                                社保类型设置
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/system/comIns_manager.php">
                            <span style="color: rgb(169, 169, 169);">
                                商保类型设置
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E5%95%86%E4%BF%9D%E7%B1%BB%E5%9E%8B%E8%AE%BE%E7%BD%AE"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/system/unitinfo_manager.php">
                            <span style="color: rgb(169, 169, 169);">
                                单位管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E6%9C%8D%E5%8A%A1%E5%8D%95%E4%BD%8D%E7%AE%A1%E7%90%86"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/system/user_Manager.php">
                            <span style="color: rgb(169, 169, 169);">
                                用户管理
                            </span>
                        </a>
                        <a href="http://www.665588.cn/?wiki=%E7%B3%BB%E7%BB%9F%E7%94%A8%E6%88%B7%E7%AE%A1%E7%90%86"
                        target="_blank">
                            (帮助)
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/system/roleManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                角色及组管理
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/user/manage/changeUserInfo.php">
                            <span style="color: rgb(169, 169, 169);">
                                修改密码
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/SQL/SQLManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                数据库备份及恢复
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="http://192.168.0.8/system/approvalManage.php">
                            <span style="color: rgb(169, 169, 169);">
                                审批流程管理
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="back" style="left: 36px; width: 55px; overflow: hidden;">
                <div class="menuLeft">
                </div>
            </li>
        </ul>
    </div>
</div>



</body>
</html>