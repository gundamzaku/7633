<?php

class SiteController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//Yii::app()->user->show();
		//var_dump(Yii::app()->user);
		$data = array('var'=>'变量值');
		$this->render('index',$data);
	}

	public function actionRule(){

		$model = new SiteForm;
		$model->username = "dan";
		$model->password = "123456";
		var_dump($model->validate());
	}

	public function actionDb(){

		//$command = Yii::app()->db->createCommand();
		/*
		$command->insert('auth_user', array(
			'username'=>'liudan',
			'password'=>md5("123456"),
			'first_name'=>'liu',
			'last_name'=>'dan',
			'email'=>'gundamzaku@163.com',
			'is_active'=>1,
			'is_staff'=>1,
			'is_superuser'=>0,
			'date_joined'=>date("Y-m-d H:i:s")
		));*/

		$user = Yii::app()->db->createCommand()
		->select('id,username')
		->from('auth_user u')
		->where('id=:id', array(':id'=>5))
		->queryRow();

		echo($user["username"]);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	public function actionTestWidget() { 

		$this->render('testwidget'); 
	}
}
