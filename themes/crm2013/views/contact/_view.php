<?php
/* @var $this ContactController */
/* @var $data Contact */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->itemid), array('view', 'id'=>$data->itemid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fromid')); ?>:</b>
	<?php echo CHtml::encode($data->fromid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manageid')); ?>:</b>
	<?php echo CHtml::encode($data->manageid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clienteleid')); ?>:</b>
	<?php echo CHtml::encode($data->clienteleid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prsonid')); ?>:</b>
	<?php echo CHtml::encode($data->prsonid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stage')); ?>:</b>
	<?php echo CHtml::encode($data->stage); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_time')); ?>:</b>
	<?php echo CHtml::encode($data->contact_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_contact_time')); ?>:</b>
	<?php echo CHtml::encode($data->next_contact_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('next_subject')); ?>:</b>
	<?php echo CHtml::encode($data->next_subject); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accessory')); ?>:</b>
	<?php echo CHtml::encode($data->accessory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_time')); ?>:</b>
	<?php echo CHtml::encode($data->add_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_us')); ?>:</b>
	<?php echo CHtml::encode($data->add_us); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_ip')); ?>:</b>
	<?php echo CHtml::encode($data->add_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_time')); ?>:</b>
	<?php echo CHtml::encode($data->modified_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_us')); ?>:</b>
	<?php echo CHtml::encode($data->modified_us); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modified_ip')); ?>:</b>
	<?php echo CHtml::encode($data->modified_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>