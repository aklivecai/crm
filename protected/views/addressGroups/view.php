<?php
/* @var $this AddressGroupsController */
/* @var $model AddressGroups */

$this->breadcrumbs=array(
	Tk::g('Address Groups') => array('admin'),
	$model->name,
);
	$items = Tak::getViewMenu($model->address_groups_id);

 $items[] = array(
	  'icon' =>'fire',
	  'url' => array('addressBook/create','groups_id'=>$model->address_groups_id),
	  'label'=>Tk::g(array('Create','Address Book')),
	);
?>

<div class="block-fluid">
	<div class="row-fluid">
	    <div class="span10">
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		array('name'=>'display','type'=>'raw', 'value'=>TakType::getStatus('display',$model->display),),
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