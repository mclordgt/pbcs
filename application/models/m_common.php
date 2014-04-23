<?php
class M_common extends CI_Model{

	public function __construct(){

		parent::__construct();

	}

	public function checkPlanInstanceTopography( $plan_id ){

		$this->db->where( 'plan_instance_id', $plan_id );
		$query = $this->db->get('pbcs_p_instance_topography_items');

		if( $query->num_rows() > 0 ){
			return true;
		} else {
			return false;
		}

	}

	public function getItemDescription( $table, $id, $selField, $where ){

		$this->db->select($selField);
		$this->db->where($where,$id);
		$query = $this->db->get($table);

		$row = $query->row();

		return $row->$selField;

	}

	public function getPresentationData( $table, $plan_id, $selField, $category=null, $catField=null ){

		$arr = array();

		$this->db->select($selField);
		$this->db->where('plan_instance_id = ',$plan_id);

		if( $category!=null && $catField!=null )
			$this->db->like($catField,$category);

		$this->db->group_by($selField);

		$query = $this->db->get($table);

		foreach( $query->result_array() as $result){
			$arr[] = $result[$selField];
		}

		return $arr;

	}

	public function getAll($table,$order_field,$id_field=null,$id=null){

		$this->db->where('active',0);

		if( $id_field!=null && $id!=null ){
			$this->db->where($id_field,$id);
		}

		$this->db->order_by($order_field,'desc');

		$query = $this->db->get($table);

		return $query->result();

	}

	public function getItem($table,$field,$id){

		$this->db->where($field,$id);
		$query = $this->db->get($table);

		return $query->row();
	}

	public function update($table,$data,$field,$id){

		$this->db->where($field,$id);
		if( $this->db->update($table,$data) ){
			return true;
		} else {
			return false;
		}

	}

	public function updateMany($table,$data,$parentField,$parentId,$andField,$andId){

		$this->db->where($parentField,$parentId);
		$this->db->where($andField,$andId);
		if(  $this->db->update($table,$data) ){
			return true;
		} else {
			return false;
		}

	}

	public function updateInsert($table,$data,$field){

		$this->db->select($field);
		$this->db->where($data);
		$select = $this->db->get($table);

		if( $select->num_rows() > 0 ){

			$dataID = $select->row();

			return $this->update( $table,$data,$field,$dataID->$field );

		} else {

			return $this->insert( $table,$data );

		}

	}

	public function deleteMissing( $table, $data, $whereID, $refID, $id, $categoryField=null, $category=null ){

		if($categoryField!=null && $category!=null){
			$this->db->where( $categoryField, $category );
		}

		$this->db->where_not_in($whereID, $data);
		$this->db->where($refID, $id);
		if( $this->db->delete($table) ){
			return true;
		} else {
			return false;
		}

	}

	public function delete($table,$field,$id){

		$data = array(
				'active' => 1
			);

		$this->db->where($field,$id);
		if( $this->db->update($table,$data) ){
			return true;
		} else {
			return false;
		}

	}

	public function insert($table,$data){
		
		if( $this->db->insert($table,$data) ){

			return $this->db->insert_id();

		} else {

			return false;

		}

	}

}