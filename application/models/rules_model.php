<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rules_model extends CI_Model {

    public function reviews_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    public function register_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    public function login_erorrs(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    public function order_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('is_natural', 'Телефон необходимо указывать в формате 0680000000');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    public function profile_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    public function changepass_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
        $this->form_validation->set_message('matches', 'Пароли должны совпадать');
    }

    public function admin_login_erorrs(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

}
