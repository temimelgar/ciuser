<?php
class Account_info_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	function fetch_all() {
		$sql ="SELECT distinct(supplier_name) as name, pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		p.supplier_id as supplier_id,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
			pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
		GROUP BY supplier_name
		ORDER BY due_date
		";
		$data = $this->db->query($sql);
		return $data->result();
	}
	function fetch_all_mobile() {
		$sql ="SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, pai.last_update,
		pai.last_update, pai.assigneesection
		FROM
		sys_billing_communications.provider_account_information pai
		LEFT JOIN
		sys_billing_communications.providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		sys_billing_communications.type t
		ON
		pai.type_id = t.type_id
		WHERE t.classification = 2
		";
		$data = $this->db->query($sql);
		return $data->result();
	}
	function fetch_all_landlines() {
		$sql ="SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, pai.last_update,
		pai.last_update, pai.assigneesection,
		pai.newnumber, pai.trunkline, pai.nooftrunkline
		FROM
		sys_billing_communications.provider_account_information pai
		LEFT JOIN
		sys_billing_communications.providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		sys_billing_communications.type t
		ON
		pai.type_id = t.type_id
		WHERE t.classification = 1
		";
		$data = $this->db->query($sql);
		return $data->result();
		}
	function check_duplicate_account($accountnumber) {
		$query = $this->db->get_where('provider_account_information', array('account_number' => $accountnumber));
		return $query->num_rows();
	}
	function save_new_mobile_account($accountnumber, $mobilenumber, $supplier, $assignee, $type, $amountlimit, $duedate, $activefrom, $remarks, $user, $assigneesection) {
		$sql = "INSERT INTO
				provider_account_information
				(account_number, supplier_id, type_id, phone_number, assignee, amount_limit, due_date, active_from, remarks, inactive, last_user, assigneesection)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$params = array($accountnumber, $supplier, $type, $mobilenumber,  $assignee,  $amountlimit, $duedate, $activefrom, $remarks, 1, $user, $assigneesection);
		$this->db->query($sql, $params);
		return $this->db->insert_id();
	}
	function save_new_landline_account($accountnumber, $landlinenumber, $supplier, $assignee, $type, $newnumber, $trunkline, $nooftrunkline, $duedate, $activefrom, $remarks, $user, $assigneesection) {
		$sql = "INSERT INTO
				provider_account_information
				(account_number, supplier_id, type_id, phone_number, assignee, newnumber, trunkline, nooftrunkline, due_date, active_from, remarks, inactive, last_user, assigneesection)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$params = array($accountnumber, $supplier, $type, $landlinenumber,  $assignee,  $newnumber, $trunkline, $nooftrunkline, $duedate, $activefrom, $remarks, 1, $user, $assigneesection);
		$this->db->query($sql, $params);
		return $this->db->insert_id();
	}
		function get_account_info_by_id($id) {
		$sql ="SELECT pai.id, pai.account_number, p.supplier_name, pai.phone_number, pai.assignee, pai.due_date, pai.remarks, pai.active_from, pai.inactive_date, pai.inactive, pai.supplier_id, pai.type_id, pai.amount_limit, pai.due_date, pai.trunkline, pai.newnumber, pai.nooftrunkline, t.type_name,
		pai.active_from, pai.assigneesection
		FROM provider_account_information AS pai
		LEFT JOIN
		providers AS p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE AS t
		ON
		pai.type_id = t.type_id
		where pai.id = ?";
		$params = array($id);
		$data = $this->db->query($sql, $params);
		return $data;
		}
	function update_account_info($id, $accountnumberupdate, $phonenumberupdate, $amountlimitupdate, $activefromupdate, $supplierupdate, $assigneeupdate, $remarksupdate, $inactivedate, $typeupdate, $last_user, $activecheckbox, $duedateupdate, $assigneesectionupdate) {
		$data = array(
				'account_number' => $accountnumberupdate,
				'phone_number' => $phonenumberupdate,
				'amount_limit' => $amountlimitupdate,
				'supplier_id' => $supplierupdate,
				'assignee' => $assigneeupdate,
				'remarks' => $remarksupdate,
				'type_id' => $typeupdate,
				'last_user' => $last_user,
				'inactive_date' => $inactivedate,
				'inactive' => $activecheckbox,
				'due_date' => $duedateupdate,
				'assigneesection' => $assigneesectionupdate
				);
				$this->db->where('id', $id);
				$query = $this->db->update('provider_account_information', $data);
				return $query;
	}
	function update_account_info_landline($id, $accountnumberupdate, $phonenumberupdate, $newnumberupdate, $trunklineupdate, $nooftrunklineupdate, $activefromupdate, $supplierupdate, $assigneeupdate, $assigneesectionupdate, $remarksupdate, $inactivedate, $typeupdate, $last_user, $activecheckbox, $duedateupdate) {
		$data = array(
				'account_number' => $accountnumberupdate,
				'phone_number' => $phonenumberupdate,
				'newnumber' => $newnumberupdate,
				'trunkline' => $trunklineupdate,
				'nooftrunkline' => $nooftrunklineupdate,
				'supplier_id' => $supplierupdate,
				'assignee' => $assigneeupdate,
				'assigneesection' => $assigneesectionupdate,
				'remarks' => $remarksupdate,
				'type_id' => $typeupdate,
				'last_user' => $last_user,
				'inactive_date' => $inactivedate,
				'inactive' => $activecheckbox,
				'due_date' => $duedateupdate
				);
				$this->db->where('id', $id);
				$query = $this->db->update('provider_account_information', $data);
						return $query;
	}
	function get_due_today() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 0" ;
		$data = $this->db->query($sql);
		return $data;
		}
					// 	$this->db->select('count(account_number) as bilang');
					// 	$this->db->from('provider_account_information');
					// 	$this->db->where('due_date - DAY(CURDATE()) = 0');
					// 	$query = $this->db->get();
					// 	return $query;
	// }
	function get_due_tomorrow() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 1" ;
		$data = $this->db->query($sql);
		return $data;
	}
	function get_due_2days() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 2" ;
		$data = $this->db->query($sql);
				return $data;
		// $this->db->select('count(account_number) as count2days');
		// $this->db->from('provider_account_information');
		// $this->db->where('due_date - DAY(CURDATE()) = 2');
		// $query = $this->db->get();
		// return $query;
	}
	function get_due_3days() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 3" ;
		$data = $this->db->query($sql);
					return $data;
		// $this->db->select('count(account_number) as count3days');
		// $this->db->from('provider_account_information');
		// $this->db->where('due_date - DAY(CURDATE()) = 3');
		// $query = $this->db->get();
		// return $query;
	}
	function get_due_4days() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 4" ;
		$data = $this->db->query($sql);
					return $data;
		// $this->db->select('count(account_number) as count4days');
		// $this->db->from('provider_account_information');
		// $this->db->where('due_date - DAY(CURDATE()) = 4');
		// $query = $this->db->get();
		// return $query;
	}
	function get_due_5days() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 5" ;
		$data = $this->db->query($sql);
							return $data;
		// $this->db->select('count(account_number) as count5days');
		// $this->db->from('provider_account_information');
		// $this->db->where('due_date - DAY(CURDATE()) = 5');
		// $query = $this->db->get();
		// return $query;
	}
	function get_due_6days() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 6" ;
		$data = $this->db->query($sql);
							return $data;
		// $this->db->select('count(account_number) as count6days');
		// $this->db->from('provider_account_information');
		// $this->db->where('due_date - DAY(CURDATE()) = 6');
		// $query = $this->db->get();
		// return $query;
	}
	function get_due_7days() {
						$sql ="SELECT *	FROM provider_account_information
		where DATEDIFF(STR_TO_DATE(CONCAT(MONTH(CURDATE()),'/', due_date,'/',YEAR(CURDATE())), '%m/%d/%y' ), CURDATE()) - 366 = 7" ;
		$data = $this->db->query($sql);
							return $data;
		// $this->db->select('count(account_number) as count7days');
		// $this->db->from('provider_account_information');
		// $this->db->where('due_date - DAY(CURDATE()) >= 7');
		// $query = $this->db->get();
		// return $query;
		}
	function get_dues() {
		$sql = "SELECT due_date, provider_account_information.supplier_id, supplier_name, provider_account_information.type_id, type.type_name, count(type.type_name) as count
				FROM provider_account_information
				LEFT JOIN
				providers
				ON
				provider_account_information.supplier_id = providers.supplier_id
				LEFT JOIN
				TYPE
				ON
				provider_account_information.type_id = type.type_id
				where inactive = 1
				GROUP BY due_date, provider_account_information.supplier_id, provider_account_information.type_id
				ORDER BY due_date
				";
		$data = $this->db->query($sql);
		return $data->result();
	}
	function get_due_details_today() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
			WHERE due_date - DAY(CURDATE()) = 0
				";
		$data = $this->db->query($sql);
		return $data->result();
	}
	function get_due_details_tomorrow() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
			WHERE due_date - DAY(CURDATE()) = 1
				";
		$data = $this->db->query($sql);
		return $data->result();
	}
	function get_due_details_2days() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
			WHERE due_date - DAY(CURDATE()) = 2
				";
		$data = $this->db->query($sql);
		return $data->result();
		}
	function get_due_details_3days() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
			WHERE due_date - DAY(CURDATE()) = 3
				";
		$data = $this->db->query($sql);
		return $data->result();
		}
	function get_due_details_4days() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
			WHERE due_date - DAY(CURDATE()) = 4
				";
		$data = $this->db->query($sql);
		return $data->result();
		}
	function get_due_details_5days() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
			WHERE due_date - DAY(CURDATE()) = 5
				";
		$data = $this->db->query($sql);
		return $data->result();
			}
	
	function get_due_details_6days() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
		WHERE due_date - DAY(CURDATE()) = 6
				";
		$data = $this->db->query($sql);
		return $data->result();
		}
	function get_due_details_7days() {
		$sql = "SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
		pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
		WHERE due_date - DAY(CURDATE()) = 7
				";
		$data = $this->db->query($sql);
		return $data->result();
		}
	function get_type_by_supplierid($supplier_id) {
		$sql = "SELECT pai.type_id as type_id, t.type_name FROM
		provider_account_information pai
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
		WHERE pai.supplier_id = ?
		group by pai.type_id
		order by type_name";
		$param = array($supplier_id);
		$data = $this->db->query($sql, $param);
			return $data->result();
	}
	function select()
	{
		$query = 'SELECT pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		p.supplier_id AS supplier_id,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline, assigneesection,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
			pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
	
		ORDER BY due_date';
		$data = $this->db->query($query);
		return $data->result_array();
	}
	function insert($data)
	{
		$count = count($data['count']);
for($i = 0; $i<$count; $i++){
$entries[] = array(
'account_number'=>$data['accountnumber'][$i],
'assignee'=>$data['assignee'][$i],
'assigneesection'=>$data['assigneesection'][$i],
'supplier_id'=>$data['supplierid'][$i],
'type_id'=>$data['typeid'][$i],
'phone_number'=>$data['phonenumber'][$i],
'due_date'=>$data['duedate'][$i],
'billing_from'=>$data['billfromdate'][$i],
'billing_to'=>$data['billtodate'][$i],
'billing_entry_no'=>$data['billingentryno'][$i],
'statement_date'=>$data['statementdate'][$i],
'amount_limit'=>$data['amount_limit'][$i],
'soa'=>$data['soanumber'][$i],
'gross'=>$data['gross'][$i],
'vat'=>$data['vat'][$i],
'vatable'=>$data['vatables'][$i],
'nvat'=>$data['nvats'][$i] - $data['adj'][$i],
'wtx'=>$data['wtx'][$i],
'adj'=>$data['adj'][$i],
'net_pay'=>$data['netpays'][$i],
'last_user'=>$data['last_user'][$i],
'payment_date'=>date("Y-m-d h:i:s"),
'last_update'=>date("Y-m-d h:i:s"),
'posting_date'=>date("Y-m-d"),
);
}
$paidentries[] = array(
'billing_entry_no'=>$data['totalgetbillingentryno'],
'type_id'=>$data['totaltype'],
'supplier_id'=>$data['totalsupplier'],
'payment_date'=>date("Y-m-d"),
'grosstotal'=>$data['totalgross'],
'vattotal'=>$data['totalvat'],
'vatabletotal'=>$data['totalvatable'],
'nvattotal'=>$data['totalnvat'],
'wtxtotal'=>$data['totalwtx'],
'adjtotal'=>$data['totaladj'],
'netpaytotal'=>$data['totalnetpay'],
'last_user'=>$data['totallastuser'],
'last_update'=>date("Y-m-d h:i:s"),
'checked_reference'=>$data['checkedreference'][$i],
'or_number'=>$data['orno'][$i],
'or_date'=>$data['or_date'][$i],
);
// <input type='text' id='checkedreference' class='form-control' name='checkedreference[]' value='".$checkedreference."'>
// <input type='text' id='orno' class='form-control' name='orno[]' value='".$orno."'>
// <input type='text' id='or_date' class='form-control' name='or_date[]' value='".$or_date."'>
// <input type='text' id='gross' class='form-control' name='gross[]' value='".$gross."'>
		$this->db->insert_batch('posting_information', $entries);
		$query = $this->db->insert_batch('paid_details', $paidentries);
			return $query;
}
	
	function select_existing($supplier, $type, $account_number)
	{
$sql = "SELECT pai.account_number, pai.phone_number, pai.supplier_id, pai.assignee, pai.amount_limit, pai.type_id, pai.due_date, pai.assigneesection
FROM
sys_billing_communications.provider_account_information AS pai
WHERE
pai.supplier_id  = ?
AND
pai.type_id = ?
AND
pai.account_number = ?
";
		$params = array($supplier, $type, $account_number);
		$query =$this->db->query($sql, $params);
				return $query;
	}
	function delete_empty()
	
								{		$this->db->where('account_number', '');
		$query = $this->db->delete('posting_information');
				return $query;
	}
	function get_billingentryno()
	{
		$this->db->select_max('billing_entry_no');
$query = $this->db->get('posting_information')->row();
	return $query->billing_entry_no;
	}
	function checkpaid($supplier, $type, $account_number, $soanumber)
	{
		$this->db->select('account_number, phone_number, supplier_id, assignee, soa');
		$query = $this->db->get_where('posting_information', array('account_number' => $account_number, 'supplier_id' => $supplier, 'type_id' => $type, 'soa' => $soanumber));
				return $query;
	}
	function fetch_paid_details()
	{
				$sql ="SELECT distinct(supplier_name) as name, pai.id, pai.account_number AS account_number,
		p.supplier_name AS supplier_name,
		p.supplier_id as supplier_id,
		t.type_name AS type_name,
		pai.phone_number AS phone_number,
		assignee, amount_limit, due_date, remarks, newnumber, trunkline, nooftrunkline,
		pai.active_from AS active_from, inactive,
		pai.inactive_date AS inactive_date,
			pai.last_user AS last_user, last_update
		FROM
		provider_account_information pai
		LEFT JOIN
		providers p
		ON
		pai.supplier_id = p.supplier_id
		LEFT JOIN
		TYPE t
		ON
		pai.type_id = t.type_id
		GROUP BY supplier_name
		ORDER BY due_date
		";
		$data = $this->db->query($sql);
		return $data->result_array();
	}
	function fetch_all_accounts()
	{
			$query = $this->db->get('provider_account_information');
				return $query;
	}
}