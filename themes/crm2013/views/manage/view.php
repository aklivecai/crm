<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	Tk::g('Manages')=>array('index'),
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
		'fromid',
		'manageid',
		'user_name',
		'user_pass',
		'salt',
		'user_nicename',
		'user_email',
		'add_time',
		'add_ip',
		'last_login_time',
		'last_login_ip',
		'login_count',
		'user_status',
		'note',
		'activkey',
		'active_time',
	),
)); ?>
</div>
<div class="span2">
<?php 
 $items = array(
	array('label'=>Tk::g('View'), 'icon'=>'eye-open', 'url'=>'#', 'active'=>true),
	array('label'=>Tk::g('View'), 'icon'=>'eye-open'),
	array('label'=>Tk::g('Admin'), 'icon'=>'th','url'=>array('admin')),
	array('label'=>Tk::g('Update'), 'icon'=>'pencil','url'=>array('update', 'id'=>$model->manageid)),
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