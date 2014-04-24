	<section id="container">
		<div id="client-info">
			<h2 class="bold">Client: <?php echo $this->session->userdata('first_name'); ?> <?php echo $this->session->userdata('last_name'); ?></h2>
			<h3>Behaviour: <?php echo $plan->behaviour_name; ?></h3>
		</div><!-- #client-info -->

		<div id="date-info">

			<div class="overflow">
				<span class="f-lt">Start Time</span>
				<span class="start-btn label f-rt" data-timer-type="start">Start Timer <i class="fa fa-play fa-fw"></i></span>
			</div>

			<div class="datetime overflow">
				<div id="start-day">
					<!-- <input type="text" name="start-day" disabled placeholder="DAY" value="<?php #echo ( isset( $instance[0]->start ) ? date( 'D', strtotime($instance[0]->start) ) : '' ); ?>"> -->
					<input type="text" name="start-day" disabled placeholder="DAY">
				</div>
				<div id="start-date" class="input-append">
					<!-- <input data-format="MM/dd/yyyy" type="text" name="start-date" disabled placeholder="DATE" value="<?php #echo ( isset( $instance[0]->start ) ? date( 'm/j/Y', strtotime($instance[0]->start) ) : '' ); ?>"> -->
					<input data-format="MM/dd/yyyy" type="text" name="start-date" disabled placeholder="DATE">
					<span class="add-on">
						<i class="fa fa-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
				</div>
				<div id="start-time" class="input-append">
					<!-- <input data-format="HH:mm:ss PP" type="text" name="start-time" disabled placeholder="TIME" value="<?php #echo ( isset( $instance[0]->start ) ? date( 'h:i:s A', strtotime($instance[0]->start) ) : '' ); ?>"> -->
					<input data-format="HH:mm:ss PP" type="text" name="start-time" disabled placeholder="TIME">
					<span class="add-on">
						<i class="fa fa-clock-o" data-time-icon="icon-time" data-date-icon="icon-calendar">
						</i>
					</span>
				</div>
			</div><!-- .datetime -->

			<?php if($duration): ?>

			<hr class="dotted">

			<div class="overflow">
				<span class="f-lt">End Time</span>
				<span class="end-btn label f-rt" data-timer-type="end">End Timer <i class="fa fa-stop fa-fw"></i></span>
			</div>

			<div class="datetime overflow">
				<div id="end-day">
					<!-- <input type="text" name="end-day" disabled placeholder="DAY" value="<?php #echo ( isset( $instance[0]->end ) ? date( 'D', strtotime($instance[0]->end) ) : '' ); ?>"> -->
					<input type="text" name="end-day" disabled placeholder="DAY">
				</div>
				<div id="end-date" class="input-append">
					<!-- <input data-format="MM/dd/yyyy" type="text" name="end-date" disabled placeholder="DATE" value="<?php #echo ( isset( $instance[0]->end ) ? date( 'm/j/Y', strtotime($instance[0]->end) ) : '' ); ?>"> -->
					<input data-format="MM/dd/yyyy" type="text" name="end-date" disabled placeholder="DATE">
					<span class="add-on">
						<i class="fa fa-calendar" data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
					</span>
				</div>
				<div id="end-time" class="input-append">
					<!-- <input data-format="HH:mm:ss PP" type="text" name="end-time" disabled placeholder="TIME" value="<?php #echo ( isset( $instance[0]->end ) ? date( 'h:i:s A', strtotime($instance[0]->end) ) : '' ); ?>"> -->
					<input data-format="HH:mm:ss PP" type="text" name="end-time" disabled placeholder="TIME">
					<span class="add-on">
						<i class="fa fa-clock-o" data-time-icon="icon-time" data-date-icon="icon-calendar">
						</i>
					</span>
				</div>
			</div><!-- .datetime -->

			<?php endif; ?>

		</div><!-- #date-info -->

		<div id="form-info">
			<h2 class="uppercase">Episodic Severity</h2>
			<hr class="dotted"/>

			<?php if( $duration ) :?>
			<input type="hidden" name="offset" value="<?php echo $plan->offset; ?>">

			<p class="duration">Total Duration: <span class="interval">xx minutes</span></p>
			<br>
			<?php endif; ?>

			<div id="form" class="form-sections">
				<!-- <input type="hidden" name="action" value="<?php #echo (count($selected) > 0 ? 'edit_data': 'save_data'); ?>"> -->
				<!-- <input type="hidden" name="behaviour_instance_id" value="<?php #echo (count($selected) > 0 ? $instance[0]->behaviour_instance_id : ''); ?>"> -->

				<form method="POST">

					<?php foreach( $measures as $measure ): ?>
					<?php $scaleItems = get_scale_items( $measure->measure_id ); ?>
						<p><?php echo $measure->measure_description; ?></p>
						<select name="<?php echo $measure->measure_id; ?>">
							<option value="0">Select Outcome</option>
							<?php foreach($scaleItems as $scaleItem): ?>
							<!-- <option value="<?php echo $scaleItem->scale_item_id; ?>"<?php #echo (isset( $selected[$measure->measure_id] ) && $selected[$measure->measure_id] == $scaleItem->scale_item_id ? ' selected': ''); ?>><?php echo $scaleItem->scale_description; ?></option> -->
							<option value="<?php echo $scaleItem->scale_item_id; ?>"><?php echo $scaleItem->scale_description; ?></option>
							<?php endforeach; ?>
						</select>
						
					<?php endforeach; ?>

					<p>Notes</p>
					<!-- <textarea name="notes"><?php #echo ( isset($instance[0]->notes) ? $instance[0]->notes : '' ); ?></textarea> -->
					<textarea name="notes"></textarea>

				</form>

			</div><!-- #form -->

		</section><!-- #container -->
		<!-- Modal -->
		<div class="modal fade" id="message-box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

			<div class="modal-dialog">
				
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title bold">Alert</h4>

					</div>
					<div class="modal-body">

						<p class="message"></p>
						
					</div>
				</div>

			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->