<?php
/* @var $this MovingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Movings',
);

$this->menu=array(
	array('label'=>'Create Movings', 'url'=>array('create')),
	array('label'=>'Manage Movings', 'url'=>array('admin')),
);
?>

<h1>Movings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
