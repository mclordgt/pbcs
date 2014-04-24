$(document).ready(function(){

	$('#myTab a').click(function (e) {

		$(this).tab('show');

		$.each(plot, function(index, value){
			plot[index].replot();
		});

		e.preventDefault();
	});

});