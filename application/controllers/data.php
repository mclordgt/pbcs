<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {

	private $data = array();
	private $client_id;
	private $plan_id;

	public function __construct() {
		
		parent::__construct();

		// Header Common 		
		$this->data['headerData']['css'][] 		= 'css/bootstrap.min.css';
		$this->data['headerData']['css'][] 		= 'css/main.css';
		$this->data['headerData']['css'][] 		= 'font-awesome/css/font-awesome.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/datetimepicker/css/bootstrap-datetimepicker.min.css';
		$this->data['headerData']['scripts'][] 	= 'js/data/ajax.js';
		$this->data['headerData']['scripts'][] 	= 'js/init.js';
		$this->data['headerData']['scripts'][] 	= 'js/common.js';

		$this->data['headerData']['headerTitle']= 'Data Capture';
		$this->data['headerData']['templateID']	= 'data';
		$this->data['headerData']['templateCl']	= 'data-capture';

		// Footer Common 
		$this->data['footerData']['scripts'][]	= 'js/bootstrap.min.js';
		$this->data['footerData']['scripts'][]	= 'plugins/datetimepicker/js/bootstrap-datetimepicker.min.js';
		$this->data['footerData']['scripts'][] 	= 'js/data/data.js';
		
		$this->load->model( array('m_clients','m_common') );

		$this->client_id = $this->uri->segment(3);
		$this->plan_id = $this->uri->segment(4);
		
		$models = array( 'm_clients','m_plans','m_measures','m_common' );

		$this->load->model( $models );

		$this->session->set_userdata( $this->m_clients->getClient( $this->client_id ) );

	}
	
	public function client()
	{
		$this->data['headerData']['pageTitle'] = 'PBCS - Data Capture';
		
		$this->data['pageData']['measures'] = $this->m_measures->get_measure_id( $this->plan_id );
		$this->data['pageData']['duration']	= $this->m_measures->checkDuration( $this->plan_id, 'Duration' );
		$this->data['pageData']['plan'] = $this->m_plans->getPlan( $this->plan_id );
		$this->data['pageData']['selected'] = $this->m_measures->getMeasureIDValue( $this->plan_id );
		$this->data['pageData']['instance'] = $this->m_measures->getBInstance( $this->plan_id );

		$this->data['pageView'] = 'data';

		$this->load->view('master', $this->data);
	}
}