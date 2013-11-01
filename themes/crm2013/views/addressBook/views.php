<?php
/* @var $this AddressBookController */
/* @var $model AddressBook */

$this->breadcrumbs=array(
	Tk::g('Address Books') => array('index'),
	$model->name,
);
?>

<div class="block-fluid">
	<div class="row-fluid">
<?php $this->renderPartial('_view',array(
    'data'=>$model,
)); ?>

</div>
</div>