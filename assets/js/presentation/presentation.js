$(document).ready(function(){
	
	var plot1 = $.jqplot ('chart1', [line3, line2, line1],{
		title: { text: 'MEASURE VALUE', textColor: '#fff', fontFamily: 'Gotham Light' },
		axesDefaults: { 
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer, labelOptions: { textColor: '#fff' },
			tickRenderer: $.jqplot.CanvasAxisTickRenderer, tickOptions: { textColor: '#fff' }
		},
		axes: {
			xaxis: { label: 'Weeks', textColor: '#fff' }, 
			yaxis: { label: 'Value', textColor: '#fff' }
		},
		legend: { show: true, location: 'nw' },
		series: [{ label: 'Minimum' }, { label: 'Average' }, { label: 'Maximum' }]
	});
	
	var plot2 = $.jqplot ('chart2', [line3, line2, line1],{
		title: { text: 'MEASURE VALUE', textColor: '#fff', fontFamily: 'Gotham Light' },
		axesDefaults: { 
			labelRenderer: $.jqplot.CanvasAxisLabelRenderer, labelOptions: { textColor: '#fff' },
			tickRenderer: $.jqplot.CanvasAxisTickRenderer, tickOptions: { textColor: '#fff' }
		},
		axes: {
			xaxis: { label: 'Weeks', textColor: '#fff' }, 
			yaxis: { label: 'Value', textColor: '#fff' }
		},
		legend: { show: true, location: 'nw' },
		series: [{ label: 'Minimum' }, { label: 'Average' }, { label: 'Maximum' }]
	});

	$('#myTab a').click(function (e) {

		$(this).tab('show');

		if( $(this).attr('href') == '#monthly'){
			plot2.replot();
		}

		e.preventDefault();
	});
});