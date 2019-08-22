<?php

class Dashboard_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}



	// public function check_duplicate_user($username) {
	// 			$query = $this->db->get_where('emp_details', array('username' => $username));
	// 	return $query->num_rows();
	// }

	// 	public function check_duplicate_user_with_id($username,$id) {
	// 	$sql = "SELECT * FROM emp_details where username = ? and id != ?";
	// 	$params = array($username, $id);
	// 	$data = $this->db->query($sql, $params);
	// 	return $data->result();
	// 	// return $data->num_rows();
	// 	// $query = $this->db->get_where('emp_details', array('username' => $username));
	// 	// return $query->num_rows();
	// }

	// public function save_new_user($fullname, $username, $password, $address, $contactdetails, $position, $department, $date_hired, $province, $city, $barangay, $noblocklot, $street, $subvilbuil) {
	// 	$sql = "INSERT INTO emp_details (fullname, username, password, address, contact, position, department, date_hired, province, city, barangay, noblocklot, street, subvilbuil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,?)";		
	// 	$params = array($fullname, $username, $password, $address, $contactdetails, $position, $department, $date_hired, $province, $city, $barangay, $noblocklot, $street, $subvilbuil);
	// 	$this->db->query($sql, $params);		
	// 	return $this->db->insert_id();
	// }

	// public function delete_user($id) {
	// 	$this->db->delete('emp_details', array('id' => $id));		
	// 	return true;
	// }

	// public function update_user($id, $fullname, $username, $address, $contact, $position, $department, $date_hired) {
	// 	$data = array(
	// 		'fullname' => $fullname,
	// 		'username' => $username,
	// 		'address' => $address,
	// 		'contact' => $contact,
	// 		'position' => $position,
	// 		'department' => $department,
	// 		'date_hired' => $date_hired,
	// 		// 'province' => $province,
	// 		// 'city' => $city,
	// 		// 'barangay' => $barangay,
	// 		// 'noblocklot' => $noblocklot,
	// 		// 'street' => $street,
	// 		// 'subvilbuil' => $subvilbuil
	// 	);
	// 	$this->db->where('id', $id);
	// 	$this->db->update('emp_details', $data);
	// 	$this->db->trans_complete();
		
	// 		if($this->db->trans_status() === FALSE)	{
	// 			$response  = "Unable to edit user";
	// 		} else	{
	// 			if($this->db->affected_rows() > 0)  {
	// 				$response = "User edited successfully";
	// 			} else {
	// 				$response = "There was an error this time";
	// 			}
	// 		}
	// 	return $response;
	// 	}



	// 	function get_user_by_id($province, $id){
	// 	$query = $this->db->get_where('emp_details', array('province' =>  $province, 'id' => $id));
	// 	return $query;
	// }


	
	
}