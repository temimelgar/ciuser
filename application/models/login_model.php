<?php

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function validate_user($username,$password){

		$sql ="SELECT u.id, u.name, u.username, u.password, ed.emp_id, ed.position, ed.salary, ed.department, ed.date_hired
				FROM
				user u
				LEFT JOIN
				emp_details ed
				ON
				u.id = ed.emp_id
				WHERE
				u.username = ?
				and
				u.password = ?
				";

		$params = array($username,$password);
		$data = $this->db->query($sql,$params);
		return $data->result();

	}

}