<?php

class MainController extends Controller
{
	public $body	= '';
	public $session = '';
	private $dao;

	public function init(){
		
		$this->session = Yii::app()->session;
		//如果在用户未登录的状态下面
		if(empty($this->session['username'])){
			$this->redirect(array('/site/login'));
		}
		$this->dao = new DaoSite();
	}

	//用户信息页
	public function actionUserProfile(){

		$userInfo = $this->dao->getUsername($this->session["username"]);
		if($userInfo == false){
			Helper::interrupt($this,"未找到该用户。",2,Yii::app()->url->getUserSecurityUrl());
		}

		$this->render('user-profile',$userInfo);
	}
	
	public function actionDoUserProfile(){
		
		$data["companyname"]		= !empty($_POST["companyname"])?$_POST["companyname"]:"";
		$data["companyidnumber"]	= !empty($_POST["companyidnumber"])?$_POST["companyidnumber"]:"";
		$data["tel"]				= !empty($_POST["tel"])?$_POST["tel"]:"";
		$data["address"]			= !empty($_POST["address"])?$_POST["address"]:"";
		$data["email"]				= !empty($_POST["email"])?$_POST["email"]:"";
		$data["qq"]					= !empty($_POST["qq"])?$_POST["qq"]:"";
		$data["ownername"]			= !empty($_POST["ownername"])?$_POST["ownername"]:"";
		$data["owneridnumber"]		= !empty($_POST["owneridnumber"])?$_POST["owneridnumber"]:"";

		//需要验证只能英文、数字、大小写不用区别
		$model = new CheckProfile;
		
		$model->companyname = $data["companyname"];
		$model->companyidnumber = $data["companyidnumber"];
		$model->tel = $data["tel"];
		$model->address = $data["address"];
		$model->email = $data["email"];
		$model->qq = $data["qq"];
		$model->ownername = $data["ownername"];
		$model->owneridnumber = $data["owneridnumber"];
		
		if($model->validate() ==  false){
			foreach($model->errors as $k=>$v){
				$message[] = $v[0];
			}
			$message = implode("<br>",$message);
			Helper::interrupt($this,$message,2,Yii::app()->url->getUserProfileUrl());
		}

		//更新
		$this->dao->updUserInfo($this->session["username"],$data);
		Helper::interrupt($this,"您的个人信息修改完成。",1,Yii::app()->url->getUserProfileUrl());
	}

	//用户安全信息页
	public function actionUserSecurity(){
		$this->render('user-security');
	}

	//用户安全信息页
	public function actionDoUserSecurity(){
		//array(3) { ["currentpwd"]=> string(8) "6gm0js0c" ["newpwd"]=> string(6) "111111" ["newpwdrepeat"]=> string(6) "111111" } 
		$currentpwd		= !empty($_POST["currentpwd"])?$_POST["currentpwd"]:"";			//老密码
		$newpwd			= !empty($_POST["newpwd"])?$_POST["newpwd"]:"";					//新密码
		$newpwdrepeat	= !empty($_POST["newpwdrepeat"])?$_POST["newpwdrepeat"]:"";		//新密码重复

		$model = new CheckSecurity();
		$model->currentpwd = $currentpwd;
		$model->newpwd = $newpwd;
		$model->newpwdrepeat = $newpwdrepeat;
		$result = $model->validate();
		if($model->validate() ==  false){
			foreach($model->errors as $k=>$v){
				$message[] = $v[0];
			}
			$message = implode("<br>",$message);
			Helper::interrupt($this,$message,2,Yii::app()->url->getUserSecurityUrl());
		}

		//从数据库中取回密码，对比是否相等
		$userInfo = $this->dao->getUsername($this->session["username"]);
		if($userInfo == false){
			Helper::interrupt($this,"未找到该用户。",2,Yii::app()->url->getUserSecurityUrl());
		}
		if($userInfo['password'] != md5($currentpwd)){
			//密码不对
			Helper::interrupt($this,"您输入的当前密码错误。",2,Yii::app()->url->getUserSecurityUrl());
		}
		//相等，修改密码。留下修改LOG
		$this->dao->insPasswordLog($this->session["username"],$userInfo['password']);

		//更改用户密码
		$data["password"] = $newpwd;
		$this->dao->updUserInfo($this->session["username"],$data);

		Helper::interrupt($this,"您的密码修改完成，请重新登录。",1,Yii::app()->url->getLoginUrl());
	}

	//系统消息列表页
	public function actionMessageList(){

		$p = !empty($_GET["p"])?$_GET["p"]:1;
        $page = new Page(10,$p,Yii::app()->url->getMessageListUrl());

		$result = $this->dao->getMessageCount();
        $page->setAllNum($result['ct']);
		$result = $this->dao->getMessagePage($page->getLimitOffset(10,$p),10);

		//数据过滤
		$purifier = new CHtmlPurifier();  
		$purifier->options = array(  
			'URI.AllowedSchemes'=>array(  
								'http' => true,  
								'https' => true,  
			),  
				  'HTML.Allowed'=>'div,br',  
		);

		foreach($result as $k=>$v){
			$result[$k]['add_time'] = date("m-d",strtotime($result[$k]['add_time']));
			$result[$k]['title'] = $purifier->purify($result[$k]['title']);
		}

        $data['page'] = $page->getHtml();
		$data['p'] = $p;
		$data['message'] = $result;
		$this->render('messages',$data);
	}

	//系统消息详情页
	public function actionMessageDetail(){
		
		$mid = !empty($_GET["mid"])?intval($_GET["mid"]):"";
		$p = !empty($_GET["p"])?intval($_GET["p"]):1;
		if(empty($mid)){
			Helper::interrupt($this,"参数错误",2,Yii::app()->url->getMessageListUrl());
		}

		//根据系统消息的ID得到消息的明细
		$result = $this->dao->getMessageDetail($mid);

		$purifier = new CHtmlPurifier();  
		$purifier->options = array(  
			'URI.AllowedSchemes'=>array(  
								'http' => true,  
								'https' => true,  
			),  
				  'HTML.Allowed'=>'div,br',  
		);
		$result['add_time'] = date("Y-m-d H:i",strtotime($result['add_time']));
		$result['title'] = $purifier->purify($result['title']);
		$result['content'] = $purifier->purify($result['content']);
		$data['message'] = $result;
		$data['p'] = $p;
		$this->render('messages-details',$data);
	}

}
