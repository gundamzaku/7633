<?php

class SiteController extends Controller
{
	public $body	= '';
	public $session = '';
	private $dao;

	public function init(){
		
		$this->session = Yii::app()->session;
		//如果在用户未登录的状态下面
		if(empty($this->session['username'])){
			$noLogin = false;
			$action = "";
			if(!empty($_GET['r']))$action = $_GET['r'];
			$arr = new SplFixedArray(11); 
			$arr[0] = "site/login";
			$arr[1] = "site/register";
			$arr[2] = "site/inviteCode";
			$arr[3] = "site/doRegister";
			$arr[4] = "site/usernameExist";
			$arr[5] = "site/info";
			$arr[6] = "site/succ";
			$arr[7] = "site/activate";
			$arr[8] = "site/test";
			$arr[9] = "site/findPwd";
			$arr[10] = "site/doLogin";
			
			$size = $arr->getSize(); 
			for($i=0;$i<$size;$i++){
				if($action == $arr->offsetGet($i)){
					$noLogin = true;
				}
			}

			if($noLogin === false){
				$this->redirect(array('/site/login'));
				//需要登录
			}
		}
		//登录的话上面这几步就不用做了

		$this->dao = new DaoSite();
	}

	public function actionIndex(){

		//获得系统消息
		$result = $this->dao->getMessage();

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
		$data["message"] = $result;
		$this->render('main',$data);
	}
	
	public function actionLogin(){
		$this->body = "single";
		$this->layout='//layouts/main_nonav';
		$this->render('login');		
	}

	public function actionDoLogin(){
		
		$username	= !empty($_POST["username"])?$_POST["username"]:"";	//用户名
		$pwd		= !empty($_POST["pwd"])?$_POST["pwd"]:"";		//密码

		$validator = new CEmailValidator();

		if($validator->validateValue($username) == false){
			Helper::interrupt($this,"用户名格式错误。",2,Yii::app()->url->getLoginUrl());
		}

		if(empty($pwd)){
			Helper::interrupt($this,"参数错误。",2,Yii::app()->url->getLoginUrl());
		}
		$pwd = md5($pwd);

		//数据库中有无这个用户
		$userInfo = $this->dao->getUsername($username);
		if($userInfo == false){
			Helper::interrupt($this,"未找到该用户。",2,Yii::app()->url->getLoginUrl());
		}

		if($userInfo["password"] != $pwd){
			//登录不成功
			Helper::interrupt($this,"密码错误，用户登录失败。",2,Yii::app()->url->getLoginUrl());
		}

		//更新登录信息
		$result = $this->dao->updUserLoginInfo($username);

		//登录成功
		$this->session["username"]		= $userInfo['username'];
		$this->session["is_superuser"]	= $userInfo['is_superuser'];
		$this->session["companyname"]	= $userInfo['companyname'];	//企业名称
		$this->session["money"]			= $userInfo['money'];		//剩余点数
		
		//获得用户的登录信息
		$userLoginInfo = $this->dao->getUserLoginInfo($username);
		$this->session["last_login"]	= $userLoginInfo['last_login'];		//上次登录时间
		$this->session["last_login_ip"] = $userLoginInfo['last_login_ip'];	//上次登录IP

		//成功后跳转
		$this->redirect(array('/site/index'));
	}

	public function actionRegister(){
		$this->body = "single";
		$this->layout='//layouts/main_nonav';
		$this->render('register');
	}

	public function actionActivate(){
		$this->body = "single";
		$this->layout='//layouts/main_nonav';
		$code = $_GET["code"];
		if(empty($code)){
			Helper::interrupt($this,"参数错误",2,Yii::app()->url->getRegisterUrl());
		}
		//根据code查找用户名
		$result = $this->dao->getUsernameByActivate($code);
		if(empty($result)){
			Helper::interrupt($this,"激活信息有误",2,Yii::app()->url->getRegisterUrl());
		}
		$username = $result["username"];
		//查找用户信息，确认有无激活。
		$result = $this->dao->getUsername($username);

		//若无激活，则直接激活。若有激活，提示。
		if($result["is_active"] != 1){
			
			//直接激活，更新激活状态
			$this->dao->beginTransaction();
			$this->dao->useActivateCode($code);
			$result = $this->dao->activateUser($username);
			if($result != 1){
				//出错，退出
				$this->dao->rollback();
				Helper::interrupt($this,"激活失败，系统无法完成您此次的激活操作，请重新尝试。",2,Yii::app()->url->getRegisterUrl());
			}else{
				$this->dao->commit();
				Helper::interrupt($this,"您的7663VR战网通行证已激活成功！",1,Yii::app()->url->getLoginUrl(),10,"登录战网","您的通行证名(注册邮箱)<br/>".$username."<br/><br/>");
			}
		}else{
			Helper::interrupt($this,"您目前已经处于激活状态",2,Yii::app()->url->getRegisterUrl());
		}
	}

	public function actionInfo(){
		$this->body = "single";
		$this->layout='//layouts/main_nonav';
		$this->render('info');
	}
	
	public function actionFindPwd(){

		$this->body = "single";
		$this->layout='//layouts/main_nonav';
		
		$username = $_POST["username"];
		$validator = new CEmailValidator();

		if($validator->validateValue($username) == false){
			Helper::interrupt($this,"邮箱格式错误。",2,Yii::app()->url->getLoginUrl());
		}

		//数据库中有无这个用户
		$userInfo = $this->dao->getUsername($username);
		if($userInfo == false){
			Helper::interrupt($this,"未找到该用户。",2,Yii::app()->url->getLoginUrl());
		}
		
		//生成新的密码
		$repassCode = Helper::getHashLower(8);
		$data['password'] = $repassCode;
		$result = $this->dao->updUserInfo($username,$data);
		if($result == 1){
			
			//发送一封激活邮件到邮箱中去
			$email = Yii::app()->email;
			$email->setMessage("您好。<br>7663VR战网平台已经重置您的密码。您的新密码为(".$repassCode.")，请及时修改并妥善保管。");
			$email->setAddress($username);
			$email->setTitle("7663VR战网密码重置");
			$email->send();
			
			Helper::interrupt($this,"已将重置密码的链接发放至您的邮箱中，请登录后点击链接进行密码重置。",1,Yii::app()->url->getLoginUrl(),10,"登录战网");
		}else{
			Helper::interrupt($this,"操作失败，请重新尝试。",2,Yii::app()->url->getLoginUrl());
		}
	}

	public function actionDoRegister(){
		//array(11) { ["username"]=> string(10) "dan@qq.com" ["pwd"]=> string(10) "gundamzaku" ["repeatpwd"]=> string(10) "gundamzaku" ["companyname"]=> string(15) "有有小公司" ["companyidnumber"]=> string(8) "20160113" ["tel"]=> string(8) "67788754" ["address"]=> string(27) "上海有个好地方街道" ["email"]=> string(18) "gundamzaku@163.com" ["qq"]=> string(6) "888888" ["ownername"]=> string(9) "王力猛" ["owneridnumber"]=> string(14) "31010999999999" } 
		$data["invite_code"]		= !empty($_POST["invite_code"])?$_POST["invite_code"]:"";
		$data["username"]			= !empty($_POST["username"])?$_POST["username"]:"";
		$data["pwd"]				= !empty($_POST["pwd"])?$_POST["pwd"]:"";
		$data["repeatpwd"]			= !empty($_POST["repeatpwd"])?$_POST["repeatpwd"]:"";
		$data["companyname"]		= !empty($_POST["companyname"])?$_POST["companyname"]:"";
		$data["companyidnumber"]	= !empty($_POST["companyidnumber"])?$_POST["companyidnumber"]:"";
		$data["tel"]				= !empty($_POST["tel"])?$_POST["tel"]:"";
		$data["address"]			= !empty($_POST["address"])?$_POST["address"]:"";
		$data["email"]				= !empty($_POST["email"])?$_POST["email"]:"";
		$data["qq"]					= !empty($_POST["qq"])?$_POST["qq"]:"";
		$data["ownername"]			= !empty($_POST["ownername"])?$_POST["ownername"]:"";
		$data["owneridnumber"]		= !empty($_POST["owneridnumber"])?$_POST["owneridnumber"]:"";

		//需要验证只能英文、数字、大小写不用区别
		$model = new CheckRegister;
		
		$model->username = $data["username"];
		$model->pwd = $data["pwd"];
		$model->repeatpwd = $data["repeatpwd"];
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
			Helper::interrupt($this,$message,2,Yii::app()->url->getRegisterUrl());
		}
		//验证邀请友有无被使用过
		if(!empty($data["invite_code"])){
			//去数据库中匹配
			$inviteInfo = $this->dao->getInviteCode($data["invite_code"]);
			if($inviteInfo['is_get'] == 1){
				Helper::interrupt($this,"注册失败，您的激活码已被使用。",2,Yii::app()->url->getRegisterUrl());
			}
		}else{
			Helper::interrupt($this,"注册失败，您的激活码无效，请重新尝试。",2,Yii::app()->url->getRegisterUrl());
		}

		$result = $this->dao->getUsername($data["username"]);
		if($result == false){		//确认用户有无被使用过
			
			//开启事务
			$this->dao->beginTransaction();
			
			$result = $this->dao->regist($data);
			if($result > 0){

				$activateCode = sha1(uniqid().Helper::getHash(8));

				//将邀请码更新成已经使用的状态
				$resultInvite = $this->dao->useInviteCode($data["invite_code"],$data["username"]);

				//写入激活码数据
				$resultActivate = $this->dao->insActivateCode($activateCode,$data["username"]);
				
				if($resultInvite + $resultActivate != 2){
					//出错，退出
					$this->dao->rollback();
					Helper::interrupt($this,"注册失败，系统无法完成您此次的注册操作，请重新尝试。",2,Yii::app()->url->getRegisterUrl());
				}else{
					$this->dao->commit();
				}

				$activateUrl = "http://".DOMAIN."/".Yii::app()->url->getActivateUrl()."&code=".$activateCode;
				//发送一封激活邮件到邮箱中去
				$email = Yii::app()->email;
				$email->setMessage("您好。<br>7663VR战网平台已经确认您的注册。请访问下面的地址进行激活操作。<br><a href='".$activateUrl."' target='_blank'>".$activateUrl."</a>");
				$email->setAddress($data["username"]);
				$email->setTitle("7663VR战网邮箱激活确认");
				$email->send();

				Helper::interrupt($this,"系统已将您的7663VR战网通行证验证发送至您的邮箱，请登录邮箱以后进行激活。！",1,Yii::app()->url->getLoginUrl(),10,"登录战网","您的通行证名(注册邮箱)<br/>".$data["username"]."<br/><br/>");
				//Helper::interrupt($this,"您的7663VR战网通行证已注册成功！",1,Yii::app()->url->getRegisterUrl(),"","登录战网","您的通行证名(注册邮箱)<br/>".$data["username"]."<br/><br/>");
			}else{
				Helper::interrupt($this,"注册失败，请重新尝试。",2,Yii::app()->url->getRegisterUrl());
			}
		}else{
			Helper::interrupt($this,"该用户已经被注册。",2,Yii::app()->url->getRegisterUrl());
		}


	}
	
	public function actionUsernameExist(){

		if(empty($_POST["username"]))$_POST["username"] = "";
		$username = $_POST["username"];

		if(empty($username)){
			$msg['result']		= "fail";
			$msg['username']	= $username;
			$msg['message']		= "用户名不能为空";
			Helper::ajaxJsonMsg($msg);
		}
		//数据库中查询是否存在用户名
		$userInfo = $this->dao->getUsername($username);

		if($userInfo == false){
			
			$msg['result']		= "succ";
			$msg['username']	= $username;
			$msg['message']		= "用户名不存在";

		}else{

			$msg['result']		= "fail";
			$msg['username']	= $username;
			$msg['message']		= "用户名已存在";
		}
		Helper::ajaxJsonMsg($msg);
	}

	public function actionInviteCode(){
		
		if(empty($_GET["inviteCode"]))$_GET["inviteCode"] = "";
		$inviteCode = $_GET["inviteCode"];

		//需要验证只能英文、数字、大小写不用区别
		$model = new CheckInviteCode;
		$model->inviteCode = $inviteCode;
		if($model->validate() ==  false){
			$msg['result']		= "fail";
			$msg['inviteCode']	= $inviteCode;
			$msg['message']		= $model->errors["inviteCode"][0];
			Helper::ajaxJsonMsg($msg);
		}

		//去数据库中确认邀请码是否存在
		$inviteInfo = $this->dao->getInviteCode($inviteCode);

		//没有找到数据
		if($inviteInfo == false){
			$msg['result']		= "fail";
			$msg['inviteCode']	= $inviteCode;
			$msg['message']		= "邀请码不存在";
			Helper::ajaxJsonMsg($msg);
		}

		if($inviteInfo['is_get'] == '1'){
			$msg['result']		= "fail";
			$msg['inviteCode']	= $inviteCode;
			$msg['message']		= "邀请码已被领取";
			Helper::ajaxJsonMsg($msg);
		}

		$msg['result']		= "succ";
		$msg['inviteCode']	= $inviteCode;
		$msg['message']		= "";
		Helper::ajaxJsonMsg($msg);
	}
	
	//退出登录
	public function actionLoginOut(){
		
		session_destroy();
		Helper::interrupt($this,"您已经退出系统。",1,Yii::app()->url->getLoginUrl());
	}

	//Test
	public function actionTest(){
		
        $page = new Page(10,5);
        $page->setAllNum(80);
        $data['page'] = $page->getHtml();
		var_dump($data['page']);
		/*模拟写入系统消息
		for($i = 0;$i<80;$i++){
			$data["title"] = "标题：".$i;
			$data["message"] = "内容：新京报讯 （记者张晓兰）同一天，又有三个城市加入了限购大军。10月6日，珠海、东莞、福州相继出台限购政策；同一天，惠州也出台了加强房地产市场监督管理工作的通知；这意味着9月30日至10月6日夜间，共计19个城市先后发布新的楼市调控政策。<br>东莞设防火墙，防深圳炒房者转移阵地<script>alert('hello')</script>对拥有2套及以上住房的本市户籍居民家庭暂停向其销售新建商品住房";
			$this->dao->insMessage($data["title"],$data["message"]);
		}*/
		//Helper::interrupt($this,"您的密码修改完成，请重新登录。",1,Yii::app()->url->getLoginUrl());
	}
	
}
