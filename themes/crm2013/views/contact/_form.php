<?php
/* @var $this ContactController */
/* @var $model Contact */
/* @var $form bootstrap.widgets.TbActiveForm */
?>
<?php  $action = $model->isNewRecord?'Create':'Update';
 $items = Tak::getEditMenu($model->itemid,$model->isNewRecord);
?>
<div class="row-fluid">
<div class="span12">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contact-form',
	 'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="head clearfix">
	<i class="isw-documents"></i><h1><?php echo Tk::g(array('Contact',$action));?></h1>
	<ul class="buttons">
	    <li>
	        <a href="#" class="isw-settings"></a>
<?php			$this->widget('application.components.MyMenu',array(
	          'htmlOptions'=>array('class'=>'dd-list'),
	          'items'=> $items ,
	    	));
		?>
	    </li>
	</ul>       
</div>
<div class="block-fluid">
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'clienteleid',array('class'=>'sele1ct-clientele','size'=>10,'maxlength'=>10,'style'=>'width:100%')); ?>
	</div>
	<div class="row-form clearfix">
		<?php echo $form->dropDownListRow($model,'prsonid',ContactpPrson::model()->getList()); ?>
	</div>		

		<div class="row-form clearfix">
		<?php echo $form->dropDownListRow($model,'type',TakType::items('contact-type')); ?>
	</div>
		<div class="row-form clearfix">
		<?php echo $form->dropDownListRow($model,'stage',TakType::items('contact-stage')); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'contact_time',array('size'=>10,'maxlength'=>10,'class'=>'type-date')); ?>
	</div>

	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'next_contact_time',array('size'=>10,'maxlength'=>10,'class'=>'type-date')); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'next_subject',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'accessory',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textAreaRow($model,'note',array('size'=>60,'maxlength'=>255)); ?>
	</div>

</div>

<div class="footer tar">
    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'submit', 'label'=>Tk::g($action))); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'reset', 'label'=>Tk::g('Reset'))); ?>
    
</div>

<?php $this->endWidget(); ?>
</div>
</div>