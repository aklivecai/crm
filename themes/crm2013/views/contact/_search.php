
<?php /** @var BootActiveForm $form */
$url = Yii::app()->createUrl($route?$route:$this->route);

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>$route?'search-contact':'search-form',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well'),
    'action' => $url,
    'method'=>'get',
)); 

 echo $form->dropDownList($model, 'type', TakType::sitems('contact-type')); 
 echo $form->dropDownList($model, 'stage', TakType::sitems('contact-stage'));

  echo $form->textFieldRow($model,'clienteleid',array('class'=>'select-clientele','size'=>10,'maxlength'=>10,'style'=>'width:200px')); 

 echo $form->textFieldRow($model,'prsonid',array('class'=>'select-prsonid','size'=>10,'maxlength'=>10,'style'=>'width:150px'));

 echo $form->textFieldRow($model,'contact_time',array('size'=>10,'maxlength'=>10,'class'=>'type-date')); 

  $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>Tk::g('Search'))); 
  $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'label'=>Tk::g('Reset'),'url'=>$url)); 
 $this->endWidget(); 
?>