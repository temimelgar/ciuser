<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class BillingEntry extends CI_Controller 
{
    public function __construct(){
        parent::__construct();

         session_check();
        $this->load->model('account_info_model');
        $this->load->model('provider_model');
        $this->load->database('ipc_central');
        $this->load->model('ipc_model');
        $this->load->model('paid_model');
        $this->load->library('excel');

    }

    function index() {
        $data['content'] = 'new_billing_entry_view';
        $data['title'] = 'New Billing Entry';
        $data['head_title'] = 'New Billing Entry';
        $data['alert'] = '';
        // $data['data'] = $this->account_info_model->fetch_all_landlines();
        $data['data'] = $this->account_info_model->fetch_all();
        $data['typesmobile'] = $this->provider_model->get_types_mobile();        
        $data['typeslandline'] = $this->provider_model->get_types_landline();        
        // $data['types'] = $this->provider_model->get_types_landline();
        // $data['employees'] = $this->ipc_model->fetch_personal_info();
        // ~ $data['items'] = $this->category->get_category_items();
        $this->load->view('template/template',$data);       
    }

    function get_type_by_supplierid() {
        $supplier_id = $this->input->post('id', TRUE);
        $data = $this->account_info_model->get_type_by_supplierid($supplier_id);
        echo json_encode($data);
    }

    function fetch()
    {
        $data = $this->account_info_model->select();
        $output = "
        <table class='table table-striped table-bordered'>
            <tr>
                <th>Account Number</th>
                <th>Assignee</th>
                <th>Phone Number</th>
                <th>Account Limit</th>
                <th>Supplier ID</th>
            </tr> 
        ";

        foreach ($data->result() as $row) {
            $output.="
            <tr>
                <td>".$row->t_account_number."</td>
                <td>".$row->t_assignee."</td>
                <td>".$row->t_phone_number."</td>
                <td>".$row->t_amount_limit."</td>
                <td>".$row->t_supplier_id."</td>
            </tr>   
            ";
        }

        $output.= "</table>";
        echo $output;
    }

    // function checkupload()
    // {
    //     // $supplier = $this->input->post('supplier', true);
    //     // $type = $this->input->post('type', true);
    //     $data = $this->input->post('data');
    //     $data = json_decode($data);

    //     foreach($data as $r) {
    //       $this->excel->getActiveSheet()->fromArray(array(
    //         $r['accountnumber'], $r['assignee'], $r['phonenumber'], $r['accountlimit'],
    //         $r['supplierid']), null, 'A' . $row
    //       );
    //       $this->excel->getActiveSheet()
    //                   ->getStyle('A' . $row . ':L' . $row)
    //                   ->applyFromArray($styleArray2);
    //       $this->excel->getActiveSheet()
    //                   ->getStyle('A' . $row . ':L' . $row)
    //                   ->applyFromArray($styleArray4);
    //       $row ++;
    //     }
    //     echo $r;

    // }


    function import()
    {
        $supplier = $this->input->post('supplier', TRUE);
        $type = $this->input->post('type', TRUE);
        $getbillingentryno = $this->account_info_model->get_billingentryno();
        $getbillingentryno =$getbillingentryno + 1;
        $last_user = $this->session->userdata('full_name');

        if(isset($_FILES["excel"]["name"]))
        {
            $path = $_FILES["excel"]["tmp_name"];
            $excel = PHPExcel_IOFactory::load($path);
            $excel-> setActiveSheetIndex(0);


            $output = " 

            <table class='table table-striped table-bordered' style='white-space: nowrap;'>
            <thead>
            <tr>
            <th>Account No</th>
            <th>Assignee</th>
            <th>Section</th>
            <th>Phone Number</th>
            <th>Due Date</th>
            <th>Bill. Cov. (From)</th>
            <th>Bill. Cov. (To)</th>
            <th>Gross</th>
            <th>VAT</th>
            <th>Vatable</th>
            <th>NVAT</th>
            <th>Adj</th>
            <th>Withholding Tax</th>
            <th>Net Pay</th>
            <th>Statement Date</th>
            <th>Amount Limit</th>
            <th>SOA Number</th>

            </tr> 
            </thead>
            <tbody>
            ";
            $i = 2;
            $count = 1;
            $ctr = 0;
            $total = 0;
            $totalgross = 0;
            $totalvat = 0;
            $totalvatable = 0;
            $totalnvat = 0;
            $totaladj = 0;
            $totalwtx = 0;
            $totalnetpay = 0;
            // foreach($object->getWorksheetIterator() as $worksheet)
            // {
            //  $highestRow = $worksheet->getHighestRow();
            //  $highestColumn = $worksheet->getHighestColumn();

            while ($excel-> getActiveSheet()->getCell('A'.$i)->getValue() != "") 
            {
                $account_number = $excel->getActiveSheet()->getCell('A'.$i)->getValue();
                $billfrom = $excel->getActiveSheet()->getCell('B'.$i)->getValue();
                $billto = $excel->getActiveSheet()->getCell('C'.$i)->getValue();
                $statement_date = $excel->getActiveSheet()->getCell('D'.$i)->getValue();
                $soanumber = $excel->getActiveSheet()->getCell('E'.$i)->getValue();
                $checkedreference = $excel->getActiveSheet()->getCell('F'.$i)->getValue();
                $orno = $excel->getActiveSheet()->getCell('G'.$i)->getValue();
                $ordate = $excel->getActiveSheet()->getCell('H'.$i)->getValue();
                $gross = $excel->getActiveSheet()->getCell('I'.$i)->getValue();


                $adj = 0;
                $adjs = 0;
                $vats  = ($gross/1.12)*.12;
                $vat  = round($vats, 2);
                $vatables = $vats/.12;
                $vatable  = number_format((float)$vatables, 2, '.', ','); 
                $nvats = (($gross - $vats) - $vatables);
                $nvat  =round($nvats, 2);   

                $wtxs = ($vatables + $nvats) * 0.02;      
                $wtx  = number_format((float)$wtxs, 2, '.', ','); ;

                $netpays = $gross - $wtxs;
                $netpay  = number_format((float)$netpays, 2, '.', ',');                 
                // $billfromdate = ($billfrom - 25569) * 86400;
                // $billfromdate = gmdate('m-d-Y', $billfromdate);
                // $billfromdate_mysql = date('Y-m-d', strtotime($billfromdate));                



                // if ($billfromdate == '12-30-1899') {
                //     $billfromdate = '';
                // }

                $billfrom_date = ($billfrom - 25569) * 86400;
                $billfromdate = date('Y-m-d', $billfrom_date);


                $billtodate_date = ($billto - 25569) * 86400;
                $billtodate = date('Y-m-d', $billtodate_date);

             

                $statementdate = ($statement_date - 25569) * 86400;
                $statementdate = date('Y-m-d', $statementdate);

                $or_date = ($ordate - 25569) * 86400;
                $or_date = gmdate('Y-m-d', $or_date);  
  
                if ($i > 1) 
                {
                    $checkexisting = $this->account_info_model->checkpaid($supplier, $type, $account_number, $soanumber); 
                    if($checkexisting->num_rows() != 0)
                    {
                        $alert='';
                        $button='';
                        $output.= "<div class='alert alert-danger' role='alert'>There's an error on your Excel file. Please Try again.</div><br>";
                        break;

                    } else {
                    $selectdata = $this->account_info_model->select_existing($supplier, $type, $account_number);


                    if($selectdata->num_rows() != 0)
                    {

                        $alert= "";
                        $style="";
                        $button="<button class='btn btn-danger' style='position: absolute; margin-right: 30px' id='savedata' name='savedata' type='submit'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Submit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>"; 
                        $row = $selectdata->row_array();
                        $phone_number = $row['phone_number'];
                        $assignee = $row['assignee'];
                        $assigneesection = $row['assigneesection'];
                        $amount_limit = $row['amount_limit'];                        
                        $due_date = $row['due_date'];      
                        $accountno = $row['account_number'];


                                                $readonly = ''; 

                                        

                    } 
                    else 
                    {

                        $fullname = $row['fullname'];
                        $row = $selectdata->row_array();
                        $phone_number = $row['phone_number'];
                        $assignee = $row['assignee'];
                        $assigneesection = $row['assigneesection'];                        
                        $amount_limit = $row['amount_limit'];
                        $due_date = $row['due_date'];
                        $accountno = "";
                        $button="";
                        $style="style='color:red'";
                        $alert = "<div class='alert alert-danger' role='alert'>There's an error on your Excel file. Please Try again. 
                        <a href='".site_url()."/billingentry'>Click Here to Refresh.</a></div><br>";
                        $gross ="0.00";
                        $vat ="0.00";
                        $vats ="0.00";
                        $vatables ="0.00";
                        $vatable ="0.00";
                        $nvat ="0.00";
                        $nvats ="0.00";
                        $wtx ="0.00";
                        $wtxs ="0.00";
                        $netpays = "0.00";
                        $netpay = "0.00";                        
                        $readonly = 'readonly';
                $adj = 0;
                $adjs = 0;
                        // break;

                    }
                    }
                }

                $output.="
                <tr>
                <input type='hidden' id='count' class='form-control' name='count[]' value='".$count."'>
                <input type='hidden' id='billingentryno' class='form-control' name='billingentryno[]' value='".$getbillingentryno."'>
                <input type='hidden' id='supplierid' class='form-control' name='supplierid[]' value='".$supplier."'>
                <input type='hidden' id='typeid' class='form-control' name='typeid[]' value='".$type."'>
                <input type='hidden' id='accountno' class='form-control' name='accountnumber[]' value='".$accountno."'>
                <input type='hidden' id='assignee' class='form-control' name='assignee[]' value='".$assignee."'>
                <input type='hidden' id='assigneesection' class='form-control' name='assigneesection[]' value='".$assigneesection."'>
                <input type='hidden' id='phonenumber' class='form-control' name='phonenumber[]' value='".$phone_number."'>
                <input type='hidden' id='duedate' class='form-control' name='duedate[]' value='".$due_date ."'>
                <input type='hidden' id='billfromdate' class='form-control' name='billfromdate[]' value='".$billfromdate."'>
                <input type='hidden' id='billtodate' class='form-control' name='billtodate[]' value='".$billtodate."'>
                <input type='hidden' id='statementdate' class='form-control' name='statementdate[]' value='".$statementdate."'>
                <input type='hidden' id='amount_limit' class='form-control' name='amount_limit[]' value='".$amount_limit."'>
                <input type='hidden' id='soanumber' class='form-control' name='soanumber[]' value='".$soanumber."'>
                <input type='hidden' id='checkedreference' class='form-control' name='checkedreference[]' value=''>
                <input type='hidden' id='orno' class='form-control' name='orno[]' value=''>
                <input type='hidden' id='or_date' class='form-control' name='or_date[]' value=''>
                <input type='hidden' id='gross".$ctr."' class='form-control' name='gross[]' value='".$gross."'>
                <input type='hidden' id='last_user' class='form-control' name='last_user[]' value='".$last_user."'>
                <input type='hidden' id='vatables".$ctr."' class='form-control' name='vatables[]' value='".$vatables."'>
                <input type='hidden' id='nvats".$ctr."' class='form-control' name='nvats[]' value='".$nvats."'>
                <input type='hidden' id='netpays".$ctr."' class='form-control' name='netpays[]' value='".$netpays."'>
                <input type='hidden' id='adjs".$ctr."' class='form-control' name='adjs[]' value='".$adjs."'>
                <input type='hidden' id='wtxs".$ctr."' class='form-control' name='wtxs[]' value='".$wtxs." ".$ctr."'>

                <td ".$style."><strong>".$account_number."</strong></td>
                <td ".$style.">".$assignee."</td>
                <td ".$style.">".$assigneesection."</td>
                <td ".$style.">".$phone_number."</td>
                <td ".$style.">".$due_date."</td>
                <td ".$style.">".mydateFormat($billfromdate)."</td>
                <td ".$style.">".mydateFormat($billtodate)."</td>
                <td ".$style.">".number_format((float)$gross, 2, '.', ',')."</td>
                <td ><input type='text'  id='vat".$ctr."' ".$readonly." class='input-sm form-control vat' name='vat[]' value='".$vat."' style='width: 120px; font-size: 12px' min='00.00'>               
                <input type='hidden' id='vattemp".$ctr."' ".$readonly." class='input-sm form-control vattemp' name='vattemp[]' value='".$vat."' style='width: 120px; font-size: 12px'></td>                              
                <td ><input type='text' id='vatable".$ctr."' class='input-sm form-control' name='vatable[]' value='".$vatable."' style='width: 120px; font-size: 12px' readonly></td>                
                <td ><input type='text' id='nvat".$ctr."' class='input-sm form-control nvat' name='nvat[]' value='".$nvat."' style='width: 120px; font-size: 12px' readonly>
                </td>                            
                <td ><input type='text' id='adj".$ctr."' class='input-sm form-control adj' name='adj[]' value='".$adj."' style='width: 120px; font-size: 12px' readonly></td>                
                <td ><input type='text' id='wtx".$ctr."' class='input-sm form-control wtx' name='wtx[]' value='".$wtx."'style='width: 100px; font-size: 12px' readonly></td>                
                <td ><input type='text' id='netpay".$ctr."' class='input-sm form-control netpay' name='netpay[]' value='".$netpay."'style='width: 120px; font-size: 12px' readonly></td>                
                <td ".$style.">".mydateFormat($statementdate)."</td>
                <td ".$style.">".$amount_limit."</td>
                <td ".$style.">".$soanumber."</td>


                </tr>
               
                ";
                // foreach ($selectdata->result() as $row) {

                // $this->account_info_model->insert($data);
                // echo 'Data Imported successfully';

                // print_r($selectdata) ;
                $i++;
                $count++;
                $ctr++;
                $totalgross = $totalgross + $gross;
                $totalvat = $totalvat + $vats;
                $totalvatable = $totalvatable + $vatables;
                $totalnvat = $totalnvat + $nvats;
                $totalwtx = $totalwtx + $wtxs;
                $totalnetpay = $totalnetpay + $netpays;

   

            } 

                    if($checkexisting->num_rows() != 0)
                    {
                    $output.='';
                } else {
                $output.=" <tfoot>
                    <tr>
            <th>
            <br><input type='hidden' id='totalsupplier' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalsupplier' value='".$supplier."' readonly></th>
             <th>
            <br><input type='hidden' id='totaltype' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totaltype' value='".$type."' readonly></th>
             <th>
            <br><input type='hidden' id='totalgetbillingentryno' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalgetbillingentryno' value='".$getbillingentryno."' readonly></th>
             <th>
            <br><input type='hidden' id='totallastuser' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totallastuser' value='".$last_user."' readonly></th>
            <th></th>
            <th></th>
                        <th></th>
            <th>Gross Total
            <br><input type='hidden' id='totalgross' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalgross' value='".$totalgross."' readonly>
            <input type='text' id='totalgrossdisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalgrossdisplay' value='".number_format((float)$totalgross, 2, '.', ',')."' readonly></th>

            <th>VAT Total
            <br><input type='hidden' id='totalvat' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalvat' value='".$totalvat."' readonly>
            <input type='text' id='totalvatdisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalvatdisplay' value='".number_format((float)$totalvat, 2, '.', ',')."' readonly></th>

            <th>Vatable Total
            <br><input type='hidden' id='totalvatable' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalvatable' value='".$totalvatable."'  readonly>
            <input type='text' id='totalvatabledisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalvatabledisplay' value='".number_format((float)$totalvatable, 2, '.', ',')."'  readonly></th>

            <th>NVAT Total
            <br><input type='hidden' id='totalnvat' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalnvat' value='".$totalnvat."'  readonly>
            <input type='text' id='totalnvatdisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalnvatdisplay' value='".number_format((float)$totalnvat, 2, '.', ',')."'  readonly></th>


            <th>Adj Total
            <br><input type='hidden' id='totaladj' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totaladj' value='".$totaladj."'  readonly>
            <input type='text' id='totaladjdisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totaladjdisplay' value='".number_format((float)$totaladj, 2, '.', ',')."'  readonly></th>


            <th>W.Tax Total
            <br><input type='hidden' id='totalwtx' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalwtx' value='".$totalwtx."'  readonly>
            <input type='text' id='totalwtxdisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalwtxdisplay' value='".number_format((float)$totalwtx, 2, '.', ',')."'  readonly></th>

            <th>Net Pay Total
            <br><input type='hidden' id='totalnetpay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalnetpay' value='".$totalnetpay."'  readonly>
            <input type='text' id='totalnetpaydisplay' style='background-color:#d21404; font-size: 13px; color: white; width: 100px;' class='input-sm form-control' name='totalnetpaydisplay' value='".number_format((float)$totalnetpay, 2, '.', ',')."'  readonly></th>
            <th></th>
            <th></th>
            <th></th>

                    </tr>

                </tfoot></tbody></table>";
}
        $output.=$alert;
        $output.=$button .'<br>' ;
        $output.="<br></div>";
        echo $output;   
        }

   



    }

    function batchInsert(){


        $result = $this->account_info_model->insert($_POST);
                 $this->account_info_model->delete_empty();


            if($result){
                echo 1;
            }
            else{
                echo 0;
            }
    }


    function viewbillingentries() {
        $data['content'] = 'billing_entries_view';
        $data['title'] = 'View Billing Entries (Paid)';
        $data['head_title'] = 'View Billing Entries (Paid)';
        $data['alert'] = '';
        $data['data'] = $this->paid_model->fetch_paid_details();
        // $data['datarow'] = count($data['data']);
        // $data['typesmobile'] = $this->provider_model->get_types_mobile();        
        // $data['typeslandline'] = $this->provider_model->get_types_landline();        
        $this->load->view('template/template',$data);            
    }

    function getpaidbybillingentryno() {
        $billing_entry_number = $this->uri->segment(3);
        $data['billing_entry_number'] = $billing_entry_number;        
        $data['data'] = $this->paid_model->get_paid_entries_by_billing_entry_no($billing_entry_number);
        // if($get_data->num_rows() > 0){

        //     $row = $get_data->row_array();
        //     $data['inactive'] = $row['inactive'];
        //     // $data['type'] = $row['type'];
        // }   
    
         $data['content'] = 'paid_entries_view';
        $data['title'] = 'Billing Entry Details :  ' . $billing_entry_number;
        $data['head_title'] = 'Billing Entry Details :  ' . $billing_entry_number;        
        $this->load->view('template/template',$data);        

    }


        function updatepaidbyid()
        {
        $id = $this->uri->segment(3);
        $data['id'] = $id;        
        $data['data'] = $this->paid_model->get_paid_entries_by_id($id);  
    
        $data['content'] = 'update_paid_entries_by_id_view';
        $data['title'] = 'Billing Entry Details ID :  ' . $id;
        $data['head_title'] = 'Billing Entry Details ID :  ' . $id;        
        $this->load->view('template/template',$data);            
        }    

        function exportbillingentries() {
        $filename = 'List of Billing Entries (Communication) as of '.date("m-d-Y").'.xls';

        $this->load->library('excel');
        $providerInfo = $this->paid_model->fetch_paid_details_array();
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);

        $excel->getActiveSheet()->SetCellValue('A1', 'BILLING ENTRY NO')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('B1', 'SUPPLIER NAME')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('C1', 'TYPE NAME')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('D1', 'PAYMENT DATE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('E1', 'GROSS')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('F1', 'VAT')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('G1', 'VATABLE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('H1', 'NVAT')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('I1', 'ADJ')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('J1', 'WITHHOLDING TAX')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('K1', 'NET PAY')->getStyle('A1:Z1')->getFont()->setBold(true);
        // $excel->getActiveSheet()->SetCellValue('L1', 'STATUS')->getStyle('A1:Z1')->getFont()->setBold(true);
        // $excel->getActiveSheet()->SetCellValue('M1', 'INACTIVE DATE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('L1', 'LAST USER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('M1', 'LAST UPDATE')->getStyle('A1:Z1')->getFont()->setBold(true);


        $row = 2;

        foreach ($providerInfo as $element)
        {
            $excel->getActiveSheet()->SetCellValue('A'.$row, $element['billing_entry_no']);
            $excel->getActiveSheet()->SetCellValue('B'.$row, $element['supplier_name']);
            $excel->getActiveSheet()->SetCellValue('C'.$row, $element['type_name']);
            $excel->getActiveSheet()->SetCellValue('D'.$row, $element['payment_date']);
            $excel->getActiveSheet()->SetCellValue('E'.$row, $element['grosstotal'] );
            $excel->getActiveSheet()->SetCellValue('F'.$row, $element['vattotal'] );
            $excel->getActiveSheet()->SetCellValue('G'.$row, $element['vatabletotal'] );
            $excel->getActiveSheet()->SetCellValue('H'.$row, $element['nvattotal'] );
            $excel->getActiveSheet()->SetCellValue('I'.$row, $element['adjtotal'] );
            $excel->getActiveSheet()->SetCellValue('J'.$row, $element['wtxtotal'] );
            $excel->getActiveSheet()->SetCellValue('K'.$row, $element['netpaytotal'] );
            // $excel->getActiveSheet()->SetCellValue('L'.$row, ($element['inactive'] == 1 ? 'Active' : 'Inactive'));
            // $excel->getActiveSheet()->SetCellValue('M'.$row, ($element['inactive_date'] == '0000-00-00' ? '' : $element['inactive_date']));
            $excel->getActiveSheet()->SetCellValue('L'.$row, $element['last_user']);
            $excel->getActiveSheet()->SetCellValue('M'.$row, $element['last_update']);

            $row++;
        }
$object_excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');// Explain format of Excel data
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$filename);
$object_excel_writer->save('php://output');



    }

    function exportbillingentrybydetails()
    {
         $billing_entry_number = $this->uri->segment(3);
        $data['billing_entry_number'] = $billing_entry_number;        

        $filename = 'List of Billing Entry No. '. $billing_entry_number . ' (Communication) as of '.date("m-d-Y").'.xls';

        $this->load->library('excel');
        $providerInfo = $this->paid_model->get_paid_entries_by_billing_entry_no_array($billing_entry_number);
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);

        $excel->getActiveSheet()->SetCellValue('A1', 'BILLING ENTRY NO')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('B1', 'ACCOUNT NUMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('C1', 'ASSIGNEE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('D1', 'SECTION')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('E1', 'SUPPLIER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('F1', 'TYPE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('G1', 'PAYMENT DATE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('H1', 'CHECKED REFERENCE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('I1', 'OR NUMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('J1', 'OR DATE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('K1', 'DUE DATE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('L1', 'BILLING FROM')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('M1', 'BILLING TO')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('N1', 'SOA NUMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('O1', 'GROSS')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('P1', 'VAT')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('Q1', 'VATABLE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('R1', 'NVAT')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('S1', 'ADJ')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('T1', 'WITHHOLDING TAX')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('U1', 'NET PAY')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('V1', 'LAST USER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('W1', 'LAST UPDATE')->getStyle('A1:Z1')->getFont()->setBold(true);



        $row = 2;

        foreach ($providerInfo as $element)
        {
            $excel->getActiveSheet()->SetCellValueExplicit('A'.$row, $element['billing_entry_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->SetCellValueExplicit('B'.$row, $element['account_number'], PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->SetCellValue('C'.$row, $element['assignee']);
            $excel->getActiveSheet()->SetCellValue('D'.$row, $element['assigneesection']);
            $excel->getActiveSheet()->SetCellValue('E'.$row, $element['supplier_name']);
            $excel->getActiveSheet()->SetCellValue('F'.$row, $element['type_name'] );
            $excel->getActiveSheet()->SetCellValue('G'.$row, $element['payment_date'] );
            $excel->getActiveSheet()->SetCellValueExplicit('H'.$row, $element['checked_reference'], PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->SetCellValueExplicit('I'.$row, $element['or_number'], PHPExcel_Cell_DataType::TYPE_STRING );
            $excel->getActiveSheet()->SetCellValue('J'.$row, $element['or_date'] );
            $excel->getActiveSheet()->SetCellValue('K'.$row, $element['due_date'] );
            $excel->getActiveSheet()->SetCellValue('L'.$row, $element['billing_from'] );
            $excel->getActiveSheet()->SetCellValue('M'.$row, $element['billing_to']);
            $excel->getActiveSheet()->SetCellValueExplicit('N'.$row, $element['soa'], PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->SetCellValue('O'.$row, $element['gross']);
            $excel->getActiveSheet()->SetCellValue('P'.$row, $element['vat']);
            $excel->getActiveSheet()->SetCellValue('Q'.$row, $element['vatable']);
            $excel->getActiveSheet()->SetCellValue('R'.$row, $element['nvat']);
            $excel->getActiveSheet()->SetCellValue('S'.$row, $element['adj']);
            $excel->getActiveSheet()->SetCellValue('T'.$row, $element['wtx']);
            $excel->getActiveSheet()->SetCellValue('U'.$row, $element['net_pay']);
            $excel->getActiveSheet()->SetCellValue('V'.$row, $element['last_user']);
            $excel->getActiveSheet()->SetCellValue('W'.$row, $element['last_update']);

            $row++;
        }
$object_excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');// Explain format of Excel data
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$filename);
$object_excel_writer->save('php://output');
    }

    function update_adustment()
    {
        $id = $this->input->post('newid');
        $newAdj = $this->input->post('newadj');
        $nvat = $this->input->post('nvat');
        $newvatable = $this->input->post('newvatable');
        $newgross = $this->input->post('newgross');
        $newbilling_entry_no = $this->input->post('newbilling_entry_no');
        $last_user = $this->session->userdata('full_name');        

        $data = $this->paid_model->update_adjustment($newAdj, $last_user, $nvat, $id, $newvatable, $newgross);
        $data2 = $this->paid_model->update_paid_details_by_billing_entry_no($newbilling_entry_no, $last_user);


    }


    function update_wtx()
    {
        $id = $this->input->post('newid');
        $netpay = $this->input->post('netpay');
        $newwitholdingtax = $this->input->post('newwitholdingtax');
        $newbilling_entry_no = $this->input->post('newbilling_entry_no');
        $last_user = $this->session->userdata('full_name');        

        $data = $this->paid_model->update_wtx($id, $netpay,$newwitholdingtax, $newbilling_entry_no, $last_user);
        $data2 = $this->paid_model->update_paid_details_by_billing_entry_no($newbilling_entry_no, $last_user);


    }


    function billing_entry_monthly()
    {
        $data['content'] = 'monthly_billing_entry_view';
        $data['title'] = 'Billing Entry - Monthly Report';
        $data['head_title'] = 'Billing Entry - Monthly Report';
        // $data['data'] = $this->account_info_model->fetch_all_landlines();
        // $data['data'] = $this->account_info_model->fetch_all();
        // $data['typesmobile'] = $this->provider_model->get_types_mobile();        
        // $data['typeslandline'] = $this->provider_model->get_types_landline();        
        // $data['types'] = $this->provider_model->get_types_landline();
        // $data['employees'] = $this->ipc_model->fetch_personal_info();
        // ~ $data['items'] = $this->category->get_category_items();     
        $data['providers'] = $this->provider_model->get_providers();        
        $this->load->view('template/template',$data);       
    }



    function table_billing_entry_monthly() 
    {
        $year = $this->input->post('year');
        // $dateend = $this->input->post('dateend');
        $supplier = $this->input->post('supplier');
        $data = $this->paid_model->get_billing_entry_by_date_and_supplier($year, $supplier);

        if($data->num_rows() == 0)
        {
        $output = "<div class='alert alert-danger' role='alert'>Sorry! No Billing Entry Found. Please try again. 
                        <a href='".site_url()."/billingentry/billing_entry_monthly'>Click Here to Refresh.</a></div><br>";
        } else {

        $output = "
        <table class='table table-striped table-bordered' style='white-space: nowrap;' id='billingentrymonthlyreporttable'>
            <thead>
                <tr>
                    <th>Assignee</th>
                    <th>Section</th>
                    <th>Account Number</th>
                    <th>Type</th>
                    <th>January</th>
                    <th>February</th>
                    <th>March</th>
                    <th>April</th>
                    <th>May</th>
                    <th>June</th>
                    <th>July</th>
                    <th>August</th>
                    <th>September</th>
                    <th>October</th>
                    <th>November</th>
                    <th>December</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>";

            
        foreach ($data->result() as $row) {

            $total = $row->january + $row->february + $row->march + $row->april + $row->may + $row->june + $row->july + $row->august + $row->september + $row->october + $row->november + $row->december;
            $output.="
            <tr>
                <td>".$row->assignee."</td>
                <td>".$row->assigneesection."</td>
                <td>".$row->account_number."</td>
                <td>".$row->type_name."</td>
                <td>". number_format((float)$row->january, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->february, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->march, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->april, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->may, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->june, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->july, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->august, 2, '.', ',')."</td>
                <td>". number_format((float)$row->september, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->october, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->november, 2, '.', ',') ."</td>
                <td>". number_format((float)$row->december, 2, '.', ',') ."</td>
                <th>". number_format((float)$total, 2, '.', ',')  ."</th>




            </tr>   
            ";
        }

        $output.= "</table>";
        // $output.="<input type='text' value='".$year."' id='yearexport'>";
        // $output.="<input type='text' value='".$supplier."' id='supplierexport'>";
       $output.="<a href='".base_url()."billingentry/export_table_billing_entry_monthly/".$supplier."/".$year."' class='btn btn-danger' id='exportBillingEntryPerMonth' type='button'>Export</a href='<?php echo base_url(); ?>billingentry/export_table_billing_entry_monthly/'>";        
  $output.="<br></div>";
  }

        echo $output;
    }

    function export_table_billing_entry_monthly()
    {
        $supplier = $this->uri->segment(3);
        $year = $this->uri->segment(4);
 
        $this->load->library('excel');
        $data = $this->paid_model->get_billing_entry_by_date_and_supplier_excel($supplier, $year);
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);

        $excel->getActiveSheet()->SetCellValue('A1', 'ASSIGNEE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('B1', 'SECTION')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('C1', 'ACCOUNT NUMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('D1', 'TYPE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('E1', 'JANUARY')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('F1', 'FEBRUARY')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('G1', 'MARCH')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('H1', 'APRIL')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('I1', 'MAY')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('J1', 'JUNE')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('K1', 'JULY')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('L1', 'AUGUST')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('M1', 'SEPTEMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('N1', 'OCTOBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('O1', 'NOVEMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('P1', 'DECEMBER')->getStyle('A1:Z1')->getFont()->setBold(true);
        $excel->getActiveSheet()->SetCellValue('Q1', 'TOTAL')->getStyle('A1:Z1')->getFont()->setBold(true);



        $row = 2;

        foreach ($data as $element)
        {
            $excel->getActiveSheet()->SetCellValue('A'.$row, $element['assignee']);
            $excel->getActiveSheet()->SetCellValue('B'.$row, $element['assigneesection']);
            $excel->getActiveSheet()->SetCellValue('C'.$row, $element['account_number']);
            $excel->getActiveSheet()->SetCellValue('D'.$row, $element['type_name'], PHPExcel_Cell_DataType::TYPE_STRING);
            $excel->getActiveSheet()->SetCellValue('E'.$row, $element['january']);
            $excel->getActiveSheet()->SetCellValue('F'.$row, $element['february'] );
            $excel->getActiveSheet()->SetCellValue('G'.$row, $element['march'],PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $excel->getActiveSheet()->SetCellValue('H'.$row, $element['april'] );
            $excel->getActiveSheet()->SetCellValue('I'.$row, $element['may'] );
            $excel->getActiveSheet()->SetCellValue('J'.$row, $element['june'] );
            $excel->getActiveSheet()->SetCellValue('K'.$row, $element['july'] );
            $excel->getActiveSheet()->SetCellValue('L'.$row, $element['august'] );
            $excel->getActiveSheet()->SetCellValue('M'.$row, $element['september']);
            $excel->getActiveSheet()->SetCellValue('N'.$row, $element['october']);
            $excel->getActiveSheet()->SetCellValue('O'.$row, $element['november']);
            $excel->getActiveSheet()->SetCellValue('P'.$row, $element['december']);
            $excel->getActiveSheet()->SetCellValue('Q'.$row, $element['january'] + $element['february'] + $element['march'] + $element['april']  + $element['may'] + $element['june'] + $element['july'] + $element['august'] + $element['september'] + $element['october'] + $element['november'] + $element['december']);

            $row++;
        }
       $filename = 'Report as of ' .date("m-d-Y").'.xls';        
$object_excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');// Explain format of Excel data
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$filename);
$object_excel_writer->save('php://output');
    }




}

                 