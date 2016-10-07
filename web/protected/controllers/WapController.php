<?php

class WapController extends Controller{

	public function init(){
		$this->layout = false;
	}

	//用户信息页
	public function actionIndex(){
		
		$this->render('index');

	}

}
