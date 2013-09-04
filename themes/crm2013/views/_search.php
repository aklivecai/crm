<?php
/* @var $this ClienteleController */
/* @var $model Clientele */
/* @var $form CActiveForm */
?>
<div class="row-fluid">

<?php 
$sdata = Tak::searchData();

$items = array(
	array('label'=>'全部', 'url'=>Yii::app()->createUrl($this->route))
);

$isactive = isset($_GET['col'])&&isset($_GET['dt'])?$_GET['dt']:false;

foreach ($sdata as $key => $value) {
	$items[$key] =  array('label'=>$value['name'], 'url'=>$url = Yii::app()->createUrl($this->route,array('col'=>'add_time','dt'=>$key)));
	$isactive&&$isactive==$key&&isset($sdata[$isactive])&&$items[$key]['active']=true;
}
$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=> $items
)); ?>
</div>
