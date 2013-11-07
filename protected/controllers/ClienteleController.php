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

	public function actionSelect(){
		 $pageSize = Yii::app()->request->getQuery('page_limit',10);
		 $page = Yii::app()->request->getQuery('page',1);
		 $q = Yii::app()->request->getQuery('q','*');
		 $criteria = new CDbCriteria;
		 if ($q!='*') {
		 	$criteria->addSearchCondition('clientele_name',$q);
		 }
		 $dataProvider = new JSonActiveDataProvider('Clientele',array(
		 		'attributes' => array('itemid', 'clientele_name'),
		 		'criteria' => $criteria,
				'sort'=>array(
					'defaultOrder'=>'last_time DESC,clientele_name ASC', 
				),
				'pagination' => array( 
					'pageSize' => $pageSize
				), 	            
		 )); 
		 $rs = $dataProvider->getArrayCountData();
		 $str = '{"total":'.$rs['totalItemCount'].',"link_template":"http://api.rottentomatoes.com/api/public/v1.0/movies.json?q={search-term}&page_limit={results-per-page}&page={page-number}"';
		 $this->writeData($dataProvider->getJsonData());
	}
}
