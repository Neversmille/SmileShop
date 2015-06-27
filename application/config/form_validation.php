<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
     'register' => array(
		array(
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[40]'
		),
		array(
			'field' => 'lastname',
			'label' => 'Фамилия',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[40]'
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
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[400]'
		),
        array(
			'field' => 'email',
			'label' => 'eMail',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email|callback_unique_email'
		),
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
    ),
    'admin_review' => array(
        array(
            'field' => 'review_is_delete',
            'label' => 'Статус',
            'rules' => 'required|max_length[1]|callback_check_review_select'
        ),
        array(
            'field' => 'review_id',
            'rules' => 'required|min_length[1]|max_length[11]|is_natural_no_zero'
        )
    ),
    'slide_add' => array(
        array(
            'field' => 'slider_position',
            'label' => 'Позиция(1-99)',
            'rules' => 'required|min_length|max_length[2]|is_natural_no_zero'
        ),
        array(
            'field' => 'slider_is_active',
            'label' => 'Статус',
            'rules' => 'required|max_length[1]|callback_check_is_active'
        ),
        array(
            'field' => 'slider_product_name',
            'label' => 'Наименование',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[1]|max_length[255]'
        ),
		array(
            'field' => 'slider_description',
            'label' => 'Описание',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[400]'
        )
    ),
    'admin_update_pass' => array(
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
    'admin_update_info' => array(
        array(
			'field' => 'name',
			'label' => 'Имя',
			'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[40]'
		)
    ),
    'add_new_admin' => array(
       array(
           'field' => 'name',
           'label' => 'Имя',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[40]'
       ),
       array(
           'field' => 'email',
           'label' => 'eMail',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email|callback_unique_email'
       ),
       array(
           'field' => 'password',
           'label' => 'Пароль',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]|matches[confpass]'
       ),
       array(
           'field' => 'confpass',
           'label' => 'Пароль',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]'
       ),
       array(
           'field' => 'allow_orders',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_products',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_firms',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_reviews',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_slider',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_admins',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       )
   ),
   'edit_admin' => array(
       array(
           'field' => 'name',
           'label' => 'Имя',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[2]|max_length[40]'
       ),
       array(
           'field' => 'email',
           'label' => 'eMail',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[40]|valid_email'
       ),
       array(
           'field' => 'is_active',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_orders',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_products',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_firms',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_reviews',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_slider',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
       array(
           'field' => 'allow_admins',
           'label' => 'Статус',
           'rules' => 'required|max_length[1]|callback_check_is_active'
       ),
   ),
   'edit_admin_pass' => array(
       array(
           'field' => 'password',
           'label' => 'Пароль',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]|matches[confpass]'
       ),
       array(
           'field' => 'confpass',
           'label' => 'Пароль',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|min_length[5]|max_length[20]'
       )
   ),
   'edit_order' => array(
       array(
           'field' => 'order_id',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|max_length[11]|integer'
       ),
       array(
           'field' => 'order_status',
           'rules' => 'required|xss_clean|prep_for_form|encode_php_tags|trim|max_length[1]|callback_check_status'
       )
   )


);
