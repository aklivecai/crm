<?php

$db = array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/db.db3',
            // 表前缀
            'tablePrefix'=>'Tak_',
        );
        // uncomment the following to use a MySQL database
$db = array(
            'connectionString' => 'mysql:host=192.168.1.222;dbname=_b2b_ak',
            'emulatePrepare' => true,
            'username' => 'ak',
            'password' => 'aklivecai',
            'charset' => 'utf8',
            'tablePrefix'=>'tak_'
);
#$db['connectionString'] = 'mysql:host=127.0.0.1;dbname=test';
#$db['username'] = 'root';
#$db['password'] = '';

if(YII_DEBUG)
{
    $db_debug = array(
        'enableProfiling' => true,
        'enableParamLogging' => true,
    );

    $db = array_merge($db, $db_debug);
}

if (true) {
    $db['connectionString'] = 'mysql:host=9juren.com;dbname=test';
    $db['username'] = 'root';
    $db['password'] = '';
}

return $db;