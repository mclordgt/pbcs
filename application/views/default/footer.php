	<?php if($this->uri->segment(1) == 'data'):  ?>
	<footer id="footer-block">
		<div id="footer-meta">
			<a href="#" class="submit center">
				<i class="fa fa-check fa-2x"></i><br>
				Submit
			</a>
		</div>
	</footer>

	<?php elseif( $this->uri->segment(1)!='presentation' ) : ?>

	<footer id="footer-block">
		<?php if( !in_array( $this->uri->segment(1), array('tools','presentation') ) ): ?>
		<a data-toggle="modal" href="#myModal" class="add-item item center"><i class="fa fa-plus fa-fw"></i> Add Item</a>
		<?php endif; ?>
		<div id="footer-meta">
			<ul class="overflow margin-auto">
				<li class="<?php echo ($this->uri->segment(1)=='' ? 'active-link ' : ''); ?>client-link">
					<a href="<?php echo site_url(); ?>">
					<i class="fa fa-user fa-fw fa-3x"></i> <br>
					Clients
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)=='plans' ? 'active-link ' : ''); ?>plan-link">
					<a href="<?php echo site_url( 'plans/client/'.$this->uri->segment(3) ); ?>">
					<i class="fa fa-file-text-o fa-fw fa-3x"></i> <br>
					Plans
					</a>
				</li>
				<li class="<?php echo ($this->uri->segment(1)=='tools' ? 'active-link ' : ''); ?>tools-link">
					<a href="#">
					<i class="fa fa-wrench fa-fw fa-3x"></i> <br>
					Tools
					</a>
				</li>
			</ul>
		</div>
	</footer>

	<?php endif; ?>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<?php script_parser($scripts); ?>
	
</body>
</html>