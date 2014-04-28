<section id="container" class="paddingNone">
	<!-- Tab panes -->
	<div class="tab-content">

		<div class="interval">
			<label>Graph Interval</label>
			<ul class="btn-group">
				<li><a class="btn btn-primary<?php echo ($this->uri->segment(5)=='week' ? ' active' : ''); ?>" href="<?php echo site_url('presentation/client').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>/week">Week</a></li>
				<li><a class="btn btn-primary<?php echo ($this->uri->segment(5)=='month' ? ' active' : ''); ?>" href="<?php echo site_url('presentation/client').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>/month">Month</a></li>
			</ul>
		</div>

		<?php $pmCount = 0; ?>
		<?php foreach( $planMeasures as $planMeasure ): ?>
		<div class="tab-pane<?php echo ($pmCount==0 ? ' active': ''); ?>" id="<?php echo str_replace(' ', '-', strtolower($planMeasure->measure_description) ); ?>">

			<div class="chart-parent">

				<div id="chart-<?php echo str_replace(' ', '_', strtolower($planMeasure->measure_description) ); ?>" style="height:300px; clear: both;"></div>

			</div>
			
		</div>
		<?php $pmCount++; ?>
		<?php endforeach; ?>

	</div>

</section><!-- /#container -->

	<script type="text/javascript">
		plot = new Object();
		interval = '<?php echo $this->uri->segment(5); ?>';

		$(document).ready(function(){
			<?php foreach( $measures as $measure ): ?>
				<?php $item = key($measure); ?>

				plot.<?php echo $item; ?> = <?php echo js_array( $measure[ $item ]); ?>
			<?php endforeach; ?>
		});
		
	</script>