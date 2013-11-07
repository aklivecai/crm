<?php

class SiteController extends Controller
{
	public $layout='columnPage';
	public $msg;
	public $model;
	public function filters()
	{
		return array(
			'rights',
		);
	}
	public function allowedActions()
	{
	 	return 'init,index,login,error';
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
		if (Tak::isGuest()) {
			// Tak::KD($_GET);
			// Tak::KD(current($_GET));
			// Tak::KD(count($_GET));
			// Tak::KD($key);
			$k = key($_GET);
			$itemid = false;		
			if ($k) {
				$itemid = Tak::getCryptNum($k);
			}
			if ($itemid) {
				$this->redirect(array('init','k'=>$k));
			}else{
				$this->errorE();
			}
		}
		$this->_setLayout();
		$this->render('index');
	}
	public function actionHelp()
	{
		$this->_setLayout();
		$this->render('help');
	}

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


	private function inits($k){
		/*已经s登录，返回上一页，没有就首页*/
		if (!Tak::isGuest()) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
			$itemid = Tak::getCryptNum($k);
			$errorInfo = '非法操作！';
			if ($itemid) {
				$this->msg = $msg = TestMemeber::model()->getMmeber($itemid); 
				if (!$msg) {
					$itemid = false;
				}else{
					if ($msg['status']==0) {
						$itemid = false;
						$errorInfo = '帐号以禁止登录! 请联系客服 400 0168 488';
					}else{
						$active_time = $msg['active_time'];
						if ($active_time>0) {
							$time = time();
							$e1 = mktime(23,59,59,date("m",$active_time),date("d",$active_time)+15,date("Y",$active_time)); 
							if ($time>$e1) {
								$itemid = false;
								$errorInfo = '帐号已过期! 请联系客服 400 0168 488';
							}elseif($this->getAction()->id!='login') {
								$this->redirect(array('login','k'=>$k));
							}
						}else{
							if ($this->getAction()->id!='init') {
								$this->redirect(array('init','k'=>$k));
							}
						}
					}
				}
			}
			if ($itemid) {
			     $itemid = Tak::setCryptKey($itemid);
			     return $itemid;
			}else{
				$this->errorE($errorInfo);
			}
	}

	private function setting(){
		 $list = Setting::model()->getThemes();
		foreach ($list as $key => $value) {
			Yii::app()->user->setState($value->item_key, $value->item_value);
		 }
	}

	private function setForm($m){
		$result = isset($_POST[$m]);
		if($result)
		{
			$arr = $_POST[$m];
			$fromid = $arr['fromid'];
			if ($fromid) {
				$fromid = Tak::getCryptKey($fromid);
			}
			$arr['fromid'] = $fromid;
			$this->model->attributes = $arr;
			$result = $this->model->validate();
		}
		return $result;
	}

	public function actionInit($k=false){
		$itemid = $this->inits($k);
		$m = 'InitForm';
		$this->model = new $m();
		if ($this->setForm($m)) {
			if($this->model->install()){
				$model = new LoginForm();
				$model->attributes = $this->model->attributes;
			}else{
				$this->errorE();
			}
			if($model->login()){
				$this->setting();
				Yii::app()->user->setFlash('info', '激活成功，建议您先修改密码!');
				$this->redirect(array('site/changepwd'));
			}			
		}
		$this->model->attributes = array('fromid'=>$itemid);
		$this->render('init',array('model'=>$this->model,'msg'=>$this->msg));
	}



	public function actionLogin($k=false)
	{
		$itemid = $this->inits($k);
		$m = 'LoginForm';
		$this->model = $model = new $m();
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
			echo CActiveForm::validate($this->model);
			Yii::app()->end();
		}
		if ($this->setForm($m)&&$model->login()) {
			$this->setting();
			$this->redirect(Yii::app()->user->returnUrl);		
		}

		$model->attributes = array('fromid'=>$itemid);
		$this->render('login',array('model'=>$model,'msg'=>$this->msg));
	}	

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		if (Tak::isGuest()) {
			$this->redirect(Yii::app()->user->loginUrl);
		}		
		// 更新最后活跃时间
		Manage::model()->upActivkey();
		$fromid = Tak::getFormid();
		if ($fromid=='1') {
			$this->redirect(array('/juren/default/logout'));
		}

		$fromid = Tak::setCryptNum($fromid);

		Yii::app()->user->logout();
		$this->redirect(array('login','k'=>$fromid));
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

	public function actionOrder(){
		$this->_setLayout();
		Yii::app()->user->setFlash('info', '<strong>"订单功能"</strong> 请联系相关业务人员或者 致电400 0168 488');
		$this->render('page');
	}

	/**
	 * 还原数据库
	 */
	public function actionRestore()
	{
		$db = Yii::app()->getDb();
		$schema=file_get_contents(Yii::app()->basePath.'/data/reset.sql');
		$schema= preg_split("/;\s+/", trim($schema, ';'));
		foreach( $schema as $sql )
			$db->createCommand($sql)->execute();
		Yii::app()->user->setFlash('success', 'Database has been restored!');
		$this->redirect(Yii::app()->homeUrl);
	}
}