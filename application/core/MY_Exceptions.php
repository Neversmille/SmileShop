<?php
// application/core/MY_Exceptions.php
class MY_Exceptions extends CI_Exceptions {

    public function show_404($error = "Запрашиваемая Вами страница не найдена")
    {
        $CI =& get_instance();
        $CI->data["error"] = $error;
        $CI->middle = '404.php';
        $CI->layout();
        $CI->output->set_status_header('404');
        echo $CI->output->get_output();
        exit;
    }
}
