<?php

/*
 *     2010-5-12
 *          <<<读取EXCEL; 可以读取多个sheet , 并且可以把多个sheet的数组 合并数据,但是多个sheet格式必须一致 
 *             设置get参数mulSheet=1 则合并数据,否则默认为第一个sheet,,,,最主要的是暂时不开放多个sheet的功能,,,
 *             需要用是 只需设置GET参数即可
 *            >>>
 *      create by  Great sToNe
 *     
 *       have fun, wa Ha Ha..
 */
#验证权限
require_once '../auth.php';
#连接模板文件
require_once sysPath . 'templateConfig.php';
#通用函数库
require_once sysPath . 'common.function.php';
#连接EXCEL类
require_once sysPath . 'class/phpExcel/Classes/PHPExcel.php';
require_once sysPath . 'class/phpExcel/Classes/PHPExcel/IOFactory.php';
#输出错误信息
function fatal($msg = '')
{
	$errorMsg = '[错误提示]';
	if (strlen ( $msg ) > 0)
		$errorMsg .= ": $msg";
	$errorMsg .= "<br>\n读取脚本终止<br>\n";
	exit ( $errorMsg );
}
function excelToArray($file, $startRow)
{
	ini_set ( 'memory_limit', '512M' );
	//	$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory;
	//	PHPExcel_Settings::setCacheStorageMethod ( $cacheMethod );
	

	$objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );
	$objReader->setReadDataOnly ( true );
	$objPHPExcel = $objReader->load ( $file );
	$objWorksheet = $objPHPExcel->getActiveSheet ();
	$highestRow = $objWorksheet->getHighestRow ();
	$highestColumn = $objWorksheet->getHighestColumn ();
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn );
	$excelData = array ();
	$i = 0;
	for($row = $startRow; $row <= $highestRow; ++ $row) {
		for($col = 0; $col < $highestColumnIndex; ++ $col) {
			$excelData [$i] [] = trim ( $objWorksheet->getCellByColumnAndRow ( $col, $row )->getValue () );
		}
		$i ++;
	}
	return $excelData;
}

$actionUrl = $_GET ['a'];
if (! isset ( $_POST ['step'] ))
	$_POST ['step'] = '0';

$title = "";

switch ($actionUrl) {
	case "recruitMarksMulInsert" :
		#链接招聘模块各类库的关联文件
		require_once sysPath . 'recruitManage/requireClassFile.php';
		
		#获取招聘相关信息设置数组
		$c = new recruitInfoSet ();
		$c->pdo = $pdo;
		$c->recruitInfoSetBasic ();
		$trainArr = $c->recruitInfoSetArr ['trainArr'];
		
		foreach ( $_GET as $getKey => $getVal ) {
			switch ($getKey) {
				case "status" :
					if (is_numeric ( $getVal ))
						$getQuery [$getKey] = $getVal;
					else
						exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
					break;
				default :
					$getQuery [$getKey] = $getVal;
					break;
			}
		}
		#加载额外的选项,
		switch ($_GET ['status']) {
			case "7" :
				$extraFieldset = "<select name='trainClassicID' class='validate[required]'><option value=''>--请选择--</option>";
				foreach ( $trainArr as $tKey => $tVal ) {
					$extraFieldset .= "<option value='$tKey'>" . $tVal ['name'] . "</option>";
				}
				$extraFieldset .= "</select>";
				break;
		}
		
		break;
}
if ($_POST ['step'] == "1") {
	$excel_file = $_FILES ['excel_file'];
	//	解决文件名中文的情况
	$_FILES ['excel_file'] ['name'] = iconv ( "GBK", "utf-8", $_FILES ['excel_file'] ['name'] );
	$_FILES ['excel_file'] ['tmp_name'] = iconv ( "GBK", "utf-8", $_FILES ['excel_file'] ['tmp_name'] );
	
	if ($excel_file)
		$excel_file = $_FILES ['excel_file'] ['tmp_name'];
	if ($excel_file == '')
		$errorMsg = fatal ( "没上传文件或重命名文件名" );
	
	move_uploaded_file ( $excel_file, 'upload/' . $_FILES ['excel_file'] ['name'] );
	$excel_file = 'upload/' . $_FILES ['excel_file'] ['name'];
	
	$fh = @fopen ( $excel_file, 'rb' );
	if (! $fh)
		$errorMsg = fatal ( "没上传文件" );
	if (filesize ( $excel_file ) == 0)
		$errorMsg = fatal ( "没上传文件,或文件过小" );
	
	$fc = fread ( $fh, filesize ( $excel_file ) );
	@fclose ( $fh );
	if (strlen ( $fc ) < filesize ( $excel_file ))
		$errorMsg = fatal ( "无法读取文件" );
	
	if (! $errorMsg) {
		$smarty->assign ( "excel_file", $excel_file );
		//取得有效行,并且去除每个单元格空格
		if ($_POST ['startRow']) {
			$startRow = $_POST ['startRow'];
			$newCellVal = excelToArray ( $excel_file, $startRow );
		}
		#加载相应的类文件(基本配置函数,及验证函数)
		switch ($actionUrl) {
			case "salaryMulInsert" :
				require_once sysPath . 'salaryManage/salaryMulInsert.php';
				$valid = new salaryMulInsert ();
				$valid->p = $pdo;
				$valid->zID = $_GET ['zID'];
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "zID" :
						case "unitID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "month" :
						case "salaryDate" :
						case "soInsDate" :
						case "HFDate" :
						case "comInsDate" :
						case "managementCostDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				
				$errMsg = $valid->validator ();
				if ($_GET ['mulFee'] != "mul")
					$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			case "rewardMulInsert" :
				require_once sysPath . 'rewardManage/rewardMulInsert.php';
				$valid = new rewardMulInsert ();
				$valid->p = $pdo;
				$valid->zID = $_GET ['zID'];
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "zID" :
						case "unitID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "month" :
						case "rewardDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				
				$errMsg = $valid->validator ();
				break;
			case "soInsFeeMulInsert" :
			case "soInsFeeCooMulInsert" :
				require_once sysPath . 'soInsManage/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "soInsID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "soInsDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			case "HFFeeMulInsert" :
				require_once sysPath . 'housingFundManage/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "housingFundID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "HFDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			case "soInsFeeAgmInsert" :
				require_once sysPath . 'agencyService/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "soInsID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "soInsDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
					 		break;
					}
				}
				$getQuery["soInsID"] = $_POST["soInsID"];
				$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			case "soInsFeeMulAgmInsert" :
				require_once sysPath . 'agencyService/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "soInsID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "soInsDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
					 		break;
					}
				}
				$getQuery["soInsID"] = $_POST["soInsID"];
				$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			case "hfFeeAgmInsert" :
				require_once sysPath . 'agencyService/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "housingFundID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "HFDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			case "sCheckMulInsert" :
				require_once sysPath . 'superCheck/sCheckMulInsert.php';
				$valid = new sCheckMulInsert ();
				$valid->p = $pdo;
				$valid->zID = $_GET ['zID'];
				$valid->t = $_GET ["t"];
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "zID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				
				$errMsg = $valid->validator ();
				if ($_GET ['mulFee'] != "mul")
					$errMsgSql = $valid->validatorSql ( $getQuery );
				break;
			#添加流程状态是 YES NO 或是等待
			case "recruitNotesMulInsert" :
				#链接招聘模块各类库的关联文件
				require_once sysPath . 'recruitManage/requireClassFile.php';
				#链接导入文件
				require_once sysPath . 'recruitManage/recruitNotesMulInsert.php';
				
				#获取招聘相关信息设置数组
				$c = new recruitInfoSet ();
				$c->pdo = $pdo;
				$c->recruitInfoSetBasic ();
				$trainArr = $c->recruitInfoSetArr ['trainArr'];
				$valid = new recruitNotesMulInsert ();
				$valid->p = $pdo;
				$valid->fieldArr ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "status" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				if ($cellArr) {
					//生成异常数据数组
					$errMsg = $valid->validator ();
					$errMsgSql = $valid->validatorSql ( $getQuery );
					//				$cellArray = $valid->extraFieldValue ();
				}
				break;
			#添加培训成绩
			case "recruitMarksMulInsert" :
				#链接招聘模块各类库的关联文件
				require_once sysPath . 'recruitManage/requireClassFile.php';
				#链接导入文件
				require_once sysPath . 'recruitManage/recruitMarksMulInsert.php';
				
				#获取招聘相关信息设置数组
				$c = new recruitInfoSet ();
				$c->pdo = $pdo;
				$c->recruitInfoSetBasic ();
				$trainArr = $c->recruitInfoSetArr ['trainArr'];
				$valid = new recruitMarksMulInsert ();
				$valid->p = $pdo;
				$valid->fieldArr ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "status" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				#加载额外的选项,
				switch ($_GET ['status']) {
					case "7" :
						$extraFieldset = "<select name='trainClassicID' class='validate[required]'><option>--请选择--</option>";
						foreach ( $trainArr as $tKey => $tVal ) {
							$extraFieldset .= "<option value='$tKey'>" . $tVal ['name'] . "</option>";
						}
						$extraFieldset .= "</select>";
						break;
				}
				if ($cellArr) {
					//生成异常数据数组
					$errMsg = $valid->validator ();
					$errMsgSql = $valid->validatorSql ( $getQuery );
					//				$cellArray = $valid->extraFieldValue ();
				}
				break;
            #代理平账社保缴交明细导入
            case "balance_soInsFeeMulInsert" :
            case "balance_soInsFeeCooMulInsert" :
            case "balance_HFFeeMulInsert":
            case "balance_basicSoInsFeeMulInsert":
			case "balance_basicHFFeeMulInsert":
                require_once sysPath . 'agencyService/' . $actionUrl . '.php';
                $valid = new $actionUrl ();
                $valid->p = $pdo;
                $valid->field ();
                $setArray = $valid->set();
                $title = $setArray['title'];
                $valid->cellArray ( $newCellVal );
                $cellArr = $valid->cellArray;
                foreach ( $_GET as $getKey => $getVal ) {
                    switch ($getKey) {
                        case "soInsID" :
                            if (is_numeric ( $getVal ))
                                $getQuery [$getKey] = $getVal;
                            else
                                exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
                            break;
                        case "soInsDate" :
                            if (isMonth ( $getVal ))
                                $getQuery [$getKey] = $getVal;
                            else
                                exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
                            break;
                    }
                }
                $errMsgSql = $valid->validatorSql ( $getQuery );
                break;
		}
		
		#抛出错误信息
		//	var_dump($valid->cellArray);
		if ($cellArr) {
			if (! empty ( $errMsg ) || ! empty ( $errMsgSql )) {
				$errorMsg = fetchArray ( $errMsg ) . "<br/>" . fetchArray ( $errMsgSql );
			} else {
				//构造基本参数,页面显示
				if ($_GET ['mulFee'] == "mul")
					$setArray = $valid->set ( "mul" );
				else
					$setArray = $valid->set (); //set()是加载相应页面的函数
				$title = $setArray ['title'];
				$fieldHeader = $setArray ['fieldHeader'];
				$db_table = $setArray ['table'];
				//生成相应信息
				$dataInfo = $valid->dataInfo ();
			}
		} else {
			$errorMsg = "1.请验证你的表格数据列是否完整
			                      <br/>2. 表格底部无多余数据";
		}
	}
}
//这样分步可以防止POST多次提交,造成数据库出错
if ($_POST ['step'] == "2") {
	$excel_file = $_POST ['excel_file'];
	$fh = @fopen ( $excel_file, 'rb' );
	if (! $fh)
		$errorMsg = fatal ( "请重新上传文件,禁止非法刷新重复添加" );
	if (filesize ( $excel_file ) == 0)
		$errorMsg = fatal ( "没上传文件,或上传文件过小" );
	
	$fc = fread ( $fh, filesize ( $excel_file ) );
	@fclose ( $fh );
	if (strlen ( $fc ) < filesize ( $excel_file ))
		$errorMsg = fatal ( "无法读取文件" );
	
	if (! $errorMsg) {
		//连接READEREXCEL 类
		if ($_POST ['startRow']) {
			$startRow = $_POST ['startRow'];
			$newCellVal = excelToArray ( $excel_file, $startRow );
		}
		
		#加载相应的类文件(基本配置函数,及验证函数)
		switch ($actionUrl) {
			case "salaryMulInsert" :
				require_once sysPath . 'salaryManage/salaryMulInsert.php';
				$valid = new salaryMulInsert ();
				//构造基本参数,页面显示
				if ($_GET ['mulFee'] == "mul")
					$setArray = $valid->set ( "mul" );
				else
					$setArray = $valid->set (); //set()是加载相应页面的函数
				$valid->p = $pdo;
				$valid->zID = $_GET ['zID'];
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "zID" :
						case "unitID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "month" :
						case "salaryDate" :
						case "soInsDate" :
						case "HFDate" :
						case "comInsDate" :
						case "managementCostDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			case "rewardMulInsert" :
				require_once sysPath . 'rewardManage/rewardMulInsert.php';
				$valid = new rewardMulInsert ();
				$valid->p = $pdo;
				$valid->zID = $_GET ['zID'];
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "zID" :
						case "unitID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "month" :
						case "rewardDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			case "soInsFeeMulInsert" :
			case "soInsFeeCooMulInsert" :
				$insuranceID = insuranceID ( "soIns" );
				require_once sysPath . 'soInsManage/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				$getQuery ['soInsID'] = $_POST ['soInsID'];
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "soInsID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "soInsDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			case "HFFeeMulInsert" :
				$insuranceID = insuranceID ( "HF" );
				require_once sysPath . 'housingFundManage/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				$getQuery ['housingFundID'] = $_POST ['housingFundID'];
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "housingFundID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "HFDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			case "hfFeeAgmInsert" :
				$insuranceID = insuranceID ( "HF" );
				require_once sysPath . 'agencyService/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				$getQuery ['housingFundID'] = $_POST ['housingFundID'];
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "housingFundID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "HFDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			case "soInsFeeAgmInsert" :
				$insuranceID = insuranceID ( "soIns" );
				require_once sysPath . 'agencyService/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				$getQuery ['soInsID'] = $_POST ['soInsID'];
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "soInsID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "soInsDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			case "soInsFeeMulAgmInsert" :
				$insuranceID = insuranceID ( "soIns" );
				require_once sysPath . 'agencyService/' . $actionUrl . '.php';
				$valid = new $actionUrl ();
				$valid->p = $pdo;
				$valid->field ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				$getQuery ['soInsID'] = $_POST ['soInsID'];
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "soInsID" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						case "soInsDate" :
							if (isMonth ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
					}
				}
				$valid->extraFieldValue ( $getQuery );
				$sql = $valid->sql ();
				break;
			/*
             * 导入培训的成绩
             * 数据存储在$newCellVal中
             */
			case "marksInsert" :
				foreach ( $newCellVal as $data ) {
					$sex_array = array (
							"男" => "1",
							"女" => "2" 
					);
					$sql [] = "UPDATE a_talent set marks = " . $data [4] . ",pass = '" . $data [5] . "',marksRemarks = '" . $data [6] . "' where name = '" . $data [1] . "' and sex = '" . $sex_array [$data [2]] . "'";
				}
				/*
                 * FIXME 这个事务处理 如果有重复记录的话，虽然总数是正确的，
                 * 但是可能有的执行多次，有的没执行，更新记录还是不正确的
                 */
				//				echo "<pre>";print_r($sql);
				$ret = transaction ( $pdo, $sql );
				if ($ret ['num'] == count ( $sql ))
					echo "执行成功";
				else
					echo "执行失败";
				exit ();
				break;
			#添加流程状态是 YES NO 或是等待
			case "recruitNotesMulInsert" :
				#链接招聘模块各类库的关联文件
				require_once sysPath . 'recruitManage/requireClassFile.php';
				#链接导入文件
				require_once sysPath . 'recruitManage/recruitNotesMulInsert.php';
				
				$valid = new recruitNotesMulInsert ();
				$valid->p = $pdo;
				$valid->fieldArr ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "status" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				if ($cellArr) {
					//生成异常数据数组
					$sql = $valid->sql ( $getQuery );
				}
				break;
			#添加培训相关成绩
			case "recruitMarksMulInsert" :
				#链接招聘模块各类库的关联文件
				require_once sysPath . 'recruitManage/requireClassFile.php';
				#链接导入文件
				require_once sysPath . 'recruitManage/recruitMarksMulInsert.php';
				
				$valid = new recruitMarksMulInsert ();
				$valid->p = $pdo;
				$valid->fieldArr ();
				$valid->cellArray ( $newCellVal );
				$cellArr = $valid->cellArray;
				foreach ( $_GET as $getKey => $getVal ) {
					switch ($getKey) {
						case "status" :
							if (is_numeric ( $getVal ))
								$getQuery [$getKey] = $getVal;
							else
								exit ( "别试图更改URL,知道你高手行了吧,,可数据库别乱整" );
							break;
						default :
							$getQuery [$getKey] = $getVal;
							break;
					}
				}
				$getQuery ['trainClassicID'] = $_POST ['trainClassicID'];
				#加载额外的选项,
				switch ($_GET ['status']) {
					case "7" :
						$extraFieldset = "<select name='trainClassicID' class='validate[required]'><option>--请选择--</option>";
						foreach ( $trainArr as $tKey => $tVal ) {
							$extraFieldset .= "<option value='$tKey'>" . $tVal ['name'] . "</option>";
						}
						$extraFieldset .= "</select>";
						break;
				}
				if ($cellArr) {
					//生成异常数据数组
					$sql = $valid->sql ( $getQuery );
				}
				break;
            case "balance_soInsFeeMulInsert" :
            case "balance_soInsFeeCooMulInsert" :
            case "balance_HFFeeMulInsert":
            case "balance_basicSoInsFeeMulInsert":
			case "balance_basicHFFeeMulInsert":
                require_once sysPath . 'agencyService/' . $actionUrl . '.php';
                $valid = new $actionUrl ();
                $valid->p = $pdo;
                $valid->field();
                $valid->cellArray($newCellVal);
                $cellArr = $valid->cellArray;
                foreach ($_GET as $getKey => $getVal) {
                    switch ($getKey) {
                        case "soInsID" :
                            if (is_numeric($getVal))
                                $getQuery [$getKey] = $getVal;
                            else
                                exit ("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                            break;
                        case "soInsDate" :
                        case "HFDate":
                        case "month":
                            if (isMonth($getVal))
                                $getQuery [$getKey] = $getVal;
                            else
                                exit ("别试图更改URL,知道你高手行了吧,,可数据库别乱整");
                            break;
		}
                }
                $valid->extraFieldValue($getQuery);
                $sql = $valid->sql();
                break;
        }
		 		//echo "<pre>";
				//print_r ( $sql );
//        exit();
		$result = transaction ( $pdo, $sql );
		//		echo "<pre>";
		//		print_r ( $result );
		$err = $result ['error'];
		$execNum = $result ['num'];
		if (! empty ( $err )) {
			$err .= "发生未知错误,请联系管理员<br/>";
		}
		if (empty ( $err )) {
			$insertInfo .= '导入成功,' . $valid->dataInfo () . ',<a href="readExcel.php?' . $_SERVER ['QUERY_STRING'] . '">继续导入</a>';
			switch ($actionUrl) {
				case "salaryMulInsert" :
					$insertInfo .= "进入<a href='" . httpPath . "salaryManage/salaryManage.php?" . $_SERVER ['QUERY_STRING'] . "' target='_blank'>[  费用制作  ]</a>";
					break;
				case "rewardMulInsert" :
					$insertInfo .= "进入<a href='" . httpPath . "rewardManage/rewardManage.php?" . $_SERVER ['QUERY_STRING'] . "' target='_blank'>[  奖金制作  ]</a>";
					break;
			}
		} else
			$errorMsg .= $err . "<a href='readExcel.php?" . $_SERVER ['QUERY_STRING'] . "'>重新导入</a>";
		
		@unlink ( $excel_file );
	}
}

#模板变量配置
if ($errorMsg)
	$smarty->assign ( "errorMsg", $errorMsg );
if ($extraFieldset)
	$smarty->assign ( "extraFieldset", $extraFieldset );
$smarty->assign ( "fieldHeader", $fieldHeader );
$smarty->assign ( "cellArr", $cellArr );
$smarty->assign ( "db_table", $db_table );
$smarty->assign ( "fieldHeader", $fieldHeader );
$smarty->assign ( "insertInfo", $insertInfo );
$smarty->assign ( "insuranceID", insuranceID () );
if ($dataInfo)
	$smarty->assign ( "dataInfo", $dataInfo );
	
	#模板配置
$smarty->assign ( array (
		"title" => $title,
		"css" => httpPath . "css/main.css",
		"httpPath" => httpPath 
) );

$smarty->display ( "excelAction/readExcel.tpl" );
?>