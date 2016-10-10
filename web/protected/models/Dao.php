<?php
class Dao{

	//protected $db;
	//protected $command;
	protected $trans;

	public function __construct(){
		//有点问题，貌似会缓存数据
		//$this->db = Yii::app()->db;
		//$this->command = $this->db->createCommand();
	}
	
	public function beginTransaction(){
		$this->trans = Yii::app()->db->beginTransaction();
	}

	public function commit(){
		$this->trans->commit();
	}

	public function rollback(){
		$this->trans->rollback();
	}

	//根据某个ID得到某表信息
	public function getTableInfo($table,$field,$value){

		$result = Yii::app()->db->createCommand()
			->select('*')
			->from($table)
			->where($field.'=:'.$field, array(':'.$field=>$value))
			->queryRow();
		return $result;
	}

	//根据某个ID更新某表信息
	public function updTableInfo($table,$info,$field,$value){

		$result = Yii::app()->db->createCommand()->update($table, 
			$info, 
			$field."=:".$field, 
			[  
				':'.$field => $value 
			]);
		return $result;
	}
}