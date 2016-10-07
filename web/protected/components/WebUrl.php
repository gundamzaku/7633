<?php 

// this file must be stored in: 
// protected/components/WebUser.php 

class WebUrl extends CComponent { 

	public function init(){ 
	} 

	//首页
	public function getIndexUrl(){
		return "/";
	}
	
	//登录页
	public function getLoginUrl(){
		return "index.php?r=site/login";
	}
	//登录提交页
	public function getDoLoginUrl(){
		return "index.php?r=site/doLogin";
	}
	//注册页
	public function getRegisterUrl(){
		return "index.php?r=site/register";
	}
	//激活确认页
	public function getActivateUrl(){
		return "index.php?r=site/activate";
	}

	//验证用户是否存在
	public function getUsernameExistUrl(){
		return "index.php?r=site/usernameExist";
	}
	
	//注册页
	public function getDoRegisterUrl(){
		return "index.php?r=site/doRegister";
	}

	//验证邀请码页
	public function getInviteCodeUrl(){
		return "index.php?r=site/inviteCode";
	}

	//找回密码的提交页
	public function getFindPwdUrl(){
		return "index.php?r=site/findPwd";	
	}
	
	//用户信息显示/修改页
	public function getUserProfileUrl(){
		return "index.php?r=main/userProfile";	
	}
	//用户信息显示/修改操作页
	public function getDoUserProfileUrl(){
		return "index.php?r=main/doUserProfile";	
	}
	//用户安全信息显示/修改页
	public function getUserSecurityUrl(){
		return "index.php?r=main/userSecurity";	
	}

	//用户安全信息显示/修改的提交页
	public function getDoUserSecurityUrl(){
		return "index.php?r=main/doUserSecurity";	
	}

	//系统消息列表
	public function getMessageListUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=main/messageList".$param;		
	}

	//系统消息详情页
	public function getMessageDetailUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=main/messageDetail".$param;	
	}

	//订单页
	public function getOrdersUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=pay/orders".$param;	
	}

	//支付页
	public function getPayUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=pay/pay".$param;	
	}

	//退出
	public function getLoginOutUrl(){
		return "index.php?r=site/loginOut";	
	}
} 