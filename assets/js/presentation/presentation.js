$(document).ready(function(){

	var count = Object.keys(plot).length;
	chart = new Object();

	$.each(plot, function(indexKey, value){

		chart[indexKey] = $.jqplot ('chart-'+indexKey, value,{
			title: { text: indexKey.replace('_', ' ').toUpperCase(), textColor: '#fff', fontFamily: 'Gotham Light' },
			axesDefaults: { 
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer, labelOptions: { textColor: '#fff' },
				tickRenderer: $.jqplot.CanvasAxisTickRenderer, tickOptions: { textColor: '#fff' }
			},
			axes: {
				xaxis: { 
					renderer: $.jqplot.DateAxisRenderer,
					tickOptions:{formatString:'%b %#d \'%y'},
					label: interval.toUpperCase()+'S', textColor: '#fff',
					tickInterval: '1 '+interval
				}, 
				yaxis: { label: 'VALUE', textColor: '#fff' }
			},
			legend: { show: true, location: 'nw' },
			series: [{ label: 'Maximum' }, { label: 'Mean' }, { label: 'Minimum' }]
		});

	});

	$('#myTab a').click(function (e) {

		$(this).tab('show');

		$.each(chart, function(index){
			chart[index].replot();
		});

		e.preventDefault();
	});


});