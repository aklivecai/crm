<?php
/* @var $this ClienteleController */
/* @var $model Clientele */
/* @var $form CActiveForm */
?>
<div class="row-fluid">
<?php 

$types = TakType::items('product',true);
$_types = array();
$_action = $this->getAction()->id=='recycle'?'recycle':'admin';
if (count($types)>0) {
foreach ($types as $key => $value) {
	$_types[] = array('label'=>$value, 'url'=>Yii::app()->createUrl('product/'.$_action,array('Product[typeid]'=>$key)),'icon'=>'eye-open');
}
$_types[] = array('label'=>'分类管理', 'url'=>Yii::app()->createUrl('takType/admin',array('type'=>'product')),'icon'=>'th');
}

$items = array(
	'product' => array('label'=>'产品管理', 'url'=>Yii::app()->createUrl('product/admin')),
	'takType' => array('label'=>'分类', 'url'=>Yii::app()->createUrl('takType/admin',array('type'=>'product'))
		,'items'=>$_types
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
