<?php
$this->breadcrumbs=array(
	'Tak Settings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TakSetting','url'=>array('index')),
	array('label'=>'Manage TakSetting','url'=>array('admin')),
);
?>

<h1>Create TakSetting</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>