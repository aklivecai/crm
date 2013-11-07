<?php
/* @var $this StocksController */
/* @var $model Stocks */

$this->breadcrumbs=array(
	Tk::g($model->sName) => array('admin'),
	Tk::g('Detail'),
);
$items = Tak::getListMenu();
?>
<div class="row-fluid">
	<div class="span12">

	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Tk::g(array($model->sName,'Detail'))?></h1>                                  
	</div>	

	<div class="block-fluid clearfix">
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
	'pager'=>array(
		'header'=>'',
		'maxButtonCount' => '5',
		'hiddenPageCssClass' => 'disabled'
		,'selectedPageCssClass' => 'active disabled'
		,'htmlOptions'=>array('class'=>'')
	),
	'columns'=>array(
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
			  ,'template'=>'{detail}'
			  ,'buttons'=>array(
                    'detail' => array
                    (
                        'label'=>'',
                         'url'=>'$data->getLink()',
                         'options'=>array('title'=>'查看详细','class'=>'icon-eye-open'),
                    ),
               ),
		)
,		array(
			'name'=>'product_id',
			'type'=>'raw',
			'value'=>'$data->iProduct->name',
		)	
,		array(
			'name'=>'stocks',
			'type'=>'raw',
		)
,		array(
			'name'=>'iProduct.material',
			'type'=>'raw',
			'value'=>'$data->iProduct->material',
		)	

,		array(
			'name'=>'iProduct.spec',
			'type'=>'raw',
			'value'=>'$data->iProduct->spec',
		)		
,		array(
			'header'=>'最后变更',
			'name'=>'modified_time',
			'value'=>'Tak::timetodate($data->modified_time,4)',
            'htmlOptions'=>array('style'=>'width: 85px')
		)
),
)); 
?>
		</div>
	</div>
</div>
