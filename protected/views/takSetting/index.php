<?php
$this->breadcrumbs=array(
	'Tak Settings',
);

$this->menu=array(
	array('label'=>'Create TakSetting','url'=>array('create')),
	array('label'=>'Manage TakSetting','url'=>array('admin')),
);
?>

<h1>Tak Settings</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
