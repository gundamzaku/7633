<?php
class CheckSecurity extends CValidator{

	public $pwd;
	public $repeatpwd;

	public function rules(){
		return array(
			array('pwd', 'required','message'=>'���벻��Ϊ��'),
			array('pwd', 'compare', 'compareAttribute' => 'repeatpwd','message'=>'������֤��һ��'),
			array('pwd', 'length','min'=>5,'max'=>24,'tooLong'=>'���������볤��Ϊ5-24���ַ�', 'tooShort'=>'���������볤��Ϊ5-24���ַ�'),
		);
	}

}