<?php
/* @var $this EventsController */
/* @var $model Events */

$this->breadcrumbs=array(
	Tk::g('Events')=>array('admin'),
	Tk::g('Admin'),
);
$items = Tak::getListMenu();
?>
<div class="row-fluid">
	<div class="span12">

	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Tk::g('Events')?></h1>   
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
<?php $this->renderPartial('//_search',array('model'=>$model,)); ?>
<?php $widget = $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id' => 'list-grid',
	'dataProvider'=>$model->search(),
	'template'=>"{items}",
	'enableHistory'=>true,
    'loadingCssClass' => 'grid-view-loading',
    'summaryCssClass' => 'dataTables_info',
    'pagerCssClass' => 'pagination dataTables_paginate',
    'template' => '{pager}{summary}<div class="dr"><span></span></div>{items}{pager}',
    'ajaxUpdate'=>true,    //禁用AJAX
    'enableSorting'=>true,
    'summaryText' => '<span>共{pages}页</span> <span>当前:{page}页</span> <span>总数:{count}</span> ',
	'filter'=>$model,
	'pager'=>array(
		'header'=>'',
		'maxButtonCount' => '5',
		'hiddenPageCssClass' => 'disabled'
		,'selectedPageCssClass' => 'active disabled'
		,'htmlOptions'=>array('class'=>'')
	),
	'columns'=>array(
/*
		array(
			'name'=>'user_name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->user_name,array("view","id"=>$data->itemid))',
		),	
*/		

		array(
			'name' => 'display',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'value'=>'TakType::getStatus("display",$data->display)',
			'type'=>'raw',
			'filter'=>TakType::items('display'), 
		)
	,		'subject'
,		'email'
,		'start_time'
,		'end_time'
,		'color'
,		'text_color'
,		/*
,		'location'
,		'url'
,		'type'
,		'priority'
,		'event_status'
,		'add_time'
,		'note'
,		*/
		array(
			 'class'=>'bootstrap.widgets.TbButtonColumn'
			  ,'header' => CHtml::dropDownList('pageSize'
					,Yii::app()->user->getState('pageSize')
					,TakType::items('pageSize')
					,array(
						'onchange'=>"$.fn.yiiGridView.update('list-grid',{data:{setPageSize: $(this).val()}})", 
					)
			  )
			  ,'htmlOptions'=>array('style'=>'width: 85px')
		),		
	),
)); 
?>
		</div>
	</div>
</div>
