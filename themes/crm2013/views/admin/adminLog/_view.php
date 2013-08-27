<?php
/* @var $this AdminLogController */
/* @var $data AdminLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->itemid), array('view', 'id'=>$data->itemid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fromid')); ?>:</b>
	<?php echo CHtml::encode($data->fromid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qstring')); ?>:</b>
	<?php echo CHtml::encode($data->qstring); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
	<?php echo CHtml::encode($data->info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_time')); ?>:</b>
	<?php echo CHtml::encode($data->add_time); ?>
	<br />


</div>