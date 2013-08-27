<?php
$this->breadcrumbs=array(
	'Tak Settings'=>array('index'),
	$model->itemid=>array('view','id'=>$model->itemid),
	'Update',
);

$this->menu=array(
	array('label'=>'List TakSetting','url'=>array('index')),
	array('label'=>'Create TakSetting','url'=>array('create')),
	array('label'=>'View TakSetting','url'=>array('view','id'=>$model->itemid)),
	array('label'=>'Manage TakSetting','url'=>array('admin')),
);
?>

<h1>Update TakSetting <?php echo $model->itemid; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>