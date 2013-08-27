<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	// 语言包
	'language'=>'zh_cn', 
	'name'=>'具人同行 在线 CRM 测试',
	 'timeZone' => 'Asia/Shanghai',
    'defaultController'=>'site',
     
    'defaultController'=>'site',
	'theme' => 'crm2013',
	// preloading 'log' component
	'preload'=>array('log'),
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'defaultPageSize' => '20'
	),	

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',

		'application.components.Globals',

		// 调试的拓展
		'application.extensions.debugtoolbar.*',

		/* for ext yii-rights */
 		'application.modules.rights.*',  		        
    	'application.modules.rights.models.*',  
    	'application.modules.rights.components.*', // Correct paths if necessary.  

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			 // 'bootstrap.gii',
			 'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
		'Admin' => array(
			'class' => 'application.modules.Admin.AdminModule'
		),

	    'rights' => array(  
	        'debug' => false,  
	        // 'install' => true,  
	        'enableBizRuleData' => true,  
	        	'userClass' => 'Manage',
               'superuserName'=>'Admin', // Name of the role with super user privileges. 
               'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
               'userIdColumn'=>'manageid', // Name of the user id column in the database. 
               'userNameColumn'=>'user_name',  // Name of the user name column in the database. 
               'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
               'enableBizRuleData'=>true,   // Whether to enable data for business rules. 
               'displayDescription'=>true,  // Whether to use item description instead of name. 
               'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
               'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
 
               'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
               'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
               'appLayout'=>'//layouts/main', // Application layout. 
               // 'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
	    ),  


	),

	// application components
	'components'=>array(
        'authManager'=>array(
            'class'=>'RDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'Tak_Rbac_Authitem',
            'itemChildTable'=>'Tak_Rbac_AuthItemChild',
            'assignmentTable'=>'Tak_Rbac_Authassignment',
            'rightsTable'=>'Tak_Rbac_Rights',
            'defaultRoles' => array('Authenticated', 'Guest'),

        ),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),        
	    'user' => array(  
	        'class' => 'RWebUser',  
	        'allowAutoLogin'=>true,
            'loginUrl' => array('/site/login'),
	    ),  


		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'db1'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/db.db3',
			// 表前缀
			'tablePrefix'=>'Tak_',
			'enableProfiling'=>true,
            'enableParamLogging' => true,
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
    		'connectionString' => 'mysql:host=localhost;dbname=test',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix'=>'tak_'
		),
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		// 权限管理添加
		'logss'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',

				),
				// debug toolbar configuration
				array(
					'class'=>'XWebDebugRouter',
					'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
					'levels'=>'error, warning, trace, profile, info',
					'allowedIPs'=>array('127.0.0.1'),
				),

			),
			),

		'logs'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
					'levels' => 'trace,info,errory,warning,xdebug',
					 'categories'=>'system.db.*',
					'showInFireBug' => true,
				),
				
			),
		),
	),

);