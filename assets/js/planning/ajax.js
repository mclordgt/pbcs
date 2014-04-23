$(function(){

	$('#save-input .choice li').click(function(){
		var _class = $(this).attr('class');

		if( _class=='no' ){
			$('#save-generate-modal').modal('hide');
		} else {

			$.ajax({
				url: global_url+'ajax/save_presentation',
				data: { plan_id: plan_id },
				type: 'POST',
				dataType: 'json'
			});
			
			$('#save-input').slideToggle('slow');
			$('#generate-report').slideToggle('slow');

		}

	});

	$('#email-address input[name="send-report"]').click(function(){

		var _email = $('#author-email').val();
		
		$('.message').removeClass('error');
		$('.message').empty();

		if( validateEmail( _email ) ){

			$.ajax({
				url: global_url+'ajax/generate_report',
				type: 'POST',
				data: { plan_id: plan_id, client_id: client_id, author_email: _email },
				beforeSend: function(){
					$('#spinner').removeClass('hide');
				},
				success: function(response){

					if(response){

						var msg = "The report was sent to your email successfully, you will be redirected to the Tools Page";
						$('.message').removeClass('error');

					} else {

						var msg = "Unable to send the report to your email please try again.";
						$('.message').addClass('error');

					}
					
					$('#spinner').addClass('hide');
					$('.message').html(msg).hide().fadeIn(300).delay(4000).fadeOut(300);

					if(response){
						setTimeout(function(){
							window.location.href=global_url+"tools/client/"+client_id+"/"+plan_id;
					 	}, 1000);
					}
					
				}
			});



		} else {

			var msg = 'Please provide a valid email for the report to send to, Thanks!';
			$('.message').addClass('error');
			$('.message').html(msg).hide().fadeIn(300).delay(4000).fadeOut(300);

		}

		return false;
	});

	function validateEmail( _email ){

		var _result;

		$.ajax({
			url: global_url+'ajax/validateEmail',
			type: 'POST',
			data: { author_email: _email },
			async: false,
			dataType: 'json',
			success: function(response){

				_result = response;

			}

		});

		return _result;

	}

});