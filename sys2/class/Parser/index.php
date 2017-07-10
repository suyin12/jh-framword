<?php
/*    <<<<<<<<  批量导入首页  >>>>>>>>>
 * 
 * 该文档被我改得一大堆
 * 除了显示部分和读取excel部分,其他的全都改了...
 * smarty  都可以做,但是没用着做,,
 * 
  和之前相比呢..其实就是增加了 验证函数和一个基本配置函数,

  验证函数{  validator()  }返回的结果集为 $error的数组形式,错误类型,错误的数据,当返回的结果集为true时,则进行导入操作,,

  基本的配置函数{  set()  }返回的数组类型 包括, 导入的表名$db_table,该功能的文件名$title,导入的字段名$field,导入的表显示格式$fieldHeader,

  使用get操作方法,判断具体是哪个批量导入功能,对应的使用相应的函数
 * */
require_once ('../../auth.php');
require_once (sysPath . "class/Parser/excelparser.php");
require_once ("includes.php");
//require_once ('../../common.function.php');

if (!isset($_POST ['step']))
    $_POST ['step'] = 0;
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href='<?php echo httpPath . "css/main.css" ?>' type="text/css" rel="stylesheet" />
        <script type="text/javascript" src='<?php echo httpPath . "lib/jquery/jquery-1.4.2.min.js" ?>'></script>
        <script type="text/javascript" src='<?php echo httpPath . "lib/js/menu.js" ?>'></script>
    </head>
    <body>
        <div id="header">
            <div id='loading'>正在加载....</div>
            <div id="menu">
                <ul class="menu">
                    <li><a href="<?php echo httpPath; ?>recruitManage/tInfo.php" class="parent"><span>招聘管理</span></a>
                        <ul>
                            <li><a href="<?php echo httpPath; ?>recruitManage/requireManage.php">招聘需求</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/planManage.php">招聘计划</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/marketAssess.php">市场评估</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/tInfo.php">人才管理</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/statistics.php">统计信息</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/waitingList.php" >待岗名单</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/drManage.php">工作管理</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/marketManage.php">渠道管理</a></li>
                            <li><a href="<?php echo httpPath; ?>recruitManage/positionManage.php">岗位管理</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo httpPath; ?>workerInfo/wInfo.php" class="parent"><span>员工信息管理</span></a>
                        <ul>
                            <li><a href="<?php echo httpPath; ?>workerInfo/wMountGuard.php">员工入职登记</a></li>
                            <li><a href="<?php echo httpPath; ?>class/Parser/index.php?a=wMulInsert">员工批量入职</a></li>
                            <li><a href="<?php echo httpPath; ?>class/Parser/index.php?a=wMulModify">员工信息批量更新</a></li>
                            <li><a href="<?php echo httpPath; ?>workerInfo/wInfo.php">员工信息查询及更新</a></li>
                            <li><a href="<?php echo httpPath; ?>workerInfo/wChangeSurvey.php">员工信息变动概况分析</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo httpPath; ?>soInsManage/soInsList.php" class="parent"><span>保险管理</span></a>
                        <ul>
                            <li><a href="<?php echo httpPath; ?>soInsManage/soInsList.php">社保管理</a></li>
                            <li><a href="<?php echo httpPath; ?>housingFundManage/HFListIndex.php">公积金管理</a></li>
                            <li><a href="<?php echo httpPath; ?>comInsManage/comInsListIndex.php">商业保险管理</a></li>
                            <li><a href="<?php echo httpPath; ?>soInsManage/soInsBalFeeIndex.php" >社保平账</a></li>
                            <li><a href="<?php echo httpPath; ?>housingFundManage/HFBalFeeIndex.php" >公积金平账</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo httpPath; ?>salaryManage/salaryIndex.php" class="parent"><span>工资管理</span></a>
                        <ul>
                            <li><a href="<?php echo httpPath; ?>salaryManage/manageZF.php" >账套管理</a></li>
                            <li><a href="#">费用申请</a></li>
                            <li><a href="<?php echo httpPath; ?>salaryManage/salaryIndex.php" >工资导入与计算</a></li>
                            <li><a href="<?php echo httpPath; ?>rewardManage/rewardIndex.php" >奖金导入与计算</a></li>
                            <li><a href="<?php echo httpPath; ?>approval/feeApprovalIndex.php" >费用审批</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo httpPath; ?>oldOA/societyManager/51jobMain.php" class="parent"><span>代理事务管理</span></a>
                        <ul>
                            <li><a href="<?php echo httpPath; ?>agencyService/archives.php">档案管理</a></li>
                            <li><a href="#">职称申报</a></li>
                            <li><a href="#">市外招调入户</a></li>
                            <li><a href="#">户口挂靠</a></li>
                            <li><a href="<?php echo httpPath; ?>agencyService/residentialCards.php?status=0&people=&name=&idcard=">证件办理</a></li>
                            <li><a href="<?php echo httpPath; ?>agencyService/jobRegListIndex.php">就业登记</a></li>
                            <li><a href="<?php echo httpPath; ?>agencyService/dangtuangong.php">党团工会</a></li>
                            <li><a href="#">培训教育</a></li>
                            <li><a href="<?php echo httpPath; ?>agencyService/agencyManage.php">个人社保代理</a></li>
                            <li><a href="<?php echo httpPath; ?>oldOA/societyManager/51jobMain.php">代理平账</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="parent"><span>财务管理</span></a>
                        <ul>
                            <li><a href="#">银行发放表</a></li>
                            <li><a href="#">待付款项</a></li>
                            <li><a href="#">应付账款</a></li>
                            <li><a href="#">款项返还</a></li>
                            <li><a href="#">已付款查询</a></li>
                            <li><a href="#">地税申报</a></li>
                            <li><a href="#">现金收款</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo httpPath; ?>leader/workerInfoSummary.php" class="parent"><span>统计分析</span></a>
                        <ul>
                            <li><a href="<?php echo httpPath; ?>leader/ledger.php">台账</a></li>
                            <li><a href="<?php echo httpPath; ?>approval/feeApprovalIndex.php">调账核实</a></li>
                            <li><a href="<?php echo httpPath; ?>approval/approvalIndex.php">审批管理</a></li>
                            <li><a href="<?php echo httpPath; ?>leader/workerInfoSummary.php" target="_blank">客户经理管理单位明细</a></li>
                            <li><a href="<?php echo httpPath; ?>leader/performanceSummary.php" target="_blank">业务综合报表(实时)</a></li>
                            <li><a href="#">报表查询</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="parent"><span>系统设置</span></a>
                        <ul>
                            <li><a href="#">银行代发模板设置</a></li>
                            <li><a href="#">个人所得税设置</a></li>
                            <li><a href="#">现金收款收费方式设置</a></li>
                            <li><a href="#">基础数据字典设置</a></li>
                            <li><a href="#">社保类型设置</a></li>
                            <li><a href="#">商保类型设置</a></li>
                            <li><a href="#">档案材料名称设置</a></li>
                            <li><a href="#">系统初始参数设置</a></li>
                            <li><a href="<?php echo httpPath; ?>user/manage/userManage.php">组维护</a></li>
                            <li><a href="#">组权限设置</a></li>
                            <li><a href="#">组织机构设置</a></li>
                            <li><a href="#">操作员设置</a></li>
                            <li><a href="<?php echo httpPath; ?>user/manage/changeUserInfo.php">修改密码</a></li>
                            <li><a href="#">系统操作日志</a></li>
                            <li><a href="#">数据库备份</a></li>
                            <li><a href="#">数据库恢复</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div id="visual">
            <!--虚拟DIV,用于控制层-->
        </div>
        <div id="main">   
            <fieldset><legend><code>无公式EXCEL导入</code></legend>
                <table width="100%" align="center" bgcolor="#4f6b72">
                    <tr>
                        <td width="100%"><font color="#FFFFFF" size="+2"></font></td>
                    </tr>
                </table>

                <?php
// Outputting fileselect form (step 0)


                /**
                 * 简单的应用
                 */
                if ($_POST ['step'] == 0)
                    echo <<<FORM
<table width="100%" border="0" align="center">
<tr>
<td>&nbsp;</td>
<td>
<p>&nbsp;</p>
选择一个Excel文档
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>

<table border="0">
<form name="exc_upload" class="form" method="post" action="" enctype="multipart/form-data">

<tr><td>Excel文档:</td><td><input type="file" size="25" name="excel_file"></td></tr>
<tr ><td>第一行为标题栏:</td><td><input type="checkbox" name="useheaders" checked></td></tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="step" value="1">
<input type="button" value="下一步" onClick="
javascript:
if( (document.exc_upload.excel_file.value.length==0))
{ alert('请选择Excel文档'); return; }; submit();
"></td></tr>


</form>
</table>

</td>
</tr>


<tr>
<td>&nbsp;</td>
<td align="right">
<p>&nbsp;</p>
</td>
</tr>
</table>

FORM;

// Processing excel file (step 1)


                if ($_POST ['step'] == 1) {
                    echo "<br>";
                    $excel_file = $_FILES ['excel_file'];    
                    #解决文件名中文的情况
                    $_FILES ['excel_file'] ['name'] = iconv("GBK", "utf-8", $_FILES ['excel_file'] ['name']);
                    $_FILES ['excel_file'] ['tmp_name'] = iconv("GBK", "utf-8", $_FILES ['excel_file'] ['tmp_name']);

                    if ($excel_file)
                        $excel_file = $_FILES ['excel_file'] ['tmp_name'];

                    if ($excel_file == '')
                        fatal("没上传文件或重命名文件名");

                    move_uploaded_file($excel_file, 'upload/' . $_FILES ['excel_file'] ['name']);
                    $excel_file = 'upload/' . $_FILES ['excel_file'] ['name'];

                    $fh = @fopen($excel_file, 'rb');
                    if (!$fh)
                        fatal("没上传文件或者文件名是中文,建议把文件名改为数字如'20081018'");
                    if (filesize($excel_file) == 0)
                        fatal("没上传文件或者文件名是中文");

                    $fc = fread($fh, filesize($excel_file));
                    @fclose($fh);
                    if (strlen($fc) < filesize($excel_file))
                        fatal("Cannot read file");

                    // Check excel file


                    $exc = new ExcelFileParser ();
                    $res = $exc->ParseFromString($fc);

                    switch ($res) {
                        case 0 :
                            break;
                        case 1 :
                            fatal("无法打开文件");
                        case 2 :
                            fatal("文件太小,不是一个Excel文档");
                        case 3 :
                            fatal("无法读取文件头");
                        case 4 :
                            fatal("读取文件时出错");
                        case 5 :
                            fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
                        case 6 :
                            fatal("File corrupted");
                        case 7 :
                            fatal("Excel文档中没有数据或者该文档不是Excel文档");
                        case 8 :
                            fatal("不支持文件的版本");

                        default :
                            fatal("未知错误");
                    }

                    // Pricessing worksheets


                    $ws_number = count($exc->worksheet ['name']);
                    if ($ws_number < 1)
                        fatal("在 Excel文件中没有sheet.");

                    $ws_number = 1; // Setting to process only the first worksheet
                    $ws_n = 0;
                    $ws = $exc->worksheet ['data'] [$ws_n]; // Get worksheet data
                    #加载相应的类文件(基本配置函数,及验证函数)
                    $actionUrl = $_GET ['a'];
                    $cellVal = cellVal($ws, $exc);
                    switch ($actionUrl) {
                        case "wMulInsert" :
                        case "wMulInsertSp" :
                            require_once sysPath . 'workerInfo/' . $actionUrl . '.php';
                            $valid = new $actionUrl ();
                            $valid->p = $pdo;
                            $cellVal = $valid->cellArray($cellVal);
                            $colValid = $valid->cellArray;
                            if ($colValid) {
                                //生成异常数据数组
                                $errMsg = $valid->validator();
                                $errMsgSql = $valid->validatorSql();
                                //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
                                //				$cellArray = $valid->extraFieldValue ();
                            }
                            break;
                        case "wMulModify" :
                        case "wMulModifyDimission":
                        case "wMulModifySoIns":
                            require_once sysPath . 'workerInfo/' . $actionUrl . '.php';
                            $valid = new $actionUrl ();
                            $valid->p = $pdo;
                            $cellVal = $valid->cellArray($cellVal);
                            $colValid = $valid->cellArray;
                            if ($colValid) {
                                //生成异常数据数组
                                $errMsg = $valid->validator();
                                $errMsgSql = $valid->validatorSql();
                                //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
                                //				$cellArray = $valid->extraFieldValue ();
                            }
                            break;
                        default :
                            exit("非法网址");
                            break;
                    }
                    #抛出错误信息
                    if ($colValid) {
                        //	var_dump ( $errorMessage );
                        if (!empty($errMsg) || !empty($errMsgSql)) {
                            echo fetchArray($errMsg);
                            echo "<br/>";
                            echo fetchArray($errMsgSql);
                        } else {
                            switch ($actionUrl) {

                                case "wMulInsert" :
                                case "wMulInsertSp":
                                case "wMulModify" :
                                case "wMulModifyDimission" :
                                case "wMulModifySoIns":
                                    //生成相应信息
                                    echo $valid->dataInfo();
                                    break;
                            }
                            if (!$exc->worksheet ['unicode'] [$ws_n])
                                $db_table = $ws_name = $exc->worksheet ['name'] [$ws_n];
                            else {
                                $ws_name = uc2html($exc->worksheet ['name'] [$ws_n]);
                                $db_table = convertUnicodeString($exc->worksheet ['name'] [$ws_n]);
                            }

                            echo "<div align=\"left\">当前文档: <b>$ws_name</b></div><br>";

                            $max_row = $ws ['max_row'];
                            $max_col = $ws ['max_col'];
                            //			var_dump($max_col);
                            if ($max_row > 0 && $max_col > 0)
                                getTableData($ws, $exc); // Get structure and data of worksheet
                            else
                                fatal("空文档");
                        }
                    } else {
                        echo "1.请验证你的表格数据列是否完整";
                    }
                }
                if ($_POST ['step'] == 2) {
                    // Adding data into mysql (step 2)


                    $excel_file = $_POST ['excel_file'];
                    $fh = @fopen($excel_file, 'rb');
                    if (!$fh)
                        fatal("请重新上传文件,禁止非法刷新重复添加");
                    if (filesize($excel_file) == 0)
                        fatal("没上传文件或者文件名是中文");

                    $fc = fread($fh, filesize($excel_file));
                    @fclose($fh);
                    if (strlen($fc) < filesize($excel_file))
                        fatal("Cannot read file");

                    // Check excel file


                    $exc = new ExcelFileParser ();
                    $res = $exc->ParseFromString($fc);

                    switch ($res) {
                        case 0 :
                            break;
                        case 1 :
                            fatal("无法打开文件");
                        case 2 :
                            fatal("文件太小,不是一个Excel文档");
                        case 3 :
                            fatal("无法读取文件头");
                        case 4 :
                            fatal("读取文件时出错");
                        case 5 :
                            fatal("这不是一个Excel文档,请选择版本低于5.0 的Excel");
                        case 6 :
                            fatal("File corrupted");
                        case 7 :
                            fatal("Excel文档中没有数据或者该文档不是Excel文档");
                        case 8 :
                            fatal("不支持文件的版本");

                        default :
                            fatal("未知错误");
                    }

                    // Pricessing worksheets


                    $ws_number = count($exc->worksheet ['name']);
                    if ($ws_number < 1)
                        fatal("在 Excel文件中没有sheet.");

                    $ws_number = 1; // Setting to process only the first worksheet
                    $ws_n = 0;
                    $ws = $exc->worksheet ['data'] [$ws_n]; // Get worksheet data
                    #加载相应的类文件(基本配置函数,及验证函数)
                    $actionUrl = $_GET ['a'];
                    $cellVal = cellVal($ws, $exc);


                    switch ($actionUrl) {

                        case "wMulInsert" :
                        case "wMulInsertSp":
                        case "wMulModify" :
                        case "wMulModifyDimission":
                        case "wMulModifySoIns":
                            require_once (sysPath . 'workerInfo/' . $actionUrl . '.php');
                            $valid = new $actionUrl ();
                            $valid->p = $pdo;
                            $cellVal = $valid->cellArray($cellVal);
                            //生成相应的的社保购买soInsurance =1 或者 资料的完整性编码 status=1/2
                            $cellArray = $valid->extraFieldValue();
                            $sql = $valid->sql();
                            break;
                    }
                    $result = $valid->transaction($sql);
                    //	var_dump($result);
                    $err = $result ['error'];
                    $execNum = $result ['num'];
                    if (!empty($err)) {
                        $err .= "<br/>发生未知错误,请联系管理员";
                    } else {
                        switch ($actionUrl) {
                            case "wMulModify" :
                            case "wMulModifyDimission":
                            case "wMulModifySoIns":
                                $result = @$valid->extraTransaction($sql ['extra']);
                                break;
                        }
                    }


                    /*
                     *  这里用三次条件限制筛选出需要在人才表中标记”已上岗“状态的ID，然后做标记
                     *  三次条件分别为“姓名+身份证号+电话”，“姓名+电话”，“姓名”，经前两个筛选后，重名的所剩无几，
                     *  如果还有的话，那。。。只好安心上路了
                     */

                    if ($actionUrl == "wMulInsert") {
                        $cellVal = $valid->cellArray;

                        foreach ($cellVal as $k => $v) {

                            $sql_update = "select talentID from a_talent where name = '" . $v['name'] . "' and telephone = '" .
                                    $v['mobilePhone'] . "' and idCard = '" . $v['pID'] . "'";
                            $ret = $pdo->query($sql_update);
                            $rows = $ret->rowCount();
                            if ($rows == 1) {
                                $res = $ret->fetch(PDO::FETCH_ASSOC);
                                $cellVal_update[] = $res['talentID'];
                            } else {
                                $cellVal_2[$k] = $v;
                            }
                        }

                        foreach ($cellVal_2 as $k => $v) {

                            $sql_update = "select talentID from a_talent where name = '" . $v['name'] . "' and telephone = '" . $v['mobilePhone'] . "'";
                            $ret = $pdo->query($sql_update);
                            $rows = $ret->rowCount();
                            if ($rows == 1) {
                                $res = $ret->fetch(PDO::FETCH_ASSOC);
                                $cellVal_update[] = $res['talentID'];
                            } else {
                                $cellVal_3[$k] = $v;
                            }
                        }

                        foreach ($cellVal_3 as $k => $v) {

                            $sql_update = "select talentID from a_talent where name = '" . $v['name'] . "'";
                            $ret = $pdo->query($sql_update);
                            $rows = $ret->rowCount();
                            if ($rows == 1) {
                                $res = $ret->fetch(PDO::FETCH_ASSOC);
                                $cellVal_update[] = $res['talentID'];
                            } else {
                                $cellVal_4[$k] = $v;
                            }
                        }


                        $talent_str = implode(",", $cellVal_update);
                        if (!$talent_str)
                            $talent_str = "0";
                        $sql_talent_upd = "update a_talent set sign = '4' where talentID in (" . $talent_str . ")";



                        $ret = $pdo->query($sql_talent_upd);
                        $rows_update = $ret->rowCount();

                        if ($execNum != $rows_update) {
                            foreach ($cellVal_4 as $v) {
                                $tips_str .= "<p>" . $v['name'] . "</p>";
                            }
                        }
                    }
                    if (empty($err)) {
                        $insertInfo .= '<div align="center"><b>添加记录成功.</b><br><br>	总共' . $execNum .
                                '行插入表中 ';
                        if ($actionUrl == "wMulInsert") {
                            $insertInfo .= '<br/>人才库中有' . $rows_update . '条记录匹配<br />';
                            if ($execNum != $rows_update)
                                $insertInfo .= '<span style=\'color:red;\'>未匹配的记录如下:(不影响员工入职)<br />' . $tips_str . '</span></div>';
                            else
                                $insertInfo .= '</div>';
                        }
                        echo $insertInfo;
                    } else
                        echo "<br><br><div align=\"center\"><font color=\"red\">$err</font><br><br><a href='index.php?a=$actionUrl>继续</a></div>";

                    @unlink($excel_file);
                }
                ?>
            </fieldset>       
        </div>
        <div id="footer">
            <script>
                $('#loading').fadeOut("slow"); 
            </script>
            <hr />

            <br />
        </div>

    </body>
</html>