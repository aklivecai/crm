<?php
$this->breadcrumbs=array(
	'Tak Settings'=>array('index'),
	$model->itemid,
);

$this->menu=array(
	array('label'=>'List TakSetting','url'=>array('index')),
	array('label'=>'Create TakSetting','url'=>array('create')),
	array('label'=>'Update TakSetting','url'=>array('update','id'=>$model->itemid)),
	array('label'=>'Delete TakSetting','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->itemid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TakSetting','url'=>array('admin')),
);
?>

<h1>View TakSetting #<?php echo $model->itemid; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'itemid',
		'fromid',
		'item_key',
		'item_value',
		'add_time',
		'add_us',
		'add_ip',
		'modified_time',
		'modified_us',
		'modified_ip',
	),
)); ?>
