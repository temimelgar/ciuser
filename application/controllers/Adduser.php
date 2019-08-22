<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Adduser extends CI_Controller {
    public function __construct(){
        parent::__construct();

         session_check();
         $this->load->model('adduser_model');        
    }

    public function index() {

        $data['content'] = 'adduser_view';
        $data['title'] = 'Add New User';
        $data['head_title'] = 'ADD USER | CI User';
        $data['provinces'] = $this->adduser_model->get_province()->result();
        $this->load->view('template/template',$data);   
    }

       public function get_cities() {
        $province = $this->input->post('province', TRUE);
        $data = $this->adduser_model->get_city($province)->result();
        echo json_encode($data);
    }

        public function get_brgy() {
        $city = $this->input->post('city', TRUE);
        $data = $this->adduser_model->get_brgy($city)->result();
        echo json_encode($data);
    }

        public function validate_user() {
            $lastname = $this->input->post('lastname');
            $firstname = $this->input->post('firstname');
            $mi = $this->input->post('mi');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $province = $this->input->post('province');     
            $city = $this->input->post('city');
            $barangay = $this->input->post('barangay');
            $noblocklot = $this->input->post('noblocklot');
            $street = $this->input->post('street');
            $subvilbuil = $this->input->post('subvilbuil');           
            $contactdetails = $this->input->post('contactdetails');
            $position = $this->input->post('position');
            $department = $this->input->post('department');
            $date_hired = $this->input->post('date_hired');

                if(!$this->adduser_model->check_duplicate_user($username)){
                    $new_registered_user = $this->adduser_model->save_new_user($lastname, $firstname, $mi, $username, $password, $province, $city, $barangay, $noblocklot, $street, $subvilbuil, $contactdetails, $position, $department, $date_hired);
                    echo json_encode($new_registered_user);


                } else {
                    echo json_encode(false);
                }

        }

    public function get_edit(){
        $id = $this->uri->segment(3);
        $data['id'] = $id;        
        $data['provinces'] = $this->adduser_model->get_province()->result();
        $get_data = $this->adduser_model->get_user_by_id($id);
        if($get_data->num_rows() > 0){

            $row = $get_data->row_array();
            $data['city'] = $row['city'];
            $data['provincecode'] = $row['province'];
            $data['barangay'] = $row['barangay'];

        }   
    
         $data['content'] = 'edituser_view';
        $data['title'] = 'Edit User';
        $data['head_title'] = 'EDIT USER | CI User';
        $this->load->view('template/template',$data);           
        

    }        

    public function get_user_edit(){
        $id = $this->input->post('id',TRUE);
        $data = $this->adduser_model->get_user_by_id($id)->result();
        echo json_encode($data);
    }





}