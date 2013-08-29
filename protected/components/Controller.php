<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public $isAjax = false;
	public function init()  
	{     
    	// parent::init();   
    	$this->isAjax  = Yii::app()->request->isAjaxRequest;
		if($this->isAjax){
			 $this->layout = '//layouts/columnAjax';
			Yii::app()->clientScript->enableJavaScript = false;
		}else{
			// Yii::app()->bootstrap->register();
		}    	
	  // Yii::app()->clientScript->registerCoreScript('jquery');	
	}	
	protected function afterRender($view, &$output)
	{
		if ($this->isAjax) {
			Yii::app()->clientScript->reset();
		}
		
		parent::afterRender($view, $output);
	}	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}	
}