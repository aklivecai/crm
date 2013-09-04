<?php
class ClienteleController extends Controller
{
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'Clientele';
	}

	public function actionSelect(){
		 $callback = $_GET['callback'];
		 header('Content-Type: application/json');
		 $dataProvider = new JSonActiveDataProvider('Clientele',array(
		 		'attributes' => array('itemid', 'clientele_name')
		 		,
		 )); 
		 $rs = $dataProvider->getArrayCountData();
		 $str = '{"total":'.$rs['totalItemCount'].',"link_template":"http://api.rottentomatoes.com/api/public/v1.0/movies.json?q={search-term}&page_limit={results-per-page}&page={page-number}"';
		$str = $callback.'('.$dataProvider->getJsonData().');';
		echo($str);
		exit;
	}
}
