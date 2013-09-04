<?php
/* @var $this AddressGroupsController */
/* @var $model AddressGroups */
/* @var $form bootstrap.widgets.TbActiveForm */
?>
<?php  $action = $model->isNewRecord?'Create':'Update';
 $items = Tak::getEditMenu($model->address_groups_id,$model->isNewRecord);
?>
<div class="row-fluid">
<div class="span12">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'address-groups-form',
	 'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="head clearfix">
	<i class="isw-documents"></i><h1><?php echo Tk::g(array('AddressGroups',$action));?></h1>
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
		<?php echo $form->textFieldRow($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix">
		<?php echo $form->radioButtonListRow($model,'display',Taktype::items('display'),array('class'=>'','template'=>'<label class="checkbox inline">{input}{label}</label>')); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textAreaRow($model,'note',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'listorder',array('size'=>60,'maxlength'=>255)); ?>
	</div>


</div>

<div class="footer tar">
    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'submit', 'label'=>Tk::g($action))); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'reset', 'label'=>Tk::g('Reset'))); ?>
    
</div>

<?php $this->endWidget(); ?>
</div>
</div>