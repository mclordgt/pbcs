<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presentation extends CI_Controller {

	public $client_id;
	public $plan_id;

	public function __construct() {
		
		parent::__construct();

		// Header Common 		
		$this->data['headerData']['css'][] 		= 'css/bootstrap.min.css';
		$this->data['headerData']['css'][] 		= 'css/presentation.css';
		$this->data['headerData']['css'][] 		= 'font-awesome/css/font-awesome.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css';
		$this->data['headerData']['css'][] 		= 'plugins/jscrollpane/css/jquery.jscrollpane.css';
		$this->data['headerData']['gfonts'][] 	= 'Ropa+Sans:400,400italic';
		$this->data['headerData']['scripts'][] 	= 'plugins/jquery-ui/js/jquery-ui-1.10.4.custom.min.js';
		$this->data['headerData']['scripts'][] 	= 'js/presentation/ajax.js';

		$this->data['headerData']['headerTitle']= 'Plans';
		$this->data['headerData']['templateID']	= 'plans';
		$this->data['headerData']['templateCl']	= '';

		// Footer Common 
		$this->data['footerData']['scripts'][]	= 'js/bootstrap.min.js';
		$this->data['footerData']['scripts'][] 	= 'plugins/flippy/flippy.js';
		$this->data['footerData']['scripts'][] 	= 'plugins/jscrollpane/js/jquery.mousewheel.js';
		$this->data['footerData']['scripts'][] 	= 'plugins/jscrollpane/js/jquery.jscrollpane.min.js';
		$this->data['footerData']['scripts'][] 	= 'js/presentation/presentation.js';

		$this->client_id = $this->uri->segment(3);
		$this->plan_id = $this->uri->segment(4);
		
		$models = array( 'm_clients','m_plans', 'm_common' );

		$this->load->model( $models );

		$this->session->set_userdata( 'plan_id', $this->plan_id );

		$this->session->set_userdata( $this->m_clients->getClient( $this->client_id ) );

	}
	
	public function client()
	{
		$this->global_library->unset_items();
		$this->data['headerData']['pageTitle'] = 'PBCS - Presentation';

		$this->data['pageData']['plan'] = $this->m_plans->getPlan( $this->plan_id );
		$this->data['pageView'] = 'presentation';

		$this->setDefinitions();
		$this->setMeasures();
		$this->setEvents();
		$this->setStrategies();
		$this->setConsequences();
		$this->setFunctions();
		$this->setOnOffset( $this->data['pageData']['plan'] );

		$this->load->view('master-presentation', $this->data);
	}

	public function setMeasures(){

		$measures = $this->m_common->getPresentationData( 'pbcs_p_instance_measures', $this->plan_id, 'measure_id' );

		if( count($measures) > 0 )
			$this->session->set_userdata( 'measure', $measures );	

	}

	public function setDefinitions(){

		$definition = $this->m_common->getPresentationData( 'pbcs_p_instance_topography_items', $this->plan_id, 'topography_item_id' );

		if( count($definition) > 0 )
			$this->session->set_userdata( 'definition', $definition );		

	}

	public function setEvents(){

		$precursor 	= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $this->plan_id, 'event_id', 'Pre-cursor', 'event_category' );
		$postcursor = $this->m_common->getPresentationData( 'pbcs_p_instance_events', $this->plan_id, 'event_id', 'Post-cursor', 'event_category' );
		$trigger 	= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $this->plan_id, 'event_id', 'Trigger', 'event_category' );
		$escalating	= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $this->plan_id, 'event_id', 'Escalating', 'event_category' );
		$calming	= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $this->plan_id, 'event_id', 'Calming', 'event_category' );

		if( count($precursor) > 0 )
			$this->session->set_userdata( 'pre-cursor-events', $precursor );

		if( count($postcursor) > 0 )
			$this->session->set_userdata( 'post-cursor-events', $postcursor );

		if( count($trigger) > 0 )
			$this->session->set_userdata( 'trigger-events', $trigger );

		if( count($escalating) > 0 )
			$this->session->set_userdata( 'escalating-events', $escalating );

		if( count($calming) > 0 )
			$this->session->set_userdata( 'calming-events', $calming );

	}

	public function setStrategies(){

		$control 		= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $this->plan_id, 'strategy_id', 'Control', 'strategy_category' );
		$positive 		= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $this->plan_id, 'strategy_id', 'Positive-reactive', 'strategy_category' );
		$other 			= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $this->plan_id, 'strategy_id', 'Other-reactive', 'strategy_category' );
		$deescalation	= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $this->plan_id, 'strategy_id', 'De-escalation', 'strategy_category' );

		if( count($control) > 0 )
			$this->session->set_userdata( 'control-strategies', $control );

		if( count($positive) > 0 )
			$this->session->set_userdata( 'positive-reactive-strategies', $positive );

		if( count($other) > 0 )
			$this->session->set_userdata( 'other-reactive-strategies', $other );

		if( count($deescalation) > 0 )
			$this->session->set_userdata( 'de-escalation-strategies', $deescalation );

	}

	public function setConsequences(){

		$consequence = $this->m_common->getPresentationData( 'pbcs_p_instance_consequences', $this->plan_id, 'consequence_id' );

		if( count($consequence) > 0 )
			$this->session->set_userdata( 'consequences', $consequence );	

	}

	public function setFunctions(){

		$function = $this->m_common->getPresentationData( 'pbcs_p_instance_functions', $this->plan_id, 'function_id' );		

		if( count($function) > 0 )
			$this->session->set_userdata( 'function', $function );	
	}

	public function setOnOffset( $planData ){

		$this->session->set_userdata( 'onset', $planData->onset );
		$this->session->set_userdata( 'offset', $planData->offset );

	}
}