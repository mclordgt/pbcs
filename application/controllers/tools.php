<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller {

	private $data = array();
	private $client_id;
	private $plan_id;

	public function __construct() {
		
		parent::__construct();

		// Header Common 		
		$this->data['headerData']['css'][] 		= 'css/bootstrap.min.css';
		$this->data['headerData']['css'][] 		= 'css/main.css';
		$this->data['headerData']['css'][] 		= 'font-awesome/css/font-awesome.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css';
		$this->data['headerData']['scripts'][] 	= 'plugins/jquery-ui/js/jquery-ui-1.10.4.custom.min.js';
		$this->data['headerData']['scripts'][] 	= 'js/tools/ajax.js';
		$this->data['headerData']['scripts'][] 	= 'js/init.js';

		$this->data['headerData']['headerTitle']= 'Tools';
		$this->data['headerData']['templateID']	= 'tools';
		$this->data['headerData']['templateCl']	= '';

		// Footer Common 
		$this->data['footerData']['scripts'][]	= 'js/bootstrap.min.js';
		$this->data['footerData']['scripts'][] 	= 'js/tools/tools.js';

		$this->client_id = $this->uri->segment(3);
		$this->plan_id = $this->uri->segment(4);
		
		$models = array( 'm_clients','m_common' );

		$this->global_library->unset_items();

		$this->load->model( $models );

		$this->session->set_userdata( $this->m_clients->getClient( $this->client_id ) );


	}
	
	public function client()
	{
		$this->data['headerData']['pageTitle'] = 'PBCS - Tools';
		
		$this->data['pageData']['clients'] = $this->m_common->getAll('pbcs_clients','client_id');
		$this->data['pageData']['checkerTopItems'] = $this->m_common->checkPlanInstanceTopography( $this->plan_id );

		$this->data['pageView'] = 'tools';

		$this->load->view('master', $this->data);
	}
}