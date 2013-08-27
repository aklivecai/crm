<?php
/* @var $this ClienteleController */
/* @var $data Clientele */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('annual_revenue')); ?>:</b>
	<?php echo CHtml::encode($data->annual_revenue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('industry')); ?>:</b>
	<?php echo CHtml::encode($data->industry); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('profession')); ?>:</b>
	<?php echo CHtml::encode($data->profession); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('origin')); ?>:</b>
	<?php echo CHtml::encode($data->origin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employees')); ?>:</b>
	<?php echo CHtml::encode($data->employees); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accountname')); ?>:</b>
	<?php echo CHtml::encode($data->accountname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web')); ?>:</b>
	<?php echo CHtml::encode($data->web); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visibility')); ?>:</b>
	<?php echo CHtml::encode($data->visibility); ?>
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

	*/ ?>

</div>