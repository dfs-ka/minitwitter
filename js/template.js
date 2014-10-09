$(document).ready(function () {
	$('.post-edit').click(function() {
		$(this).parent().parent().parent().find('.post-msg').hide();
		$(this).parent().parent().parent().find('.post-edit-msg').show();	
	});
	
	$('.post-edit-msg-confirm').click(function() {
		var post_id = $(this).parent().parent().parent().attr('id').substr(5);
		var msg = $(this).parent().find('textarea').val();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: '/index/edit', 
			data: { post_id: post_id, msg: msg },
			success: function(data){
				if(data.status) {
					$('#post_'+post_id).find('.post-msg').html(msg.replace(/\r\n|\r|\n/g,"<br />"));
					$('#post_'+post_id).find('.post-edit-msg').hide();
					$('#post_'+post_id).find('.post-msg').show();
				} else {
					alert(data.error);
				}
			},
			error: function(data){
				alert('Error!');
			}
		});
	});
	
	$('.post-edit-msg-cancel').click(function() {
		$(this).parent().parent().find('.post-edit-msg').hide();
		$(this).parent().parent().find('.post-msg').show();
	});
	
	$('.post-delete').click(function() { 
		if(confirm('Are you sure?')) {
			var post_id = $(this).parent().parent().parent().attr('id').substr(5);
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: '/index/delete', 
				data: { post_id: post_id },
				success: function(data){
					if(data.status) {
						$('#post_'+post_id).remove();
					} else {
						alert('Error! You don\'t have permission to delete this post.');
					}
				},
				error: function(data){
					alert('Error!');
				}
			});
		}
	});
});