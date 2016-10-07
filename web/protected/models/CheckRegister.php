<?php
class CheckRegister extends CFormModel{

	public $username;
	public $pwd;
	public $repeatpwd;
	public $companyname;
	public $companyidnumber;
	public $tel;
	public $address;
	public $email;
	public $qq;
	public $ownername;
	public $owneridnumber;

	public function rules(){
		return array(
			array('username', 'required','message'=>'用户名不能为空'),
			array('pwd', 'required','message'=>'密码不能为空'),
			array('companyname', 'required','message'=>'公司名称不能为空'),
			array('companyidnumber', 'required','message'=>'企业营业执照号码不能为空'),
			array('tel', 'required','message'=>'联系电话不能为空'),
			array('address', 'required','message'=>'联系地址不能为空'),
			array('email', 'required','message'=>'Email不能为空'),
			array('qq', 'required','message'=>'QQ不能为空'),
			array('ownername', 'required','message'=>'企业法人姓名不能为空'),
			array('owneridnumber', 'required','message'=>'法人身份证号码不能为空'),
			array('username', 'email','message'=>'用户名必须为正确的邮箱格式'),
			array('pwd', 'compare', 'compareAttribute' => 'repeatpwd','message'=>'密码验证不一致'),
			array('pwd', 'length','min'=>5,'max'=>24,'tooLong'=>'密码请输入长度为5-24个字符', 'tooShort'=>'密码请输入长度为5-24个字符'),
		);
	}
	/*
	public function checkPwd($attribute,$params){

		if($this->pwd != $this->repeatpwd){
			$this->addError($attribute,'密码验证不一致');
		}
	}*/
}