
	<section id="container">

		<?php foreach($clients as $client): ?>

		<div class="pages overflow">
			<div class="page-description f-lt">
				<h3>
					<!-- <input type="radio" name="client_link" value="<?php #echo site_url().'plans/client/'.$client->client_id; ?>"> -->
					<a href="<?php echo site_url().'plans/client/'.$client->client_id; ?>">
					<?php echo $client->first_name . ' ' .$client->last_name; ?>
					</a>
				</h3>
				<!-- <p>Lorem ipsum sit dolor amet something this is only a sample text</p> -->
			</div>
			<ul class="page-action f-rt overflow">
				<!-- <li><a href="<?php #echo site_url(); ?>plans/client/<?php #echo $client->client_id; ?>"><i class="fa fa-info-circle fa-2x"></i></a></li> -->
				<li><a href="#" class="action" data-id="<?php echo $client->client_id; ?>" data-action="edit"><i class="fa fa-edit fa-2x"></i></a></li>
				<li><a href="#" class="action" data-id="<?php echo $client->client_id; ?>" data-action="delete"><i class="fa fa-trash-o fa-2x"></i></a></li>
			</ul>
		</div><!-- .pages-->

		<?php endforeach; ?>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

			<div class="modal-dialog">
				
				<form id="modal-form" class="modal-content" role="form">
					<input type="hidden" name="client_id">
					<div class="modal-header">
						<!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
						<ul class="overflow modal-metas">
							<li><a href="#" class="h4 modal-title save-entry">Save</a></li>
							<li><a href="#" class="h4 modal-title" data-dismiss="modal">Close</a></li>
						</ul>
						<h4 class="modal-title bold">Add Client</h4>

					</div>
					<div class="modal-body">

						<p class="message"></p>

						<div class="form-group">

							<label for="first_name">First Name</label>
							<input type="text" class="form-control" name="first_name">

						</div><!-- .form-group -->
						<div class="form-group">

							<label for="last_name">Last Name</label>
							<input type="text" class="form-control" name="last_name">

						</div><!-- .form-group -->
						<div class="form-group">

							<label for="birthdate" style="clear:left">Date of Birth</label>
							<div class="date-group">
								<input type="text" class="form-control" name="birthday" id="birthday" max="2" min="1" placeholder="day e.g (01-31)">
								<input type="text" class="form-control" name="birthmonth" id="birthmonth" max="2" min="1" placeholder="month e.g (01-12)">
								<input type="text" class="form-control" name="birthyear" id="birthyear" max="4" min="4" placeholder="year e.g (1980, 1995)">
							</div>

						</div><!-- .form-group -->
						
					</div>
<!-- 					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div> -->
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