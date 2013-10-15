<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	Tk::g($model->sName) => array('admin'),
	Tk::g('Admin'),
);
$items = Tak::getListMenu();
?>
<div class="row-fluid">
	<div class="span12">

	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Tk::g($model->sName)?></h1>   
		<?php 
		$this->widget('application.components.MyMenu',array(
		      'htmlOptions'=>array('class'=>'buttons'),
		      'items'=> $items ,
		));
		?>                                    
	</div>	

	<div class="block-fluid clearfix">

<?php 
	$this->renderPartial("type",array('model'=>$model,));
?>


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
		Tak::getAdminPageCol()
		,'name'
		,array(
			'name'=>'typeid',
			'type'=>'raw',
			'value'=>'$data->iType->typename',
			'filter'=>TakType::items('product',true), 
		)

		,array(
			'name'=>'material',
			'type'=>'raw',
			'filter'=>false, 
		)
		,array(
			'name'=>'spec',
			'type'=>'raw',
			'filter'=>false, 
		)
		// ,array(
		// 	'name'=>'unit',
		// 	'type'=>'raw',
		// 	'filter'=>false, 
		// )
		,array(
			'name'=>'note',
			'type'=>'raw',
			'filter'=>false, 
			'value' =>'mb_substr(htmlspecialchars_decode($data->note),0,30,"utf-8")',
			'htmlOptions'=>array('style'=>'width:220px;'),
		)	
	),
)); 
?>
		</div>
	</div>
</div>
