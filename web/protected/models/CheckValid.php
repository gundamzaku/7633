<?php
class CheckSecurity extends CValidator{

	public $pwd;
	public $repeatpwd;

	public function rules(){
		return array(
			array('pwd', 'required','message'=>'密码不能为空'),
			array('pwd', 'compare', 'compareAttribute' => 'repeatpwd','message'=>'密码验证不一致'),
			array('pwd', 'length','min'=>5,'max'=>24,'tooLong'=>'密码请输入长度为5-24个字符', 'tooShort'=>'密码请输入长度为5-24个字符'),
		);
	}

}