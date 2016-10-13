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

	//支付成功页
	public function getPayResultUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=pay/payResult".$param;	
	}

	//退出
	public function getLoginOutUrl(){
		return "index.php?r=site/loginOut";	
	}

	/**********************************************/
	//下面是后台的URL配置
	//登录页
	public function getAdminLoginUrl(){
		return "index.php?r=admin/login";
	}
	//登录提交确认页
	public function getAdminDoLoginUrl(){
		return "index.php?r=admin/doLogin";
	}
	//进入主页面
	public function getAdminMainUrl(){
		return "index.php?r=admin/main";
	}
	//进入广告列表面
	public function getAdminAdviertisementUrl(){
		
		return "index.php?r=admin/adviertisement";
	}

	//添加广告页面
	public function getAdminAddAdviertisementUrl(){
		return "index.php?r=admin/addAdviertisement";
	}

	//修改广告页面
	public function getAdminUpdAdviertisementUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=admin/updAdviertisement".$param;
	}

	//添加广告确认页面
	public function getAdminDoAddAdviertisementUrl(){
		return "index.php?r=admin/doAddAdviertisement";
	}

	//商铺
	//进入商铺列表面
	public function getAdminStoreUrl(){
		
		return "index.php?r=admin/store";
	}

	//添加商铺页面
	public function getAdminAddStoreUrl(){
		return "index.php?r=admin/addStore";
	}

	//修改商铺页面
	public function getAdminUpdStoreUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=admin/updStore".$param;
	}

	//添加商铺确认页面
	public function getAdminDoAddStoreUrl(){
		return "index.php?r=admin/doAddStore";
	}

	//系统消息
	//进入系统消息列表面
	public function getAdminMessageUrl(){
		
		return "index.php?r=admin/message";
	}

	//添加系统消息页面
	public function getAdminAddMessageUrl(){
		return "index.php?r=admin/addMessage";
	}

	//修改系统消息页面
	public function getAdminUpdMessageUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=admin/updMessage".$param;
	}

	//添加系统消息确认页面
	public function getAdminDoAddMessageUrl(){
		return "index.php?r=admin/doAddMessage";
	}
	
	//添加配置页面
	public function getAdminSettingUrl(){
		return "index.php?r=admin/updSetting";
	}	

	//操作配置页面
	public function getAdminDoUpdSettingUrl(){
		return "index.php?r=admin/doUpdSetting";
	}	
	//删除
	public function getAdminDoDeleteUrl($param=""){
		if(!empty($param))$param = "&".$param;
		return "index.php?r=admin/doDelete".$param;
	}
	//退出
	public function getAdminLoginOutUrl(){
		return "index.php?r=admin/loginOut";	
	}
} 