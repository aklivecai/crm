<?php
class ClienteleController extends Controller
{
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'Clientele';
	}
	public function actionSelectById($id=false){
		 // header('Content-Type: application/json');
		if (!is_numeric($id)) {
			$message = Tk::g('Illegal operation');
			throw new CHttpException(403, $message);
			exit;
		}
		// $tags = Clientele::model()->published()->recently(3)->findAll();
		// Tak::KD($tags);
		$msg = Clientele::model()->find(array(
		    'select'=>'itemid,clientele_name',
		    'condition'=>'itemid=:itemid',
		    'params'=>array(':itemid'=>$id),
		));
		if ($msg!=null) {
			$str = json_encode($msg->attributes);
			$this->writeData('{data:['.$str.']}');
		}		
	}
}
