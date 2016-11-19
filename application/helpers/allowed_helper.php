<?php
function allowed($param) 
{
    $CI =& get_instance();
    if ($CI->session->userdata('level') != $param) {
            redirect(base_url(),'refresh');
        }
}