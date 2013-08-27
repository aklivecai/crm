<?php
/* @var $this ClienteleController */
/* @var $model Clientele */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clientele-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'itemid'); ?>
		<?php echo $form->textField($model,'itemid'); ?>
		<?php echo $form->error($model,'itemid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fromid'); ?>
		<?php echo $form->textField($model,'fromid'); ?>
		<?php echo $form->error($model,'fromid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'manageid'); ?>
		<?php echo $form->textField($model,'manageid'); ?>
		<?php echo $form->error($model,'manageid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'annual_revenue'); ?>
		<?php echo $form->textField($model,'annual_revenue'); ?>
		<?php echo $form->error($model,'annual_revenue'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'industry'); ?>
		<?php echo $form->textField($model,'industry',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'industry'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'profession'); ?>
		<?php echo $form->textField($model,'profession',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'profession'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origin'); ?>
		<?php echo $form->textField($model,'origin',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'origin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'employees'); ?>
		<?php echo $form->textField($model,'employees'); ?>
		<?php echo $form->error($model,'employees'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accountname'); ?>
		<?php echo $form->textField($model,'accountname',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'accountname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'web'); ?>
		<?php echo $form->textField($model,'web',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'visibility'); ?>
		<?php echo $form->textField($model,'visibility',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'visibility'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_time'); ?>
		<?php echo $form->textField($model,'add_time',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'add_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_us'); ?>
		<?php echo $form->textField($model,'add_us'); ?>
		<?php echo $form->error($model,'add_us'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_ip'); ?>
		<?php echo $form->textField($model,'add_ip'); ?>
		<?php echo $form->error($model,'add_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_time'); ?>
		<?php echo $form->textField($model,'modified_time',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'modified_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_us'); ?>
		<?php echo $form->textField($model,'modified_us'); ?>
		<?php echo $form->error($model,'modified_us'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_ip'); ?>
		<?php echo $form->textField($model,'modified_ip'); ?>
		<?php echo $form->error($model,'modified_ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->