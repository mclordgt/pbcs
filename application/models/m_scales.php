<?php
class M_scales extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function getItems( $id ){

		$this->db->order_by('scale_order','asc');
		$this->db->where( 'scale_id',$id );
		$query = $this->db->get('pbcs_b_scale_items');

		return $query->result();

	}

}