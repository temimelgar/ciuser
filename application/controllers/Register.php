<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Register extends CI_Controller {
    public function __construct(){
        parent::__construct();

         session_check();
        $this->load->model('register_model');
    }

    public function index() {
        $data['content'] = 'register_view';
        $data['title'] = 'Employee Registration';
        $data['head_title'] = 'REGISTER | CI User';
        $data['data'] = $this->register_model->get_user();
        // $data['provinces'] = $this->adduser_model->get_province();
        $this->load->view('template/template',$data);
             
    }

    public function validate_user() {
        $fullname = $this->input->post('id');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $address = $this->input->post('address');
        $contactdetails = $this->input->post('contactdetails');
        $position = $this->input->post('position');
        $department = $this->input->post('department');
        $date_hired = $this->input->post('date_hired');
                $province = $this->input->post('province');
        $city = $this->input->post('city');
        $barangay = $this->input->post('barangay');
        $noblocklot = $this->input->post('noblocklot');
        $street = $this->input->post('street');
        $subvilbuil = $this->input->post('subvilbuil');
        // $data = $this->register_model->check_duplicate_user($username);
            if(!$this->register_model->check_duplicate_user($username)){
                $new_registered_user = $this->register_model->save_new_user($fullname, $username, $password, $address, $contactdetails, $position, $department, $date_hired, $province, $city, $barangay, $noblocklot, $street, $subvilbuil);
                echo json_encode($new_registered_user);
            } else {
                echo json_encode(false);
            }
    }

    public function delete_user() {
        $id = $this->input->post('id');
        $this->register_model->delete_user($id);
    }

    public function update_user() {
        $id = $this->input->post('id');
        $fullname = $this->input->post('fullname');
        $username = $this->input->post('username');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $position = $this->input->post('position');
        $department = $this->input->post('department');
        $date_hired = $this->input->post('date_hired');


        // $data = $this->register_model->check_duplicate_user($username);
            if(!$this->register_model->check_duplicate_user_with_id($username, $id)){
                $updated_user = $this->register_model->update_user($id, $fullname, $username, $address, $contact, $position, $department, $date_hired);
                echo json_encode($updated_user);
            } else {
                echo json_encode(false);
            }
    }





    public function get_province_by_id($province) {   
        $province = $this->input->post('province', TRUE);
        $data = $this->registed_model->get_province_by_id($province)->result();
        echo json_encode($data);
        
    }


    public function get_data_edit() {
        $province = $this->input->post('province', TRUE);
        $id = $this->input->post('id', TRUE);
        $data = $this->register_model->get_user_by_id($province, $id)->result();
        echo json_encode($data);
    }


}