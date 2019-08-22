<?php

class Provider_model extends CI_Model {

	public function __construct(){
		parent::__construct();

	}

	public function get_providers(){
			$sql ="SELECT * FROM providers";
			$data = $this->db->query($sql);
		return $data->result();
	}

	public function export_providers(){
			$sql ="SELECT * FROM providers";
			$data = $this->db->query($sql);
		return $data->result_array();



		//         $this->db->select('*');
		// 		$this->db->from('providers');
		// 		$query = $this->db->get();
		// return $query;
	}

	public function get_active_providers(){
			$sql ="SELECT * FROM providers where isactive = 1";
			$data = $this->db->query($sql);
		return $data->result();


		//         $this->db->select('*');
		// 		$this->db->from('providers');
		// 		$query = $this->db->get();
		// return $query;
	}

	public function get_categories(){
			$sql ="SELECT * FROM category";
			$data = $this->db->query($sql);
		return $data->result();
	}
	public function get_types(){
			$sql ="SELECT * FROM type";
			$data = $this->db->query($sql);
		return $data->result();
	}	
	public function get_types_mobile(){
			$sql ="SELECT * FROM type WHERE classification = 2";
	
			$data = $this->db->query($sql);
		return $data->result();
	}	

	public function get_types_landline(){
			$sql ="SELECT * FROM type WHERE classification = 1";
	
			$data = $this->db->query($sql);
		return $data->result();
	}				

	public function check_duplicate_provider($suppliername) {
		$query = $this->db->get_where('providers', array('supplier_name' => $suppliername));
		return $query->num_rows();
	}

	function save_new_provider($suppliername, $activefrom, $suppliercategory, $last_user) {
		$sql = "INSERT INTO
				providers
				(supplier_name, active_from, supplier_category, isactive, last_user, update_by, update_date)
				VALUES
				(?, ?, ?, ?, ?, ?, ?)";
		$params = array($suppliername, $activefrom, $suppliercategory, 1, $last_user, $last_user, date("Y-m-d h:i:s"));
		$this->db->query($sql, $params);
		return $this->db->insert_id();
	}

	function get_provider_by_id($id) {
		$this->db->select('category.category, providers.supplier_id, providers.supplier_name, providers.active_from, providers.inactive_date, providers.supplier_category, isactive');
		$this->db->from('providers');
		$this->db->join('category', 'providers.supplier_id = category.category_id', 'left');
		$this->db->where(array('providers.supplier_id' => $id));
		
		$query = $this->db->get();

		return $query;
	}

	function update_isactive($id, $activecheckbox, $activeFromUpdate, $supplierNameUpdate, $suppliercategory, $inactivedate, $last_user) {

		$data = array(
		'isactive' => $activecheckbox,
		'active_from' => $activeFromUpdate,
		'supplier_name' => $supplierNameUpdate,
		'supplier_category' => $suppliercategory,
		'inactive_date' => $inactivedate,
		'last_user' => $last_user,
		'update_date' => date("Y-m-d h:i:s"),
		);
		$this->db->where('supplier_id', $id);
		$query = $this->db->update('providers', $data);

		return $query;
	}

	function exportProvider() {

	}
	
}
