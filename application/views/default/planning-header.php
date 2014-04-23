<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?php echo $pageTitle; ?></title>

	<!-- CSS -->
	<?php css_parser($css); ?>

	<?php google_font_parser($gfonts); ?>

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


</head>
<body id="<?php echo $templateID; ?>"<?php echo ($templateCl != '' ? ' class="'.$templateCl.'"' : '' ) ?>>
    <div id="wrap">
        <div class="row relative">
            <p class="cols mt5 mb5"><img class="logo" src="<?php echo site_url('assets/images/presentation/signal.png'); ?>"> </p> <a href="<?php echo site_url( 'tools/client/'.$this->uri->segment(3).'/'.$this->uri->segment(4) ); ?>" class="backward"><i class="fa fa-step-backward fa-2x"></i></a>
            <a href="#" class="save-generate"><i class="fa fa-save fa-2x"></i></a> <p class="user fright mt5 mb5"> <img src="<?php echo site_url('assets/images/presentation/user.png'); ?>"> <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></p>
        </div> <!-- .row -->
