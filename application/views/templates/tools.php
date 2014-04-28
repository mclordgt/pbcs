	<section id="container">
		<div class="pages overflow">
			<div class="page-description f-lt">
				<h3>
					<a href="<?php echo site_url( 'planning/client' ).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">
					Planning Tool
					</a>
				</h3>
			</div>
		</div><!-- .pages-->
		<div class="pages overflow">
			<div class="page-description f-lt">
				<h3>
					<?php if($checkerTopItems): ?>
					<a href="<?php echo site_url( 'data/client' ).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">
					Data Capture
					</a>
					<?php else : ?>
					<span style="color: #d4d4d4">Data Capture</span>
					<?php endif; ?>
				</h3>
			</div>
		</div><!-- .pages-->
		<div class="pages overflow">
			<div class="page-description f-lt">
				<h3>
					<?php if($checkerTopItems): ?>
					<a class="showModal" href="<?php echo site_url('presentation/client').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">
					Data Presentation
					</a>
					<?php else : ?>
					<span style="color: #d4d4d4">Data Presentation</span>
					<?php endif; ?>
				</h3>
			</div>
		</div><!-- .pages-->
	</section><!-- #container -->
		<!-- Modal -->
		<div class="modal fade" id="interval" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">

			<div class="modal-dialog">
				
				<div class="modal-content">
					<div class="modal-header">
						<ul class="overflow modal-metas">
							<li><a href="#" class="h4 modal-title" data-dismiss="modal">Close</a></li>
						</ul>
						<h4 class="modal-title">Please Select Interval to graph</h4>
					</div>
					<div class="modal-body">

						<ul class="btn-group">
							<li><a class="btn btn-success" href="<?php echo site_url('presentation/client').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>/week">Week</a></li>
							<li><a class="btn btn-success" href="<?php echo site_url('presentation/client').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>/month">Month</a></li>
						</ul>

					</div>
				</div>

			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div><!-- /.modal -->
