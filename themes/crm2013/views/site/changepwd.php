<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	'个人资料',
);
?>

<a href="#fModal" role="button" class="btn" data-toggle="modal">Modal form</a>
       <!-- Bootrstrap modal form -->
        <div id="fModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">修改密码</h3>
            </div>        
            <div class="row-fluid">
                <div class="block-fluid">
                    <div class="row-form clearfix">
                        <div class="span3">旧密码:</div>
                        <div class="span9"><input type="password" value=""/></div>
                    </div>            
                    <div class="row-form clearfix">
                        <div class="span3">新密码:</div>
                        <div class="span9"><input type="password" value=""/></div>
                    </div>                                    
                    <div class="row-form clearfix">
                        <div class="span3">重复输入新密码:</div>
                        <div class="span9"><input type="password" value=""/></div>
                    </div>
                </div>
            </div>                    
            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal" aria-hidden="true">保存</button> 
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>            
            </div>
        </div>   
<div class="row-fluid">
<div class="span4">
    <div class="block-fluid ucard">

            <div class="info">                                                                
                <ul class="rows">
                    <li class="heading">账户信息</li>
<?php $this->widget('ext.TakDetailView', array(
	'data'=>$model,
	'tagName'=>null,
	'attributes'=>array(
		'user_name',
		array('name'=>'add_time', 'value'=>Tak::timetodate($model->add_time,6),),
		array('name'=>'active_time', 'value'=>Tak::timetodate($model->active_time,6),),
		array('name'=>'last_login_time', 'value'=>Tak::timetodate($model->last_login_time,6),),
		array('name'=>'last_login_ip', 'value'=>Tak::Num2IP($model->last_login_ip),),
		'login_count',

	),
)); ?>       
                </ul>                                                      
            </div>
    </div>
</div>
<div class="span8">    
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); 
?>
<?php echo $form->errorSummary($model); ?>              
<div class="block-fluid without-head">                        
    <div class="row-form clearfix" style="border-top-width: 0px;">
    <?php echo $form->textFieldRow($model, 'user_nicename', array('size'=>60,'maxlength'=>64)); ?>
</div><div class="row-form clearfix">
    <?php echo $form->textFieldRow($model, 'user_email', array('size'=>60,'maxlength'=>100)); ?>
</div><div class="row-form clearfix">
	<?php echo $form->textAreaRow($model, 'note', array('maxlength'=>255)); ?>
  </div>

<div class="footer tar">
    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'submit', 'label'=>$model->isNewRecord ? Tk::g('Add') : Tk::g('Save'))); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'reset', 'label'=>Tk::g('Reset'))); ?>
</div>
<?php $this->endWidget(); ?>                                            
                    </div>
</div>

