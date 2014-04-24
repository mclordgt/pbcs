<?php
class M_presentation extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function getPlanMeasures( $plan_id ){

		$this->db->from( 'pbcs_b_instance_measures A' );
		$this->db->join( 'pbcs_b_measures B', 'B.measure_id = A.measure_id' );
		$this->db->where( 'plan_instance_id', $plan_id );
		$this->db->group_by( 'A.measure_id' );
		$query = $this->db->get();

		return $query->result();

	}

	public function getMinAvgMax( $client_id, $measure_id ){

		$return = array();

		$sql = "select extract(week from bi.start) as week, min(bim.measure_value) as minimum, avg(bim.measure_value) as average, max(bim.measure_value) as maximum, bm.measure_description as description from (pbcs_clients as pc inner join pbcs_p_instances as pi on pc.client_id = pi.client_id ) inner join ( pbcs_b_measures as bm inner join ( pbcs_b_instances as bi inner join pbcs_b_instance_measures as bim on bi.behaviour_instance_id = bim.behaviour_instance_id ) on bm.measure_id=bim.measure_id) on pi.plan_instance_id = bi.plan_instance_id group by extract(week from bi.start), pc.client_id, bim.measure_id having ( ( pc.client_id = ? ) AND ( bim.measure_id = ? ) )";		
		$query = $this->db->query( $sql, array( $client_id, $measure_id ) );

		foreach( $query->result() as $res ){
			$temp = str_replace(' ', '_', strtolower( $res->description ) ); 
			$return[ $temp ]['min'][] = [ (int)$res->week, (int)$res->minimum ];
			$return[ $temp ]['avg'][] = [ (int)$res->week, (int)$res->average ];
			$return[ $temp ]['max'][] = [ (int)$res->week, (int)$res->maximum ];
		}

		return $return;

	}

	

}