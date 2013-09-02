<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>      
<div class="container">
<div class="form-signin">
<div class="googleq-rcode">
<?php $this->widget('application.components.GoogleQRCode', array(
    'size' => 120,
    'content' => Yii::app()->request->hostInfo.Yii::app()->request->getUrl(),
    'htmlOptions' => array('alt'=> '手机登录','title' => '手机登录')
));
?>
</div>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>

<?php echo $form->dropDownListRow($model, 'fromid',$listType); ?>

<?php echo $form->textFieldRow($model, 'username', array('class'=>'span3','autofocus'=>'autofocus')); ?>
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
<?php echo $form->checkboxRow($model, 'rememberMe'); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'登录')); ?> 


<?php $this->endWidget(); ?>
</div>
</div>