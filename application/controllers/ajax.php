<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	private $data = array();

	public function __construct() {
		
		parent::__construct();
		
		$this->load->model( 'm_common' );
	}	

	public function graphValues(){

		extract($_POST);

		$this->load->model( 'm_presentation' );
		$measures = array();

		$planMeasures = $this->m_presentation->getPlanMeasures( $plan_id );

		foreach( $planMeasures as $measure ){
			$measures[] = $this->m_presentation->getMinAvgMax( $client_id, $measure->measure_id, $interval );	
		}
		foreach( $measures as $k ){
			$item = key($k);
			$plot[$item] = array( $k[$item]['min'], $k[$item]['avg'], $k[$item]['max'] );
		}

		echo json_encode($plot);
	}

	public function validateEmail(){

		extract($_POST);

		$this->load->library( 'form_validation' );
		$this->form_validation->set_rules( 'author_email', 'Author Email', 'required|valid_email' );

		echo json_encode($this->form_validation->run());

	}

	public function generate_report(){

		extract($_POST);

		$this->load->model( array( 'm_clients', 'm_plans' ) );
		$clientInfo = $this->m_clients->getClient( $client_id );
		$planInfo = $this->m_plans->getPlan( $plan_id );

		include APPPATH."third_party/PhpOffice/PhpWord/Autoloader.php";
		include APPPATH."third_party/PhpOffice/PhpWord/PhpWord.php";

		\PhpOffice\PhpWord\Autoloader::register();

		$word = new \PhpOffice\PhpWord\PhpWord();

		$document = $word->loadTemplate(APPPATH."third_party/PhpOffice/resources/Sample_07_TemplateCloneRow.docx");

		$client = $clientInfo->first_name." ".$clientInfo->last_name;
		$birthdate = date( 'F j, Y', strtotime($clientInfo->birthdate) );

		//Events
		$precursor 		= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $plan_id, 'event_id', 'Pre-cursor', 'event_category' );
		$postcursor 	= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $plan_id, 'event_id', 'Post-cursor', 'event_category' );
		$escalating		= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $plan_id, 'event_id', 'Escalating', 'event_category' );
		$trigger 		= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $plan_id, 'event_id', 'Trigger', 'event_category' );
		$calming		= $this->m_common->getPresentationData( 'pbcs_p_instance_events', $plan_id, 'event_id', 'Calming', 'event_category' );

		//Strategies
		$positive 		= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $plan_id, 'strategy_id', 'Positive-reactive', 'strategy_category' );
		$control 		= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $plan_id, 'strategy_id', 'Control', 'strategy_category' );
		$other 			= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $plan_id, 'strategy_id', 'Other-reactive', 'strategy_category' );
		$deescalation	= $this->m_common->getPresentationData( 'pbcs_p_instance_strategies', $plan_id, 'strategy_id', 'De-escalation', 'strategy_category' );

		//Others
		$function 		= $this->m_common->getPresentationData( 'pbcs_p_instance_functions', $plan_id, 'function_id' );		
		$consequence 	= $this->m_common->getPresentationData( 'pbcs_p_instance_consequences', $plan_id, 'consequence_id' );

		$preCount = count($precursor);
		$postCount = count($postcursor);
		$escCount = count($escalating);
		$triCount = count($trigger);
		$calCount = count($calming);

		$funCount = count($function);
		$cosCount = count($consequence);

		$posCount = count($positive);
		$conCount = count($control);
		$othCount = count($other);
		$deeCount = count($deescalation);

		$document->cloneRow('precursor', $preCount);
		$document->cloneRow('postcursor', $postCount);
		$document->cloneRow('escalating', $escCount);
		$document->cloneRow('trigger', $triCount);
		$document->cloneRow('calming', $calCount);

		$document->cloneRow('function', $funCount);
		$document->cloneRow('consequence', $cosCount);

		$document->cloneRow('positive', $posCount);
		$document->cloneRow('control', $conCount);
		$document->cloneRow('other', $othCount);
		$document->cloneRow('deescalation', $deeCount);

		//Events
		for($i=0;$i<=$preCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_b_topography_items', $precursor[$i], 'topography_name', 'topography_id' );
			$document->setValue('precursor#'.$n, $item);	

		}

		for($i=0;$i<=$postCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_b_topography_items', $postcursor[$i], 'topography_name', 'topography_id' );
			$document->setValue('postcursor#'.$n, $item);	

		}

		for($i=0;$i<=$escCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_events', $escalating[$i], 'event_description', 'event_id' );
			$document->setValue('escalating#'.$n, $item);	

		}

		for($i=0;$i<=$triCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_events', $trigger[$i], 'event_description', 'event_id' );
			$document->setValue('trigger#'.$n, $item);	

		}

		for($i=0;$i<=$calCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_events', $calming[$i], 'event_description', 'event_id' );
			$document->setValue('calming#'.$n, $item);	

		}

		//Strategies
		for($i=0;$i<=$posCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_strategies', $positive[$i], 'strategy_name', 'strategy_id' );
			$document->setValue('positive#'.$n, $item);	

		}

		for($i=0;$i<=$conCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_strategies', $control[$i], 'strategy_name', 'strategy_id' );
			$document->setValue('control#'.$n, $item);	

		}

		for($i=0;$i<=$othCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_strategies', $other[$i], 'strategy_name', 'strategy_id' );
			$document->setValue('other#'.$n, $item);	

		}

		for($i=0;$i<=$deeCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_strategies', $deescalation[$i], 'strategy_name', 'strategy_id' );
			$document->setValue('deescalation#'.$n, $item);	

		}

		for($i=0;$i<=$funCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_functions', $function[$i], 'function_description', 'function_id' );
			$document->setValue('function#'.$n, $item);	

		}

		for($i=0;$i<=$cosCount-1;$i++){

			$n = $i + 1;
			$item = $this->m_common->getItemDescription( 'pbcs_p_consequences', $consequence[$i], 'consequence_description', 'consequence_id' );
			$document->setValue('consequence#'.$n, $item);	

		}

		$document->setValue('client_name', $client);
		$document->setValue('date_now', date('F j, Y') );
		$document->setValue('birthdate', $birthdate);
		$document->setValue('plan_title', $planInfo->plan_title);
		$document->setValue('behaviour', $planInfo->behaviour_name);

		$filename = $clientInfo->first_name."-".$clientInfo->last_name.'-'.str_replace( ' ', '-', $planInfo->plan_title).'-'.date('d-m-Y').'.docx';
		$attachment = 'assets/files/'.$filename;
		$document->saveAs( $attachment );

		// echo json_encode( $this->sendReportEmail( $author_email,$client,$attachment ) );

	}

	public function sendReportEmail($email,$name,$file){

		$this->load->library( 'email' );

		$config['protocol'] = 'smtp';
		//$config['charset'] = '/usr/sbin/sendmail';
		$config['charset'] = 'utf-8';
		$config['smtp_timeout'] = 5;
		$config['smtp_host'] = 'smtp.mandrillapp.com';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'rob@principalcreative.com.au';
		$config['smtp_pass'] = 'S1Zn1BetxJqabfDYiAnIlg'; 

		$this->email->initialize($config);

		$this->email->from('rob@principalcreative.com.au', 'PBCS');
		$this->email->to($email);
		$this->email->subject( 'PBCS report - '.$name );
		$this->email->message('You have generated a report for '.$name);
		$this->email->attach($file);
		
		if( $this->email->send() ){
			return true;
		} else {
			return $this->email->print_debugger();
		}

	}

	public function getClient(){

		extract($_POST);

		$client = $this->m_common->getItem( 'pbcs_clients', 'client_id', $id );

		echo json_encode( $client );

	}

	public function save_data(){

		extract($_POST);
		parse_str( $outcome, $test );

		$start_time = date( 'Y-m-d H:i:s', strtotime($start) );
		$end_time 	= date( 'Y-m-d H:i:s', strtotime($end) );

		$data = array(
				'plan_instance_id'	=> $plan_id,
				'start'				=> $start_time,
				'end'				=> $end_time,
				'notes'				=> $notes
			);

		$behaviour_instance_id = $this->m_common->insert( 'pbcs_b_instances', $data );

		foreach( $test as $k => $v ){

			$data_instance = array(
					'plan_instance_id'	=> $plan_id,
					'behaviour_instance_id'	=> $behaviour_instance_id,
					'measure_id'			=> $k,
					'measure_value'			=> $v
				);

			$valid = $this->m_common->insert( 'pbcs_b_instance_measures', $data_instance );
		}

		if( is_numeric( $valid ) ){

			$return['stats'] = 'ok';
			$return['msg']	 = 'You have successfully saved data';

		} else {

			$return['stats'] = 'error';
			$return['msg']	 = 'An error has occurred while saving data, please try again';			

		}

		echo json_encode($return);

	}

	public function edit_data(){

		extract($_POST);
		parse_str( $outcome, $test );

		$start_time = date( 'Y-m-d H:i:s', strtotime($start) );
		$end_time 	= date( 'Y-m-d H:i:s', strtotime($end) );

		$data = array(
				'start'				=> $start_time,
				'end'				=> $end_time,
				'notes'				=> $notes
			);

		$this->m_common->update( 'pbcs_b_instances', $data, 'behaviour_instance_id', $biid );

		foreach( $test as $k => $v ){

			// var_dump($k);

			$data_instance = array(
					'measure_value'			=> $v
				);

			$valid = $this->m_common->updateMany( 'pbcs_b_instance_measures', $data_instance, 'behaviour_instance_id', $biid, 'measure_id', $k );
		}

		if( $valid ){

			$return['stats'] = 'ok';
			$return['msg']	 = 'You have successfully edited data';

		} else {

			$return['stats'] = 'error';
			$return['msg']	 = 'An error has occurred while editing data, please try again';			

		}

		echo json_encode($return);

	}

	public function save_presentation(){

		extract( $_POST );

		foreach( $this->session->all_userdata() as $userKey => $userValue ){

			switch( $userKey ){

				case 'onset':
					$table = 'pbcs_p_instances';

					$data = array(
							'onset'	=> $userValue
						);

					$this->m_common->update( $table, $data, 'plan_instance_id', $plan_id );
				break;

				case 'offset':
					$table = 'pbcs_p_instances';

					$data = array(
							'offset'	=> $userValue
						);

					$this->m_common->update( $table, $data, 'plan_instance_id', $plan_id );
				break;

				case 'measure':
					$table = 'pbcs_p_instance_measures';
					$data = array();

					$this->m_common->deleteMissing( $table, $userValue[0], 'measure_id', 'plan_instance_id', $plan_id );

					foreach( $userValue[0] as $uK => $uV ){

						$data = array(
							'plan_instance_id'	=> $plan_id,
							'measure_id' => $uV
							);

						$this->m_common->updateInsert( $table, $data, 'plan_measure_id' );

						$data = array();

					}

				break;

				case 'definition':

					$table = 'pbcs_p_instance_topography_items';
					$this->m_common->deleteMissing( $table, $userValue, 'topography_item_id', 'plan_instance_id', $plan_id );

					foreach( $userValue as $uV ){

						$data = array(
							'plan_instance_id'	=> $plan_id,
							'topography_item_id'=> $uV

							);
						$this->m_common->updateInsert( $table, $data, 'plan_topography_item_id' );

					}

				break;

				case 'function':

					$table = 'pbcs_p_instance_functions';
					$this->m_common->deleteMissing( $table, $userValue, 'function_id', 'plan_instance_id', $plan_id );

					foreach( $userValue as $uV ){

						$data = array(
							'plan_instance_id'	=> $plan_id,
							'function_id'=> $uV

							);
						$this->m_common->updateInsert( $table, $data, 'instance_function_id' );

					}

				break;

				case 'consequences':

					$table =  'pbcs_p_instance_consequences';
					$this->m_common->deleteMissing( $table, $userValue, 'consequence_id', 'plan_instance_id', $plan_id );

					foreach( $userValue as $uV ){

						$data = array(
							'consequence_id'	=> $uV,
							'plan_instance_id'	=> $plan_id
							);
				 	$this->m_common->updateInsert( $table, $data, 'instance_consequence_id' );

					}

				break;

				case 'pre-cursor-events':
				case 'post-cursor-events':
				case 'escalating-events':
				case 'calming-events':
				case 'trigger-events':

					$key = ucwords( str_replace( '-events', '', $userKey ) );
					$table = 'pbcs_p_instance_events';
					$this->m_common->deleteMissing( $table, $userValue, 'event_id', 'plan_instance_id', $plan_id, 'event_category', $key );

					foreach( $userValue as $uV ){

						$data = array(
							'plan_instance_id'	=> $plan_id,
							'event_id'			=> $uV,
							'event_category'	=> $key
							);

						$this->m_common->updateInsert( $table, $data, 'instance_event_id' );

					}

				break;

				case 'positive-reactive-strategies':
				case 'other-reactive-strategies':
				case 'control-strategies':
				case 'de-escalation-strategies':

					$key = ucwords( str_replace( '-strategies', '', $userKey ) );
					$table = 'pbcs_p_instance_strategies';
					$this->m_common->deleteMissing( $table, $userValue, 'strategy_id', 'plan_instance_id', $plan_id, 'strategy_category', $key );

					foreach( $userValue as $uV ){

						$data = array(
							'plan_instance_id'	=> $plan_id,
							'strategy_id'		=> $uV,
							'strategy_category'	=> $key
							);

						$this->m_common->insert( $table, $data );
						$this->m_common->updateInsert( $table, $data, 'instance_strategy_id' );
					}

				break;

			}		

		}

	}

	public function addToSession(){

		extract($_POST);

		if( isset( $clear ) ){

			$this->session->unset_userdata( $key ); 

		}

		if( $this->session->userdata( $key ) ){
			
			$array = $this->session->userdata( $key );
			if( isset( $single ) ){
				$array = $value;
			} else {
				$array[] = $value;	
			}

			$this->session->set_userdata( $key, $array );

		} else {
			if( isset( $single ) ){
				$array = $value;
			} else {
				$array = array( $value );
			}
			
			$this->session->set_userdata( $key, $array );
		}

		echo json_encode( $this->session->userdata( $key ) );

	}

	public function removeFromSession(){

		extract($_POST);

		$array = array( $value );

		$selArray = $this->session->userdata( $key );

		$this->session->set_userdata( $key, array_diff( $selArray, $array ) );

		echo json_encode( $this->session->userdata( $key ) );

	}

	public function clearSession(){

		extract($_POST);

		$unset_items = array( $key => '' ); 

		$this->session->unset_userdata($unset_items);

		echo json_encode($this->session->userdata($key));

	}

	public function presentation(){

		extract($_POST);

		switch($tile){

			case 'pre-cursor-events':
				echo tiles_content_parser( 'pbcs_b_topography_items', 'precursor', $tile);
			break;

			case 'post-cursor-events':
				echo tiles_content_parser( 'pbcs_b_topography_items', 'postcursor', $tile);
			break;

			case 'positive-reactive-strategies':
				echo tiles_content_parser( 'pbcs_p_strategies', 'reactive', $tile, null, 1, 'pbcs_p_function_categories', 'pbcs_p_function_categories.strategy_id', 'pbcs_p_strategies.strategy_id');
			break;

			case 'other-reactive-strategies':
				echo tiles_content_parser( 'pbcs_p_strategies', null, $tile, 1, null);
			break;

			case 'control-strategies':
				echo tiles_content_parser( 'pbcs_p_strategies', 'control', $tile);
			break;

			case 'de-escalation-strategies':
				echo tiles_content_parser( 'pbcs_p_strategies', 'de_escalatic', $tile);
			break;

			case 'escalating-events':
				echo tiles_content_parser( 'pbcs_p_events', 'escalating', $tile);
			break;

			case 'calming-events':
				echo tiles_content_parser( 'pbcs_p_events', 'calming', $tile);
			break;

			case 'trigger-events':
				echo tiles_content_parser( 'pbcs_p_events', 'event_trigger', $tile);
			break;

			case 'function':
				echo function_content_parser( 'pbcs_p_functions', $tile );
			break;

			case 'consequences':
				echo function_content_parser( 'pbcs_p_consequences', $tile );
			break;

			default:
				echo presentation_default( $plan_id );
			break;

		}

	}

	//Clients
	public function getPlans(){

		$plans = $this->m_common->getAll( 'pbcs_p_instances', 'plan_instance_id','client_id',$this->input->post( 'client_id' ) );
		echo plan_parser( $plans );

	}

	//Plans
	public function save_plan(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules( 'plan_title','Plan Title','required' );
		$this->form_validation->set_rules( 'behaviour_id','Behaviour','required|is_natural_no_zero' );

		$this->form_validation->set_error_delimiters('<span>', '</span>');

		if($this->form_validation->run()!==FALSE){

			extract($_POST);

			$this->load->model( 'm_plans' );

			$data = array(
					'client_id'				=> $client_id,
					'plan_title'			=> ucwords($plan_title),
					'behaviour_id'			=> $behaviour_id,
					'function_description'	=> $function_description,
					'date_created'			=> date('Y-m-d H:i:s')
				);

			$return = array();

			if( !$this->m_plans->is_exists($data) ){

				$insert_id = $this->m_common->insert('pbcs_p_instances',$data);

				if( is_numeric( $insert_id ) ){

					$return['stats'] = 'ok';
					$return['msg']	 = 'You have successfully added a plan';

				} else {

					$return['stats'] = 'error';
					$return['msg']	 = 'An error has occurred while saving a plan, please try again';			

				}

			} else {

				$return['stats'] = 'error';
				$return['msg']	 = 'Plan already exists on the database';			

			}

		} else {

			$return['stats'] = 'error';
			$return['msg']	 = 'Validation Error';	

			$return['validation']['plan_title'] = form_error('plan_title');
			$return['validation']['behaviour_id'] = form_error('behaviour_id');

		}

		echo json_encode($return);

	}

	//Plans
	public function edit_plan(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules( 'plan_title','Plan Title','required' );
		$this->form_validation->set_rules( 'behaviour_id','Behaviour','required|is_natural_no_zero' );

		$this->form_validation->set_error_delimiters('<span>', '</span>');

		if($this->form_validation->run()!==FALSE){

			extract($_POST);

			$this->load->model( 'm_plans' );

			$data = array(
					'client_id'				=> $client_id,
					'plan_title'			=> ucwords($plan_title),
					'behaviour_id'			=> $behaviour_id,
					'function_description'	=> $function_description,
					'date_created'			=> date('Y-m-d H:i:s')
				);

			$return = array();
			
			$update = $this->m_common->update('pbcs_p_instances',$data,'plan_instance_id',$plan_id );

			if( $update ){

				$return['stats'] = 'ok';
				$return['msg']	 = 'You have successfully edited a plan';

			} else {

				$return['stats'] = 'error';
				$return['msg']	 = 'An error has occurred while editing a plan, please try again';			

			}

		} else {

			$return['stats'] = 'error';
			$return['msg']	 = 'Validation Error';	

			$return['validation']['plan_title'] = form_error('plan_title');
			$return['validation']['behaviour_id'] = form_error('behaviour_id');

		}

		echo json_encode($return);

	}

	public function getPlan(){

		extract($_POST);

		$this->load->model( 'm_plans' ); 

		echo json_encode( $this->m_plans->getPlan( $id ) );
	}

	public function delete_plan(){

		extract( $_POST );

		$return = array();

		//TABLE, FIELD, ID
		if( $this->m_common->delete( 'pbcs_p_instances', 'plan_instance_id', $id ) ){

			$return['stats'] 	= 'ok';
			$return['msg'] 		= 'You have deleted a plan successfully';

		} else {

			$return['stats'] 	= 'error';
			$return['msg'] 		= 'An error occured while trying to delete a plan';

		}

		echo json_encode($return);

	}


	//Clients
	public function getClients(){

		//TABLE, ORDER_FIELD, ID_FIELD=null, ID=null
		echo client_parser( $this->m_common->getAll( 'pbcs_clients','client_id' ) );

	}
	
	public function save_entry(){

		// extract($_POST);

		$this->load->library('form_validation');

		$this->form_validation->set_rules( 'first_name','First Name','required' );
		$this->form_validation->set_rules( 'last_name','Last Name','required' );
		$this->form_validation->set_rules( 'birthdate','Birthdate','required' );

		$this->form_validation->set_error_delimiters('<span>', '</span>');

		if($this->form_validation->run()!==FALSE){

			extract($_POST);

			$this->load->model( 'm_clients' );

			$data = array(
					'first_name' 	=> ucwords( $first_name ),
					'last_name'		=> ucwords( $last_name ),
					'birthdate'		=> date('Y-m-d', strtotime($birthdate)),
					'active'		=> 0
				);

			$return = array();

			if( !$this->m_clients->is_exists($data) ){

				$insert_id = $this->m_common->insert('pbcs_clients',$data);

				if( is_numeric( $insert_id ) ){

					$return['stats'] = 'ok';
					$return['msg']	 = 'You have successfully added a client';

				} else {

					$return['stats'] = 'error';
					$return['msg']	 = 'An error has occurred while saving an client, please try again';			

				}

			} else {

				$return['stats'] = 'error';
				$return['msg']	 = 'Client already exists on the database';			

			}

		} else {

			$return['stats'] = 'error';
			$return['msg']	 = 'Validation Error';	

			$return['validation']['first_name'] = form_error('first_name');
			$return['validation']['last_name'] = form_error('last_name');
			$return['validation']['birthdate'] = form_error('birthdate');

		}

		echo json_encode($return);

	}

	public function edit_entry(){

		// extract($_POST);

		$this->load->library('form_validation');

		$this->form_validation->set_rules( 'first_name','First Name','required' );
		$this->form_validation->set_rules( 'last_name','Last Name','required' );
		$this->form_validation->set_rules( 'birthdate','Birthdate','required' );

		$this->form_validation->set_error_delimiters('<span>', '</span>');

		if($this->form_validation->run()!==FALSE){

			extract($_POST);

			$this->load->model( 'm_clients' );

			$data = array(
					'first_name' 	=> ucwords( $first_name ),
					'last_name'		=> ucwords( $last_name ),
					'birthdate'		=> date('Y-m-d', strtotime($birthdate)),
					'active'		=> 0
				);

			$return = array();

			$update = $this->m_common->update('pbcs_clients',$data,'client_id',$id);

			if( $update ){

				$return['stats'] = 'ok';
				$return['msg']	 = 'You have successfully edited a client';

			} else {

				$return['stats'] = 'error';
				$return['msg']	 = 'An error has occurred while editing a client, please try again';			

			}

		} else {

			$return['stats'] = 'error';
			$return['msg']	 = 'Validation Error';	

			$return['validation']['first_name'] = form_error('first_name');
			$return['validation']['last_name'] = form_error('last_name');
			$return['validation']['birthdate'] = form_error('birthdate');

		}

		echo json_encode($return);

	}

	public function delete_entry(){

		extract( $_POST );

		$return = array();

		//TABLE, FIELD, ID
		if( $this->m_common->delete( 'pbcs_clients', 'client_id', $id ) ){

			$return['stats'] 	= 'ok';
			$return['msg'] 		= 'You have deleted a client successfully';

		} else {

			$return['stats'] 	= 'error';
			$return['msg'] 		= 'An error occured while trying to delete a client';

		}

		echo json_encode($return);

	}

	public function delete_session(){

		$this->session->sess_destroy();

	}

}