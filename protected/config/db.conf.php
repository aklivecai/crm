<?php

$db = array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/db.db3',
            // 表前缀
            'tablePrefix'=>'Tak_',
        );
        // uncomment the following to use a MySQL database
$db = array(
            'connectionString' => 'mysql:host=localhost;dbname=test',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix'=>'tak_'
);
if(YII_DEBUG)
{
    $db_debug = array(
        'enableProfiling' => true,
        'enableParamLogging' => true,
    );

    $db = array_merge($db, $db_debug);
}

return $db;