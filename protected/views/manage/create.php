<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	'Manages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Manage', 'url'=>array('index')),
	array('label'=>'Manage Manage', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>