<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	'员工管理'=>array('index')
	,'展示'
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
<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>
<?php echo CHtml::ajaxSubmitButton('<span class="isw-plus">xx</span>Filter',array('menu/ajaxupdate'), array(),array("style"=>"display:none;")); ?>
<?php echo CHtml::ajaxSubmitButton('Activate',array('menu/ajaxupdate','act'=>'doActive'), array('success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('In Activate',array('menu/ajaxupdate','act'=>'doInactive'), array('success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Delete',array('menu/ajaxupdate','act'=>'doDelete'), array('beforeSend'=>'function() { if(confirm("Are You Sure ...")) return true; return false; }', 'success'=>'reloadGrid')); ?>
<?php echo CHtml::ajaxSubmitButton('Update sort order',array('menu/ajaxupdate','act'=>'doSortOrder'), array('success'=>'reloadGrid')); ?>
<div class="row-fluid">
	<div class="span12">
	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1>员工信息</h1>   
<ul class="buttons">
    <li>
        <a href="#" class="isw-settings"></a>
        <ul class="dd-list">
            <li><a href="<?php echo $this->createUrl('create')?>"><span class="isw-plus"></span> 添加</a></li>
            <li><a href="#"><span class="isw-edit"></span> 修改</a></li>
            <li><a href="#"><span class="isw-delete"></span> 删除</a></li>
            <li><a href="javascript:" onClick="$.fn.yiiGridView.update('menu-grid');"><span class="isw-refresh"></span>刷新</a></li>
        </ul>
    </li>
</ul>                                    
    </div>
		<div class="block-fluid clearfix">

<?php  $widget = $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id' => 'list-grid',
	'dataProvider'=>$model->search(),

	'template'=>"{items}",

	//Ajax地址转
	'enableHistory'=>true,


    'loadingCssClass' => 'grid-view-loading',
    'summaryCssClass' => 'dataTables_info',
    'pagerCssClass' => 'pagination dataTables_paginate',
    'template' => '{pager}{summary}{items}{pager}',

           'cssFile' => Yii::app()->baseUrl . '/media/css/gridview.css',
            'ajaxUpdate'=>true,    //禁用AJAX
            'enableSorting'=>true,
            'summaryText' => '总数：{count}  区间：{start}-{end} 当前:{page} 总页码：{pages}',

	'filter'=>$model,
	'pager'=>array(
		'header'=>'',
		'hiddenPageCssClass' => 'disabled'
		,'selectedPageCssClass' => 'active disabled'
		,'htmlOptions'=>array('class'=>'')
	),
	'selectableRows'=>2, 	
	'columns'=>array(
		array('class'=>'CCheckBoxColumn','name'=>'manageid','id'=>'select'), 	

		array(
			'name' => 'user_status',
			 'htmlOptions'=>array('style'=>'width: 50px'),
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
			'name'=>'user_nicename',
			'type'=>'raw',
		),		
		array(
			'name' => 'login_count',
			'type'=>'raw',			
            'filter' => false
		),
		array(
			'name'=>'last_login_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->last_login_time)',
            'filter' => false
		),		
		array(
			 'class'=>'bootstrap.widgets.TbButtonColumn'
			  ,'header' => CHtml::dropDownList('pageSize'
					,Yii::app()->user->getState('pageSize')
					,array(20=>20,50=>50,100=>100)
					,array( // change 'user-grid' to the actual id of your grid!! 
						'onchange'=>"$.fn.yiiGridView.update('list-grid',{data:{pageSize: $(this).val()}})", 
					)
				  )
			  ,'htmlOptions'=>array('style'=>'width: 80px'),
		),		
	),
)); 

Yii::app()->clientScript->registerScript('search', "
function reloadGrid(data) {
    $.fn.yiiGridView.update('menu-grid');
}
");
?>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>