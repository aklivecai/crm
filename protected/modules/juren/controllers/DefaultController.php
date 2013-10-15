<?php
class DefaultController extends JController
{

	public function init(){
		parent::init();
		$this->layout = 'column1';		
	}

	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionLogin($itemid=false)
	{
		/*已经登录，返回上一页，没有就首页*/
		if (!Tak::isGuest()) {
			$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->layout = 'column1';
		$model = new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$fromid = $_POST['LoginForm']['fromid'];
			if ($fromid) {
				$fromid = Tak::getCryptKey($fromid);
			}else{
				$fromid = 1;
			}
			$_POST['LoginForm']['fromid'] = $fromid;
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->login()){
				 $this->redirect(array('index'));
			}
		}
		if ($itemid) {
			$model->fromid = Tak::getCryptKey($itemid); 
		}else{
			$itemid = Tak::setCryptKey(1);
		}		
		
		$model->attributes = array('fromid'=>$itemid);
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('default/login'));
	}
	public function actionChangepwd()
	{
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
			}
		}
		$this->render('changepwd',array(
			'model' => $model,
			'modifySuccess' => $modifySuccess,
		));
	}			
}