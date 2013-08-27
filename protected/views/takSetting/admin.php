<?php
$this->breadcrumbs=array(
	'Tak Settings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TakSetting','url'=>array('index')),
	array('label'=>'Create TakSetting','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tak-setting-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tak Settings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tak-setting-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'itemid',
		'fromid',
		'item_key',
		'item_value',
		'add_time',
		'add_us',
		/*
		'add_ip',
		'modified_time',
		'modified_us',
		'modified_ip',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
