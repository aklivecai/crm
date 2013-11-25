
<?php

class ManageController extends Controller
{

	public function init()  
	{     
    	parent::init();
    	$this->primaryName = 'manageid';
    	$this->modelName = 'Manage';
	  // Yii::app()->clientScript->registerCoreScript('jquery');
  //   	$cs = Yii::app()->getClientScript();
		// $cs->enableJavaScript = false;
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

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

	protected function getSelectOption($q){
		$result = parent::getSelectOption($q);
		$result['data']['attributes'][] = 'user_nicename';
		if ($q) {
			$result['data']['criteria']->addSearchCondition('user_nicename',$q,false,'OR');
		}
		return $result;
	}	

}
