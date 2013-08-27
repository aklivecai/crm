<?php
/* @var $this ClienteleController */
/* @var $model Clientele */

$this->breadcrumbs=array(
	'Clienteles'=>array('index'),
	$model->itemid,
);

$this->menu=array(
	array('label'=>'List Clientele', 'url'=>array('index')),
	array('label'=>'Create Clientele', 'url'=>array('create')),
	array('label'=>'Update Clientele', 'url'=>array('update', 'id'=>$model->itemid)),
	array('label'=>'Delete Clientele', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->itemid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Clientele', 'url'=>array('admin')),
);
?>

<h1>View Clientele #<?php echo $model->itemid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'itemid',
		'fromid',
		'manageid',
		'rating',
		'annual_revenue',
		'industry',
		'profession',
		'origin',
		'employees',
		'accountname',
		'email',
		'address',
		'telephone',
		'fax',
		'web',
		'visibility',
		'add_time',
		'add_us',
		'add_ip',
		'modified_time',
		'modified_us',
		'modified_ip',
		'note',
	),
)); ?>
