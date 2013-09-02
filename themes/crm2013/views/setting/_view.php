<?php
/* @var $this SettingController */
/* @var $data Setting */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->itemid), array('view', 'id'=>$data->itemid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manageid')); ?>:</b>
	<?php echo CHtml::encode($data->manageid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_key')); ?>:</b>
	<?php echo CHtml::encode($data->item_key); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_value')); ?>:</b>
	<?php echo CHtml::encode($data->item_value); ?>
	<br />


</div>