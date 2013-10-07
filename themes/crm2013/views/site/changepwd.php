<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs = array(
	'修改密码',
);


$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php 
    echo $form->errorSummary($model); 
?>
<div>
<?php echo $form->passwordFieldRow($model, 'oldPasswd'); ?>
</div>
<div>
<?php echo $form->passwordFieldRow($model, 'passwd'); ?>
</div><div>
<?php echo $form->passwordFieldRow($model, 'passwdConfirm'); ?>
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'修改')); ?> 


<?php $this->endWidget(); ?>