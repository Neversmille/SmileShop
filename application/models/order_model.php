<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Order_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->load->model('catalog_model');
    }

    /*
    *   Добавление заказа в бд
    *   @param array $client_id - id клиента
    *   @param string $phone - введенный при оформлении заказа телефон
    *   @param string $text - дополнительные пожелания по заказу
    *   @return boolean true - в случае успеха
    *   @return boolean false - в случае ошибки
    */
    public function add_order($basket,$client_id,$client_email,$phone,$text){

        //Фомируем массив id товаров в корзине
        $products_id = array_keys($basket);
        $products_price = $this->get_all_products_price($products_id);

        //Если цены не получены
        if (!$products_price){
            return false;
        }

        //Заполняем массив корзины ценами из базы данных
        foreach ($products_price as $value) {
            $id = $value["product_id"];
            $basket[$id]["product_price"] = $value["product_price"];
        }

        // var_dump($basket);
        // die("basket");

        $totalCost = $this->count_total_cost($basket);
        if (!$totalCost) {
            return false;
        }
        // var_dump($totalCost);

        $order_id = $this->order_record($totalCost,$client_id,$text,$phone);
        if (!$order_id){
            return false;
        }

        if($this->add_order_products($basket,$order_id)){
            $this->send_order_email($client_email,$totalCost);
            return true;
        }else {
            return false;
        }

    }

    /*
    *   Подсчет общей стоимости заказа
    *   @param array $basket
    */
    public function count_total_cost($basket){

        $totalCost = 0;

        foreach ($basket as  $value) {
            $totalCost+= $value["amount"]*$value["product_price"];
        }

        if($totalCost>0){
            return $totalCost;
        }else{
            return false;
        }

    }

    /*
    *   Поулчение массива цен товаров по массиву их id
    *   @param array $products_id - массив id товара
    *   @return array - массив цен
    *   @return array() - в случае ошибки
    */
    public function get_all_products_price($products_id){

        $prices = $this->db->select('product_id, product_price')
                            ->where_in('product_id',$products_id)
                            ->get('products')
                            ->result_array();

        //Проверяем для всех ли товаров была найдена цена
        if($prices&&(count($prices)==count($products_id))){
            return $prices;
        }else {
            return array();
        }

    }

    /*
    *   Добавление записи о заказе в БД
    *   @param float $order_price - общая сумма заказа
    *   @param int $client_id - id клиента
    *   @param string $text - дополнительная информация по заказу
    *   @param $order_phone - номер телефона в заказе
    *   @return int - id заказа
    *   @return boolean false - ошибка добавления заказа
    */
    public function order_record($order_price,$client_id,$order_text,$order_phone){
        if(!$this->check_client_id($client_id)){
            return false;
        }
        $data = array("order_price" => $order_price, "order_client_id" => $client_id, "order_text" => $order_text, "order_phone" => $order_phone);
        if($this->db->insert('orders',$data)){
            return $this->db->insert_id();
        }else {
            return false;
        }

    }

    /*
    *   Проверка существования клиента по id
    *   @param int $client_id
    *   @return boolean true - клиент есть
    *   @return boolean false - клиента нет
    */
    public function check_client_id($client_id){
        $client = $this->db->where('client_id',$client_id)
                                    ->count_all_results('clients');
        if($client){
            return true;
        }else{
            return false;
        }
    }

    /*
    *   Добавление товаров к заказу
    *   @param array $basket - данные о заказе
    *   @param int $order_id - id заказа
    *   @return boolean true - данные добавлены
    *   @return boolean false - ошибка добавления данных
    */
    function add_order_products($basket,$order_id){
        $data = array();
        foreach ($basket as $key => $value) {
            $array = array("orderItem_order_id" => $order_id,
                                "orderItem_product_id" => $key,
                                 "orderItem_amount" => $value["amount"],
                                 "orderItem_price" => $value["product_price"]);
            array_push($data, $array);
        }

        if($this->db->insert_batch('orderItems',$data)){
            return true;
        }else{
            return false;
        }

    }


    /*
    *   Отправка почты с регистрационными данными
    *   @param string $email - пользовательская почта
    *   @param float $totalCost - общая сумма заказа
    *   @return boolean true - почта отправлена
    *   @return boolean false - ошибка отправки почты
    */
    public function send_order_email($email,$totalCost){

        $subject = "Интернет магазин SmileShop";
        $message = "Ваш заказ успешно принят! Общая сумма заказа: ${totalCost} грн. В ближайшее время наш оператор свяжется с вами";

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


}
