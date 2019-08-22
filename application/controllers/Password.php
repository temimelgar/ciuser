<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Password extends CI_Controller {
    public function __construct(){
        parent::__construct();

         session_check();
    }

    public function index() {



        $data['content'] = 'password_view';
        $data['title'] = 'Change account Password';
        $data['head_title'] = 'UPDATE PASSWORD | CI User';
        // $data['data'] = $this->register_model->get_user();
        // ~ $data['items'] = $this->category->get_category_items();
        $this->load->view('template/template',$data);
       
    }

   
}