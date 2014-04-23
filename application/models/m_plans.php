<?php
class M_plans extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function getPlan( $id ){

		$this->db->from('pbcs_p_instances A');
		$this->db->join('pbcs_behaviours B', 'B.behaviour_id = A.behaviour_id');
		$this->db->where('plan_instance_id', $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function getItems($table, $notStrategyType=null, $onlyStrategyType=null, $topCat=null, $join=null, $fromId=null, $joinId=null){

		$this->db->from($table);

		if($join!=null){
			$this->db->select( $table.'.*,function_id' );
			$this->db->join($join, $joinId.' = '.$fromId, 'left');
			$this->db->order_by( 'function_id','DESC');
		}

		if($topCat!=null){
			$this->db->where($topCat, 1);	
		}
		
		if( $notStrategyType != null ){
			$this->db->where('strategey_type !=', $notStrategyType);	
		}

		if( $onlyStrategyType != null ){
			$this->db->where('strategey_type =', $onlyStrategyType);	
		}

		$query = $this->db->get();

		return $query->result();

	}

	public function getItem( $table, $primary_key, $id ){

		$this->db->where( $primary_key, $id );
		$query = $this->db->get( $table );

		return $query->row();

	}

	public function getFuncCons( $table ){

		$query = $this->db->get( $table );

		return $query->result();

	}

	public function is_exists( $data ){

		extract( $data );

		$this->db->like('plan_title',$plan_title);		
		$this->db->like('behaviour_id',$behaviour_id);		
		$this->db->from('pbcs_p_instances');	
		
		if( $this->db->count_all_results() > 0 ){
			return true;
		} else {
			return false;
		}

	}

}