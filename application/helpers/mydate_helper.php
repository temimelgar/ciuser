<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('mydateFormat'))
{
    function mydateFormat($originalDate)
    {
        return date('m/d/Y', strtotime($originalDate));
    }
}


if(!function_exists('myDateTime'))
{
    function myDateTime($originalDate)
    {
        return date('m/d/Y h:i:s', strtotime($originalDate));
    }
}
