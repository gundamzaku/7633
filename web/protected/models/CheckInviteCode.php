<?php
class CheckInviteCode extends CFormModel{

	public $inviteCode;

	public function rules(){
		return array(
			array('inviteCode', 'required','message'=>'邀请码不能为空'),
			array('inviteCode','match','pattern'=>'/^[a-zA-Z0-9\-_]+$/','message'=>'邀请码必须为英文数字'),  
		);
	}
}