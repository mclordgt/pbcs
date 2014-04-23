	<div class="centerpiece">
		<div class="cols col161">
			<ul class="tiles">
				<li id="positive-reactive-strategies" class="box-dimension manage review">
					<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/positive-reactive-strategies-blur.png'); ?>"></p>
				</li>
				<li id="control-strategies" class="box-dimension mt10 mb10 manage review">
					<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/control-strategies-blur.png'); ?>"></p>
				</li>
				<li id="pre-cursor-events" class="box-dimension describe review activeTile">
					<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/pre-cursor-events-active.png'); ?>"></p>
				</li>
			</ul> <!-- .tiles -->
		</div><!-- .cols -->
		<div class="cols col500 ml10 mr10">
			<div id="content" class="flipbox-container">
				<div class="flipbox default">
					<div id="meter">
						<img src="<?php echo site_url('assets/images/presentation/meter-dummy.png'); ?>">
						<span class="es">0</span>
					</div> <!-- #meter -->
					<?php if(!$plan->onoffset): ?>
					<span id="onset" class="otime">
						<span><?php echo $this->session->userdata('onset'); ?></span>
					</span>
					<?php else : ?>
					<span id="offset" class="otime">
						<span><?php echo $this->session->userdata('offset'); ?></span>
					</span>
					<?php endif; ?>
					<span id="start" class="sfbutton"><img src="<?php echo site_url('assets/images/presentation/tiles/start-active.png'); ?>"></span>
					<span id="finish" class="sfbutton"><img src="<?php echo site_url('assets/images/presentation/tiles/finish-active.png'); ?>"></span>

					<div id="outburst-behaviour" class="greyBg">
						<p><?php echo $plan->behaviour_name; ?></p>
						<!-- <hr> -->
						<!-- <span id="down" class="arrow"><img src="<?php #echo site_url('assets/images/presentation/tiles/arrow-down.png'); ?>"></span> -->
					</div><!-- #outburst-behaviour -->

					<div id="behaviour-label">
						<div class="bcontent">
							<?php behaviourTop_parser('behaviour', ( $this->session->userdata('definition') ? $this->session->userdata('definition') : array() ) ); ?>
						</div>
						<!-- <span id="up" class="arrow"><img src="<?php #echo site_url('assets/images/presentation/tiles/arrow-up.png'); ?>"></span> -->
					</div> <!-- #behaviour-label -->

					<div id="definition">
						<h3 class="center">Definition</h3>
						<ul>
							<?php if( $this->session->userdata('definition') ): ?>
							<?php foreach( $this->session->userdata('definition') as $value ): ?>
							<?php $top = $this->m_plans->getItem( 'pbcs_b_topography_items', 'topography_id', $value); ?>
							<li data-id="<?php echo $value; ?>"><?php echo $top->topography_name; ?></li>
							<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div> <!-- #definition -->
					<div id="left-wave">
						<span id="three" class="point"><img src="<?php echo site_url('assets/images/presentation/3.png'); ?>"></span>
						<span id="two" class="point"><img src="<?php echo site_url('assets/images/presentation/2.png'); ?>"></span>
						<span id="tool1" class="tooltips"><img src="<?php echo site_url('assets/images/presentation/tooltip.png'); ?>"></span>
						<span id="one" class="point"><img src="<?php echo site_url('assets/images/presentation/1.png'); ?>"></span>
					</div>
					<div id="right-wave">&nbsp;</div>
				</div> <!-- .flipbox -->
			</div> <!-- #content -->
		</div> <!-- .cols -->
		<div class="cols col161">
			<ul class="tiles">
				<li id="other-reactive-strategies" class="box-dimension manage review">
					<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/other-reactive-strategies-blur.png'); ?>"></p>
				</li>
				<li id="de-escalation-strategies" class="box-dimension mt10 mb10 manage review">
					<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/restoring-events-blur.png'); ?>"></p>
				</li>
				<li id="post-cursor-events"  class="box-dimension describe review activeTile">
					<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/post-cursor-events-active.png'); ?>"></p>
				</li>
			</ul> <!-- .tiles -->
		</div><!-- .cols -->
		<span class="clear">&nbsp;</span>
	</div> <!-- .row -->
	<div class="row">
		<ul class="row fleft tiles">
			<li id="escalating-events" class="cols box-dimension mr10p5 understand review">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/escalating-events-blur.png'); ?>"></p>
			</li>
			<li id="calming-events" class="cols box-dimension mr10p5 understand review">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/calming-events-blur.png'); ?>"></p>
			</li>
			<li id="trigger-events" class="cols box-dimension mr10p5 understand review">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/trigger-events-blur.png'); ?>"></p>
			</li>
			<li id="function" class="cols box-dimension mr10p5 understand review">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/function-blur.png'); ?>"></p>
			</li>
			<li id="consequences" class="cols box-dimension understand review">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/consequences-blur.png'); ?>"></p>
			</li>
		</ul> <!-- .row -->
	</div> <!-- .row -->
	<div class="row mt20">
		<ul id="main-navi" class="row fleft">
			<li id="describe" class="cols box-dimension2 mr10p5">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/describe-active.png'); ?>"></p>
			</li>
			<li id="understand" class="cols box-dimension2 mr10p5">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/understand-blur.png'); ?>"></p>
			</li>
			<li id="manage" class="cols box-dimension2 mr10p5">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/manage-blur.png'); ?>"></p>
			</li>
			<li id="review" class="cols box-dimension2">
				<p class="center"><img src="<?php echo site_url('assets/images/presentation/tiles/review-blur.png'); ?>"></p>
			</li>
		</ul> <!-- #main-navi -->
	</div>  <!-- .row -->

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

		<div class="modal-dialog">

			<div class="modal-content">
				<input type="hidden" name="client_id" value="<?php echo $this->session->userdata('client_id'); ?>">
				<div class="modal-header">

					<ul class="overflow modal-metas">
						<li><a href="#" class="h4 modal-title save-entry">Save</a></li>
						<li><a href="#" class="h4 modal-title" data-dismiss="modal">Close</a></li>
					</ul>
					<h4 class="modal-title bold"><span class="onoffset"></span> Time</h4>

				</div>
				<div class="modal-body">

					<p class="message"></p>

					<div class="form-group">

						<label for="minutes">Minutes</label>
						<select name="minutes" class="form-control">
							<?php for($i=1;$i<=60;$i++): ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?> Minute(s)</option>
							<?php endfor; ?>
						</select>

					</div><!-- .form-group -->

				</div>
			</div>

		</div><!-- /.modal-dialog -->

	</div><!-- /.modal -->

	<!-- Modal -->
	<div class="modal fade" id="measures" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

		<div class="modal-dialog">

			<div class="modal-content">
				<input type="hidden" name="client_id" value="<?php echo $this->session->userdata('client_id'); ?>">
				<div class="modal-header">

					<ul class="overflow modal-metas">
						<li><a href="#" class="h4 modal-title save-entry">Save</a></li>
						<li><a href="#" class="h4 modal-title" data-dismiss="modal">Close</a></li>
					</ul>
					<h4 class="modal-title bold">Measures</h4>

				</div>
				<div class="modal-body">

					<p class="message"></p>

					<div class="form-group">

						<label for="minutes">Minutes</label>

						<div class="checkboxes">
							<?php $measures = get_measures( $plan->behaviour_id ); ?>
							<?php foreach( $measures as $measure ): ?>
							<label>
								<?php if( $this->session->userdata('measure') && in_array($measure->measure_id, $this->session->userdata('measure')) ): ?>
									<?php $checked = ' checked'; ?>
								<?php else : ?>
									<?php $checked = ''; ?>
								<?php endif; ?>
								<input type="checkbox" value="<?php echo $measure->measure_id; ?>"<?php echo $checked; ?>> <?php echo $measure->measure_description; ?>
							</label>
							<?php endforeach; ?>
						</div>

					</div><!-- .form-group -->

				</div>
			</div>

		</div><!-- /.modal-dialog -->

	</div><!-- /.modal -->

	<!-- Modal -->
	<div class="modal fade" id="save-generate-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

		<div class="modal-dialog">

			<div class="modal-content">
				<input type="hidden" name="client_id" value="<?php echo $this->session->userdata('client_id'); ?>">
				<div class="modal-header">

					<ul class="overflow modal-metas">
						<li><a href="#" class="h4 modal-title" data-dismiss="modal">Close</a></li>
					</ul>
					<h4 class="modal-title bold">Behaviour Data</h4>

				</div>
				<div class="modal-body">

					<p class="message"></p>

					<div id="save-input" class="form-group">

						<label>Do you want to save the input data?</label>

						<ul class="choice">
							<li class="yes">Yes</li>
							<li class="no">No</li>
						</ul>

					</div><!-- .form-group -->
					<div id="generate-report" class="form-group">

						<label>Do you want to generate a report for this plan?</label>

						<ul class="choice">
							<li class="yes">Yes</li>
							<li class="no">No</li>
						</ul>

					</div><!-- .form-group -->

					<div id="email-address" class="form-group">

						<label>Please enter email address to send it to</label>

						<input type="text" name="author_email" id="author-email">

						<input type="submit" name="send-report" id="send-report" value="Send Report">
						<i id="spinner" class="fa fa-spinner fa-lg fa-spin hide"></i>

					</div><!-- .form-group -->

				</div>
			</div>

		</div><!-- /.modal-dialog -->

	</div><!-- /.modal -->