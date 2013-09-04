<?php
/* @var $this AddressBookController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Address Books',
);

$this->menu=array(
	array('label'=>'Create AddressBook', 'url'=>array('create')),
	array('label'=>'Manage AddressBook', 'url'=>array('admin')),
);
?>

<h1>Address Books</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
