<?php
/* @var $this ClienteleController */
/* @var $model Clientele */

$this->breadcrumbs=array(
	'Clienteles'=>array('index'),
	$model->itemid=>array('view','id'=>$model->itemid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Clientele', 'url'=>array('index')),
	array('label'=>'Create Clientele', 'url'=>array('create')),
	array('label'=>'View Clientele', 'url'=>array('view', 'id'=>$model->itemid)),
	array('label'=>'Manage Clientele', 'url'=>array('admin')),
);
?>

<h1>Update Clientele <?php echo $model->itemid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>