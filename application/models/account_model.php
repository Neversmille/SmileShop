<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model {

	/*
	*	Добавление учетной записи пользователя
	*	@param array $client_data
	*	          string $client_data["client_name"] - Имя
	*	          string $client_data["client_email"] - Почта
	*	          string $client_data["password"] - Почтовый ящик
	*/
	public function add_client($client_data){
        if (!is_array($client_data)){
            return array("error" => "аргумент должен быть массивом");
        }
        if ($this->db->insert('clients', $client_data)) {
            return array("data" => true);
        }else{
            return array("error" => "ошибка выполнения запроса");
        }

    }

	/*
	*	Проверка существования почты в БД
	*	@param string $email - почтовая почта
	*/
	public function check_email($email){
        if(!is_string($email)){
            return array("error" => "аргумент должен быть строкой");
        }
        $status = $this->db->select('client_email')
                                    ->where('client_email',$email)
                                    ->count_all_results('clients');
        if ($status === 0){
			return  array("data" => true);
		}else{
			return array("error" => "пользователь с таким email уже существует");
		}

	}

	/*
	*	Авторизация пользователя
	*	@param string $email - почтовый ящик
	*	@param string $password - пароль
	*	@set session name,lastname,email,phone,id
	*/
	public function client_auth($email, $password){
        if(!is_string($email) || !is_string($password)){
            return array("error" => "аргументы должны быть строками");
        }

        $client_data = $this->db->where('client_email',$email)
								->get('clients')
								->result_array();

		if(empty($client_data)){
			return array("error" => "пользователя с таким email не существует");
		}else{
            $client_data = $client_data[0];
            $db_pass = $client_data["client_password"];
            unset($client_data["client_password"]);
            $this->load->library('passwordhash');
            //Проверяем правильность ввденного пароля
            if ($this->passwordhash->CheckPassword($password,$db_pass)){
                $this->client_set_auth($client_data);
                return array("data" => true);
            }else {
                return array("error" => "неверный пароль");
            }
        }
	}

	/*
	*	Установка сессии после успешной авторизации
	*	@param array $client_data - информация о пользователе
	*/
	public function client_set_auth($client_data) {
        if (!is_array($client_data)){
            return array("error" => "аргумент должен быть массивом");
        }

        $this->session->set_userdata(array("account" => $client_data));
        return array("data" => true);
	}

    /*
    *   Авторизация пользователя через соц сеть
    *   @param int $client_soc_id - id пользователя в соц сети
    */
    public function soc_client_auth($client_soc_id) {
        if(!is_int($client_soc_id)){
            return array("error" => "аргумент должен быть типа int");
        }
        $client_data = $this->db->where("client_soc_id",$client_soc_id)
                        ->get('clients')
                        ->result_array();
        if(empty($client_data)){
            return array("error" => "такого пользователя не существует");
        }else {
            $this->client_set_auth($client_data[0]);
            return array("data" => true);
        }
    }

    /*
    *   Проверка существования пользователя с таким соц ид в БД
    *   @param int $client_soc_id - id пользователя в соц сети
    */
    public function check_soc_id($client_soc_id){
        if(!is_int($client_soc_id)){
            return array("error" => "аргумент должен быть типа int");
        }
        $status = $this->db->select('client_soc_id')
                                            ->where('client_soc_id',$client_soc_id)
									  ->count_all_results('clients');
        if ($status===1){
			return array("data" => true);
		}else{
			return array("error" => "пользователя с таким соц id не существует");
		}
    }

    /*
    *   Отправка почты с регистрационными данными
    *   @param string $email - пользовательская почта
    *   @param string $pass - пароль
    */
    public function send_email($email,$pass){
        if(!is_string($email)||!is_string($pass)){
            return array("error" => "аргументы должны быть типа string");
        }
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
            return array("data" => true);
        }else{
            return array("error" => "ошибка отправки почты");
        }
    }

    /*
    *   Обновление данных клиента
    *   @param int $client_id - id пользователя
    *   @param array $client_data - массив обновляеммых данных ["поле"  => "значение"]
    */
    public function update_client($client_id, $client_data){
		$client_id = intval($client_id);
        if(!is_array($client_data)){
            return array("error" => "неверный тип аргументов");
        }
        $result = $this->db->where('client_id', $client_id)
                     ->update('clients', $client_data);
        if ($result) {
            return array("data" => true);
        }else {
            return array("error" => "ошибка обновления данных");
        }

    }

}
