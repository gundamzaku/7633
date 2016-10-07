<?php
class CheckProfile extends CFormModel{

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
			array('companyname', 'required','message'=>'公司名称不能为空'),
			array('companyidnumber', 'required','message'=>'企业营业执照号码不能为空'),
			array('tel', 'required','message'=>'联系电话不能为空'),
			array('address', 'required','message'=>'联系地址不能为空'),
			array('email', 'required','message'=>'Email不能为空'),
			array('qq', 'required','message'=>'QQ不能为空'),
			array('ownername', 'required','message'=>'企业法人姓名不能为空'),
			array('owneridnumber', 'required','message'=>'法人身份证号码不能为空')
		);
	}
}