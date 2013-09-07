<?php
/* @var $this AdminLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Admin Logs',
);

$this->menu=array(
	array('label'=>'Create AdminLog', 'url'=>array('create')),
	array('label'=>'Manage AdminLog', 'url'=>array('admin')),
);
?>

<h1>操作日志</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
