<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Assignee extends CI_Controller {
    public function __construct(){
        parent::__construct();

         session_check();
         $this->load->model('assignee_model');        
    }

    public function index() {

        $data['content'] = 'assignee_view';
        $data['title'] = 'Assignee Details';
        $data['head_title'] = 'Assignee Details';
        // $data['provinces'] = $this->adduser_model->get_province()->result();
        $this->load->view('template/template',$data);   
    }


}