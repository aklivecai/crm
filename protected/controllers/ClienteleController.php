<?php
class ClienteleController extends Controller
{
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'Clientele';
	}

	public function actionSelect(){
		$this->layout = '//layouts/columnPage';
		$model = new Clientele('search');
		$model->unsetAttributes();  
		if(isset($_GET['Clientele'])){
			$model->attributes = $_GET['Clientele'] ;
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
