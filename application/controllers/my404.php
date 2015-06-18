<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class my404 extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$this->output->set_status_header('404');
		$this->middle = '404.php';
		$this->layout();
    }
}
?>
