<?php

class SiteController extends Controller
{

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$data = array('var'=>'变量值');
		$this->render('index',$data);
	}

	public function actionRule(){

		$model = new SiteForm;
		$model->username = "dan";
		$model->password = "123456";
		var_dump($model->validate());
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
}