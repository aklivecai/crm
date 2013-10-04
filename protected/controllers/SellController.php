<?php

class SellController extends Controller
{
	public $type = 1;
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'Movings';
		
	}
	public function loadModel($id=false)
	{
		if($this->_model===null)
		{
			if ($id) {
				$m = $this->modelName;
				$model = $m::model();
				
				$this->_model->initak($this->type);
			}
			
			if($this->_model===null){
					throw new CHttpException(404,'所请求的页面不存在。');
			}
		}
		return $this->_model;
	}	
}
