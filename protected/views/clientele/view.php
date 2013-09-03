<?php
/* @var $this ClienteleController */
/* @var $model Clientele */

$this->breadcrumbs=array(
	Tk::g('Clienteles') => array('admin'),
	$model->itemid,
);
	$items = Tak::getViewMenu($model->itemid);
?>

<div class="span11">
	<div class="head clearfix">
	<div class="isw-zoom"></div>
		<h1><?php echo Tk::g('Clienteles')?></h1>
		<ul class="buttons">
		    <li class="toggle active"><a href="#"></a></li>
		</ul>
	</div>
<div class="block">
	    <div class="span8">
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'clientele_name',
		array('name'=>'rating','type'=>'raw', 'value'=>TakType::getStatus('rating',$model->rating),),
		array('name'=>'annual_revenue','type'=>'raw', 'value'=>TakType::getStatus('annual_revenue',$model->annual_revenue),),
		array('name'=>'industry','type'=>'raw', 'value'=>TakType::getStatus('industry',$model->industry),),
		array('name'=>'profession','type'=>'raw', 'value'=>TakType::getStatus('profession',$model->profession),),
		array('name'=>'origin','type'=>'raw', 'value'=>TakType::getStatus('origin',$model->origin),),
		array('name'=>'employees','type'=>'raw', 'value'=>TakType::getStatus('employees',$model->employees),),
		'email',
		'address',
		'telephone',
		'fax',
		'web',
		array('name'=>'display','type'=>'raw', 'value'=>TakType::getStatus('display',$model->display),),
		array('name'=>'last_time', 'value'=>Tak::timetodate($model->last_time),),
		array('name'=>'add_time', 'value'=>Tak::timetodate($model->add_time),),
		array('name'=>'modified_time', 'value'=>Tak::timetodate($model->modified_time),),
		'note',
	),
)); ?>
</div>
<div class="span2">
<?php 
	$this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'list',
	    'items'=> $items,
	    )
	); 
?>
</div>
<div class="clearfix"></div>
</div>
</div>