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

	protected function _setLayout($layout='column2')
	{
		$this->layout=$layout;
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionIndex()
	{
		$this->_setLayout();
		$this->render('index');
	}
	public function actionHelp()
	{
		$this->_setLayout();
		$this->render('help');
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
		$arr = array(2,3,4,5);

		/*已经s登录，返回上一页，没有就首页*/
		if (!Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		foreach ($arr as $key => $value) {
			$arr[Tak::setCryptKey($value)] = $value;
			unset($arr[$key]);
		}
		/*没有传递itemid 得报错。调试默认*/
		if (!$itemid) {
			$itemid = Tak::setCryptKey(2);
			$this->redirect(array('login','itemid'=>$itemid));
		}       

		$model = new LoginForm();
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
			if($model->validate() && $model->login()){
				// 读取用户配置信息
				 $list = Setting::model()->getThemes();
				 foreach ($list as $key => $value) {
				 	Yii::app()->user->setState($value->item_key, $value->item_value);
				 }
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model,'listType'=>$arr));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		if (Yii::app()->user->isGuest) {
			$this->redirect(Yii::app()->user->loginUrl);
		}		
		// 更新最后活跃时间
		Manage::model()->upActivkey();
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionChangepwd()
	{
		$this->_setLayout();
		$model = new PasswdModifyForm();
		$m = 'PasswdModifyForm';
		$modifySuccess = false;
		if(isset($_POST[$m]))
		{
			$model->attributes = $_POST[$m];
			if($model->save()){
                $model->oldPasswd="";
                $model->passwd = "";
                $model->passwdConfirm="";
                Tak::msg('','修改密码成功！');
			}
		}
		$this->render('changepwd',array(
			'model' => $model,
			'modifySuccess' =>$modifySuccess,
		));
	}
	
	public function actionProfile()
	{
		$this->_setLayout();

		$m = 'Manage';
		$model = $m::model()->findByPk(Tak::getManageid());
		if(isset($_POST[$m]))
		{
			$_POST[$m]['user_pass'] = $model->user_pass;
			$_POST[$m]['user_name'] = $model->user_name;

			$model->attributes = $_POST[$m];

			if($model->save())
				$this->redirect(array('profile'));
		}
		$this->render('profile',array(
			'model'=>$model,
		));
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