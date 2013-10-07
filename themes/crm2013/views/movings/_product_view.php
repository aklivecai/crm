<?php
/* @var $this MovingsController */
/* @var $data Movings */
?>

<tr data-preview='<?php echo $data->iProduct->getLink(false,'preview'); ?>'>
	<td><?php echo $data->iProduct->name; ?></td>
	<td><?php echo CHtml::encode($data->iProduct->material); ?></td>
	<td><?php echo CHtml::encode($data->iProduct->spec); ?></td>
	<td class="txt-center"><?php echo CHtml::encode($data->iProduct->unit); ?></td>
	<td class="txt-right"><?php echo CHtml::encode($data->numbers); ?></td>
	<td><?php echo CHtml::encode($data->note); ?></td>
</tr>
