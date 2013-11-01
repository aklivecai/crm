<?php
/* @var $this ClienteleController */
/* @var $model Clientele */
/* @var $form CActiveForm */
?>
<div class="row-fluid">
<?php 

$_action = $this->getAction()->id=='recycle'?'recycle':'admin';


$items = array(
	'product' => array('label'=>'产品管理', 'url'=>Yii::app()->createUrl('product/admin')),
	'takType' => array('label'=>'分类', 'url'=>Yii::app()->createUrl('takType/admin',array('type'=>'product'))
	),
);
if ($items[$this->getId()]) {
	$items[$this->getId()]['active'] = true;
}
$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=> $items
)); ?>
</div>
