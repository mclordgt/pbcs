$(function(){

  //   $( "#birthdate" ).datepicker({
  //   	yearRange: '1900:2014',
  //   	dateFormat: 'dd-mm-yy',
		// changeMonth: true,
		// changeYear: true
  //   });

	$('.add-item').click(function(){
		$('#myModal').modal();
		$('h4.modal-title').text( 'Add Client' );
		if( $( '.save-entry' ).hasClass('edit-entry') ){
			$( '.save-entry' ).removeClass('edit-entry');
		}
	});

	$('#myModal').on('hidden.bs.modal', function (e) {

		$(this).find('form')[0].reset();

	});

	// $('.page-description h3').click(function(){
	// 	var radio = $('input[name="client_link"]', this),
	// 		client_link = radio.val();
		
	// 	radio.prop('checked','checked');

	// 	$('.plan-link a').css({ 'opacity':'1', 'cursor':'pointer' });
	// 	$('.plan-link a').prop('href', client_link);
	// });

	// $('input[name="client_link"]').change(function(){
	// 	var client_link = $(this).val();

	// 	$('.plan-link a').css({ 'opacity':'1', 'cursor':'pointer' });
	// 	$('.plan-link a').prop('href', client_link);
	// });

	// $('.plan-link a').click(function(){
	// 	var plan_link = $(this).attr('href');

	// 	if(plan_link == '#'){

	// 		$('#message-box').modal();
	// 		$('#message-box .message').text( 'Please select a plan to continue, thank you!' ).addClass('error').show();

	// 		setTimeout(function(){
	// 			$('#message-box').modal('hide');	
	// 		}, 1000);

	// 		return false;
	// 	} 
	// });

});