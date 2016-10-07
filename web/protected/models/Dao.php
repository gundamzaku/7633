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

}