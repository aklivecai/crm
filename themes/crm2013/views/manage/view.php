<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	'Manages'=>array('index'),
	$model->manageid,
);

$this->menu=array(
	array('label'=>'List Manage', 'url'=>array('index')),
	array('label'=>'Create Manage', 'url'=>array('create')),
	array('label'=>'Update Manage', 'url'=>array('update', 'id'=>$model->manageid)),
	array('label'=>'Delete Manage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->manageid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Manage', 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fromid',
		'manageid',
		'user_name',
		'user_pass',
		'salt',
		'user_nicename',
		'user_email',
		'add_time',
		'add_ip',
		'last_login_time',
		'last_login_ip',
		'login_count',
		'user_status',
		'note',
		'activkey',
		'active_time',
	),
)); ?>
