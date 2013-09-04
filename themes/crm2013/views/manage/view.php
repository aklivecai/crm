<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	Tk::g('Manages')=>array('admin'),
	$model->manageid,
);

$this->menu=array(
	array('label'=>'List Manage', 'url'=>array('index')),
	array('label'=>'Create Manage', 'url'=>array('create')),
	array('label'=>'Update Manage', ),
	array('label'=>'Delete Manage', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->manageid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Manage', 'url'=>array('admin')),
);

?>
<div class="block-fluid">
               <div class="row-fluid">
                    <div class="span10">
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_name',
		'user_nicename',
		'user_email',
		array('name'=>'add_time', 'value'=>Tak::timetodate($model->add_time,6),),
		array('name'=>'add_ip', 'value'=>Tak::Num2IP($model->add_ip),),
		array('name'=>'last_login_time', 'value'=>Tak::timetodate($model->last_login_time,6),),
		array('name'=>'last_login_ip', 'value'=>Tak::Num2IP($model->last_login_ip),),
		'login_count',
		array('name'=>'user_status','type'=>'raw' ,'value'=>TakType::getStatus("status",$model->user_status)),

		'note',
		array('name'=>'active_time', 'value'=>Tak::timetodate($model->active_time,6),),
	),
)); ?>
</div>
<div class="span2">
<?php 
 $items = array(
	array('label'=>Tk::g('Action'), 'icon'=>'fire', 'url'=>'', 'active'=>true),
	array('label'=>Tk::g('View'), 'icon'=>'eye-open'),
	array('label'=>Tk::g('Admin'), 'icon'=>'th','url'=>array('admin')),
	array('label'=>Tk::g('Create'), 'icon'=>'pencil','url'=>array('create')),
	array('label'=>'权限', 'icon'=>'user','url'=>array('rights/assignment/user','id'=>$model->manageid)),
	array('label'=>Tk::g('Update'), 'icon'=>'edit','url'=>array('update', 'id'=>$model->manageid)),
	array('label'=>Tk::g('Delete'), 'icon'=>'trash','url'=>array('delete', 'id'=>$model->manageid),'linkOptions'=>array('class'=>'delete')),
	array('label'=>'列表', 'url'=>'#', 'icon'=>'eye-open','items'=>array(
	    array('label'=>'上一个', 'url'=>'#'),
	    array('label'=>'下一个', 'url'=>'#'),
	    '---',
	    array('label'=>'其他'),
	    array('label'=>'1', 'url'=>'#'),
	    array('label'=>'2', 'url'=>'#'),
	    array('label'=>'3', 'url'=>'#'),
	    array('label'=>'4', 'url'=>'#'),
		)
	)
);
$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'list',
    'items'=> $items,
    )
); 
?>
</div>
</div>
</div>