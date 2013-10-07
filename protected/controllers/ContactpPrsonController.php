<?php

class ContactpPrsonController extends Controller
{
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'ContactpPrson';
	}


	public function actionSelect(){
		 $pageSize = Yii::app()->request->getQuery('page_limit',10);
		 $page = Yii::app()->request->getQuery('page',1);
		 $q = Yii::app()->request->getQuery('q','*');

		 $clienteleid = Yii::app()->request->getQuery('clienteleid','0');
		 if(!is_numeric($clienteleid)){
		 	$clienteleid = '0';
		 }
		 $criteria = new CDbCriteria;
		 if ($q!='*') {
		 	$criteria->addSearchCondition('nicename',$q);
		 }
		 if ($clienteleid!='0') {
		 	$criteria->addCondition('clienteleid='.$clienteleid);
		 }
		 $dataProvider = new JSonActiveDataProvider($this->modelName,array(
		 		'attributes' => array('itemid', 'nicename'),
		 		'criteria' => $criteria,
				'sort'=>array(
					'defaultOrder'=>'last_time DESC,nicename ASC', 
				),
				'pagination' => array( 
					'pageSize' => $pageSize
				), 	            
		 )); 
		 $rs = $dataProvider->getArrayCountData();
		 $this->writeData($dataProvider->getJsonData());
	}		
}
