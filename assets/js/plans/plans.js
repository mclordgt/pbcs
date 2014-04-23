$(function(){

	$('.add-item').click(function(){
		$('#myModal').modal();
		$('h4.modal-title').text( 'Add a Plan' );
		if( $( '.save-entry' ).hasClass('edit-entry') ){
			$( '.save-entry' ).removeClass('edit-entry');
		}
	});

	$('#myModal').on('hidden.bs.modal', function (e) {

		$(this).find('form')[0].reset();

	});
	
	// $('input[name="plan_instance_id"]').change(function(){
	// 	var plan_link = $(this).val();

	// 	$('.tools-link a').css({ 'opacity':'1', 'cursor':'pointer' });
	// 	$('.tools-link a').prop('href', plan_link);
	// });

	// $('.tools-link a').click(function(){
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