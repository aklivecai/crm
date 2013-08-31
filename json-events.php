<?php

	$year = date('Y');
	$month = date('m');

	echo json_encode(array(

		array(
			'id' => 111,
			'title' => "Event1",
			'start' => time(),
			'url' => "http://yahoo.com/",
			'color'=> 'yellow',    // an option!
			'textColor'=> 'black'  // an option!
		),

		array(
			'id' => 222,
			'title' => "你好的时枯井 是",
			'start' => "$year-$month-20",
			'end' => "$year-$month-22",
			'url' => "http://yahoo.com/",
			'color'=> 'yellow',    // an option!
			'textColor'=> 'black'  // an option!
		)

	));

?>
