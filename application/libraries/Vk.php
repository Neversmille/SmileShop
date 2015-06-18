<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vk {

    private $code; //Секртеный код полученный от вк
    private $client_id; //id приложения
    private $client_secret; //Секретный ключ приложения
    private $redirect_url;//Url перенаправления
    private $fields;//

    function __construct($params) {
        $this->client_id = $params["client_id"];
        $this->client_secret = $params["client_secret"];
        $this->redirect_url = $params["redirect_url"];
        $this->code = $params["code"];
        $this->fields = $params["fields"];
    }

    /*
    *   Получения токена от вк для запроса данных
    */
    public function getToken(){
        $client_id = urldecode($this->client_id);
        $client_secret = urldecode($this->client_secret);
        $redirect_url = urldecode($this->redirect_url);
        $token_url = "https://oauth.vk.com/access_token?client_id=".$this->client_id."&client_secret=".$this->client_secret."&code=".$this->code."&redirect_uri=".$this->redirect_url;
        $curl = curl_init($token_url);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 10);
        $rawdata = curl_exec($curl);
        $rawdata = json_decode($rawdata);
        curl_close($curl);
        return $rawdata;
    }

    /*
    *   Запрос данных от вк при помощи токена
    */
    public function getData($rawdata){
        $access_token = urldecode($rawdata->access_token);
        $user_id =  urldecode($rawdata->user_id);
        $fields = urldecode($this->fields);
        $data_url = "https://api.vk.com/method/users.get?uids=${user_id}&fields=${fields}&access_token${access_token}";
        $curl = curl_init($data_url);
        curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 10);
        $userdata = curl_exec($curl);
        $userdata = json_decode($userdata)->response[0];
        return $userdata;
    }

}
