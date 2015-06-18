<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public $data;
    public $template  = array();

    public function __construct(){

        parent::__construct();
        /*
        *   Проверка авторизирован ли пользователь
        */
        $this->data["login_status"] = $this->set_login_status();
        $this->data["title"] = "тайтл";
        $this->data["basket_count"] = $this->get_basket_count();

    }


    /*
    *   Загрузка layout
    */
    public function layout() {
         $this->data["css"] = array('style.css','owl.carousel.css','bootstrap.min.css','flexslider.css','flexslider.css','font-awesome.min.css','red.css','sidebar-nav.css');
         $this->data["js"] = array('jquery.js','bootstrap.min.js','owl.carousel.min.js','filter.js','nav.js','jquery.flexslider-min.js','respond.min.js','html5shiv.js','custom.js','ajax-basket.js');
         $this->data['user_widget']   = $this->load->view('layouts/user_widget', $this->data, true);
         $this->template['header']   = $this->load->view('layouts/header', $this->data, true);
         $this->template['menu']   = $this->load->view('layouts/menu', $this->data, true);
         $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
         $this->template['newsletter'] = $this->load->view('layouts/newsletter', $this->data, true);
         $this->template['footer'] = $this->load->view('layouts/footer', $this->data, true);
         $this->template['product_add'] = $this->load->view('modals/product_add',$this->data,true);
         $this->load->view('layouts/index', $this->template);
   }

   /*
   *    Получение количества наименований в корзине
   */
   private function get_basket_count(){
       $basket = $this->session->userdata('basket');
       if ($basket) {
           return $basket = count($basket);
       }else{
           return $basket = 0;
       }
   }

   private function set_login_status(){
       if ($this->session->userdata('account')) {
           $this->data["user_info"] = $this->session->userdata('account');
           return true;
       }else{
           return false;
       }
   }

}
