<?php
class M_clients extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function getClient( $id ){

		$this->db->where('client_id',$id);
		$query = $this->db->get('pbcs_clients');

		return $query->row();

	}

	public function is_exists( $data ){

		extract( $data );

		$this->db->like('first_name',$first_name);		
		$this->db->like('last_name',$last_name);		
		$this->db->like('birthdate',$birthdate);	
		$this->db->from('pbcs_clients');	
		
		if( $this->db->count_all_results() > 0 ){
			return true;
		} else {
			return false;
		}

	}

}