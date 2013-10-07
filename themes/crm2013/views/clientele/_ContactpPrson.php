<div class="item">
<?php echo $data->getHtmlLink() ;?>
&nbsp;&nbsp;
	电话：<?php echo $data->mobile.' / '.$data->phone;?>  
&nbsp;
最后联系：<?php echo Tak::timetodate($data->last_time,3);?>
</div>