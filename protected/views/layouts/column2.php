<?php $this->beginContent('application.views.layouts.main'); ?>
<div class="container">
	<div class="span-18">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-6 last">
		<div id="sidebar">
			<?php if(!Yii::app()->user->isGuest) $this->widget('UserMenu'); ?>

			<?php $this->widget('TagCloud', array(
				'title' => '标记',
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>

			<?php $this->widget('RecentComments', array(
				'title' => '最新的评论',
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>
			

		</div><!-- sidebar -->
	</div>
</div>
<?php $this->endContent(); ?>