<?php
$this->pageTitle=Yii::app()->name . '登录';
$this->breadcrumbs=array(
	'登录',
);
?>
 <?php 
        $sql = "SELECT * FROM {{admin_log}} ";
        $criteria=new CDbCriteria();
        $result = Yii::app()->db->createCommand($sql)->query();
        $pages=new CPagination($result->rowCount);
        $pages->pageSize = 10; 
        $pages->applyLimit($criteria); 
        $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit"); 
        $result->bindValue(':offset', $pages->currentPage*$pages->pageSize); 
        $result->bindValue(':limit', $pages->pageSize); 
        $posts=$result->query();

    	//分页widget代码: 
    	$this->widget('CLinkPager',array('pages'=>$pages,'maxButtonCount'=>5));
 ?>	
 <?php foreach($posts as $row):?> 
 <?php echo CHtml::link($row["qstring"],array('delivery/view','itemid'=>$row["itemid"]));?> 
 <?php echo $row["info"]."<br />" ?>
 <?php endforeach;?>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>
<?php echo $form->hiddenField($model,'fromid'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('autofocus'=>"true")); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row submit">
		<?php echo CHtml::submitButton('登录'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
