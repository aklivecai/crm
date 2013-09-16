<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$tshiPatch = dirname(__FILE__) ;

Yii::setPathOfAlias('bootstrap', $tshiPatch.'/../extensions/bootstrap');

return array(
	'basePath'=>$tshiPatch.DIRECTORY_SEPARATOR.'..',
	// 语言包
	'language'=>'zh_cn', 
	'name'=>'具人同行 在线 CRM 测试',
	 'timeZone' => 'Asia/Shanghai',
    'defaultController'=>'site',

	'theme' => 'crm2013',
	// preloading 'log' component
	'preload'=>array('log'),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=> include( $tshiPatch.'/params.conf.php' ),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',


		// 调试的拓展
		'application.extensions.debugtoolbar.*',

		'application.extensions.jsonDataprovider.*',

		/* for ext yii-rights */
 		'application.modules.rights.*',
    	'application.modules.rights.models.*',  
    	'application.modules.rights.components.*', // Correct paths if necessary.  

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			// 以及默认的位置
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			 // 'bootstrap.gii',
			// Gii 在GiiModule::generatorPaths 属性指定的目录中查找可用的生成器。 当需要定制时，我们可以在应用程序的配置文件中做如下配置，
			 'generatorPaths'=>array(
			 	'application.gii',   // a path alias
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
               'layout'=>'//layouts/mainRight',  // Layout to use for displaying Rights. 
               'appLayout'=>'//layouts/main', // Application layout. 
               // 'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
	    ),  

	),
	// application components components.authManager.assignmentTable
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
	    'mobileDetect' => array(
	        'class' => 'ext.MobileDetect.MobileDetect'
	    ),        
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),        
	    'user' => array(  
	        'class' => 'RWebUser',  
	        'allowAutoLogin'=>true,
            'loginUrl' => array('/site/login'),
	    ),  
	    'urlManager' => include( $tshiPatch.'/url.conf.php' ),
		'db' => include( $tshiPatch.'/db.conf.php' ),
		'errorHandler'=>array(
			// 程序有错的时候跳到指定的action
			'errorAction'=>'site/error',
		),

		'log' => array(
            'class'=>'CLogRouter',
            'routes'=>include( $tshiPatch.'/log.conf.php'),
        ),
	),

);