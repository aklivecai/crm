<?php
/* @var $this AdminLogController */
/* @var $data AdminLog */
?>

<div class="view">
<ul>
	<li><?php echo CHtml::encode($data->getAttributeLabel('itemid')); ?>:
	<?php echo CHtml::link(CHtml::encode($data->itemid), array('view', 'id'=>$data->itemid)); ?>
	</li>
	<li><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:
	<?php echo CHtml::encode($data->user_name); ?></li>

	<li><?php echo CHtml::encode($data->getAttributeLabel('qstring')); ?>:
	<?php echo CHtml::encode($data->qstring); ?></li>

	<li><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:
	<?php echo CHtml::encode($data->info); ?></li>
	<li><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:
	<?php echo CHtml::encode($data->ip); ?></li>
	<li><?php echo CHtml::encode($data->getAttributeLabel('add_time')); ?>:
	<?php echo  Tak::timetodate($data->add_time); ?></li>
	</ul>
</div>