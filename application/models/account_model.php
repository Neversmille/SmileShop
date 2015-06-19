<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	/*
	*	Добавление учетной записи пользователя
	*	@param array $client_data
	*	@          string $client_data["client_name"] - Имя
	*	@          string $client_data["client_email"] - Почта
	*	@          string $client_data["password"] - Почтовый ящик
	*/
	public function add_client($client_data){
		    $this->db->insert('clients', $client_data);
	}

	/*
	*	Проверка существования почты в БД
	*	@param string $email - почтовая почта
	*	@return boolean true-почта существуе
	*	@return boolean false - почта не существует
	*/
	public function check_email($email){
		$status = $this->db->select('client_email')
                                            ->where('client_email',$email)
									  ->count_all_results('clients');
        if ($status){
			return true;
		}else{
			return false;
		}

	}

	/*
	*	Авторизация пользователя
	*	@param string $email - почтовый ящик
	*	@param string $password - пароль
	*	@return boolean true - авторизация успешна
	*	@return boolean false - авторизация неудачна
	*	@set session name,lastname,email,phone,id
	*/
	public function client_auth($email, $password){

		$client_data = $this->db->where('client_email',$email)
								->get('clients')
								->result_array();

         //Проверяем существует ли пользователь с такой почтой
		if(empty($client_data)){
			return false;
		}else{
            $client_data = $client_data[0];
            $db_pass = $client_data["client_password"];
            unset($client_data["client_password"]);
            $this->load->library('passwordhash');
            //Проверяем правильность ввденного пароля
            if ($this->passwordhash->CheckPassword($password,$db_pass)){
                $this->client_set_auth($client_data);
                return true;
            }else {
                return false;
            }
        }
	}

	/*
	*	Установка сессии после успешной авторизации
	*	@param array $client_data - информация о пользователе
	*	$client_data[client_id,client_name,client_lastname,client_email,
	*				    client_phone,client_password, client_type,client_soc_id]
	*/
	public function client_set_auth($client_data) {
		$this->session->set_userdata(array("account" => $client_data));
	}

    /*
    *   Авторизация пользователя через соц сеть
    *   @param int $client_soc_id - id пользователя в соц сети
    *   @return boolean true - авторизирован
    *   @return boolean false - ошибка авторизации
    */
    public function soc_client_auth($client_soc_id) {
        $client_data = $this->db->where("client_soc_id",$client_soc_id)
                        ->get('clients')
                        ->result_array();
        if(empty($client_data)){
            return false;
        }else {
            $this->client_set_auth($client_data[0]);
            return true;
        }
    }

    /*
    *   Проверка существования пользователя с таким соц ид в БД
    *   @param int $client_soc_id - id пользователя в соц сети
    *   @return boolean true - пользователь сущестует
    *   @return boolean false - пользователь не существует
    */
    public function check_soc_id($client_soc_id){
		$status = $this->db->select('client_soc_id')
                                            ->where('client_soc_id',$client_soc_id)
									  ->count_all_results('clients');
        if ($status){
			return true;
		}else{
			return false;
		}
    }

    /*
    *   Отправка почты с регистрационными данными
    *   @param string $email - пользовательская почта
    *   @param string $pass - пароль
    *   @return boolean true - почта отправлена
    *   @return boolean false - ошибка отправки почты
    */
    public function send_email($email,$pass){

        $subject = "Интернет магазин SmileShop";
        $message = "Поздравляем с успешной регистрацией.\rДанные для входа на сайт: login: ${email} pass:${pass}";

        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('admin@smileshop', 'Администрация');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send()){
            return true;
        }else{
            return false;
        }
    }

    /*
    *   Обновление данных клиента
    *   @param int $client_id - id пользователя
    *   @param array $client_data - массив обновляеммых данных ["поле"  => "значение"]
    */
    public function update_client($client_id, $client_data){
        $result = $this->db->where('client_id', $client_id)
                     ->update('clients', $client_data);
        if ($result) {
            return true;
        }else {
            return false;
        }

    }

}
