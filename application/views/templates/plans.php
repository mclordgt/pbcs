<section id="container">
	<?php if( count($plans) > 0 ): ?>
	<?php foreach($plans as $plan): ?>
	<div class="pages overflow">
		<div class="page-description f-lt">
			<h3>
				<!-- <input type="radio" name="plan_instance_id" value="">  -->
				<a href="<?php echo site_url().'tools/client/'.$this->session->userdata('client_id').'/'.$plan->plan_instance_id; ?>">
				<?php echo $plan->plan_title; ?>
				</a>
			</h3>
			<!-- <p>Lorem ipsum sit dolor amet something this is only a sample text</p> -->
		</div>
		<ul class="page-action f-rt overflow">
			<!-- <li><a href="<?php #echo site_url(); ?>presentation/client/<?php #echo $plan->client_id; ?>/<?php echo $plan->plan_instance_id; ?>" data-title="" data-placement="bottom" rel="tooltip"><i class="fa fa-info-circle fa-2x"></i></a></li> -->
			<li><a href="#" class="action" data-id="<?php echo $plan->plan_instance_id; ?>" data-action="edit" data-title="Edit Plan" data-placement="bottom" rel="tooltip" ><i class="fa fa-edit fa-2x"></i></a></li>
			<li><a href="#" class="action" data-id="<?php echo $plan->plan_instance_id; ?>" data-action="delete" data-title="Delete Plan" data-placement="bottom" rel="tooltip"><i class="fa fa-trash-o fa-2x"></i></a></li>
		</ul>
	</div><!-- .pages-->
	<?php endforeach; ?>
	<?php else : ?>
		<script type="text/javascript">
			$(function(){
				setTimeout(function(){
					$('#myModal').modal();	
				}, 1000);
			});
		</script>
	<?php endif; ?>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

		<div class="modal-dialog">

			<form id="modal-form" class="modal-content" role="form">
				<input type="hidden" name="client_id" value="<?php echo $this->session->userdata('client_id'); ?>">
				<input type="hidden" name="plan_id">
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
					<ul class="overflow modal-metas">
						<li><a href="#" class="h4 modal-title save-entry">Save</a></li>
						<li><a href="#" class="h4 modal-title" data-dismiss="modal">Close</a></li>
					</ul>
					<h4 class="modal-title bold">Add a Plan</h4>

				</div>
				<div class="modal-body">

					<p class="message"></p>

					<div class="form-group">

						<label for="first_name">Plan Title</label>
						<input type="text" name="plan_title" id="plan_title" class="form-control">

					</div><!-- .form-group -->

					<div class="form-group">

						<label for="first_name">Behaviour</label>
						<select class="form-control" name="behaviour_id" id="behaviour_id">
							<option value="0">Please select a behaviour</option>
							<?php $behaviours = behaviour_parser(); ?>
							<?php foreach( $behaviours as $behaviour ): ?>
							<option value="<?php echo $behaviour->behaviour_id; ?>"><?php echo $behaviour->behaviour_name; ?></option>
						<?php endforeach; ?>
						</select>

					</div><!-- .form-group -->

					<div class="form-group">

						<label for="first_name">Description</label>
						<textarea class="form-control" id="function_description" name="function_description"></textarea>

					</div><!-- .form-group -->

				</div>
			</form>

		</div><!-- /.modal-dialog -->

	</div><!-- /.modal -->
	
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

</section><!-- #container -->