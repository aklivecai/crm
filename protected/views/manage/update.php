<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	'Manages'=>array('index'),
	$model->manageid=>array('view','id'=>$model->manageid),
	'修改',
);

$this->menu=array(
	array('label'=>'List Manage', 'url'=>array('index')),
	array('label'=>'Create Manage', 'url'=>array('create')),
	array('label'=>'View Manage', 'url'=>array('view', 'id'=>$model->manageid)),
	array('label'=>'Manage Manage', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>