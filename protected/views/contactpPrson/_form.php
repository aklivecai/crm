<?php
/* @var $this ContactpPrsonController */
/* @var $model ContactpPrson */
/* @var $form bootstrap.widgets.TbActiveForm */
?>
<?php  $action = $model->isNewRecord?'Create':'Update';
 $items = Tak::getEditMenu($model->itemid,$model->isNewRecord);
?>
<div class="row-fluid">
<div class="span12">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contactp-prson-form',
	 'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="head clearfix">
	<i class="isw-documents"></i><h1><?php echo Tk::g(array('ContactpPrson',$action));?></h1>
	<ul class="buttons">
	    <li>
	        <a href="#" class="isw-settings"></a>
<?php			$this->widget('application.components.MyMenu',array(
	          'htmlOptions'=>array('class'=>'dd-list'),
	          'items'=> $items ,
	    	));
		?>
	    </li>
	</ul>       
</div>
<div class="block-fluid">
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'clientele',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'nicename',array('size'=>60,'maxlength'=>64)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->radioButtonListRow($model,'sex',Taktype::items('sex'),array('class'=>'','template'=>'<label class="checkbox inline">{input}{label}</label>')); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'department',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'position',array('size'=>60,'maxlength'=>100)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'phone',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'mobile',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'fax',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'qq',array('size'=>20,'maxlength'=>20)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textFieldRow($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	<div class="row-form clearfix" >
		<?php echo $form->textAreaRow($model,'note',array('size'=>60,'maxlength'=>255)); ?>
	</div>

</div>

<div class="footer tar">
    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'submit', 'label'=>Tk::g($action))); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array('size'=>'large','buttonType'=>'reset', 'label'=>Tk::g('Reset'))); ?>
    
</div>

<?php $this->endWidget(); ?>

<div id="myModal" class="modal hide"> 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Modal header</h3>
</div>
 
<div class="modal-body">
    <p>One fine body...</p>
</div>
 
<div class="modal-footer">
    <a data-dismiss="modal" class="btn btn-primary" href="#">Save changes</a>    <a data-dismiss="modal" class="btn" href="#">Close</a></div>
</div>

<?php echo CHtml::tag('input',array('id'=>'clientele-select','value'=>$this->createUrl('clientele/select'),'type'=>'hidden'));?>

<div id="dialogContent" title="Basic dialog">
  <iframe src=""></iframe>
</div>
<button id="dialog">Open Dialog</button>

<script type="text/javascript">
 $(function () {
   $("#dialogContent").dialog({
     autoOpen: false,
     modal: true
   });

   $('#dialog').click(function () {
     $("#dialogContent").dialog( "open" );
   });
 });


$(function() {
    $(".modal-link").click(function(event) {
        event.preventDefault()
        $('#myModal').removeData("modal")
        $('#myModal').modal({remote: $(this).attr("href")})
    })
})

</script>
</div>

<script>
  //$.fx.speeds._default = 500;  
  $(function() {    
    $( "#dialog" ).dialog({      
    autoOpen: false,      
    show: "fade",   
    hide: "fade",
            modal: true,            
            open: function () {$(this).load($('#clientele-select').val());},                     
            height: 'auto',            
            width: 'auto',        
            resizable: true,    
            title: 'Vessels'
        });     

    $( "#opener" ).click(function() {      
    $( "#dialog" ).dialog( "open" );      
    return false;   
    });  
  });  
  </script>

<div id="dialog"></div><button id="opener">Open Dialog</button>

