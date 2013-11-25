<?php 

$_tags = array();
$_i = count($tags);
foreach ($tags as $k1 => $v1) {
  if ($k1=='Next') {
    $_tags[] = '----';
    $_tags[] = array(
          'label'=>Tak::getDataView($model->getLinkName()),
           'url'=> '',
           'disabled'=>true,
           'icon' =>'ok',
        );
    $_tags[] = '----';
  }

  if (is_array($v1)) {   
    foreach ($v1 as $key => $value) {
      $_tags[] = array(
        'label'=>Tak::getDataView($value[$model->linkName]),
        'url'=> $model->getLink($key,$view),
        'icon' =>'chevron-right',
      );
    }
  }
  $_i--;

}
   $this->widget('bootstrap.widgets.TbMenu', array(
    'id' =>'gettop-'.$model->primaryKey,
    'items'=> $_tags,
    'htmlOptions' =>array('class'=>'dropdown-menu load-over')
    )
); 
?>