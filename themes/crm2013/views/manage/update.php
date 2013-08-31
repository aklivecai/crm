<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	Tk::g('Manages')=>array('index'),
	$model->manageid=>array('view','id'=>$model->manageid),
	Tk::g('Update'),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>