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
			$arr = new SplFixedArray(1); 
			$arr[0] = "admin/login";

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
}
