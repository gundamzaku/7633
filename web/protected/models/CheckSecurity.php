<?php
class CheckSecurity extends CFormModel{

	public $currentpwd;
	public $newpwd;
	public $newpwdrepeat;

	public function rules(){
		return array(
			array('currentpwd', 'required','message'=>'旧密码不能为空'),
			array('newpwd', 'required','message'=>'新密码不能为空'),
			array('newpwd', 'compare', 'compareAttribute' => 'newpwdrepeat','message'=>'密码验证不一致'),
			array('newpwd', 'length','min'=>5,'max'=>24,'tooLong'=>'密码请输入长度为5-24个字符', 'tooShort'=>'密码请输入长度为5-24个字符'),
		);
	}

}