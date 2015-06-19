<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rules_model extends CI_Model {

    //Параметры валидации отзывов
    public $reviews_rules = array(
        array(
            'field' => 'text',
            'label' => 'Ваш отзыв',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[400]'
        )
    );

    public function reviews_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    //Параметры валидации регистрации
    public $register_rules = array(
        array(
            'field' => 'name',
            'label' => 'Имя',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]|'
        ),array(
            'field' => 'lastname',
            'label' => 'Фамилия',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]|'
        ),
        array(
            'field' => 'email',
            'label' => 'eMail',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Пароль',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]|trim'
        )
    );

    public function register_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    //Параметры валидации авторизации
    public $login_rules = array(
        array(
            'field' => 'email',
            'label' => 'eMail',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email'
        ),
        array(
            'field' => 'password',
            'label' => 'Пароль',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]|trim'
        )
    );

    public function login_erorrs(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

    //Параметры валидации авторизации
    public $order_rules = array(
        array(
            'field' => 'phone',
            'label' => 'Телефон',
            'rules' => 'is_natural|required|xss_clean|trim|min_length[7]|max_length[20]'
        ),
        array(
            'field' => 'text',
            'label' => 'Дополнительная информация',
            'rules' => 'xss_clean|prep_for_form|encode_php_tags|trim|max_length[500]|trim'
        )
    );

    public function order_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('is_natural', 'Телефон необходимо указывать в формате 0680000000');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }


    //Параметры валидации личного кабинета
    public $profile_rules = array(
        array(
            'field' => 'name',
            'label' => 'Имя',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]|'
        ),array(
            'field' => 'lastname',
            'label' => 'Фамилия',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]|'
        )
    );

    public function profile_errors(){
        $this->form_validation->set_error_delimiters('<p class="color">', '</p>');
        $this->form_validation->set_message('required', 'Поле обязательно для заполнения');
        $this->form_validation->set_message('min_length', 'Поле "%s" должно быть не менее %s символов');
        $this->form_validation->set_message('max_length', 'Поле "%s" должно быть не более %s символов');
    }

}
