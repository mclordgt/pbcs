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

	public function getMinAvgMax( $client_id, $measure_id, $interval='week' ){

		$return = array();

		$sql = "select extract({$interval} from bi.start) as duration, min(bim.measure_value) as minimum, avg(bim.measure_value) as average, max(bim.measure_value) as maximum, bm.measure_description as description from (pbcs_clients as pc inner join pbcs_p_instances as pi on pc.client_id = pi.client_id ) inner join ( pbcs_b_measures as bm inner join ( pbcs_b_instances as bi inner join pbcs_b_instance_measures as bim on bi.behaviour_instance_id = bim.behaviour_instance_id ) on bm.measure_id=bim.measure_id) on pi.plan_instance_id = bi.plan_instance_id group by extract({$interval} from bi.start), pc.client_id, bim.measure_id having ( ( pc.client_id = ? ) AND ( bim.measure_id = ? ) )";		
		$query = $this->db->query( $sql, array( $client_id, $measure_id ) );

		$year = date('Y');

		if( $interval == 'week' ){
			$week_start = new DateTime();
		} 

		foreach( $query->result() as $res ){
			$temp = str_replace(' ', '_', strtolower( $res->description ) ); 

			if( $interval == 'week' ){
				$week_start->setISODate( $year , $res->duration+1 );	
				$format = $week_start->format('Y-m-d h:m a');
			} elseif( $interval == 'month' ){
				$format = $year.'-'.$res->duration.'-1 12:00 am';
			} elseif( $interval == 'year' ) {
				$format = $year.'-1-1 12:00 am';
			}

			$return[ $temp ]['min'][] = [ $format, (int)$res->minimum ];
			$return[ $temp ]['avg'][] = [ $format, (int)$res->average ];
			$return[ $temp ]['max'][] = [ $format, (int)$res->maximum ];
		}

		return $return;

	}

	

}