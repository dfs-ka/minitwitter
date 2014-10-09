<?php foreach($error as $e): ?>
	<div class="error"><?php echo $e ?></div>
<?php endforeach; ?>

<?php if(!Yii::app()->user->isGuest): ?>
	<?php echo CHtml::beginForm(); ?>
	<?php echo CHtml::textArea('msg',$msg,array('placeholder'=>'Your message', 'class'=>'newpost', 'rows'=>3)); ?><br />
	<?php echo CHtml::submitButton('Send', array('name' => 'send')); ?>
	<?php echo CHtml::endForm(); ?>
	<br />
<?php endif; ?>

<?php foreach($posts as $post): ?>
	<div id="post_<?php echo $post['id'] ?>" class="post">
		<div class="post-header">
			<div class="post-date"><?php echo $post['date'] ?>&nbsp;</div>
			<div class="post-author">@<?php echo $post['username'] ?></div>
			<?php if($this->user->id == $post['uid']): ?>
				<div class="post-control">
					<div class="post-edit">Edit</div>&nbsp;&nbsp;
					<div class="post-delete">Delete</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="post-body">
			<div class="post-msg"><?php echo nl2br($post['msg']) ?></div>
			<div class="post-edit-msg">
				<?php echo CHtml::textArea('msg',$post['msg'],array('rows'=>3)); ?><br />
				<div class="post-edit-msg-confirm">Confirm</div>
				<div class="post-edit-msg-cancel">Cancel</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>