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
    *   @param string $client_email - почта клиента
    *   @param string $phone - введенный при оформлении заказа телефон
    *   @param string $text - дополнительные пожелания по заказу
    */
    public function add_order($basket,$client_id,$client_email,$phone,$text){
        $client_id = intval($client_id);
        if(!is_array($basket) || !is_string($phone) || !is_string($client_email) || !is_string($array)){
            return array("error" => "неверный тип аргументов");
        }
        //Фомируем массив id товаров в корзине
        $products_id = array_keys($basket);
        $products_price = $this->get_all_products_price($products_id);
        if(isset($products_price["error"])){
            return array("error" => "ошибка получения цен");
        }
        $products_price = $products_price["data"];

        //Заполняем массив корзины ценами из базы данных
        foreach ($products_price as $value) {
            $id = $value["product_id"];
            $basket[$id]["product_price"] = $value["product_price"];
        }


        $totalCost = $this->count_total_cost($basket);
        if(isset($totalCost["error"])){
            return array("error" => "ошибка подсчета общей суммы");
        }
        $totalCost = $totalCost["data"];

        $order_id = $this->order_record($totalCost,$client_id,$text,$phone);
        if (isset($order_id["error"])){
            return array("error" => "ошибка добавления заказа");
        }
        $order_id = $order_id["data"];

        $add_order_products = $this->add_order_products($basket,$order_id);
        if (isset($add_order_products["error"])){
            return array("error" => "ошибка добавления товаров в заказ");
        }else{
            $this->send_order_email($client_email,$totalCost);
            return array("data" => true);
        }

    }

    /*
    *   Подсчет общей стоимости заказа
    *   @param array $basket
    */
    public function count_total_cost($basket){
        if(!is_array($basket)){
            return array("error" => "аргумент должен быть типа array");
        }
        $totalCost = 0;

        foreach ($basket as  $value) {
            $totalCost+= $value["amount"]*$value["product_price"];
        }

        if($totalCost>0){
            return array("data" => $totalCost);
        }else{
            return array("error" => "некорректная общая стоимость");
        }

    }

    /*
    *   Получение массива цен товаров по массиву их id
    *   @param array $products_id - массив id товара
    */
    public function get_all_products_price($products_id){
        if(!is_array($products_id)){
            return array("error" => "аргумент должен быть типа array");
        }
        $prices = $this->db->select('product_id, product_price')
                            ->where_in('product_id',$products_id)
                            ->get('products')
                            ->result_array();

        //Проверяем для всех ли товаров была найдена цена
        if($prices&&(count($prices)==count($products_id))){
            return array("data" => $prices);
        }else {
            return array("error" => "ошибка получения цен");
        }

    }

    /*
    *   Добавление записи о заказе в БД
    *   @param float $order_price - общая сумма заказа
    *   @param int $client_id - id клиента
    *   @param string $text - дополнительная информация по заказу
    *   @param $order_phone - номер телефона в заказе
    */
    public function order_record($order_price,$client_id,$order_text,$order_phone){
        $client_id = intval($client_id);

        $id_check = $this->check_client_id($client_id);
        if (isset($id_check["error"])){
            return array("error" => "нет клиента с таким id");
        }

        $data = array("order_price" => $order_price, "order_client_id" => $client_id, "order_text" => $order_text, "order_phone" => $order_phone);
        if($this->db->insert('orders',$data)){
            return array("data" => $this->db->insert_id());
        }else {
            return array("error" => "ошибка добавления зака");
        }

    }

    /*
    *   Проверка существования клиента по id
    *   @param int $client_id
    */
    public function check_client_id($client_id){
        $client_id = intval($client_id);
        $client = $this->db->where('client_id',$client_id)
                                    ->count_all_results('clients');
        if($client===1){
            return array("data" => true);
        }else{
            return array("error" => "нет клиента с таким id");
        }
    }

    /*
    *   Добавление товаров к заказу
    *   @param array $basket - данные о заказе
    *   @param int $order_id - id заказа
    */
    function add_order_products($basket,$order_id){
        $order_id = intval($order_id);
        if(!is_array($basket)){
            return array("error" => "неверный тип аргумента");
        }
        foreach ($basket as $key => $value) {
            $array = array("orderItem_order_id" => $order_id,
                                "orderItem_product_id" => $key,
                                 "orderItem_amount" => $value["amount"],
                                 "orderItem_price" => $value["product_price"]);
            $data[] = $array;
        }

        if($this->db->insert_batch('orderItems',$data)){
            return array("data" => true);
        }else{
            return array("error" => "ошибка добавления товаров в заказ");
        }

    }


    /*
    *   Отправка почты с регистрационными данными
    *   @param string $email - пользовательская почта
    *   @param float $totalCost - общая сумма заказа
    */
    public function send_order_email($email,$totalCost){
        if(!is_string($email)){
            return array("error" => "неверный формат почтовой почты"); 
        }

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
            return array("data" => true);
        }else{
            return array("error" => "ошибка отправки почты");
        }
    }


}
