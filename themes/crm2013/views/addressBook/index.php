<?php
/* @var $this AddressBookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Tk::g('Address Books'),
);
?>
<div class="row-fluid">
	<div class="span12">

	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php echo Tk::g('AddressBook')?></h1>                              
	</div>	
<div class="block-fluid clearfix">
<?php //$this->renderPartial('_search',array('model'=>$model,)); ?>
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
	),
	'columns'=>array(
		Tak::getAdminPageCol(array(
			'template'=>'{preview}','buttons'=>array(
				'preview' => array(
                        'label'=>'',
                         'url'=>'Yii::app()->controller->createUrl("views", array("id"=>$data->primaryKey))',
                         'options'=>array('title'=>'浏览','class'=>'icon-eye-open'),
                        )
			)
		))
		,array(
			'name'=>'name',
			'type'=>'raw',
		)
		,array(
			'name'=>'phone',
			'type'=>'raw',
            'sortable' => false,
		)
		,array(
			'name'=>'email',
			'type'=>'email',
            'sortable' => false,
		)
		,array(
			'name'=>'address',
			'type'=>'raw',
             'filter' => false,
            'sortable' => false,
		)
		,array(
			'name'=>'position',
			'type'=>'raw',
             'filter' => false,
            'sortable' => false,
		)
		,array(
			'name' => 'groups_id',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'type'=>'raw',
			'value'=>'TakType::item("AddressGroups",$data->groups_id)',
			'filter'=>TakType::items('AddressGroups'), 
		)	
		,array(
			'name' => 'display',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'value'=>'TakType::getStatus("display",$data->display)',
			'type'=>'raw',
			'filter'=>TakType::items('display'), 
		)
	),
)); 
?>
		</div>
	</div>
</div>