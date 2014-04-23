<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends CI_Controller {

	private $data = array();

	public function __construct() {
		
		parent::__construct();

		// Header Common 		
		$this->data['headerData']['css'][] 		= 'css/bootstrap.min.css';
		$this->data['headerData']['css'][] 		= 'css/main.css';
		$this->data['headerData']['css'][] 		= 'font-awesome/css/font-awesome.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css';
		$this->data['headerData']['scripts'][] 	= 'plugins/jquery-ui/js/jquery-ui-1.10.4.custom.min.js';
		$this->data['headerData']['scripts'][] 	= 'js/clients/ajax.js';
		$this->data['headerData']['scripts'][] 	= 'js/init.js';
		$this->data['headerData']['scripts'][] 	= 'js/common.js';

		$this->data['headerData']['headerTitle']= 'Clients';
		$this->data['headerData']['templateID']	= 'clients';
		$this->data['headerData']['templateCl']	= '';

		// Footer Common 
		$this->data['footerData']['scripts'][]	= 'js/bootstrap.min.js';
		$this->data['footerData']['scripts'][] 	= 'js/clients/clients.js';

		$this->load->model( array('m_clients','m_common') );


	}
	
	public function index()
	{
		$this->data['headerData']['pageTitle'] = 'PBCS - Clients';
		
		$this->data['pageData']['clients'] = $this->m_common->getAll('pbcs_clients','client_id');

		$this->data['pageView'] = 'clients';

		$this->load->view('master', $this->data);
	}
}