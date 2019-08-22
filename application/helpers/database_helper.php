<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('session_check'))
{
    function session_check()
    {
        $CI = get_instance();
        $CI->load->library('session');

        if(empty($CI->session->userdata())) {
            redirect('http://ecommerce5/ipc_central/php_processors/proc_logout.php');
        }
    }
}
