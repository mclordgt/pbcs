$.fn.centerIcons = function(){

	var _el = $(this);

	$('.pages').each(function(){
		var _ph = $('.page-description', this).outerHeight(),
			_liL = $('.page-action', this).outerHeight(),
			_nH = ( ( ( _ph - _liL ) / 16 ) / 2 ).toFixed(2);

		$(this).find('.page-action').css({ 'margin-top': _nH + 'em' });
	});

};

$.fn.getClients = function(){

	$.ajax({
		url: global_url + 'ajax/getClients',
		dataType: 'html',
		type: 'POST',
		success: function(response){

			$(response).prependTo('#container');

		}
	});

}

$.fn.getPlans = function( options ){

	var options = $.extend( options );

	$.ajax({
		url: global_url + 'ajax/getPlans',
		data: { 'client_id': options.id },
		dataType: 'html',
		type: 'POST',
		success: function(response){
			$(response).prependTo('#container');
		}
	});

}