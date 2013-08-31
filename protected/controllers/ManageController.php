<?php

class ManageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';
	
	public function init()  
	{     
    	parent::init();
    	$this->primaryName = 'manageid';
    	$this->modelName = 'Manage';
	  // Yii::app()->clientScript->registerCoreScript('jquery');
  //   	$cs = Yii::app()->getClientScript();
		// $cs->enableJavaScript = false;
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
	 * Lists all models.
	 */
	public function actionIndex()
	{

		$criteria = array();
		if (!Tak::getAdmin()) {
		   	$criteria['condition'] = "fromid=".Tak::getFormid();
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

}
