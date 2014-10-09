<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<link  rel="shortcut icon" href="/favicon.ico">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css?<?=mt_rand(10000,99000)?>" />
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery-1.10.2.min.js', CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/template.js?'.mt_rand(10000,99000), CClientScript::POS_HEAD); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="site">
	<div class="header">
		<div class="container">
			<div id="mainmenu">
				<?php $this->widget('zii.widgets.CMenu',array(
					'items'=>array(
						array('label'=>'Home', 'url'=>array('/index')),
						array('label'=>'Log out', 'url'=>array('/index/logout'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Log in', 'url'=>array('/index/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Register', 'url'=>array('/index/registration'), 'visible'=>Yii::app()->user->isGuest),
					),
				)); ?>
			</div><!-- mainmenu -->
		</div>
	</div><!-- header -->
	<div id="page">
		<div class="container">
			<?php echo $content; ?>
			<div class="prefooter"></div>
		</div>
	</div><!-- page -->
</div><!-- site -->
<div class="footer">
	<div class="container">
		<div class="copy">&copy; dfs</div>
	</div>
</div><!-- footer -->
</body>
</html>