<?php
/* @var $this OrderFlowController */
/* @var $model OrderFlow */

$this->breadcrumbs=array(
	Tk::g($model->sName)=>array('admin'),
	$model->name=>array('view','id'=>$model->itemid),
	Tk::g('Update'),
);
?>	
<?php $this->renderPartial('_form', array('model'=>$model)); ?>