<?php

// This is the main Web application configuration. Any writable
// application properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'MiniTwitter',
	'defaultController'=>'index',

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.models.formmodels.*',
		'application.components.*',
	),
	
	// modules to attach
	'modules' => array(
		'email' => array(
			'delivery' => 'php',
		)
	),
	
	// application components
	'components'=>array(		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// connect to db
		'db'=>array(
			'connectionString' => 'mysql:host=host;dbname=dbname',
			'emulatePrepare' => true,
			'username' => 'username',
			'password' => 'password',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
		
		'urlManager'=>array(
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),		
		),
		
		'errorHandler'=>array(
		),	
	),
);