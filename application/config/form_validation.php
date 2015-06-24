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
	),
    'changepass' => array(
        array(
			'field' => 'oldpass',
			'label' => 'Пароль',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]|callback_check_pass'
		),
        array(
			'field' => 'newpass',
			'label' => 'Пароль',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]|matches[confpass]'
		),
        array(
			'field' => 'confpass',
			'label' => 'Пароль',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]'
		)
    ),
    'admin_login' => array(
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
    'product' => array(
        array(
            'field' => 'product_id',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[11]|is_natural'
        ),
        array(
            'field' => 'product_name',
            'label' => 'Наименование',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[255]'
        ),
        array(
            'field' => 'product_url',
            'label' => 'URL',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[100]|alpha_dash|callback_check_unique_edit_url'
        ),
        array(
            'field' => 'product_price',
            'label' => 'Цена',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[8]|callback_ check_price'
        ),
        array(
            'field' => 'product_description',
            'label' => 'Описание',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[400]'
        ),
        array(
            'field' => 'product_category_id',
            'label' => 'Категория',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[11]|is_natural'
        ),
        array(
            'field' => 'product_hot',
            'label' => 'Горячее предложение',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[1]|is_natural'
        ),
        array(
            'field' => 'product_avaible',
            'label' => 'Наличие на складе',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[1]|is_natural'
        ),
    ),
    'product_add' => array(
        array(
            'field' => 'product_name',
            'label' => 'Наименование',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[255]'
        ),
        array(
            'field' => 'product_url',
            'label' => 'URL',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[100]|alpha_dash|callback_check_unique_url'
        ),
        array(
            'field' => 'product_price',
            'label' => 'Цена',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[8]|callback_ check_price'
        ),
        array(
            'field' => 'product_description',
            'label' => 'Описание',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[400]'
        ),
        array(
            'field' => 'product_category_id',
            'label' => 'Категория',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[11]|is_natural'
        ),
        array(
            'field' => 'product_hot',
            'label' => 'Горячее предложение',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[1]|is_natural'
        ),
        array(
            'field' => 'product_avaible',
            'label' => 'Наличие на складе',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[1]|is_natural'
        ),
    ),
    'firm' => array(
        array(
            'field' => 'firm_id',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[11]|is_natural'
        ),
        array(
            'field' => 'firm_name',
            'label' => 'Наименование',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[30]|callback_check_unique_edit_name'
        )
    ),
    'firm_add' => array(
        array(
            'field' => 'firm_name',
            'label' => 'Наименование',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[30]|callback_check_unique_name'
        )
    )


);
