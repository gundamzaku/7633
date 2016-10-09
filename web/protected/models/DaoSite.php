<?php

class DaoSite extends Dao{

	protected $dateTime;
	
	public function __construct(){
		$this->dateTime = date("Y-m-d H:i:s");
		parent::__construct();
	}
	
	public function getUsername($username){

		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('auth_user')
			->where('username=:username', array(':username'=>$username))
			->queryRow();
		return $result;
	}

	public function getUsernameByActivate($activateCode){
		$result = Yii::app()->db->createCommand()
			->select('username')
			->from('activate_code')
			->where('activate_code=:activate_code', array(':activate_code'=>$activateCode))
			->queryRow();
		return $result;
	}
	
	public function regist($userInfo){

		$result = Yii::app()->db->createCommand()->insert('auth_user', array(
			'username'=>$userInfo["username"],
			'password'=>md5($userInfo["pwd"]),
			'first_name'=>'',
			'last_name'=>'',
			'is_active'=>0,	//没有通过邮箱验证的注册，都是未激活状态
			'is_staff'=>1,
			'is_superuser'=>0,
			'date_joined'=>$this->dateTime,
			'companyname'=>$userInfo["companyname"],
			'companyidnumber'=>$userInfo["companyidnumber"],
			'tel'=>$userInfo["tel"],
			'address'=>$userInfo["address"],
			'qq'=>$userInfo["qq"],
			'ownername'=>$userInfo["ownername"],
			'owneridnumber'=>$userInfo["owneridnumber"],
		));
		return $result;
	}

	public function updUserInfo($username,$userInfo){
		if(!empty($userInfo["password"]))$userInfo["password"] = md5($userInfo["password"]);
		$result = Yii::app()->db->createCommand()->update('auth_user', 
			$userInfo, 
			"username=:username", 
			[  
				':username' => $username 
			]);
		return $result;
	}
	
	//更新用户的登录信息
	public function updUserLoginInfo($username){
		try{
			$result = Yii::app()->db->createCommand()->insert('auth_user_login_info', array(
				'username'=>$username,
				'now_login'=>$this->dateTime,
				'now_login_ip'=>Yii::app()->request->userHostAddress,
			));
		}catch(Exception $e){
			if($e->errorInfo[1] == 1062){
				$result = Yii::app()->db->createCommand()->update('auth_user_login_info', 
					[
						'last_login'=>new CDbExpression('now_login'),
						'last_login_ip'=>new CDbExpression('now_login_ip'),
						'now_login'=>$this->dateTime,
						'now_login_ip'=>Yii::app()->request->userHostAddress,
					], 
					"username=:username", 
					[  
						':username' => $username 
					]);
			}
		}
		return $result;
	}
	
	//根据用户名获得用户的登录信息
	public function getUserLoginInfo($username){
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('auth_user_login_info')
			->where('username=:username', array(':username'=>$username))
			->queryRow();
		return $result;
	}

	/*
	 *	邀请码
	 */
	public function getInviteCode($inviteCode){
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('invite_code')
			->where('invite_code=:invite_code', array(':invite_code'=>$inviteCode))
			->queryRow();
		return $result;
	}
	
	public function useInviteCode($inviteCode,$username){
		$result = Yii::app()->db->createCommand()->update('invite_code', 
			[
				'is_get' => 1,  
				'username' => $username,  
				'add_time' => $this->dateTime,
				'add_ip' => Yii::app()->request->userHostAddress 
			], 
			"invite_code=:invite_code", 
			[  
				':invite_code' => $inviteCode 
			]);
		return $result;
	}
	
	//写入激活数据
	public function insActivateCode($activateCode,$username){
		$result = Yii::app()->db->createCommand()->insert('activate_code', array(
			'activate_code'=>$activateCode,
			'username'=>$username,
			));
		return $result;
	}

	//激活用户
	public function activateUser($username){
		$result = Yii::app()->db->createCommand()->update('auth_user', 
			[
				'is_active' => 1
			], 
			"username=:username", 
			[  
				':username' => $username 
			]);
		return $result;
	}

	//激活码已经使用
	public function useActivateCode($activateCode){
		$result = Yii::app()->db->createCommand()->update('activate_code', 
			[
				'is_use' => 1,  
				'add_time' => $this->dateTime,
				'add_ip' => Yii::app()->request->userHostAddress 
			], 
			"activate_code=:activate_code", 
			[  
				':activate_code' => $activateCode 
			]);
		return $result;
	}
	//写入密码修改的Log
	
	public function insPasswordLog($username,$password){
		$result = Yii::app()->db->createCommand()->insert('password_log', array(
			'username'=>$username,
			'password'=>$password,
			'add_time' => $this->dateTime,
			'add_ip' => Yii::app()->request->userHostAddress 
		));
		return $result;
	}

	//写入系统消息
	public function insMessage($title,$content){

		$result = Yii::app()->db->createCommand()->insert('message', array(
			'title'=>$title,
			'content'=>$content,
			'add_time' => $this->dateTime
		));
		return $result;
	}

	//得到系统消息
	public function getMessage(){
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('message')
			->order('add_time desc')
			->limit(5)
			->queryAll();
		return $result;
	}

	//得到系统消息（总数）
	public function getMessageCount(){
		
		$result = Yii::app()->db->createCommand()
			->select('count(*) ct')
			->from('message')
			->queryRow();
		return $result;
	}

	//得到系统消息（带分页）
	public function getMessagePage($offset,$limit){
		
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('message')
			->order('add_time desc')
			->limit($limit)
			->offset($offset)
			->queryAll();
		return $result;
	}

	//得到系统明细
	public function getMessageDetail($mid){
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('message')
			->where('mid=:mid', array(':mid'=>$mid))
			->queryRow();
		return $result;
	}
}