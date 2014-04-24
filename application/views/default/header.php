<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?php echo $pageTitle; ?></title>

	<!-- CSS -->
	<?php css_parser($css); ?>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery.js"></script>

	<!-- SCRIPTS -->
	<script type="text/javascript"> 
		global_url = '<?php echo base_url(); ?>'; 
		<?php if( $this->uri->segment(3)!='' ): ?>	
		client_id = '<?php echo $this->uri->segment(3); ?>';
		plan_id = '<?php echo $this->uri->segment(4); ?>';
		<?php endif; ?>
	</script>
	<?php script_parser($scripts); ?>

	<?php if( $this->uri->segment(1)!='presentation' ): ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$().centerIcons();
		});
	</script>
	<?php endif; ?>

</head>
<body id="<?php echo $templateID; ?>"<?php echo ($templateCl != '' ? ' class="'.$templateCl.'"' : '' ) ?>>
	<header id="heading-info">
		<div id="heading-meta" class="overflow">
			<section id="user-info" class="overflow f-lt"><i class="fa fa-user fa-fw fa-2x f-lt"></i> <span class="f-lt">Welcome,<br>John Rowland</span></section>      
			<section id="page-title"><h1><?php echo $headerTitle; ?></h1></section>
			<?php if( $this->uri->segment(1)=='data' && $this->uri->segment(2)=='client' || $this->uri->segment(1)=='presentation' ): ?>
			<section id="exit" class="overflow"><a href="<?php echo site_url( 'tools/client/'.$this->uri->segment(3).'/'.$this->uri->segment(4) ); ?>" class="exit f-rt"><i class="fa fa-times fa-fw fa-2x f-lt"></i></a></section>
			<?php endif; ?>
		</div>
		<?php if($this->uri->segment(1) == 'presentation'): ?>
		<div id="client_info">
			<i class="fa fa-user fa-lg"></i> <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>
		</div><!-- #client_info -->
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="myTab">
			<?php $pmCount = 0; ?>
			<?php foreach($planMeasures as $planMeasure): ?>
			<li<?php echo ($pmCount == 0 ? ' class="active"' : ''); ?>><a href="#<?php echo str_replace(' ', '-', strtolower($planMeasure->measure_description) ); ?>" data-toggle="tab"><?php echo ucwords($planMeasure->measure_description); ?></a></li>
			<?php $pmCount++; ?>
			<?php endforeach; ?>
			<!-- <li><a href="#monthly" data-toggle="tab">Monthly</a></li> -->
		</ul>
		<?php elseif( $this->session->userdata('client_id') && $this->uri->segment(1) != 'presentation'): ?>
		<ul class="overflow clear">
			<li>
				<a href="#">
					<i class="fa fa-user fa-lg"></i> <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>
				</a>
			</li>
		</ul>
		<?php endif; ?>
	</header>
