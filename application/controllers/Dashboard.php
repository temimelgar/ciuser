<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->helper(array('url','date'));


         session_check();
        $this->load->model('dashboard_model');
        $this->load->model('account_info_model');
    }
    
    public function index()
    {   
        $data['title']   = "Billing Entry (Communications)";
        $data['content'] = "dashboard_view";
        $data['head_title'] = "Billing Entry (Communications)";
        $data['data'] = $this->account_info_model->get_dues();            
        $get_data = $this->account_info_model->get_due_today();
        $get_data_tom = $this->account_info_model->get_due_tomorrow();
        $get_data_2days = $this->account_info_model->get_due_2days();
        $get_data_3days = $this->account_info_model->get_due_3days();
        $get_data_4days = $this->account_info_model->get_due_4days();
        $get_data_5days = $this->account_info_model->get_due_5days();
        $get_data_6days = $this->account_info_model->get_due_6days();
        $get_data_7days = $this->account_info_model->get_due_7days();
        $data['bilang'] = $get_data->num_rows();
        $data['tomcount'] = $get_data_tom->num_rows();
        $data['count2days'] = $get_data_2days->num_rows();
        $data['count3days'] = $get_data_3days->num_rows();
        $data['count4days'] = $get_data_4days->num_rows();
        $data['count5days'] = $get_data_5days->num_rows();
        $data['count6days'] = $get_data_6days->num_rows();
        $data['count7days'] = $get_data_7days->num_rows();
        // $data['count2days'] = $row['count2days'];
        

        $this->load->view('template/template',$data);
 }

 function transactions() {
    $data['title']   = "Incoming Dues (Today)";
    $data['content'] = "incoming_dues_view";
    $data['head_title'] = "Incoming Dues (Today)";
    // $data['data'] = $this->account_info_model->get_dues();            
    $data['data'] = $this->account_info_model->get_due_details_today();

    $this->load->view('template/template',$data);
 }

  function transactions_tomorrow() {
    $data['title']   = "Incoming Dues (Tomorrow)";
    $data['content'] = "incoming_dues_view";
    $data['head_title'] = "Incoming Dues (Tomorrow)";
    // $data['data'] = $this->account_info_model->get_dues();            
    $data['data'] = $this->account_info_model->get_due_details_tomorrow();

    $this->load->view('template/template',$data);
 }

   function transactions_2days() {
    $data['title']   = "Incoming Dues (2 Days)";
    $data['content'] = "incoming_dues_view";
    $data['head_title'] = "Incoming Dues (2 Days)";
    // $data['data'] = $this->account_info_model->get_dues();            
    $data['data'] = $this->account_info_model->get_due_details_2days();

    $this->load->view('template/template',$data);
 }

   function transactions_3days() {
     $data['title']   = "Incoming Dues (3 Days)";
        $data['content'] = "incoming_dues_view";
        $data['head_title'] = "Incoming Dues (3 Days)";
        // $data['data'] = $this->account_info_model->get_dues();            
        $data['data'] = $this->account_info_model->get_due_details_3days();

        $this->load->view('template/template',$data);
 }

   function transactions_4days() {
     $data['title']   = "Incoming Dues (4 Days)";
        $data['content'] = "incoming_dues_view";
        $data['head_title'] = "Incoming Dues (4 Days)";
        // $data['data'] = $this->account_info_model->get_dues();            
        $data['data'] = $this->account_info_model->get_due_details_4days();

        $this->load->view('template/template',$data);
 } 

   function transactions_5days() {
     $data['title']   = "Incoming Dues (5 Days)";
        $data['content'] = "incoming_dues_view";
        $data['head_title'] = "Incoming Dues (5 Days)";
        // $data['data'] = $this->account_info_model->get_dues();            
        $data['data'] = $this->account_info_model->get_due_details_5days();

        $this->load->view('template/template',$data);
 }  

   function transactions_6days() {
     $data['title']   = "Incoming Dues (6 Days)";
        $data['content'] = "incoming_dues_view";
        $data['head_title'] = "Incoming Dues (6 Days)";
        // $data['data'] = $this->account_info_model->get_dues();            
        $data['data'] = $this->account_info_model->get_due_details_6days();

        $this->load->view('template/template',$data);
 }  

   function transactions_7days() {
     $data['title']   = "Incoming Dues (7 Days)";
        $data['content'] = "incoming_dues_view";
        $data['head_title'] = "Incoming Dues (7 Days)";
        // $data['data'] = $this->account_info_model->get_dues();            
        $data['data'] = $this->account_info_model->get_due_details_7days();

        $this->load->view('template/template',$data);
 }   

}