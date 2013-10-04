<?php
/* @var $this MovingsController */
/* @var $model Movings */
/* @var $form bootstrap.widgets.TbActiveForm */
?>
<?php  $action = $model->isNewRecord?'Create':'Update';
 $items = Tak::getEditMenu($model->itemid,$model->isNewRecord);
?>
<div class="row-fluid">
<div class="span12">

<?php $form=$this->beginWidget('CActiveForm',array(
	'id'=>'movings-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->hiddenField($model,'typeid'); ?>

$form->errorSummary($model)
<div class="head clearfix">
	<i class="isw-documents"></i><h1><?php echo Tk::g(array($action,'-',$model->sName,$this->cates[$model->typeid]));?></h1>
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
	<div class="span12">
		<div class="span5">
		<?php 
		 echo $form->field($model,'numbers',array('size'=>60,'maxlength'=>100))->textInput();
		?>	
		<?php echo $form->textFieldRow($model,'time',array('size'=>10,'maxlength'=>10)); ?>	
		<?php echo $form->textFieldRow($model,'typeid',array('size'=>10,'maxlength'=>10)); ?>	
		<?php echo $form->textFieldRow($model,'enterprise',array('size'=>60,'maxlength'=>100)); ?>	
		<?php echo $form->textFieldRow($model,'us_launch',array('size'=>10,'maxlength'=>10)); ?>	
		<?php echo $form->textFieldRow($model,'time_stocked',array('size'=>10,'maxlength'=>10)); ?>	
		<?php echo $form->textAreaRow($model,'note',array('size'=>60,'maxlength'=>255)); ?>			
		
		</div>
		<div class="span7">
			sads

		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="footer tar">
    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'submit', 'label'=>Tk::g($action))); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'reset', 'label'=>Tk::g('Reset'))); ?>
    
</div>

<?php $this->endWidget(); ?>
</div>
</div>