<?php
/* @var $this MovingsController */
/* @var $model Movings */

$this->breadcrumbs=array(
	Tk::g($model->sName) => array('admin'),
	Tk::g('Admin'),
);
$items = Tak::getListMenu();

$subItems = array('label'=>Tk::g('Create'), 'url'=>$this->createUrl('create'),'icon'=>'plus');
$_subItems = array();

foreach ($this->cates as $key => $value) {
	$_subItems[] = array('label'=>$value, 'url'=>$this->createUrl('create',array('Movings[typeid]'=>$key)),'icon'=>'chevron-right');
}
$subItems['items'] = $_subItems;
?>
<div class="row-fluid">
	<div class="span12">

	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Tk::g($model->sName) ?></h1>   
		<?php 
		$this->widget('application.components.MyMenu',array(
		      'htmlOptions'=>array('class'=>'buttons'),
		      'items'=> $items ,
		));
		?>    
	</div>	
	<div class="block-fluid clearfix">
<?php $this->renderPartial('//_search',array('model'=>$model,'subItems' => array($subItems))); ?>
<?php 
$cates = $this->cates;
$widget = $this->widget('bootstrap.widgets.TbGridView', array(
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
		Tak::getAdminPageCol()
		,array(
			'name'=>'typeid',
			'type'=>'raw',
			'value'=>'TakType::getStatus('.$this->typename.'."-type",$data->typeid)',
			'filter'=>$cates, 
			'headerHtmlOptions'=>array('style'=>'width:100px;'),
			'header'=> $model->getAttributeLabel("typeid"),
		)
		,array(
			'name'=>'enterprise',
			'type'=>'raw',
            'filter' => false,
            'sortable' => false,
            'header'=> $model->getAttributeLabel("enterprise"),
		)	
,		'numbers'

		,array(
			'name'=>'us_launch',
			'type'=>'raw',
            'filter' => false,
            'sortable' => false,
		)	
		,array(
			'name'=>'time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->time)',
            'filter' => false,
            'sortable' => false,
            'headerHtmlOptions'=>array('class'=>'stor-date'),
            'header'=> $model->getAttributeLabel("time"),
		)	
		,array(
			'name'=>'time_stocked',
			'type'=>'raw',
			'value'=>'TakType::getStatus("isok",$data->time_stocked>0?1:0)',
            'filter' => false,
            'sortable' => true,
            'headerHtmlOptions'=>array('class'=>'stor-date'),
            'header'=> Tk::g($model->sName),
		)	
	
	),
)); 
?>
		</div>
	</div>
</div>
