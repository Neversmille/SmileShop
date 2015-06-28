<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model {

    /*
    *   Получение истории заказов клиента
    *   @param int $client_id
    */
    public function get_orders_history($client_id) {
        $client_id = intval($client_id);

        //Получение массива информации о заказах по client_id
        $orders = $this->db->where('order_client_id',$client_id)
                                    ->order_by('order_id','desc')
                                    ->get('orders')
                                    ->result_array();

        if (empty($orders)) {
            return array("error" => "по запросу ничего не найдено");
        }else{
            return array("data" => $orders);
        }
    }

    /*
    *   Получение подробных данных заказаов
    *   @param array $orders - массив заказов пользователя
    */
    public function get_orders_detail($orders) {
        if (!is_array($orders)){
            return array("error" => "аргумент должен быть типа array");
        }
        if (empty($orders)){
            return array("error" => "нет заказов");
        }
        
        //Формирование массива из order_id
        foreach ($orders as $value) {
            $orders_id[] = $value["order_id"];
        }

        // Получение массива информации всех товаров из списка заказов
        $orderItems = $this->db->join('products', 'orderItem_product_id = product_id', 'left')
                                           ->where_in('orderItem_order_id',$orders_id)
                                            ->get('orderItems')
                                            ->result_array();


        if (empty($orderItems)) {
            return array("error" => "информации по заказам отсутствует");
        }

        //Формирование массива ["order_id" => array(orderItems1,orderItems2,....)]
        foreach ($orderItems as $value) {
            $order_id = $value["orderItem_order_id"];

            if (!isset($all_info[$order_id])){
                $all_info[$order_id] = array();
            }
            $all_info[$order_id][] = $value;
        }

        if(empty($all_info)) {
            return array("error" => "по запросу ничего не найдено");
        }else{
            return  array("data" => $all_info);
        }
    }

}
