<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
     'register' => array(
		array(
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]'
		),
		array(
			'field' => 'lastname',
			'label' => 'Фамилия',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]'
		),
		array(
			'field' => 'email',
			'label' => 'eMail',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email|callback_unique_email'
		),
		array(
			'field' => 'password',
			'label' => 'Пароль',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]'
		)
    ),
	'login' => array(
		array(
			'field' => 'email',
			'label' => 'eMail',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email'
		),
		array(
			'field' => 'password',
			'label' => 'Пароль',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]'
		)
	),
	'reviews' => array(
		array(
            'field' => 'text',
            'label' => 'Ваш отзыв',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[400]'
        )
	),
	'order' => array(
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
	),
	'profile' => array(
		array(
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]'
		),array(
			'field' => 'lastname',
			'label' => 'Фамилия',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]'
		)
	)

);
