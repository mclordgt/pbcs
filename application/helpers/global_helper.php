<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('behaviour_parser')){

	function behaviour_parser(){

		$CI = get_instance();

		$CI->load->model( 'm_behaviours' );

		return $CI->m_behaviours->get_behaviours();

	}

}

if ( ! function_exists('topItem_parser')){

	function topItem_parser(){

		$CI = get_instance();

		$CI->load->model( 'm_behaviours' );

		return $CI->m_behaviours->get_topItems();

	}

}

if ( ! function_exists('function_parser')){

	function function_parser(){

		$CI = get_instance();

		$CI->load->model( 'm_functions' );

		return $CI->m_functions->getFunctions();

	}

}

if( !function_exists('client_parser') ){

	function client_parser( $clients ){

		foreach($clients as $client){ 
		?>

		<div class="pages overflow">
			<div class="page-description f-lt">
				<h3>
					<a href="<?php echo site_url().'plans/client/'.$client->client_id; ?>">
					<?php echo $client->first_name . ' ' .$client->last_name; ?>
					</a>
				</h3>
			</div>
			<ul class="page-action f-rt overflow">
				<li><a href="#" class="action" data-id="<?php echo $client->client_id; ?>" data-action="edit"><i class="fa fa-edit fa-2x"></i></a></li>
				<li><a href="#" class="action" data-id="<?php echo $client->client_id; ?>" data-action="delete"><i class="fa fa-trash-o fa-2x"></i></a></li>
			</ul>
		</div><!-- .pages-->
		
		<?php
		}

	}

}

if( !function_exists('plan_parser') ){

	function plan_parser( $plans ){

		$CI = get_instance();

		foreach($plans as $plan){ 
		?>

		<div class="pages overflow">
			<div class="page-description f-lt">
				<h3>				
					<a href="<?php echo site_url().'tools/client/'.$CI->session->userdata('client_id').'/'.$plan->plan_instance_id; ?>">
					<?php echo $plan->plan_title; ?>
					</a>
				</h3>
			</div>
			<ul class="page-action f-rt overflow cols-3">
				<li><a href="#" class="action" data-id="<?php echo $plan->plan_instance_id; ?>" data-action="edit"><i class="fa fa-edit fa-2x"></i></a></li>
				<li><a href="#" class="action" data-id="<?php echo $plan->plan_instance_id; ?>" data-action="delete"><i class="fa fa-trash-o fa-2x"></i></a></li>
			</ul>
		</div><!-- .pages-->
		
		<?php
		}

	}

}

if( !function_exists('behaviourTop_parser') ){

	function behaviourTop_parser( $bTopographies, $remove ){

		$CI = get_instance();

		$CI->load->model( 'm_plans' );

		$bTops = $CI->m_plans->getItems( 'pbcs_b_topography_items', null, null, $bTopographies );

		foreach($bTops as $bTop){ 
			$class = ( in_array($bTop->topography_id, $remove) ? ' class="hide"' : '' );
		?>
			<p data-id="<?php echo $bTop->topography_id; ?>"<?php echo $class; ?>><?php echo $bTop->topography_name; ?></p>
		<?php
		}

	}

}

if( !function_exists('tiles_content_parser') ){

	function tiles_content_parser( $table, $tile, $title, $notStrategyType=null, $onlyStrategyType=null, $join=null, $fromId=null, $joinId=null ){

		$CI = get_instance();

		$CI->load->model( 'm_plans' );

		$bTops = $CI->m_plans->getItems( $table, $notStrategyType, $onlyStrategyType, $tile, $join, $fromId, $joinId );
		?>
		<h3><?php echo ucwords(str_replace('-',' ',$title)); ?></h3>

		<hr>
		<div class="contents">
			<ul class="lists">
				<?php foreach($bTops as $bTop): ?>
				<?php $id = ( isset($bTop->topography_id) ? $bTop->topography_id : ( isset($bTop->strategy_id) ? $bTop->strategy_id : $bTop->event_id ) ); ?>
				<?php $name = ( isset( $bTop->topography_name ) ? $bTop->topography_name : ( isset($bTop->strategy_name) ? $bTop->strategy_name : $bTop->event_description ) ); ?>
				<?php $class = ( $CI->session->userdata('function') && isset($bTop->function_id) && in_array($bTop->function_id, $CI->session->userdata('function') ) ? ' class="bold underline"' : '' ); ?>
				<li<?php echo $class; ?>><?php echo $name; ?> <span data-id="<?php echo $id; ?>"<?php echo ( $CI->session->userdata($title) && in_array( $id, $CI->session->userdata($title) ) ? ' class="checked"' : '')?>></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
	}

}

if( !function_exists('function_content_parser') ){

	function function_content_parser( $table, $title ){

		$CI = get_instance();

		$CI->session->all_userdata();

		$CI->load->model( 'm_plans' );

		$bTops = $CI->m_plans->getFuncCons( $table );
		?>
		<h3><?php echo ucwords(str_replace('-',' ',$title)); ?></h3>
		
		<hr>
		<div class="contents">
			<ul class="lists">
				<?php foreach($bTops as $bTop){ ?>
				<?php $id = ( isset($bTop->function_id) ? $bTop->function_id : $bTop->consequence_id ); ?>
				<?php $name = ( isset($bTop->function_description) ? $bTop->function_description : $bTop->consequence_description ); ?>
				<li><?php echo $name; ?> <span data-id="<?php echo $id; ?>"<?php echo ( $CI->session->userdata($title) && in_array( $id, $CI->session->userdata($title) ) ? ' class="checked"' : '')?>></span></li>
				<?php } ?>
			</ul>
		</div>
		<?php
	}

}

if( !function_exists('get_scale_items') ){

	function get_scale_items( $id ){

		$CI = get_instance();

		$CI->load->model( 'm_scales' );

		$sItems = $CI->m_scales->getItems( $id );

		return $sItems;

	}

}

if( !function_exists('measure_parser') ){

	function measure_parser( $table, $title ){

		$CI = get_instance();

		$CI->load->model( 'm_common' );

		$bTops = $CI->m_plans->getFuncCons( $table );
		?>
		<h3><?php echo ucwords(str_replace('-',' ',$title)); ?></h3>
		
		<hr>
		<div class="contents">
			<ul class="lists">
				<?php foreach($bTops as $bTop){ ?>
				<?php $id = ( isset($bTop->function_id) ? $bTop->function_id : $bTop->consequence_id ); ?>
				<?php $name = ( isset($bTop->function_description) ? $bTop->function_description : $bTop->consequence_description ); ?>
				<li><?php echo $name; ?> <span data-id="<?php echo $id; ?>"<?php echo ( $CI->session->userdata($title) && in_array( $id, $CI->session->userdata($title) ) ? ' class="checked"' : '')?>></span></li>
				<?php } ?>
			</ul>
		</div>
		<?php
	}

}

if( !function_exists('get_measures') ){

	function get_measures( $behaviour_id ){
 
		$CI = get_instance();

		$CI->load->model('m_measures');

		return $CI->m_measures->get_measures( $behaviour_id );

	}

}

if( !function_exists('presentation_default') ){

	function presentation_default( $plan_id ){

		$CI = get_instance();

		$CI->load->model('m_plans');

		$plan = $CI->m_plans->getPlan( $plan_id );

		?>
		<div id="meter">
			<img src="<?php echo site_url('assets/images/presentation/meter-dummy.png'); ?>">
			<span class="es">0</span>
		</div> <!-- #meter -->

		<?php if(!$plan->onoffset): ?>
		<span id="onset" class="otime">
			<span><?php echo ( $CI->session->userdata('onset') ? $CI->session->userdata('onset') : 0); ?></span>
		</span>
		<?php else :?>
		<span id="offset" class="otime">
			<span><?php echo ( $CI->session->userdata('offset') ? $CI->session->userdata('offset') : 0); ?></span>
		</span>
		<?php endif;  ?>

		<span id="start" class="sfbutton"><img src="<?php echo site_url('assets/images/presentation/tiles/start-active.png'); ?>"></span>
		<span id="finish" class="sfbutton"><img src="<?php echo site_url('assets/images/presentation/tiles/finish-active.png'); ?>"></span>

		<div id="outburst-behaviour" class="greyBg">
			<p><?php echo $plan->behaviour_name; ?></p>
			<!-- <span id="down" class="arrow"><img src="<?php echo site_url('assets/images/presentation/tiles/arrow-down.png'); ?>"></span> -->
		</div><!-- #outburst-behaviour -->

		<div id="behaviour-label">
			<div class="bcontent">
				<?php behaviourTop_parser( 'behaviour', ( is_array($CI->session->userdata('definition')) ? $CI->session->userdata('definition') : array() ) ); ?>
			</div>
			<!-- <span id="up" class="arrow"><img src="<?php echo site_url('assets/images/presentation/tiles/arrow-up.png'); ?>"></span> -->
		</div> <!-- #behaviour-label -->

		<div id="definition">
			<h3 class="center">Definition</h3>
			<ul>
				<?php if( $CI->session->userdata('definition') ): ?>
				<?php foreach( $CI->session->userdata('definition') as $value ): ?>
				<?php $top = $CI->m_plans->getItem( 'pbcs_b_topography_items', 'topography_id', $value); ?>
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
		<?php
	}

}