<?php

class ManageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'updateOwn + update', // Apply this filter only for the update action.
			'rights',
		);
	}

	/**
	 * Filter method for checking whether the currently logged in user
	 * is the author of the post being accessed.
	 */
	public function filterUpdateOwn($filterChain)
	{

		$obj = $this->loadModel($_GET['id']);
		
		// Remove the 'rights' filter if the user is updating an own post
		// and has the permission to do so.
		if(Yii::app()->user->checkAccess('ManageUpdateOwn', array('userid'=>$obj->manageid)))
			$filterChain->removeAt(1);
		
		$filterChain->run();
	}	

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Manage;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Manage']))
		{
			
			$model->attributes=$_POST['Manage'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->manageid));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Manage']))
		{
			$model->attributes=$_POST['Manage'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->manageid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		Tak::KD(yii::app()->theme->baseUrl);
		$auth = Yii::app()->authManager;
		$criteria = array();
		if (!Tak::getAdmin()) {
		   	$criteria['condition'] = "fromid=".Tak::getFormid();
		   	print_r($criteria);
		 }   
		$dataProvider = new CActiveDataProvider('Manage',array(
			'pagination'=>array(
				'pageSize'=>20,
			),			
 			'criteria'=> $criteria,
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Manage('search');
		if (isset($_GET['pageSize'])) {
			if ((int)$_GET['pageSize']>0&&$_GET['pageSize']!=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize'])) {
				Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			}			
			unset($_GET['pageSize']); 
		}
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Manage']))
			$model->attributes = $_GET['Manage'] ;
	  if(Yii::app()->request->isAjaxRequest){
	  	 $this->layout = '//layouts/columnAjax';
	  }
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel($id)
	{
		if($this->_model===null)
		{
				if(Yii::app()->user->isGuest)
					$ite = true;
					// $condition='status=.'Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED;
				else
					$condition='';

			$this->_model = Manage::model()->findByPk($id, $condition);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


	/**
	 * Performs the AJAX validation.
	 * @param Manage $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manage-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
