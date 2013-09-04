<?php
/* @var $this ClienteleController */
/* @var $model Clientele */

$this->breadcrumbs=array(
	Tk::g('Clienteles') => array('admin'),
	$model->itemid,
);
	$items = Tak::getViewMenu($model->itemid);
?>

<div class="row-fluid">
  <div class="span8">
    <div class="head clearfix">
      <div class="isw-zoom"></div>
      <h1><?php echo Tk::g('Clienteles')?></h1>
      <ul class="buttons">
        <li class="toggle active"><a href="#"></a></li>
      </ul>
    </div>
    <div class="block">
      <div class="span9">
        <?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'clientele_name',
		array('name'=>'rating','type'=>'raw', 'value'=>TakType::getStatus('rating',$model->rating),),
		array('name'=>'annual_revenue','type'=>'raw', 'value'=>TakType::getStatus('annual_revenue',$model->annual_revenue),),
		array('name'=>'industry','type'=>'raw', 'value'=>TakType::getStatus('industry',$model->industry),),
		array('name'=>'profession','type'=>'raw', 'value'=>TakType::getStatus('profession',$model->profession),),
		array('name'=>'origin','type'=>'raw', 'value'=>TakType::getStatus('origin',$model->origin),),
		array('name'=>'employees','type'=>'raw', 'value'=>TakType::getStatus('employees',$model->employees),),
		'email',
		'address',
		'telephone',
		'fax',
		'web',
		array('name'=>'display','type'=>'raw', 'value'=>TakType::getStatus('display',$model->display),),
		array('name'=>'last_time', 'value'=>Tak::timetodate($model->last_time,6),),
		array('name'=>'add_time', 'value'=>Tak::timetodate($model->add_time,6),),
		array('name'=>'modified_time', 'value'=>Tak::timetodate($model->modified_time,6),),
		'note',
	),
)); ?>
      </div>
      <div class="span3">
        <?php 
	$this->widget('bootstrap.widgets.TbMenu', array(
	    'type'=>'list',
	    'items'=> $items,
	    )
	); 
?>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="span4">
    <div class="row-fluid">
      <div class="span12">
        <div class="head clearfix">
          <div class="isw-users"></div>
          <h1><?php echo Tk::g('ContactpPrson') ?></h1>
          <ul class="buttons">
            <li class="toggle"><a href="#"></a></li>
          </ul>
        </div>
        <div class="block-fluid users">
          <div class="item clearfix">
            <div class="image"><a href="#"></a></div>
            <div class="info"> <a href="#" class="name">张三</a> <span>0755-3424234</span>
              <div class="controls"> <a href="#" class="icon-ok"></a> <a href="#" class="icon-remove"></a> </div>
            </div>
          </div>
          <div class="item clearfix">
            <div class="image"><a href="#"></a></div>
            <div class="info"> <a href="#" class="name">张三</a> <span>0755-3424234</span>
              <div class="controls"> <a href="#" class="icon-ok"></a> <a href="#" class="icon-remove"></a> </div>
            </div>
          </div>
          <div class="item clearfix">
            <div class="image"><a href="#"></a></div>
            <div class="info"> <a href="#" class="name">张三</a>
              <div class="controls"> <a href="#" class="icon-ok"></a> <a href="#" class="icon-remove"></a> </div>
            </div>
          </div>
<div class="footer">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Tk::g('More'),
    'url'=>Yii::app()->createUrl('ContactpPrson/admin',array('ContactpPrson[clientele]'=>$model->itemid)), 
    'size'=>'small', 
)); ?>
</div>          
        </div>
      </div>
    </div>
<div class="row-fluid">
      <div class="span12">
        <div class="head clearfix">
          <div class="isw-users"></div>
          <h1><?php echo Tk::g('Contact') ?></h1>
          <ul class="buttons">
            <li class="toggle"><a href="#"></a></li>
          </ul>
        </div>
        <div class="block-fluid users">
          <div class="item clearfix">
            <div class="image"></div>
            <div class="info"> <a href="#" class="name">王五</a> <span>初期沟通</span>
               <span class="text">2013-07-09</span>
            </div>
          </div>
          <div class="item clearfix">
            <div class="image"></div>
            <div class="info"> <a href="#" class="name">王五</a> <span>立项评估</span>
               <span class="text">2013-07-09</span>
            </div>
          </div>
          <div class="item clearfix">
            <div class="image"></div>
            <div class="info"> <a href="#" class="name">王五</a> <span>需求分析</span>
               <span class="text">2013-07-09</span>
            </div>
          </div>
          <div class="item clearfix">
            <div class="image"></div>
            <div class="info"> <a href="#" class="name">王五</a> <span>商务谈判</span>
               <span class="text">2013-07-09</span>
            </div>
          </div>
<div class="footer">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>Tk::g('More'),
    'url'=>Yii::app()->createUrl('Contact/admin', 
  array('Contact[clienteleid]'=>$model->itemid)), 
    'size'=>'small', 
)); ?>
</div>          
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="dr"><span></span></div>
</div>
