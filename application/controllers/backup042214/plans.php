<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plans extends CI_Controller {

	private $data = array();
	private $client_id;

	public function __construct() {
		
		parent::__construct();

		// Header Common 		
		$this->data['headerData']['css'][] 		= 'css/bootstrap.min.css';
		$this->data['headerData']['css'][] 		= 'css/main.css';
		$this->data['headerData']['css'][] 		= 'font-awesome/css/font-awesome.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css';
		$this->data['headerData']['scripts'][] 	= 'plugins/jquery-ui/js/jquery-ui-1.10.4.custom.min.js';
		$this->data['headerData']['scripts'][] 	= 'js/plans/ajax.js';
		$this->data['headerData']['scripts'][] 	= 'js/init.js';
		$this->data['headerData']['scripts'][] 	= 'js/common.js';

		$this->data['headerData']['headerTitle']= 'Plans';
		$this->data['headerData']['templateID']	= 'plans';
		$this->data['headerData']['templateCl']	= '';

		// Footer Common 
		$this->data['footerData']['scripts'][]	= 'js/bootstrap.min.js';
		$this->data['footerData']['scripts'][] 	= 'js/plans/plans.js';

		$this->client_id = $this->uri->segment(3);
		
		$models = array( 'm_clients','m_common' );

		$this->global_library->unset_items();

		$this->load->model( $models );

		$this->session->set_userdata( $this->m_clients->getClient( $this->client_id ) );

	}
	
	public function client()
	{
		$this->data['headerData']['pageTitle'] = 'PBCS - Plans';

		$this->data['pageData']['plans'] = $this->m_common->getAll( 'pbcs_p_instances','plan_instance_id','client_id',$this->client_id );

		$this->data['pageView'] = 'plans';

		$this->load->view('master', $this->data);
	}
}