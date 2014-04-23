<?php
class M_behaviours extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function get_behaviours(){

		$this->db->where( 'active',0);
		$query = $this->db->get( 'pbcs_behaviours' );

		return $query->result();

	}

	public function get_topItems(){

		$query = $this->db->get( 'pbcs_b_topography_items' );

		return $query->result();

	}

}