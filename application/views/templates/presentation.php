<section id="container" class="paddingNone">

	<!-- Tab panes -->
	<div class="tab-content">
		<?php $pmCount = 0; ?>
		<?php foreach( $planMeasures as $planMeasure ): ?>
		<div class="tab-pane<?php echo ($pmCount==0 ? ' active': ''); ?>" id="<?php echo str_replace(' ', '-', strtolower($planMeasure->measure_description) ); ?>">
			<h4><?php echo ucwords( $planMeasure->measure_description ); ?> Measure of Value</h4>

			<div class="chart-parent">
				<div id="chart<?php echo $pmCount+1; ?>" style="height:300px;"></div>
			</div>
			
		</div>
		<?php $pmCount++; ?>
		<?php endforeach; ?>
	</div>

	<script type="text/javascript">

		var plot = new Object();

		<?php $iCount = 1; ?>
		<?php foreach( $measures as $measure ): ?>
			<?php $item = key($measure); ?>

			plot.plot<?php echo $iCount; ?> = $.jqplot ('chart<?php echo $iCount; ?>', <?php echo js_array( $measure[ $item ] ); ?>,{
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
				series: [{ label: 'Maximum' }, { label: 'Average' }, { label: 'Minimum' }]
			});

			<?php $iCount++; ?>
		<?php endforeach; ?>

		var details = <?php echo $iCount-1; ?>
		
	</script>

</section><!-- /#container -->