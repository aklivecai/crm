<?php
/* @var $this ClienteleController */
/* @var $model Clientele */

$this->breadcrumbs=array(
	'Clienteles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Clientele', 'url'=>array('index')),
	array('label'=>'Manage Clientele', 'url'=>array('admin')),
);
?>

<h1>Create Clientele</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>