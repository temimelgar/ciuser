<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Provider extends CI_Controller {
    public function __construct(){
        parent::__construct();

         session_check();
        $this->load->model('provider_model');

    }

    function index() {
        $data['content'] = 'provider_view';
        $data['title'] = 'Provider Maintenance';
        $data['head_title'] = 'Provider Maintenance';
        $data['data'] = $this->provider_model->get_providers();
        $data['categories'] = $this->provider_model->get_categories();
        // ~ $data['items'] = $this->category->get_category_items();
        $this->load->view('template/template',$data);       
    }

    function validate_provider() {
            $suppliername = $this->input->post('suppliername');
            $activefrom = $this->input->post('activefrom');
            $suppliercategory = $this->input->post('suppliercategory');
            $last_user = $this->session->userdata('full_name');

                if(!$this->provider_model->check_duplicate_provider($suppliername)){
                    $new_registered_provider = $this->provider_model->save_new_provider($suppliername, $activefrom, $suppliercategory, $last_user);
                    echo json_encode($new_registered_provider);
                } else {
                    echo json_encode(false);
                }

    }



        public function get_edit(){
        $id = $this->uri->segment(3);
        $data['id'] = $id;        
        $data['categories'] = $this->provider_model->get_categories();
        $get_data = $this->provider_model->get_provider_by_id($id);
        if($get_data->num_rows() > 0){

            $row = $get_data->row_array();
            $data['isactive'] = $row['isactive'];
            $data['category'] = $row['category'];
        }   
    
         $data['content'] = 'provider_edit_view';
        $data['title'] = 'Update Provider';
        $data['head_title'] = 'Provider Maintenance';        
        $this->load->view('template/template',$data);           
        
    }    

        public function get_provider_by_id() {
        $id = $this->input->post('id',TRUE);
        $data = $this->provider_model->get_provider_by_id($id)->result();
        echo json_encode($data);
    }

        function update_provider() {
        $id = $this->input->post('id',TRUE);
        $activecheckbox = $this->input->post('activecheckbox',TRUE);
        $activeFromUpdate = $this->input->post('activeFromUpdate',TRUE);
        $supplierNameUpdate = $this->input->post('supplierNameUpdate',TRUE);
        $suppliercategory = $this->input->post('suppliercategory',TRUE);
        $inactivedate = $this->input->post('inactivedate',TRUE);
        $last_user = $this->session->userdata('full_name');


        $data = $this->provider_model->update_isactive($id, $activecheckbox, $activeFromUpdate, $supplierNameUpdate, $suppliercategory, $inactivedate, $last_user);

        // redirect('provider');
    }

    function exportProvider() {
        $filename = 'List of Communication.xls';

        $this->load->library('excel');
        $providerInfo = $this->provider_model->export_providers();
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);

        $excel->getActiveSheet()->SetCellValue('A1', 'SUPPLIER NAME')->getStyle('A1:F1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('B1', 'ACTIVE FROM')->getStyle('A1:F1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('C1', 'CATEGORY')->getStyle('A1:F1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('D1', 'STATUS')->getStyle('A1:F1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('E1', 'UPDATE BY')->getStyle('A1:F1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('F1', 'UPDATE DATE')->getStyle('A1:F1')->getFont()->setBold(true);


        $row = 2;

        foreach ($providerInfo as $element)
        {
            $excel->getActiveSheet()->SetCellValue('A'.$row, $element['supplier_name']);
            $excel->getActiveSheet()->SetCellValue('B'.$row, $element['active_from']);
            $excel->getActiveSheet()->SetCellValue('C'.$row, ($element['supplier_category'] == 1 ? 'Communication' : 'Courier'));
            $excel->getActiveSheet()->SetCellValue('D'.$row, ($element['supplier_category'] == 1 ? 'Active' : 'Inactive'));
            $excel->getActiveSheet()->SetCellValue('E'.$row, $element['last_user'] );
            $excel->getActiveSheet()->SetCellValue('F'.$row, $element['update_date'] );

            $row++;
        }
$object_excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');// Explain format of Excel data
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=”'.$filename);
$object_excel_writer->save('php://output');



    }
   
}
