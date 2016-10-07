<?php
class InfoLeftWidget extends CWidget{

	public $session;

    public function run(){
		$this->session = Yii::app()->session;
		$data["username"] = $this->session["username"];
		$data["is_superuser"] = $this->session["is_superuser"];
		$data["companyname"] = $this->session["companyname"];
		$data["money"] = $this->session["money"];
		$data["last_login"] = $this->session["last_login"];
		$data["last_login_ip"] = $this->session["last_login_ip"];
        $this->render('info_left',$data);//, array('datetime'=>$datetime)
    }
}