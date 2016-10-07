<?php 

// this file must be stored in: 
// protected/components/WebUser.php 

class WebUrl extends CComponent { 

	public function init(){ 
	} 

	//��ҳ
	public function getIndexUrl(){
		return "/";
	}
	
	//��¼ҳ
	public function getLoginUrl(){
		return "index.php?r=site/login";
	}
	//��¼�ύҳ
	public function getDoLoginUrl(){
		return "index.php?r=site/doLogin";
	}
	//ע��ҳ
	public function getRegisterUrl(){
		return "index.php?r=site/register";
	}
	//����ȷ��ҳ
	public function getActivateUrl(){
		return "index.php?r=site/activate";
	}

	//��֤�û��Ƿ����
	public function getUsernameExistUrl(){
		return "index.php?r=site/usernameExist";
	}
	
	//ע��ҳ
	public function getDoRegisterUrl(){
		return "index.php?r=site/doRegister";
	}

	//��֤������ҳ
	public function getInviteCodeUrl(){
		return "index.php?r=site/inviteCode";
	}

	//�һ�������ύҳ
	public function getFindPwdUrl(){
		return "index.php?r=site/findPwd";	
	}
	
	//�û���Ϣ��ʾ/�޸�ҳ
	public function getUserProfileUrl(){
		return "index.php?r=main/userProfile";	
	}
	//�û���Ϣ��ʾ/�޸Ĳ���ҳ
	public function getDoUserProfileUrl(){
		return "index.php?r=main/doUserProfile";	
	}
	//�û���ȫ��Ϣ��ʾ/�޸�ҳ
	public function getUserSecurityUrl(){
		return "index.php?r=main/userSecurity";	
	}

	//�û���ȫ��Ϣ��ʾ/�޸ĵ��ύҳ
	public function getDoUserSecurityUrl(){
		return "index.php?r=main/doUserSecurity";	
	}

	//ϵͳ��Ϣ�б�
	public function getMessageListUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=main/messageList".$param;		
	}

	//ϵͳ��Ϣ����ҳ
	public function getMessageDetailUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=main/messageDetail".$param;	
	}

	//����ҳ
	public function getOrdersUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=pay/orders".$param;	
	}

	//֧��ҳ
	public function getPayUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=pay/pay".$param;	
	}

	//�˳�
	public function getLoginOutUrl(){
		return "index.php?r=site/loginOut";	
	}
} 