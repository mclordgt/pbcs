<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class global_library{

	public function unset_items(){

		$CI = get_instance();

		$unset_items = array(
			'pre-cursor-events' => '',
			'onset'	=> '',
			'offset' => '',
			'post-cursor-events' => '',
			'trigger-events' => '',
			'calming-events' => '',
			'control-strategies' => '',
			'positive-reactive-strategies' => '',
			'other-reactive-strategies' => '',
			'de-escalation-strategies' => '',
			'consequences' => '',
			'escalating-events' => '',
			'definition' => '',
			'function' => ''
		);

		$CI->session->unset_userdata($unset_items);

	}

}