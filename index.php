<?php
// include Yii bootstrap file
require_once(dirname(__FILE__).'/framework/yii.php');

// create a Web application instance and run
$configFile='protected/config/main.php';
Yii::createWebApplication($configFile)->run();
?>
