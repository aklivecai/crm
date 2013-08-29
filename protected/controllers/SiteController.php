<?php

class SiteController extends Controller
{
	public $layout='columnPage';
	public function filters()
	{
		return array(
			'rights',
		);
	}
	public function allowedActions()
	{
	 	return 'login,error';
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionIndex()
	{
		$this->layout='column1';
		$this->render('index');
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
	    }else{
	    	throw new CHttpException(404, 'Page not found.');
	    }
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin($itemid=false)
	{
		if (!$itemid) {
			$itemid = Tak::setCryptKey(2);
			$this->redirect(array('login','itemid'=>$itemid));
		}       

		$model = new LoginForm($itemid);
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		// 更新最后活跃时间
		Manage::model()->upActivkey();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	

	/**
	 * 还原数据库
	 */
	public function actionRestore()
	{
		$db = Yii::app()->getDb();
		$schema=file_get_contents(Yii::app()->basePath.'/data/reset.sql');
		$schema=preg_split("/;\s+/", trim($schema, ';'));
		foreach( $schema as $sql )
			$db->createCommand($sql)->execute();
		Yii::app()->user->setFlash('success', 'Database has been restored!');
		$this->redirect(Yii::app()->homeUrl);
	}
}