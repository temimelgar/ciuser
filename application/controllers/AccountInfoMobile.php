<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class AccountInfoMobile extends CI_Controller {
    public function __construct(){
        parent::__construct();

         session_check();
        $this->load->model('account_info_model');
        $this->load->model('provider_model');
        $this->load->database('ipc_central');
        $this->load->model('ipc_model');


    }

    function index() {
        $data['content'] = 'account_info_mobile_view';
        $data['title'] = 'Account Information (Mobile)';
        $data['head_title'] = 'Account Information (Mobile)';
        $data['data'] = $this->account_info_model->fetch_all_mobile();
        $data['providers'] = $this->provider_model->get_providers();
        $data['types'] = $this->provider_model->get_types_mobile();
        $data['employees'] = $this->ipc_model->fetch_personal_info();
        $data['sections'] = $this->ipc_model->fetch_sections();
        // ~ $data['items'] = $this->category->get_category_items();
        $this->load->view('template/template',$data);       
    }

        function validate_account_mobile() {
            $accountnumber = $this->input->post('accountnumber');
            $mobilenumber = $this->input->post('mobilenumber');
            $supplier = $this->input->post('supplier');
            $assignee = $this->input->post('assignee');
            $assigneesection = $this->input->post('assigneesection');
            $type = $this->input->post('type');
            $amountlimit = $this->input->post('amountlimit');
            $duedate = $this->input->post('duedate');
            $activefrom = $this->input->post('activefrom');
            $remarks = $this->input->post('remarks');
            $user =  $this->session->userdata('full_name');

                if(!$this->account_info_model->check_duplicate_account($accountnumber)){
                    $new_registered_account = $this->account_info_model->save_new_mobile_account($accountnumber, $mobilenumber, $supplier, $assignee, $type, $amountlimit, $duedate, $activefrom, $remarks, $user, $assigneesection);
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
        $data['types'] = $this->provider_model->get_types_mobile();
        $data['sections'] = $this->ipc_model->fetch_sections();        
        $get_data = $this->account_info_model->get_account_info_by_id($id);

        if($get_data->num_rows() > 0){

            $row = $get_data->row_array();
            $data['inactive'] = $row['inactive'];
            // $data['type'] = $row['type'];
        }   
    
        $data['content'] = 'account_info_mobile_edit_view';
        $data['title'] = 'Update Account Information (Mobile)';
        $data['head_title'] = 'Update Account Information (Mobile)';        
        $this->load->view('template/template',$data);           
        }

        public function get_account_info_by_id() {
        $id = $this->input->post('id',TRUE);
        $data = $this->account_info_model->get_account_info_by_id($id)->result();
        echo json_encode($data);
    }

    function update_account_info() {
                $id = $this->input->post('id',TRUE);
        $accountnumberupdate = $this->input->post('accountnumberupdate',TRUE);
        $phonenumberupdate = $this->input->post('phonenumberupdate',TRUE);
        $amountlimitupdate = $this->input->post('amountlimitupdate',TRUE);
        $activefromupdate = $this->input->post('activefromupdate',TRUE);
        $activecheckbox = $this->input->post('activecheckbox',TRUE);        
        $supplierupdate = $this->input->post('supplierupdate',TRUE);
        $assigneeupdate = $this->input->post('assigneeupdate',TRUE);
        $remarksupdate = $this->input->post('remarksupdate',TRUE);  
        $inactivedate = $this->input->post('inactivedate',TRUE);
        $typeupdate = $this->input->post('typeupdate',TRUE);
        $duedateupdate = $this->input->post('duedateupdate',TRUE);
        $assigneesectionupdate = $this->input->post('assigneesectionupdate',TRUE);

        $last_user = $this->session->userdata('full_name');        

        $data = $this->account_info_model->update_account_info($id, $accountnumberupdate, $phonenumberupdate, $amountlimitupdate, $activefromupdate, $supplierupdate, $assigneeupdate, $remarksupdate, $inactivedate, $typeupdate, $last_user, $activecheckbox, $duedateupdate, $assigneesectionupdate);

    }


    
   
}

            