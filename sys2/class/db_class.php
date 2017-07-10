<?php
/*
作者：LOSKIN
time:2013-11-26
描述：数据库操作类
更新：
	11-26 改造类PDO类库（静态）
	
*/
class db{
		static $conn;
		static $nums;		
	//构造函数经过实例化被调用
	function __construct($pdo) {
		self::$conn=$pdo;
	}

	//增加记录
	/*
	 * tableName:指定表名
	 * arr:传一个关联下标数组，下标为字段名，其值为这个字段写入的内容
	 *     例如 $arr=array('title'=>'title1','content'=>'content1')
	 */
	static function insert($tableName,$arr){
		//根据数组，产生字段列表，值列表
		$columList="";
		$valueList="";
		foreach($arr as $key=>$value){
			$columList.=",".$key;
			$valueList.=",'".$value."'";
		}
		$columList=substr($columList,1);
		$valueList=substr($valueList,1);
		//拼insert语句
		$sql="insert into {$tableName}({$columList}) values({$valueList})";
		$re=self::$conn->exec($sql);
		if($re==true){
			return self::$conn->lastInsertId();
		}else{
			return false;
		}
	}
	//删除
	//$arr=array("主键字段名"=>id值)
	static function delete($tableName,$arr){
		foreach($arr as $key=>$value){
			$sql="delete from {$tableName} where {$key}={$value}";
		}
		return self::$conn->exec($sql);
	}
	//修改
	//$arr=array('title'=>'title1','content'=>'content1','nid'=>5)
	//主键字段名 update 表名 set title='title1',content='content' where nid=5
	//primaryColumName:主键字段名称
	//tableName:表名
	static function update($tableName,$arr,$primaryColumName){
		//产生where子句  update 表名 set title='title1',content='content' where nid=5
		$where="where {$primaryColumName}=".$arr[$primaryColumName];
		unset($arr[$primaryColumName]);
		$columValueList="";//title='title1',content='content1'
		foreach($arr as $key=>$value){
			$columValueList.=",".$key."='".$value."'";	
		}
		$columValueList=substr($columValueList,1);
		//update语句
		$sql="update {$tableName} set {$columValueList} {$where}";
		return self::$conn->query($sql);//PDOstatement对象
	}
	//查询
	//$tableName,$columList,$where="",$limit=""$group="",$order="",
	//news * where type=1 limit 0,3
	static function select($tableName,$columList,$where="",$limit="",$order="",$group=""){
		$sql="select {$columList} from {$tableName} {$where} {$group} {$order} {$limit}";
		//echo $sql."<br/>";
		$pre = self::$conn->prepare($sql);
		$pre->execute();
		self::$nums = $pre->rowCount(); //获取并设置数据库总记录数
		$result=self::$conn->query($sql);//PDOstatement对象
		if(is_object($result)){
				$arr=array();
				while($re=$result->fetch(PDO::FETCH_ASSOC)){
					$arr[]=$re;
				}
				return $arr;
		}else{
			return false;
		}
	}
	static function query($sql){
		//echo $sql;
		$result=self::$conn->query($sql);//PDOstatement对象
		if(is_object($result)){
			$arr=array();
			while($re=$result->fetch(PDO::FETCH_ASSOC)){
				$arr[]=$re;
			}
			return $arr;
		}else{
			return false;
		}
	}
	function __destruct(){
		$pdo=null;//关闭数据库
	}
}









