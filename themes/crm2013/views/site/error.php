<?php $this->pageTitle=Yii::app()->name . ' - ' .$error['code']; ?>
   <div class="errorPage">        
        <p class="name"><?php echo $code; ?></p>
        <p class="description"><?php echo CHtml::encode($message); ?></p>        
        <p>
        <?php 
        $url = Yii::app()->request->urlReferrer;
        if ($url) {
        	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'linkurl', 'label'=>'返回上一页','type'=>'danger','htmlOptions'=>array('href'=>Yii::app()->request->urlReferrer)));
        }
       $url = $url?$url:Yii::app()->homeUrl;
       $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'linkurl', 'label'=>'回到主页','type'=>'warning','htmlOptions'=>array('href'=>Yii::app()->homeUrl)));
       $cl = Yii::app()->getClientScript();
        $cl->registerMetaTag("8;url=$url",$name,'refresh');
	 	$cl->registerScript('1', "setTimeout(function(){ window.location = \"".$url."\";} ,8 * 1000);");

        ?>
        	</p>
    </div>