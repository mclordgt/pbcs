$(function() {
	$('#start-date').datetimepicker({
		pickTime: false
	}).on('changeDate', function(){
		$(this).datetimepicker('hide');
		$('#end-date').datetimepicker({
			startDate: '+1d'
		});
		var curDate = $('#start-date input[type="text"]').val(),
		d = new Date(curDate), 
		weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		$('#start-day input[type="text"]').val( ( weekdays[ d.getDay() ] ) );
	});
	
	$('#start-time').datetimepicker({
		pickDate: false,
		pick12HourFormat: true
	});
	$('#end-date').datetimepicker({
		pickTime: false
	}).on('changeDate', function(){
		$(this).datetimepicker('hide');

		var curDate = $('#end-date input[type="text"]').val(),
		d = new Date(curDate), 
		weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		$('#end-day input[type="text"]').val( ( weekdays[ d.getDay() ] ) );
	});
	$('#end-time').datetimepicker({
		pickDate: false,
		pick12HourFormat: true
	});

	$('#date-info .label').on('click', function(){
		var timer = $(this).data('timer-type'),
		offset = $('input[name="offset"]').val() * 60,
		d = new Date(),
		weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

		$('#date-info input[name="'+timer+'-day"]').val( weekdays[ d.getDay() ] );
		$('#date-info input[name="'+timer+'-date"]').val( d.getMonth()+1+'/'+d.getDate()+'/'+d.getFullYear() );
		$('#date-info input[name="'+timer+'-time"]').val( d.toLocaleTimeString() );

		if( timer == 'end' ){
			var diff = computeDateDiff( offset ),
			interval = '',

			interval = ( diff['hour'] > 0 ? diff['hour']+ ( diff['hour'] > 1 ? ' hours ' : ' hour ' ) : '' );
			interval += ( diff['minutes'] > 0 ? diff['minutes']+ ( diff['minutes'] > 1 ? ' minutes ' : ' minute ' ) : '');
			interval += ( diff['seconds'] > 0 ? diff['seconds']+ ( diff['seconds'] > 1 ? ' seconds' : ' second' ) : '');

			$('.interval').empty().html( interval );
		}

	});

	function computeDateDiff( offset ){

		var _day = 24*60*60*1000,
		firstDate = new Date( $('#date-info input[name="start-day"]').val()+' '+$('#date-info input[name="start-date"]').val()+' '+$('#date-info input[name="start-time"]').val() );
		secondDate = new Date( $('#date-info input[name="end-day"]').val()+' '+$('#date-info input[name="end-date"]').val()+' '+$('#date-info input[name="end-time"]').val() ),
		offset = offset * 1000; 

		var diff = secondDate.getTime() - firstDate.getTime();
		s = diff/1000,
		m = s/60,
		h = m/60,
		d = h/24,
		arr = [],
		arr['hour'] = Math.floor( h ),
		arr['minutes'] = Math.floor( m - (60 * arr['hour'] ) ), 
		arr['seconds'] = Math.floor( s - (60 * arr['minutes'] ) );

		return arr;

	}

});