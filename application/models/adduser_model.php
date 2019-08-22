<?php 

class Adduser_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}


	public function get_province() {
        
        $this->db->select('*');
$this->db->from('refprovince');
$this->db->order_by('provDesc');
$query = $this->db->get();
		return $query;	
	}

	public function get_city($province) {
		$query = $this->db->get_where('refcitymun', array('provCode' => $province));
	
		$params = array($province);
		return $query;
	}

	public function get_brgy($city) {
		$query = $this->db->get_where('refbrgy', array('citymunCode' => $city));
		$params = array($city);
	return $query;
	}

	public function check_duplicate_user($username) {
			$query = $this->db->get_where('emp_details', array('username' => $username));
	return $query->num_rows();
	}

	public function save_new_user($lastname, $firstname, $mi, $username, $password, $province, $city, $barangay, $noblocklot, $street, $subvilbuil, $contactdetails, $position, $department, $date_hired) {
		$sql = "INSERT INTO
				emp_details
				(lastname, firstname, mi, username, password, province, city, barangay, noblocklot, street, subvilbuil, contact, position, department, date_hired)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$params = array($lastname, $firstname, $mi, $username, $password, $province, $city, $barangay, $noblocklot, $street, $subvilbuil, $contactdetails, $position, $department, $date_hired);
		$this->db->query($sql, $params);
		return $this->db->insert_id();

	}

	public function get_user_by_id($id){

		$this->db->select('*');
		$this->db->from('emp_details');
		$this->db->join('refprovince', 'emp_details.province = refprovince.provCode');
		$this->db->join('refcitymun', 'emp_details.city = refcitymun.citymunCode');
		$this->db->where(array('emp_details.id' => $id));

		$query = $this->db->get();


		return $query;
	}





	
	
}

?>