<?php

class PurchaseController extends Controller
{
	protected $type = 1;
	protected $cates = null;
	
	public function init()  
	{     
		$this->dir = '//movings/';
    	parent::init();
    	$this->modelName = 'Movings';
    	$this->cates = TakType::items('purchase-type');

	}
	public function loadModel($id=false)
	{
		if($this->_model===null)
		{
			if ($id) {
				$m = $this->modelName;
				$model = $m::model();
				$this->_model = $m->findByPk($id, $condition);
			}
			if($this->_model===null){
					throw new CHttpException(404,'所请求的页面不存在。');
			}else{
				$this->_model->initak($this->type);
			}
		}
		return $this->_model;
	}	

	protected function beforeAction($action)
	{
		$m = $this->modelName;
		$strTypeName = 'typeid';
		if ($action->id=='create') {
			$typeid = Yii::app()->request->getParam($m.'['.$strTypeName.']',false);
			if (!$typeid||!$this->cates[$typeid]) {
				$typeid = key($this->cates);
			}
			if(isset($_POST[$m])){
				$_POST[$m][$strTypeName] = $typeid;
			}else{
				$_GET[$m][$strTypeName] = $typeid;
			}
		}
	    return true;
	} 	
	public function afterRender($view, &$output){
		parent::afterRender($view, $output);
	}		

}
