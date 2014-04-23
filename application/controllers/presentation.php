<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presentation extends CI_Controller {

	public $client_id;
	public $plan_id;

	public function __construct() {
		
		parent::__construct();

		// Header Common 		
		$this->data['headerData']['css'][] 		= 'css/bootstrap.min.css';
		$this->data['headerData']['css'][] 		= 'css/main.css';
		$this->data['headerData']['css'][] 		= 'plugins/jqplot/jquery.jqplot.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jqplot/syntaxhighlighter/styles/shCoreDefault.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jqplot/syntaxhighlighter/styles/shThemejqPlot.min.css';
		$this->data['headerData']['css'][] 		= 'font-awesome/css/font-awesome.min.css';
		$this->data['headerData']['css'][] 		= 'plugins/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css';
		$this->data['headerData']['scripts'][] 	= 'plugins/jquery-ui/js/jquery-ui-1.10.4.custom.min.js';
		$this->data['headerData']['scripts'][] 	= 'js/presentation/ajax.js';
		$this->data['headerData']['scripts'][]	= 'plugins/jqplot/jquery.jqplot.min.js';
		// $this->data['headerData']['scripts'][] 	= 'js/init.js';
		// $this->data['headerData']['scripts'][] 	= 'js/common.js';

		$this->data['headerData']['headerTitle']= 'Presentation';
		$this->data['headerData']['templateID']	= 'presentation';
		$this->data['headerData']['templateCl']	= '';

		// Footer Common 
		$this->data['footerData']['scripts'][]	= 'js/bootstrap.min.js';
		
		$this->data['footerData']['scripts'][]	= 'plugins/jqplot/syntaxhighlighter/scripts/shCore.min.js';
		$this->data['footerData']['scripts'][]	= 'plugins/jqplot/syntaxhighlighter/scripts/shBrushJScript.min.js';
		$this->data['footerData']['scripts'][]	= 'plugins/jqplot/syntaxhighlighter/scripts/shBrushXml.min.js';
		$this->data['footerData']['scripts'][]	= 'plugins/jqplot/plugins/jqplot.canvasTextRenderer.min.js';
		$this->data['footerData']['scripts'][]	= 'plugins/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js';
		$this->data['footerData']['scripts'][] 	= 'js/presentation/presentation.js';

		$this->client_id = $this->uri->segment(3);
		
		$models = array( 'm_clients','m_plans', 'm_common' );
		$this->load->model( $models );

		$this->global_library->unset_items();

		$this->session->set_userdata( $this->m_clients->getClient( $this->client_id ) );

	}
	
	public function client()
	{
		$this->global_library->unset_items();
		$this->data['headerData']['pageTitle'] = 'PBCS - Presentation';

		$this->data['pageData']['plan'] = $this->m_plans->getPlan( $this->plan_id );
		$this->data['pageView'] = 'presentation';

		$this->load->view('master', $this->data);
	}

}