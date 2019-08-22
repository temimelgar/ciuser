<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class AccountInfoLandline extends CI_Controller {
    public function __construct(){
        parent::__construct(); 

         session_check();
        $this->load->model('account_info_model');
        $this->load->model('provider_model');
        $this->load->database('ipc_central');
        $this->load->model('ipc_model');
        $this->load->library('excel');
    }

    function index() {
        $data['content'] = 'account_info_landline_view';
        $data['title'] = 'Account Information (Landline)';
        $data['head_title'] = 'Account Information (Landline)';
        $data['data'] = $this->account_info_model->fetch_all_landlines();
        $data['providers'] = $this->provider_model->get_providers();
        $data['types'] = $this->provider_model->get_types_landline();
        $data['employees'] = $this->ipc_model->fetch_personal_info();
        $data['sections'] = $this->ipc_model->fetch_sections();
        $this->load->view('template/template',$data);       
    }

        function validate_account_landline() {
            $accountnumber = $this->input->post('accountnumber');
            $landlinenumber = $this->input->post('landlinenumber');
            $supplier = $this->input->post('supplier');
            $assignee = $this->input->post('assignee');
            $assigneesection = $this->input->post('assigneesection');
            $type = $this->input->post('type');
            $newnumber = $this->input->post('newnumber');
            $trunkline = $this->input->post('trunkline');
            $nooftrunkline = $this->input->post('nooftrunkline');
            $duedate = $this->input->post('duedate');
            $activefrom = $this->input->post('activefrom');
            $remarks = $this->input->post('remarks');
            $user =  $this->session->userdata('full_name');


                if(!$this->account_info_model->check_duplicate_account($accountnumber)){
                    $new_registered_account = $this->account_info_model->save_new_landline_account($accountnumber, $landlinenumber, $supplier, $assignee, $type, $newnumber, $trunkline, $nooftrunkline, $duedate, $activefrom, $remarks, $user, $assigneesection);
                    echo json_encode($new_registered_account);
                } else {
                    echo json_encode(false);
                }

    }

        public function get_edit(){
        $id = $this->uri->segment(3);
        $data['id'] = $id;        
        $data['providers'] = $this->provider_model->get_providers();
        $data['employees'] = $this->ipc_model->fetch_personal_info();
        $data['types'] = $this->provider_model->get_types_landline();
        $data['sections'] = $this->ipc_model->fetch_sections();        
        $get_data = $this->account_info_model->get_account_info_by_id($id);
        if($get_data->num_rows() > 0){

            $row = $get_data->row_array();
            $data['inactive'] = $row['inactive'];
            // $data['type'] = $row['type'];
        }   
    
         $data['content'] = 'account_info_landline_edit_view';
        $data['title'] = 'Update Account Information (Landline) ';
        $data['head_title'] = 'Update Account Information (Landline)';        
        $this->load->view('template/template',$data);           
        
    } 

        public function get_account_info_by_id() {
        $id = $this->input->post('id',TRUE);
        $data = $this->account_info_model->get_account_info_by_id($id)->result();
        echo json_encode($data);
    }

    function update_account_info() {
        $accountnumberupdate = $this->input->post('accountnumberupdate',TRUE);
        $nooftrunklineupdate = $this->input->post('nooftrunklineupdate',TRUE);        
        $phonenumberupdate = $this->input->post('phonenumberupdate',TRUE);
        $activefromupdate = $this->input->post('activefromupdate',TRUE);        
        $newnumberupdate = $this->input->post('newnumberupdate',TRUE);
        $trunklineupdate = $this->input->post('trunklineupdate',TRUE);
        $activecheckbox = $this->input->post('activecheckbox',TRUE);        
        $supplierupdate = $this->input->post('supplierupdate',TRUE);
        $assigneeupdate = $this->input->post('assigneeupdate',TRUE);
        $assigneesectionupdate = $this->input->post('assigneesectionupdate',TRUE);
        $remarksupdate = $this->input->post('remarksupdate',TRUE);  
        $inactivedate = $this->input->post('inactivedate',TRUE);
        $typeupdate = $this->input->post('typeupdate',TRUE);
        $duedateupdate = $this->input->post('duedateupdate',TRUE);
        $last_user = $this->session->userdata('full_name');        
        $id = $this->input->post('id',TRUE);

        $data = $this->account_info_model->update_account_info_landline($id, $accountnumberupdate, $phonenumberupdate, $newnumberupdate, $trunklineupdate, $nooftrunklineupdate, $activefromupdate, $supplierupdate, $assigneeupdate, $assigneesectionupdate, $remarksupdate, $inactivedate, $typeupdate, $last_user, $activecheckbox, $duedateupdate);

    }

    function exportaccount() {
        $filename = 'List of Accounts (Communication) as of '.date("m-d-Y").'.xls';

        $this->load->library('excel');
        $providerInfo = $this->account_info_model->select();
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);

        $excel->getActiveSheet()->SetCellValue('A1', 'ACCOUNT NUMBER')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('B1', 'SUPPLIER NAME')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('C1', 'TYPE NAME')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('D1', 'PHONE NUMBER')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('E1', 'ASSIGNEE')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('F1', 'SECTION')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('G1', 'AMOUNT LIMIT')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('H1', 'DUE DATE')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('I1', 'NEW NUMBER')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('J1', 'TRUNK LINE')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('K1', 'NO. OF TRUNK LINE')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('L1', 'ACTIVE FROM')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('M1', 'STATUS')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('N1', 'INACTIVE DATE')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('O1', 'LAST USER')->getStyle('A1:O1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('P1', 'LAST UPDATE')->getStyle('A1:O1')->getFont()->setBold(true);


        $row = 2;

        foreach ($providerInfo as $element)
        {
            $excel->getActiveSheet()->SetCellValue('A'.$row, $element['account_number']);
            $excel->getActiveSheet()->SetCellValue('B'.$row, $element['supplier_name']);
            $excel->getActiveSheet()->SetCellValue('C'.$row, $element['type_name']);
            $excel->getActiveSheet()->SetCellValue('D'.$row, $element['phone_number']);
            $excel->getActiveSheet()->SetCellValue('E'.$row, $element['assignee'] );
            $excel->getActiveSheet()->SetCellValue('F'.$row, $element['assigneesection'] );
            $excel->getActiveSheet()->SetCellValue('G'.$row, $element['amount_limit'] );
            $excel->getActiveSheet()->SetCellValue('H'.$row, $element['due_date'] );
            $excel->getActiveSheet()->SetCellValue('I'.$row, $element['newnumber'] );
            $excel->getActiveSheet()->SetCellValue('J'.$row, $element['trunkline'] );
            $excel->getActiveSheet()->SetCellValue('K'.$row, $element['nooftrunkline'] );
            $excel->getActiveSheet()->SetCellValue('L'.$row, $element['active_from'] );
            $excel->getActiveSheet()->SetCellValue('M'.$row, ($element['inactive'] == 1 ? 'Active' : 'Inactive'));
            $excel->getActiveSheet()->SetCellValue('N'.$row, ($element['inactive_date'] == '0000-00-00' ? '' : $element['inactive_date']));
            $excel->getActiveSheet()->SetCellValue('O'.$row, $element['last_user']);
            $excel->getActiveSheet()->SetCellValue('P'.$row, $element['last_update']);

            $row++;
        }
$object_excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');// Explain format of Excel data
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$filename);
$object_excel_writer->save('php://output');



    }     
    


    
   
}

            