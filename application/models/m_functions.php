<?php
class M_functions extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function getFunctions(){

		$query = $this->db->get( 'pbcs_p_functions' );

		return $query->result();

	}

}