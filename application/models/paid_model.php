<?php 

class Paid_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}


	function fetch_paid_details()
	{
				$sql ="SELECT pd.id, pd.billing_entry_no, pd.type_id, pd.supplier_id, pd.grosstotal, pd.vattotal, pd.adjtotal, pd.vatabletotal,
pd.nvattotal, pd.wtxtotal, pd.netpaytotal, pd.last_user, pd.last_update, t.type_name, p.supplier_name, pd.payment_date, pd.checked_reference, pd.or_number, pd.or_date
 FROM 
paid_details AS pd
LEFT JOIN
providers AS p
ON
pd.supplier_id = p.supplier_id
LEFT JOIN
TYPE AS t
ON
pd.type_id = t.type_id
order by billing_entry_no desc
		";
		$data = $this->db->query($sql);
		return $data->result();
	}


	function get_paid_entries_by_billing_entry_no($billing_entry_number)
	{
		$sql ="SELECT p.id, p.billing_entry_no, p.posting_date, pr.supplier_name, t.type_name, p.due_date, p.billing_from, p.billing_to,
p.statement_date, p.payment_date, p.checked_reference, p.or_number, p.or_date, p.account_number, p.phone_number, 
p.assignee, p.amount_limit, p.soa, p.gross, p.vat, p.adj, p.vatable, p.nvat, p.wtx, p.net_pay, p.last_user, p.last_update,p.assigneesection
FROM
sys_billing_communications.posting_information p
LEFT JOIN
sys_billing_communications.providers pr
ON
p.supplier_id = pr.supplier_id
LEFT JOIN
TYPE t
ON
p.type_id = t.type_id
		WHERE p.billing_entry_no = ?";
		$param = array($billing_entry_number);
		$data = $this->db->query($sql, $param);
		return $data->result();	
	}

	function get_paid_entries_by_id($id)
	{
		$sql ="SELECT p.id, p.billing_entry_no, p.posting_date, pr.supplier_name, t.type_name, p.due_date, p.billing_from, p.billing_to,
p.statement_date, p.payment_date, p.checked_reference, p.or_number, p.or_date, p.account_number, p.phone_number, 
p.assignee, p.amount_limit, p.soa, p.gross, p.vat, p.adj, p.vatable, p.nvat, p.wtx, p.net_pay, p.last_user, p.last_update,CONCAT(pit.last_name,', ', pit.first_name) AS fullname, emt.division_id,
		emt.department_id, emt.section_id 
FROM
sys_billing_communications.posting_information p
LEFT JOIN
sys_billing_communications.providers pr
ON
p.supplier_id = pr.supplier_id
LEFT JOIN
TYPE t
ON
p.type_id = t.type_id
LEFT JOIN
ipc_central.employee_masterfile_tab emt
ON
p.assignee = emt.id
LEFT JOIN
ipc_central.personal_information_tab pit
ON
p.assignee = pit.employee_id
		WHERE p.id = ?";
		$param = array($id);
		$data = $this->db->query($sql, $param);
		return $data->result();	
	}	

	function get_paid_entries_by_billing_entry_no_array($billing_entry_number)
	{
		$sql ="SELECT p.billing_entry_no, p.posting_date, pr.supplier_name, t.type_name, p.due_date, p.billing_from, p.billing_to,
p.statement_date, p.payment_date, p.checked_reference, p.or_number, p.or_date, p.account_number, p.phone_number, 
p.assignee, p.assigneesection, p.amount_limit, p.soa, p.gross, p.vat, p.adj, p.vatable, p.nvat, p.wtx, p.net_pay, p.last_user, p.last_update
FROM
sys_billing_communications.posting_information p
LEFT JOIN
sys_billing_communications.providers pr
ON
p.supplier_id = pr.supplier_id
LEFT JOIN
TYPE t
ON
p.type_id = t.type_id
LEFT JOIN
ipc_central.employee_masterfile_tab emt
ON
p.assignee = emt.id
		WHERE p.billing_entry_no = ?";
		$param = array($billing_entry_number);
		$data = $this->db->query($sql, $param);
		return $data->result_array();	
	}	

	function fetch_paid_details_array()
	{
				$sql ="SELECT pd.id, pd.billing_entry_no, pd.type_id, pd.supplier_id, pd.grosstotal, pd.vattotal, pd.adjtotal, pd.vatabletotal,
pd.nvattotal, pd.wtxtotal, pd.netpaytotal, pd.last_user, pd.last_update, t.type_name, p.supplier_name, pd.payment_date
 FROM 
paid_details AS pd
LEFT JOIN
providers AS p
ON
pd.supplier_id = p.supplier_id
LEFT JOIN
TYPE AS t
ON
pd.type_id = t.type_id
order by billing_entry_no desc
		";
		$data = $this->db->query($sql);
		return $data->result_array();
	}	

	function update_adjustment($newAdj, $last_user, $nvat, $id, $newvatable, $newgross)
	{
		$sql = "
		UPDATE 
			posting_information
		SET
			adj = ?,
			nvat = ?,
			last_user = ?,
			last_update = NOW(),
			wtx = (? + ?) * 0.02,
			net_pay = (? - ((? + ?) * 0.02))  
		where
		id = ?

		";
	$params = array($newAdj, $nvat, $last_user, $nvat, $newvatable, $newgross, $nvat, $newvatable, $id);
	$data = $this->db->query($sql, $params);
				
	}

	function update_paid_details_by_billing_entry_no($newbilling_entry_no, $last_user)
	{
		$sql = "UPDATE paid_details set 
		nvattotal = (select sum(nvat) from posting_information where billing_entry_no = ?),
		adjtotal = (select sum(adj) from posting_information where billing_entry_no = ?),
		wtxtotal = (select sum(wtx) from posting_information where billing_entry_no = ?),
		netpaytotal  = (select sum(net_pay) from posting_information where billing_entry_no = ?),
		last_user = ?,
		last_update = NOW()
		where billing_entry_no = ?";
	$params = array($newbilling_entry_no, $newbilling_entry_no, $newbilling_entry_no, $newbilling_entry_no, $last_user,  $newbilling_entry_no);
	$data = $this->db->query($sql, $params);		

	}


	function update_wtx($id, $netpay, $newwitholdingtax, $newbilling_entry_no, $last_user)
	{
		$sql = "
		UPDATE 
			posting_information
		SET
			wtx =  ?,
			net_pay = ?,
			last_user = ?,
			last_update = NOW()

		where
		id = ?

		";
	$params = array($newwitholdingtax, $netpay, $last_user, $id);
	$data = $this->db->query($sql, $params);
				
	}	


	function get_billing_entry_by_date_and_supplier($year, $supplier)
	{
		$sql = "
SELECT a.assignee, a.assigneesection, a.phone_number, a.gross,
 a.billing_from, a.billing_to, a.account_number, g.type_name, a.statement_date,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-01-01') AND LAST_DAY(CONCAT(?, '-01-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS january,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-02-01') AND LAST_DAY(CONCAT(?, '-02-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS february,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-03-01') AND LAST_DAY(CONCAT(?, '-03-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS march,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-04-01') AND LAST_DAY(CONCAT(?, '-04-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS april,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-05-01') AND LAST_DAY(CONCAT(?, '-05-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS may,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-06-01') AND LAST_DAY(CONCAT(?, '-06-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS june,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-07-01') AND LAST_DAY(CONCAT(?, '-07-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS july,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-08-01') AND LAST_DAY(CONCAT(?, '-08-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS august,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-09-01') AND LAST_DAY(CONCAT(?, '-09-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS september,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-10-01') AND LAST_DAY(CONCAT(?, '-10-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS october,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-11-01') AND LAST_DAY(CONCAT(?, '-12-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS november,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-12-01') AND LAST_DAY(CONCAT(?, '-12-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS december
FROM 
sys_billing_communications.posting_information AS a
LEFT JOIN
sys_billing_communications.type AS g
ON
a.type_id = g.type_id
where a.supplier_id = ?
AND YEAR(a.billing_from) = ?
GROUP BY
a.account_number";

		$params = array($year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year,  $supplier, $year);
		$data = $this->db->query($sql, $params);

		return $data;		
	}

	function get_billing_entry_by_date_and_supplier_excel($supplier, $year)
	{
		$sql = "
SELECT a.assignee, a.phone_number, a.gross, a.assigneesection,
 a.billing_from, a.billing_to, a.account_number, f.supplier_name, g.type_name, a.statement_date,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-01-01') AND LAST_DAY(CONCAT(?, '-01-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS january,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-02-01') AND LAST_DAY(CONCAT(?, '-02-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS february,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-03-01') AND LAST_DAY(CONCAT(?, '-03-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS march,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-04-01') AND LAST_DAY(CONCAT(?, '-04-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS april,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-05-01') AND LAST_DAY(CONCAT(?, '-05-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS may,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-06-01') AND LAST_DAY(CONCAT(?, '-06-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS june,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-07-01') AND LAST_DAY(CONCAT(?, '-07-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS july,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-08-01') AND LAST_DAY(CONCAT(?, '-08-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS august,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-09-01') AND LAST_DAY(CONCAT(?, '-09-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS september,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-10-01') AND LAST_DAY(CONCAT(?, '-10-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS october,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-11-01') AND LAST_DAY(CONCAT(?, '-12-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS november,
SUM(CASE WHEN a.statement_date BETWEEN CONCAT(?, '-12-01') AND LAST_DAY(CONCAT(?, '-12-01'))
THEN 
a.gross
ELSE
a.gross = 1
END) AS december
FROM 
sys_billing_communications.posting_information AS a

LEFT JOIN 
sys_billing_communications.providers AS f
ON
a.supplier_id = f.supplier_id
LEFT JOIN
sys_billing_communications.type AS g
ON
a.type_id = g.type_id
WHERE
a.supplier_id = ?
AND YEAR(a.billing_from) = ?
GROUP BY
a.account_number


		";
		$params = array($year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year, $year,  $supplier, $year);
		$data = $this->db->query($sql, $params);
		// $data = $this->db->query($sql);

		return $data->result_array();		
	}


}