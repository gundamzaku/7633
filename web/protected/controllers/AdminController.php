<?php

class AdminController extends Controller
{
	public $body	= '';
	public $session = '';
	private $dao;

	public function init(){
		
		$this->session = Yii::app()->session;
		//如果在用户未登录的状态下面
		if(empty($this->session['adminname'])){
			$noLogin = false;
			$action = "";
			if(!empty($_GET['r']))$action = $_GET['r'];
			$arr = new SplFixedArray(2); 
			$arr[0] = "admin/login";
			$arr[1] = "admin/doLogin";

			$size = $arr->getSize(); 
			for($i=0;$i<$size;$i++){
				if($action == $arr->offsetGet($i) || empty($action)){
					$noLogin = true;
				}
			}

			if($noLogin === false){
				$this->redirect(array('/admin/login'));
				//需要登录
			}
		}
		//登录的话上面这几步就不用做了

		$this->dao = new DaoSite();
	}

	//后台登录页
	public function actionLogin(){
		$this->body = "single";
		$this->layout='//layouts/main_nonav';
		$this->render('login');
	}

	//后台登录确认页
	public function actionDoLogin(){

		$adminname = $_POST["adminname"];
		$pwd = $_POST["pwd"];
		
		if(empty($adminname)){
			Helper::interrupt($this,"您输入的当前管理员名称不能为空。",2,Yii::app()->url->getAdminLoginUrl());
		}

		if(empty($pwd)){
			Helper::interrupt($this,"您输入的当前密码不能为空。",2,Yii::app()->url->getAdminLoginUrl());
		}

		//得到用户
		$adminInfo = $this->dao->getAdminInfo($adminname);
		if(empty($adminInfo)){
			Helper::interrupt($this,"后台帐号不存在。",2,Yii::app()->url->getAdminLoginUrl());
		}
		if(md5($pwd) != $adminInfo["password"]){
			Helper::interrupt($this,"您输入的当前密码错误。",2,Yii::app()->url->getAdminLoginUrl());
		}

		$this->session["adminname"] = $adminInfo["adminname"];
		Helper::interrupt($this,"登录完成。",1,Yii::app()->url->getAdminMainUrl());
	}

	//后台主页面
	public function actionMain(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		$this->render('main');
	}

	//后台广告页面
	public function actionAdviertisement(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';

		$p = !empty($_GET["p"])?$_GET["p"]:1;
        $page = new Page(10,$p,Yii::app()->url->getAdminAdviertisementUrl());

		$result = $this->dao->getAdviertisementCount();
        $page->setAllNum($result['ct']);
		$result = $this->dao->getAdviertisementPage($page->getLimitOffset(10,$p),10);
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
			$result[$k]['title']	= $purifier->purify($result[$k]['title']);
			$result[$k]['url']		= $purifier->purify($result[$k]['url']);
		}

        $data['page'] = $page->getHtml();
		$data['p'] = $p;
		$data['adviertisement'] = $result;

		$this->render('adviertisement',$data);
	}

	//添加后台广告页面
	public function actionAddAdviertisement(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		
		$data['aid'] = "";
		$data['title'] = "";
		$data['icon'] = "";
		$data['url'] = "";
		$this->render('addAdviertisement',$data);
	}

	//修改后台广告页面
	public function actionUpdAdviertisement(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		
		$aid = intval($_GET["aid"]);	//ID
		
		//根据AID拿到广告信息
		$adviertisementInfo = $this->dao->getTableInfo("adviertisement","aid",$aid);

		$data['aid'] = $adviertisementInfo["aid"];
		$data['title'] = $adviertisementInfo["title"];
		$data['icon'] = $adviertisementInfo["icon"];
		$data['url'] = $adviertisementInfo["url"];
		
		$this->render('addAdviertisement',$data);
	}

	//添加后台广告操作页面
	public function actionDoAddAdviertisement(){
		
		$aid = !empty($_POST["aid"])?$_POST["aid"]:"";
		$title = !empty($_POST["title"])?$_POST["title"]:"";
		$url = !empty($_POST["url"])?$_POST["url"]:"";
		$iconOld = !empty($_POST["icon_old"])?$_POST["icon_old"]:"";
		$icon = !empty($_FILES["icon"])?$_FILES["icon"]:"";
		$model = new CheckAdviertisement();
		$model->title = $title;

		$model->icon = CUploadedFile::getInstanceByName('icon');
		
		if($model->validate() ==  false){
			foreach($model->errors as $k=>$v){
				$message[] = $v[0];
			}
			$message = implode("<br>",$message);

			Helper::interrupt($this,$message,2,Yii::app()->url->getAdminAddAdviertisementUrl());
		}
		if(!empty($model->icon)){
			$iconName = Helper::uploadPic("adv","icon");
		}else{
			$iconName = $iconOld;
		}
		if(empty($aid)){
			$this->dao->addAdviertisement($title,$iconName,$url);
			$desc = "添加";
			$url = Yii::app()->url->getAdminAddAdviertisementUrl();
		}else{

			$info["title"] = $title;
			$info["url"] = $url;
			$info["icon"] = $iconName;

			$this->dao->updTableInfo("adviertisement",$info,"aid",$aid);
			$desc = "修改";
			$url = Yii::app()->url->getAdminUpdAdviertisementUrl("aid=".$aid);
			
		}
		Helper::interrupt($this,"宣传广告".$desc."完成。",1,$url);
	}

	/*******后台商铺********/
	
	//后台商铺页面
	public function actionStore(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';

		$p = !empty($_GET["p"])?$_GET["p"]:1;
        $page = new Page(10,$p,Yii::app()->url->getAdminStoreUrl());

		$result = $this->dao->getStoreCount();
        $page->setAllNum($result['ct']);
		$result = $this->dao->getStorePage($page->getLimitOffset(10,$p),10);
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
			$result[$k]['title']	= $purifier->purify($result[$k]['title']);
			$result[$k]['url']		= $purifier->purify($result[$k]['url']);
		}

        $data['page'] = $page->getHtml();
		$data['p'] = $p;
		$data['store'] = $result;

		$this->render('store',$data);
	}

	//添加后台商铺页面
	public function actionAddStore(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		
		$data['sid'] = "";
		$data['title'] = "";
		$data['icon'] = "";
		$data['url'] = "";
		$this->render('addStore',$data);
	}
	
	//修改后台商铺页面
	public function actionUpdStore(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		
		$sid = intval($_GET["sid"]);	//ID
		
		//根据AID拿到广告信息
		$storeInfo = $this->dao->getTableInfo("store","sid",$sid);

		$data['sid'] = $storeInfo["sid"];
		$data['title'] = $storeInfo["title"];
		$data['icon'] = $storeInfo["icon"];
		$data['url'] = $storeInfo["url"];
		
		$this->render('addStore',$data);
	}

	//添加后台商铺操作页面
	public function actionDoAddStore(){
		
		$sid = !empty($_POST["sid"])?$_POST["sid"]:"";
		$title = !empty($_POST["title"])?$_POST["title"]:"";
		$url = !empty($_POST["url"])?$_POST["url"]:"";
		$iconOld = !empty($_POST["icon_old"])?$_POST["icon_old"]:"";
		$icon = !empty($_FILES["icon"])?$_FILES["icon"]:"";

		//结构和adviertisment的一样，暂衍用了
		$model = new CheckAdviertisement();
		$model->title = $title;

		$model->icon = CUploadedFile::getInstanceByName('icon');
		
		if($model->validate() ==  false){
			foreach($model->errors as $k=>$v){
				$message[] = $v[0];
			}
			$message = implode("<br>",$message);

			Helper::interrupt($this,$message,2,Yii::app()->url->getAdminAddStoreUrl());
		}
		if(!empty($model->icon)){
			$iconName = Helper::uploadPic("store","icon");
		}else{
			$iconName = $iconOld;
		}

		if(empty($sid)){

			$this->dao->addStore($title,$iconName,$url);
			$desc = "添加";
			$url = Yii::app()->url->getAdminAddStoreUrl();
		
		}else{

			$info["title"] = $title;
			$info["url"] = $url;
			$info["icon"] = $iconName;

			$this->dao->updTableInfo("store",$info,"sid",$sid);
			$desc = "修改";
			$url = Yii::app()->url->getAdminUpdStoreUrl("sid=".$sid);
			
		}
		Helper::interrupt($this,"店铺信息".$desc."完成。",1,$url);
	}

	/*******后台系统消息********/
	
	//后台系统页面
	public function actionMessage(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';

		$p = !empty($_GET["p"])?$_GET["p"]:1;
        $page = new Page(10,$p,Yii::app()->url->getAdminMessageUrl());

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
			$result[$k]['title']	= $purifier->purify($result[$k]['title']);
			$result[$k]['content']		= $purifier->purify($result[$k]['content']);
		}

        $data['page'] = $page->getHtml();
		$data['p'] = $p;
		$data['message'] = $result;

		$this->render('message',$data);
	}

	//添加后台系统页面
	public function actionAddMessage(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		
		$data['mid'] = "";
		$data['title'] = "";
		$data['content'] = "";
		$this->render('addMessage',$data);
	}

	//修改后台系统页面
	public function actionUpdMessage(){
		$this->body = "single";
		$this->layout='//layouts/main_admin_nonav';
		
		$mid = intval($_GET["mid"]);	//ID
		
		//根据AID拿到广告信息
		$messageInfo = $this->dao->getTableInfo("message","mid",$mid);

		$data['mid'] = $messageInfo["mid"];
		$data['title'] = $messageInfo["title"];
		$data['content'] = $messageInfo["content"];
		
		$this->render('addMessage',$data);
	}

	//添加后台系统操作页面
	public function actionDoAddMessage(){
		
		$mid = !empty($_POST["mid"])?$_POST["mid"]:"";
		$title = !empty($_POST["title"])?$_POST["title"]:"";
		$content = !empty($_POST["content"])?$_POST["content"]:"";
		
		if(empty($title)){
			Helper::interrupt($this,"标题不能为空。",2,Yii::app()->url->getAdminAddMessageUrl());
		}

		if(empty($content)){
			Helper::interrupt($this,"内容不能为空。",2,Yii::app()->url->getAdminAddMessageUrl());
		}

		if(empty($mid)){

			$this->dao->addMessage($title,$content);
			$desc = "添加";
			$url = Yii::app()->url->getAdminAddMessageUrl();
		
		}else{

			$info["title"] = $title;
			$info["content"] = $content;

			$this->dao->updTableInfo("message",$info,"mid",$mid);
			$desc = "修改";
			$url = Yii::app()->url->getAdminUpdMessageUrl("mid=".$mid);
			
		}
		Helper::interrupt($this,"系统消息".$desc."完成。",1,$url);
	}
}
