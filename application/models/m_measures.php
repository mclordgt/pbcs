<?php
class M_measures extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function get_measures( $behaviour_id ){

		$this->db->where( 'behaviour_id', $behaviour_id );
		$query = $this->db->get( 'pbcs_b_measures' );

		return $query->result();

	}

	public function get_measure_id( $plan_id ){

		$this->db->select( 'A.measure_id, B.measure_description' );
		$this->db->where( 'plan_instance_id', $plan_id );
		$this->db->from( 'pbcs_p_instance_measures A' );
		$this->db->join( 'pbcs_b_measures B', 'B.measure_id=A.measure_id' );
		$query = $this->db->get();

		return $query->result();

	}

	public function checkDuration( $plan_id, $duration ){

		$this->db->select('B.measure_description');
		$this->db->where( 'plan_instance_id', $plan_id );
		$this->db->where( 'B.measure_description', $duration );
		$this->db->from( 'pbcs_p_instance_measures A' );
		$this->db->join( 'pbcs_b_measures B', 'B.measure_id=A.measure_id' );
		$query = $this->db->get();

		if( $query->num_rows() > 0 ){
			return true;
		} else {
			return false;
		}

	}

	public function getMeasureIDValue( $plan_id ){

		$this->db->select( 'measure_id,measure_value' );
		$this->db->from( 'pbcs_b_instance_measures' );
		$this->db->where( 'plan_instance_id', $plan_id );
		$query = $this->db->get();

		$array = array();

		foreach ($query->result() as $key ) {
			if( $key->measure_id != 0 )
			$array[$key->measure_id] = $key->measure_value;
		}

		return $array;

	}

	public function getBInstance( $plan_id ){

		$this->db->where( 'plan_instance_id',$plan_id );
		$query = $this->db->get( 'pbcs_b_instances' );

		return $query->result();

	}

}