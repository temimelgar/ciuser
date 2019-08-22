<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
class Phpspreadsheet extends CI_Controller {
    
    public function index()
    {       
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $sheet->setCellValue('A2', 12345.6789);
        $sheet->setCellValue('A3', TRUE);
        $sheet->setCellValue(
    'A4',
    '=IF(A3, CONCATENATE(A1, " ", A2), CONCATENATE(A2, " ", A1))');
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file.xlsx';
 
        $writer->save($filename); // will create and save the file in the root of the project
 
    }
 
    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $sheet->setCellValue('A2', 12345.6789);
        $sheet->setCellValue('A4', 42374324723);
        $sheet->setCellValue('A3', TRUE);
        $sheet->getCell('B8')
    ->setValue('Some value');
        $sheet->setCellValue('A4','=IF(A3, CONCATENATE(A1, " ", A2), CONCATENATE(A2, " ", A1))');        
        $sheet->setCellValue('A5')->getCell('A2', 'A4')->getCalculatedValue();        



        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
    }
}