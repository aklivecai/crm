<?php

class ContactpPrsonController extends Controller
{
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'ContactpPrson';
	}
	public function actionAdmin($itemid=false)
	{
		$model = new ContactpPrson('search');
		$model->unsetAttributes();  
		if(isset($_GET['ContactpPrson'])){
			$model->attributes = $_GET['ContactpPrson'] ;
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}	
	public function actionCreate($itemid = false)
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
}
