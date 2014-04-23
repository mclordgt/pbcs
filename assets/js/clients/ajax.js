$(function(){

	$('#container').on('click', '.save-entry', function(){
		
		var first_name = $('input[name="first_name"]').val(),
			last_name = $('input[name="last_name"]').val(),
			birthday = $('input[name="birthday"]').val(),
			birthmonth = $('input[name="birthmonth"]').val(),
			birthyear = $('input[name="birthyear"]').val(),
			birthdate = birthyear+'-'+birthmonth+'-'+birthday;

			var d = new Date( birthdate );

			if( d.getMonth() != birthmonth && d.getDate() != birthday ){

				$('.message').addClass('error');
				$('.message').html("Please follow date format on date of birth field").hide().fadeIn(300).delay(4000).fadeOut(300);
				return false;

			}

			if( $(this).hasClass('edit-entry') ){
				var client_id = $('input[name="client_id"]').val(),
					url = global_url + 'ajax/edit_entry',
					data = { 'first_name': first_name, 'last_name': last_name, 'birthdate': birthdate, id: client_id };
			} else {
				var url = global_url + 'ajax/save_entry',
					data = { 'first_name': first_name, 'last_name': last_name, 'birthdate': birthdate };
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

							$('input[name="'+k+'"]').parent().find('label span').remove();
							$('input[name="'+k+'"]').parent().find('label').append(v);

						});

					}

					$('.message').addClass('error');

				} else {

					$('.message').removeClass('error');
					$('#modal-form input').val('');
					$('.pages').remove();
					$().getClients();
					// $().centerIcons();

				}

				$('.message').html(response.msg).hide().fadeIn(300).delay(4000).fadeOut(300);

				if(response.stats != 'error'){

					setTimeout(function(){
						$('#myModal').modal('hide');
					}, 1000);

				}

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
				url: global_url + 'ajax/delete_entry',
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

		} else if(action=="edit") {

			$('.message').empty();
			$('#modal-form label span').remove();

			$.ajax({
				url: global_url + 'ajax/getClient',
				type: 'POST',
				data: { 'id': id },
				dataType: 'json',
				success: function(response){

					$('#myModal').modal('show');
					$('#myModal input[name="client_id"]').val( id );
					$('h4.modal-title').text( 'Edit Client' );
					$('#myModal .save-entry').addClass( 'edit-entry' );

					$('input[name="first_name"]').val( response.first_name );
					$('input[name="last_name"]').val( response.last_name );

					var d = new Date( response.birthdate ),
						sel_date = d.getDate(),
						sel_month = d.getMonth() + 1,
						sel_year = d.getFullYear(),
						fDate = sel_date +'-'+ sel_month +'-'+ sel_year;
					
					$('input[name="birthday"]').val( sel_date );
					$('input[name="birthmonth"]').val( sel_month );
					$('input[name="birthyear"]').val( sel_year );
					// console.log( fDate );

					// $('input[name="first_name"]').val( response.first_name );
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