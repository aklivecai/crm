<?php
/* @var $this TestMemeberController */
/* @var $model TestMemeber */

$this->breadcrumbs=array(
	Tk::g('Test Memebers') => array('admin'),
	'管理',
);
$msg = Yii::app()->user->getFlash('msg',false);
if ($msg) {
	echo "<div class=\"flash success\">$msg</div>";
}

?>

<?php echo CHtml::link(Tk::g('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'list-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'ajaxUpdate' => false,
	'enableHistory'=>true,
	'columns'=>array(
		array(
			'class'=>'CButtonColumn',
			'template' => '{view} {update}  {delete} <br />{viewlog} ', 
            'header' => CHtml::dropDownList('pageSize'
                    ,Yii::app()->user->getState('pageSize')
                    ,TakType::items('pageSize')
                    ,array(
                        'onchange'=>"$.fn.yiiGridView.update('list-grid',{data:{setPageSize: $(this).val()}})", 
                        'style'=>'width: '.$width.' !important',
                    ) 
              ),
             'buttons'=>array(
					'viewlog' => array
					(
						'label'=>'浏览日志',
						 'url'=>'Yii::app()->createUrl("juren/testLog/admin", array("TestLog[fromid]"=>$data->itemid))',
						 'linkOptions'=>array('style'=>'width: 50px'),
					),
			  ), 

		),
		array(
			'name'=>'itemid',
            'headerHtmlOptions' => array('style'=>'width:80px;'),
		),		
		array(
			'name'=>'company',
            'headerHtmlOptions' => array('style'=>'width:150px;'),
		),	
		array(
			'name'=>'email',
            'headerHtmlOptions' => array('style'=>'width:80px;'),
		),	
		array(
			'name'=>'email',
			'header' => '连接地址',
			'filter'=> false,
			'type'=>'raw',
			'value'=>'$data->getHtmlLink()',
		),		
		array(
			'name'=>'active_time',
			'value'=>'Tak::timetodate($data->active_time,5)',
            'headerHtmlOptions' => array('style'=>'width:120px;'),
            'filter'=> false
		),		
	),
)); ?>



