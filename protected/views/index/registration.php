<?php foreach($error as $e): ?>
	<div class="error"><?php echo $e ?></div>
<?php endforeach; ?>

<?php echo CHtml::beginForm('registration'); ?>
<?php echo CHtml::textField('username','',array('placeholder'=>'username')); ?><br />
<?php echo CHtml::passwordField('password','',array('placeholder'=>'password')); ?><br />
<?php echo CHtml::submitButton('Register', array('name' => 'send')); ?>
<?php echo CHtml::endForm(); ?>