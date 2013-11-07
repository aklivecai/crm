<?php

class StocksController extends Controller
{
	public function init()  
	{     
    	parent::init();
    	$this->modelName = 'Stocks';
	}
}
