$(function(){

	$('#container').on('click', '.save-entry', function(){
		
		var	client_id				= $('input[name="client_id"]').val(),
			plan_title 				= $('input[name="plan_title"]').val(),
			behaviour_id			= $('select[name="behaviour_id"]').val(),
			function_description 	= $('textarea[name="function_description"]').val();

			if( $(this).hasClass('edit-entry') ){
				var plan_id = $('input[name="plan_id"]').val(),
					url = global_url + 'ajax/edit_plan',
					data = { 'client_id': client_id, 'plan_title': plan_title, 'behaviour_id': behaviour_id, 'function_description': function_description, plan_id: plan_id };
			} else {
				var url = global_url + 'ajax/save_plan',
					data = { 'client_id': client_id, 'plan_title': plan_title, 'behaviour_id': behaviour_id, 'function_description': function_description };
			}

		$('#modal-form label span').remove();

		$.ajax({
			url: url,
			type: 'POST',
			data: data,
			dataType: 'json',
			success: function(response){

				if(response.stats == 'error'){

					if( response.validation ){

						$.each(response.validation, function(k,v){

							$('#'+k).parent().find('label span').remove();
							$('#'+k).parent().find('label').append(v);

						});

					}

					$('.message').addClass('error');

				} else {

					$('.message').removeClass('error');
					$('#modal-form input[type="text"]').val('');
					$('#modal-form select option:first').prop('selected','selected');
					$('#modal-form textarea').val('');
					$('.pages').remove();
					$().getPlans({ 'id': client_id });
					$().centerIcons();

				}

				$('.message').html(response.msg).hide().fadeIn(300).delay(4000).fadeOut(300);


			}, error: function(xhr,response,errorThrown){
				
				console.log(xhr);

			}
		});

		return false;
	});


	$('#container').on('click','.action', function(){

		var _this = $(this),
			action = _this.data('action'),
			id = _this.data('id');

		if(action=="delete"){

			$.ajax({
				url: global_url + 'ajax/delete_plan',
				type: 'POST',
				data: { 'id': id },
				dataType: 'json',
				success: function(response){

					$('#message-box .message').text( response.msg ).show();
					$('#message-box').modal('show');

					setTimeout(function(){
						$('#message-box').modal('hide');	
						_this.parent().parent().parent().remove();
					}, 1000);

				}
			});

		} else if(action=="edit"){

			$.ajax({
				url: global_url + 'ajax/getPlan',
				type: 'POST',
				data: { 'id': id },
				dataType: 'json',
				success: function(response){

					console.log(response);

					$('#myModal').modal('show');
					$('h4.modal-title').text( 'Edit a Plan' );
					$('#myModal input[name="plan_id"]').val( id );
					$('#myModal .save-entry').addClass( 'edit-entry' );

					$('input[name="plan_title"]').val( response.plan_title );
					$('textarea[name="function_description"]').val( response.function_description );

					$('select[name="behaviour_id"] option').each(function(){

						if( response.behaviour_id == $(this).attr('value') ){

							$(this).prop('selected','selected');

						}

					});

					// $('#message-box .message').text( response.msg ).show();
					// $('#message-box').modal('show');

					// setTimeout(function(){
					// 	$('#message-box').modal('hide');	
					// 	_this.parent().parent().parent().remove();
					// }, 1000);

				}
			});

		}

		return false;
	});

});