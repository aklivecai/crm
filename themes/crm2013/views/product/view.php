<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	Tk::g($model->sName) => array('admin'),
	$model->name,
);
	$items = Tak::getViewMenu($model->itemid);
?>

<div class="block-fluid">
	<div class="row-fluid">
	    <div class="span10">
		<?php $this->renderPartial('_view',array('model'=>$model,)); ?>
		</div>
		<div class="span2">
		<?php $this->widget('bootstrap.widgets.TbMenu', array(
		    'type'=>'list',
		    'items'=> $items,
		    )
		); 
		?>
		</div>
</div>
</div>