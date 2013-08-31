<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = 'column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $_model;
	public $primaryName = 'itemid';
	public $modelName = '';


	public $isAjax = false;
	public function init()  
	{     
    	// parent::init();   
    	$this->isAjax  = Yii::app()->request->isAjaxRequest;
		if($this->isAjax){
			 $this->layout = '//layouts/columnAjax';
			Yii::app()->clientScript->enableJavaScript = false;
		}else{
			// Yii::app()->bootstrap->register();
		}
	}	

	public function afterRender($view, &$output)
	{
		if ($this->isAjax) {
			Yii::app()->clientScript->reset();
		}		
		parent::afterRender($view, $output);
	}	


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'updateOwn + update', // Apply this filter only for the update action.
			'deleteOwn + delete', // Apply this filter only for the update action.
			'rights',
		);
	}

	/**
	 * Filter method for checking whether the currently logged in user
	 * is the author of the post being accessed.
	 */
	public function filterUpdateOwn($filterChain)
	{
		$itemid = $this->primaryName;
		$obj = $this->loadModel($_GET['id']);
		// Remove the 'rights' filter if the user is updating an own post
		// and has the permission to do so.

		if(Yii::app()->user->checkAccess('UpdateOwn', array('userid'=>$obj->$itemid)))
			$filterChain->removeAt(1);
		$filterChain->run();
	}	

	/**
	 * Filter method for checking whether the currently logged in user
	 * is the author of the post being accessed.
	 */
	public function filterDeleteOwn($filterChain)
	{
		$itemid = $this->primaryName;
		$obj = $this->loadModel($_GET['id']);
		if(Yii::app()->user->checkAccess('DeleteOwn', array('userid'=>$obj->$itemid)))
			$filterChain->removeAt(1);
		$filterChain->run();
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
			$m = $this->modelName;
			$this->_model = $m::model()->findByPk($id, $condition);
			if($this->_model===null)
				throw new CHttpException(404,'所请求的页面不存在。');
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$m = $this->modelName;
		$itemid = $this->primaryName;

		$model =new $m;
		if(isset($_POST[$m]))
		{
			$model->attributes=$_POST[$m];
			if($model->save())
				$this->redirect(array('view','id'=>$model->$itemid));
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

		$m = $this->modelName;
		$itemid = $this->primaryName;

		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$m]))
		{
			$model->attributes=$_POST[$m];
			if($model->save())
				$this->redirect(array('view','id'=>$model->$itemid));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$m = $this->modelName;
		$model = new $m('search');
		if (isset($_GET['setPageSize'])) {
			$setPageSize = (int)$_GET['setPageSize'];
			if ($setPageSize>0
				&&$setPageSize!=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize'])
				) {
				Yii::app()->user->setState('pageSize',$setPageSize);
			}			
			unset($_GET['pageSize']); 
		}
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$m])){
			$model->attributes = $_GET[$m] ;
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}	

}