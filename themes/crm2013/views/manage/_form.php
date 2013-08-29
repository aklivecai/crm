<?php
/* @var $this ManageController */
/* @var $model Manage */
/* @var $form CActiveForm */
?>
<div class="page-header">
	<h1>员工 <small>信息</small></h1>
</div>
<div class="row-fluid">
<div class="span12">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'enableAjaxValidation'=>true,
)); 
?>
<?php echo $form->errorSummary($model); ?>

<div class="head clearfix">
	<i class="isw-documents"></i> <h1>操作</h1>
</div>
<div class="block-fluid">
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <?php echo $form->textFieldRow($model, 'user_name', array('class'=>'span9','size'=>60,'maxlength'=>60)); ?>
	</div>
	<div class="row-form clearfix">
    <?php echo $form->passwordFieldRow($model, 'user_pass', array('size'=>60,'maxlength'=>64)); ?>
</div><div class="row-form clearfix">
    <?php echo $form->textFieldRow($model, 'user_nicename', array('size'=>60,'maxlength'=>64)); ?>
</div><div class="row-form clearfix">
    <?php echo $form->textFieldRow($model, 'user_email', array('size'=>60,'maxlength'=>100)); ?>
</div><div class="row-form clearfix">
    <?php echo $form->textFieldRow($model, 'user_status', array('size'=>11,'maxlength'=>11)); ?>
</div><div class="row-form clearfix">
	<?php echo $form->textAreaRow($model, 'note', array('maxlength'=>255)); ?>
	</div>

 
<div class="footer tar">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>$model->isNewRecord ? Tk::g('Add') : Tk::g('Save'))); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'重置')); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'danger', 'label'=>Tk::g('Return'),'htmlOptions'=>array('href'=>Yii::app()->request->urlReferrer))); ?>
</div>
 
<?php $this->endWidget(); ?>
</div>
</div>
</div>