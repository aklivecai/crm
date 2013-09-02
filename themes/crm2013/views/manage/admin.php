<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	Tk::g('Manages')=>array('admin')
	,Tk::g('Admin')
);

$items = array(  
    array(
      'icon' =>'isw-plus',
      'url' => array('create'),
      'label'=>Tk::g('Create'),
    )    
    ,array(
      'icon' =>'isw-edit',
      'url' => '#',
      'label'=>Tk::g('Update'),
      'linkOptions'=>array('class'=>'edit'),
    )    
    ,array(
      'icon' =>'isw-delete',
      'url' => '#',
      'label'=>Tk::g('Delete'),
      'linkOptions'=>array('class'=>'delete-select','submit'=>array('click'=>"$.fn.yiiGridView.update('menu-grid');")),
    )
    ,array(
      'icon' =>'isw-user',
      'url' => array('/rights/'),
      'label'=>'权限管理',
    )
    ,array(
      'icon' =>'isw-refresh',
      'url' => Yii::app()->request->url,
      'label'=>Tk::g('Refresh'),
      'linkOptions'=>array('class'=>'refresh'),
    )    
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>


<div class="row-fluid">
	<div class="span12">
	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1>员工信息</h1>   
<ul class="buttons">
    <li>
        <a href="#" class="isw-settings"></a>
<?php 
$this->widget('application.components.MyMenu',array(
      'htmlOptions'=>array('class'=>'dd-list'),
      'items'=> $items ,
));
?>      
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
            'ajaxUpdate'=>true,    //禁用AJAX
            'enableSorting'=>true,
            'summaryText' => '<span>总数：{count}</span>  <span>区间：{start}-{end}</span> <span>当前:{page}</span> <span>总页数：{pages}</span>',

	'filter'=>$model,
	'pager'=>array(
		'header'=>'',
		'maxButtonCount' => '5',
		'hiddenPageCssClass' => 'disabled'
		,'selectedPageCssClass' => 'active disabled'
		,'htmlOptions'=>array('class'=>'')
	),
	// 'selectableRows'=>2, 	
	'columns'=>array(
		// array('class'=>'CCheckBoxColumn','name'=>'manageid','id'=>'select'), 	

		array(
			'name' => 'user_status',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'value'=>'TakType::getStatus("status",$data->user_status)',
			'type'=>'raw',
			'filter'=>TakType::items('status'),			 
		),
		array(
			'name'=>'user_name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->user_name,array("view","id"=>$data->manageid))',
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
					,TakType::items('pageSize')
					,array( // change 'user-grid' to the actual id of your grid!! 
						'onchange'=>"$.fn.yiiGridView.update('list-grid',{data:{setPageSize: $(this).val()}})", 
					)
			  )
			  ,'htmlOptions'=>array('style'=>'width: 85px')
			  ,'template'=>'{view} {update} {vrights} {delete}'
			  ,'buttons'=>array(
					'vrights' => array
					(
						'label'=>'权限 | ',
						 'url'=>'Yii::app()->createUrl("rights/assignment/user", array("id"=>$data->manageid))',
						 'linkOptions'=>array('style'=>'width: 50px'),
					),
			  ),
		),		
	),
)); 
?>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>