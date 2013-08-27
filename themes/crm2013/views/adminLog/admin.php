<?php
/* @var $this AdminLogController */
/* @var $model AdminLog */

$this->breadcrumbs=array(
	'日志管理'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AdminLog', 'url'=>array('index')),
	array('label'=>'Create AdminLog', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#admin-log-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'admin-log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'user_name',
		'qstring',
		'info',
		'ip',
		array(
			'name'=>'add_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->add_time)'
		),		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
