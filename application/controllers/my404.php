<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class my404 extends MY_Controller
{


    public function index($error = "Запрашиваемая Вами страница не найдена")
    {
        $this->output->set_status_header('404');
        $this->data["error"] = $error;
        $this->middle = '404.php';
        $this->layout();
    }
}
