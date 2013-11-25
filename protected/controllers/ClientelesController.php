<?php
class ClientelesController extends Controller
{
	public $defaultAction = 'index';
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'Clientele';
	}

	public function actionIndex()
	{
		$m = $this->modelName;
		$model = new $m('search');
		$model->setGetCU();

		$model->unsetAttributes();
		if(isset($_GET[$m])){
			$model->attributes = $_GET[$m] ;
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}	
	public function actionView($id)
	{
		$model = Clientele::model()->setGetCU()->findByPk($id);

		$strView = $this->templates['view'];

		$m = 'Contact';
		$mContact = new $m('search');
		$arr = isset($_GET[$m])?$_GET[$m]:false;
		if($arr) {
			$arr['clienteleid'] = $model->itemid;
			$mContact->attributes = $arr;
		}else{
			$mContact->attributes = array('clienteleid'=>$model->itemid);
		}
		if($this->isAjax
			&&($arr||$_GET[$m.'_page'])){
			$strView = 'contact';
		}
		if($mContact->contact_time==0){
			$mContact->contact_time = '';
		}
		$this->render($strView,array(
			'model' => $model,
			'mContact' => $mContact,
		));
	}	
}
