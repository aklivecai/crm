<?php
/* @var $this MovingsController */
/* @var $model Movings */
/* @var $form bootstrap.widgets.TbActiveForm */
?>
<?php  $action = $model->isNewRecord?'Entering':'Update';

$items = Tak::getEditMenu($model->itemid,$model->isNewRecord);

$strProducts =  false;
$products = $_POST['Product'];


if (!$products&&$model->itemid>0) {
  $products = ProductMoving::getListByMovingid($model->itemid);
}

if ($products) {
  $strProducts = '';
  $str = '<tr id=":itemid"><td class="info"><span>:name</span></td>
    <td><input type="number" class="stor-txt" name="Product[number][:itemid]" required="required" value=":value"/></td>
   <td><input name="Product[note][:itemid]" type="text" class="stor-txt" value=":note"/></td>
    <td><a href="#"><span class="icon-remove"></span></a></td>
  </tr>';
  foreach ($products as $key => $value) {
    $strProducts.=strtr($str,array(':itemid'=>$key,':value'=>$value['numbers'],':note'=>$value['note'],':name'=>$value['name'],)); 
}
/*    <tr><td class="info"><span>xxx</span></td>
    <td><input type="number" class="stor-txt" name="Product[number][44438103774791038]" value="20" required="required" /></td>
   <td><input type="text" class="stor-txt" name="Product[note][44438103774791038]" /></td>
    <td><a href="#"><span class="icon-remove"></span></a></td>
  </tr>*/
}
?>

<div class="page-header">
  <h1><?php echo $model->sName?> <small><?php echo Tk::g($this->cates[$model->typeid]);?></small> </h1>
</div>
<div class="row-fluid">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'movings-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
    )); ?>

  <div class="head clearfix">
    <i class="isw-documents"></i>
    <h1><?php echo Tk::g($action);?></h1>
<?php 
$this->widget('application.components.MyMenu',array(
      'htmlOptions'=>array('class'=>'buttons'),
      'items'=> $items ,
));
?>  
  </div>

  <div class="block-fluid clearfix">
    <?php echo $form->hiddenField($model,'typeid'); ?>
    <div class="dr"><span></span></div>
    <?php echo $form->errorSummary($model,null,null,array('class'=>'alert alert-error'));?>
    <div class="span6">
      <div class="block-fluid without-head">
        <div class="toolbar nopadding-toolbar clear clearfix">
          <h4>单据信息</h4>
        </div>
        <div class="row-form clearfix" style="border-top-width: 0px;"> <span class="span3"><?php echo $form->labelEx($model,'time'); ?></span> <span class="span9"><?php echo $form->dateField($model,'time',array('required'=>'required','size'=>10,'maxlength'=>10,'value'=>($model->time>0?Tak::timetodate($model->time):''))); ?></span> </div>
        <div class="row-form clearfix"> <span class="span3"><?php echo $form->labelEx($model,'numbers'); ?></span> <span class="span9"><?php echo $form->textField($model,'numbers',array('size'=>60,'maxlength'=>100)); ?></span> </div>
        <div class="row-form clearfix"> <span class="span3"><?php echo $form->labelEx($model,'enterprise'); ?></span> <span class="span9"><?php echo $form->textField($model,'enterprise',array('required'=>'required','size'=>60,'maxlength'=>100)); ?></span> </div>
        <div class="row-form clearfix"> <span class="span3"><?php echo $form->labelEx($model,'us_launch'); ?></span> <span class="span9"><?php echo $form->textField($model,'us_launch',array('size'=>60,'maxlength'=>100)); ?></span> </div>
        <div class="row-form clearfix"> <span class="span3"><?php echo $form->labelEx($model,'note'); ?></span> <span class="span9"><?php echo $form->textArea($model,'note',array('size'=>60,'maxlength'=>255)); ?></span> </div>
      </div>
    </div>
    <div class="span5">
      <div class="block-fluid without-head">
        <div class="toolbar nopadding-toolbar clearfix">
          <h4>产品明细</h4>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="table" >
          <thead>
            <tr>
              <th>产品</th>
              <th width="80">数量</th>
              <th width="80">备注</th>
              <th width="30">移除</th>
            </tr>
          </thead>
          <tbody class="not-mpr" id="product-movings">
          <?php echo $strProducts;?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3">
                    <div>
                            <input type="text" class="sele1ct-product" />
                    </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
</div>
<div class="footer tar">
  <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'submit', 'label'=>Tk::g($action))); ?>

  <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'reset', 'label'=>Tk::g('Reset'))); ?>
</div>

<?php $this->endWidget(); ?>
<?php 
Yii::app()->clientScript->registerScriptFile(yii::app()->theme->baseUrl.'/js/k-load-movings.js', CClientScript::POS_END);
?>
</div>
