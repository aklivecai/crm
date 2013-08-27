<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tak-setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'itemid',array('class'=>'span5','maxlength'=>25)); ?>

	<?php echo $form->textFieldRow($model,'fromid',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'item_key',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'item_value',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'add_time',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'add_us',array('class'=>'span5','maxlength'=>25)); ?>

	<?php echo $form->textFieldRow($model,'add_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'modified_time',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'modified_us',array('class'=>'span5','maxlength'=>25)); ?>

	<?php echo $form->textFieldRow($model,'modified_ip',array('class'=>'span5','maxlength'=>10)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
