<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('login_model');
    }

    public function index() {

            //         echo "<pre>";
        // print_r($this->session->userdata());
        // echo "</pre>";
        // exit();
        session_start();        
        $native_session = $_SESSION['user_data'];
        session_destroy();

        // echo "<pre>";
        // print_r($native_session);
        // echo "</pre>";
        // exit();
        $this->load->library('session');
        $this->session->set_userdata($native_session);

        redirect('dashboard');
    }

        public function logout()
    {
        $this->load->library('session');
        $native_session = $this->session->userdata();
        $this->session->sess_destroy();

        // $native_session = array(
        //     'user_data' => $native_session,
        //     'mc_login'  => 1
        // );

        // array_shift($native_session);

        // session_start();
        // $_SESSION['user_data'] = $native_session;
        // $_SESSION['mc_login']  = 1;

        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        // exit();

        //header("Location: http://ecommerce5/ipc_central/main_home_.php");
        redirect('http://ecommerce5/ipc_central/main_home_.php');
    }

    // public function ajax_validate() {

    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');
        
    //     $data = $this->login_model->validate_user($username, $password);

    //     if(count($data) > 0) {

    //         $user_data = array(
    //             'id' => $data[0]->id,
    //             'name' => $data[0]->name,
    //             'position' => $data[0]->position,
    //             'salary' => $data[0]->salary,
    //             'department' => $data[0]->department,
    //             'date_hired' => $data[0]->date_hired
    //             );
    //         $this->session->set_userdata($user_data);

    //       echo 'registered';


    //     } else {
    //         echo 'error';
    //     }

    // }


}
