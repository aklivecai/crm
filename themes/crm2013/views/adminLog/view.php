<?php
/* @var $this AdminLogController */
/* @var $model AdminLog */

$this->breadcrumbs=array(
	'Admin Logs'=>array('index'),
	$model->itemid,
);

$this->menu=array(
	array('label'=>'List AdminLog', 'url'=>array('index')),
	array('label'=>'Create AdminLog', 'url'=>array('create')),
	array('label'=>'Update AdminLog', 'url'=>array('update', 'id'=>$model->itemid)),
	array('label'=>'Delete AdminLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->itemid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AdminLog', 'url'=>array('admin')),
);
?>

<h1>View AdminLog #<?php echo $model->itemid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'itemid',
		'fromid',
		'user_name',
		'qstring',
		'info',
		'ip',
		'add_time',
	),
)); ?>
