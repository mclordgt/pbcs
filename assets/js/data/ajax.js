$(function(){

	$('.submit').click(function(){

		var action 	= $('input[name="action"]').val(),
			start 	= $('input[name="start-date"]').val(),
			sTime	= $('input[name="start-time"]').val(),
			end		= $('input[name="end-date"]').val(),
			eTime	= $('input[name="end-time"]').val(),
			notes	= $('textarea[name="notes"]').val(),
			biid	= $('input[name="behaviour_instance_id"]').val(),
			outcome = $('#form form').serialize(),
			data 	= { plan_id: plan_id, biid: biid, start: start +' '+sTime, end: end +' '+eTime, outcome: outcome, notes: notes };

			if( validate() > 0){
				alert(1);
			} else {
				$.ajax({
					url: global_url + 'ajax/'+action,
					type: 'POST',
					data: data,
					dataType: 'json',
					success: function(response){

						$('#message-box .message').text( response.msg ).show();

						if( response.stats == 'ok' ){

							$('#message-box').modal();
							setTimeout(function(){
								window.location.href=global_url+"tools/client/"+client_id+"/"+plan_id;
							}, 5000);

						} else {

							$('#message-box').modal();
							setTimeout(function(){
								$('#message-box').modal('hide');	
							}, 1000);

						}
					}
				});
			}

		return false;

	});

	function validate(){

		var sTime	= $('input[name="start-time"]'),
			eTime	= $('input[name="end-time"]'),
			notes	= $('textarea[name="notes"]'),
			err		= 0;

		if( sTime.val() =='' ){
			sTime.css( { 'border':'1px solid red'} );
			err++;
		} else {
			sTime.css( { 'border':'1px solid #fff'} );
		}

		if( eTime.val() =='' ){
			eTime.css( { 'border':'1px solid red'} );
			err++;
		} else {
			eTime.css( { 'border':'1px solid #fff'} );
		}

		if( notes.val() =='' ){
			notes.css( { 'border':'1px solid red'} );
			err++;
		} else {
			notes.css( { 'border':'1px solid #fff'} );
		}

		return err;

	}

});