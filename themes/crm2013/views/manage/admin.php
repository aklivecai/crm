<?php
/* @var $this ManageController */
/* @var $model Manage */

$this->breadcrumbs=array(
	Tk::g('Manages') => array('admin')
	,Tk::g('Admin')
);

$items = array(  
    array(
      'icon' =>'isw-plus',
      'url' => array('create'),
      'label'=>Tk::g('Create'),
    )    
    ,array(
      'icon' =>'isw-user',
      'url' => array('/rights/'),
      'label'=>Tk::g(array('Permissions','Admin')),
    ) 
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>
	<!--[if !IE]><!-->
	<style>
	@media 
	only screen and (max-width: 500px),
	(min-device-width: 568px) and (max-device-width: 1024px)  {
	
	#list-grid a
	#list-grid span,{
		float: none;
		display: inline;
	}
#list-grid .button-column {
	width: 48%;
	text-align: right;
	background-color: #EEE;
}	
		/* Force table to not be like tables anymore */
		#list-grid table,#list-grid thead,#list-grid tbody,#list-grid th,#list-grid td,#list-grid tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		#list-grid thead tr { 

		}
		#list-grid .filter-container{
			display: block;
		}
		#list-grid thead a{
			background: none;
		}
		#list-grid thead a,
		#list-grid thead input,
		#list-grid thead select{
			display: block;
			background: none;
			min-width:90%;
			margin:0 auto;
		}
		#list-grid thead td{
			padding:0 0;
			margin:0 2px;
			height:28px;
			line-height: 25px;
			border:0;
			background: none;
		}
		#list-grid thead tr{
			border:0;
			background-color: none;
			float: left;
			width:48%;

		}
		#list-grid thead tr:first-child{
		}
		#list-grid thead tr:last-child{
		
		}
		#list-grid tbody tr:first-child{
			clear:both;
		}

		
		#list-grid tr { border: 1px solid #CCC; }
		
		#list-grid td { 
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #EEE; 
			position: relative;
			padding-left: 50%; 
		}
		
		#list-grid  td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
		
		/*
		Label the data
		*/
		/*#list-grid td:nth-of-type(1):before { content: "操作"; }*/
		#list-grid tbody td:nth-of-type(2):before { content: "登录帐号"; }
		#list-grid tbody td:nth-of-type(3):before { content: "名字"; }

		#list-grid tbody td:nth-of-type(4):before { content: "最后登录"; }
		#list-grid tbody td:nth-of-type(5):before { content: "登录次数"; }
		#list-grid tbody td:nth-of-type(6):before { content: "状态"; }
	}
	

	
	</style>
	<!--<![endif]-->

<div class="row-fluid">
	<div class="span12">
	<div class="head clearfix">
        <div class="isw-grid"></div>
        <h1><?php  echo Tk::g('Manages');?></h1>   
<?php 
$this->widget('application.components.MyMenu',array(
      'htmlOptions'=>array('class'=>'buttons'),
      'items'=> $items ,
));

?>                    

    </div>
		<div class="block-fluid clearfix">
<?php  $widget = $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id' => 'list-grid',
	'dataProvider' => $model->search(),
	'template'=>"{items}",
	//Ajax地址转
	'enableHistory'=>true,
    'loadingCssClass' => 'grid-view-loading',
    'summaryCssClass' => 'dataTables_info',
    'pagerCssClass' => 'pagination dataTables_paginate',
    'template' => '{pager}{summary}<div class="dr"><span></span></div>{items}{pager}',
            'ajaxUpdate'=>true,    //禁用AJAX
            'enableSorting'=>true,
            'summaryText' => '<span>总数：{count}</span>  <span>区间：{start}-{end}</span> <span>当前:{page}</span> <span>总页数：{pages}</span>',

	'filter'=>$model,
	'pager'=>array(
		'header'=>'',
		'maxButtonCount' => '5',
		'hiddenPageCssClass' => 'disabled'
		,'selectedPageCssClass' => 'active disabled'
		,'htmlOptions'=>array('class'=>'')
	),
	// 'selectableRows'=>2, 	
	'columns'=>array(
		// array('class'=>'CCheckBoxColumn','name'=>'manageid','id'=>'select'), 	
		Tak::getAdminPageCol(array(
			  'template'=>'<span>{vrights}</span> | {view} {update}'
			  ,'buttons'=>array(
					'vrights' => array
					(
						'label'=>'权限',
						 'url'=>'Yii::app()->createUrl("rights/assignment/user", array("id"=>$data->manageid))',
						 'linkOptions'=>array('style'=>'width: 50px'),
					),
			  ),
			)
			  ,'list-grid'
			  ,'80px'
		),	

		array(
			'name'=>'user_name',
			'type'=>'raw',
			'value'=>'CHtml::link($data->user_name,array("view","id"=>$data->manageid))',
		),	
		array(
			'name'=>'user_nicename',
			'type'=>'raw',
		),		
		array(
			'name' => 'login_count',
			'type'=>'raw',			
            'filter' => false
		),
		array(
			'name'=>'last_login_time',
			'type'=>'raw',
			'value'=>'Tak::timetodate($data->last_login_time,4)',
            'filter' => false
		),	
		array(
			'name' => 'user_status',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'value'=>'TakType::getStatus("status",$data->user_status)',
			'type'=>'raw',
			'filter'=>TakType::items('status'),			 
		),
	),
)); 
?>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>