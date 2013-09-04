<?php
/* @var $this ContactController */
/* @var $model Contact */

$this->breadcrumbs=array(
	Tk::g('Contacts') => array('admin'),
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
		'iClientele.clientele_name',
		'iContactpPrson.nicename',
		array('name'=>'type','type'=>'raw', 'value'=>TakType::getStatus('contact-type',$model->type),),
		array('name'=>'stage','type'=>'raw', 'value'=>TakType::getStatus('contact-stage',$model->stage),),
		array('name'=>'contact_time', 'value'=>Tak::timetodate($model->contact_time),),
		array('name'=>'next_contact_time', 'value'=>Tak::timetodate($model->next_contact_time),),
		'next_subject',
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