<?php
/* @var $this ContactpPrsonController */
/* @var $model ContactpPrson */

$this->breadcrumbs=array(
	Tk::g('Contactp Prsons')=>array('admin'),
	Tk::g('Admin'),
);
$items = Tak::getListMenu();
?>
<div class="row-fluid">
	<div class="span12">

	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Tk::g('ContactpPrson')?></h1>   
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
		Tak::getAdminPageCol(),
		array(
			'name'=>'nicename',
			'type'=>'raw',
			'htmlOptions'=>array('style'=>'width: 120px'),
		)
		,array(
			'name'=>'iClientele.clientele_name',
			'header'=>'客户',
			'type'=>'raw',
			'value'=>'$data->iClientele->clientele_name',
		)
		,array(
			'name'=>'phone',
			'type'=>'raw',
            'filter' => false,
            'sortable' => false,
		)
		,array(
			'name'=>'mobile',
			'type'=>'raw',
            'filter' => true,
            'sortable' => false,
		)
		,array(
			'name'=>'email',
			'type'=>'email',
            'filter' => false,
            'sortable' => false,
		)
		,array(
			'name'=>'qq',
			'type'=>'raw',
            'sortable' => false,
            'filter' => false,
		)
		,array(
			'name'=>'address',
			'type'=>'raw',
            'filter' => false,
            'sortable' => false,
		)
		,array(
			'header'=>'最后联系',
			'name'=>'last_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->last_time,4)',
            'filter' => false
		)	
		,array(
			'name' => 'sex',
			'htmlOptions'=>array('style'=>'width: 40px'),
			'value'=>'TakType::getStatus("sex",$data->sex)',
			'type'=>'raw',
			'filter'=>false,
            'sortable' => false,
		)
	),
)); 
?>
		</div>
	</div>
</div>
