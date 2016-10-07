<?php

class PayController extends Controller
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
	public function actionOrders(){

		$p = !empty($_GET["p"])?$_GET["p"]:1;
		//10:平均显示页数
        $page = new Page(10,$p,Yii::app()->url->getOrdersUrl());

		//$result = $this->dao->getMessageCount();
        //得到总行数
		$result['ct'] = 80;//这里模拟80条
		$page->setAllNum($result['ct']);
		//得到数据
		//$result = $this->dao->getMessagePage($page->getLimitOffset(10,$p),10);
		//具体代码可参数MainController.php中的actionMessageList()
        $data['page'] = $page->getHtml();

		$data['p'] = $p;
		$data['orders'] = $result;
		$this->render('orders',$data);

	}

	//支付页
	public function actionPay(){
		$this->render('pay');

	}
}
