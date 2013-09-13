<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	Tk::g('Events') => array('admin'),
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
		'subject',
		'email',
		array('name'=>'start_time', 'value'=>Tak::timetodate($model->start_time),),
		array('name'=>'end_time', 'value'=>Tak::timetodate($model->end_time),),
		'color',
		'text_color',
		'location',
		'url',
		'type',
		'priority',
		'event_status',
		array('name'=>'display','type'=>'raw', 'value'=>TakType::getStatus('display',$model->display),),
		array('name'=>'status','type'=>'raw', 'value'=>TakType::getStatus('status',$model->status),),
		array('name'=>'add_time', 'value'=>Tak::timetodate($model->add_time),),
		array('name'=>'modified_time', 'value'=>Tak::timetodate($model->modified_time),),
		'note',
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