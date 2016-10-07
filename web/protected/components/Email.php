<?php
class Email extends CComponent{
	private $mailer;
	public $message;
	public $address;
	public $title;

	public function init(){
		//创建邮件应用
		$this->mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$this->mailer->Host = SMTP_HOST;//port:25
		$this->mailer->IsSMTP();
		$this->mailer->SMTPAuth = true;
		$this->mailer->From = SMTP_FROM;
		$this->mailer->AddReplyTo(SMTP_FROM);
		$this->mailer->FromName = SMTP_FROM_NAME;
		$this->mailer->Username = SMTP_USERNAME;    //这里输入发件地址的用户名
		$this->mailer->Password = SMTP_PASSWORD;    //这里输入发件地址的密码
		$this->mailer->SMTPDebug = false;   //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
		$this->mailer->CharSet = 'UTF-8';
		$this->mailer->IsHTML(true);

	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function setAddress($address){
		$this->address = $address;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function send(){
		$this->mailer->AddAddress($this->address);
		$this->mailer->Subject = Yii::t('7663', $this->title);
		$this->mailer->Body = $this->message;
		$result = $this->mailer->Send();
		return $result;
	}
}