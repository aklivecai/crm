<?php
/* @var $this OrderController */
/* @var $model Order */
/* @var $form bootstrap.widgets.TbActiveForm */
?>
<?php
$itemid = $model->itemid;
$this->breadcrumbs=array(
	Tk::g($model->sName) => array('admin'),
	$itemid,
);
  $orderInfo = $model->getOrderInfo();
  $listStatus = $model->getListStatus();
?>


<div class="tak-order-status">
	<?php echo CHtml::image($this->getAssetsUrl().'img/tak/'.$model->status.'.png') ?>
</div>

<div class="well">
<strong><?php echo $model->getAttributeLabel('itemid');?></strong>：
	<?php echo $model->itemid; ?>
	，
<strong><?php echo $model->getAttributeLabel('status');?></strong>：
	<?php echo OrderType::item('order-status',$model->status); ?>
<p>
	<?php echo $model->getAttributeLabel('add_time');?>：
	<?php echo Tak::timetodate($model->add_time,6); ?>
	，
	<?php echo $model->getAttributeLabel('total');?>：
	<strong class="price-strong">￥
		<?php echo $model->total; ?>
	</strong>
	，
	<?php echo $model->getAttributeLabel('manageid');?>：
	<?php 
	echo CHtml::link($model->iManage->company,Yii::app()->createUrl('/Site/PreviewTestMember',array('id'=>$model->manageid)),array('class'=>'data-preview'));
	 ?>
	，
	<?php echo $model->getAttributeLabel('add_ip');?>：
	<?php echo Tak::Num2IP($model->add_ip); ?>
</p>
<p>
	<?php
	 	if ($model->pay_time>0) {
	 		echo $model->getAttributeLabel('pay_time').'：'.Tak::timetodate($model->pay_time,6).'，';
	 	}
	 	if ($model->delivery_time>0) {
	 		echo $model->getAttributeLabel('delivery_time').'：'.Tak::timetodate($model->delivery_time,6);
	 	}
	 ?>
</p> 
<table class="tak-table action-fold">
	<caption>订单跟踪</caption>
	<colgroup align="center">
	<col width="140px"/>
	<col width="85px"/>
	<col width="150px"/>
	</colgroup>	
	<thead>
	<tr>
		<th>处理时间</th>
		<th>操作人</th>
		<th>状态</th>
		<th>文件</th>
		<th>处理信息</th>
	</tr>
	</thead>
	<tbody class="wap-products">
	<?php 
	$list = $model->getFlows();
	$result = '';
	$strHtml = '<tr>
	<td>:add_time</td>
	<td>:action_user</td>
	<td>:name</td>
	<td>:pics</td>
	<td>:note</td>
	</tr>';
	$arr = false;
	foreach ($list as $key => $value) {
		$arr = array(
			':pics'=>$value->getFilesImg(),
			':add_time'=>Tak::timetodate($value->add_time,6),
			':action_user'=>$value->action_user,
			':name'=>$value->getName(),
			':note'=>$value->note,
		);
		$result .= strtr($strHtml,$arr);
	}
	echo $result;
	?>
	</tbody>	
</table>

</div>

<table class="tak-table action-fold">
	<caption>详细信息</caption>
	<tbody>
	<tr>
		<th><?php echo $orderInfo->getAttributeLabel('date_time');?>:</th>
		<td><?php echo Tak::timetodate($orderInfo->date_time,3); ?></td>
		<th><?php echo $orderInfo->getAttributeLabel('packing');?>:</th>
		<td><?php echo OrderType::item('packing',$orderInfo->packing); ?></td>
	</tr>
	<tr>
		<th><?php echo $orderInfo->getAttributeLabel('taxes');?>:</th>
		<td><?php echo OrderType::item('taxes',$orderInfo->taxes); ?></td>
		<th><?php echo $orderInfo->getAttributeLabel('convey');?>:</th>
		<td><?php echo OrderType::item('convey',$orderInfo->convey); ?></td>
	</tr>
	<tr>
		<th><?php echo $orderInfo->getAttributeLabel('pay_type');?>:</th>
		<td colspan="3">
			<?php 
				echo OrderType::getStatus('pay_type',$orderInfo->pay_type); 
				echo $orderInfo->getPayInfo();
			?>
		</td>		
	</tr>
	<tr>
		<th><?php echo $orderInfo->getAttributeLabel('detype');?>:</th>
		<td colspan="3">
		<?php 
			echo OrderType::getStatus('detype',$orderInfo->detype); 
			
			echo $orderInfo->getContactp();
		?>
		</td>
	</tr>
	<tr>
		<th><?php echo $orderInfo->getAttributeLabel('note');?>:</th>
		<td colspan="3">
		<?php 
			echo $orderInfo->note;
		?>
		</td>
	</tr>
	</tbody>
</table>

<table class="tak-table action-fold">
	<caption>商品清单</caption>
	<thead>
		<tr>
			<th width="150">产品名称</th>
			<th>详情</th>
			<th width="120">单价</th>
			<th width="80">数量</th>
			<th width="150">小计</th>
		</tr>
	</thead>
	<tbody class="wap-products">
	<?php 
	 $list = $model->getProducts();
	$result = '';
	$strHtml = '<tr>
	<td>:name</td>
	<td>
		<dl>
			<dt>$model:</dt><dd>:model &nbsp;</dd>
			<dt>$standard:</dt><dd>:standard &nbsp;</dd>
			<dt>$color:</dt><dd>:color &nbsp;</dd>
			<dt>$unit:</dt><dd>:unit &nbsp;</dd>
		</dl>
		<div class="kclear"></div>
		<div>
		<strong>$note:</strong>
		:note 
		&nbsp;
		</div>
		:pics
	</td>
	<td class="price-strong">￥:price &nbsp;</td>
	<td>:amount &nbsp;</td>
	<td class="price-strong">￥:sum &nbsp;</td>
	</tr>';
	$arr = false;
	foreach ($list as $key => $value) {
		$arr = array(':pics'=>$value->getFilesImg());
		$icount = 0;
		foreach (array('name','amount','price','sum','unit','model','standard','color','note') as  $v1) {
			$arr[':'.$v1] = $value->{$v1};
			if ($icount>3) {
				$arr['$'.$v1] = $value->getAttributeLabel($v1);
			}
			$icount++;
		}
		$result .= strtr($strHtml,$arr);
	}
	echo $result;
	?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5">合计:
			<strong  class="price-strong">￥
			<?php echo $model->total;  ?>
			</strong>
			</td>
		</tr>
	</tfoot>
</table>


<script>
var flowForm = $('#flow-form')
, flowStatus = flowForm.find('#OrderFlow_status')
, flowName = flowForm.find('#OrderFlow_name')

, setStatus = function(status,txt){	
	$('#show-status').html(txt);
	if (status!=='') {
		flowForm.addClass('active');
		flowStatus.val(status);
		if (status==0) {
			flowName.removeAttr('disabled');
		}else{
			flowName.attr('disabled',true);
		}
	}else{
		flowForm.removeClass('active');
	}
};

 flowForm.on('submit',function(event){
	 if (flowStatus.val()==0&&flowName.val()=='') {
	 	event.preventDefault();
	 	alert('流程名字不能为空!');
	 	flowName.focus();
	 };
});

	$(function() {
		$(document).on('click','table.action-fold caption',function(){
			var t = $(this).parent();
			t.toggleClass('active');
		});
	});
</script>
