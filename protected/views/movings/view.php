<?php
/* @var $this MovingsController */
/* @var $model Movings */

$this->breadcrumbs=array(
	Tk::g($model->sName) => array('admin'),
	$model->itemid,
);
	$items = Tak::getViewMenu($model->itemid);
?>

<div class="block-fluid">
	<div class="row-fluid">
	    <div class="span10">
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type',
		'numbers',
		'time',
		'typeid',
		'enterprise',
		'us_launch',
		'time_stocked',
		array('name'=>'add_time', 'value'=>Tak::timetodate($model->add_time),),
		'modified',
		'note',
		array('name'=>'status','type'=>'raw', 'value'=>TakType::getStatus('status',$model->status),),
	),
)); ?>
</div>
<div class="span2">
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=> $items,
    )
); 
?>
</div>
</div>
</div>