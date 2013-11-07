<?php
$this->pageTitle=Yii::app()->name . ' - 提示';
$this->breadcrumbs=array(
  '提示',
);
?>
<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
    'heading'=>'提示',
)); ?>
 <p>
    <br />
    <?php echo  Yii::app()->user->getFlash('info');?></p> 
<?php $this->endWidget(); ?>