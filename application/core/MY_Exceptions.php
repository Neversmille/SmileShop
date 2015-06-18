<?php
// application/core/MY_Exceptions.php
class MY_Exceptions extends CI_Exceptions {

    public function show_404()
    {
        $CI =& get_instance();
        // $CI->load->view('404.php');
		$CI->middle = '404.php';
		$CI->layout();
		$CI->output->set_status_header('404');
         echo $CI->output->get_output();
        exit;
    }
}
