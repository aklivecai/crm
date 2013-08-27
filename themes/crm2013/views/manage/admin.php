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
<div class="row-fluid">
	<div class="span12">
	<div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>员工信息</h1>                               
                        </div>
		<div class="block-fluid clearfix">
		
<?php  $widget = $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'',

	'dataProvider'=>$model->search(),

	 'template'=>"{items}",
    'summaryCssClass' => 'SS',
    'pagerCssClass' => 'SS',
    'template' => '{pager}{summary}{items}{pager}',

           'cssFile' => Yii::app()->baseUrl . '/media/css/gridview.css',
 
            'ajaxUpdate'=>false,    //禁用AJAX
              'enableSorting'=>true,
              'summaryText' => '{count} records(s) found.',


	'filter'=>$model,
	'pager'=>array(

	),
	'selectableRows'=>2, 	
	'columns'=>array(
		array('class'=>'CCheckBoxColumn','name'=>'manageid','id'=>'select'), 	
		array(
			 'class'=>'bootstrap.widgets.TbButtonColumn',
			  'header' => '操作',
			  'htmlOptions'=>array('style'=>'width: 80px'),
		),
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
		),
		array(
			'name'=>'last_login_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->last_login_time)',

            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'last_login_time', 
                'htmlOptions' => array(
                    'id' => 'datepicker_for_last_login_time',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy/mm/dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true), // (#4)			
		),		
		array(
			'name'=>'active_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->active_time)'
		),
	),
)); ?>
               <div id="pagination">
                    <?php $widget->renderPager(); ?>
                </div>
		</div>
	</div>
</div>