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
					<a href="<?php echo site_url('presentation/client').'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>">
					Data Presentation
					</a>
					<?php else : ?>
					<span style="color: #d4d4d4">Data Presentation</span>
					<?php endif; ?>
				</h3>
			</div>
		</div><!-- .pages-->
	</section><!-- #container -->
