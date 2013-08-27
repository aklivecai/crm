<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	'员工管理'=>array('index')
);

$this->menu=array(
	array('label'=>'List Manage', 'url'=>array('index')),
	array('label'=>'Create Manage', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#manage-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
    'pager' => array(
        'maxButtonCount' => '7',
    ),
    'template' => '{pager}{summary}{items}{pager}',
	'filter'=>$model,
	'columns'=>array( 	
		array( 
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'type'=>'raw',
		'header'=>CHtml::dropDownList('pageSize',$pageSize,array(20=>20,50=>50,100=>100),array( 
		// change 'user-grid' to the actual id of your grid!! 
		'onchange'=>"$.fn.yiiGridView.update('user-grid',{ data:{pageSize: $(this).val() }})", 
		)), 
		),		
		array(
			'name'=>'user_name',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->user_name), "")'
		),		
		array(
			'name'=>'user_email',
			'type'=>'raw',
			'value'=>'CHtml::mailto($data->user_email)'
		),		
		array(
			'name'=>'last_login_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->last_login_time)'
		),		
		'last_login_ip',
		'login_count',
		'user_status',
		array(
			 'class'=>'bootstrap.widgets.TbButtonColumn',
			  'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
